<?php

namespace App\Http\Controllers;

use App\Consigment;
use App\Customer;
use App\ExtraUser;
use Auth;
use DB;
use Illuminate\Http\Request;

class ConsigmentController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:consigment-list|consigment-create|consigment-edit|consigment-delete', ['only' => ['index','show']]);
         $this->middleware('permission:consigment-create', ['only' => ['create','store']]);
         $this->middleware('permission:consigment-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:consigment-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consigments = Consigment::latest()->paginate(10);
        return view('consigments.index',compact('consigments'))
            ->with('i', (request()->input('page', 1) - 1) * 10)
            ->withTitle('Consigment Listing')
            ->with('trash',false);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $customers = Customer::get();
      return view('consigments.create', ['customers' => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            //fieldname
        ]);
        // dd($request->all());
        DB::beginTransaction();
        
        try {
          $consigment = new Consigment;
          $consigment->company_name = $request->company;
          $consigment->name = $request->name;
          $consigment->date = $request->date;
          $path='customer_files';
          $signature = '';
          if($request->file('signature'))
          {
            $signature = date('Ymd-Hi_').$request->file('signature')->getClientOriginalName();
            $request->file('signature')
                    ->move($path, $signature);
            $featured_path=$path.$signature;
          }
          $consigment->signature_img = $signature;
          $consigment->user_id = $request->user_id;
          $consigment->save();
          if (isset($request->account_contact)) {
            $account = new ExtraUser;
            $account->company_name = $request->company;
            $account->extra_name = $request->account_contact;
            $account->extra_email = $request->account_email;
            $account->status = 1;
            $account->save(); 
            $consigment->consigmentExtraUser()->attach($account->id);
          }
          if (isset($request->purchasing_contact)) {
            $purchase = new ExtraUser;
            $purchase->company_name = $request->company;
            $purchase->extra_name = $request->purchasing_contact;
            $purchase->extra_email = $request->purchasing_email;
            $purchase->status = 2;
            $purchase->save();
            $consigment->consigmentExtraUser()->attach($purchase->id);
          }
          if (isset($request->officers)) {
            foreach ($request->officers as $key => $name) {
              $officer = new ExtraUser;
              $officer->extra_name = $name['officer_name']; 
              $officer->status = 3;
              $officer->save();
              $consigment->consigmentExtraUser()->attach($officer->id);
            }
          }
          if (isset($request->credit_ref)) {
            foreach ($request->credit_ref as $key => $group) {
              $extrauser = new ExtraUser;
              $extrauser->company_name = $group['credit_ref_company'];
              $extrauser->extra_name = $group['credit_ref_contact'];
              $extrauser->extra_email = $group['credit_ref_email'];
              $extrauser->extra_phone = $group['credit_ref_phone'];
              $extrauser->status = 4;
              $extrauser->save();
              $consigment->consigmentExtraUser()->attach($extrauser->id);
            }
          }
          DB::commit();
          return redirect()->route('consigments.index')
                          ->with('success','Consigment created successfully.');
        } catch (\Throwable $th) {
          DB::rollBack();
          return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Consigment  $consigment
     * @return \Illuminate\Http\Response
     */
    public function show(Consigment $consigment)
    {
        return view('consigments.show',compact('consigment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Consigment  $consigment
     * @return \Illuminate\Http\Response
     */
    public function edit(Consigment $consigment)
    {
        return view('consigment.edit',compact('consigment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Consigment  $consigment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consigment $consigment)
    {
         $request->validate([
           //your code
        ]);
        $consigment->update($request->all());
        return redirect()->route('consigment.index')
                        ->with('success','Consigment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Consigment  $consigment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consigment $consigment)
    {
        $consigment->delete();
  
        return redirect()->route('consigment.index')
                        ->with('success','Consigment deleted successfully');
    }

    public function consigmentTrash()
    {
        $consigment = Consigment::onlyTrashed()->paginate(10);
        return view('consigment.index',compact('consigment'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->withTitle('Consigment Listing')
            ->with('trash',true);
    }

    public function consigmentRestore($id)
    {
        Consigment::where('id', $id)
                ->restore();
        
        return redirect()->route('consigment.index')
                         ->with('success','Consigment restore successfully');
    }

    public function getCustomer(Request $request)
    {
      $customer = Customer::with('user')->find($request->company);
      return response()->json(['success' => true, 'customer' => $customer]);
    }
}
