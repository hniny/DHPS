<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use App\Department;
use App\Position;
use App\City;
use App\User;
use App\TeamMember;
use App\EmergencyContact;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;;
use DB;
use Illuminate\Http\Request;
use Image;

class TeamMemberLoginController extends Controller
{
  public function register()
  {
    Auth::logout();
    $departments = Department::pluck('dep_name', 'id');
    $positions = Position::pluck('position_name', 'id');
    $cities = City::pluck('name', 'id');
    return view('auth.teammember.register')
           ->withTitle('Team Member မှတ်ပုံတင်ခြင်း')
           ->withDepartments($departments)
           ->withPositions($positions)
           ->withCities($cities);
  }

  public function teamMemberRegister(Request $request)
  {
    // dd($request->all());
    $request->validate([
      'name' => 'required',
      'home_number' => 'required',
      'mobile_number' => 'required',
      'residential_address' => 'required',
      'application_id' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
      'employee_info' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
      'department_id' => 'required',
      'position_id' => 'required',
      'date_of_employee' => 'required',
      'emp_id_no' => 'required',
      'applicant_id_one' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
      'employee_info_one' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
    ]);
    // dd($request->all());
    DB::beginTransaction();
    try {
      $user = new User;
      $user->name = $request->name;
      $user->user_name = $request->emp_id_no;
      $user->email = $request->email;
      $user->password = bcrypt('internet');
      $user->user_type = config('userTypes.userTypes')['TEAM_MEMBER'];
      $user->save();
      if ($user) {
        $member = new TeamMember;
        $member->home_number = $request->home_number;
        $member->mobile_number = $request->mobile_number;
        $member->residential_address = $request->residential_address;
        $member->postal_address = $request->zone;
        $member->department_id = $request->department_id;
        $member->position_id = $request->position_id;
        $member->user_id = $user->id;
        $member->date_of_employee = $request->date_of_employee;
        $member->emp_id_no = $request->emp_id_no;
       

        if( $request->file('application_id'))
      {
        $originalImage = $request->file('application_id');
        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path(). '/customer_files/';
        // $originalPath = public_path(). $path;
        // $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
        $thumbnailImage->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbnailPath.time().$originalImage->getClientOriginalName()); 

        
        $application_id=time().$originalImage->getClientOriginalName();
        $member->application_id = $application_id;
      }

      if( $request->file('employee_info'))
      {
        $originalImage = $request->file('employee_info');
        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path(). '/customer_files/';
        // $originalPath = public_path(). $path;
        // $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
        $thumbnailImage->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbnailPath.time().$originalImage->getClientOriginalName()); 

        
        $employee_info=time().$originalImage->getClientOriginalName();
       
        $member->employee_info = $employee_info;
      }
        
      if( $request->file('applicant_id_one'))
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
        
        $member->applicant_id_one = $applicant_one_file_name;
      }

      if( $request->file('employee_info_one'))
      {
        $originalImage = $request->file('employee_info_one');
        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path(). '/customer_files/';
        // $originalPath = public_path(). '/customer_files/';
        // $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
        $thumbnailImage->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbnailPath.time().$originalImage->getClientOriginalName()); 

        
        $employee_one_file_name=time().$originalImage->getClientOriginalName();
        $member->employee_info_one = $employee_one_file_name;
      }
        $member->save();
      }
      // if ($member) {
      //   $USERNAME = $request->emp_id_no;
      //   $user->user_name = $USERNAME;
      //   $user->update();
      // }
      if ($member && isset($request->contact_persons)) {
        foreach ($request->contact_persons as $key => $person) {
          $contact = new EmergencyContact;
          $contact->name = $person['contact_name'];
          $contact->phone = $person['contact_number'];
          $contact->city = $person['city'];
          $contact->team_member_id = $member->id;
          $contact->save();
        }
      }
      $role = Role::findOrFail(3);
      $user->assignRole([$role->id]);
      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      return back()->withErrors([$e->getMessage()]);
    }
    return redirect()->route('teamMember_login');
  }

  public function login()
  {
    Auth::logout();
    return view('auth.teammember.login')
           ->withTitle('Team Member Log In');
  }

  public function teamMemberLogIn(Request $request)
  {
    $credentials = $request->only('user_name', 'password');
    if (Auth::attempt($credentials)) {
      // Authentication passed...
      $user_type = Auth::user()->user_type;
      switch ($user_type) {
        case 3:
          return redirect()->route('customers.index');
          break;
        
        default:
        Auth::logout();
        return redirect()->route('teamMember_login');
          break;
      }
    } else {
      return redirect()->route('teamMember_login');
    }
  }
 
}
