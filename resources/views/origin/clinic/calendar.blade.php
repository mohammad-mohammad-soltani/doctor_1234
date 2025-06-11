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
    <x-spacer space="1rem" />
    <h1 class="kalame-black text-2xl" > افزودن نوبت</h1>
    <x-spacer space="1rem"/>
    <section class="add-clinic">
        <div class="line_1">
            <label class="kalame-bold" for="">نام مراجعه کننده</label>
            <x-spacer space="1rem" />
            <input id="ref_name"  type="text" class="simple-border-input w-full ">
            <x-spacer space="1rem" />
            <label class="kalame-bold" for="">لاین خدماتی</label>
            <x-spacer space="1rem" />
            <input id="product_line" type="text" class="simple-border-input w-full ">
            <x-spacer space="1rem" />
            <label class="kalame-bold" for="">نوع کالای مصرفی</label>
            <x-spacer space="1rem" />
            <select name="" id="product_type" class="simple-border-input w-full" id="">
                @foreach(\App\Models\Products::where('clinic' ,  Auth::guard('origin') -> user() -> clinic_id) -> orWhere('clinic' , 'all') -> get() as $product)
                    <option value="{{$product -> id}}">{{$product -> name}}</option>
                @endforeach
            </select>
            <x-spacer space="1rem" />
            <label class="kalame-bold" for="">مقدار مصرفی</label>
            <x-spacer space="1rem" />
            <input id="product_val" type="text" class="simple-border-input w-full ">
            <x-spacer space="1rem" />
            <label class="kalame-bold text-right w-full" for="">طریقه پرداخت</label>
            <x-spacer space="1rem" />
            <select id="payment_way" class="simple-border-input w-full" >
                <option value="1">نقدی</option>
                <option value="2">کارت به کارت</option>
                <option value="3">کارتخوان</option>
            </select>
            <x-spacer space="1rem" />

            <label class="kalame-bold" for="">
        طریقه آشنایی</label>
            <x-spacer space="1rem" />
            <input id="introduce_way" type="text" class="simple-border-input w-full ">
            <x-spacer space="1rem" />
        </div>
        <div class="line_2" >
            <label class="kalame-bold text-right w-full" for="" >تاریخ مراجعه</label>
            <x-spacer space="1rem" />
            <input id="coming_time" data-jdp data-jdf-time  type="text" class="simple-border-input w-full ">
            <x-spacer space="1rem" />
            <label class="kalame-bold text-right w-full" for="">شماره پرونده</label>
            <x-spacer space="1rem" />
            <input  id="serial_number" type="text" class="simple-border-input w-full ">
            <x-spacer space="1rem" />
            <label class="kalame-bold text-right w-full" for="">نام پزشک</label>
            <x-spacer space="1rem" />
            <select id="doctor_name" class="simple-border-input w-full" >
                @foreach(\App\Models\Doctor::where('clinic_id' , Auth::guard('origin') -> user() -> clinic_id) -> get() as $doctor)
                    <option value="{{$doctor -> id}}">{{$doctor -> name}}</option>
                @endforeach
            </select>
            <x-spacer space="1rem" />
            <label class="kalame-bold text-right w-full" for="">هزینه جانبی</label>
            <x-spacer space="1rem" />
            <input id="other_prices" type="text" class="simple-border-input w-full ">
            <x-spacer space="1rem" />
            <label class="kalame-bold text-right w-full" for="">زمان صرف شده جهت انجام</label>
            <x-spacer space="1rem" />
            <input id="timeofwork" type="text" class="simple-border-input w-full ">
            <x-spacer space="1rem" />
            <label class="kalame-bold text-right w-full" for="">هزینه دریافت شده</label>
            <x-spacer space="1rem" />
            <input id="goted_money" type="text" class="simple-border-input w-full ">
            <x-spacer space="1rem" />
            <button id="new_calendar" class="send-btn" >افزودن نوبت</button>
        </div>
    </section>
    <x-spacer space="1rem" />
    <h1 class="kalame-black text-2xl" >لیست نوبت ها</h1>
    <x-spacer space="1rem"/>
    <div class="table" >
        <div class="line head">
            <div class="id">#</div>
            <div class="name">نام مراجعه کننده</div>
            <div class="name">تاریخ</div>
            <div class="actions">فعالیت ها</div>
        </div>
        @foreach(\App\Models\Calendar::where('clinic_id' , \Illuminate\Support\Facades\Auth::guard('origin')-> user() -> clinic_id ) -> get() as $clinic)
            <div id="col_{{$clinic -> id}}" class="line"  >
                <div class="id">{{$clinic -> id}}</div>
                <div class="name">{{$clinic -> name}}</div>
                <div style="font-family: sans-serif" class="name">{{$clinic -> time}}</div>
                <div class="actions">
                    @if($clinic -> clinic != "all")
                        <button  class="actions-btn" data-id="{{$clinic -> id}}"  >فعالیت ها</button>
                    @else
                        <span>ویرایش مجاز نیست</span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <section style="display: none" id="actions_popup" class="pop_up">
        <section class="actions-pop">

            <h2 class="kalame-bold" >فعالیت ها</h2>
            <p>شما از اینجا میتوانید فعالیت های مربوط به نوبت را انجام دهید</p>
            <div class="actions " style="width: 100%">
                <button id="delete_calendar" class=" button " >حذف نوبت</button>
                <button id="edite_calendar" class=" button " >ویرایش نوبت</button>

            </div>
            <x-spacer space="1rem" />
            <button class="close-btn send-btn" data-close="actions_popup">بستن</button>
        </section>

    </section>


    </section>
@endsection
