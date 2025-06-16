<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Category;
use App\Models\Clinic;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Origin extends Controller
{
    public function login(){
        return view('origin.login');
    }

    public function login_post(Request $request){
        if(Auth::guard("origin")->attempt(["username" => $request->username , "password" => $request->password])){
            $request->session()->regenerate();
            return redirect()->route('origin.dashboard');

        }else{
            return back()->withErrors(['password' => 'کلمه عبور اشتباه است']);
        }
    }

    public function products(){
        return view("origin.clinic.products");
    }
    public function calendar(){
        return view("origin.clinic.calendar");
    }

    public function add_product(Request $request){
        $clinic = Auth::guard("origin") -> user() -> clinic_id;

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
    public function add_calendar(Request $request){
        try{
            \App\Models\Calendar::create([
                "name" => $request->name,
                "clinic_id" => Auth::guard("origin") -> user() -> clinic_id,
                'doctor' => $request->doctor_name,
                'time' => $request->coming_time,
                'requirements' => json_encode(["product" => $request -> product_type , 'val' => $request -> product_val]),
                'price' =>$request -> other_prices,
                'number' =>    $request -> serial_number,
                'payment_way' => $request->payment_way,
                'timeofwork' => $request->timeofwork,
                'payment_status' => $request->goted_money,
                'introduce_way' => $request->introduce_way,
                'product_line' => $request->product_line,

            ]);
            return ['ok' => true];
        }catch (\Exception $exception){
            return $exception -> getMessage();
        }

    }
    public function calendar_edite(Request $request , $id){
        $recorde = Calendar::where('id' , $id) -> get() -> first();
        return view("origin.clinic.calendar-edite" , compact('recorde'));

    }

    public function edite_calendar(Request $request)
    {
        try {
            $calendar = \App\Models\Calendar::find($request->id);
            $calendar -> update([
                "name" => $request->name,
                "clinic_id" => Auth::guard("origin")->user()->clinic_id,
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
    public function category(){
        return view("origin.clinic.category");
    }
    public function add_category(Request $request){
        if(Auth::guard("manager")->check()){
            $clinic = 'all';
        }else{
            $clinic = Auth::guard("origin") -> user() -> clinic_id;
        }
        try {
            $status = Category::create([
                'name' => $request->name,
                'clinic' => $clinic,

            ]);
            return ['ok' => true];
        }catch (\Exception $exception){
            return ['ok' => false];
        }
    }
    public function delete_category(Request $request)
    {
        try {
            $status = Category::find($request->id)->forceDelete();
            return ['ok' => true];
        } catch (\Exception $exception) {
            return ['ok' => false];
        }
    }
    public function panel(Request $request ){
        return view("origin.panel");
    }
    public function logout()
    {
        Auth::guard("origin")->logout();
        return redirect('/Receptionist');
    }


}
