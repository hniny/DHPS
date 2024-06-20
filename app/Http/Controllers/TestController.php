<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:test-list|test-create|test-edit|test-delete', ['only' => ['index','show']]);
         $this->middleware('permission:test-create', ['only' => ['create','store']]);
         $this->middleware('permission:test-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:test-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $test = Test::latest()->paginate(10);
        return view('test.index',compact('$test'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->withTitle('Test Listing')
            ->with('trash',false);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('test.create');
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
  
        Test::create($request->all());
            
        return redirect()->route('test.index')
                        ->with('success','Test created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        return view('test.show',compact('Test'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        return view('test).edit',compact('test'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
         $request->validate([
           //your code
        ]);
        $test->update($request->all());
        return redirect()->route('test.index')
                        ->with('success','Test updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        $test->delete();
  
        return redirect()->route('test.index')
                        ->with('success','Test deleted successfully');
    }

    public function testTrash()
    {
        $test = Test::onlyTrashed()->paginate(10);
        return view('test.index',compact('test'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->withTitle('Test Listing')
            ->with('trash',true);
    }

    public function testRestore($id)
    {
        Test::where('id', $id)
                ->restore();
        
        return redirect()->route('test.index')
                         ->with('success','Test restore successfully');
    }
}
