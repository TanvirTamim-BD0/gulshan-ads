<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guides;
use App\Models\Services;
use App\Models\BuyService;
use App\Models\User;
use Auth;
use App\Models\Support;
use App\Models\ServiceCategory;

class ServicesController extends Controller
{
    public function services()
    {   
        $serviceData = Services::orderBy('id','desc')->paginate(6);
        $serviceCategoryData = ServiceCategory::orderBy('id','desc')->get();
        return view('user.services',compact('serviceData','serviceCategoryData'));
    }

    public function servicesSearch(Request $request)
    {
        $serviceData = Services::where('name', 'like' ,'%'.$request->serach_text.'%')->orderBy('id','desc')->paginate(6);
        $serviceCategoryData = ServiceCategory::orderBy('id','desc')->get();
        return view('user.services',compact('serviceData','serviceCategoryData'));
    }

    public function serviceDetails($id)
    {   
        $data = Services::where('id',$id)->first();
        return view('user.serviceDetails',compact('data'));
    }

    public function buyService($id){

        $serviceData = Services::where('id',$id)->first();
        $userData = User::where('id',Auth::user()->id)->first();
        $uniqueId = random_int(1000000000, 9999999999);

        if ($userData->balance >= $serviceData->price) {

            $buyService = new BuyService();
            $buyService->invoice_no = "8080".$uniqueId;
            $buyService->user_id = Auth::user()->id;
            $buyService->service_id = $serviceData->id;
            $buyService->save();

            return redirect()->route('home')->with('message','Successfully Service Buying');

        }else{
            return redirect()->back()->with('error',"insufficiens balance!!");
        }

    }

    public function serviceBuyReport()
    {
        $buyServiceData = BuyService::orderBy('id','desc')->where('user_id',Auth::user()->id)->get(); 
        return view('user.buyServiceInvoice',compact('buyServiceData'));
    }

    public function servicesCategoryWise($id)
    {
        $serviceData = Services::where('service_category_id',$id)->orderBy('id','desc')->paginate(6);
        $serviceCategoryData = ServiceCategory::orderBy('id','desc')->get();
        return view('user.services',compact('serviceData','serviceCategoryData'));
    }


    public function guides()
    {   
        $guidesData = Guides::orderBy('id','desc')->get();
        return view('user.guides',compact('guidesData'));
    }

    public function guideDetails($id)
    {
        $data = Guides::where('id',$id)->first();
        return view('user.guidesDetails',compact('data'));
    }


    public function support()
    {   
        $supportData = Support::orderBy('id','desc')->get();
        return view('user.support',compact('supportData'));
    }

}
