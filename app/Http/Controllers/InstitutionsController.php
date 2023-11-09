<?php

namespace App\Http\Controllers;
use App\Models\Institutions;
use Illuminate\Http\Request;
use App\Http\Requests\InstitutionsRequest;
use App\Http\Controllers\Api\Controller;
use App\Models\InstitutionCategory;



class InstitutionsController extends Controller
{
//------go to main page and show all the institutions------------------//
    public function index()
    {
        //get all institutions table records with their categories
        $inst = Institutions::with('category')->get();
        return view('admin.Institutions.index',compact('inst'));
    }

//------go to the create page------------------//
    public function create()
    {
        $category = InstitutionCategory::all();
        return view('admin.Institutions.create',compact('category'));
    }

//------store the requested data from the create page------------------//
    public function store(InstitutionsRequest $request)
    {
        $inst = $request->validated();//validate the incoming data
        $existing_inst = Institutions::where('name',$inst)->first();
        //check if this news has been added before or not
        if($existing_inst)
        {
            return redirect()->back()->with('alert','this institution is added already');
        }
        $n_inst = Institutions::create($inst);
        return redirect(route('institutions.index'));
    }

//------go to the edit page------------------//
    public function edit($id)
    {
        $edit_inst = Institutions::where('id',$id)->get();
        $category = InstitutionCategory::all();
        return view('admin.Institutions.edit',compact('edit_inst','category'));
    }

//------update an existing institutions record------------------//
    public function update(InstitutionsRequest $request, $id)
    {
        $updated_inst = $request->validated();
        $old_inst = Institutions::where('id',$id)->first();//find the desired record
        $old_inst->update($updated_inst);//update the old values(old_inst) with the new (updated_inst)
        return redirect(route('institutions.index'));
    }

//------remove an existing institutions record------------------//
    public function destroy($id)
    {
        $removed_inst = Institutions::where('id',$id)->delete();//find the desired record and delete it
        return redirect()->back();
    }
}
