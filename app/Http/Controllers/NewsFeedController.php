<?php

namespace App\Http\Controllers;
use App\Models\NewsFeed;
use Illuminate\Http\Request;
use App\Http\Requests\NewsFeedRequest;
use App\Http\Controllers\Api\Controller;

class NewsFeedController extends Controller
{

//------go to main page and show all the news feed------------------//
    public function index()
    {
        //get all newsfeed table records
        $newsf = NewsFeed::all();
        return view('admin.news feed.index',compact('newsf'));
    }

//------go to the create page------------------//
    public function create()
    {
        return view('admin.news feed.create');
    }

//------store the requested data from the create page------------------//
    public function store(NewsFeedRequest $request)
    {
        $newsf = $request->validated();
        //here we are using the "file" function to get the url of the image and
        //store the image file using "store" function in 'public' disk inside 'images' folder.
        $newsf_image = $request->file('filename')->store('img','public');
        $existing_newsf = NewsFeed::where('title',$newsf)->first();
        //check if this news has been added before or not
        if($existing_newsf)
        {
            return redirect()->back()->with('alert','this feed is added already');
        }

        $n_newsf = NewsFeed::create([
            'title' => $newsf['title'],
            'filename'=>$newsf_image,
            'order' => $newsf['order'],
            'place'=>$newsf['place'],
            'path'=>$image_url,
            'newsDate'=>$newsf['newsDate']
        ]);
        return redirect(route('news_feed.index'));
    }

//------go to the edit page------------------//
    public function edit($id)
    {
        $edit_newsf = NewsFeed::where('id',$id)->get();//get the newsf that has the same id
        return view('admin.news feed.edit',compact('edit_newsf'));
    }

//------update an existing news feed record------------------//
    public function update(NewsFeedRequest $request, $id)
    {
        $updated_newsf = $request->validated();
        $old_newsf = NewsFeed::where('id',$id)->first();//find the desired record
        $old_newsf->update($updated_newsf);//update the old values(old_newsf) with the new (updated_newsf)
        return redirect(route('news_feed.index'));
    }

//------remove an existing news feed record------------------//
    public function destroy($id)
    {
        $removed_newsf = NewsFeed::where('id',$id)->delete();//find the desired record and delete it
        return redirect()->back();
    }
}
