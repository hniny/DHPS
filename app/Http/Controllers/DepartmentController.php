<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:department-list|department-create|department-edit|department-delete', ['only' => ['index','show']]);
         $this->middleware('permission:department-create', ['only' => ['create','store']]);
         $this->middleware('permission:department-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:department-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::latest()->get();
        // dd($departments);
        return view('department.index',compact('departments'))
            ->with('i', (request()->input('page', 1) - 1) * 10)
            ->withTitle('Department Listing')
            ->with('trash',false);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('department.create')->withTitle('Department Create');
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
            //fieldname
        ]);
  
        Department::create($request->all());
            
        return redirect()->route('departments.index')
                        ->with('success','Department created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return view('department.show',compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('department.edit',compact('department'))->withTitle('Department Edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        // dd($request->all());
         $request->validate([
           //your code
        ]);
        $department->update($request->all());
        return redirect()->route('departments.index')
                        ->with('success','Department updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
  
        return redirect()->route('departments.index')
                        ->with('success','Department deleted successfully');
    }

    public function departmentTrash()
    {
        $department = Department::onlyTrashed()->paginate(10);
        return view('departmen.index',compact('department'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->withTitle('Department Listing')
            ->with('trash',true);
    }

    public function departmentRestore($id)
    {
        Department::where('id', $id)
                ->restore();
        
        return redirect()->route('departments.index')
                         ->with('success','Department restore successfully');
    }
}
