<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\PaymentMethodCategory;

class PaymentMethodController extends Controller
{   
    
    public function index()
    {   
        $paymentMethodData = PaymentMethod::orderBy('id','desc')->get();
        return view('admin.paymentMethod.index',compact('paymentMethodData'));
    }

    public function create()
    {   
        $paymentMethodCategoryData = PaymentMethodCategory::orderBy('id','desc')->get();
        return view('admin.paymentMethod.create',compact('paymentMethodCategoryData'));
    }

    public function getPaymentTypeWisePaymentMethod(Request $request)
    {   
        $sectionData = PaymentMethodCategory::where('payment_type', $request->paymentType)->get();
        $data = [
            'sectionData' => $sectionData,
        ];
        return response()->json($data);
    }

    public function getPaymentAccount(Request $request)
    {
        $sectionData = PaymentMethod::where('payment_category_id', $request->paymentMethod)->get();
        $data = [
            'sectionData' => $sectionData,
        ];
        return response()->json($data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'payment_category_id' => 'required',
            'ac_number' => 'required',
        ]);

        $data = $request->all();
        
        if(PaymentMethod::create($data)){
            return redirect()->route('payment-method.index')->with('message','Successfully Payment Method Create');
        }else{
            return redirect()->back();
        }
    }

    public function edit($id)
    {   
        $paymentMethodData = PaymentMethod::where('id',$id)->first();
        $paymentMethodCategoryData = PaymentMethodCategory::orderBy('id','desc')->get();
        return view('admin.paymentMethod.edit',compact('paymentMethodData','paymentMethodCategoryData'));
    }

    public function update(Request $request,$id){

        $request->validate([
            'payment_category_id' => 'required',
            'ac_number' => 'required',
        ]);


        $data = $request->all();
    
        $paymentMethod = PaymentMethod::find($id);
        if($paymentMethod->update($data)){
            return redirect(route('payment-method.index'))->with('message','Successfully Payment Method Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }

    }


    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::find($id);
        if($paymentMethod->delete()){

            return redirect(route('payment-method.index'))->with('message','Successfully Payment Method Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
    }

}
