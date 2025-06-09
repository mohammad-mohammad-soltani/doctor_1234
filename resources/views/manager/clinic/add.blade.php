@extends('layout.student')
@section('title' , 'افزودن کلینیک')
@section('content')
    <x-spacer space="1rem" />
    <h1 class="kalame-black text-2xl" > افزودن کلینیک</h1>
    <x-spacer space="1rem"/>
    <section class="add-clinic">
        <div class="line_1">
            <label class="kalame-bold" for="">نام کلینیک</label>
            <x-spacer space="1rem" />
            <input id="clinic_name" type="text" class="simple-border-input w-full ">
        </div>
        <div class="line_2">
            <button id="new_clinic" class="send-btn" >افزودن کلینیک</button>
        </div>
    </section>
    <x-spacer space="1rem" />
    <h1 class="kalame-black text-2xl" >لیست کلینیک ها</h1>
    <x-spacer space="1rem"/>
    <div class="table" >
        <div class="line head">
            <div class="id">#</div>
            <div class="name">نام کلینیک</div>
            <div class="actions">فعالیت ها</div>
        </div>
        @foreach(\App\Models\Clinic::get() as $clinic)
            <div class="line"  >
                <div class="id">{{$clinic -> id}}</div>
                <div class="name">{{$clinic -> name}}</div>
                <div class="actions">
                    <button  class="actions-btn" data-id="{{$clinic -> id}}"  >فعالیت ها</button>
                </div>
            </div>
        @endforeach
    </div>
    <section style="display: none" id="actions_popup" class="pop_up">
        <section class="actions-pop">

            <h2 class="kalame-bold" >فعالیت ها</h2>
            <p>شما از اینجا میتوانید فعالیت های مربوط به کلینیک ها را انجام دهید</p>
            <div class="actions " style="width: 100%">
                <button id="add_doctor_btn" class="add_doctor button" >افزودن پزشک</button>
                <button id="add_origin_btn" class="add_origin button" >افزودن منشی</button>
                <button id="add_origin_btn" class="add_origin button full" >مدیریت کلینیک</button>

            </div>
            <x-spacer space="1rem" />
            <button class="close-btn send-btn" data-close="actions_popup">بستن</button>
        </section>

    </section>

    <section class="pop_up" id="add_doctor" style="display: none">
        <section class="add-clinic ">
            <div class="line_1">
                <label class="kalame-bold" for="">نام پزشک</label>
                <x-spacer space="1rem" />
                <input id="doctor_name" type="text" class="simple-border-input w-full ">
                <x-spacer space="0.5rem" />
                <label class="kalame-bold" for="">کلمه عبور</label>
                <x-spacer space="1rem" />
                <input id="doctor_password" type="text" class="simple-border-input w-full ">
                <x-spacer space="1rem"/>
                <button data-close="add_doctor" class="send-btn desk-close close-btn" >بستن</button>

            </div>
            <div class="line_2">
                <label  class="kalame-bold w-full" for="">نام کاربری</label>
                <x-spacer space="1rem" />
                <input id="doctor_username" type="text" class="simple-border-input w-full ">
                <x-spacer space="0.5rem" />

                <x-spacer space="1rem" />
                <button id="new_doctor" class="send-btn" >افزودن پزشک</button>
                <div class="mobile-only" style="display: none">
                    <x-spacer space="0.7rem"  />
                </div>
                <button data-close="add_doctor"  class="close-btn send-btn mobile-only" style="display: none" >بستن</button>

            </div>

        </section>
    </section>
    <section class="pop_up" id="add_origin" style="display: none">
        <section class="add-clinic ">
            <div class="line_1">
                <label class="kalame-bold" for="">نام منشی</label>
                <x-spacer space="1rem" />
                <input id="origin_name" type="text" class="simple-border-input w-full ">
                <x-spacer space="0.5rem" />
                <label class="kalame-bold" for="">کلمه عبور</label>
                <x-spacer space="1rem" />
                <input id="origin_password" type="text" class="simple-border-input w-full ">
                <x-spacer space="1rem"/>
                <button data-close="add_origin" class="send-btn desk-close close-btn" >بستن</button>

            </div>
            <div class="line_2">
                <label  class="kalame-bold w-full" for="">نام کاربری</label>
                <x-spacer space="1rem" />
                <input id="origin_username" type="text" class="simple-border-input w-full ">
                <x-spacer space="0.5rem" />

                <x-spacer space="1rem" />
                <button id="new_origin" class="send-btn" >افزودن منشی</button>
                <div class="mobile-only" style="display: none">
                    <x-spacer space="0.7rem"  />
                </div>
                <button data-close="add_origin"  class="close-btn send-btn mobile-only" style="display: none" >بستن</button>
            </div>

        </section>
    </section>
    </section>
@endsection
