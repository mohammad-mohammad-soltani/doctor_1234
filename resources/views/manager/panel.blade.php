@extends('layout.student')
@section('title' , 'صفحه اصلی')

@section('content')
    <x-spacer space="20px" />
    <div class="main_page_grid">
        <div class="student_describe box-1-3">
            <h2>تعداد کل کلینیک ها :</h2>
            <span><span>{{\App\Models\Clinic::all()->count()}}</span><span></span> <span>کلینیک</span> </span>
            <x-spacer space="2rem" />
            <a  class="text-center send-btn">مدیریت کلینیک ها</a>
        </div>
        <div class="score_box box-1-3">
            <h2>تعداد کل پزشکان : </h2>
            <span><span>{{\App\Models\Doctor::all()->count()}}</span> پزشک</span>
            <x-spacer space="2rem" />
            <a  class="text-center send-btn">مدیریت پزشکان</a>
        </div>
        <div class="class_days box-1-3">
            <h2> تعداد کل منشی ها: </h2>
            <span><span>{{\App\Models\Doctor::all()->count()}}</span> منشی</span>
            <x-spacer space="2rem" />
            <a  class="text-center send-btn">مدیریت منشی ها</a>
        </div>
    </div>
    <x-spacer space="2rem"/>
    <h2 class="kalame-bold text-xl text-center" >5 نوبت آخر ثبت شده در سامانه</h2>
    <x-spacer space="1rem"/>
    <div class="table box-full" >
        <div class="line head">
            <div class="id">#</div>
            <div class="name">نام مراجعه کننده</div>
            <div class="name">تاریخ</div>
        </div>
        @foreach(\App\Models\Calendar::limit(5) -> get() as $clinic)
            <div id="col_{{$clinic -> id}}" class="line"  >
                <div class="id">{{$clinic -> id}}</div>
                <div class="name">{{$clinic -> name}}</div>
                <div style="font-family: sans-serif" class="name">{{$clinic -> time}}</div>
            </div>
        @endforeach
    </div>


@endsection
