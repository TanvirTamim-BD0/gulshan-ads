<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class UsersController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:users,admin');
    }
    
    public function index()
    {   
        $userData = User::orderBy('id','desc')->get();
        return view('admin.users.index', compact('userData'));
    }

    public function create()
    {
        return view('admin.users.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
        ]);
    
        $data = $request->all();

        $uniqueId = random_int(1000, 9999);
        $data['userID'] = "6263".$uniqueId;
        $data['password'] = Hash::make($data['password']);
    
        $user = User::create($data);
        return redirect()->route('users.index')->with('message','Successfully User Create');
    }


    public function edit($id)
    {   
        $userData = User::where('id',$id)->first();
        return view('admin.users.edit',compact('userData'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);
    
        $user = User::where('id',$id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->company_name = $request->company_name;
        $user->note = $request->note;
        $user->whatsapp_number = $request->whatsapp_number;

        if(!empty($request->password)){ 
            if($request->password){
                $user->password = Hash::make($request->password);
            }
        }

        $user->save();

        return redirect()->route('users.index')->with('message','Successfully User Updated');
    }

    public function destroy($id)
    {
        $user = User::where('id',$id)->first();
        if($user->delete()){
            return redirect()->route('users.index')->with('message','Successfully User Deleted');;
        }else{
            return redirect()->back();
        }
    }

    public function updateDollerRate(Request $request)
    {
        if ($request->ajax()) {

            $data = User::where('id',$request->pk)->first();
            $data->doller_rate = $request->value;
            $data->save();

            return response()->json(['success' => true]);

        }
    }

}
