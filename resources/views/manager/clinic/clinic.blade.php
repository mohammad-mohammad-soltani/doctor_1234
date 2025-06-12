@extends('layout.student')
@section('content')
    <h1 class="kalame-black text-2xl" >لیست کلینیک ها</h1>
    <p>برای مدیریت کلینیک ها ابتدا یک کلینیک را انتخاب و سپس دکمه فعالیت ها را فشار دهید</p>
    <x-spacer space="1rem" />
    <x-spacer space="1rem"/>
    <div class="table" >
        <div class="line head">
            <div class="id">#</div>
            <div class="name">نام کلینیک</div>
            <div class="actions">فعالیت ها</div>
        </div>
        @foreach(\App\Models\Clinic::get() as $clinic)
            <div id="col_{{$clinic -> id}}" class="line"  >
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
                <a href="./" id="clinic_settings_btn"  class="add_doctor button" >تنظیمات کلینیک</a>
                <button id="remove_clinic" class="add_origin button" >حذف کلینیک</button>

            </div>
            <x-spacer space="1rem" />
            <button class="close-btn send-btn" data-close="actions_popup">بستن</button>
        </section>

    </section>
@endsection
