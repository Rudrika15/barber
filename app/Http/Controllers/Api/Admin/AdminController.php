<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class AdminController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
 

     /**
     * @OA\Post(
     *     path="/api/auth/adminlogin",
     *     summary="Authenticate user",
     *     tags={"Admin"},
     *     @OA\Parameter(
     *         name="userName",
     *         in="query",
     *         description="User's username",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="User's password",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Login successful"),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     */
    public function login(Request $request){

        // check otp code here 
    	$validator = Validator::make($request->all(), [
            'userName' => 'required',
            'password' => 'required'
        ]);
        
        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $credentials = $validator->validated();
        // Check if the user exists based on the mobile number
        $user = Admin::where('userName', $credentials['userName'])
                ->where('password', $credentials['password'])
                ->first();
    
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        // Generate a JWT token without checking the password
        $token = auth()->login($user);
        return $this->createNewToken($token);
    
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
