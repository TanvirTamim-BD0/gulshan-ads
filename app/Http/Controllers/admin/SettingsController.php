<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ads;
use Carbon\Carbon;

class SettingsController extends Controller
{
    public function index()
    {   
        $setting = Ads::first();
        return view('admin.settings.index',compact('setting'));
    }

    public function update(Request $request,$id){

        $data = $request->all();
    
        $setting = Ads::find($id);

        if($request->site_logo != ''){
            //To remove previous file...
            $destinationPath = public_path('uploads/site_logo/');
            if(file_exists($destinationPath.$setting->site_logo)){
                if($setting->site_logo != ''){
                    unlink($destinationPath.$setting->site_logo);
                }
            }

            $file = $request->file('site_logo');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath,$fileName);
            $data['site_logo'] = $fileName;
        }


        if($setting->update($data)){
            return redirect(route('settings.index'))->with('message','Successfully Setting Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }

    }

}
