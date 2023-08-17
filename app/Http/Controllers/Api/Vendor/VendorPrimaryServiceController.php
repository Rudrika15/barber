<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use App\Models\VendorPrimaryService;
use Illuminate\Http\Request;

class VendorPrimaryServiceController extends Controller
{
    //
    function get_vendor_primary_service($id){
        try{
            $vendorPrimaryService=VendorPrimaryService::where('vendorId','=',$id)->get();
            if($vendorPrimaryService){
                return response([
                    'success'=>true,
                    'status'=>200,
                    'message'=>'List Of Vendor Primary Services Vendor Wise !',
                    'data'=>$vendorPrimaryService
                ]);
            }else{
                return response([
                    'success'=>false,
                    'status'=>400,
                    'message'=>'No Data Found',
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
