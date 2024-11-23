<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdAccount;
use App\Models\AdAccountTopUp;
use App\Models\AdAccountTransfer;
use App\Models\AdAccountRequest;
use App\Models\AdAccountAppeal;
use App\Models\AdAccountReplace;
use Carbon\Carbon;
use App\Models\User;
use Auth;
use App\Models\AdAccountSetting;
use App\Models\AdAccountRenameRequest;
use App\Models\AdAccountFoundTransfer;
use DateTime;
use DateTimezone;
use App\Models\AdAccountBMLinkRequest;
use App\Models\AdAccountRefundRequest;
use App\Models\TryHoldRequest;
use App\Models\BillFailedRequest;

class AdAccountController extends Controller
{   
    function __construct()
    {
         $this->middleware('permission:meta-ad-accounts,admin');
    }

    /*--------- Ad Account List Part -----------*/

    public function adAccountList()
    {   
        $adAccountData = AdAccount::orderBy('id','desc')->get();
        $userData = User::orderBy('id','desc')->get();
        return view('admin.adAccount.adAccountList',compact('adAccountData','userData'));
    }

    public function adAccountMultipleReject(Request $request)
    {   
        if($request->adAccountIds != ''){
            foreach ($request->adAccountIds as $id) {
                $adAccount = AdAccount::where('id',$id)->first();
                $adAccount->status = 'Reject';
                $adAccount->save();
            }
            return redirect()->back()->with('Successfully account reject');
        }
    }

    public function adAccountDailySpending()
    {   
        $adAccountData = AdAccount::orderBy('id','desc')->get();
        return view('admin.adAccount.spending',compact('adAccountData'));
    }

    public function adAccountCarD4Digit()
    {   
        $adAccountData = AdAccount::orderBy('id','desc')->get();
        return view('admin.adAccount.card4Digit',compact('adAccountData'));
    }

    public function adAccountSocial()
    {   
        $adAccountData = AdAccount::orderBy('id','desc')->get();
        return view('admin.adAccount.social',compact('adAccountData'));
    }

    public function adAccountBusinessManager()
    {   
        $adAccountData = AdAccount::orderBy('id','desc')->get();
        return view('admin.adAccount.businessManager',compact('adAccountData'));
    }

    

    public function adAccountStatusFilter($data)
    {
        if ($data == 'Created') {
            $adAccountData = AdAccount::orderBy('id','desc')->where('status','Created')->get();
        }elseif($data == 'Pending'){
            $adAccountData = AdAccount::orderBy('id','desc')->where('status','Pending')->get();
        }elseif($data == 'Reject'){
            $adAccountData = AdAccount::orderBy('id','desc')->where('status','Reject')->get();
        }

        $userData = User::orderBy('id','desc')->get();
        $setting = AdAccountSetting::first();
        return view('admin.adAccount.adAccountList',compact('adAccountData','userData','setting'));
    }

    public function adAccountSettings()
    {
        $setting = AdAccountSetting::first();
        return view('admin.adAccount.adAccountSetting',compact('setting'));
    }

    public function adAccountSettingsSubmit(Request $request)
    {   

        $adAccountSetting = AdAccountSetting::first();
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

        $adAccount = AdAccount::where('id',$id)->first();
        $adAccount->status = 'Created';
        $adAccount->confirmed_date = $current_time;
        $adAccount->save();

        return redirect()->route('ad-account-list')->with('message','Successfully Ad Account Created');
    }

    public function adAccountStatusReject(Request $request)
    {   
        $data = AdAccount::where('id',$request->ad_account_id)->first();
        $data->status = 'Reject';
        $data->rejected_text = $request->rejected_text;
        $data->save();

        return redirect()->route('ad-account-list')->with('message','Successfully Balance Reject');
    }

    public function editAdAccount($id)
    {
        $adAccount = AdAccount::where('id',$id)->first();
        $userData = User::orderBy('id','desc')->get();
        return view('admin.adAccount.editAdAccount',compact('adAccount','userData'));
    }

    public function updateAdAccount(Request $request ,$id)
    {   
        $data = $request->all();

        if ($request->balance <= 10) {
            
            $user = User::where('id',$request->user_id)->first();

            /*$mail_data = [
                    'email' => $user->email,
                    'from_name' => 'gulshanadspro@gmail.com',
                    'subject' => 'Gulshan Ads Mail',
                    'companyName' => $user->company_name,
                    'text' => "আপনার রিচার্জকৃত ব্যালান্স ইতমধ্যে শেষ হতে চলছে I (১০$ এর কম আছে ব্যালান্স ) অনুগ্রহ করে রিচার্জ করে নিন অন্যথায় আপনার বিজ্ঞাপনের রেসপন্স ভালো পেতে সমস্যা হতে পারে I",
            ];
        
            \Mail::send('admin.adMail.successMail',$mail_data,function($message) use ($mail_data){
                $message->to($mail_data['email'])
                        ->from($mail_data['from_name'])
                        ->subject($mail_data['subject']);
                });*/

            $adAccount = AdAccount::where('id',$id)->first();        
            if($adAccount->update($data)){
                return redirect(route('ad-account-list'))->with('message','Successfully Ad Account Updated');
            }else{
                return redirect()->back()->with('error','Error !! Update Failed');
            }

        }else{
            $adAccount = AdAccount::where('id',$id)->first();        
            if($adAccount->update($data)){
                return redirect(route('ad-account-list'))->with('message','Successfully Ad Account Updated');
            }else{
                return redirect()->back()->with('error','Error !! Update Failed');
            }
        }

    }

    public function updateAccountNameUser(Request $request ,$id)
    {
        $data = $request->all();
        $adAccount = AdAccount::where('id',$id)->first();  

        if($adAccount->update($data)){
                return redirect(route('ad-account-list'))->with('message','Successfully Ad Account Updated');
            }else{
                return redirect()->back()->with('error','Error !! Update Failed');
        }
    }


    public function updateAccountData(Request $request)
    {
        if ($request->ajax()) {

            $data = AdAccount::where('id',$request->pk)->first();
            $data->ad_name = $request->value;
            $data->save();

            return response()->json(['success' => true]);

        }
    }

    public function updateAddAccountBalance(Request $request)
    {
        if ($request->ajax()) {

            $data = AdAccount::where('id',$request->pk)->first();
            $data->balance = $request->value;
            $data->save();

            return response()->json(['success' => true]);

        }
    }


     public function updateAccountBmi(Request $request)
    {
        if ($request->ajax()) {

            $data = AdAccount::where('id',$request->pk)->first();
            $data->business_manager_id = $request->value;
            $data->save();

            return response()->json(['success' => true]);

        }
    }

    


    /*--------- Ad Account Create Request Part -----------*/

    public function createAdAccount()
    {  
        $userData = User::orderBy('id','desc')->get();
        return view('admin.adAccount.createManualAdAccount',compact('userData'));
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

        if(AdAccount::create($data)){

            $user = User::where('id',$request->user_id)->first();

            $mail_data = [
                    'email' => $user->email,
                    'from_name' => 'gulshanadspro@gmail.com',
                    'subject' => 'Gulshan Ads Mail',
                    'companyName' => $user->company_name,
                    'text' => "আপনার এড $request->ad_name ( $request->ad_account_number ) দেয়া হইলো I অনুগ্রহ করে যাচাই করে নিন আপনার বিজনেস ম্যানেজারে আসছে কিনা যদি না আসে আমাদের সাথে যোগাযোগ করুন I",
            ];
        
            \Mail::send('admin.adMail.successMail',$mail_data,function($message) use ($mail_data){
                $message->to($mail_data['email'])
                        ->from($mail_data['from_name'])
                        ->subject($mail_data['subject']);
                });

           return redirect()->back()->with('message','Successfully Ad Account Created');
        }else{
            return redirect()->back()->with('error','Error !! Added Failed');
        }
    }


    public function adAccountCreateRequest(){

        $adAccountRequestData = AdAccountRequest::orderBy('id','desc')->get();
        return view('admin.adAccount.adAccountRequest',compact('adAccountRequestData'));
    }

    public function adAccountRequestStatusFilter($data){

        if ($data == 'Created') {
            $adAccountRequestData = AdAccountRequest::orderBy('id','desc')->where('status','Created')->get();
        }elseif($data == 'Pending'){
            $adAccountRequestData = AdAccountRequest::orderBy('id','desc')->where('status','Pending')->get();
        }elseif($data == 'Reject'){
            $adAccountRequestData = AdAccountRequest::orderBy('id','desc')->where('status','Reject')->get();
        }

        return view('admin.adAccount.adAccountRequest',compact('adAccountRequestData'));
    }

    

    public function adAccountCreate($id)
    {   
        $adAccount = AdAccountRequest::where('id',$id)->first();
        $userData = User::orderBy('id','desc')->get();
        return view('admin.adAccount.createAdAccount',compact('adAccount','userData'));
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

        if(AdAccount::create($data)){
            $adAccountRequest = AdAccountRequest::where('id',$id)->first();
            $adAccountRequest->status = 'Created';
            $adAccountRequest->confirmed_date = $current_time;
            $adAccountRequest->save();

            $user = User::where('id',$request->user_id)->first();

            $mail_data = [
                    'email' => $user->email,
                    'from_name' => 'gulshanadspro@gmail.com',
                    'subject' => 'Gulshan Ads Mail',
                    'companyName' => $user->company_name,
                    'text' => "আপনার আবেনকৃত এড $request->ad_name ( $request->ad_account_number ) দেয়া হইলো I অনুগ্রহ করে যাচাই করে নিন আপনার বিজনেস ম্যানেজারে আসছে কিনা যদি না আসে আমাদের সাথে যোগাযোগ করুন I",
            ];
        
            \Mail::send('admin.adMail.successMail',$mail_data,function($message) use ($mail_data){
                $message->to($mail_data['email'])
                        ->from($mail_data['from_name'])
                        ->subject($mail_data['subject']);
                });


           return redirect()->back()->with('message','Successfully Ad Account Created');
        }else{
            return redirect()->back()->with('error','Error !! Added Failed');
        }

    }

    public function adAccountRequestReject(Request $request)
    {
        $data = AdAccountRequest::where('id',$request->ad_account_request_id)->first();
        $data->status = 'Reject';
        $data->rejected_text = $request->rejected_text;
        $data->save();

        return redirect()->route('ad-account-create-request')->with('message','Successfully Ad Account Request Rejected');
    }




    /*--------- Ad Account TopUp Request Part -----------*/

    public function adAccountTopUpRequest()
    {   
        $adAccountTopUpData = AdAccountTopUp::orderBy('id','desc')->get();
        return view('admin.adAccount.adAccountTopUpRequest',compact('adAccountTopUpData'));
    }

    public function adAccountTopUpStatusFilter($data)
    {   
        if ($data == 'Complete') {
            $adAccountTopUpData = AdAccountTopUp::orderBy('id','desc')->where('status','Complete')->get();
        }elseif($data == 'Pending'){
            $adAccountTopUpData = AdAccountTopUp::orderBy('id','desc')->where('status','Pending')->get();
        }elseif($data == 'Reject'){
            $adAccountTopUpData = AdAccountTopUp::orderBy('id','desc')->where('status','Reject')->get();
        }

        return view('admin.adAccount.adAccountTopUpRequest',compact('adAccountTopUpData'));
    }


    public function adAccountTopUpRequestComplete($id)
    {
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $current_time = $dt->format('Y-m-d g:i a');

        $adAccountTopUp = AdAccountTopUp::where('id',$id)->first();

        if ($adAccountTopUp->status == 'Complete') {
            return redirect()->route('ad-account-top-up-request');
        }else{
            $user = User::where('id',$adAccountTopUp->user_id)->first();
            $user->balance -= $adAccountTopUp->amount;
            $user->save();

            $adAccountTopUp->status = 'Complete';
            $adAccountTopUp->confirmed_date = $current_time;
            $adAccountTopUp->save();

            $adAccountData = AdAccount::where('id',$adAccountTopUp->ad_account_id)->first();

            $mail_data = [
                    'email' => $user->email,
                    'from_name' => 'gulshanadspro@gmail.com',
                    'subject' => 'Gulshan Ads Mail',
                    'companyName' => $user->company_name,
                    'topupAmount' => $adAccountTopUp->amount,
                    'text' => "আপনার আবেনকৃত এড $adAccountData->ad_name ( $adAccountData->ad_account_number ) এ ( $adAccountTopUp->amount ) রিচার্জ সফল হয়েছে . অনুগ্রহ করে যাচাই করে নিন আপনার এড একাউন্ট এ আসছে কিনা ,যদি না আসে আমাদের সাথে যোগাযোগ করুন I",
            ];
        
            \Mail::send('admin.adMail.successMail',$mail_data,function($message) use ($mail_data){
                $message->to($mail_data['email'])
                        ->from($mail_data['from_name'])
                        ->subject($mail_data['subject']);
                });

            return redirect()->back()->with('message','Successfully Ad Account TopUp Complete');
        }

        
    }
    

    public function adAccountTopUpRequestReject($id)
    {
        $data = AdAccountTopUp::where('id',$id)->first();

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
        $delete = AdAccountTopUp::where('id',$id)->delete();
        return redirect()->route('ad-account-top-up-request')->with('message','Successfully Ad Account TopUp Request Deleted');
    }

    public function adAccountTopUpRequestEdit($id)
    {
        $adAccountTopUpData = AdAccountTopUp::where('id',$id)->first();
        $adAccount = AdAccount::where('user_id',$adAccountTopUpData->user_id)->where('status','Complete')->get();
        return view('admin.adAccount.adAccountTopUpRequestEdit',compact('adAccountTopUpData','adAccount'));
    }

    public function adAccountTopUpRequestUpdate(Request $request,$id)
    {
        $request->validate([
            'amount' => 'required',
        ]);

        $adAccountTopUpData = AdAccountTopUp::where('id',$id)->first();
        $adAccountTopUpData->amount = $request->amount;
        $adAccountTopUpData->note = $request->note;
        $adAccountTopUpData->save();

        return redirect()->route('ad-account-top-up-request')->with('message','Successfully Ad Account TopUp Request Updated');
    }


     /*--------- Ad Account Found Transfer Request Part -----------*/

    public function adAccountFoundTransferRequest()
    {   
        $adAccountFoundTransferData = AdAccountFoundTransfer::orderBy('id','desc')->get();
        return view('admin.adAccount.adAccountFoundTransferRequest',compact('adAccountFoundTransferData'));
    }
    
    public function adAccountFoundTransferRequestComplete($id)
    {
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $current_time = $dt->format('Y-m-d g:i a');

        $adAccountFoundTransfer = AdAccountFoundTransfer::where('id',$id)->first();

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
        $data = AdAccountFoundTransfer::where('id',$request->ad_account_found_transfer_id)->first();
        $data->status = 'Reject';
        $data->rejected_text = $request->rejected_text;
        $data->save();

        return redirect()->route('ad-account-found-transfer-request')->with('message','Successfully Ad Account Found Request Rejected');
    }

    public function adAccountFoundTransferRequestDelete($id)
    {
        $delete = AdAccountFoundTransfer::where('id',$id)->delete();
        return redirect()->route('ad-account-found-transfer-request')->with('message','Successfully Ad Account Found Transfer Request Deleted');
    }


    /*--------- Ad Account Transfer Request Part -----------*/

    public function adAccountTransferRequest()
    {   
        $adAccountTransferData = AdAccountTransfer::orderBy('id','desc')->get();
        return view('admin.adAccount.adAccountTransferRequest',compact('adAccountTransferData'));
    }

    public function adAccountTransferStatusFilter($data)
    {   
        if ($data == 'Complete') {
            $adAccountTransferData = AdAccountTransfer::orderBy('id','desc')->where('status','Complete')->get();
        }elseif($data == 'Pending'){
            $adAccountTransferData = AdAccountTransfer::orderBy('id','desc')->where('status','Pending')->get();
        }elseif($data == 'Reject'){
            $adAccountTransferData = AdAccountTransfer::orderBy('id','desc')->where('status','Reject')->get();
        }

        return view('admin.adAccount.adAccountTransferRequest',compact('adAccountTransferData'));
    }


    public function adAccountTransferRequestComplete($id)
    {
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $current_time = $dt->format('Y-m-d g:i a');

        $adAccountTransfer = AdAccountTransfer::where('id',$id)->first();
        $adAccountTransfer->status = 'Complete';
        $adAccountTransfer->confirmed_date = $current_time;
        $adAccountTransfer->save();

        $user = User::where('id',$adAccountTransfer->user_id)->first();
        $adAccountData = AdAccount::where('id',$adAccountTransfer->ad_account_id)->first();

        $mail_data = [
                'email' => $user->email,
                'from_name' => 'gulshanadspro@gmail.com',
                'subject' => 'Gulshan Ads Mail',
                'companyName' => $user->company_name,
                'text' => "আপনার আবেনকৃত এড $adAccountData->ad_name ( $adAccountData->ad_account_number ) নির্ধারিত BM ID তে শেয়ার করা হয়েছে অনুগ্রহ করে যাচাই করে নিন আপনার বিজনেস ম্যানেজারে  এড একাউন্ট এ আসছে কিনা ,যদি না আসে আমাদের সাথে যোগাযোগ করুন I",
        ];
    
        \Mail::send('admin.adMail.successMail',$mail_data,function($message) use ($mail_data){
            $message->to($mail_data['email'])
                    ->from($mail_data['from_name'])
                    ->subject($mail_data['subject']);
            });


        return redirect()->back()->with('message','Successfully Ad Account Transfer Complete');
    }

    public function adAccountTransferRequestReject(Request $request,$id)
    {
        $data = AdAccountTransfer::where('id',$request->ad_account_transfer_id)->first();
        $data->status = 'Reject';
        $data->rejected_text = $request->rejected_text;
        $data->save();

        return redirect()->back()->with('message','Successfully Ad Account TopUp Request Rejected');
    }

    public function adAccountTransferRequestDelete($id)
    {
        $delete = AdAccountTransfer::where('id',$id)->delete();
        return redirect()->route('ad-account-transfer-request')->with('message','Successfully Ad Account Transfer Request Deleted');
    }



    /*--------- Ad Account Appeal Request Part -----------*/

    public function adAccountAppealRequest()
    {   
        $adAccountAppealData = AdAccountAppeal::orderBy('id','desc')->get();
        return view('admin.adAccount.adAccountAppealRequest',compact('adAccountAppealData'));
    }

    public function adAccountAppealStatusFilter($data)
    {   
        if ($data == 'Complete') {
            $adAccountAppealData = AdAccountAppeal::orderBy('id','desc')->where('status','Complete')->get();
        }elseif($data == 'Pending'){
            $adAccountAppealData = AdAccountAppeal::orderBy('id','desc')->where('status','Pending')->get();
        }elseif($data == 'Reject'){
            $adAccountAppealData = AdAccountAppeal::orderBy('id','desc')->where('status','Reject')->get();
        }

        return view('admin.adAccount.adAccountAppealRequest',compact('adAccountAppealData'));
    }


    public function adAccountAppealRequestDelete($id)
    {
        $delete = AdAccountAppeal::where('id',$id)->delete();
        return redirect()->route('ad-account-appeal-request')->with('message','Successfully Ad Account Appeal Request Deleted');
    }

    public function adAccountAppealRequestComplete($id)
    {
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $current_time = $dt->format('Y-m-d g:i a');

        $adAccountAppeal = AdAccountAppeal::where('id',$id)->first();
        $adAccountAppeal->status = 'Complete';
        $adAccountAppeal->confirmed_date = $current_time;
        $adAccountAppeal->save();

        $user = User::where('id',$adAccountAppeal->user_id)->first();
        $adAccountData = AdAccount::where('id',$adAccountAppeal->ad_account_id)->first();

        $mail_data = [
                'email' => $user->email,
                'from_name' => 'gulshanadspro@gmail.com',
                'subject' => 'Gulshan Ads Mail',
                'companyName' => $user->company_name,
                'text' => "আপনার আবেনকৃত এড $adAccountData->ad_name ( $adAccountData->ad_account_number ) এর  জন্যে আমরা মেটাতে আবেদন করেছি I কোনো প্রকার আপডেট পাইলে আমরা আপনার সাথে যোগাযোগ করবো I",
        ];
    
        \Mail::send('admin.adMail.successMail',$mail_data,function($message) use ($mail_data){
            $message->to($mail_data['email'])
                    ->from($mail_data['from_name'])
                    ->subject($mail_data['subject']);
            });

        return redirect()->back()->with('message','Successfully Ad Account Appeal Complete');
    }

    public function adAccountAppealRequestReject(Request $request,$id)
    {
        $data = AdAccountAppeal::where('id',$request->ad_account_appeal_id)->first();
        $data->status = 'Reject';
        $data->rejected_text = $request->rejected_text;
        $data->save();

        return redirect()->route('ad-account-appeal-request')->with('message','Successfully Ad Account Appeal Request Rejected');
    }




    /*--------- Ad Account Replace Request Part -----------*/

    public function adAccountReplaceRequest()
    {   
        $adAccountReplaceData = AdAccountReplace::orderBy('id','desc')->get();
        return view('admin.adAccount.adAccountReplaceRequest',compact('adAccountReplaceData'));
    }

    public function adAccountReplaceStatusFilter($data)
    {   
        if ($data == 'Complete') {
            $adAccountReplaceData = AdAccountReplace::orderBy('id','desc')->where('status','Complete')->get();
        }elseif($data == 'Pending'){
            $adAccountReplaceData = AdAccountReplace::orderBy('id','desc')->where('status','Pending')->get();
        }elseif($data == 'Reject'){
            $adAccountReplaceData = AdAccountReplace::orderBy('id','desc')->where('status','Reject')->get();
        }

        return view('admin.adAccount.adAccountReplaceRequest',compact('adAccountReplaceData'));
    }

    
    public function adAccountReplaceRequestDelete($id)
    {
        $delete = AdAccountReplace::where('id',$id)->delete();
        return redirect()->route('ad-account-replace-request')->with('message','Successfully Ad Account Replace Request Deleted');
    }

    public function adAccountReplaceRequestComplete($id)
    {
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $current_time = $dt->format('Y-m-d g:i a');

        $adAccountReplace = AdAccountReplace::where('id',$id)->first();
        $adAccountReplace->status = 'Complete';
        $adAccountReplace->confirmed_date = $current_time;
        $adAccountReplace->save();

        $user = User::where('id',$adAccountReplace->user_id)->first();
        $adAccountData = AdAccount::where('id',$adAccountReplace->ad_account_id)->first();

        $mail_data = [
                'email' => $user->email,
                'from_name' => 'gulshanadspro@gmail.com',
                'subject' => 'Gulshan Ads Mail',
                'companyName' => $user->company_name,
                'text' => "আপনার আবেনকৃত এড $adAccountData->ad_name ( $adAccountData->ad_account_number ) পরিবর্তন করে দেয়া হলো I",
        ];
    
        \Mail::send('admin.adMail.successMail',$mail_data,function($message) use ($mail_data){
            $message->to($mail_data['email'])
                    ->from($mail_data['from_name'])
                    ->subject($mail_data['subject']);
            });

        return redirect()->back()->with('message','Successfully Ad Account Replace Complete');
    }

    public function adAccountReplaceRequestReject(Request $request,$id)
    {
        $data = AdAccountReplace::where('id',$request->ad_account_replace_id)->first();
        $data->status = 'Reject';
        $data->rejected_text = $request->rejected_text;
        $data->save();

        return redirect()->route('ad-account-replace-request')->with('message','Successfully Ad Account Replace Request Rejected');
    }



    /*--------- Ad Account Rename Request Part -----------*/

    public function adAccountRenameRequest()
    {   
        $adAccountRenameData = AdAccountRenameRequest::orderBy('id','desc')->get();
        return view('admin.adAccount.adAccountRenameRequest',compact('adAccountRenameData'));
    }

    public function adAccountRenameStatusFilter($data)
    {   
        if ($data == 'Complete') {
            $adAccountRenameData = AdAccountRenameRequest::orderBy('id','desc')->where('status','Complete')->get();
        }elseif($data == 'Pending'){
            $adAccountRenameData = AdAccountRenameRequest::orderBy('id','desc')->where('status','Pending')->get();
        }elseif($data == 'Reject'){
            $adAccountRenameData = AdAccountRenameRequest::orderBy('id','desc')->where('status','Reject')->get();
        }

        return view('admin.adAccount.adAccountRenameRequest',compact('adAccountRenameData'));
    }
    
    
    public function adAccountRenameRequestDelete($id)
    {
        $delete = AdAccountRenameRequest::where('id',$id)->delete();
        return redirect()->route('ad-account-rename-request')->with('message','Successfully Ad Account Rename Request Deleted');
    }

    public function adAccountRenameRequestComplete(Request $request,$id)
    {
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $current_time = $dt->format('Y-m-d g:i a');

        $adAccountRenameRequest = AdAccountRenameRequest::where('id',$id)->first();
        $adAccountRenameRequest->status = 'Complete';
        $adAccountRenameRequest->confirmed_date = $current_time;
        $adAccountRenameRequest->save();

        $user = User::where('id',$adAccountRenameRequest->user_id)->first();
        
        $adAccountData = AdAccount::where('id',$adAccountRenameRequest->ad_account_id)->first();
        $adAccountData->ad_name = $request->ad_name;
        $adAccountData->save();

        $mail_data = [
                'email' => $user->email,
                'from_name' => 'gulshanadspro@gmail.com',
                'subject' => 'Gulshan Ads Mail',
                'companyName' => $user->company_name,
                'text' => "আপনার আবেনকৃত এড $adAccountData->ad_name ( $adAccountData->ad_account_number ) পরিবর্তন করে দেয়া হলো I",
        ];
    
        \Mail::send('admin.adMail.successMail',$mail_data,function($message) use ($mail_data){
            $message->to($mail_data['email'])
                    ->from($mail_data['from_name'])
                    ->subject($mail_data['subject']);
            });

        return redirect()->back()->with('message','Successfully Ad Account Rename Complete');
    }

    public function adAccountRenameRequestReject(Request $request,$id)
    {
        $data = AdAccountRenameRequest::where('id',$request->ad_account_rename_id)->first();
        $data->status = 'Reject';
        $data->rejected_text = $request->rejected_text;
        $data->save();

        return redirect()->route('ad-account-rename-request')->with('message','Successfully Ad Account Rename Request Rejected');
    }


    /*--------- Ad Account BM Link Request Part -----------*/

    public function adAccountBMLinkRequestView()
    {
        $adAccountBMLinkData = AdAccountBMLinkRequest::orderBy('id','desc')->get();
        return view('admin.adAccount.adAccountBMLinkRequest',compact('adAccountBMLinkData'));
    }

    public function adAccountBmLinkReply(Request $request,$id)
    {
        $adAccountBMLink = AdAccountBMLinkRequest::where('id',$id)->first();
        $adAccountBMLink->status = 'Complete';
        $adAccountBMLink->reply = $request->reply;
        $adAccountBMLink->save();

        return redirect()->back()->with('message','Successfully BM Link Send');
    }

    public function adAccountBmLinkRequestDelete($id)
    {
         $delete = AdAccountBMLinkRequest::where('id',$id)->delete();
         return redirect()->back()->with('message','Successfully Ad Account BM Link Request Deleted');
    }


    /*--------- Ad Account Refund Request Part -----------*/
    public function adAccountRefundRequestView()
    {
        $adAccountRefundData = AdAccountRefundRequest::orderBy('id','desc')->get();
        return view('admin.adAccount.adAccountRefundRequest',compact('adAccountRefundData'));
    }

    public function adAccountRefundRequestComplete($id)
    {   
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $current_time = $dt->format('Y-m-d g:i a');

        $adAccountRefund = AdAccountRefundRequest::where('id',$id)->first();

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
        $data = AdAccountRefundRequest::where('id',$id)->first();
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
        $delete = AdAccountRefundRequest::where('id',$id)->delete();
         return redirect()->back()->with('message','Successfully Ad Account Refund Request Deleted');
    }
    

    public function adAccountRefundStatusFilter($data)
    {   
        if ($data == 'Complete') {
            $adAccountRefundData = AdAccountRefundRequest::orderBy('id','desc')->where('status','Complete')->get();
        }elseif($data == 'Pending'){
            $adAccountRefundData = AdAccountRefundRequest::orderBy('id','desc')->where('status','Pending')->get();
        }elseif($data == 'Reject'){
            $adAccountRefundData = AdAccountRefundRequest::orderBy('id','desc')->where('status','Reject')->get();
        }

        return view('admin.adAccount.adAccountRefundRequest',compact('adAccountRefundData'));
    }



    /*--------- Ad Account Try Hold Request Part -----------*/

    public function adAccountTryHoldRequest()
    {   
        $adAccountTryHoldData = TryHoldRequest::orderBy('id','desc')->get();
        return view('admin.adAccount.adAccountTryHold',compact('adAccountTryHoldData'));
    }

    public function adAccountTryHoldStatusFilter($data)
    {   
        if ($data == 'Complete') {
            $adAccountTryHoldData = TryHoldRequest::orderBy('id','desc')->where('status','Complete')->get();
        }elseif($data == 'Pending'){
            $adAccountTryHoldData = TryHoldRequest::orderBy('id','desc')->where('status','Pending')->get();
        }elseif($data == 'Reject'){
            $adAccountTryHoldData = TryHoldRequest::orderBy('id','desc')->where('status','Reject')->get();
        }

        return view('admin.adAccount.adAccountTryHold',compact('adAccountTryHoldData'));
    }


    public function adAccountTryHoldRequestDelete($id)
    {
        $delete = TryHoldRequest::where('id',$id)->delete();
        return redirect()->route('ad-account-try-hold-request')->with('message','Successfully Ad Account Try Hold Request Deleted');
    }

    public function adAccountTryHoldRequestComplete($id)
    {
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $current_time = $dt->format('Y-m-d g:i a');

        $adAccountAppeal = TryHoldRequest::where('id',$id)->first();
        $adAccountAppeal->status = 'Complete';
        $adAccountAppeal->confirmed_date = $current_time;
        $adAccountAppeal->save();

        $user = User::where('id',$adAccountAppeal->user_id)->first();
        $adAccountData = AdAccount::where('id',$adAccountAppeal->ad_account_id)->first();

        return redirect()->back()->with('message','Successfully Ad Account Try Hold Complete');
    }

    public function adAccountTryHoldRequestReject(Request $request,$id)
    {
        $data = TryHoldRequest::where('id',$request->ad_account_appeal_id)->first();
        $data->status = 'Reject';
        $data->rejected_text = $request->rejected_text;
        $data->save();

        return redirect()->route('ad-account-try-hold-request')->with('message','Successfully Ad Account Try Hold Request Rejected');
    }


    /*--------- Ad Account Bill Failed Request Part -----------*/

    public function adAccountBillFailedRequest()
    {   
        $adAccountBillFailedData = BillFailedRequest::orderBy('id','desc')->get();
        return view('admin.adAccount.adAccountBillFailed',compact('adAccountBillFailedData'));
    }

    public function adAccountBillFailedStatusFilter($data)
    {   
        if ($data == 'Complete') {
            $adAccountBillFailedData = BillFailedRequest::orderBy('id','desc')->where('status','Complete')->get();
        }elseif($data == 'Pending'){
            $adAccountBillFailedData = BillFailedRequest::orderBy('id','desc')->where('status','Pending')->get();
        }elseif($data == 'Reject'){
            $adAccountBillFailedData = BillFailedRequest::orderBy('id','desc')->where('status','Reject')->get();
        }

        return view('admin.adAccount.adAccountBillFailed',compact('adAccountBillFailedData'));
    }


    public function adAccountBillFailedRequestDelete($id)
    {
        $delete = BillFailedRequest::where('id',$id)->delete();
        return redirect()->route('ad-account-bill-failed-request')->with('message','Successfully Ad Account Bill Failed Request Deleted');
    }

    public function adAccountBillFailedRequestComplete($id)
    {
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $current_time = $dt->format('Y-m-d g:i a');

        $adAccountAppeal = BillFailedRequest::where('id',$id)->first();
        $adAccountAppeal->status = 'Complete';
        $adAccountAppeal->confirmed_date = $current_time;
        $adAccountAppeal->save();

        $user = User::where('id',$adAccountAppeal->user_id)->first();
        $adAccountData = AdAccount::where('id',$adAccountAppeal->ad_account_id)->first();

        return redirect()->back()->with('message','Successfully Ad Account Bill Failed Complete');
    }

    public function adAccountBillFailedRequestReject(Request $request,$id)
    {
        $data = BillFailedRequest::where('id',$request->ad_account_appeal_id)->first();
        $data->status = 'Reject';
        $data->rejected_text = $request->rejected_text;
        $data->save();

        return redirect()->route('ad-account-bill-failed-request')->with('message','Successfully Ad Account Bill Failed Request Rejected');
    }


}
