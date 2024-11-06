<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PaymentMethod;
use App\Models\PaymentMethodCategory;
use App\Models\BalanceTopUp;
use Illuminate\Support\Facades\Auth;
use App\Models\DollarRate;

class BalanceTopUpController extends Controller
{
    public function balance()
    {   
        $userData = User::where('id',Auth::user()->id)->first();
        $paymentBank = PaymentMethodCategory::where('payment_type','Bank')->pluck('id');
        $paymentMethodBank = PaymentMethod::whereIn('payment_category_id',$paymentBank)->get();

        $paymentMobile = PaymentMethodCategory::where('payment_type','Mobile Banking')->pluck('id');
        $paymentMethodMobile = PaymentMethod::whereIn('payment_category_id',$paymentMobile)->get();
        $dollarRate = DollarRate::first();
        return view('user.balance',compact('userData','paymentMethodBank','paymentMethodMobile','dollarRate'));
    }

    public function balanceTopUp(Request $request)
    {   
         $request->validate([
            'payment_method_id' => 'required',
            'usd' => 'required',
            'confirmation_screenshot' => 'required',
        ]);

        $data = $request->all();
        $uniqueId = random_int(1000000, 9999999);
        $data['user_id'] = Auth::user()->id;
        $data['payment_id'] = "pay-".$uniqueId;
        $data['status'] = 'Pending';
    
        if($request->confirmation_screenshot){
            $file = $request->file('confirmation_screenshot');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/confirmation_screenshot/');
            $file->move($destinationPath,$fileName);
            $data['confirmation_screenshot'] = $fileName;
        }
        
        if(BalanceTopUp::create($data)){
            return redirect()->route('home')->with('message','Your balance topup is successful. Wait few minutes for admin approval');
        }else{
            return redirect()->back();
        }

    }

}
