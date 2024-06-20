<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Customer;
use App\Position;
use App\City;
use App\TownShip;
use App\CustomerType;
use App\OutletType;
use App\Zone;
use DB;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;

class CustomerLoginController extends Controller
{
  public function register()
  {
    Auth::logout();
    $payment_methods = config('paymentmethods.paymentmethods');
    $payment_terms = config('paymentmethods.paymentterms');
    // $positions = Position::pluck('position_name', 'id');
    $cities = City::pluck('name', 'id');
    $customerTypes = CustomerType::pluck('name', 'id');
    $outletTypes = OutletType::pluck('name', 'id');
    // dd($customerTypes);
    return view('auth.customer.register',compact('payment_methods','payment_terms'))
    ->withTitle('Customerမှတ်ပုံတင်ခြင်း')
    ->withCities($cities)
    ->withCustomerTypes($customerTypes)
    ->withOutletTypes($outletTypes);
  }

  public function customerRegister(Request $request)
  {
// dd($request->all());
    $request->validate([
      'name' => 'required',
      'position' => 'required',
      // 'email' => 'required',
      'office_number' => 'required',
      'mobile_number' => 'required',
      'componay_name' => 'required',
      'trading_name' => 'required',
      'company_registration_date' => 'required',
      'company_registration_no' => 'required',
      'delivery_address' => 'required',
      'preferred_bank' => 'required',
      'payment_method' => 'required',
      'payment_term' => 'required',
      'applicant_id' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
      'company_ref_id' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
      'applicant_id_one' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
      'company_ref_id_one' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
      'customer_type_id' => 'required',
      'outlet_type_id' => 'required'
    ]);
    // dd($request->all());
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
      $customer->company_registration_date =$request->company_registration_date;
      $customer->company_registration_no =$request->company_registration_no;
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

     
      
      
      $customer->save();
      // commit
      if (isset($customer->id)) {
        $user->user_name = $request->postal_code.''.$customer->id;
        $user->update();
      }

      $role = Role::findOrFail(2);
      $user->assignRole([$role->id]);
      DB::commit();

    } catch (\Exception $e) {
        DB::rollback();
        return back()->withErrors([$e->getMessage()]);
    }   
    return redirect()->route('customer_login')
                    ->with('success','Customer created successfully.');
  }

  public function login()
  {
    Auth::logout();
    return view('auth.customer.login')
           ->withTitle('Customer Log In');
  }

  public function customerLogIn(Request $request)
  {
    // dd($request->all());
    $credentials = $request->only('user_name', 'password');
    if (Auth::attempt($credentials)) {
      // Authentication passed...
      $user_type = Auth::user()->user_type;
      switch ($user_type) {
        case 2:
          return redirect()->route('orders.index');
          break;
        
        default:
          Auth::logout();
          return redirect()->route('customer_login');
          break;
      }
      
    } else {
      return redirect()->route('customer_login');
    }
  }

  public function cityTownship(Request $request)
  {
    // dd($request->all());
    $townships = TownShip::where('city_id', $request->city)->get();
    return response()->json(['townships' => $townships, 'success' => true]);
  }
  public function cityZone(Request $request)
  {
    // dd($request->all());
    $zone = Zone::where('city_id', $request->city)->get();
    return response()->json(['zones' => $zone, 'success' => true]);
    
  }
}
