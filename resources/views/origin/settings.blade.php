@extends('layout.student')
@section('content')
    <style>
        .content{
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    <div class="main_form">
        <div class="inner_form_box">
            <h2>اطلاعات حساب کاربری</h2>
            <span class="thin-text" >شما میتوانید اطلاعات غیر ضروری خود را ویرایش کنید</span>
            <x-spacer space="20px" />
            <div class="line_form_items">
                <label  class="thin-text" for="name">نام و نام خانوادگی</label>
                <input autocomplete="off" class="simple-border-input thin-text en " placeholder="نام کاربری خود را وارد نمایید"  type="text" name="username" id="name" value="{{$user -> name}}">
            </div>
            <x-spacer space="20px" />
            <div class="line_form_items">
                <label  class="thin-text" for="username">نام کاربری</label>
                <input autocomplete="off"  class="simple-border-input thin-text en " placeholder="نام کاربری خود را وارد نمایید"  type="text" name="username" id="username" value="{{$user -> username}}">
            </div>
            <x-spacer space="20px" />
            <div class="line_form_items">
                <label  class="thin-text" for="password">کلمه عبور</label>
                <input autocomplete="off" class="simple-border-input thin-text en" placeholder="کلمه عبور جدید خود را وارد نمایید"  type="text" name="password" id="password">
            </div>
            <x-spacer space="1rem" />
            <button id="manager_settings" class="send-btn" >ذخیره تغییرات </button>
        </div>
    </div>
@endsection
