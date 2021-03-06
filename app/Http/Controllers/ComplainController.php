<?php

namespace App\Http\Controllers;

use App\Models\Complain;
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

                            $id = base64_decode($id);
                        //return $id;
                      //  $data = Complain::find($id);
                            //return $data;
                        
                        // return $id;
                            // $GetComplainData = DB::table('complains')
                            // ->join('user_registrations', 'complains.reg_id', '=', 'user_registrations.id')
                            // ->join('police_stations', 'complains.station_id', '=', 'police_stations.id')
                            // ->select('complains.*', 'user_registrations.*','police_stations.*' )
                            // ->where('complains.id', $id)
                            // ->get();

                            $GetComplainData =  DB::table('complains')
                            ->leftJoin('user_registrations', 'complains.reg_id', '=', 'user_registrations.id')
                            ->leftJoin('police_stations', 'complains.station_id', '=', 'police_stations.id')
                            ->select('complains.*', 'user_registrations.name','user_registrations.email', 'user_registrations.phone', 'user_registrations.nid', 'user_registrations.gender','user_registrations.birth_day','user_registrations.image', 'user_registrations.address','police_stations.policeStationName')
                            ->where('complains.id', $id)
                            ->get();


                          //  $data = Complain::find($id);
                            //return $GetComplainData;
                                            foreach($GetComplainData as $value){
                                                $file = json_decode($value->file);
                                            }
                              return view('pages.complain.detailsComplain', compact('GetComplainData', 'file'));
                        
                        
               

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

    public function details(Request $request){
        $id =  $request->id;
        return Complain::find($id);
    }
     public function updateStatus(Request $request){
        $id =  $request->id;
        return Complain::find($id);
    }


    //Complain Status update
    public function updateId(Request $request){
        $id =  $request->id;
        $getData =  Complain::where('id', $id)->find($id);
        

        // if($getData->save($request->comp_status)){
        //    return 'success';
        // }else{
        //     return 'faild';
        // }
        if($getData){
            $getData->comp_status = $request->comp_status;
            $getData->save();
            return 'success';
        }else{
            return 'faild';
        }
        

       // return $getData;
    }


}
