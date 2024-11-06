<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Models\User;
use Carbon\Carbon;

class ServiceCategoryController extends Controller
{
    public function index()
    {   
        $serviceCategoryData = ServiceCategory::orderBy('id','desc')->get();
        return view('admin.serviceCategory.index',compact('serviceCategoryData'));
    }

    public function create()
    {
        return view('admin.serviceCategory.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ]);

        $data = $request->all();

        if(ServiceCategory::create($data)){
            return redirect()->route('service-category.index')->with('message','Successfully Service Category Create');
        }else{
            return redirect()->back();
        }
    }

    public function edit($id)
    {   
        $serviceCategoryData = ServiceCategory::where('id',$id)->first();
        return view('admin.serviceCategory.edit',compact('serviceCategoryData'));
    }

    public function update(Request $request,$id){

        $request->validate([
            'category_name' => 'required',
        ]);

        $data = $request->all();
    
        $serviceCategory = ServiceCategory::find($id);

        if($serviceCategory->update($data)){
            return redirect(route('service-category.index'))->with('message','Successfully Service Category Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }

    }


    public function destroy($id)
    {
        $serviceCategory = ServiceCategory::find($id);
        if($serviceCategory->delete()){

            return redirect(route('service-category.index'))->with('message','Successfully Service Category Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
    }
}
