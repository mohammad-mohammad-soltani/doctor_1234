<div class="course_card  @if(is_array($button)) array_box @endif ">
    <div class="line w-full"></div>

    <div class="data">
        <div class="title">{{$title}}</div>
        <x-spacer space="10px"/>
        @if(is_array($button))
            <div class="flex-buttons">
                @foreach($button as $key => $val)
                    <a href="{{$prefix[$key]}}{{$id}}" >{{$val }} </a>
                @endforeach
            </div>
        @else
            <a href="{{$prefix}}{{$id}}" >{{$button }} </a>
        @endif
    </div>

</div>

