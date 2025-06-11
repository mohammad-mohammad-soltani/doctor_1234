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
    <h1 class="kalame-black text-2xl" > افزودن محصول</h1>
    <x-spacer space="1rem"/>
    <section class="add-clinic">
        <div class="line_1">
            <label class="kalame-bold" for="">نام محصول</label>
            <x-spacer space="1rem" />
            <input id="product_name" type="text" class="simple-border-input w-full ">
        </div>
        <div class="line_2">
            <button id="new_product" class="send-btn" >افزودن محصول</button>
        </div>
    </section>
    <x-spacer space="1rem" />
    <h1 class="kalame-black text-2xl" >لیست محصولات</h1>
    <x-spacer space="1rem"/>
    <div class="table" >
        <div class="line head">
            <div class="id">#</div>
            <div class="name">نام محصول</div>
            <div class="name">کلینیک</div>
            <div class="actions">فعالیت ها</div>
        </div>
        @foreach(\App\Models\Products::get() as $clinic)
            <div id="col_{{$clinic -> id}}" class="line"  >
                <div class="id">{{$clinic -> id}}</div>
                <div class="name">{{$clinic -> name}}</div>
                <div class="name">{{get_clinic_name($clinic -> clinic)}}</div>
                <div class="actions">
                    <button  class="actions-btn" data-id="{{$clinic -> id}}"  >فعالیت ها</button>
                </div>
            </div>
        @endforeach
    </div>
    <section style="display: none" id="actions_popup" class="pop_up">
        <section class="actions-pop">

            <h2 class="kalame-bold" >فعالیت ها</h2>
            <p>شما از اینجا میتوانید فعالیت های مربوط به کالاها / خدمات را انجام دهید</p>
            <div class="actions " style="width: 100%">
                <button id="delete_product_btn" class=" button full" >حذف کالا / خدمت</button>

            </div>
            <x-spacer space="1rem" />
            <button class="close-btn send-btn" data-close="actions_popup">بستن</button>
        </section>

    </section>


    </section>
@endsection
