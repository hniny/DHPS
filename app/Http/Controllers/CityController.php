<?php

namespace App\Http\Controllers;

use App\City;
use App\Zone;
use App\TownShip;
use Illuminate\Http\Request;

class CityController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:city-list|city-create|city-edit|city-delete', ['only' => ['index','show']]);
         $this->middleware('permission:city-create', ['only' => ['create','store']]);
         $this->middleware('permission:city-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:city-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = new City;
        $city_names = $query->pluck('name','id');
        // dd($city);
        if (isset($request->city)) {
            // dd($request->city);
            $query = $query->where('name',$request->city);
        }
        $cities = $query->paginate(10);
        return view('city.index',compact('cities','city_names'))
            ->with('i', (request()->input('page', 1) - 1) * 10)
            ->withTitle('City Listing')
            ->withCity($request->city)
            ->with('trash',false);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('city.create')->withTitle('Add New City');
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
          'name' => 'required',
        ]);
  
        City::create($request->all());
            
        return redirect()->route('cities.index')
                        ->with('success','City created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return view('city.show',compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        return view('city.edit',compact('city'))->withTitle('Edit City');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
         $request->validate([
           //your code
        ]);
        $city->update($request->all());
        return redirect()->route('cities.index')
                        ->with('success','City updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {

        Zone::where('city_id', $city->id)->delete();
        TownShip::where('city_id', $city->id)->delete();
        $city->delete();
  
        return redirect()->route('cities.index')
                        ->with('success','City deleted successfully');
    }

    public function cityTrash()
    {
        $city = City::onlyTrashed()->paginate(10);
        return view('city.index',compact('city'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->withTitle('City Listing')
            ->with('trash',true);
    }

    public function cityRestore($id)
    {
        City::where('id', $id)
                ->restore();
        
        return redirect()->route('city.index')
                         ->with('success','City restore successfully');
    }
}
