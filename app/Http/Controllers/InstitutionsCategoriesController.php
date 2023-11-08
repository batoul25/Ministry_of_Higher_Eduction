<?php

namespace App\Http\Controllers;
use App\Models\InstitutionCategory;
use App\Models\Institutions;
use Illuminate\Http\Request;
use App\Http\Requests\InstCategoryRequest;
use App\Http\Controllers\Api\Controller;

class InstitutionsCategoriesController extends Controller
{

//------go to main page and show all the institutions------------------//
    public function index()
    {
        //get all categories table records
        $cate = InstitutionCategory::all();
        return view('admin.Categories.index',compact('cate'));
    }

//------go to the create page------------------//
    public function create()
    {
        return view('admin.Categories.create');
    }

//------store the requested data from the create page------------------//
    public function store(InstCategoryRequest $request)
    {
        $cate = $request->validated();//validate the incoming data
        $existing_cate = InstitutionCategory::where('name',$cate)->first();
        //check if this news has been added before or not
        if($existing_cate)
        {
            return redirect()->back()->with('alert','this category is added already');
        }
        $n_cate = InstitutionCategory::create($cate);
        return redirect(route('categories.index'));
    }

//------go to the edit page------------------//
    public function edit($id)
    {
        $edit_cate = InstitutionCategory::where('id',$id)->get();
        return view('admin.Categories.edit',compact('edit_cate'));
    }

//------update an existing category record------------------//
    public function update(InstCategoryRequest $request, $id)
    {
        $updated_cate = $request->validated();
        $old_cate = InstitutionCategory::where('id',$id)->first();//find the desired record
        $old_cate->update($updated_cate);//update the old values(old_cate) with the new (updated_cate)
        return redirect(route('categories.index'));
    }

//------remove an existing category record------------------//
    public function destroy($id)
    {
        //here we are checking if there is any institution that is related to this category...
        //ofcourse we cannot delete the category because of the integrity constraint violation
        $check_constraint = Institutions::where('category_id',$id)->first();

        if($check_constraint)
        {
            return redirect()->back()->with('alert','there is an institution that is related to this category...');
        }
        $removed_cate = InstitutionCategory::where('id',$id)->delete();//find the desired record and delete it
        return redirect()->back();
    }
}
