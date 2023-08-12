<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    function vendor_list(){
        $vendor=Vendor::all();
        if($vendor){
            return response([
                'success'=>true,
                'message'=>'Vendor List',
                'data'=>$vendor
            ]);
        }
        else{
            return response([
                'success'=>false,
                'message'=>'Vendor List Not Found !'
            ]);
        }
    }
    function single_vendor($id){
        $vendor=Vendor::find($id);
        return response([
            'success'=>true,
            'message'=>'Single Vendor',
            'data'=>$vendor
        ]);
    }
    function register(Request $request){
        $rules=array(
            'mobile'=>'required',
            'businessName'=>'required',
            'personFName'=>'required',
            'personLName'=>'required',
        );
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $validator->errors();
        }
        $vendor= new Vendor();
        $vendor->mobile=$request->mobile;
        $vendor->businessName=$request->businessName;
        $vendor->personFName=$request->personFName;
        $vendor->personLName=$request->personLName;
        $token = $vendor->createToken('MyApp')->plainTextToken;
        $vendor->save();
        if($vendor){
            return response()->json([
                'success'=>true,
                'message'=>$vendor,
                'token'=>$token
            ]); 
        }
        else{
            return response()->json([
                'success'=>false,
                'message'=>'Vendor Not Created'
            ]);
        }
    }
    function login(Request $request){
        $vendor=Vendor::where('mobile',$request->mobile)->first();
        if($vendor){
            $token = $vendor->createToken('MyApp')->plainTextToken;
            return response([
                'success'=>true,
                'message'=>$vendor,
                'token' => $token
            ]);
        }else{
            return response([
                'success'=>False,
                'message'=>'Mobile Number Not Matched'
            ]); 
        }
    } 
    function vendor_edit_Profile(Request $request,$id){
        $rules=array(
            'mobile'=>'required',
            'email'=>'required',
            'businessName'=>'required',
            'personFName'=>'required',
            'personLName'=>'required',
            'addressLine1'=>'required',
            'addressLine2'=>'required',
            'landMark'=>'required',
            'state'=>'required',
            'city'=>'required',
            'pincode'=>'required',
            'latitude'=>'required',
            'longtitude'=>'required',
            'logo'=>'required',
            'auth_token'=>'required',
            'isEmail_verify'=>'required',
            'isMobile_verify'=>'required',
            'processDone'=>'required',
        );
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $validator->errors();
        }
        $id=$request->id;
        $vendor=Vendor::find($id);
        $vendor->mobile=$request->mobile;
        $vendor->email=$request->email;
        $vendor->businessName=$request->businessName;
        $vendor->personFName=$request->personFName;
        $vendor->personLName=$request->personLName;
        $vendor->addressLine1=$request->addressLine1;
        $vendor->addressLine2=$request->addressLine2;
        $vendor->landMark=$request->landMark;
        $vendor->state=$request->state;
        $vendor->city=$request->city;
        $vendor->pincode=$request->pincode;
        $vendor->latitude=$request->latitude;
        $vendor->longtitude=$request->longtitude;
        $vendor->logo=$request->logo;
        if ($request->logo) {
            $vendor->logo = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('vendor'),  $vendor->logo);
        }
        $token = $vendor->createToken('MyApp')->plainTextToken;
        $vendor->auth_token=$request->auth_token;
        $vendor->isEmail_verify=$request->isEmail_verify;
        $vendor->isMobile_verify=$request->isMobile_verify;
        $vendor->processDone=$request->processDone;
        
        $vendor->save();
        if($vendor){
            return response([
                'success'=>true,
                'message'=>'Vendor Profile Updated Suceessfully !',
                'token'=>$token
            ]);
        }
        else{
            return response([
                'success'=>false,
                'message'=>'Vendor Profile Not Updated !',
            ]); 
        }
    }   
}
