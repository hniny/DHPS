<?php

namespace App\Http\Controllers;

use App\Zone;
use App\City;
use App\TownShip;
use Illuminate\Http\Request;

class ZoneController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:zone-list|zone-create|zone-edit|zone-delete', ['only' => ['index','show']]);
         $this->middleware('permission:zone-create', ['only' => ['create','store']]);
         $this->middleware('permission:zone-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:zone-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =Zone::with('city');
        $names = $query;
        $names = $query->pluck('name','id');
        
      $cities = new City;
      $cityNames = $cities->pluck('name','id');
    //   dd($cityNames);
        if (isset($request->name)) {
            $query = $query->where('name',$request->name);
        }
        if (isset($request->city)) {
            // dd($request->city);
            $query = $query->whereHas('city',function($q) use($request){
                $q->where('name',$request->city)   ;
            });
        }
        $zones = $query->paginate(10);
        return view('zone.index',compact('zones'))
            ->with('i', (request()->input('page', 1) - 1) * 10)
            ->withTitle('Zone Listing')
            ->withNames($names)
            ->withCityNames($cityNames)
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
      $cities = City::pluck('name', 'id');
      return view('zone.create')->withTitle('Zone Create')
                                ->withCities($cities);
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
        ]);
  
        $zone = new Zone;
        $zone->name = $request->name;
        $zone->city_id = $request->city_id;
        $zone->save();
            
        return redirect()->route('zones.index')
                        ->with('success','Zone created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function show(Zone $zone)
    {
        return view('zone.show',compact('zone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function edit(Zone $zone)
    {
      $cities = City::pluck('name', 'id');
      return view('zone.edit',compact('zone'))->withTitle('Zone Create')
                                              ->withCities($cities);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zone $zone)
    { 
         $request->validate([
          'name' => 'required',
          'city_id' => 'required',
        ]);
        $zone->name = $request->name;
        $zone->city_id = $request->city_id;
        $zone->update();
        return redirect()->route('zones.index')
                        ->with('success','Zone updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zone $zone)
    {

        TownShip::where('zone_id', $zone->id)->delete();
        $zone->delete();

        return redirect()->route('zones.index')
                        ->with('success','Zone deleted successfully');
    }

    public function zoneTrash()
    {
        $zone = Zone::onlyTrashed()->paginate(10);
        return view('zone.index',compact('zone'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->withTitle('Zone Listing')
            ->with('trash',true);
    }

    public function zoneRestore($id)
    {
        Zone::where('id', $id)
                ->restore();
        
        return redirect()->route('zone.index')
                         ->with('success','Zone restore successfully');
    }
}
