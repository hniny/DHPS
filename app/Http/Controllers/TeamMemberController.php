<?php

namespace App\Http\Controllers;

use App\TeamMember;
use App\Department;
use App\Position;
use App\User;
use App\City;
use App\TownShip;
use App\Zone;
use App\EmergencyContact;
use DB;
use Image;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Exports\TeamWeeklyExport;
use App\Exports\TeamMonthlyExport;
use App\Exports\TeamYearlyExport;
use Maatwebsite\Excel\Facades\Excel;
class TeamMemberController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:teamMember-list|teamMember-create|teamMember-edit|teamMember-delete', ['only' => ['index','show']]);
         $this->middleware('permission:teamMember-create', ['only' => ['create','store']]);
         $this->middleware('permission:teamMember-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:teamMember-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $query = TeamMember::with('users');
      $teamMembers = $query;
      $teamMembers = $teamMembers->get();
      
        $departments = Department::all();
        
        if(isset($request->name)){
          $query = $query->whereHas('users', function ($q) use($request)
            {
                $q->where('name', $request->name);
            });
        }
        if (isset($request->department)) {
         
          $dep_id = Department::where('dep_name', $request->department)->first();
          
          $query = $query->where('department_id',$dep_id->id);
          
        }
		$i = (request()->input('page', 1) - 1) * 10;
        $j = $i;
      
        $teamMember = $query->latest()->paginate(10);
        return view('teamMember.index',compact('teamMember','departments','teamMembers'))
            ->with('i', $i)
			->with('j', $j)
            ->withTitle('TeamMember Listing')
            ->withName($request->name)
            ->withDepartment($request->department)
            ->with('trash',false);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
      $departments = Department::pluck('dep_name', 'id');
      $positions = Position::pluck('position_name', 'id');
      $cities = City::pluck('name', 'id');
      return view('teamMember.create', ['departments' => $departments, 'positions' => $positions, 'cities' => $cities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //  dd($request->township);
    $request->validate([
      'name' => 'required',
      'home_number' => 'required',
      'mobile_number' => 'required',
      'residential_address' => 'required',
    'postal_address' => 'requierd',
      'application_id' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
      'employee_info' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
      'department_id' => 'required',
      'position_id' => 'required',
      'date_of_employee' => 'required',
      'emp_id_no' => 'required',
      'applicant_id_one' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
      'employee_info_one' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
    ]);
    //dd($request->all());
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
        // dd($user);
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
        // $path='customer_files';
        $featured_path='';
        $application_id='';
        $employee_info='';
        $applicant_one_file_name='';
        $employee_one_file_name='';
        if( $request->hasFile('application_id'))
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

      if( $request->hasFile('employee_info'))
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
        $member->applicant_id_one = $applicant_one_file_name;
      }

      if( $request->hasFile('employee_info_one'))
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
     
      DB::commit();
      return redirect()->route('teammembers.index')->with('success','TeamMember created successfully');
    } catch (\Throwable $th) {
      // dd($th);
      DB::rollBack();
      return back();
    }
  }

    /**
     * Display the specified resource.
     *
     * @param  \App\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function show(TeamMember $teammember)
    {
      return view('teamMember.show',compact('teammember'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function edit(TeamMember $teammember)
    {
      // dd($teammember);
      $departments = Department::pluck('dep_name', 'id');
      $positions = Position::pluck('position_name', 'id');
      $cities = City::pluck('name', 'id');
      // $townships = TownShip::pluck('name', 'id');
      $zones = Zone::pluck('name','id');
      return view('teamMember.edit', ['teammember' => $teammember, 'departments' => $departments, 'positions' => $positions, 'cities' => $cities, 'zones' => $zones]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeamMember $teammember)
    {
    // dd($request->all());
    DB::beginTransaction();
    try {
      if (isset($teammember->users)) {
        $user = User::find($teammember->users->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if (isset($request->password)) {
          $user->password = bcrypt($request->password);
        }
        $user->save();
        // dd($user);
        $member = TeamMember::find($teammember->id);
      if ($request->home_number) {
        $member->home_number = $request->home_number;
      }
      if ($request->mobile_number) {
        $member->mobile_number = $request->mobile_number;
      }
      if ($request->residential_address) {
        $member->residential_address = $request->residential_address;
      }
      if ($request->zone) {
        $member->postal_address = $request->zone;
      }
      if ($request->department_id) {
        $member->department_id = $request->department_id;
      }
      if ($request->position_id) {
        $member->position_id = $request->position_id;
      }
      if ($request->date_of_employee) {
        $member->date_of_employee = $request->date_of_employee;
      }
      if ($request->emp_id_no) {
        $member->emp_id_no = $request->emp_id_no;
      }
        
        if( $request->hasFile('application_id'))
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

      if( $request->hasFile('employee_info'))
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
        $member->applicant_id_one = $applicant_one_file_name;
      }

      if( $request->hasFile('employee_info_one'))
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
      if (isset($request->contact_persons)) {
        foreach ($request->contact_persons as $key => $person) {
          $contact = new EmergencyContact;
          $contact->name = $person['contact_name'];
          $contact->phone = $person['contact_number'];
          $contact->city = $person['city'];
          $contact->team_member_id = $teammember->id;
          $contact->save();
        }
      }
    }
      DB::commit();
        return redirect()->route('teammembers.index')->with('success','TeamMember updated successfully');
      } catch (\Throwable $th) {
        // dd($th);
        DB::rollBack();
        return back();
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeamMember $teammember)
    {
      // if (isset($teammember->users)) {
      //   User::destroy($teammember->user_id);
      // }
      // dd($teammember);
      EmergencyContact::destroy($teammember->id);
      $teammember->delete();
      return redirect()->route('teammembers.index')
                      ->with('success','TeamMember deleted successfully');
    }

    public function deleteContactPerson(Request $request)
    {
      $contact_person = EmergencyContact::find($request->person_id);
      if($contact_person->delete()){
        return response()->json([
            'success' => 'true'
        ]);
      } else {
        return response()->json([
          'success' => 'false'
        ]);
      }
    }

    public function teamMemberTrash()
    {
        $teamMember = TeamMember::onlyTrashed()->paginate(10);
        return view('teamMember.index',compact('teamMember'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->withTitle('TeamMember Listing')
            ->with('trash',true);
    }

    public function teamMemberRestore($id)
    {
        TeamMember::where('id', $id)
                ->restore();
        
        return redirect()->route('teamMember.index')
                         ->with('success','TeamMember restore successfully');
    }

    public function downloadlist($id){
      $member = TeamMember::find($id);
      //dd($member);
    }
  // ************************report for member****************************
  public function teamWeekly(Request $request) 
  {
      $member_name = $request->member_name;
      // dd($member_name);
      return Excel::download(new teamWeeklyExport, $member_name.' WeeklyReport.xlsx');
  }
  public function teamMonthly(Request $request) 
  {
    $member_name = $request->member_name;
      return Excel::download(new teamMonthlyExport, $member_name.' TeamMonthlyReport.xlsx');
  }
  public function teamYearly(Request $request) 
  {
    $member_name = $request->member_name;
    // dd($request->all());
      return Excel::download(new teamYearlyExport, $member_name.' TeamYearlyReport.xlsx');
  }
}
