<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function login(Request $request){
    	if($request->isMethod('post')){
    		$data=$request->input();
    		if(Auth::attempt(['email'=> $data['email'],'password'=>$data['password'],'admin'=>'1'])){
                // Session::put('adminSession',$data['email']);
    			return redirect('/admin/dashboard');
    		}else{
                return redirect('/admin')->with('flash_message_error','Invalid username/password combination');
            }
    	}
        return view('admin.admin_login');
    	//return redirect('/admin')->with('flash_message_error','Invalid username/password combination');
    }

    public function dashboard(){
        return view('admin.dashboard');
    }

    public function checkpass(Request $request){
        $data=$request->all();
        $current_pass=$data['current_pwd'];
        //alert($current_pass);
        $curr_user = User::where(['admin' => '1'])->first();
        // echo $curr_user;
        if(Hash::check($current_pass,$curr_user->password)){
            //user password valid
            return "true";
        }else{
            return "false";
        }
    }

    public function settings(){
        return view('admin.settings');
    }

    public function updatePass(Request $request){
        #updates the password of the admin
        if($request->isMethod('post')){
           $data=$request->all();
           $check_pass = User::where(['email' => Auth::user()->email])->first();
           $current_pass = $data['current_pwd'];
           // echo "<pre>";print_r($data);die(); 
           if(Hash::check($current_pass,$check_pass->password)){
                $password = bcrypt($data['new_pwd']);
                User::where('id','1')->update(['password'=>$password]);
                return redirect('/admin/settings')->with('flash_message_success','Password updated successfully');      
            }else{
            return redirect('/admin/settings')->with('flash_message_error','Incorrect Current Password');
            }
        }

    }

    public function logout(){
        Session::flush();
        return redirect('/admin')->with('flash_message_success','Logged out successfully');
    }

    
}
