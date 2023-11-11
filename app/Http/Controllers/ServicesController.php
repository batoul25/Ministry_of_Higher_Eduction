<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{

    public function index()
    {
        //

        //get all newsfeed table records
        $services = Services::all();
        return view('admin.services.index',compact('services'));
    }


    public function create()
    {
        //
        return view('admin.services.create');
    }


    public function store(ServiceRequest $request)
    {
        //
        $serv= $request->validated();

    // Check if a file was uploaded
    if ($request->hasFile('filename')) {
        $file = $request->file('logo');

        // Ensure the file is valid
        if ($file->isValid()) {
            // Store the file in the 'public' disk inside the 'images' folder
            $service_image = $file->storeAs('logos', $file->getClientOriginalName(), 'public');
        } else {
            // File is not valid, handle the error
            return redirect()->back()->with('alert', 'Invalid file. Please upload a valid image file.');
        }
    } else {
        // No file was uploaded, handle the error
        return redirect()->back()->with('alert', 'No file uploaded. Please select an image file to upload.');
    }

    $existing_service = Services::where('name',  $serv['name'])->first();

    // Check if this news feed has been added before or not
    if ($existing_service) {
        return redirect()->back()->with('alert', 'This service is already added.');
    }

        $n_service = Services::create([
        'name' => $serv['name'],
        'logo' => $service_image,
        'path' => $file->getClientOriginalName(),
    ]);
    // Flash a success message to the session
    Session::flash('created-message', 'Service created successfully.');
    return redirect(route('services.index'));
}
//------go to the edit page------------------//
    public function edit($id)
    {
        $edit_serv = Services::where('id',$id)->get();//get the newsf that has the same id
        return view('admin.services.edit',compact('edit_serv'));
    }





 //------update an existing news feed record------------------//
 public function update(Services $request, $id)
 {
     $updated_serv = $request->validated();
     $old_serv = Services::where('id',$id)->first();//find the desired record
     $old_serv ->update($updated_serv);//update the old values(old_newsf) with the new (updated_newsf)
     // Flash a success message to the session
     Session::flash('updated-message', 'Service updated successfully.');
     return redirect(route('services.index'));
 }

 //------remove an existing news feed record------------------//
public function destroy($id)
{
    $service = Services::find($id);

    if (!$service) {
        return redirect()->back()->with('alert', 'Service not found.');
    }

    // Delete the associated image file

$filePath = 'public/images/' . $service->logo;
if (Storage::exists($filePath)) {
    Storage::delete($filePath);
}
    // Delete the NewsFeed record
    $removed_serv = $service->delete();

    // Flash a success message to the session
    Session::flash('message', 'Service deleted successfully.');

    return redirect()->back();
}
}
