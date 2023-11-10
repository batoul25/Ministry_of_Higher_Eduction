<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Services;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $services = Services::all();
        if($services->isNotEmpty()){
            return $this->successResponse(ServiceResource::collection($services) , 'Services Retrived Sucssefully' , 200);
    }
    return $this->errorResponse('The Table Is Empty' , 401);

}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try{
            $service = Services::find($id);
            return $this->successResponse(new ServiceResource($service),'Retrived Successfuly', 200);
        }catch(\Exception $e){
            return $this->errorResponse('The service is not found' , 401);
        }
    }

}
