<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Origin;
use App\Models\Products;
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
            return redirect()->route('manager.dashboard');

        }else{
            return back()->withErrors(['password' => 'کلمه عبور اشتباه است']);
        }
    }
    public function panel(Request $request){
        return view("manager.panel");
    }
    public function add_client(){
        return view("manager.clinic.add");

    }
    public function products(){
        return view("manager.clinic.products");
    }
    public function add_clinic(Request $request){
        try {
            $status = Clinic::create([
                'name' => $request->name,
                'doctors' => [],
                'origins' => [],
            ]);
            return ['ok' => true];

        }catch (\Exception $exception){
            return ['ok' => false];
        }
    }
    public function add_doctor(Request $request){
        try {
            $status = Doctor::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'clinic_id' => $request->clinic_id,
            ]);
            return ['ok' => true];
        }catch (\Exception $exception){
            return ['ok' => false];
        }
    }
    public function add_origin(Request $request){
        try {
            $status = Origin::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'clinic_id' => $request->clinic_id,
            ]);
            return ['ok' => true];
        }catch (\Exception $exception){
            return ['ok' => false];
        }
    }
    public function add_product(Request $request){
        if(Auth::guard("manager")->check()){
            $clinic = 'all';
        }
        try {
            $status = Products::create([
                'name' => $request->name,
                'clinic' => $clinic,

            ]);
            return ['ok' => true];
        }catch (\Exception $exception){
            return ['ok' => false];
        }
    }
    public function delete_product(Request $request){
        try {
            $status = Products::find($request->id)->forceDelete();
            return ['ok' => true];
        }catch (\Exception $exception){
            return ['ok' => false];
        }
    }
    public function delete_clinic(Request $request){
        try {
            $status = Clinic::find($request->id)->forceDelete();
            return ['ok' => true];
        }catch (\Exception $exception){
            return ['ok' => false];
        }
    }
    public function settings(){
        return view("manager.settings");
    }
    public function clinic(){
        return view("manager.clinic.clinic");
    }
    public function clinic2($id){
        $recorde = Clinic::where('id' , $id)->get()->first();
        return view("manager.clinic.clinic2" , compact('recorde'));
    }

}
