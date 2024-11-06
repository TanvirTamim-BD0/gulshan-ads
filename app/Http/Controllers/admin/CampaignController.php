<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use DateTime;
use DateTimezone;

class CampaignController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:campaign,admin');
    }
    
    public function campaignRequest()
    {
        $campaignData = Campaign::whereNot('status','Confirmed')->orderBy('id','desc')->get();
        return view('admin.campaign',compact('campaignData'));
    }

    public function resumeCampaignRequest()
    {
        $campaignData = Campaign::where('status','Confirmed')->where('running_status','Resume')->orderBy('id','desc')->get();
        return view('admin.campaign',compact('campaignData'));
    }

    public function pauseCampaignRequest()
    {
        $campaignData = Campaign::where('status','Confirmed')->where('running_status','Pause')->orderBy('id','desc')->get();
        return view('admin.campaign',compact('campaignData'));
    }


    public function campaignRequestConfirmed(Request $request,$id)
    {   
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $current_time = $dt->format('Y-m-d g:i a');

        $campaign = Campaign::where('id',$id)->first();
        $campaign->status = 'Confirmed';
        $campaign->confirmed_date = $current_time;
        $campaign->confirmed_text = $request->confirmed_text;
        $campaign->save();

        $userData = User::where('id',$campaign->user_id)->first();
        $userData->balance -= $campaign->budget;
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

        return redirect()->route('campaign-request')->with('message','Successfully Campaign Confirmed');
    }

    public function campaignRequestReject(Request $request,$id)
    {
        $data = Campaign::where('id',$request->service_buy_id)->first();
        $data->status = 'Reject';
        $data->rejected_text = $request->rejected_text;
        $data->save();

        return redirect()->route('campaign-request')->with('message','Successfully Campaign Rejected');
    }

}
