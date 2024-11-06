<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Audience;

class AudienceController extends Controller
{
    public function index()
    {   
        $audienceData = Audience::orderBy('id','desc')->get();
        return view('admin.audience.index',compact('audienceData'));
    }

    public function create()
    {
        return view('admin.audience.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'area' => 'required',
        ]);

        $data = $request->all();
        
        if(Audience::create($data)){
            return redirect()->route('audience.index')->with('message','Successfully Audience Created');
        }else{
            return redirect()->back();
        }
    }

    public function edit($id)
    {   
        $audienceData = Audience::where('id',$id)->first();
        return view('admin.audience.edit',compact('audienceData'));
    }

    public function update(Request $request,$id){

        $request->validate([
            'area' => 'required',
        ]);


        $data = $request->all();
    
        $audienceData = Audience::find($id);
        if($audienceData->update($data)){
            return redirect(route('audience.index'))->with('message','Successfully Audience Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }

    }


    public function destroy($id)
    {
        $audienceData = Audience::find($id);
        if($audienceData->delete()){

            return redirect(route('audience.index'))->with('message','Successfully Audience Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
    }    
}
