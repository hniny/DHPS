<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:position-list|position-create|position-edit|position-delete', ['only' => ['index','show']]);
         $this->middleware('permission:position-create', ['only' => ['create','store']]);
         $this->middleware('permission:position-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:position-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::latest()->paginate(10);
        return view('position.index',compact('positions'))
            ->with('i', (request()->input('page', 1) - 1) * 10)
            ->withTitle('Position Listing')
            ->with('trash',false);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('position.create');
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
  
        Position::create($request->all());
            
        return redirect()->route('position.index')
                        ->with('success','Position created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        return view('position.show',compact('Position'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        return view('position).edit',compact('position'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
         $request->validate([
           //your code
        ]);
        $position->update($request->all());
        return redirect()->route('position.index')
                        ->with('success','Position updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        $position->delete();
  
        return redirect()->route('position.index')
                        ->with('success','Position deleted successfully');
    }

    public function positionTrash()
    {
        $position = Position::onlyTrashed()->paginate(10);
        return view('position.index',compact('position'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->withTitle('Position Listing')
            ->with('trash',true);
    }

    public function positionRestore($id)
    {
        Position::where('id', $id)
                ->restore();
        
        return redirect()->route('position.index')
                         ->with('success','Position restore successfully');
    }
}
