<?php

namespace App\Http\Controllers\Api\Vendor;

use JWTAuth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function register(Request $request)
    {
    	//Validate data
        $data = $request->only('mobile', 'businessName', 'personFName','personLName','email');
        $validator = Validator::make($data, [
            'mobile' => 'required',
            'businessName' => 'required',
            'personFName' => 'required',
            'personLName' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, create new user
        $vendor =User::create([
        	'businessName' => $request->businessName,
        	'personFName' => $request->personFName,
        	'personLName' => $request->personLName,
            'mobile'=>$request->mobile,
            'email'=>$request->email,
            'password'=>'-',
        ]);
        $vendor->assignRole('Vendor');
        //vendor created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Vendor created successfully',
            'data' => $vendor
        ], Response::HTTP_OK);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('mobile');

        //valid credential
        $validator = Validator::make($credentials, [
            'mobile' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is validated
        //Crean token
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                	'success' => false,
                	'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {
    	return $credentials;
            return response()->json([
                	'success' => false,
                	'message' => 'Could not create token.',
                ], 500);
        }
 	
 		//Token created, return with success response and jwt token
        return response()->json([
            'success' => true,
            'message'=>'login Successfully',
            'token' => $token,
        ]);
    }
}
