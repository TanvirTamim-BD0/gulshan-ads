<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BalanceTopUp;
use App\Models\User;
use Carbon\Carbon;
use Auth;
use DateTime;
use DateTimezone;

class BalanceController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:balance-top-up,admin');
    }

    public function balanceTopUpRequest()
    {   
        $balanaceData = BalanceTopUp::orderBy('id','desc')->get();
        return view('admin.balance.balanceRequest',compact('balanaceData'));
    }

    public function balanaceRequestStatusFilter($data)
    {
        if ($data == 'Confirmed') {
            $balanaceData = BalanceTopUp::orderBy('id','desc')->where('status','Confirmed')->get();
        }elseif($data == 'Pending'){
            $balanaceData = BalanceTopUp::orderBy('id','desc')->where('status','Pending')->get();
        }elseif($data == 'Reject'){
            $balanaceData = BalanceTopUp::orderBy('id','desc')->where('status','Reject')->get();
        }
        return view('admin.balance.balanceRequest',compact('balanaceData'));
    }

    public function balanceConfirmed($id)
    {   

        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $current_time = $dt->format('Y-m-d g:i a');

        $data = BalanceTopUp::where('id',$id)->first();

        if ($data->status == 'Confirmed') {
           return redirect()->route('balance-top-up-request');
        }else{

            $user = User::where('id',$data->user_id)->first();
            $user->balance += $data->usd;
            $user->save();

            $data->status = 'Confirmed';
            $data->confirmed_date = $current_time;
            $data->save();

                $mail_data = [
                        'email' => $user->email,
                        'from_name' => 'gulshanadspro@gmail.com',
                        'subject' => 'Gulshan Ads Mail',
                        'companyName' => $user->company_name,
                        'text' => "আপনার আবেনকৃত $data->usd(usd) , $data->bdt(bdt) রিচার্জ সফল হয়েছে I",
                ];
            
                \Mail::send('admin.adMail.successMail',$mail_data,function($message) use ($mail_data){
                    $message->to($mail_data['email'])
                            ->from($mail_data['from_name'])
                            ->subject($mail_data['subject']);
                    });

            return redirect()->route('balance-top-up-request')->with('message','Successfully Balance Confirmed');

        }
        
    }

    public function balanaceRequestRejected(Request $request)
    {
        $data = BalanceTopUp::where('id',$request->balance_id)->first();

        if ($data->status == 'Confirmed') {
            $user = User::where('id',$data->user_id)->first();
            $user->balance -= $data->amount;
            $user->save();

            $data->status = 'Reject';
            $data->rejected_text = $request->rejected_text;
            $data->save();
        }else{
            $data->status = 'Reject';
            $data->rejected_text = $request->rejected_text;
            $data->save();
        }

        return redirect()->route('balance-top-up-request')->with('message','Successfully Balance Reject');
    }

    public function balanceDelete($id)
    {
        $delete = BalanceTopUp::where('id',$id)->delete();
        return redirect()->route('balance-top-up-request')->with('message','Successfully Balance Request Deleted');
    }

    public function balanceEdit($id)
    {
        $balanceData = BalanceTopUp::where('id',$id)->first();
        return view('admin.balance.edit',compact('balanceData'));
    }

    public function updateBalance(Request $request,$id)
    {
        $balanceData = BalanceTopUp::where('id',$id)->first();
        $balanceData->usd = $request->usd;
        $balanceData->save();

        return redirect()->route('balance-top-up-request')->with('message','Successfully Balance Request Updated');
    }


    public function addBalance()
    {   
        $userData = User::orderBy('id','desc')->get();
        return view('admin.balance.addBalance',compact('userData'));
    }

    public function userBalanceAdd(Request $request)
    {   
        $request->validate([
            'user_id' => 'required',
            'amount' => 'required',
        ]);


        if ($request->amount >= 1) {

            $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
            $current_time = $dt->format('Y-m-d g:i a');

            $BalanceTopUp = new BalanceTopUp();
            $BalanceTopUp->user_id = $request->user_id;
            $BalanceTopUp->usd = $request->amount;
            $BalanceTopUp->manual_payment = 'Manual Payment By '. Auth::guard('admin')->user()->name;
            $BalanceTopUp->status = 'Confirmed';
            $BalanceTopUp->confirmed_date = $current_time;
            $BalanceTopUp->save();

            $user = User::where('id',$request->user_id)->first();
            $user->balance += $request->amount;
            $user->save();

            return redirect()->route('add-balance')->with('message','Successfully Balance Add');

        }else{
            return redirect()->route('add-balance')->with('error','Balance Amount is Too Low');
        }
        
    }

}
