<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use DB;
use Spatie\Permission\Models\Permission;

class AdminShowController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:admin,admin');
    }

    public function index()
    {   
        $adminData = Admin::get();
        return view('admin.admins.index',compact('adminData'));
    }

    public function create()
    {   
        $roles = Role::get();
        return view('admin.admins.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required',
        ]);
    
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $admin = Admin::create($data);
        $admin->assignRole($request->input('roles'));
        
        return redirect()->route('admins.index')->with('message','Successfully Admin Create');
    }


    public function edit($id)
    {   
        $adminData = Admin::where('id',$id)->first();
        $roles = Role::get();
        return view('admin.admins.edit',compact('adminData','roles'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
    
        $admin = Admin::where('id',$id)->first();
        $admin->name = $request->name;
        $admin->email = $request->email;

        if(!empty($request->password)){ 
            if($request->password){
                $admin->password = Hash::make($request->password);
            }
        }
        $admin->save();

        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $admin->assignRole($request->input('roles'));

        return redirect()->route('admins.index')->with('message','Successfully Admin Updated');
    }

    public function destroy($id)
    {
        $admin = Admin::where('id',$id)->first();
        if($admin->delete()){
            return redirect()->route('admins.index')->with('message','Successfully Admin Deleted');;
        }else{
            return redirect()->back();
        }
    }

}
