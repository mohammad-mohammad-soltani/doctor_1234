@php
    function get_clinic_name($id){
        switch( $id){
            case "all":
                return "همه";
            default :
                return \App\Models\Clinic::where('id' , $id)->get()->first()->name;
        }

    }

@endphp
@extends('layout.student')
@section('title' , 'افزودن کلینیک')
@section('content')
    <meta data-id="{{$recorde -> id}}" id="calendar_id" >
    <x-spacer space="1rem" />
    <h1 class="kalame-black text-2xl" > ویرایش نوبت</h1>
    <p>پزشک گرامی ! از این صفحه شما میتوانید نوبت های خود را ویرایش / مشاهده نمایید</p>
    <x-spacer space="1rem"/>
    <section class="add-clinic">
        <div class="line_1">
            <label class="kalame-bold" for="">نام مراجعه کننده</label>
            <x-spacer space="1rem" />
            <input autocomplete="off" id="ref_name" value="{{$recorde -> name}}"  type="text" class="simple-border-input w-full ">
            <x-spacer space="1rem" />
            <label class="kalame-bold" for="">لاین خدماتی</label>
            <x-spacer space="1rem" />
            <select autocomplete="off" name="" id="product_line" class="simple-border-input w-full" id="" >
                @foreach(\App\Models\Category::where('clinic' ,  Auth::guard('doctor') -> user() -> clinic_id) -> orWhere('clinic' , 'all') -> get() as $product)
                    <option  @if($recorde -> product_line == $product -> id) selected="1" @endif   value="{{$product -> id}}">{{$product -> name}}</option>
                @endforeach
            </select>            <x-spacer space="1rem" />
            <label class="kalame-bold" for="">نوع کالای مصرفی</label>
            <x-spacer space="1rem" />
            <select autocomplete="off" name="" id="product_type" class="simple-border-input w-full" id="" >
                @foreach(\App\Models\Products::where('clinic' ,  Auth::guard('doctor') -> user() -> clinic_id) -> orWhere('clinic' , 'all') -> get() as $product)
                    <option @if(json_decode($recorde -> requirements , true)['product'] == $product -> id) selected="1" @endif value="{{$product -> id}}">{{$product -> name}}</option>
                @endforeach
            </select>
            <x-spacer space="1rem" />
            <label class="kalame-bold" for="">مقدار مصرفی</label>
            <x-spacer space="1rem" />
            <input autocomplete="off" value="{{json_decode($recorde -> requirements , true)['val']}}" id="product_val" type="text" class="simple-border-input w-full ">
            <x-spacer space="1rem" />
            <label class="kalame-bold text-right w-full" for="">طریقه پرداخت</label>
            <x-spacer space="1rem" />
            <select autocomplete="off"  id="payment_way" class="simple-border-input w-full" >
                <option  @if($recorde -> payment_way == 1) selected @endif  value="1">نقدی</option>
                <option @if($recorde -> payment_way == 2) selected @endif value="2">کارت به کارت</option>
                <option @if($recorde -> payment_way == 3) selected @endif value="3">کارتخوان</option>
            </select>
            <x-spacer space="1rem" />

            <label class="kalame-bold" for="">طریقه آشنایی</label>
            <x-spacer space="1rem" />
            <input autocomplete="off" value="{{$recorde -> introduce_way}}" id="introduce_way" type="text" class="simple-border-input w-full ">
            <x-spacer space="1rem" />
        </div>
        <div class="line_2" >
            <label class="kalame-bold text-right w-full" for=""  >تاریخ مراجعه</label>
            <x-spacer space="1rem" />
            <input autocomplete="off" id="coming_time" data-jdp data-jdf-time value="{{$recorde -> time}}"  type="text" class="simple-border-input w-full ">
            <x-spacer space="1rem" />
            <label class="kalame-bold text-right w-full" for="">شماره پرونده</label>
            <x-spacer space="1rem" />
            <input autocomplete="off" value="{{$recorde -> number}}" id="serial_number" type="text" class="simple-border-input w-full ">
            <x-spacer space="1rem" />
            <label class="kalame-bold text-right w-full" for="">نام پزشک</label>
            <x-spacer space="1rem" />
            <select autocomplete="off" id="doctor_name" class="simple-border-input w-full" >
                @foreach(\App\Models\Doctor::where('clinic_id' , Auth::guard('doctor') -> user() -> clinic_id) -> get() as $doctor)
                    <option @if($doctor -> id == $recorde -> doctor) selected @endif value="{{$doctor -> id}}">{{$doctor -> name}}</option>
                @endforeach
            </select>
            <x-spacer space="1rem" />
            <label class="kalame-bold text-right w-full" for="">هزینه جانبی</label>
            <x-spacer space="1rem" />
            <input autocomplete="off" value="{{$recorde -> price}}" id="other_prices" type="text" class="simple-border-input w-full ">
            <x-spacer space="1rem" />
            <label class="kalame-bold text-right w-full" for="">زمان صرف شده جهت انجام</label>
            <x-spacer space="1rem" />
            <input autocomplete="off" value="{{$recorde -> timeofwork}}" id="timeofwork" type="text" class="simple-border-input w-full ">
            <x-spacer space="1rem" />
            <label class="kalame-bold text-right w-full" for="">هزینه دریافت شده</label>
            <x-spacer space="1rem" />
            <input autocomplete="off" value="{{$recorde -> payment_status}}" id="goted_money" type="text" class="simple-border-input w-full ">
            <x-spacer space="1rem" />
            <button id="edite_calendar" class="send-btn" >ویرایش نوبت</button>
        </div>
    </section>
@endsection
