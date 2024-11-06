<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Support;

class SupportController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:support,admin');
    }
    
    public function index()
    {   
        $supportData = Support::orderBy('id','desc')->get();
        return view('admin.support.index',compact('supportData'));
    }

    public function create()
    {
        return view('admin.support.create');
    }


    public function store(Request $request)
    {   
         $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $data = $request->all();
        
        if(Support::create($data)){
            return redirect()->route('supports.index')->with('message','Successfully Support Create');
        }else{
            return redirect()->back();
        }
    }

    public function edit($id)
    {   
        $supportData = Support::where('id',$id)->first();
        return view('admin.support.edit',compact('supportData'));
    }

    public function update(Request $request,$id){

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $data = $request->all();
    
        $support = Support::find($id);

        if($support->update($data)){
            return redirect(route('supports.index'))->with('message','Successfully Support Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }

    }


    public function destroy($id)
    {
        $support = Support::find($id);
        if($support->delete()){
            return redirect(route('supports.index'))->with('message','Successfully Support Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
    }

}
