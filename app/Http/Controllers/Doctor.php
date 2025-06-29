<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Doctor extends Controller
{
    function panel(){
        return view("doctor.dashboard");
    }

    public function login(){
        if(Auth::guard("doctor")->check()){
            return redirect()->route('doctor.dashboard');
        }
        return view('doctor.login');
    }

    public function login_post(Request $request){
        if(Auth::guard("doctor")->attempt(["username" => $request->username , "password" => $request->password])){
            $request->session()->regenerate();
            return redirect()->route('doctor.dashboard');

        }else{
            return back()->withErrors(['password' => 'کلمه عبور اشتباه است']);
        }
    }

    public function calendar_edite(Request $request , $id){
        $recorde = Calendar::where('id' , $id) -> get() -> first();
        return view("doctor.clinic.calendar-edite" , compact('recorde'));

    }
    public function edite_calendar(Request $request)
    {
        try {
            $calendar = \App\Models\Calendar::find($request->id);
            $calendar -> update([
                "name" => $request->name,
                "clinic_id" => Auth::guard("doctor")->user()->clinic_id,
                'doctor' => $request->doctor_name,
                'time' => $request->coming_time,
                'requirements' => json_encode(["product" => $request->product_type, 'val' => $request->product_val]),
                'price' => $request->other_prices,
                'number' => $request->serial_number,
                'payment_way' => $request->payment_way,
                'timeofwork' => $request->timeofwork,
                'payment_status' => $request->goted_money,
                'introduce_way' => $request->introduce_way,
                'product_line' => $request->product_line,

            ]);
            return ['ok' => true];
        } catch (\Exception $exception) {
            return ['ok' => false];
        }
    }
    public function delete_calendar(Request $request){
        try {
            $status = Calendar::find($request->id)->forceDelete();
            return ['ok' => true];
        }catch (\Exception $exception){
            return ['ok' => false];
        }
    }
    public function logout()
    {
        Auth::guard("doctor")->logout();
        return redirect('/Doctor');
    }
    public function settings(){
        $user = Auth::guard("doctor")->user();
        return view("doctor.settings" , compact('user'));
    }

    public function doctor_settings(Request $request){
        try {
            $doctor = \App\Models\Doctor::find(Auth::guard("doctor")->id());

            $data = [
                "name" => $request->name,
                "username" => $request->username,
            ];

            if (!empty($request->password)) {
                $data["password"] = bcrypt($request->password);
            }

            $doctor->update($data);

            return ['ok' => true];
        } catch (\Exception $exception) {
            return ['ok' => false , 'error' => $exception->getMessage()];
        }
    }

}
