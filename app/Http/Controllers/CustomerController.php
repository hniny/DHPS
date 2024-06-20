<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\City;
use App\Position;
use App\TownShip;
use App\TeamMember;
use App\CustomerType;
use App\OutletType;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Exception;
use Image;
use App\Exports\CustomerWeeklyExport;
use App\Exports\CustomerMonthlyExport;
use App\Exports\CustomerYearlyExport;
use Maatwebsite\Excel\Facades\Excel;
class CustomerController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:customer-list|customer-create|customer-edit|customer-delete', ['only' => ['index','show']]);
         $this->middleware('permission:customer-create', ['only' => ['create','store']]);
         $this->middleware('permission:customer-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
    }

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
        // dd($teamMemberID);
        $query = Customer::with('user');
        $team =  TeamMember::with('users');
        $members = $team;
        $teamMembers = $members->get();
        // dd($teamMembers);
        $names = $query;
        $names = $names->get();
        if($userType == config('userTypes.userTypes')['TEAM_MEMBER']) {
            $query->where('team_member_id', $teamMemberID);
            // dd($query->get());
        }
        if ($request->assign == 1) {
            $query->doesntHave('teamMember');
        }
        if ($request->assign == 2) {
            $query->has('teamMember');
        }
        
        if (isset($request->name)) {
            $query = $query->whereHas('user', function ($q) use($request)
            {
                $q->where('name', $request->name);
            });
        }
        if (isset($request->cname)) {
            $query = $query->where('componay_name',$request->cname);
        }
        if(isset($request->team_member)){
            // dd($request->team_member);
            $query = $query->where('team_member_id',$request->team_member);
            // dd($query);
        }

      $i = (request()->input('page', 1) - 1) * 10;
        $j = $i;
        $customers = $query->with('position')->with('teamMember')->latest()->paginate(10);
        return view('customer.index',compact('customers','teamMembers'))
               ->with('i', $i)
			   ->with('j', $j)
               ->withTitle('Customer Listing')
               ->withNames($names)
               ->withName($request->name)
               ->with('trash',false);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payment_methods = config('paymentmethods.paymentmethods');
        // $positions = Position::pluck('position_name', 'id');
        $cities = City::pluck('name', 'id');
        $customerTypes = CustomerType::pluck('name', 'id');
        $outletTypes = OutletType::pluck('name', 'id');
        return view('customer.create',compact('positions','payment_methods'))
               ->withTitle('Add New Retail Customer')
               ->withCities($cities)
               ->withCustomerTypes($customerTypes)
               ->withOutletTypes($outletTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'office_number' => 'required',
            'mobile_number' => 'required',
            'componay_name' => 'required',
            'trading_name' => 'required',
            'company_registration_date' => 'required',
            'company_registration_no' => 'required',
            'delivery_address' => 'required',
            'preferred_bank' => 'required',
            'payment_method' => 'required',
            'applicant_id' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
            'company_ref_id' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
            'applicant_id_one' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
            'company_ref_id_one' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
            'customer_type_id' => 'required',
            'outlet_type_id' => 'required'
        ]);
        // dd($request->all());
        // dd(auth()->user()->teamMember->id);
        DB::beginTransaction();

        try {
            // Save User Data
           $user = new User;
           $user->email = $request->email;
           $user->name = $request->name;
           $user->password = bcrypt(1234);
           $user->user_type = config('userTypes.userTypes')['CUSTOMER'];
           $user->save();
           // End of saving User Data

            // Save Customer Data
            $customer = new Customer;
            $customer->user_id = $user->id;
            $customer->office_number = $request->office_number;
            $customer->mobile_number = $request->mobile_number;
            $customer->position = $request->position;
            $customer->componay_name = $request->componay_name;
            $customer->trading_name = $request->trading_name;
            $customer->office_address = $request->township;
            $customer->delivery_address = $request->delivery_address;
            $customer->company_registration_date = $request->company_registration_date;
            $customer->company_registration_no = $request->company_registration_no;
            $customer->preferred_bank = $request->preferred_bank;
            $customer->payment_method = $request->payment_method;
            $customer->payment_term = $request->payment_term;
            $customer->customer_type_id = $request->customer_type_id;
            $customer->outlet_type_id = $request->outlet_type_id;
            if( $request->hasFile('applicant_id'))
      {
        $originalImage = $request->file('applicant_id');
        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path(). '/customer_files/';
        // $originalPath = public_path(). $path;
        // $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
        $thumbnailImage->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbnailPath.time().$originalImage->getClientOriginalName()); 

        
        $applicant_file_name=time().$originalImage->getClientOriginalName();
        $customer->applicant_id = $applicant_file_name;
      }
      if( $request->hasFile('company_ref_id'))
      {
        $originalImage = $request->file('company_ref_id');
        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path(). '/customer_files/';
        // $originalPath = public_path(). '/customer_files/';
        // $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
        $thumbnailImage->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbnailPath.time().$originalImage->getClientOriginalName()); 

        
        $company_ref_file_name=time().$originalImage->getClientOriginalName();
       
        $customer->company_ref_id = $company_ref_file_name;
      }
      if( $request->hasFile('applicant_id_one'))
      {
        $originalImage = $request->file('applicant_id_one');
        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path(). '/customer_files/';
        // $originalPath = public_path(). '/customer_files/';
        // $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
        $thumbnailImage->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbnailPath.time().$originalImage->getClientOriginalName()); 

        
        $applicant_one_file_name=time().$originalImage->getClientOriginalName();

        $customer->applicant_id_one = $applicant_one_file_name;
      }
      if( $request->hasFile('company_ref_id_one'))
      {
        $originalImage = $request->file('company_ref_id_one');
        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path(). '/customer_files/';
        // $originalPath = public_path(). '/customer_files/';
        // $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
        $thumbnailImage->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbnailPath.time().$originalImage->getClientOriginalName()); 

        
        $company_one_ref_file_name=time().$originalImage->getClientOriginalName();
        $customer->company_ref_id_one = $company_one_ref_file_name;
      }
         
            
            if (auth()->user()->user_type == 3) {
              $customer->team_member_id = auth()->user()->teamMember->id;
            }
            $customer->save();
            if (isset($customer->id)) {
              $user->user_name = $request->postal_code.''.$customer->id;
              $user->update();
            }
            $role = Role::findOrFail(2);
            $user->assignRole([$role->id]);
            // commit
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors([$e->getMessage()]);
        }   
        return redirect()->route('customers.index')
                        ->with('success','Customer created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        // $customer = new Customer;
        // $users = $customer->where('user_id','id')->get();
        // dd($users);
        return view('customer.show',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        // dd($customer);
        $payment_methods = config('paymentmethods.paymentmethods');
        $payment_terms = config('paymentmethods.paymentterms');
        $positions = Position::pluck('position_name', 'id');
        $cities = City::pluck('name', 'id');
        $townships = TownShip::pluck('name', 'id');
        $customerTypes = CustomerType::pluck('name', 'id');
        $outletTypes = OutletType::pluck('name', 'id');
        return view('customer.edit',compact('customer','positions','payment_methods'))
        ->withTitle('Edit Retail Customer')
        ->withCities($cities)
        ->withCustomerTypes($customerTypes)
        ->withOutletTypes($outletTypes  )
        ->withTownships($townships);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {   
        DB::beginTransaction();

        try {
            // Update User Data
           $user = User::find($customer->user_id);
           $user->email = $request->email;
           $user->name = $request->name;
           $user->password = bcrypt($request->password);
           $user->update();
           // End of updating User Data
            // Save Customer Data
            $customer->user_id = $user->id;
            if ($request->office_number) {
                $customer->office_number = $request->office_number;
            }
            if ($request->mobile_number) {
                $customer->mobile_number = $request->mobile_number;
            }
            if ($request->position) {
                $customer->position = $request->position;
            }
            if ($request->componay_name) {
                $customer->componay_name = $request->componay_name;
            }
            if ($request->trading_name) {
                $customer->trading_name = $request->trading_name;
            }
            if ($request->office_address) {
                $customer->office_address = $request->office_address;
            } 
            if ($request->delivery_address) {
                $customer->delivery_address = $request->delivery_address;
            } 
            if ($request->company_registration_date) {
                $customer->company_registration_date = $request->company_registration_date;
            }
            if ($request->company_registration_no) {
                $customer->company_registration_no = $request->company_registration_no;
            }
            if ($request->preferred_bank) {
                $customer->preferred_bank = $request->preferred_bank;
            }
            if ($request->payment_method) {
                $customer->payment_method = $request->payment_method;
            }
            if ($request->payment_term) {
                $customer->payment_term = $request->payment_term;
            }
            if ($request->customer_type_id) {
                $customer->customer_type_id = $request->customer_type_id;
            }
            if ($request->outlet_type_id) {
                $customer->outlet_type_id = $request->outlet_type_id;
            }
            
            if( $request->hasFile('applicant_id'))
      {
        $originalImage = $request->file('applicant_id');
        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path(). '/customer_files/';
        // $originalPath = public_path(). $path;
        // $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
        $thumbnailImage->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbnailPath.time().$originalImage->getClientOriginalName()); 

        
        $applicant_file_name=time().$originalImage->getClientOriginalName();
        $customer->applicant_id = $applicant_file_name;
      }
      if( $request->hasFile('company_ref_id'))
      {
        $originalImage = $request->file('company_ref_id');
        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path(). '/customer_files/';
        // $originalPath = public_path(). '/customer_files/';
        // $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
        $thumbnailImage->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbnailPath.time().$originalImage->getClientOriginalName()); 

        
        $company_ref_file_name=time().$originalImage->getClientOriginalName();
            $customer->company_ref_id = $company_ref_file_name;
      }
      if( $request->hasFile('applicant_id_one'))
      {
        $originalImage = $request->file('applicant_id_one');
        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path(). '/customer_files/';
        // $originalPath = public_path(). '/customer_files/';
        // $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
        $thumbnailImage->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbnailPath.time().$originalImage->getClientOriginalName()); 

        
        $applicant_one_file_name=time().$originalImage->getClientOriginalName();
            $customer->applicant_id_one = $applicant_one_file_name;
      }
      if( $request->hasFile('company_ref_id_one'))
      {
        $originalImage = $request->file('company_ref_id_one');
        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path(). '/customer_files/';
        // $originalPath = public_path(). '/customer_files/';
        // $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
        $thumbnailImage->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbnailPath.time().$originalImage->getClientOriginalName()); 

        
        $company_one_ref_file_name=time().$originalImage->getClientOriginalName();
        $customer->company_ref_id_one = $company_one_ref_file_name;
      }
            
            
            $customer->update();
            // commit
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors([$e->getMessage()]);
        } 
        return redirect()->route('customers.index')
                        ->with('success','Customer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        DB::beginTransaction();
        try {
            // Delete User Data
            $customer->user->delete();
            // Delete User Data
            $customer->delete();
            // commit
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors([$e->getMessage()]);
        } 
  
        return redirect()->route('customers.index')
                        ->with('success','Customer deleted successfully');
    }

    public function customerTrash()
    {
        $customer = Customer::onlyTrashed()->paginate(10);
        return view('customer.index',compact('customer'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->withTitle('Customer Listing')
            ->with('trash',true);
    }

    public function customerRestore($id)
    {
        Customer::where('id', $id)
                ->restore();
        
        return redirect()->route('customer.index')
                         ->with('success','Customer restore successfully');
    }
    public function assignCustomerToTeamMember(Request $request)
    {
        DB::beginTransaction();
        try {
            $customer = Customer::find($request->customer_id);
            $customer->team_member_id = $request->team_member_id;
            $customer->update();
            // commit
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors([$e->getMessage()]);
        } 
        return redirect()->route('customers.index')
        ->with('success','Team Member assigned successfully');
    }
    public function customerStore(Customer $customer){
        // dd($customer);
       
        $user = User::find($customer->user_id);
    //    dd($user);
           $user->status = 1;
           $user->update();
           return redirect()->route('customers.index')
           ->with('success','Customer Login Approved!');
    }

    // ************************report for customer****************************
    public function customerWeekly(Request $request) 
    {
        $customer_name = $request->customer_name;
        return Excel::download(new CustomerWeeklyExport, $customer_name.' WeeklyReport.xlsx');
    }
    public function customerMonthly(Request $request) 
    {
        $customer_name = $request->customer_name;
        // dd($customer_name);
        return Excel::download(new CustomerMonthlyExport, $customer_name.' MonthlyReport.xlsx');
    }
    public function customerYearly(Request $request) 
    {
        // dd($request->all());
        $customer_name = $request->customer_name;
        return Excel::download(new CustomerYearlyExport, $customer_name.' YearlyReport.xlsx');
    }
    public function paymentTerm(Request $request)
    {
        $authUser = auth()->user();
        $userType = isset($authUser) ? $authUser->user_type : 0;
        // $teamMemberID = isset($authUser->teamMember) ? $authUser->teamMember->id : 0;
        $query = Customer::with('user');
        $team =  TeamMember::with('users');
        $members = $team;
        $teamMembers = $members->get();
       $customer = new Customer;
       $cashes = $customer->where('payment_term',1);
       $credits = $customer->where('payment_term',3);
       $consignments = $customer->where('payment_term',2);
        // dd($teamMembers);
        $names = $query;
        $names = $names->get();
        if($userType == config('userTypes.userTypes')['TEAM_MEMBER']) {
            $query->where('team_member_id', $teamMemberID);
        }
    
        if (isset($request->cname)) {
            $query = $query->where('componay_name',$request->cname);
            $cashes = $cashes->where('componay_name',$request->cname);  
            $credits = $credits->where('componay_name',$request->cname);  
            $consignments = $consignments->where('componay_name',$request->cname);  
        }
        if(isset($request->team_member)){
            // dd($request->team_member);
            $query = $query->where('team_member_id',$request->team_member);
            $cashes = $cashes->where('team_member_id',$request->team_member);
            $credits = $credits->where('team_member_id',$request->team_member);
            $consignments = $consignments->where('team_member_id',$request->team_member);
            // dd($query);
        }
        // dd($cashes);
        $cashes = $cashes->with('position')->latest()->paginate(10);
        $credits = $credits->with('position')->latest()->paginate(10);
        $consignments = $consignments->with('position')->latest()->paginate(10);
       
		$i = (request()->input('page', 1) - 1) * 10;
		$j = $i;
		$x = $i;
        return view('customer.paymentTerm',compact('cashes','consignments','credits','teamMembers'))
               ->with('i', $i)
			->with('j', $j)
			->with('x', $x)
               ->withTitle('Customer Listing')
              
               ->with('trash',false);
    }
}
