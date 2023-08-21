<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VendorPrimaryService;
use App\Models\VendorSecondaryService;
use Illuminate\Http\Request;

class VendorSecondaryServiceController extends Controller
{
    function vendor_secondary_service($id){
        try{
            
            $vednorSecondaryService=VendorPrimaryService::where('vendorId','=',$id)
            ->with('vendor_secondary_services')
            ->get();

            
            if($vednorSecondaryService){
                return response([
                    'success'=>true,
                    'status'=>200,
                    'message'=>'List Of Vendor Secondary Services Vendor Wise !',
                    'data'=>$vednorSecondaryService
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
