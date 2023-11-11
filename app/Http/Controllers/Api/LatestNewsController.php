<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\LatestNewsResource;
use App\Models\LatestNews;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class LatestNewsController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //To show all the latest news
    public function index()
    {
        //
        $latestNews = LatestNews::orderBy('id', 'desc')->get();
        return $this ->successResponse(LatestNewsResource::collection($latestNews), 'Latest News Retrived Successfully');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LatestNews  $latestNews
     * @return \Illuminate\Http\Response
     */
    //To show a specific news by the id
    public function show($id)
    {
        //
        try{
            $news = LatestNews::find($id);
            return $this->successResponse(new LatestNewsResource($news),'Retrived Successfully');
        }catch(\Exception $exc){
            return $this->errorResponse('The news is not found' , 401);
        }

    }

    //To show only few news on the main page
   public function view(){
        $latestNews = LatestNews::orderBy('id','desc')->take(4)->get();
        return $this ->successResponse(LatestNewsResource::collection($latestNews), 'Latest News Retrived Successfully');

   }

}
