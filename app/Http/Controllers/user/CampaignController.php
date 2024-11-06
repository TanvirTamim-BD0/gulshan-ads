<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Audience;
use Auth;
use App\Models\DetailedTargeting;
use App\Models\DetailedTargetingChiled;
use App\Models\EditorAccess;

class CampaignController extends Controller
{
    public function createCampagin()
    {   
        $audienceData = Audience::groupBy('country')->select('country')->get();
        $editorAccess = EditorAccess::first();
        return view('user.createCampagin',compact('audienceData','editorAccess'));
    }

    public function campaginSubmit(Request $request)
    {   
        $request->validate([
            'post_link' => 'required',
            'campaign_type' => 'required',
            'budget' => 'required',
            'days' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        $chiledData = json_encode($request->detailed_targeting_chiled);
        $data['detailed_targeting_chiled'] = $chiledData;

        $locationData = json_encode($request->location_id);
        $data['location_id'] = $locationData;

        if($request->post_image){
            $file = $request->file('post_image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/post_image/');
            $file->move($destinationPath,$fileName);
            $data['post_image'] = $fileName;
        }

        if(Campaign::create($data)){
            return redirect()->back()->with('message','Successfully Campaign Created');
        }else{
            return redirect()->back();
        }
    }


    public function pendingCampaign()
    {
        $campaignData = Campaign::where('user_id',Auth::user()->id)->whereNot('status','Confirmed')->orderBy('id','desc')->get();
        return view('user.campaign.pendingCampaign',compact('campaignData'));
    }

    public function resumeCampaign()
    {
        $campaignData = Campaign::where('user_id',Auth::user()->id)->where('status','Confirmed')->where('running_status','Resume')->orderBy('id','desc')->get();
        return view('user.campaign.resumeCampaign',compact('campaignData'));
    }

    public function pauseCampaign()
    {
        $campaignData = Campaign::where('user_id',Auth::user()->id)->where('status','Confirmed')->where('running_status','Pause')->orderBy('id','desc')->get();
        return view('user.campaign.pauseCampaign',compact('campaignData'));
    }


    public function campaignPauseSubmit($id)
    {
        $campaign = Campaign::where('id',$id)->first();
        $campaign->running_status = 'Pause';
        $campaign->save();

        return redirect()->back()->with('message','Successfully Campaign Updated');
    }


    public function campaignResumeSubmit($id)
    {
        $campaign = Campaign::where('id',$id)->first();
        $campaign->running_status = 'Resume';
        $campaign->save();

        return redirect()->back()->with('message','Successfully Campaign Updated');
    }


    public function countryWiseDistrictData(Request $request)
    {
       $data = Audience::where('country',$request->country)->groupBy('district')->select('district')->get();
       return response()->json($data);
    }

    public function districtWiseAreaData(Request $request)
    {
       $data = Audience::where('district',$request->district)->get();
       return response()->json($data);
    }

    public function detailedTargetingWiseData(Request $request)
    {   
       $data = DetailedTargeting::where('type',$request->features)->get();
       return response()->json($data);
    }

    public function detailedTargetingWiseChiledData(Request $request)
    {   
        $detailedTargeting = DetailedTargeting::where('name',$request->chiled)->first();
         $data = DetailedTargetingChiled::where('detailed_targeting_id',$detailedTargeting->id)->get();

       return response()->json($data);
    }

}
