<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use App\Models\VendorSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VendorScheduleController extends Controller
{
    function vendor_create_schedule(Request $request){
        try{
            $rules=array(
                'vendorId'=>'required',
                'day'=>'required',
                'openingTime'=>'required',
                'closingTime'=>'required',
                'dayOff'=>'required',
            );
    
            $validator=Validator::make($request->all(),$rules);
            if($validator->fails()){
                return $validator->errors();
            }
    
            $vednorschedule=new VendorSchedule();
            $vednorschedule->vendorId=$request->vendorId;
            $vednorschedule->day=$request->day;
            $vednorschedule->openingTime=$request->openingTime;
            $vednorschedule->closingTime=$request->closingTime;
            $vednorschedule->dayOff=$request->dayOff;
    
            $vednorschedule->save();
            if($vednorschedule){
                return response([
                    'success'=>true,
                    'status'=>200,
                    'message'=>'Vendor Schedule Created !',
                    'data'=>$vednorschedule
                ]);
            }else{
                return response([
                    'success' => false,
                    'status' => 400,
                    'message' => ['No Data Found !'],
                    'data' => $vednorschedule
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
    function vendor_schudule_list($id){
        try{
            $vednorschedule=VendorSchedule::where('vendorId','=',$id)->get();
            if($vednorschedule){
                return response([
                    'success'=>true,
                    'status'=>200,
                    'message'=>'Vendor Schedule Created !',
                    'data'=>$vednorschedule
                ]);
            }else{
                return response([
                    'success' => false,
                    'status' => 400,
                    'message' => ['No Data Found !'],
                    'data' => $vednorschedule
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
