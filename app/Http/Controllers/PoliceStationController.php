<?php

namespace App\Http\Controllers;

use App\Models\policeStation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;



class PoliceStationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getAllStation =  policeStation::get();
        return view('pages.policeStation.policeStation', compact('getAllStation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('pages.policeStation.addStation');
    }                                                                          

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     function store(Request $request)
    {

        

        $validatedData = $request->validate([
            'policeStationName' => 'required|unique:police_stations',
            'email' => 'required|unique:police_stations',
            'district' => 'required',
            'address' => 'required | max:250',
        ]);
        

        $stationCode = (rand(10,1000));
        $policeStationName =  $request->input('policeStationName');
        $email =  $request->input('email');
        $district =  $request->input('district');
        $address =  $request->input('address');

            $dataInsert =  policeStation::insert([
                'policeStationName'=>$policeStationName,
                'email'=> $email,
                'stationCode'=> $stationCode,
                'district' => $district,
                'address' => $address
                  ]);
            
            if ($dataInsert) {
                return back()->with('added_recorded', 'Police Station Added Successfully');
            }else{
                return back()->with('error_recorded', 'Police Station Added Faild');
            }
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Moldes\policeStation  $policeStation
     * @return \Illuminate\Http\Response
     */
     function show(policeStation $policeStation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Moldes\policeStation  $policeStation
     * @return \Illuminate\Http\Response
     */
     function edit(policeStation $policeStation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Moldes\policeStation  $policeStation
     * @return \Illuminate\Http\Response
     */
     function update(Request $request, policeStation $policeStation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Moldes\policeStation  $policeStation
     * @return \Illuminate\Http\Response
     */
     function destroy(policeStation $policeStation)
    {
        //
    }
}
