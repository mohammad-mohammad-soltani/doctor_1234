<!doctype html>
<html lang="en">
<head>
    @vite("resources/css/app.css")
    @vite('resources/css/st_login.css')

    @vite("resources/js/app.js")

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/font/yekan/yekan.css">
    <link rel="stylesheet" href="/font/kalame/kalame.css">
    <link rel="stylesheet" href="/font/font-awsem/css/all.min.css">
    <title>ورود - سامانه مدلاین</title>

</head>
<body  style="background: url(/images/login-bg.jpg)" >

<form action="{{route('origin.login_post')}}" method="post">
    @csrf

    <div class="login  ">
        <h1 class="font-black" >ورود منشی - سامانه مدلاین</h1>
        <x-spacer space="30px" />
        <label class="text-right"  >نام کاربری</label>
        <input type="text" value="{{old('username')}}" name="username" placeholder="نام کاربری">
        <p class="error p-10 {{ count($errors->get('username')) == 0 ? "invisible" : "" }} "    >

            @error('username')
            {{ $message }}
            @enderror
        </p>
        <label class="text-right  " >کلمه عبور</label>
        <input type="password" value="{{old('password')}}" name="password" placeholder="کلمه عبور" ></input>
        <p class="error p-10  {{ count($errors->get('password')) == 0 ? "invisible" : "" }}  " >
            @error('password')
            {{ $message }}
            @enderror
        </p>
        <x-spacer space="20px" />
        <button type="submit" class="submit-button " >وارد شوید</button>
    </div>
</form>
</body>
</html>
