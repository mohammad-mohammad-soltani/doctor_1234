@extends('layout.student')
@section('content')
    <h2 class="kalame-black text-2xl" >لیست پزشکان</h2>
    <x-spacer space="0.7rem" />
    <div class="table" >
        <div class="line head">
            <div class="id">#</div>
            <div class="name">نام پزشک</div>
            <div class="name"></div>
            <div class="actions">فعالیت ها</div>
        </div>
        @foreach(\App\Models\Doctor::where('clinic_id' , $clinic_id) -> get() as $clinic)
            <div id="col_{{$clinic -> id}}_doctor" class="line"  >
                <div class="id">{{$clinic -> id}}</div>
                <div class="name name_v">{{$clinic -> name}}</div>
                <div class="name"></div>

                <div class="actions">
                    <button  class="manage_doctor"  data-id="{{$clinic -> id}}"  >فعالیت ها</button>
                </div>
            </div>
        @endforeach
    </div>
    <x-spacer space="0.7rem" />
    <h2 class="kalame-black text-2xl">لیست منشی ها</h2>
    <x-spacer space="0.7rem" />
    <div class="table" >
        <div class="line head">
            <div class="id">#</div>
            <div class="name">نام منشی</div>
            <div class="name">پزشک</div>
            <div class="actions">فعالیت ها</div>
        </div>
        @foreach(\App\Models\Origin::where('clinic_id' , $clinic_id) -> get() as $nr)
            <div id="col_{{$nr -> id}}_origin" class="line"  >
                <div class="id">{{$nr -> id}}</div>
                <div class="name">{{$nr -> name}}</div>
                @php
                    try {
                        $doctor = \App\Models\Doctor::find($nr->doctor);
                        $doctorName = $doctor ? $doctor->name : 'پزشک حذف شده';
                    } catch(Exception $e) {
                        $doctorName = 'پزشک حذف شده است';
                    }
                @endphp

                <div class="name">{{ $doctorName }}</div>

                <div class="actions">
                    <button  class="actions-bt manage_origin" data-id="{{$nr -> id}}"  >فعالیت ها</button>
                </div>
            </div>
        @endforeach
    </div>

    <section style="display: none" id="actions_popup_doctor" class="pop_up">
        <section class="actions-pop">

            <h2 class="kalame-bold" >مدیریت دکتر</h2>
            <p>شما از اینجا میتوانید پزشک مورد نظرتان را مدیریت کنید</p>
            <div class="actions " style="width: 100%">
                <button id="edite_doctor" class="button" >ویرایش پزشک</button>
                <button id="remove_doctor_from_clinic" class=" button" >حذف پزشک از کلینیک</button>

            </div>
            <x-spacer space="1rem" />
            <button class="close-btn send-btn" data-close="actions_popup_doctor">بستن</button>
        </section>

    </section>
    <section style="display: none" id="actions_popup_origin" class="pop_up">
        <section class="actions-pop">

            <h2 class="kalame-bold" >مدیریت منشی</h2>
            <p>شما از اینجا میتوانید منشی مورد نظرتان را مدیریت کنید</p>
            <div class="actions " style="width: 100%">
                <button id="edite_origin" class="button" >ویرایش منشی</button>
                <button id="remove_origin_from_clinic" class=" button" >حذف منشی از کلینیک</button>

            </div>
            <x-spacer space="1rem" />
            <button class="close-btn send-btn" data-close="actions_popup_origin">بستن</button>
        </section>

    </section>
    <section style="display: none" id="edite_doctor_pop" class="pop_up">
        <section class="add-clinic ">
            <div class="line_1">
                <label class="kalame-bold" for="">نام پزشک</label>
                <x-spacer space="1rem" />
                <input id="doctor_name" type="text" class="simple-border-input w-full ">
                <x-spacer space="0.5rem" />
                <label class="kalame-bold" for="">کلمه عبور</label>
                <x-spacer space="1rem" />
                <input placeholder="اگر میخواهید تغییر نکند خالی بگذارید" id="doctor_password" type="text" class="simple-border-input w-full ">
                <x-spacer space="1rem"/>
                <button data-close="edite_doctor_pop" class="send-btn desk-close close-btn" >بستن</button>

            </div>
            <div class="line_2">
                <label  class="kalame-bold w-full" for="">نام کاربری</label>
                <x-spacer space="1rem" />
                <input id="doctor_username" type="text" class="simple-border-input w-full ">
                <x-spacer space="0.5rem" />


                <x-spacer space="1rem" />
                <button id="edite_doctor_btn" class="send-btn" >ویرایش پزشک</button>
                <div class="mobile-only" style="display: none">
                    <x-spacer space="0.7rem"  />
                </div>
                <button data-close="edite_doctor_pop"  class="close-btn send-btn mobile-only" style="display: none" >بستن</button>
            </div>

        </section>

    </section>
    <section style="display: none" id="edite_origin_pop" class="pop_up">
        <section class="add-clinic ">
            <div class="line_1">
                <label class="kalame-bold" for="">نام منشی</label>
                <x-spacer space="1rem" />
                <input id="origin_name" type="text" class="simple-border-input w-full ">
                <x-spacer space="0.5rem" />
                <label class="kalame-bold" for="">کلمه عبور</label>
                <x-spacer space="1rem" />
                <input placeholder="اگر میخواهید تغییر نکند خالی بگذارید" id="origin_password" type="text" class="simple-border-input w-full ">
                <x-spacer space="1rem"/>
                <button data-close="edite_origin_pop" class="send-btn desk-close close-btn" >بستن</button>

            </div>
            <div class="line_2">
                <label  class="kalame-bold w-full" for="">نام کاربری</label>
                <x-spacer space="1rem" />
                <input id="origin_username" type="text" class="simple-border-input w-full ">
                <x-spacer space="0.5rem" />


                <x-spacer space="1rem" />
                <button id="edite_origin_btn" class="send-btn" >ویرایش منشی</button>
                <div class="mobile-only" style="display: none">
                    <x-spacer space="0.7rem"  />
                </div>
                <button data-close="edite_origin_pop"  class="close-btn send-btn mobile-only" style="display: none" >بستن</button>
            </div>

        </section>

    </section>



@endsection
