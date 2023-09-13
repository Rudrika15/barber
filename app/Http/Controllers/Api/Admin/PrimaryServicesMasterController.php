<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrimaryServicesMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrimaryServicesMasterController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/auth/store_primary_service",
     *     summary="Authenticate user and generate JWT token",
     *     tags={"Primary Services"},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Primary service name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
    *         required=true,
    *         @OA\MediaType(
    *             mediaType="multipart/form-data",
    *             @OA\Schema(
    *                 @OA\Property(
    *                     property="urlIcon",
    *                     description="Image file",
    *                     type="file",
    *                 ),
    *             ),
    *         ),
    *     ),
     *     @OA\Parameter(
     *         name="business_key",
     *         in="query",
     *         description="Primary service business_key",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Primary Service Created"),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     */
    public function store_primary_service(Request $request){
        try{
            $rules = array(
                'name' => 'required',
                'urlIcon' => 'required',
                'business_key' => 'required',
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $validator->errors();
            }
    
            $primaryService=new PrimaryServicesMaster();
            $primaryService->name=$request->name;
            $primaryService->urlIcon=$request->urlIcon;
            if ($request->urlIcon) {
                $primaryService->urlIcon = time() . '.' . $request->urlIcon->extension();
                $request->urlIcon->move(public_path('primaryIcon'),  $primaryService->urlIcon);
            }   
            $primaryService->business_key=$request->business_key;
            $primaryService->save();
    
            if ($primaryService) {
                return response([
                    'success' => true,
                    'status' => 200,
                    'message' => 'Primary Service Created !',
                    'data' => $primaryService,
                ]);
            } else {
                return response([
                    'message' => 'Primary Service Data No Found',
                    'data' => $primaryService,
                ], 404);
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

    /**
     * @OA\Post(
     *     path="/api/auth/update_primary_service/{id}",
     *     summary="Authenticate user and generate JWT token",
     *     tags={"Primary Services"},
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Primary service id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Primary service name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
    *         @OA\MediaType(
    *             mediaType="multipart/form-data",
    *             @OA\Schema(
    *                 @OA\Property(
    *                     property="urlIcon",
    *                     description="Image file",
    *                     type="file",
    *                 ),
    *             ),
    *         ),
    *     ),
     *     @OA\Parameter(
     *         name="business_key",
     *         in="query",
     *         description="Primary service business_key",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Primary Service Updated"),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     */
    public function update_primary_service(Request $request,$id){
        try{
            $rules = array(
                'name' => 'required',
                'business_key' => 'required',
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $validator->errors();
            }
            $id=$request->id;
            $primaryService=PrimaryServicesMaster::find($id);
            $primaryService->name=$request->name;
            if ($request->urlIcon) {
                $primaryService->urlIcon = time() . '.' . $request->urlIcon->extension();
                $request->urlIcon->move(public_path('primaryIcon'),  $primaryService->urlIcon);
            }   
            $primaryService->business_key=$request->business_key;
            $primaryService->save();

            if ($primaryService) {
                return response([
                    'success' => true,
                    'status' => 200,
                    'message' => 'Primary Service Updated !',
                    'data' => $primaryService,
                ]);
            } else {
                return response([
                    'message' => 'Primary Service Data No Found',
                    'data' => $primaryService,
                ], 404);
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

    /**
     * @OA\Get(
     *     path="/api/auth/get_primary_service",
     *     summary="Authenticate user and generate JWT token",
     *     tags={"Primary Services"},
     *     @OA\Response(response="200", description="Primary Service List"),
     *     @OA\Response(response="401", description="Invalid Data")
     * )
     */
    function get_primary_service(){
        try{
            $primaryService=PrimaryServicesMaster::all();
            if($primaryService){
                return response([
                    'success' => true,
                    'status' => 200,
                    'message' => 'List Of Primary Service Master !',
                    'data' => $primaryService
                ]);
            }else{
                return response([
                    'success' => false,
                    'status' => 400,
                    'message' => ['No Data Found !'],
                    'data' => $primaryService
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


    /**
     * @OA\Get(
     *     path="/api/auth/delete_primary_service/{id}",
     *     summary="Authenticate user and generate JWT token",
     *     tags={"Primary Services"},
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Primary service id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),    
     *     @OA\Response(response="200", description="Primary Service"),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     */
    public function delete_primary_service($id){
        $primaryService = PrimaryServicesMaster::find($id);
        $primaryService->status = "Deleted";
       
        if (!$primaryService) {
            return response([
                'success' => false,
                'status' => 404, // Use 404 Not Found status code for resource not found
                'message' => 'Primary Service not found!',
                'data' => ['id' => $id]
            ]);
        }
    
        $primaryService->is_deleted = "Yes";
        $primaryService->save();
        if($primaryService){
            return response([
                'success' => true,
                'status' => 200,
                'message' => 'Primary Service Deleted !',
                'data' => $primaryService
            ]);
        }else{
            return response([
                'success' => false,
                'status' => 400,
                'message' => ['No Data Found !'],
                'data' => $primaryService
            ]);
        }
    }
}
