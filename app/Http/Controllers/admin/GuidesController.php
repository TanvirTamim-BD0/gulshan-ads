<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guides;

class GuidesController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:guides,admin');
    }
    
    public function index()
    {   
        $guidesData = Guides::orderBy('id','desc')->get();
        return view('admin.guides.index',compact('guidesData'));
    }

    public function create()
    {
        return view('admin.guides.create');
    }


    public function store(Request $request)
    {
         $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $data = $request->all();

        if($request->image){
            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/guides_image/');
            $file->move($destinationPath,$fileName);
            $data['image'] = $fileName;
        }
        
        if(Guides::create($data)){
            return redirect()->route('guide.index')->with('message','Successfully Guides Create');
        }else{
            return redirect()->back();
        }
    }

    public function edit($id)
    {   
        $guidesData = Guides::where('id',$id)->first();
        return view('admin.guides.edit',compact('guidesData'));
    }

    public function update(Request $request,$id){

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $data = $request->all();
    
        $guide = Guides::find($id);
        if($request->image != ''){
            //To remove previous file...
            $destinationPath = public_path('uploads/guides_image/');
            if(file_exists($destinationPath.$guide->image)){
                if($guide->image != ''){
                    unlink($destinationPath.$guide->image);
                }
            }

            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath,$fileName);
            $data['image'] = $fileName;
        }

        if($guide->update($data)){
            return redirect(route('guide.index'))->with('message','Successfully Guides Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }

    }


    public function destroy($id)
    {
        $guide = Guides::find($id);
        if($guide->delete()){

            return redirect(route('guide.index'))->with('message','Successfully Guides Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
    }



    public function guideView($id)
    {   
        $guide = Guides::where('id',$id)->first();
        return view('admin.guides.guidesView',compact('guide'));
    }
}
