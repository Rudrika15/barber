<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use App\Models\PrimaryServicesMaster;
use App\Models\SecondaryServicesMaster;
use Illuminate\Http\Request;

class SecondaryServicesMasterController extends Controller
{
    function get_secondary_service() {
        try {
            $primaryServices = PrimaryServicesMaster::with('secondary_service')->get();
            if($primaryServices){
                return response([
                    'success' => true,
                    'status' => 200,
                    'message' => 'List Of Secondary Service Data Primary Service Wise !',
                    'data' => $primaryServices
                ]);
            }else{
                return response([
                    'success' => false,
                    'status' => 400,
                    'message' => 'No Data Found',
                    'data' => $primaryServices
                ]); 
            }
        } catch (\Exception $e) {
            return response([
                'success' => false,
                'message' => 'An error occurred while processing your request.',
                'status' => 500,
                'error' => $e->getMessage()
            ]);
        }
    }
}
