<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use App\Models\SecondaryServicesMaster;
use Illuminate\Http\Request;

class SecondaryServicesMasterController extends Controller
{
    //
    function get_secondary_service($id){
        try{
            $secondaryService=SecondaryServicesMaster::where('primaryId','=',$id)->get();
            if($secondaryService){
                return response([
                    'success' => true,
                    'status' => 200,
                    'message' => 'List Of Secondary Service Master Primary Service Wise !',
                    'data' => $secondaryService
                ]);
            }else{
                return response([
                    'success' => false,
                    'status' => 400,
                    'message' => ['No Data Found !'],
                    'data' => $secondaryService
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
