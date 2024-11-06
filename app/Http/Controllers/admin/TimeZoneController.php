<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TimeZone;

class TimeZoneController extends Controller
{
    public function index()
    {   
        $timeZoneData = TimeZone::orderBy('id','desc')->get();
        return view('admin.timeZone.index',compact('timeZoneData'));
    }

    public function create()
    {
        return view('admin.timeZone.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();

        if(TimeZone::create($data)){
            return redirect()->route('timeZone.index')->with('message','Successfully TimeZone Create');
        }else{
            return redirect()->back();
        }
    }

    public function edit($id)
    {   
        $timeZone = TimeZone::where('id',$id)->first();
        return view('admin.timeZone.edit',compact('timeZone'));
    }

    public function update(Request $request,$id){

        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
    
        $timeZone = TimeZone::find($id);

        if($timeZone->update($data)){
            return redirect(route('timeZone.index'))->with('message','Successfully TimeZone Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }

    }


    public function destroy($id)
    {
        $timeZone = TimeZone::find($id);
        if($timeZone->delete()){

            return redirect(route('timeZone.index'))->with('message','Successfully TimeZone Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
    }
}
