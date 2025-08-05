<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TiktokAdAccountRequest;
use App\Models\TiktokAdAccount;
use App\Models\TiktokAdAccountAppeal;
use App\Models\TiktokAdAccountTopUp;
use App\Models\TiktokAdAccountTransfer;
use App\Models\TiktokAdAccountReplace;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\BalanceTopUp;
use App\Models\BuyService;
use App\Models\Campaign;
use App\Models\TiktokAdAccountRenameRequest;
use App\Models\TimeZone;
use App\Models\BusinessType;
use App\Models\TiktokAdAccountFoundTransfer;
use App\Models\TiktokAdAccountBMLinkRequest;
use App\Models\TiktokAdAccountRefundRequest;
use App\Models\TiktokTryHoldRequest;
use App\Models\TiktokBillFailedRequest;

class TiktokAdAccountController extends Controller
{
    public function adAccountOverview()
    {   
        $accountCount = TiktokAdAccount::where('user_id',Auth::user()->id)->count();
        $buyServiceCount = BuyService::where('user_id',Auth::user()->id)->where('status','Confirmed')->count();
        $bmShareCount = TiktokAdAccountTransfer::where('user_id',Auth::user()->id)->where('status','Complete')->count();
        $disabledCount = TiktokAdAccountAppeal::where('user_id',Auth::user()->id)->where('status','Complete')->count();
        $replaceCount = TiktokAdAccountReplace::where('user_id',Auth::user()->id)->where('status','Complete')->count();
        $campaignCount = Campaign::where('user_id',Auth::user()->id)->where('status','Confirmed')->count();

        $topUpData = TiktokAdAccountTopUp::where('user_id',Auth::user()->id)->where('status','Complete')->get();

        $totalDepositAmount = 0;
        if(isset($topUpData)){
            foreach($topUpData as $result){
                $totalDepositAmount += $result->amount;
            }
        }

        return view('user.tiktokAdAccount.overview',compact('accountCount','buyServiceCount','bmShareCount','disabledCount','replaceCount','campaignCount','totalDepositAmount'));
    }

    public function adAccountRequestList()
    {   
        $accountRequestData = TiktokAdAccountRequest::where('user_id',Auth::user()->id)->get();
        return view('user.tiktokAdAccount.requestList',compact('accountRequestData'));
    } 

    public function createdAccount()
    {   
        $accountData = TiktokAdAccount::where('status','Created')->where('user_id',Auth::user()->id)->get();
        return view('user.tiktokAdAccount.createdAccount',compact('accountData'));
    }
    

    public function userAdAccountEdit($id)
    {   
        $accountData = TiktokAdAccount::where('id',$id)->first();
        return view('user.tiktokAdAccount.editAdAccount',compact('accountData'));
    }

    public function adAccountEditSubmit(Request $request,$id)
    {
        $request->validate([
            'facebook_page_url_1' => 'required',
            'website_url' => 'required',
            'business_manager_id' => 'required',
        ]);

        $data = $request->all();
        $account = TiktokAdAccount::where('id',$id)->first();

        if($account->update($data)){
            return redirect(route('tiktok-created-account'))->with('message','Successfully Ad Account Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }
    }


    public function userAdAccountRequestEdit($id)
    {   
        $accountData = TiktokAdAccountRequest::where('id',$id)->first();
        return view('user.tiktokAdAccount.editAdAccountRequest',compact('accountData'));
    }

    public function adAccountRequestEditSubmit(Request $request,$id)
    {
        $request->validate([
            'facebook_page_url_1' => 'required',
            'website_url' => 'required',
            'business_manager_id' => 'required',
        ]);

        $data = $request->all();
        $account = TiktokAdAccountRequest::where('id',$id)->first();

        if($account->update($data)){
            return redirect(route('tiktok-ad-account-overview'))->with('message','Successfully Ad Account Request Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }
    }



    public function adAccountRequest()
    {   
        $timeZoneData = TimeZone::get();
        $businessTypeData = BusinessType::get();
        return view('user.tiktokAdAccount.request',compact('timeZoneData','businessTypeData'));
    }

    public function adAccountRequestSubmit(Request $request)
    {
        $request->validate([
            'facebook_page_url_1' => 'required',
            'website_url' => 'required',
            'business_manager_id' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['status'] = 'Pending';

        if(TiktokAdAccountRequest::create($data)){
            return redirect()->route('home')->with('message','Ad account request successfully send');
        }else{
            return redirect()->back();
        }

    }

    public function adAccountTopUp()
    {   
        $accountData = TiktokAdAccount::where('user_id',Auth::user()->id)->where('status','Created')->get();
        return view('user.tiktokAdAccount.topUp',compact('accountData'));
    }

    public function adAccountTopUpSubmit(Request $request)
    {   
        $validatedata = '';
        foreach ($request->addMoreInputFields as $key => $value) {
            $validatedata = $value['amount'];

            if ($validatedata != '') {

                $totalAmount = 0;
                foreach ($request->addMoreInputFields as $key => $value) {
                    $totalAmount += $value['amount'];
                }
                $userData = User::where('id',Auth::user()->id)->first();

                if ($userData->balance >= $totalAmount) {
                    foreach ($request->addMoreInputFields as $key => $value) {

                    $check = TiktokAdAccountTopUp::where('ad_account_id',$value['ad_account_id'])->where('status','Pending')->first();

                        if ($check) {
                            
                        }else{
                            if ($value['amount'] != '') {
                                $data = new TiktokAdAccountTopUp();
                                $data->user_id = Auth::user()->id;
                                $data->ad_account_id = $value['ad_account_id'];
                                $data->amount = $value['amount'];
                                $data->note = $value['note'];
                                $data->save();
                            }
                        }
                    }
                    return redirect()->route('home')->with('message','Successfully Ad Account Balance TopUp');
                }else{
                    return redirect()->back()->with('error',"insufficiens balance!!");
                }
            }
        }

        return redirect()->back()->with('error','Please enter the data !!');

    }   

    public function adAccountFoundTransfer()
    {
        $accountData = TiktokAdAccount::where('user_id',Auth::user()->id)->where('status','Created')->get();
        return view('user.tiktokAdAccount.foundTransfer',compact('accountData'));
    }


     public function adAccountFoundTransferSubmit(Request $request)
    {
        
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['status'] = 'Pending';

        if(TiktokAdAccountFoundTransfer::create($data)){
            return redirect()->route('home')->with('message','Ad account found transfer successfully send');
        }else{
            return redirect()->back();
        }

    }


    public function adAccountTransfer()
    {   
        $accountData = TiktokAdAccount::where('user_id',Auth::user()->id)->where('status','Created')->get();
        return view('user.tiktokAdAccount.trasnfer',compact('accountData'));
    }

    public function adAccountTransferSubmit(Request $request)
    {   

        $validatedata = '';
        foreach ($request->addMoreInputFields as $key => $value) {
            $validatedata = $value['business_manager_id'];

            if ($validatedata != '') {
                foreach ($request->addMoreInputFields as $key => $value) {
                    if ($value['business_manager_id'] != '' && isset($value['transfer_or_share'])) {
                        $data = new TiktokAdAccountTransfer();
                        $data->user_id = Auth::user()->id;
                        $data->ad_account_id = $value['ad_account_id'];
                        $data->business_manager_id = $value['business_manager_id'];
                        $data->transfer_or_share = $value['transfer_or_share'];
                        $data->save();
                    }
                }

                return redirect()->route('home')->with('message','Successfully Ad Account Transfer Request Send');
            }
        }

        return redirect()->back()->with('error','Please enter the data !!');
    }


    public function adAccountAppeal()
    {   
        $accountData = TiktokAdAccount::where('user_id',Auth::user()->id)->where('status','Created')->get();
        return view('user.tiktokAdAccount.appeal',compact('accountData'));
    }

    public function adAccountAppealSubmit(Request $request)
    {   
        $request->validate([
            'ad_account_ids' => 'required',
        ]);

        foreach($request->ad_account_ids as $ad_account_id){
            $data = new TiktokAdAccountAppeal();
            $data->user_id = Auth::user()->id;
            $data->ad_account_id = $ad_account_id;
            $data->save();
        }

        return redirect()->route('home')->with('message','Successfully Appeal Send');
    }


    public function adAccountReplace()
    {   
        $accountData = TiktokAdAccount::where('user_id',Auth::user()->id)->where('status','Created')->get();
        return view('user.tiktokAdAccount.replace',compact('accountData'));
    }


    public function adAccountReplaceSubmit(Request $request)
    {   

        $validatedata = '';
        foreach ($request->addMoreInputFields as $key => $value) {
            $validatedata = $value['business_manager_id'];

            if ($validatedata != '') {
                foreach ($request->addMoreInputFields as $key => $value) {
                    if ($value['business_manager_id'] != '' && isset($value['screenshot_of_rejected_appeal']) ) {
                        $data = new TiktokAdAccountReplace();
                        $data->user_id = Auth::user()->id;
                        $data->ad_account_id = $value['ad_account_id'];
                        $data->business_manager_id = $value['business_manager_id'];
                        
                        if($value['screenshot_of_rejected_appeal']){
                            $file = $value['screenshot_of_rejected_appeal'];
                            $fileName = time().'.'.$file->getClientOriginalExtension();
                            $destinationPath = public_path('uploads/screenshot_of_rejected_appeal/');
                            $file->move($destinationPath,$fileName);
                            $data->screenshot_of_rejected_appeal = $fileName;
                        }
                        $data->save();
                    }
                }

                return redirect()->route('home')->with('message','Successfully Ad Account Replace Request Send');
            }
        }

        return redirect()->back()->with('error','Please enter the data !!');
    }


    public function adAccountRename()
    {   
        $accountData = TiktokAdAccount::where('user_id',Auth::user()->id)->where('status','Created')->get();
        return view('user.tiktokAdAccount.renameRequest',compact('accountData'));
    }

    public function adAccountRenameRequestSubmit(Request $request)
    {
        $request->validate([
            'ad_account_id' => 'required',
            'new_name' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['status'] = 'Pending';

        if(TiktokAdAccountRenameRequest::create($data)){
            return redirect()->route('home')->with('message','Ad account rname request successfully send');
        }else{
            return redirect()->back();
        }
    }
    

    public function adAccountBmLinkRequest()
    {
        return view('user.tiktokAdAccount.bmLinkRequest');
    }

    public function adAccountBmLinkRequestSubmit(Request $request)
    {
        $request->validate([
            'bm_name' => 'required',
        ]);

        $data = new TiktokAdAccountBMLinkRequest();
        $data->user_id = Auth::user()->id;
        $data->bm_name = $request->bm_name;
        $data->save();

        return redirect()->route('home')->with('message','Successfully BM Link Request Send');
    }


    public function adAccountRefundRequest()
    {   
        $accountData = TiktokAdAccount::where('status','Created')->where('user_id',Auth::user()->id)->get();
        return view('user.tiktokAdAccount.refundRequest',compact('accountData'));
    }

    public function adAccountRefundRequestSubmit(Request $request)
    {
        $request->validate([
            'ad_account_id' => 'required',
            'amount' => 'required',
        ]);

        $data = new TiktokAdAccountRefundRequest();
        $data->user_id = Auth::user()->id;
        $data->ad_account_id = $request->ad_account_id;
        $data->amount = $request->amount;
        $data->save();

        return redirect()->route('home')->with('message','Successfully Refund Request Send');
    }



    /*--- Try hold request-----*/
    public function adAccountTryHold()
    {   
        $accountData = TiktokAdAccount::where('user_id',Auth::user()->id)->where('status','Created')->get();
        return view('user.tiktokAdAccount.tryHold',compact('accountData'));
    }

    public function adAccountTryHoldSubmit(Request $request)
    {   
        $request->validate([
            'ad_account_ids' => 'required',
        ]);

        foreach($request->ad_account_ids as $ad_account_id){
            $data = new TiktokTryHoldRequest();
            $data->user_id = Auth::user()->id;
            $data->ad_account_id = $ad_account_id;
            $data->save();
        }

        return redirect()->route('home')->with('message','Successfully Try Hold Request Send');
    }



    /*---- bill failed request -------*/

    public function adAccountBillFailed()
    {   
        $accountData = TiktokAdAccount::where('user_id',Auth::user()->id)->where('status','Created')->get();
        return view('user.tiktokAdAccount.billFailed',compact('accountData'));
    }

    public function adAccountBillFailedSubmit(Request $request)
    {   
        $request->validate([
            'ad_account_ids' => 'required',
        ]);

        foreach($request->ad_account_ids as $ad_account_id){
            $data = new TiktokBillFailedRequest();
            $data->user_id = Auth::user()->id;
            $data->ad_account_id = $ad_account_id;
            $data->save();
        }

        return redirect()->route('home')->with('message','Successfully Bill Failed Request Send');
    }



}
