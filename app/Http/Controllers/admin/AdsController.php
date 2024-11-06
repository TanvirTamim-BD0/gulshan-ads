<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ads;
use Carbon\Carbon;

class AdsController extends Controller
{
    public function index()
    {   
        $ads = Ads::first();
        return view('admin.ads.index',compact('ads'));
    }


    public function update(Request $request,$id){

        $data = $request->all();
    
        $ad = Ads::find($id);

        if($request->ads_1 != ''){
            //To remove previous file...
            $destinationPath = public_path('uploads/ads_1/');
            if(file_exists($destinationPath.$ad->ads_1)){
                if($ad->ads != ''){
                    unlink($destinationPath.$ad->ads_1);
                }
            }

            $file = $request->file('ads_1');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath,$fileName);
            $data['ads_1'] = $fileName;
        }


        if($request->ads_2 != ''){
            //To remove previous file...
            $destinationPath = public_path('uploads/ads_2/');
            if(file_exists($destinationPath.$ad->ads_2)){
                if($ad->ads != ''){
                    unlink($destinationPath.$ad->ads_2);
                }
            }

            $file = $request->file('ads_2');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath,$fileName);
            $data['ads_2'] = $fileName;
        }


        if($request->ads_3 != ''){
            //To remove previous file...
            $destinationPath = public_path('uploads/ads_3/');
            if(file_exists($destinationPath.$ad->ads_3)){
                if($ad->ads != ''){
                    unlink($destinationPath.$ad->ads_3);
                }
            }

            $file = $request->file('ads_3');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath,$fileName);
            $data['ads_3'] = $fileName;
        }


        if($request->ads_4 != ''){
            //To remove previous file...
            $destinationPath = public_path('uploads/ads_4/');
            if(file_exists($destinationPath.$ad->ads_4)){
                if($ad->ads != ''){
                    unlink($destinationPath.$ad->ads_4);
                }
            }

            $file = $request->file('ads_4');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath,$fileName);
            $data['ads_4'] = $fileName;
        }

        if($request->ads_5 != ''){
            //To remove previous file...
            $destinationPath = public_path('uploads/ads_5/');
            if(file_exists($destinationPath.$ad->ads_5)){
                if($ad->ads != ''){
                    unlink($destinationPath.$ad->ads_5);
                }
            }

            $file = $request->file('ads_5');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath,$fileName);
            $data['ads_5'] = $fileName;
        }


        if($request->ads_6 != ''){
            //To remove previous file...
            $destinationPath = public_path('uploads/ads_6/');
            if(file_exists($destinationPath.$ad->ads_6)){
                if($ad->ads != ''){
                    unlink($destinationPath.$ad->ads_6);
                }
            }

            $file = $request->file('ads_6');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath,$fileName);
            $data['ads_6'] = $fileName;
        }


        if($ad->update($data)){
            return redirect(route('ads.index'))->with('message','Successfully Ads Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }

    }


    public function adImageRemove($data){
        $ad = Ads::first();

        if ($data == 'ads_1') {
           $ad->ads_1 = null;
        }
        if ($data == 'ads_2') {
           $ad->ads_2 = null;
        }
        if ($data == 'ads_3') {
           $ad->ads_3 = null;
        }
        if ($data == 'ads_4') {
           $ad->ads_4 = null;
        }
        if ($data == 'ads_5') {
           $ad->ads_5 = null;
        }
        if ($data == 'ads_6') {
           $ad->ads_6 = null;
        }

        $ad->save();
        return redirect()->back();
    }


}
