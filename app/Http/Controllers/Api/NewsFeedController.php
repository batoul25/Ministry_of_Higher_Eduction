<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\NewsFeedResource;
use App\Models\NewsFeed;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;//here we imported the ApiResponse trait just for code modularity.

class NewsFeedController extends Controller
{
    use ApiResponse;//included the class name so we can use the functions defined in it(successResponse & errorResponse).

    public function index()
    {
         //get all news info...
         $newsFeed = NewsFeed::get();

         //in this condition we are checking if the newsfeed table is empty or not.
         if($newsFeed->isNotEmpty())
         {
             return $this->successResponse(NewsFeedResource::collection($newsFeed),'Data fetched successfully',200);
         }

         return $this->errorResponse('there is no data in the table',401);
    }



        /**
     * Display the specified resource.
     *
     * @param  \App\Models\NewsFeed  $newsFeed
     * @return \Illuminate\Http\Response
     */
    //To show a specific news by the id
    public function show($id)
    {
        //
        try{
            $news = NewsFeed::find($id);
            return $this->successResponse(new NewsFeedResource($news),'Retrived Successfully');
        }catch(\Exception $exc){
            return $this->errorResponse('The news is not found' , 401);
        }

    }

}
