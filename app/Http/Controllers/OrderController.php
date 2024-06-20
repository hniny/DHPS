<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerOrder;
use App\Product;
use App\User;
use Auth;
use App\OrderRequest;
use App\MemberCustomerOrder;
use DB;
use Exception;
use App\Mail\CustomerOrder as CustomerOrderMail;
use Mail;
use Illuminate\Http\Request;
use App\Traits\Invoice;
use App\CustomerOrderHasOrderRequest;

class OrderController extends Controller
{
  Use Invoice;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $user = auth()->user();
      $query = Customer::query();
      $customer = $query;
      $customer = $customer->where('user_id', $user->id)->first();
      $customer = $customer <> null ? $customer->id : 0;
     $customerOrders = new CustomerOrder;

     $q = $customerOrders;
     $invoices = $q->whereHas('customer', function ($query) use($customer)
      {
        $query->where('customer_id', $customer);
      })->pluck('invoice_no', 'id');
      // dd($invoices);
      if (isset($request->invoice)) {
        $customerOrders = $customerOrders->where('invoice_no', $request->invoice);
      }
      if (isset($request->date)) {
        $customerOrders = $customerOrders->whereDate('created_at', $request->date);
      }
     
      $orders =  $customerOrders ->withCount('orderRequest')
                                ->whereHas('customer', function ($query) use($customer)
                                      {
                                        $query->where('member_customer_orders.customer_id', $customer);
                                      })
                                      ->latest()
                                      //customer order
                                      ->paginate(10);
      $warehouse_orders =  $customerOrders ->withCount('orderRequest')
                                ->whereHas('customer', function ($query) use($customer)
                                {
                                  $query->where('member_customer_orders.customer_id', $customer);
                                })
                                ->latest()
                                ->where('status', 1)//order to warehouse
                                ->paginate(10);
      
      return view('order.index',compact('orders','warehouse_orders'))
            ->with('i', (request()->input('page', 1) - 1) * 10)
            ->withInvoices($invoices)
            ->withInvoice($request->invoice)
            ->withDate($request->date)
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
      $user = Auth::user()->id;
      $customer = Customer::where('user_id',$user)->pluck('delivery_address');
      $invoice = $this->getNextOrderInv();
      
      // $customer[0];
      if($isTeamMember) {
        $customers = Customer::where('team_member_id', $teamMemberID)->get();
      }
      
      return view('order.create', compact('isTeamMember','customers','customer'))
            ->withTitle('Customer အော်ဒါအသစ်မှာရန်')
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
        $customerOrder->urgent_order = $request->urgent_order == null?'0':$request->urgent_order;
        $customerOrder->delivered_at = $DELIVERED_AT;
        // $customerOrder = $this->increaseNextOrderInv();
        $customerOrder->save();
       
        // dd($customerOrder);
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
      return redirect()->route('orders.index')
                       ->with('success','CustomerOrder created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerOrder $order)
    {
      
         return view('order.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerOrder $order)
    {
      // $products = Product::select('id', 'name', 'detail','price','image')->get(); 
      $products=Product::all();
      $orders=$order->orderRequest()->get();  
      
    // dd($checked);
      return view('order.edit',compact('order','orders'))
            ->withTitle('Edit Customer Order')
            ->withProducts($products);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerOrder $order)
    {
      // dd($order);
      DB::beginTransaction();
      try {
        // Delete User Data
        $order->invoice_no = $request->invoice_no;
        $order->biller_address = $request->biller_address;
        $order->delivery_address = $request->delivery_address;
        $order->customer_note = $request->customer_note;
         $order->urgent_order = $request->urgent_order == null ? 0 : 1;
       
        $order->update();
        $order->orderRequest()->delete();       
        if(isset($request->order_items)) {            
          foreach ($request->order_items as $key => $order_item) {            
            $orderRequest = new OrderRequest;
            $orderRequest->item_no = $order_item['item_no'];
            // $orderRequest->pack_size = $order_item['pack_size'];
            $orderRequest->description = $order_item['description'];
            $orderRequest->quantity = $order_item['quantity'];
            $orderRequest->remark = $order_item['remark'];
            $orderRequest->save();
            $order->orderRequest()->attach($orderRequest->id);
          }
        }
        // commit
        DB::commit();

      } catch (\Exception $e) {
        DB::rollback();
        return back()->withErrors([$e->getMessage()]);
      } 
      return redirect()->route('orders.index')
                      ->with('success','CustomerOrder updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function invoiceDownload(Request $request)
    {
      // dd($request->all());
      //PDF file is stored under project/publicinvoices/info.pdf

      $file= public_path().'/invoices/'.$request->invoice;

      $headers = array(

        'Content-Type: application/pdf',

      );

      return response()->download($file, $request->invoice, $headers);
    }

    public function invoiceShow(Request $request)
    {
    
      $filename =public_path().'invoices/'.$request->invoice;
          
      return response()->make(file_get_contents($filename), 200, [
                 'Content-Type' => 'application/pdf',
                 'Content-Disposition' => 'inline; filename="'.$filename.'"'
      ]);
    }

    public function warehouse(CustomerOrder $customerOrder)
    {
      
      $customerOrder->status = 1;
      $customerOrder->update();
      return redirect()->route('orders.index')
           ->with('success','Successfully sended to warehouse!');
    }
}
