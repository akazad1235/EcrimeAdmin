<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complain;
use App\Models\Criminal;
use App\Models\userRegistration;
use Image;
use Illuminate\Support\Facades\DB;

class userComplainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
             $adddd =  DB::table('complains')
            ->join('user_registrations', 'complains.reg_id', '=', 'user_registrations.id')
            ->where('reg_id',20)
            ->get();

            return $adddd;

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
       // return $request;
        // return response()->json(['success' => 'complain added success', 'status'=>'200', 'data'=>  $request]);
        
        $regId = $request->input('reg_id');
        $stdId = $request->input('station_id');
        $crimeType = $request->input('crime_type');
        $desc = $request->input('desc');
        $place = $request->input('place');

        $image = $request->file('image');

        $CheckUser = userRegistration::find($regId);

       // return response()->json(['success' => 'complain added success', 'status'=>'200', 'result'=>$CheckUser]);

        if ($CheckUser->acc_active && $CheckUser->nid) {
          if($image){
            $fileName = rand(0, 999999999) . '_' . date('Ymdhis').'_' . rand(100, 999999999) . '.' . $image->getClientOriginalExtension();
        // return $fileName;
          Image::make($image)->resize(400, 400)->save(public_path('admin/images/complain/').$fileName);
       
            $files = [];
            if($request->hasFile('file')){
    
                $sl = 0;
                foreach($request->file('file') as $value)
                {
                    $name = rand(0, 999999999) . '_' . date('Ymdhis').'_' . rand(100, 999999999) . '.' . $value->getClientOriginalExtension();
                   // $files->save(public_path('admin/images/complain/').$name);  
                    //Image::make($value)->resize(400, 400)->save(public_path('admin/images/complain/').$name );
                    $value->move(public_path('admin/images/complain/'), $name);
                    $files[] = $name;
                    $sl++; 
                }
            }
        }
        
        $data = [
            'reg_id' => $regId,
            'station_id' => $stdId,
            'complain_type' => $crimeType,
            'complain_name' => 'test',
            'desc' => $desc,
            'place' => $place,
            'image' =>  $fileName,
             'file' =>  json_encode($files),
        
        ];
       // return $data;
       
      //  }
        // else{
        //     $data = [
        //         'reg_id' => $regId,
        //         'station_id' => $stdId,
        //         'complain_type' => $crimeType,
        //         'desc' => $desc,
        //         'address' => $place,     
        //     ];
        // }
       
       
        if (Complain::create($data) == true) {
            return response()->json(['success' => 'Complain added success', 'status'=>'200', 'result'=>$data]);
        }else{
            return response()->json(['error' => 'Complain Added Faild ', 'status'=>'500']);
        }
        }else{
            return response()->json(['error' => 'Your Account or NID not Active', 'status'=>'500']);
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $complianDataById =  DB::table('complains')->where('reg_id', $id)->get();
            // ->join('user_registrations', 'complains.reg_id', '=', 'user_registrations.id')
            // ->where('reg_id',$id)
            // ->get();

         $details = Complain::find($id);   

      
        

            if($details){
                $file = $details->file;
                $convertFile = json_decode($file);
                return response()->json(['success'=>'Complain Data showed' , 'status'=>'200', 'result'=>$details, 'convertFile'=>$convertFile]);
            }else{
                return response()->json(['success'=>'Complain Data showed' , 'status'=>'200']);
            }

            
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