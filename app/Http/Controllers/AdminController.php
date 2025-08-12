<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\BalanceTopUp;
use App\Models\AdAccountTopUp;
use App\Models\AdAccountRequest;
use App\Models\BuyService;
use App\Models\DollarRate;
use App\Models\AdAccount;
use App\Models\AdAccountFoundTransfer;
use App\Models\TiktokAdAccountRequest;
use App\Models\TiktokAdAccount;
use App\Models\TiktokAdAccountFoundTransfer;
use App\Models\TiktokAdAccountTopUp;

class AdminController extends Controller
{
    //todo: admin login form
    public function login_form()
    {
        return view('admin.login');
    }

    

    //todo: admin login functionality
    public function admin_login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.dashboard');
        }else{
            Session::flash('error-message','Invalid Email or Password');
            return back();
        }
    }

    public function adminDashboard()
    {   
        $balanceTopUpData = BalanceTopUp::where('status','Pending')->orderBy('id','desc')->limit(10)->get();
        $adAccountTopUpData = AdAccountTopUp::where('status','Pending')->orderBy('id','desc')->limit(10)->get();
        $adAccountRequestData = AdAccountRequest::where('status','Pending')->orderBy('id','desc')->limit(10)->get();
        $adAccountFoundTransferData = AdAccountFoundTransfer::where('status','Pending')->orderBy('id','desc')->limit(10)->get();
        $tiktokAdAccountTopUpData = TiktokAdAccountTopUp::where('status','Pending')->orderBy('id','desc')->limit(10)->get();
        $tiktokAdAccountRequestData = TiktokAdAccountRequest::where('status','Pending')->orderBy('id','desc')->limit(10)->get();
        $tiktokAdAccountFoundTransferData = TiktokAdAccountFoundTransfer::where('status','Pending')->orderBy('id','desc')->limit(10)->get();
        $buyServiceData = BuyService::orderBy('id','desc')->limit(10)->get();
        $rate = DollarRate::first();
        return view('admin.dashboard',compact('balanceTopUpData','adAccountTopUpData','adAccountRequestData','buyServiceData','rate','adAccountFoundTransferData','tiktokAdAccountTopUpData','tiktokAdAccountRequestData','tiktokAdAccountFoundTransferData'));
    }


    //todo: admin logout functionality
    public function adminLogout(){
        Auth::guard('admin')->logout();
        return redirect()->route('login.form');
    }


    public function dollarRateUpdate(Request $request,$id)
    {
        $request->validate([
            'rate' => 'required',
        ]);

        $dollarRate = DollarRate::where('id',$id)->first();
        $dollarRate->rate = $request->rate;
        $dollarRate->save();

        return redirect()->back()->with('message','Successfully Dollar Updated');
    }
    
}