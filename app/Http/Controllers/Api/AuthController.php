<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){

        // check otp code here 
    	$validator = Validator::make($request->all(), [
            'mobile' => 'required'
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $credentials = $validator->validated();
        // Check if the user exists based on the mobile number
        $user = User::where('mobile', $credentials['mobile'])->first();
    
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        // Generate a JWT token without checking the password
        $token = auth()->login($user);
        return $this->createNewToken($token);
    
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    
     public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            'businessName' => 'required',
            'personFName' => 'required',
            'personLName' => 'required',
            
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        
        $user =User::create([
            'businessName' => $request->businessName,
            'personFName' => $request->personFName,
            'personLName' => $request->personLName,
            'mobile'=>$request->mobile,
            'email'=>'aaa@gmail.com',
            'password'=>'-',
        ]);
       if($user){
    
        $token = auth()->login($user);
        return $this->createNewToken($token);
    
       }else{   
            return response()->json([
            'message' => 'User register fail',
            'user' => $user,
        ], 201);
        }
    }
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
     /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserProfile()
    {
        return response()->json(auth()->user());
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){   
         return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
                'user' => auth()->user()
            ]);
        
    }

     /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }
}
