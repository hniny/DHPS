<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerOrder;
use App\Product;
use App\OrderRequest;
use App\MemberCustomerOrder;
use App\TeamMember;
use DB;
use Auth;
use Mail;
use App\Mail\CustomerOrder as CustomerOrderMail;
use Illuminate\Http\Request;
use App\Traits\Invoice;

class TeamMemberOrderController extends Controller
{
  Use Invoice;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $authUser = auth()->user();
      $userType = isset($authUser) ? $authUser->user_type : 0;
      $teamMemberID = isset($authUser->teamMember) ? $authUser->teamMember->id : 0;
      $query = Customer::query();
      if($userType == config('userTypes.userTypes')['TEAM_MEMBER']) {
        $query->where('team_member_id', $teamMemberID);
      }
      $customers = $query->get();

      $customerOrders = new CustomerOrder;

      $q = $customerOrders;

      $invoices = $q->whereHas('customer', function ($query) use($customers)
      {
        $query->whereIn('customer_id', $customers);
      })->pluck('invoice_no', 'id');

      if (isset($request->invoice)) {
        $customerOrders = $customerOrders->where('invoice_no', $request->invoice);
      }
      if (isset($request->date)) {
        $customerOrders = $customerOrders->whereDate('created_at', $request->date);
      }

      $orders = $customerOrders->whereHas('customer', function ($query) use($customers)
      {
        $query->whereIn('customer_id', $customers);
      })->withCount('orderRequest')->latest()->paginate(10);
      
      return view('teamMemberorder.index',compact('orders'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
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
      // dd('zz');
      $authUser = auth()->user();
      $teamMemberID = $authUser->getTeamMemberID();
      $isTeamMember = $authUser->isTeamMember();
      $customers = [];
      $products = Product::select('id', 'name', 'detail','image')->get();
      $invoice = $this->getNextOrderInv();
      if($isTeamMember) {
        $customers = Customer::where('team_member_id', $teamMemberID)->get();
      }
      $user = Auth::user()->id;
      $teammember = TeamMember::where('user_id',$user)->pluck('residential_address');
      // dd($teammember);

      return view('teamMemberorder.create', compact('isTeamMember','customers','teammember'))
            ->withTitle('Add New Order')
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
      $TO_MAIL = env('MAIL_TO_ADDRESS', 'developer@hostmyanmar.net');
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
      return redirect()->route('teammember_orders.index')
                       ->with('success','CustomerOrder created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
