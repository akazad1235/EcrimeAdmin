<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\policeStation;
use DB;

class ComplainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // return session()->get('stationId');
        
       $allComplain = DB::table('complains')
                        ->join('user_registrations', 'complains.reg_id', '=' , 'user_registrations.id')
                        ->join('police_stations', 'complains.station_id', '=', 'police_stations.id')
                        ->select('complains.*', 'user_registrations.name', 'police_stations.policeStationName')
                        ->get();

    $comById = DB::table('complains')

                        ->join('user_registrations', 'complains.reg_id', '=' , 'user_registrations.id')
                        ->join('police_stations', 'complains.station_id', '=', 'police_stations.id')
                        // ->where('station_id',session()->get('stationId'))
                        ->where('station_id',session()->get('stationId'))
                        ->select('complains.*', 'user_registrations.name', 'police_stations.policeStationName')
                        ->get();
                         return view ('pages.complain.manageComplain', compact('allComplain', 'comById'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



}
