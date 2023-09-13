<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
/**
     * @OA\Post(
     *     path="/api/home",
     *     summary="Home Page",
     *     tags={"Demo"},
     *     @OA\Parameter(
     *         name="personFName",
     *         in="query",
     *         description="Provied Your Name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Login successful"),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     */
class HomeController extends Controller
{
    public function index(Request $request){

        return response()->json([
            'personFName'=>$request->input('personFName'),
            'message'=>"Sucessfully!"
        ]);
    }
    public function View(Request $request){

        return response()->json([
            'personFName'=>'Manisha',
            'message'=>"Sucessfully!"
        ]);
    }
    
}
