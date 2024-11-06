<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailedTargeting;
use App\Models\DetailedTargetingChiled;

class DetailedTargetingChiledController extends Controller
{
    public function index()
    {   
        $detailedTargetingChiledData = DetailedTargetingChiled::orderBy('id','desc')->get();
        return view('admin.detailedTargetingChiled.index',compact('detailedTargetingChiledData'));
    }

    public function create()
    {
        return view('admin.detailedTargetingChiled.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        
        if(DetailedTargetingChiled::create($data)){
            return redirect()->route('detailed-targeting-chiled.index')->with('message','Successfully Detailed Targeting Chiled Created');
        }else{
            return redirect()->back();
        }
    }

    public function edit($id)
    {   
        $detailedTargetingChiledData = DetailedTargetingChiled::where('id',$id)->first();
        return view('admin.detailedTargetingChiled.edit',compact('detailedTargetingChiledData'));
    }

    public function update(Request $request,$id){

        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
    
        $detailedTargetingChiledData = DetailedTargetingChiled::find($id);
        if($detailedTargetingChiledData->update($data)){
            return redirect(route('detailed-targeting-chiled.index'))->with('message','Successfully Detailed Targeting Chiled Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }

    }


    public function destroy($id)
    {
        $detailedTargetingData = DetailedTargetingChiled::find($id);
        if($detailedTargetingData->delete()){

            return redirect(route('detailed-targeting-chiled.index'))->with('message','Successfully Detailed Targeting Chiled Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
    }  

}
