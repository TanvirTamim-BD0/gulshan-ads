<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailedTargeting;

class DetailedTargetingController extends Controller
{
    public function index()
    {   
        $detailedTargetingData = DetailedTargeting::orderBy('id','desc')->get();
        return view('admin.detailedTargeting.index',compact('detailedTargetingData'));
    }

    public function create()
    {
        return view('admin.detailedTargeting.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'name' => 'required',
        ]);

        $data = $request->all();
        
        if(DetailedTargeting::create($data)){
            return redirect()->route('detailed-targeting.index')->with('message','Successfully Detailed Targeting Created');
        }else{
            return redirect()->back();
        }
    }

    public function edit($id)
    {   
        $detailedTargetingData = DetailedTargeting::where('id',$id)->first();
        return view('admin.detailedTargeting.edit',compact('detailedTargetingData'));
    }

    public function update(Request $request,$id){

        $request->validate([
            'type' => 'required',
            'name' => 'required',
        ]);

        $data = $request->all();
    
        $detailedTargetingData = DetailedTargeting::find($id);
        if($detailedTargetingData->update($data)){
            return redirect(route('detailed-targeting.index'))->with('message','Successfully Detailed Targeting Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }

    }


    public function destroy($id)
    {
        $detailedTargetingData = DetailedTargeting::find($id);
        if($detailedTargetingData->delete()){

            return redirect(route('detailed-targeting.index'))->with('message','Successfully Detailed Targeting Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
    }    


}
