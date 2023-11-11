<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use App\Models\BreakingNews;
use App\Http\Requests\BreakingNewsRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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

    // Check if a file was uploaded
    if ($request->hasFile('filename')) {
        $file = $request->file('filename');

        // Ensure the file is valid
        if ($file->isValid()) {
            // Generate a unique filename
            $filename = $file->storeAs('images', $file->getClientOriginalName(), 'public');



            $existing_bnews = BreakingNews::where('title', $bnews)->first();

            // Check if this news has been added before or not
            if ($existing_bnews) {
                return redirect()->back()->with('alert', 'This news has already been added.');
            }

            $n_bnews = new BreakingNews();

            // Set the object's attributes
            $n_bnews->title = $request->input('title');
            $n_bnews->filename = $filename; // Store the generated filename
            $n_bnews->path = $file->getClientOriginalName();
            $n_bnews->description = $request->input('description');

            // Save the object as a new record
            $n_bnews->save();
        } else {
            // File is not valid, handle the error
            return redirect()->back()->with('alert', 'Invalid file. Please upload a valid image file.');
        }
    } else {
        // No file was uploaded, handle the error
        return redirect()->back()->with('alert', 'No file uploaded. Please select an image file to upload.');
    }
     // Flash a success message to the session
     Session::flash('created_message', 'Breaking news created successfully.');
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
         // Flash a success message to the session
        Session::flash('updated_message', 'Breaking news updated successfully.');
        return redirect(route('breaking_news.index'));
    }

//------remove an existing breaking news record------------------//
    public function destroy($id)
    {
        $bnew = BreakingNews::find($id);//find the desired record and delete it
        // Delete the associated image file

    $filePath = 'public/images/' .$bnew->filename;
    if (Storage::exists($filePath)) {
        Storage::delete($filePath);
    }
    $removed_bnew = $bnew->delete();
    // Flash a success message to the session
    Session::flash('message', 'Breaking news deleted successfully.');
            return redirect()->back();
        }
}
