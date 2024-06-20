<?php

namespace App\Http\Controllers;

use App\ExtraUser;
use Illuminate\Http\Request;

class ExtraUserController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:extraUser-list|extraUser-create|extraUser-edit|extraUser-delete', ['only' => ['index','show']]);
         $this->middleware('permission:extraUser-create', ['only' => ['create','store']]);
         $this->middleware('permission:extraUser-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:extraUser-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $extraUser = ExtraUser::latest()->paginate(10);
        return view('extraUser.index',compact('$extraUser'))
            ->with('i', (request()->input('page', 1) - 1) * 10)
            ->withTitle('ExtraUser Listing')
            ->with('trash',false);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('extraUser.create');
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
  
        ExtraUser::create($request->all());
            
        return redirect()->route('extraUser.index')
                        ->with('success','ExtraUser created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExtraUser  $extraUser
     * @return \Illuminate\Http\Response
     */
    public function show(ExtraUser $extraUser)
    {
        return view('extraUser.show',compact('ExtraUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExtraUser  $extraUser
     * @return \Illuminate\Http\Response
     */
    public function edit(ExtraUser $extraUser)
    {
        return view('extraUser.edit',compact('extraUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExtraUser  $extraUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExtraUser $extraUser)
    {
         $request->validate([
           //your code
        ]);
        $extraUser->update($request->all());
        return redirect()->route('extraUser.index')
                        ->with('success','ExtraUser updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExtraUser  $extraUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExtraUser $extraUser)
    {
        $extraUser->delete();
  
        return redirect()->route('extraUser.index')
                        ->with('success','ExtraUser deleted successfully');
    }

    public function extraUserTrash()
    {
        $extraUser = ExtraUser::onlyTrashed()->paginate(10);
        return view('extraUser.index',compact('extraUser'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->withTitle('ExtraUser Listing')
            ->with('trash',true);
    }

    public function extraUserRestore($id)
    {
        ExtraUser::where('id', $id)
                ->restore();
        
        return redirect()->route('extraUser.index')
                         ->with('success','ExtraUser restore successfully');
    }
}
