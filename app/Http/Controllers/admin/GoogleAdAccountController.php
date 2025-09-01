<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoogleAdAccount;
use App\Models\GoogleAdAccountTopUp;
use App\Models\GoogleAdAccountTransfer;
use App\Models\GoogleAdAccountRequest;
use App\Models\GoogleAdAccountAppeal;
use App\Models\GoogleAdAccountReplace;
use Carbon\Carbon;
use App\Models\User;
use Auth;
use App\Models\GoogleAdAccountSetting;
use App\Models\GoogleAdAccountRenameRequest;
use App\Models\GoogleAdAccountFoundTransfer;
use DateTime;
use DateTimezone;
use App\Models\GoogleAdAccountBMLinkRequest;
use App\Models\GoogleAdAccountRefundRequest;
use App\Models\GoogleTryHoldRequest;
use App\Models\GoogleBillFailedRequest;

class GoogleAdAccountController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:meta-ad-accounts,admin');
    }

    /*--------- Ad Account List Part -----------*/

    public function adAccountList()
    {   
        $adAccountData = GoogleAdAccount::orderBy('id','desc')->get();
        $userData = User::orderBy('id','desc')->get();
        return view('admin.googleAdAccount.adAccountList',compact('adAccountData','userData'));
    }

    public function adAccountMultipleReject(Request $request)
    {   
        if($request->adAccountIds != ''){
            foreach ($request->adAccountIds as $id) {
                $adAccount = GoogleAdAccount::where('id',$id)->first();
                $adAccount->status = 'Reject';
                $adAccount->save();
            }
            return redirect()->back()->with('Successfully account reject');
        }
    }

    public function adAccountDailySpending()
    {   
        $adAccountData = GoogleAdAccount::orderBy('id','desc')->get();
        return view('admin.googleAdAccount.spending',compact('adAccountData'));
    }

    public function adAccountCarD4Digit()
    {   
        $adAccountData = GoogleAdAccount::orderBy('id','desc')->get();
        return view('admin.googleAdAccount.card4Digit',compact('adAccountData'));
    }

    public function adAccountSocial()
    {   
        $adAccountData = GoogleAdAccount::orderBy('id','desc')->get();
        return view('admin.googleAdAccount.social',compact('adAccountData'));
    }

    public function adAccountBusinessManager()
    {   
        $adAccountData = GoogleAdAccount::orderBy('id','desc')->get();
        return view('admin.googleAdAccount.businessManager',compact('adAccountData'));
    }

    

    public function adAccountStatusFilter($data)
    {
        if ($data == 'Created') {
            $adAccountData = GoogleAdAccount::orderBy('id','desc')->where('status','Created')->get();
        }elseif($data == 'Pending'){
            $adAccountData = GoogleAdAccount::orderBy('id','desc')->where('status','Pending')->get();
        }elseif($data == 'Reject'){
            $adAccountData = GoogleAdAccount::orderBy('id','desc')->where('status','Reject')->get();
        }

        $userData = User::orderBy('id','desc')->get();
        $setting = GoogleAdAccountSetting::first();
        return view('admin.googleAdAccount.adAccountList',compact('adAccountData','userData','setting'));
    }

    public function adAccountSettings()
    {
        $setting = GoogleAdAccountSetting::first();
        return view('admin.googleAdAccount.adAccountSetting',compact('setting'));
    }

    public function adAccountSettingsSubmit(Request $request)
    {   

        $adAccountSetting = GoogleAdAccountSetting::first();
        $adAccountSetting->user = $request->user;
        $adAccountSetting->account_name = $request->account_name;
        $adAccountSetting->current_balance = $request->current_balance;
        $adAccountSetting->daily_limit = $request->daily_limit;
        $adAccountSetting->payment_threshold = $request->payment_threshold;
        $adAccountSetting->daily_spending_user = $request->daily_spending_user;
        $adAccountSetting->monthly_billing_date = $request->monthly_billing_date;
        $adAccountSetting->card_4_digit = $request->card_4_digit;
        $adAccountSetting->business_manager_id = $request->business_manager_id;
        $adAccountSetting->social = $request->social;
        $adAccountSetting->status = $request->status;
        $adAccountSetting->action = $request->action;
        $adAccountSetting->save();

        return redirect()->back()->with('message','Successfully Updated');

    }   

    public function adAccountStatusComplete($id)
    {   
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $current_time = $dt->format('Y-m-d g:i a');

        $adAccount = GoogleAdAccount::where('id',$id)->first();
        $adAccount->status = 'Created';
        $adAccount->confirmed_date = $current_time;
        $adAccount->save();

        return redirect()->route('google-ad-account-list')->with('message','Successfully Ad Account Created');
    }

    public function adAccountStatusReject(Request $request)
    {   
        $data = GoogleAdAccount::where('id',$request->ad_account_id)->first();
        $data->status = 'Reject';
        $data->rejected_text = $request->rejected_text;
        $data->save();

        return redirect()->route('google-ad-account-list')->with('message','Successfully Balance Reject');
    }

    public function editAdAccount($id)
    {
        $adAccount = GoogleAdAccount::where('id',$id)->first();
        $userData = User::orderBy('id','desc')->get();
        return view('admin.googleAdAccount.editAdAccount',compact('adAccount','userData'));
    }

    public function updateAdAccount(Request $request ,$id)
    {   
        $data = $request->all();

        if ($request->balance <= 10) {
            
            $user = User::where('id',$request->user_id)->first();


            $adAccount = GoogleAdAccount::where('id',$id)->first();        
            if($adAccount->update($data)){
                return redirect(route('google-ad-account-list'))->with('message','Successfully Ad Account Updated');
            }else{
                return redirect()->back()->with('error','Error !! Update Failed');
            }

        }else{
            $adAccount = GoogleAdAccount::where('id',$id)->first();        
            if($adAccount->update($data)){
                return redirect(route('google-ad-account-list'))->with('message','Successfully Ad Account Updated');
            }else{
                return redirect()->back()->with('error','Error !! Update Failed');
            }
        }

    }

    public function updateAccountNameUser(Request $request ,$id)
    {
        $data = $request->all();
        $adAccount = GoogleAdAccount::where('id',$id)->first();  

        if($adAccount->update($data)){
                return redirect(route('google-ad-account-list'))->with('message','Successfully Ad Account Updated');
            }else{
                return redirect()->back()->with('error','Error !! Update Failed');
        }
    }


    public function updateAccountData(Request $request)
    {
        if ($request->ajax()) {

            $data = GoogleAdAccount::where('id',$request->pk)->first();
            $data->ad_name = $request->value;
            $data->save();

            return response()->json(['success' => true]);

        }
    }

    public function updateAddAccountBalance(Request $request)
    {
        if ($request->ajax()) {

            $data = GoogleAdAccount::where('id',$request->pk)->first();
            $data->balance = $request->value;
            $data->save();

            return response()->json(['success' => true]);

        }
    }


     public function updateAccountBmi(Request $request)
    {
        if ($request->ajax()) {

            $data = GoogleAdAccount::where('id',$request->pk)->first();
            $data->business_manager_id = $request->value;
            $data->save();

            return response()->json(['success' => true]);

        }
    }

    


    /*--------- Ad Account Create Request Part -----------*/

    public function createAdAccount()
    {  
        $userData = User::orderBy('id','desc')->get();
        return view('admin.googleAdAccount.createManualAdAccount',compact('userData'));
    }

    public function manualCreateAdAccount(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'ad_name' => 'required',
            'ad_account_number' => 'required|unique:ad_accounts',
            'business_manager_id' => 'required',
        ]);

        $data = $request->all();
        $uniqueId = random_int(10000000000, 99999999999);
        
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $current_time = $dt->format('Y-m-d g:i a');

        $data['status'] = "Created";
        $data['confirmed_date'] = $current_time;

        if(GoogleAdAccount::create($data)){

            $user = User::where('id',$request->user_id)->first();

           return redirect()->back()->with('message','Successfully Ad Account Created');
        }else{
            return redirect()->back()->with('error','Error !! Added Failed');
        }
    }


    public function adAccountCreateRequest(){

        $adAccountRequestData = GoogleAdAccountRequest::orderBy('id','desc')->get();
        return view('admin.googleAdAccount.adAccountRequest',compact('adAccountRequestData'));
    }

    public function adAccountRequestStatusFilter($data){

        if ($data == 'Created') {
            $adAccountRequestData = GoogleAdAccountRequest::orderBy('id','desc')->where('status','Created')->get();
        }elseif($data == 'Pending'){
            $adAccountRequestData = GoogleAdAccountRequest::orderBy('id','desc')->where('status','Pending')->get();
        }elseif($data == 'Reject'){
            $adAccountRequestData = GoogleAdAccountRequest::orderBy('id','desc')->where('status','Reject')->get();
        }

        return view('admin.googleAdAccount.adAccountRequest',compact('adAccountRequestData'));
    }

    

    public function adAccountCreate($id)
    {   
        $adAccount = GoogleAdAccountRequest::where('id',$id)->first();
        $userData = User::orderBy('id','desc')->get();
        return view('admin.googleAdAccount.createAdAccount',compact('adAccount','userData'));
    }

    public function adAccountCreateSubmit(Request $request,$id)
    {
        $request->validate([
            'user_id' => 'required',
            'ad_name' => 'required',
            'ad_account_number' => 'required|unique:ad_accounts',
            'business_manager_id' => 'required',
        ]);

        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $current_time = $dt->format('Y-m-d g:i a');

        $data = $request->all();
        $uniqueId = random_int(10000000000, 99999999999);

        $data['status'] = "Created";
        $data['confirmed_date'] = $current_time;

        if(GoogleAdAccount::create($data)){
            $adAccountRequest = GoogleAdAccountRequest::where('id',$id)->first();
            $adAccountRequest->status = 'Created';
            $adAccountRequest->confirmed_date = $current_time;
            $adAccountRequest->save();

            $user = User::where('id',$request->user_id)->first();


           return redirect()->back()->with('message','Successfully Ad Account Created');
        }else{
            return redirect()->back()->with('error','Error !! Added Failed');
        }

    }

    public function adAccountRequestReject(Request $request)
    {
        $data = GoogleAdAccountRequest::where('id',$request->ad_account_request_id)->first();
        $data->status = 'Reject';
        $data->rejected_text = $request->rejected_text;
        $data->save();

        return redirect()->route('google-ad-account-create-request')->with('message','Successfully Ad Account Request Rejected');
    }




    /*--------- Ad Account TopUp Request Part -----------*/

    public function adAccountTopUpRequest()
    {   
        $adAccountTopUpData = GoogleAdAccountTopUp::orderBy('id','desc')->get();
        return view('admin.googleAdAccount.adAccountTopUpRequest',compact('adAccountTopUpData'));
    }

    public function adAccountTopUpStatusFilter($data)
    {   
        if ($data == 'Complete') {
            $adAccountTopUpData = GoogleAdAccountTopUp::orderBy('id','desc')->where('status','Complete')->get();
        }elseif($data == 'Pending'){
            $adAccountTopUpData = GoogleAdAccountTopUp::orderBy('id','desc')->where('status','Pending')->get();
        }elseif($data == 'Reject'){
            $adAccountTopUpData = GoogleAdAccountTopUp::orderBy('id','desc')->where('status','Reject')->get();
        }

        return view('admin.googleAdAccount.adAccountTopUpRequest',compact('adAccountTopUpData'));
    }


    public function adAccountTopUpRequestComplete($id)
    {
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $current_time = $dt->format('Y-m-d g:i a');

        $adAccountTopUp = GoogleAdAccountTopUp::where('id',$id)->first();

        if ($adAccountTopUp->status == 'Complete') {
            return redirect()->route('google-ad-account-top-up-request');
        }else{
            $user = User::where('id',$adAccountTopUp->user_id)->first();
            $user->balance -= $adAccountTopUp->amount;
            $user->save();

            $adAccountTopUp->status = 'Complete';
            $adAccountTopUp->confirmed_date = $current_time;
            $adAccountTopUp->save();

            $adAccountData = GoogleAdAccount::where('id',$adAccountTopUp->ad_account_id)->first();

            return redirect()->back()->with('message','Successfully Ad Account TopUp Complete');
        }

        
    }
    

    public function adAccountTopUpRequestReject($id)
    {
        $data = GoogleAdAccountTopUp::where('id',$id)->first();

        if ($data->status == 'Complete') {
            $user = User::where('id',$data->user_id)->first();
            $user->balance += $data->amount;
            $user->save();

            $data->status = 'Reject';
            $data->save();
        }else{
            $data->status = 'Reject';
            $data->save();
        }

        return redirect()->back()->with('message','Successfully Ad Account TopUp Request Rejected');
    }


    public function adAccountTopUpRequestDelete($id)
    {
        $delete = GoogleAdAccountTopUp::where('id',$id)->delete();
        return redirect()->route('google-ad-account-top-up-request')->with('message','Successfully Ad Account TopUp Request Deleted');
    }

    public function adAccountTopUpRequestEdit($id)
    {
        $adAccountTopUpData = GoogleAdAccountTopUp::where('id',$id)->first();
        $adAccount = GoogleAdAccount::where('user_id',$adAccountTopUpData->user_id)->where('status','Complete')->get();
        return view('admin.googleAdAccount.adAccountTopUpRequestEdit',compact('adAccountTopUpData','adAccount'));
    }

    public function adAccountTopUpRequestUpdate(Request $request,$id)
    {
        $request->validate([
            'amount' => 'required',
        ]);

        $adAccountTopUpData = GoogleAdAccountTopUp::where('id',$id)->first();
        $adAccountTopUpData->amount = $request->amount;
        $adAccountTopUpData->note = $request->note;
        $adAccountTopUpData->save();

        return redirect()->route('google-ad-account-top-up-request')->with('message','Successfully Ad Account TopUp Request Updated');
    }


     /*--------- Ad Account Found Transfer Request Part -----------*/

    public function adAccountFoundTransferRequest()
    {   
        $adAccountFoundTransferData = GoogleAdAccountFoundTransfer::orderBy('id','desc')->get();
        return view('admin.googleAdAccount.adAccountFoundTransferRequest',compact('adAccountFoundTransferData'));
    }
    
    public function adAccountFoundTransferRequestComplete($id)
    {
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $current_time = $dt->format('Y-m-d g:i a');

        $adAccountFoundTransfer = GoogleAdAccountFoundTransfer::where('id',$id)->first();

        if ($adAccountFoundTransfer->status == 'Complete') {
           return redirect()->back();
        }else{
            $adAccountFoundTransfer->status = 'Complete';
            $adAccountFoundTransfer->confirmed_date = $current_time;
            $adAccountFoundTransfer->save();

            return redirect()->back()->with('message','Successfully Ad Account Fund Transfer Complete');
        }

    }

    public function adAccountFoundTransferRequestReject(Request $request,$id)
    {
        $data = GoogleAdAccountFoundTransfer::where('id',$request->ad_account_found_transfer_id)->first();
        $data->status = 'Reject';
        $data->rejected_text = $request->rejected_text;
        $data->save();

        return redirect()->route('google-ad-account-found-transfer-request')->with('message','Successfully Ad Account Found Request Rejected');
    }

    public function adAccountFoundTransferRequestDelete($id)
    {
        $delete = GoogleAdAccountFoundTransfer::where('id',$id)->delete();
        return redirect()->route('google-ad-account-found-transfer-request')->with('message','Successfully Ad Account Found Transfer Request Deleted');
    }


    /*--------- Ad Account Transfer Request Part -----------*/

    public function adAccountTransferRequest()
    {   
        $adAccountTransferData = GoogleAdAccountTransfer::orderBy('id','desc')->get();
        return view('admin.googleAdAccount.adAccountTransferRequest',compact('adAccountTransferData'));
    }

    public function adAccountTransferStatusFilter($data)
    {   
        if ($data == 'Complete') {
            $adAccountTransferData = GoogleAdAccountTransfer::orderBy('id','desc')->where('status','Complete')->get();
        }elseif($data == 'Pending'){
            $adAccountTransferData = GoogleAdAccountTransfer::orderBy('id','desc')->where('status','Pending')->get();
        }elseif($data == 'Reject'){
            $adAccountTransferData = GoogleAdAccountTransfer::orderBy('id','desc')->where('status','Reject')->get();
        }

        return view('admin.googleAdAccount.adAccountTransferRequest',compact('adAccountTransferData'));
    }


    public function adAccountTransferRequestComplete($id)
    {
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $current_time = $dt->format('Y-m-d g:i a');

        $adAccountTransfer = GoogleAdAccountTransfer::where('id',$id)->first();
        $adAccountTransfer->status = 'Complete';
        $adAccountTransfer->confirmed_date = $current_time;
        $adAccountTransfer->save();

        $user = User::where('id',$adAccountTransfer->user_id)->first();
        $adAccountData = GoogleAdAccount::where('id',$adAccountTransfer->ad_account_id)->first();

        return redirect()->back()->with('message','Successfully Ad Account Transfer Complete');
    }

    public function adAccountTransferRequestReject(Request $request,$id)
    {
        $data = GoogleAdAccountTransfer::where('id',$request->ad_account_transfer_id)->first();
        $data->status = 'Reject';
        $data->rejected_text = $request->rejected_text;
        $data->save();

        return redirect()->back()->with('message','Successfully Ad Account TopUp Request Rejected');
    }

    public function adAccountTransferRequestDelete($id)
    {
        $delete = GoogleAdAccountTransfer::where('id',$id)->delete();
        return redirect()->route('google-ad-account-transfer-request')->with('message','Successfully Ad Account Transfer Request Deleted');
    }



    /*--------- Ad Account Appeal Request Part -----------*/

    public function adAccountAppealRequest()
    {   
        $adAccountAppealData = GoogleAdAccountAppeal::orderBy('id','desc')->get();
        return view('admin.googleAdAccount.adAccountAppealRequest',compact('adAccountAppealData'));
    }

    public function adAccountAppealStatusFilter($data)
    {   
        if ($data == 'Complete') {
            $adAccountAppealData = GoogleAdAccountAppeal::orderBy('id','desc')->where('status','Complete')->get();
        }elseif($data == 'Pending'){
            $adAccountAppealData = GoogleAdAccountAppeal::orderBy('id','desc')->where('status','Pending')->get();
        }elseif($data == 'Reject'){
            $adAccountAppealData = GoogleAdAccountAppeal::orderBy('id','desc')->where('status','Reject')->get();
        }

        return view('admin.googleAdAccount.adAccountAppealRequest',compact('adAccountAppealData'));
    }


    public function adAccountAppealRequestDelete($id)
    {
        $delete = GoogleAdAccountAppeal::where('id',$id)->delete();
        return redirect()->route('tiktok-ad-account-appeal-request')->with('message','Successfully Ad Account Appeal Request Deleted');
    }

    public function adAccountAppealRequestComplete($id)
    {
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $current_time = $dt->format('Y-m-d g:i a');

        $adAccountAppeal = GoogleAdAccountAppeal::where('id',$id)->first();
        $adAccountAppeal->status = 'Complete';
        $adAccountAppeal->confirmed_date = $current_time;
        $adAccountAppeal->save();

        $user = User::where('id',$adAccountAppeal->user_id)->first();
        $adAccountData = GoogleAdAccount::where('id',$adAccountAppeal->ad_account_id)->first();

        return redirect()->back()->with('message','Successfully Ad Account Appeal Complete');
    }

    public function adAccountAppealRequestReject(Request $request,$id)
    {
        $data = GoogleAdAccountAppeal::where('id',$request->ad_account_appeal_id)->first();
        $data->status = 'Reject';
        $data->rejected_text = $request->rejected_text;
        $data->save();

        return redirect()->route('google-ad-account-appeal-request')->with('message','Successfully Ad Account Appeal Request Rejected');
    }




    /*--------- Ad Account Replace Request Part -----------*/

    public function adAccountReplaceRequest()
    {   
        $adAccountReplaceData = GoogleAdAccountReplace::orderBy('id','desc')->get();
        return view('admin.googleAdAccount.adAccountReplaceRequest',compact('adAccountReplaceData'));
    }

    public function adAccountReplaceStatusFilter($data)
    {   
        if ($data == 'Complete') {
            $adAccountReplaceData = GoogleAdAccountReplace::orderBy('id','desc')->where('status','Complete')->get();
        }elseif($data == 'Pending'){
            $adAccountReplaceData = GoogleAdAccountReplace::orderBy('id','desc')->where('status','Pending')->get();
        }elseif($data == 'Reject'){
            $adAccountReplaceData = GoogleAdAccountReplace::orderBy('id','desc')->where('status','Reject')->get();
        }

        return view('admin.googleAdAccount.adAccountReplaceRequest',compact('adAccountReplaceData'));
    }

    
    public function adAccountReplaceRequestDelete($id)
    {
        $delete = GoogleAdAccountReplace::where('id',$id)->delete();
        return redirect()->route('google-ad-account-replace-request')->with('message','Successfully Ad Account Replace Request Deleted');
    }

    public function adAccountReplaceRequestComplete($id)
    {
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $current_time = $dt->format('Y-m-d g:i a');

        $adAccountReplace = GoogleAdAccountReplace::where('id',$id)->first();
        $adAccountReplace->status = 'Complete';
        $adAccountReplace->confirmed_date = $current_time;
        $adAccountReplace->save();

        $user = User::where('id',$adAccountReplace->user_id)->first();
        $adAccountData = GoogleAdAccount::where('id',$adAccountReplace->ad_account_id)->first();

        return redirect()->back()->with('message','Successfully Ad Account Replace Complete');
    }

    public function adAccountReplaceRequestReject(Request $request,$id)
    {
        $data = GoogleAdAccountReplace::where('id',$request->ad_account_replace_id)->first();
        $data->status = 'Reject';
        $data->rejected_text = $request->rejected_text;
        $data->save();

        return redirect()->route('google-ad-account-replace-request')->with('message','Successfully Ad Account Replace Request Rejected');
    }



    /*--------- Ad Account Rename Request Part -----------*/

    public function adAccountRenameRequest()
    {   
        $adAccountRenameData = GoogleAdAccountRenameRequest::orderBy('id','desc')->get();
        return view('admin.googleAdAccount.adAccountRenameRequest',compact('adAccountRenameData'));
    }

    public function adAccountRenameStatusFilter($data)
    {   
        if ($data == 'Complete') {
            $adAccountRenameData = GoogleAdAccountRenameRequest::orderBy('id','desc')->where('status','Complete')->get();
        }elseif($data == 'Pending'){
            $adAccountRenameData = GoogleAdAccountRenameRequest::orderBy('id','desc')->where('status','Pending')->get();
        }elseif($data == 'Reject'){
            $adAccountRenameData = GoogleAdAccountRenameRequest::orderBy('id','desc')->where('status','Reject')->get();
        }

        return view('admin.googleAdAccount.adAccountRenameRequest',compact('adAccountRenameData'));
    }
    
    
    public function adAccountRenameRequestDelete($id)
    {
        $delete = GoogleAdAccountRenameRequest::where('id',$id)->delete();
        return redirect()->route('google-ad-account-rename-request')->with('message','Successfully Ad Account Rename Request Deleted');
    }

    public function adAccountRenameRequestComplete(Request $request,$id)
    {
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $current_time = $dt->format('Y-m-d g:i a');

        $adAccountRenameRequest = GoogleAdAccountRenameRequest::where('id',$id)->first();
        $adAccountRenameRequest->status = 'Complete';
        $adAccountRenameRequest->confirmed_date = $current_time;
        $adAccountRenameRequest->save();

        $user = User::where('id',$adAccountRenameRequest->user_id)->first();
        
        $adAccountData = GoogleAdAccount::where('id',$adAccountRenameRequest->ad_account_id)->first();
        $adAccountData->ad_name = $request->ad_name;
        $adAccountData->save();

        return redirect()->back()->with('message','Successfully Ad Account Rename Complete');
    }

    public function adAccountRenameRequestReject(Request $request,$id)
    {
        $data = GoogleAdAccountRenameRequest::where('id',$request->ad_account_rename_id)->first();
        $data->status = 'Reject';
        $data->rejected_text = $request->rejected_text;
        $data->save();

        return redirect()->route('google-ad-account-rename-request')->with('message','Successfully Ad Account Rename Request Rejected');
    }


    /*--------- Ad Account BM Link Request Part -----------*/

    public function adAccountBMLinkRequestView()
    {
        $adAccountBMLinkData = GoogleAdAccountBMLinkRequest::orderBy('id','desc')->get();
        return view('admin.tiktokAdAccount.adAccountBMLinkRequest',compact('adAccountBMLinkData'));
    }

    public function adAccountBmLinkReply(Request $request,$id)
    {
        $adAccountBMLink = GoogleAdAccountBMLinkRequest::where('id',$id)->first();
        $adAccountBMLink->status = 'Complete';
        $adAccountBMLink->reply = $request->reply;
        $adAccountBMLink->save();

        return redirect()->back()->with('message','Successfully BM Link Send');
    }

    public function adAccountBmLinkRequestDelete($id)
    {
         $delete = GoogleAdAccountBMLinkRequest::where('id',$id)->delete();
         return redirect()->back()->with('message','Successfully Ad Account BM Link Request Deleted');
    }


    /*--------- Ad Account Refund Request Part -----------*/
    public function adAccountRefundRequestView()
    {
        $adAccountRefundData = GoogleAdAccountRefundRequest::orderBy('id','desc')->get();
        return view('admin.googleAdAccount.adAccountRefundRequest',compact('adAccountRefundData'));
    }

    public function adAccountRefundRequestComplete($id)
    {   
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $current_time = $dt->format('Y-m-d g:i a');

        $adAccountRefund = GoogleAdAccountRefundRequest::where('id',$id)->first();

        if ($adAccountRefund->status == 'Complete') {
           return redirect()->back();
        }else{

        $adAccountRefund->status = 'Complete';
        $adAccountRefund->confirmed_date = $current_time;
        $adAccountRefund->save();

        $user = User::where('id',$adAccountRefund->user_id)->first();
        $user->balance += $adAccountRefund->amount;
        $user->save();
       
        return redirect()->back()->with('message','Successfully Ad Account Refund Complete');
        }
    }


    public function adAccountRefundRequestReject(Request $request,$id)
    {
        $data = GoogleAdAccountRefundRequest::where('id',$id)->first();
        if ($data->status == 'Complete') {
            $user = User::where('id',$data->user_id)->first();
            $user->balance -= $data->amount;
            $user->save();
            
            $data->status = 'Reject';
            $data->rejected_text = $request->rejected_text;
            $data->save();

            return redirect()->back()->with('message','Successfully Ad Account Refund Request Rejected');

        }else{

            $data->status = 'Reject';
            $data->rejected_text = $request->rejected_text;
            $data->save();

            return redirect()->back()->with('message','Successfully Ad Account Refund Request Rejected');
        }
    }


    public function adAccountRefundRequestDelete($id)
    {
        $delete = GoogleAdAccountRefundRequest::where('id',$id)->delete();
         return redirect()->back()->with('message','Successfully Ad Account Refund Request Deleted');
    }
    

    public function adAccountRefundStatusFilter($data)
    {   
        if ($data == 'Complete') {
            $adAccountRefundData = GoogleAdAccountRefundRequest::orderBy('id','desc')->where('status','Complete')->get();
        }elseif($data == 'Pending'){
            $adAccountRefundData = GoogleAdAccountRefundRequest::orderBy('id','desc')->where('status','Pending')->get();
        }elseif($data == 'Reject'){
            $adAccountRefundData = GoogleAdAccountRefundRequest::orderBy('id','desc')->where('status','Reject')->get();
        }

        return view('admin.googleAdAccount.adAccountRefundRequest',compact('adAccountRefundData'));
    }



    /*--------- Ad Account Try Hold Request Part -----------*/

    public function adAccountTryHoldRequest()
    {   
        $adAccountTryHoldData = GoogleTryHoldRequest::orderBy('id','desc')->get();
        return view('admin.googleAdAccount.adAccountTryHold',compact('adAccountTryHoldData'));
    }

    public function adAccountTryHoldStatusFilter($data)
    {   
        if ($data == 'Complete') {
            $adAccountTryHoldData = GoogleTryHoldRequest::orderBy('id','desc')->where('status','Complete')->get();
        }elseif($data == 'Pending'){
            $adAccountTryHoldData = GoogleTryHoldRequest::orderBy('id','desc')->where('status','Pending')->get();
        }elseif($data == 'Reject'){
            $adAccountTryHoldData = GoogleTryHoldRequest::orderBy('id','desc')->where('status','Reject')->get();
        }

        return view('admin.googleAdAccount.adAccountTryHold',compact('adAccountTryHoldData'));
    }


    public function adAccountTryHoldRequestDelete($id)
    {
        $delete = GoogleTryHoldRequest::where('id',$id)->delete();
        return redirect()->route('google-ad-account-try-hold-request')->with('message','Successfully Ad Account Try Hold Request Deleted');
    }

    public function adAccountTryHoldRequestComplete($id)
    {
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $current_time = $dt->format('Y-m-d g:i a');

        $adAccountAppeal = GoogleTryHoldRequest::where('id',$id)->first();
        $adAccountAppeal->status = 'Complete';
        $adAccountAppeal->confirmed_date = $current_time;
        $adAccountAppeal->save();

        $user = User::where('id',$adAccountAppeal->user_id)->first();
        $adAccountData = GoogleAdAccount::where('id',$adAccountAppeal->ad_account_id)->first();

        return redirect()->back()->with('message','Successfully Ad Account Try Hold Complete');
    }

    public function adAccountTryHoldRequestReject(Request $request,$id)
    {
        $data = GoogleTryHoldRequest::where('id',$request->ad_account_appeal_id)->first();
        $data->status = 'Reject';
        $data->rejected_text = $request->rejected_text;
        $data->save();

        return redirect()->route('google-ad-account-try-hold-request')->with('message','Successfully Ad Account Try Hold Request Rejected');
    }


    /*--------- Ad Account Bill Failed Request Part -----------*/

    public function adAccountBillFailedRequest()
    {   
        $adAccountBillFailedData = GoogleBillFailedRequest::orderBy('id','desc')->get();
        return view('admin.googleAdAccount.adAccountBillFailed',compact('adAccountBillFailedData'));
    }

    public function adAccountBillFailedStatusFilter($data)
    {   
        if ($data == 'Complete') {
            $adAccountBillFailedData = GoogleBillFailedRequest::orderBy('id','desc')->where('status','Complete')->get();
        }elseif($data == 'Pending'){
            $adAccountBillFailedData = GoogleBillFailedRequest::orderBy('id','desc')->where('status','Pending')->get();
        }elseif($data == 'Reject'){
            $adAccountBillFailedData = GoogleBillFailedRequest::orderBy('id','desc')->where('status','Reject')->get();
        }

        return view('admin.googleAdAccount.adAccountBillFailed',compact('adAccountBillFailedData'));
    }


    public function adAccountBillFailedRequestDelete($id)
    {
        $delete = GoogleBillFailedRequest::where('id',$id)->delete();
        return redirect()->route('google-ad-account-bill-failed-request')->with('message','Successfully Ad Account Bill Failed Request Deleted');
    }

    public function adAccountBillFailedRequestComplete($id)
    {
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $current_time = $dt->format('Y-m-d g:i a');

        $adAccountAppeal = GoogleBillFailedRequest::where('id',$id)->first();
        $adAccountAppeal->status = 'Complete';
        $adAccountAppeal->confirmed_date = $current_time;
        $adAccountAppeal->save();

        $user = User::where('id',$adAccountAppeal->user_id)->first();
        $adAccountData = GoogleAdAccount::where('id',$adAccountAppeal->ad_account_id)->first();

        return redirect()->back()->with('message','Successfully Ad Account Bill Failed Complete');
    }

    public function adAccountBillFailedRequestReject(Request $request,$id)
    {
        $data = GoogleBillFailedRequest::where('id',$request->ad_account_appeal_id)->first();
        $data->status = 'Reject';
        $data->rejected_text = $request->rejected_text;
        $data->save();

        return redirect()->route('google-ad-account-bill-failed-request')->with('message','Successfully Ad Account Bill Failed Request Rejected');
    }
}
