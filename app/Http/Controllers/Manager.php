<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Manager extends Controller
{
    public function login(Request $request){
        if(Auth::guard("manager")->check()){
            return redirect()->route("manager.dashboard");
        }
        return view("manager.login");
    }
    public function login_post(Request $request){
        if(Auth::guard("manager")->attempt(["username" => $request->username , "password" => $request->password])){
            $request->session()->regenerate();
            return redirect()->route('manager.panel');

        }else{
            return back()->withErrors(['password' => 'کلمه عبور اشتباه است']);
        }
    }
    public function panel(Request $request){
        return view("manager.panel");
    }

}
