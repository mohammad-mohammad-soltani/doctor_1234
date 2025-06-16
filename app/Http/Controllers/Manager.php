<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Category;
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
    public function add_category(Request $request){
        if(Auth::guard("manager")->check()){
            $clinic = 'all';
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
    public function delete_product(Request $request){
        try {
            $status = Products::find($request->id)->forceDelete();
            return ['ok' => true];
        }catch (\Exception $exception){
            return ['ok' => false];
        }
    }
    public function delete_category(Request $request){
        try {
            $status = Category::find($request->id)->forceDelete();
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
    public function delete_doctor(Request $request){
        try {
            $status = Doctor::find($request->id)->forceDelete();
            return ['ok' => true];
        }catch (\Exception $exception){
            return ['ok' => false];
        }
    }
    public function delete_origin(Request $request){
        try {
            $status = Origin::find($request->id)->forceDelete();
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
    public function clinic2($clinic_id){
        $recorde = Clinic::where('id' , $clinic_id)->get()->first();
        return view("manager.clinic.clinic2" , ['clinic_id' => $clinic_id , $recorde]);
    }
    public function update_clinic(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
        ]);
        $clinic = Clinic::find($request -> id);
        $clinic->name = $validated['name'];

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $clinic->logo_path = $path;
        }

        $clinic->save();
    }
    public function get_origins(Request $request){
        $origins = Doctor::where('clinic_id' , $request->id)->get();
        return $origins;
    }
    public function category(){
        return view("manager.clinic.category");
    }
    public function get_doctor(Request $request){
        return Doctor::where('id' , $request->id)->get()->first();
    }
    public function get_origin(Request $request){
        return Origin::where('id' , $request->id)->get()->first();
    }
    public function edite_doctor(Request $request){
        try {
            $doctor = \App\Models\Doctor::find($request->doctor);

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
            return ['ok' => false];
        }
    }

    public function edite_origin(Request $request){
        try {
            $origin = \App\Models\Origin::find($request->doctor);

            $data = [
                "name" => $request->name,
                "username" => $request->username,
            ];

            if (!empty($request->password)) {
                $data["password"] = bcrypt($request->password);
            }

            $origin->update($data);

            return ['ok' => true];
        } catch (\Exception $exception) {
            return ['ok' => false];
        }
    }
    public function logout()
    {
        Auth::guard("manager")->logout();
        return redirect('/Manager');
    }

}
