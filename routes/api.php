<?php

use App\Http\Controllers\Api\LatestNewsController;
use App\Http\Controllers\Api\FooterController;
use App\Http\Controllers\Api\ServicesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InstitutionsController;
use App\Http\Controllers\Api\InstitutionCategoryController;
use App\Http\Controllers\Api\NewsFeedController;
use App\Http\Controllers\Api\BreakingNewsController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

                //---------Institutions routes----------//
//make sure your Api link is something like this: http://127.0.0.1:8000/api/institutions/inst
Route::group(['prefix'=>'institutions'],function(){
//show all institutions
Route::get('/inst',[InstitutionsController::class,'index']);
//show a specific institution
Route::get('/inst/{category_id}',[InstitutionsController::class,'show']);
// //insert new institution
// Route::post('/inst',[InstitutionsController::class,'store']);
// //update existing institution\\
// Route::post('/inst/{instid}',[InstitutionsController::class,'update']);
// //remove existing institution\\
// Route::delete('/inst/{instid}',[InstitutionsController::class,'destroy']);
// //remove all Institutions
// Route::get('/destroyall',[InstitutionsController::class,'destroy_all']);
});

//show all categories
Route::get('/cate',[InstitutionCategoryController::class,'index']);

//show all newsfeed
Route::get('/newf',[NewsFeedController::class,'index']);
//show news feed by specific id
Route::get('/newf/{id}',[NewsFeedController::class,'show']);

//Show all Services
Route::get('/services' , [ServicesController::class , 'index']);
//Show Service by specific id
Route::get('/services/{id}' , [ServicesController::class , 'show']);

//show all breakingnews
Route::get('/breakn',[BreakingNewsController::class,'index']);

//Route to get all the latest news
Route::get("/AllLatestNews" , [LatestNewsController::class , 'index']);
//Route to get a specific show by id
Route::get("/latestNews/{id}" , [LatestNewsController::class , 'show']);
//Route to show some news on the main page
Route::get("/FewLatestNews" , [LatestNewsController::class ,'view']);

//Show All the footer links
Route::get("/footerLinks" , [FooterController::class , 'index']);


