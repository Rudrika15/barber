<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use App\Models\PrimaryServicesMaster;
use Illuminate\Http\Request;

class PrimaryServicesMasterController extends Controller
{
    //
    function get_primary_service(){
        try{
            $primaryService=PrimaryServicesMaster::all();
            if($primaryService){
                return response([
                    'success' => true,
                    'status' => 200,
                    'message' => 'List Of Primary Service Master !',
                    'data' => $primaryService
                ]);
            }else{
                return response([
                    'success' => false,
                    'status' => 400,
                    'message' => ['No Data Found !'],
                    'data' => $primaryService
                ]);
            }
        }catch(\Exception $e){
            return response([
                'success'=>false,
                'message'=>'An error occurred while processing your request.',
                'status'=>500,
                'error'=>$e->getMessage()
            ]);
        }
    }
}
