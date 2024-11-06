<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EditorAccess;

class EditorAccessController extends Controller
{
    public function index()
    {   
        $access = EditorAccess::first();
        return view('admin.editorAccess.index',compact('access'));
    }


    public function update(Request $request,$id){

        $data = $request->all();
    
        $access = EditorAccess::find($id);

        if($access->update($data)){
            return redirect(route('editor-access.index'))->with('message','Successfully Editor Access Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }

    }
}
