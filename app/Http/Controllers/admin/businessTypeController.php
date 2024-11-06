<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessType;

class businessTypeController extends Controller
{
    public function index()
    {   
        $businessTypeData = BusinessType::orderBy('id','desc')->get();
        return view('admin.businessType.index',compact('businessTypeData'));
    }

    public function create()
    {
        return view('admin.businessType.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();

        if(BusinessType::create($data)){
            return redirect()->route('businessType.index')->with('message','Successfully business Type Create');
        }else{
            return redirect()->back();
        }
    }

    public function edit($id)
    {   
        $businessType = BusinessType::where('id',$id)->first();
        return view('admin.businessType.edit',compact('businessType'));
    }

    public function update(Request $request,$id){

        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
    
        $businessType = BusinessType::find($id);

        if($businessType->update($data)){
            return redirect(route('businessType.index'))->with('message','Successfully business Type Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }

    }


    public function destroy($id)
    {
        $businessType = BusinessType::find($id);
        if($businessType->delete()){

            return redirect(route('businessType.index'))->with('message','Successfully business Type Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
    }
}
