@php
    if(\Illuminate\Support\Facades\Auth::guard('manager') -> check()){
        $guard = 'manager';
        $user = \Illuminate\Support\Facades\Auth::guard('manager')->getUser();
    }
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - سامانه آموزشی شتاب</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/font/yekan/yekan.css">
    <link rel="stylesheet" href="/font/kalame/kalame.css">
    <link rel="stylesheet" href="/font/font-awsem/css/all.min.css">
    @vite('resources/css/app.css')
    @vite('resources/css/theme_st.css')
</head>
<body>

<header>

    <div class="items">
        <div id="notif_btn" class="notif">
            <i class="fa-regular fa-bell"></i>
            <span>اعلان ها</span>

            <div id="notif_box" style="display: none"  class="notif_box ">
                <span class="kalame-bold notifications">اعلان ها</span>

            </div>
        </div>
        <div class="profile" id="profile-btn">
            <div class="avatar"  >
                <img src="{{$user -> profile_path}}" alt="">
            </div>
            <span class="display_name" >{{$user -> name}}</span>


        </div>
        <div id="profile_box" style="display: none"  class="profile_box ">
            <span class="thin-text kalame-bold" > سلام {{$user -> name}} </span>
            <x-spacer space="10px" />
            <div class="profile-box-menu">
{{--                <a href="{{route("student.settings")}}">--}}
{{--                    <span>تنظیمات حساب کاربری</span>--}}
{{--                </a>--}}
{{--                <a href="{{route("student.logout")}}">--}}
{{--                    <span>خروج از حساب کاربری</span>--}}
{{--                </a>--}}
            </div>

        </div>

    </div>
    <div class="search">
        <div class="search_box">
            <div class="icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <input type="text" placeholder="دنبال چی میگردی" >
        </div>
    </div>
    <div class="logo">
        <h1 class="kalame-bold rtl" >دکترینو</h1>
    </div>
    <div class="open-sidebar">
        <button id="open-sidebar-btn" ><i class="fa-solid fa-bars"></i></button>
    </div>
</header>
<div  class="side_bar">
    <ul class="main" >
        @if($guard == 'manager')
            <li class="">
                <a href="{{route("manager.dashboard")}}/">
                    <div class="icon">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <span>داشبورد</span>
                </a>
            </li>
{{--            <li  >--}}
{{--                <a href="{{ route('student.settings') }}" >--}}
{{--                    <div class="icon">--}}
{{--                        <i class="fa-solid fa-gear"></i>--}}
{{--                    </div>--}}
{{--                    <span>تنظیمات</span>--}}
{{--                </a>--}}
{{--            </li>--}}
        @endif

    </ul>
    <div class="mobile-only side_bar_mobile_zone" style="display: none" >
        <nav  >
            <button>خروج از حساب</button>

            <button id="close-sidebar" >بستن</button>
        </nav>
        <ul class="" >

            @if($guard == 'manager')
                <li class="">
                    <a href="{{route("manager.dashboard")}}/">
                        <div class="icon">
                            <i class="fa-solid fa-eye"></i>
                        </div>
                        <span>داشبورد</span>
                    </a>
                </li>
{{--                <li  >--}}
{{--                    <a href="{{ route('student.settings') }}" >--}}
{{--                        <div class="icon">--}}
{{--                            <i class="fa-solid fa-gear"></i>--}}
{{--                        </div>--}}
{{--                        <span>تنظیمات</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
            @endif

        </ul>
    </div>
</div>
<div class="end-side-bar" style="grid-area: end-side-bar">

</div>
<div class="top_sidebar">
    <img class="shetab_logo" src="/images/logo.png" alt="">
</div>
<div class="content">
@yield('content')
</div>
