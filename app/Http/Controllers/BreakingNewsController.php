<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use App\Models\BreakingNews;
use App\Http\Requests\BreakingNewsRequest;

class BreakingNewsController extends Controller
{

//------go to main page and show all the breaking news------------------//
    public function index()
    {
        //get all breakingNews table records
        $bnews = BreakingNews::all();
        return view('admin.breaking news.index',compact('bnews'));
    }

//------go to the create page------------------//
    public function create()
    {
        return view('admin.breaking news.create');
    }

//------store the requested data from the create page------------------//
    public function store(BreakingNewsRequest $request)
    {
        $bnews = $request->validated();
        //here we are using the "file" function to get the url of the image and
        //store the image file using "store" function in 'public' disk inside 'images' folder.
        $bnews_image = $request->file('filename')->store('images','public');
        $existing_bnews = BreakingNews::where('title',$bnews)->first();
        //check if this news has been added before or not
        if($existing_bnews)
        {
            return redirect()->back()->with('alert','this news is added already');
        }
        $n_bnews = new BreakingNews();//create a new object (n_bnews)

        //define the object's attributes
        $n_bnews->title = $request->input('title');
        $n_bnews->filename = $bnews_image;//image's url
        $n_bnews->path = $request->input('path');
        $n_bnews->description = $request->input('description');
        //save the object  as a new record
        $n_bnews->save();
        return redirect(route('breaking_news.index'));
    }

//------go to the edit page------------------//
    public function edit($id)
    {
        $edit_bnew = BreakingNews::where('id',$id)->get();//get the bnew that has the same id
        return view('admin.breaking news.edit',compact('edit_bnew'));
    }

//------update an existing breaking news record------------------//
    public function update(BreakingNewsRequest $request, $id)
    {
        $updated_bnew = $request->validated();
        $old_bnew = BreakingNews::where('id',$id)->first();//find the desired record
        $old_bnew->update($updated_bnew);//update the old values(old_bnew) with the new (updated_bnew)
        return redirect(route('breaking_news.index'));
    }

//------remove an existing breaking news record------------------//
    public function destroy($id)
    {
        $removed_bnew = BreakingNews::where('id',$id)->delete();//find the desired record and delete it
        return redirect()->back();
    }
}
