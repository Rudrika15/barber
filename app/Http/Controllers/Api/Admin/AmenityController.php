<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Amenity;
use Illuminate\Support\Facades\Validator;

class AmenityController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/auth/get_amenities/{sortOrder}",
     *     summary="Amenities list",
     *     tags={"Amenities"},
     *     @OA\Parameter(
     *         name="sortOrder",
     *         in="query",
     *         description="Amenities id",
     *     ),
     *     @OA\Response(response="200", description="Amenities List"),
     *     @OA\Response(response="401", description="Invalid Data")
     * )
     */
    function get_amenities(Request $request){
        try{
           $amenity=Amenity::query();
            if ($request->sortOrder) {
                $getOrder =  $request->sortOrder;
                if ($getOrder == "A" || $getOrder=="a")
                    $amenity->orderBy('name', 'asc'); 
                else if ($getOrder == "Z" || $getOrder=="z")
                    $amenity->orderBy('name', 'desc'); 
                else
                    $amenity->orderBy('name', 'asc'); 
            } else {
                $amenity->orderBy('name', 'desc'); 
            }
            $perPage = $request->input('perPage', 2); 
            $amenity = $amenity->paginate($perPage); 
            if($amenity){
                return response([
                    'success' => true,
                    'status' => 200,
                    'message' => 'List Of Amenities !',
                    'data' => $amenity
                ]);
            }else{
                return response([
                    'success' => false,
                    'status' => 400,
                    'message' => ['No Data Found !'],
                    'data' => $amenity
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
     * @OA\Post(
     *     path="/api/auth/store_amenities",
     *     summary="Store Amenities",
     *     tags={"Amenities"},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Amenities name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="url",
     *         in="query",
     *         description="Amenities URL",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="business_key",
     *         in="query",
     *         description="Amenities business_key",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Amenities Created"),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     */
    public function store_amenities(Request $request){
        try{
            $rules = array(
                'name' => 'required',
                'url' => 'required',
                'business_key' => 'required',
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $validator->errors();
            }
    
            $amenities=new Amenity();
            $amenities->name=$request->name;
            $amenities->url=$request->url;  
            $amenities->business_key=$request->business_key;
            $amenities->save();
    
            if ($amenities) {
                return response([
                    'success' => true,
                    'status' => 200,
                    'message' => 'Primary Service Created !',
                    'data' => $amenities,
                ]);
            } else {
                return response([
                    'message' => 'Primary Service Data No Found',
                    'data' => $amenities,
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
     *     path="/api/auth/update_amenities/{id}",
     *     summary="Update Amenities",
     *     tags={"Amenities"},
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Amenities id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Amenities name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     * *     @OA\Parameter(
     *         name="url",
     *         in="query",
     *         description="Amenities url",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="business_key",
     *         in="query",
     *         description="Amenities business_key",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Amenities Updated"),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     */
    public function update_amenities(Request $request,$id){
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
            $amenities=Amenity::find($id);
            $amenities->name=$request->name; 
            $amenities->url=$request->url; 
            $amenities->business_key=$request->business_key;
            $amenities->status="Active";
            $amenities->is_deleted="No";
            $amenities->save();

            if ($amenities) {
                return response([
                    'success' => true,
                    'status' => 200,
                    'message' => 'Primary Service Updated !',
                    'data' => $amenities,
                ]);
            } else {
                return response([
                    'message' => 'Primary Service Data No Found',
                    'data' => $amenities,
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
     *     path="/api/auth/delete_amenities/{id}",
     *     summary="Delete Amenities",
     *     tags={"Amenities"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Amenities id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),    
     *     @OA\Response(response="200", description="Primary Service"),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     */
    public function delete_amenities($id){
        try{
            $amenities = Amenity::find($id);
            $amenities->status = "Deleted";
            $amenities->is_deleted = "Yes";
            $amenities->save();
            if($amenities){
                return response([
                    'success' => true,
                    'status' => 200,
                    'message' => 'Primary Service Deleted !',
                    'data' => $amenities
                ]);
            }else{
                return response([
                    'success' => false,
                    'status' => 400,
                    'message' => ['No Data Found !'],
                    'data' => $amenities
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
