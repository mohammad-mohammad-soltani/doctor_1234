@extends('layout.student')
@section('title' , 'صفحه اصلی')

@section('content')
    <x-spacer space="20px" />
    <div class="main_page_grid">
        <div class="student_describe box-1-3">
            <h2>تعداد نوبت های ثبت شده کلینیک :</h2>
            <span><span>{{\App\Models\Calendar::where('clinic_id' , Auth::guard('origin') -> user() -> clinic_id ) -> get()->count()}}</span><span></span> <span>کلینیک</span> </span>
            <x-spacer space="2rem" />
        </div>
        <div class="score_box box-1-3">
            <h2>تعداد کل پزشکان کیلینیک: </h2>
            <span><span>{{\App\Models\Doctor::where('clinic_id' , Auth::guard('origin') -> user() -> clinic_id ) -> get()->count()}}</span> پزشک</span>
            <x-spacer space="2rem" />
        </div>
        <div class="class_days box-1-3">
            <h2> تعداد کل منشی های کلینیک: </h2>
            <span><span>{{\App\Models\Origin::where('clinic_id' , Auth::guard('origin') -> user() -> clinic_id ) -> get()->count()}}</span> منشی</span>
            <x-spacer space="2rem" />
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
        @foreach(\App\Models\Calendar::where('clinic_id' , Auth::guard('origin') -> user() -> clinic_id ) -> limit(5) -> get() as $clinic)
            <div id="col_{{$clinic -> id}}" class="line"  >
                <div class="id">{{$clinic -> id}}</div>
                <div class="name">{{$clinic -> name}}</div>
                <div style="font-family: sans-serif" class="name">{{$clinic -> time}}</div>
            </div>
        @endforeach
    </div>


@endsection
