<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\BuyService;
use App\Models\User;
use Carbon\Carbon;
use App\Models\ServiceCategory;
use DateTime;
use DateTimezone;

class ServiceController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:services,admin');
    }
    
    public function index()
    {   
        $serviceData = Services::orderBy('id','desc')->get();
        return view('admin.services.index',compact('serviceData'));
    }

    public function create()
    {   
        $serviceCategoryData = ServiceCategory::orderBy('id','desc')->get();
        return view('admin.services.create',compact('serviceCategoryData'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'service_category_id' => 'required',
            'name' => 'required',
            'detals' => 'required',
            'price' => 'required',
        ]);

        $data = $request->all();

        if($request->image){
            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/service_image/');
            $file->move($destinationPath,$fileName);
            $data['image'] = $fileName;
        }
        
        if(Services::create($data)){
            return redirect()->route('service.index')->with('message','Successfully Service Create');
        }else{
            return redirect()->back();
        }
    }

    public function edit($id)
    {   
        $serviceData = Services::where('id',$id)->first();
        $serviceCategoryData = ServiceCategory::orderBy('id','desc')->get();
        return view('admin.services.edit',compact('serviceData','serviceCategoryData'));
    }

    public function update(Request $request,$id){

        $request->validate([
            'service_category_id' => 'required',
            'name' => 'required',
            'detals' => 'required',
            'price' => 'required',
        ]);

        $data = $request->all();
    
        $service = Services::find($id);

        if($request->image != ''){
            //To remove previous file...
            $destinationPath = public_path('uploads/service_image/');
            if(file_exists($destinationPath.$service->image)){
                if($service->image != ''){
                    unlink($destinationPath.$service->image);
                }
            }

            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath,$fileName);
            $data['image'] = $fileName;
        }

        if($service->update($data)){
            return redirect(route('service.index'))->with('message','Successfully Service Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }

    }


    public function destroy($id)
    {
        $service = Services::find($id);
        if($service->delete()){

            return redirect(route('service.index'))->with('message','Successfully Service Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
    }


    public function serviceView($id)
    {   
        $serviceData = Services::where('id',$id)->first();
        return view('admin.services.serviceView',compact('serviceData'));
    }


    public function serviceBuyRequest()
    {   
        $buyServiceData = BuyService::orderBy('id','desc')->get(); 
        return view('admin.services.buyServiceList',compact('buyServiceData'));
    }

    public function serviceBuyRequestConfirmed(Request $request,$id)
    {   
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $current_time = $dt->format('Y-m-d g:i a');

        $adAccountReplace = BuyService::where('id',$id)->first();
        $adAccountReplace->status = 'Confirmed';
        $adAccountReplace->confirmed_date = $current_time;
        $adAccountReplace->confirmed_text = $request->confirmed_text;
        $adAccountReplace->save();

        $serviceData = Services::where('id',$adAccountReplace->service_id)->first();
        $userData = User::where('id',$adAccountReplace->user_id)->first();
        $userData->balance -= $serviceData->price;
        $userData->save();

        $mail_data = [
                    'email' => $userData->email,
                    'from_name' => 'tanvirtamim6688@gmail.com',
                    'subject' => 'Gulshan Ads Mail',
                    'companyName' => $userData->company_name,
                    'text' => "আপনার আবেনকৃত সার্ভিস টি ক্রয় সফল হয়েছে I",
            ];
        
            \Mail::send('admin.adMail.successMail',$mail_data,function($message) use ($mail_data){
                $message->to($mail_data['email'])
                        ->from($mail_data['from_name'])
                        ->subject($mail_data['subject']);
                });

        return redirect()->route('service-buy-request')->with('message','Successfully Service Buy Confirmed');
    }

    public function serviceBuyRequestReject(Request $request,$id)
    {
        $data = BuyService::where('id',$request->service_buy_id)->first();
        $serviceData = Services::where('id',$data->service_id)->first();

        if ($data->status == 'Confirmed') {
            $user = User::where('id',$data->user_id)->first();
            $user->balance += $serviceData->price;
            $user->save();

            $data->status = 'Reject';
            $data->rejected_text = $request->rejected_text;
            $data->save();
        }else{
            $data->status = 'Reject';
            $data->rejected_text = $request->rejected_text;
            $data->save();
        }

        return redirect()->route('service-buy-request')->with('message','Successfully Service Buy Request Rejected');
    }


    public function serviceBuyRequestDelete($id)
    {
        $delete = BuyService::where('id',$id)->delete();
         return redirect()->route('service-buy-request')->with('message','Successfully Service Buy Request Deleted');
    }

}
