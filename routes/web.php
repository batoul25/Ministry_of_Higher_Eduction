<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BreakingNewsController;
use App\Http\Controllers\LatestNewsController;
use App\Http\Controllers\NewsFeedController;
use App\Http\Controllers\InstitutionsController;
use App\Http\Controllers\InstitutionsCategoriesController;


Route::get('/', function () {
    return view('welcome');
});
//breaking news section
Route::resource('breaking_news',BreakingNewsController::class);
//latest news section
Route::resource('latest_news',LatestNewsController::class);
//news feed section
Route::resource('news_feed',NewsFeedController::class);
//Institutions section
Route::resource('institutions',InstitutionsController::class);
//Institution's category section
Route::resource('categories',InstitutionsCategoriesController::class);



Route::view('/create' , 'admin\latest news\create');
Route::view('/index' , 'admin\latest news\index');

Route::view('/create/n' , 'admin\news feed\create');

