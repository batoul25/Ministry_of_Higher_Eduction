<?php

namespace App\Http\Controllers;
use App\Models\NewsFeed;
use App\Http\Requests\NewsFeedRequest;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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

    // Check if a file was uploaded
    if ($request->hasFile('filename')) {
        $file = $request->file('filename');

        // Ensure the file is valid
        if ($file->isValid()) {
            // Store the file in the 'public' disk inside the 'images' folder
            $newsf_image = $file->storeAs('images', $file->getClientOriginalName(), 'public');
        } else {
            // File is not valid, handle the error
            return redirect()->back()->with('alert', 'Invalid file. Please upload a valid image file.');
        }
    } else {
        // No file was uploaded, handle the error
        return redirect()->back()->with('alert', 'No file uploaded. Please select an image file to upload.');
    }

    $existing_newsf = NewsFeed::where('title', $newsf['title'])->first();

    // Check if this news feed has been added before or not
    if ($existing_newsf) {
        return redirect()->back()->with('alert', 'This feed is already added.');
    }

    $n_newsf = NewsFeed::create([
        'title' => $newsf['title'],
        'filename' => $newsf_image,
        'order' => $newsf['order'],
        'place' => $newsf['place'],
        'path' => $file->getClientOriginalName(),
        'newsDate' => isset($newsf['newsDate']) ? $newsf['newsDate'] : null
    ]);
    // Flash a success message to the session
    Session::flash('created-message', 'News feed created successfully.');
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
        // Flash a success message to the session
        Session::flash('updated-message', 'News feed updated successfully.');
        return redirect(route('news_feed.index'));
    }

//------remove an existing news feed record------------------//
public function destroy($id)
{
    $newsFeed = NewsFeed::find($id);

    if (!$newsFeed) {
        return redirect()->back()->with('alert', 'News feed not found.');
    }

    // Delete the associated image file

$filePath = 'public/images/' . $newsFeed->filename;
if (Storage::exists($filePath)) {
    Storage::delete($filePath);
}
    // Delete the NewsFeed record
    $removed_newsf = $newsFeed->delete();

    // Flash a success message to the session
    Session::flash('message', 'News feed deleted successfully.');

    return redirect()->back();
}
}
