<?php

namespace App\Http\Controllers;

use App\City;
use App\Zone;
use App\TownShip;
use Illuminate\Http\Request;

class TownShipController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:township-list|township-create|township-edit|township-delete', ['only' => ['index','show']]);
         $this->middleware('permission:township-create', ['only' => ['create','store']]);
         $this->middleware('permission:township-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:township-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = new TownShip;
        $cities = new City;
        $cityNames = $cities->pluck('name','id');
        $zones = new Zone;
        $zoneNames = $zones->pluck('name','id');
        if (isset($request->township)) {
            // dd($request->township);
            $query = $query->where('name','like','%'.$request->township.'%');
        }
        if (isset($request->city)) {
            // dd($request->city);
            $query = $query->whereHas('cities',function($q) use($request){
                $q->where('name',$request->city)   ;
            });
        }
        if (isset($request->zone)) {
            // dd($request->zone);
            $query = $query->whereHas('zones',function($q) use($request){
                $q->where('name',$request->zone)   ;
            });
        }
        $townships = $query->latest()->paginate(10);
        return view('township.index',compact('townships','cityNames','zoneNames'))
            ->with('i', (request()->input('page', 1) - 1) * 10)
            ->withTitle('TownShip Listing')
            ->with('trash',false);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::pluck('name', 'id');
        $zones = Zone::pluck('name', 'id');
        return view('township.create')
              ->withTitle('Create New TownShip')
              ->withCities($cities)
              ->withZones($zones);
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
          'name' => 'required',
          'city_id' => 'required',
          'zone_id' => 'required',
          'postal_code' => 'required',
        ]);
  
        TownShip::create($request->all());
            
        return redirect()->route('townships.index')
                        ->with('success','TownShip created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TownShip  $townShip
     * @return \Illuminate\Http\Response
     */
    public function show(TownShip $township)
    {
        return view('township.show',compact('township'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TownShip  $townShip
     * @return \Illuminate\Http\Response
     */
    public function edit(TownShip $township)
    {
      $cities = City::pluck('name', 'id');
      $zones = Zone::pluck('name', 'id');

      return view('township.edit',compact('township'))
             ->withTitle('Edit Township')
             ->withCities($cities)
             ->withZones($zones);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TownShip  $townShip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TownShip $township)
    {
        $request->validate([
          'name' => 'required',
          'city_id' => 'required',
          'zone_id' => 'required',
          'postal_code' => 'required',
        ]);
        $township->update($request->all());
        return redirect()->route('townships.index')
                        ->with('success','TownShip updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TownShip  $townShip
     * @return \Illuminate\Http\Response
     */
    public function destroy(TownShip $township)
    {
        $township->delete();
  
        return redirect()->route('townships.index')
                        ->with('success','TownShip deleted successfully');
    }

    public function townShipTrash()
    {
        $townShip = TownShip::onlyTrashed()->paginate(10);
        return view('townShip.index',compact('townShip'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->withTitle('TownShip Listing')
            ->with('trash',true);
    }

    public function townShipRestore($id)
    {
        TownShip::where('id', $id)
                ->restore();
        
        return redirect()->route('townShip.index')
                         ->with('success','TownShip restore successfully');
    }
}
