<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethodCategory;

class PaymentMethodCategoryController extends Controller
{
    public function index()
    {   
        $paymentMethodCategoryData = PaymentMethodCategory::orderBy('id','desc')->get();
        return view('admin.paymentMethodCategory.index',compact('paymentMethodCategoryData'));
    }

    public function create()
    {
        return view('admin.paymentMethodCategory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => 'required',
            'payment_type' => 'required',
        ]);

        $data = $request->all();

        if($request->icon){
            $file = $request->file('icon');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/payment_method_icon/');
            $file->move($destinationPath,$fileName);
            $data['icon'] = $fileName;
        }

        
        if(PaymentMethodCategory::create($data)){
            return redirect()->route('payment-method-category.index')->with('message','Successfully Payment Method Create');
        }else{
            return redirect()->back();
        }
    }

    public function edit($id)
    {   
        $paymentMethodCategoryData = PaymentMethodCategory::where('id',$id)->first();
        return view('admin.paymentMethodCategory.edit',compact('paymentMethodCategoryData'));
    }

    public function update(Request $request,$id){

        $request->validate([
            'payment_method' => 'required',
            'payment_type' => 'required',
        ]);


        $data = $request->all();
    
        $paymentMethodCategoryData = PaymentMethodCategory::find($id);


        if($request->icon != ''){
            //To remove previous file...
            $destinationPath = public_path('uploads/payment_method_icon/');
            if(file_exists($destinationPath.$paymentMethodCategoryData->icon)){
                if($paymentMethodCategoryData->ads != ''){
                    unlink($destinationPath.$paymentMethodCategoryData->icon);
                }
            }

            $file = $request->file('icon');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath,$fileName);
            $data['icon'] = $fileName;
        }

        if($paymentMethodCategoryData->update($data)){
            return redirect(route('payment-method-category.index'))->with('message','Successfully Payment Method Category Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }

    }


    public function destroy($id)
    {
        $paymentMethodCategory = PaymentMethodCategory::find($id);
        if($paymentMethodCategory->delete()){

            return redirect(route('payment-method-category.index'))->with('message','Successfully Payment Method Category Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
    }    

}
