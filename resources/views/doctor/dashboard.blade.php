@extends('layout.student')
@section('content')
    <h1 class="text-xl" style="font-family: kalameBold">نوبت هایی که شما در پیش دارید</h1>
    <p>در لیست زیر شما لیست نوبت هایی که برای شما ثبت شده است را مشاهده خواهید کرد . اگر لیست خالی بود به این معناست که در آینده نوبتی برای شما ثبت نشده است</p>
    <x-spacer space="1.7rem"/>
    <div class="table" >
        <div class="line head">
            <div class="id">#</div>
            <div class="name">نام مراجعه کننده</div>
            <div class="name">تاریخ</div>
            <div class="actions">فعالیت ها</div>
        </div>
        @foreach(\App\Models\Calendar::where('clinic_id', Auth::guard('doctor')->user()->clinic_id)->get() as $clinic)
            @php
                $clinicDate = Morilog\Jalali\Jalalian::fromFormat('Y/m/d H:i:s', $clinic->time)->format('Y/m/d');
                $now = Morilog\Jalali\Jalalian::now()->format('Y/m/d');

                $isFuture = $clinicDate >= $now;
            @endphp


        @if($isFuture)
                <div class="line">
                    <div class="id">{{ $clinic->id }}</div>
                    <div class="name">{{ $clinic->name }}</div>
                    <div class="name" style="font-family: sans-serif">{{ $clinic->time }}</div>
                    <div class="actions">
                        @if($clinic->clinic != "all")
                            <button class="actions-btn" data-id="{{ $clinic->id }}">فعالیت ها</button>
                        @else
                            <span>ویرایش مجاز نیست</span>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach



    </div>
    <section style="display: none" id="actions_popup" class="pop_up">
        <section class="actions-pop">

            <h2 class="kalame-bold" >فعالیت ها</h2>
            <p>شما از اینجا میتوانید فعالیت های مربوط به نوبت را انجام دهید</p>
            <div class="actions " style="width: 100%">
                <button id="view_calendar"  class=" button " >مشاهده و ویرایش نوبت</button>
                <button id="delete_calendar2" class=" button " >حذف نوبت</button>


            </div>
            <x-spacer space="1rem" />
            <button class="close-btn send-btn" data-close="actions_popup">بستن</button>
        </section>

    </section>
@endsection
