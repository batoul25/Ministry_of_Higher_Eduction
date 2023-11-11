<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\InstitutionResource;
use App\Models\Institutions;
use Illuminate\Http\Request;
use App\Http\Requests\InstitutionsRequest;
use App\Traits\ApiResponse;//here we imported the ApiResponse trait just for code modularity.

class InstitutionsController extends Controller
{
    use ApiResponse;//included the class name so we can use the functions defined in it(successResponse & errorResponse).

    //-------show all existing Institutions--------//
    public function index()
    {
        //get all institutions info...
        $institutions = Institutions::with('category')->get();

        //in this condition we are checking if the institutions table is empty or not.
        if($institutions->isNotEmpty())
        {
            return $this->successResponse(InstitutionResource::collection($institutions),'Data fetched successfully',200);
        }

        return $this->errorResponse('there is no data in the table',401);
    }

    //-------add new Institution--------//
    public function store(InstitutionsRequest $request)
    {
        $val_request = $request->validated();
        $newest_order = Institutions::max('order');//the record that has the maximum order value is the newest

        $existing_inst = Institutions::where('name',$val_request)->first();
        if($existing_inst)
            {//check if it's already added before.
            return $this->errorResponse('Institution already exists',401);
            }

        else{
            $newinstitution = Institutions::create([
                'name'        => $val_request['name'],
                'category_id' => $val_request['category_id'],
                'order'       => $newest_order + 1,//increase the order by one so it will become the newest
            ]);
            if($newinstitution)
            {//check if it's added successfully.
                return $this->successResponse($newinstitution,'Institution added successfully',201);
            }
            return $this->errorResponse('there was an error adding the institution!',401);
        }
    }

    //-------show a specific existing Institution--------//
    public function show($category_id)
    {
        //find the institution by id.
        $institutions = Institutions::where('category_id' , $category_id)->get();
      // Check if any institutions exist
    if ($institutions->count() > 0) {
        return $this->successResponse(InstitutionResource::collection($institutions), 'Data fetched successfully', 200);
    }
        //if it does not exist it will break the if statement and return the error response
        return $this->errorResponse('this institution doesnt exists',401);
    }

    //-------update an existing Institution--------//
    public function update(InstitutionsRequest $request,$id)
    {
        $val_request = $request->validated();//this is the new values, we validate them
        //find the desired institution by id.
        $inst = Institutions::find($id);

        //in this condition we are checking if the institution record exits or not.

        if($inst)//if it exists
        {
            $updated_inst = $inst->update($val_request);
            return $this->successResponse($updated_inst,'Institution updated successfully',200);
        }

        //if it does not exist it will break the if statement and return the error response
        return $this->errorResponse('this institution does not exists',401);
    }

    //-------delete an existing Institution--------//
    public function destroy($id)
    {
        //find the desired institution by id.
        $institutions = Institutions::find($id);
        //in this condition we are checking if the institution record exits or not.
        if($institutions)
        {
            $institutions->delete();
            return $this->successResponse($institutions,'Institution removed successfully',200);
        }
        //if it does not exist it will break the if statement and return the error response
        return $this->errorResponse('this institution doesnt exists',401);
    }

    public function destroy_all()
    {
        Institutions::truncate();
        return $this->successResponse(null,'all Institutions removed successfully',200);
    }
}
