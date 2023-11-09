<?php

namespace App\Http\Controllers;
use App\Models\LatestNews;
use Illuminate\Http\Request;
use App\Http\Requests\LatestNewsRequest;
use App\Http\Controllers\Api\Controller;

class LatestNewsController extends Controller
{

//------go to main page and show all the latest news------------------//
    public function index()
    {
        //get all latest news table records
        $lnews = LatestNews::all();
        return view('admin.latest news.index',compact('lnews'));
    }

//------go to the create page------------------//
    public function create()
    {
        return view('admin.latest news.create');
    }

//------store the requested data from the create page------------------//
    public function store(LatestNewsRequest $request)
    {
        $lnews = $request->validated();//validation

        //check if this record already exists
        $existing_lnews = LatestNews::where('title',$lnews)->first();

        if($existing_lnews)
        {
            return redirect()->back()->with('alert','this latest news is added already');
        }
        //if it doesn't exist break the if statement and create it
        $n_lnews = LatestNews::create($lnews);

        return redirect(route('latest_news.index'));
    }

//------go to the edit page------------------//
    public function edit($id)
    {
        $edit_lnew = LatestNews::where('id',$id)->get();//get the lnew that has the same id
        return view('admin.latest news.edit',compact('edit_lnew'));
    }

//------update an existing latest news record------------------//
    public function update(LatestNewsRequest $request, $id)
    {
        $updated_lnew = $request->validated();
        $old_lnew = LatestNews::where('id',$id)->first();//find the desired record
        $old_lnew->update($updated_lnew);//update the old values(old_lnew) with the new (updated_lnew)
        return redirect(route('latest_news.index'));
    }

//------remove an existing latest news record------------------//
    public function destroy($id)
    {
        $removed_lnew = LatestNews::where('id',$id)->delete();//find the desired record and delete it
        return redirect()->back();
    }
}
