<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AdAccount;
use App\Models\BalanceTopUp;
use App\Models\AdAccountTopUp;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:reports,admin');
    }
    
    public function balanaceTopUpReportFilter()
    {   
        $userData = User::orderBy('id','desc')->get();
        return view('admin.balanaceTopUpReport.filter',compact('userData'));
    }

    public function balanaceTopUpReport(Request $request)
    {   
        $userData = User::where('id',$request->user_id)->first();

        $totalUsdBalanace = 0;
        $totalBdtBalanace = 0;
        $userID = $request->user_id;
        $balanceData = BalanceTopUp::where('user_id',$request->user_id)->where('status','Confirmed')->get();
        if(isset($balanceData)){
            foreach($balanceData as $result){
                $totalUsdBalanace += $result->usd;
                $totalBdtBalanace += $result->bdt;
            }
        }

        return view('admin.balanaceTopUpReport.index',compact('balanceData','totalUsdBalanace','totalBdtBalanace','userID','userData'));
    }


    public function adAccountbalanaceTopUpReportFilter()
    {   
        $userData = User::orderBy('id','desc')->get();
        return view('admin.adAccountBalanaceTopUpReport.filter',compact('userData'));
    }

    public function getAdAccountUserWise(Request $request)
    {
        $sectionData = AdAccount::where('user_id', $request->userId)->where('status','Created')->get();
        $data = [
            'sectionData' => $sectionData,
        ];
        return response()->json($data);
    }

    public function adAccountbalanaceTopUpReport(Request $request)
    {   

        $userData = User::where('id',$request->user_id)->first();
        $accountData = AdAccount::where('id', $request->ad_account_id)->first();

        $totalBalanace = 0;
        $userID = $request->user_id;
        $adAccountId = $request->ad_account_id;

        $balanceData = AdAccountTopUp::where('user_id',$request->user_id)->where('ad_account_id',$request->ad_account_id)->where('status','Complete')->get();
        if(isset($balanceData)){
            foreach($balanceData as $result){
                $totalBalanace += $result->amount;
            }
        }

        return view('admin.adAccountBalanaceTopUpReport.index',compact('balanceData','totalBalanace','userID','adAccountId','userData','accountData'));
    }


    public function pdfAdAccountData(Request $request)
    {   

        $userData = User::where('id',$request->user_id)->first();
        $accountData = AdAccount::where('id', $request->ad_account_id)->first();

        $totalBalanace = 0;

        $balanceData = AdAccountTopUp::where('user_id',$request->user_id)->where('ad_account_id',$request->ad_account_id)->where('status','Complete')->get();
        if(isset($balanceData)){
            foreach($balanceData as $result){
                $totalBalanace += $result->amount;
            }
        }

         $data = [
            
                'totalBalanace' => $totalBalanace,
                'balanceData' => $balanceData,
                'userData' => $userData,
                'accountData' => $accountData,
            
        ];
     
        $pdf = Pdf::loadView('admin.adAccountBalanaceTopUpReport.pdf', $data);
     
        return $pdf->download();
    }


    public function pdfAccountBalanceData(Request $request)
    {   
        $userData = User::where('id',$request->user_id)->first();

        $totalUsdBalanace = 0;
        $totalBdtBalanace = 0;
        $balanceData = BalanceTopUp::where('user_id',$request->user_id)->where('status','Confirmed')->get();
        if(isset($balanceData)){
            foreach($balanceData as $result){
                $totalUsdBalanace += $result->usd;
                $totalBdtBalanace += $result->bdt;
            }
        }

        $data = [
            
                'totalUsdBalanace' => $totalUsdBalanace,
                'totalBdtBalanace' => $totalBdtBalanace,
                'balanceData' => $balanceData,
                'userData' => $userData,
        ];
     
        $pdf = Pdf::loadView('admin.balanaceTopUpReport.pdf', $data);
     
        return $pdf->download();

    }

}
