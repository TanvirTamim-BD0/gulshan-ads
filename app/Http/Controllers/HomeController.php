<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdAccount;
use App\Models\AdAccountRequest;
use App\Models\AdAccountAppeal;
use App\Models\AdAccountTopUp;
use App\Models\AdAccountTransfer;
use App\Models\AdAccountReplace;
use App\Models\BalanceTopUp;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\BuyService;
use App\Models\DollarRate;
use App\Models\AdAccountBMLinkRequest;
use App\Models\AdAccountRefundRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $accountData = AdAccount::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        $accountRequestData = AdAccountRequest::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        $accountTransferData = AdAccountTransfer::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        $accountAppealData = AdAccountAppeal::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        $accountReplaceData = AdAccountReplace::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        $balanceTopUpData = BalanceTopUp::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        $adAccountTopUpData = AdAccountTopUp::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        $userData = User::where('id',Auth::user()->id)->first();
        $totalAdAccount = AdAccount::where('user_id',Auth::user()->id)->count();
        $buyServiceData = BuyService::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        $adAccountBMLinkData = AdAccountBMLinkRequest::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        $refundData = AdAccountRefundRequest::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        return view('user.dashboard',compact('accountData','balanceTopUpData','adAccountTopUpData','totalAdAccount','userData','accountRequestData','accountTransferData','accountAppealData','accountReplaceData','buyServiceData','adAccountBMLinkData','refundData'));
    }

    

}
