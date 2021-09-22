<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminLogin;

class LoginController extends Controller
{
    public function loginUser(){
        return view('login');
    }


    public function onLogout(Request $request){
        $request->session()->flush();
        return redirect('/login');
    }


    public function onLogin(Request $request){
        $username = $request->input('name');
        $password = $request->input('password'); 

        $countValue = AdminLogin::where(['username'=>$username ,'password'=>$password])->count();
        if($countValue==1){
            $request->session()->put('user', $username); 
            return 1;
        }else{
            return 0;
        }
    }
}
