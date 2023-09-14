<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrimaryServicesMaster;
use App\Models\SecondaryServicesMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SecondaryServicesMasterController extends Controller
{

     /**
     * @OA\Get(
     *     path="/api/auth/get_secondary_service/{sortOrder}",
     *     summary="Secondary service list",
     *     tags={"Secondary Services"},
     
     *     @OA\Parameter(
     *         name="sortOrder",
     *         in="query",
     *         description="Primary service id",
     *         
     *     ),
     *     @OA\Response(response="200", description="Primary Service List"),
     *     @OA\Response(response="401", description="Invalid Data")
     * )
     */
    function get_secondary_service(Request $request) {
        try {
            $primaryServices = PrimaryServicesMaster::with(['secondary_service' => function ($query) use ($request) {
                if ($request->sortOrder) {
                    $getOrder =  $request->sortOrder;
                    if ($getOrder == "A" || $getOrder == "a") {
                        $query->orderBy('secondaryName', 'asc');
                    } else if ($getOrder == "Z" || $getOrder == "z") {
                        $query->orderBy('secondaryName', 'desc');
                    } else {
                        $query->orderBy('secondaryName', 'asc');
                    }
                } else {
                    $query->orderBy('secondaryName', 'desc');
                }
            }]);
            $perPage = $request->input('perPage', 5); 
            $primaryServices = $primaryServices->paginate($perPage); 
            if($primaryServices){
                return response([
                    'success' => true,
                    'status' => 200,
                    'message' => 'List Of Secondary Service Data Primary Service Wise !',
                    'data' => $primaryServices
                ]);
            }else{
                return response([
                    'success' => false,
                    'status' => 400,
                    'message' => 'No Data Found',
                    'data' => $primaryServices
                ]); 
            }
        } catch (\Exception $e) {
            return response([
                'success' => false,
                'message' => 'An error occurred while processing your request.',
                'status' => 500,
                'error' => $e->getMessage()
            ]);
        }
    }



    /**
     * @OA\Post(
     *     path="/api/auth/store_secondary_service",
     *     summary="Store secondary service",
     *     tags={"Secondary Services"},
     *     @OA\Parameter(
     *         name="primary_service_id",
     *         in="query",
     *         description="Primary service Id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="secondaryName",
     *         in="query",
     *         description="Secondary service name",
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
     *         description="Secondary service business_key",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Seondary Service Created"),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     */
    public function store_secondary_service(Request $request){
        try{

            $rules = array(
                'primary_service_id'=>'required',
                'secondaryName' => 'required',
                'urlIcon' => 'required',
                'business_key' => 'required',
            );
            $validator=Validator::make($request->all(),$rules);
            if($validator->fails()){
                return$validator->errors();
            }
            $secondaryService=new SecondaryServicesMaster();
            $secondaryService->primary_service_id=$request->primary_service_id;
            $secondaryService->secondaryName=$request->secondaryName;
            if ($request->urlIcon) {
                $secondaryService->urlIcon = time() . '.' . $request->urlIcon->extension();
                $request->urlIcon->move(env('SECONDARY_ICON_URL'),  $secondaryService->urlIcon);
            } 
            $secondaryService->business_key=$request->business_key;
            $secondaryService->save();
    
            if($secondaryService){
                return response([
                    'success' => true,
                    'status' => 200,
                    'message' => 'Created Secondary Service !',
                    'data' => $secondaryService
                ]);
            }else{
                return response([
                    'success' => false,
                    'status' => 400,
                    'message' => 'No Data Found',
                    'data' => $secondaryService
                ]); 
            }
        } catch (\Exception $e) {
            return response([
                'success' => false,
                'message' => 'An error occurred while processing your request.',
                'status' => 500,
                'error' => $e->getMessage()
            ]);
        }
        
    }

    /**
     * @OA\Post(
     *     path="/api/auth/update_secondary_service/{id}",
     *     summary="Update secondary service",
     *     tags={"Secondary Services"},
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Secondary service Id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="primary_service_id",
     *         in="query",
     *         description="Primary service Id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="secondaryName",
     *         in="query",
     *         description="Secondary service name",
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
     *         description="Secondary service business_key",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Seondary Service Updated"),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     */
    public function update_secondary_service(Request $request,$id){
        try{

            $rules = array(
                'primary_service_id'=>'required',
                'secondaryName' => 'required',
                'business_key' => 'required',
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $validator->errors();
            }
            $id=$request->id;
            $secondaryService=SecondaryServicesMaster::find($id);
            $secondaryService->primary_service_id=$request->primary_service_id;
            $secondaryService->secondaryName=$request->secondaryName;
            if ($request->urlIcon) {
                $secondaryService->urlIcon = time() . '.' . $request->urlIcon->extension();
                $request->urlIcon->move(env('SECONDARY_ICON_URL'),  $secondaryService->urlIcon);
            } 
            $secondaryService->business_key=$request->business_key;
            $secondaryService->status="Active";
            $secondaryService->is_deleted="No";
            $secondaryService->save();
    
            if($secondaryService){
                return response([
                    'success' => true,
                    'status' => 200,
                    'message' => 'Updated Secondary Service !',
                    'data' => $secondaryService
                ]);
            }else{
                return response([
                    'success' => false,
                    'status' => 400,
                    'message' => 'No Data Found',
                    'data' => $secondaryService
                ]); 
            }
        } catch (\Exception $e) {
            return response([
                'success' => false,
                'message' => 'An error occurred while processing your request.',
                'status' => 500,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/auth/delete_secondary_service/{id}",
     *     summary="Delete secondary service",
     *     tags={"Secondary Services"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Primary service id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),    
     *     @OA\Response(response="200", description="Delete Secondary Service"),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     */
    public function delete_secondary_service($id){
        $secondaryService = SecondaryServicesMaster::find($id);
        $secondaryService->status = "Deleted";
        $secondaryService->is_deleted = "Yes";
        $secondaryService->save();
        if($secondaryService){
            return response([
                'success' => true,
                'status' => 200,
                'message' => 'Secondary Service Deleted !',
                'data' => $secondaryService
            ]);
        }else{
            return response([
                'success' => false,
                'status' => 400,
                'message' => ['No Data Found !'],
                'data' => $secondaryService
            ]);
        }
    }
}
