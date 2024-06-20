<?php

namespace App\Http\Controllers;

use App\CustomerOrder;
use App\MemberCustomerOrder;
use App\Customer;
use App\OrderRequest;
use App\CustomerOrderHasOrderRequest;
use App\Product;
use Illuminate\Http\Request;
use DB;
use Exception;
use App\Mail\CustomerOrder as CustomerOrderMail;
use Mail;
use App\Traits\Invoice;
use PDF;
use Carbon\Carbon;
use App\Exports\WeeklyReportExport;
use Maatwebsite\Excel\Facades\Excel;
class CustomerOrderController extends Controller
{
    Use Invoice;
    function __construct()
    {
         $this->middleware('permission:customerOrder-list|customerOrder-create|customerOrder-edit|customerOrder-delete', ['only' => ['index','show']]);
         $this->middleware('permission:customerOrder-create', ['only' => ['create','store']]);
         $this->middleware('permission:customerOrder-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:customerOrder-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $orders = new CustomerOrder;
        $query = $orders->withCount('orderRequest')->where('status',0);//default order value
        $warehouse =  $orders->withCount('orderRequest')->where('status',1);//send to warehouse
        $invoices = $orders->pluck('invoice_no', 'id');
        $from=Carbon::parse($request->from)->format('yy-m-d');
        $to=Carbon::parse($request->to)->format('yy-m-d');

        if ($request->has('invoice')) {
            // dd($request->invoice); 
            $query = $query->where('invoice_no', $request->invoice);
            // dd($query);
            $warehouse = $warehouse->where('invoice_no', $request->invoice);
        }

        if ($request->has('from') && $request->has('to')) {
           
            $from=Carbon::parse($request->from)->format('yy-m-d');
            $to=Carbon::parse($request->to)->format('yy-m-d');
           
            $query = CustomerOrder::whereBetween('created_at', [$from, $to])->where('status',0);
            $warehouse = CustomerOrder::whereBetween('created_at', [$from, $to])->where('status',1);
            
        }

      $customerOrders = $query->latest()
                            ->paginate(10);
    $deliveries = $warehouse->latest()
                        ->paginate(10);
      return view('customerOrder.index',compact('customerOrders','deliveries'))
            ->with('i', (request()->input('page', 1) - 1) * 10)
            ->withInvoices($invoices)
            ->withInvoice($request->invoice)
            ->withFrom($from)
            ->withTo($to)
            ->withTitle('CustomerOrder Listing')
            ->with('trash',false);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authUser = auth()->user();
        $teamMemberID = $authUser->getTeamMemberID();
        $isTeamMember = $authUser->isTeamMember();
        $customers = [];
        $products = Product::select('id', 'name', 'detail','image','price')->get();
        $invoice = $this->getNextOrderInv();
        if($isTeamMember) {
            $customers = Customer::where('team_member_id', $teamMemberID)->get();
        }
        return view('customerOrder.create', compact('isTeamMember','customers'))
              ->withTitle('Add New Customer Order')
              ->withProducts($products)
              ->withInvoice($invoice);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $TO_MAIL = env('MAIL_TO_ADDRESS', 'dev8.hmm@gmail.com');
        $authUser = auth()->user();
        $isTeamMember = $authUser->isTeamMember();
        $CUSTOMER_ID = $isTeamMember ? $request->customer_id : $authUser->getCustomerID();
        $TEAM_MEMBER_ID = $authUser->getTeamMemberID();

        $DELIVERED_AT = NULL;
        // $request->validate([
        //     //fieldname
        // ]);
        // dd($request->all());
        DB::beginTransaction();

        try {
            $customer = Customer::find($CUSTOMER_ID);
            $customerName = isset($customer->user) ? $customer->user->name : '';
            // Save Customer Order
            $customerOrder = new CustomerOrder;
            $customerOrder->invoice_no = $request->invoice_no;
            $customerOrder->biller_address = $request->biller_address;
            $customerOrder->delivery_address = $request->delivery_address;
            $customerOrder->customer_note = $request->customer_note;
            $customerOrder->delivered_at = $DELIVERED_AT;
            $customerOrder->save();
            if( !isset($request->order_items) ) throw new Exception('Order Items should not empty');
            foreach ($request->order_items as $key => $order_item) {
                $orderRequest = new OrderRequest;
                $orderRequest->item_no = $order_item['item_no'];
                // $orderRequest->pack_size = $order_item['pack_size'];
                $orderRequest->description = $order_item['description'];
                $orderRequest->quantity = $order_item['quantity'];
                $orderRequest->remark = $order_item['remark'];
                $orderRequest->save();

                $customerOrder->orderRequest()->attach($orderRequest->id);
            }
            MemberCustomerOrder::create([
                'member_id' => $TEAM_MEMBER_ID,
                'customer_id' => $CUSTOMER_ID,
                'customer_order_id' => $customerOrder->id,
            ]);
            Mail::to($TO_MAIL)->send(new CustomerOrderMail($customerName, $customerOrder, $request->order_items));
            // commit
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput($request->input())->withErrors([$e->getMessage()]);
        } 
        $this->increaseNextOrderInv();
        return redirect()->route('customer-orders.index')
                        ->with('success','CustomerOrder created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CustomerOrder  $customerOrder
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerOrder $customerOrder)
    {
        return view('customerOrder.show',compact('customerOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CustomerOrder  $customerOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerOrder $customerOrder)
    {
        $products = Product::select('id', 'name', 'detail')->get();
        return view('customerOrder.edit',compact('customerOrder'))
              ->withTitle('Edit Customer Order')
              ->withProducts($products);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CustomerOrder  $customerOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerOrder $customerOrder)
    {
         $request->validate([
           //your code
        ]);
        DB::beginTransaction();
        try {
            // Delete User Data
            $customerOrder->invoice_no = $request->invoice_no;
            $customerOrder->biller_address = $request->biller_address;
            $customerOrder->delivery_address = $request->delivery_address;
            $customerOrder->customer_note = $request->customer_note;
            $customerOrder->update();
            if(isset($request->order_items)) {
                foreach ($request->order_items as $key => $order_item) {
                    $orderRequest = new OrderRequest;
                    $orderRequest->item_no = $order_item['item_no'];
                    // $orderRequest->pack_size = $order_item['pack_size'];
                    $orderRequest->description = $order_item['description'];
                    $orderRequest->quantity = $order_item['quantity'];
                    $orderRequest->remark = $order_item['remark'];
                    $orderRequest->save();
    
                    $customerOrder->orderRequest()->attach($orderRequest->id);
                }
            }
            // commit
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors([$e->getMessage()]);
        } 
        return redirect()->route('customer-orders.index')
                        ->with('success','CustomerOrder updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CustomerOrder  $customerOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerOrder $customerOrder)
    {

        DB::beginTransaction();
        try {
            // Delete User Data
            $customerOrder->orderRequest()->delete();
            $customerOrder->orderRequest()->detach();
            // Delete Customer Orde Data
            $customerOrder->delete();
            // commit
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors([$e->getMessage()]);
        } 
        
  
        return redirect()->route('customer-orders.index')
                        ->with('success','CustomerOrder deleted successfully');
    }

    public function customerOrderTrash()
    {
        $customerOrder = CustomerOrder::onlyTrashed()->paginate(10);
        return view('customerOrder.index',compact('customerOrder'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->withTitle('CustomerOrder Listing')
            ->with('trash',true);
    }

    public function customerOrderRestore($id)
    {
        CustomerOrder::where('id', $id)
                ->restore();
        
        return redirect()->route('customerOrder.index')
                         ->with('success','CustomerOrder restore successfully');
    }
    public function deleteOrderItem(Request $request)
    {
        $orderRequest = OrderRequest::find($request->orderID);
        $orderRequest->customerOrder()->detach($request->orderID);
        $orderRequest->delete();
        return response()->json(['success' => true]);
    }
    public function getInvoiceList()
    {
        $customerOrders = CustomerOrder::with('orderRequest')->get();
        return response()->json(['data' => $customerOrders]);
    }
    public function uploadInvoiceCustomerOrder(Request $request)
    {
      // $request->validate([
      //   'invoice' => 'required',
      // ]);    
      // dd($request->all());
      if($request->file('invoice'))
        {
          $path=public_path().'\invoices';
          $filename=date('Ymd-Hi_').$request->file('invoice')->getClientOriginalName();
          $request->file('invoice')
                  ->move($path, $filename);
          $featured_path = $filename;
          DB::beginTransaction();
          try {
            $customerOrder = CustomerOrder::find($request->customerOrder_id);
            $customerOrder->invoice = $featured_path;
            $customerOrder->update();
            // commit
            DB::commit();

          } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors([$e->getMessage()]);
          } 
        }
        return redirect()->route('customer-orders.index')
        ->with('success','Invoice Uploaded successfully');
    }
    public function deliverCustomerOrder(Request $request)
    {
      $DELIVERED_AT = date('Y-m-d h:i:s');
      DB::beginTransaction();
      try {
        $customerOrder = CustomerOrder::find($request->customerOrder_id);
        $customerOrder->delivered_at = $DELIVERED_AT;
        $customerOrder->update();
        // commit
        DB::commit();

      } catch (\Exception $e) {
        DB::rollback();
        return back()->withErrors([$e->getMessage()]);
      } 
      return redirect()->route('customer-orders.index')
             ->with('success','CustomerOrder delivered successfully');
    }
    public function warehouse(CustomerOrder $customerOrder)
    {
      
      $customerOrder->status = 1;//order to delivery
      $customerOrder->update();
      return redirect()->route('customer-orders.index')
           ->with('success','Successfully sended to warehouse!');
    }


    public function warehouseIndex(Request $request)
    {
        // dd($request->all());
        $orders = new CustomerOrder;
        $query = $orders->withCount('orderRequest')->where('status',1);//send order to warehouse
        $warehouse = $orders->withCount('orderRequest')->where('status',2);//deliveried order
        $invoices = $orders->pluck('invoice_no', 'id');

        if (isset($request->date)) {
            $query = $query->whereDate('created_at', $request->date);
            $warehouse = $warehouse->whereDate('created_at', $request->date);
        }

        if (isset($request->invoice)) {
            $query = $query->where('invoice_no', $request->invoice);
            $warehouse = $warehouse->where('invoice_no', $request->invoice);
        }
        
      $customerOrders = $query->latest()
                            ->paginate(10);
    $deliveries = $warehouse->latest()
                        ->paginate(10);
      return view('customerOrder.warehouse',compact('customerOrders','deliveries'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->withInvoices($invoices)
            ->withInvoice($request->invoice)
            ->withDate($request->date)
            ->withTitle('CustomerOrder Listing')
            ->with('trash',false);
    }
    public function delivery(CustomerOrder $customerOrder)
    {
      
      $customerOrder->status = 2;//warehouse to delivery
      $customerOrder->update();
      return redirect()->route('warehouse')
           ->with('success','Successfully delivery to warehouse!');
    }
    
    public function dailyOrder($fd=null,$td=null,Request $request){
        //Weekly report
        $fdate=Carbon::parse($fd)->format('yy-m-d');
        // dd($fdate);
        $tdate=Carbon::parse($td)->format('yy-m-d');

        // $weekly_report = CustomerOrder::whereBetween('created_at',[$fdate,$tdate])->where('status',0)->get();
        // dd($weekly_report);

        // $d = date("Y-m-d");
        $products = Product::all();

        foreach ($products as $value) {
            $data[$value['name']] = OrderRequest::select('item_no')
                                                ->where('item_no',$value['name'])
                                                //->whereDate('created_at',$d)
                                                ->whereBetween('created_at',[$fdate,$tdate])
                                               
                                                ->sum('quantity');
        }
        // dd($data);
        $pdf = PDF::loadView('report.dailyOrder', [
            'data' => $data,
            'from' => $fdate,
            'to'=> $tdate
            ]);
           
        return $pdf->download('salelist'.$fdate.'.pdf',array('Attachment'=> 0));
    }

    public function monthlyOrder(){
        $m = date('m');
        $month = date('F');
        $products = Product::all();
        foreach ($products as $value) {
            $data[$value['name']] = OrderRequest::select('item_no')
                                                ->where('item_no',$value['name'])
                                                ->whereMonth('created_at',$m)
                                                ->sum('quantity');
        }

        $pdf = PDF::loadView('report.monthlyOrder', [
            'data' => $data,
            'month'=> $month
            ]);
        return $pdf->download('salelist'.$month.'.pdf',array('Attachment'=> 0));
    }
    public function weeklyExport() 
    {
        return Excel::download(new WeeklyReportExport, 'weeklyReport.xlsx');
    }
}
