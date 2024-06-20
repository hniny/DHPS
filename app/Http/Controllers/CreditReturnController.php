<?php

namespace App\Http\Controllers;

use App\CreditReturn;
use Illuminate\Http\Request;

class CreditReturnController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:creditReturn-list|creditReturn-create|creditReturn-edit|creditReturn-delete', ['only' => ['index','show']]);
         $this->middleware('permission:creditReturn-create', ['only' => ['create','store']]);
         $this->middleware('permission:creditReturn-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:creditReturn-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $creditReturns = CreditReturn::latest()->paginate(10);
        return view('creditReturn.index',compact('creditReturns'))
            ->with('i', (request()->input('page', 1) - 1) * 10)
            ->withTitle('CreditReturn Listing')
            ->with('trash',false);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('creditReturn.create')->withTitle('Add New Credit Return');
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
  
        CreditReturn::create($request->all());
            
        return redirect()->route('creditReturn.index')
                        ->with('success','CreditReturn created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CreditReturn  $creditReturn
     * @return \Illuminate\Http\Response
     */
    public function show(CreditReturn $creditReturn)
    {
        return view('creditReturn.show',compact('CreditReturn'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CreditReturn  $creditReturn
     * @return \Illuminate\Http\Response
     */
    public function edit(CreditReturn $creditReturn)
    {
        return view('creditReturn.edit',compact('creditReturn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CreditReturn  $creditReturn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CreditReturn $creditReturn)
    {
         $request->validate([
           //your code
        ]);
        $creditReturn->update($request->all());
        return redirect()->route('creditReturn.index')
                        ->with('success','CreditReturn updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CreditReturn  $creditReturn
     * @return \Illuminate\Http\Response
     */
    public function destroy(CreditReturn $creditReturn)
    {
        $creditReturn->delete();
  
        return redirect()->route('creditReturn.index')
                        ->with('success','CreditReturn deleted successfully');
    }

    public function creditReturnTrash()
    {
        $creditReturn = CreditReturn::onlyTrashed()->paginate(10);
        return view('creditReturn.index',compact('creditReturn'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->withTitle('CreditReturn Listing')
            ->with('trash',true);
    }

    public function creditReturnRestore($id)
    {
        CreditReturn::where('id', $id)
                ->restore();
        
        return redirect()->route('creditReturn.index')
                         ->with('success','CreditReturn restore successfully');
    }
}
