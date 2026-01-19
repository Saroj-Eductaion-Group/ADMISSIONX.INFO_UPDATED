@if(sizeof($getCourseObj) > 0)
<div class="stream-type fillter-type @if(sizeof($getCourseObj) > 5) sy @endif single-item">
    <div class="ft-title">Courses</div>
    <div class="ft-content content">
        <div style="margin-top:10px;">
        @foreach( $getCourseObj as $item )
            {{--*/ $courseFlag = 0 /*--}}
            @if( !empty(Request::get('course')) )
                @foreach(Request::get('course') as $data)
                    @if( $data == $item->id )
                        <span class="input-main-select">
                            <label for="course_{{ $item->id }}" class="input-top-select">
                                <input type="checkbox" id="course_{{ $item->id }}" name="course[]" class="ft-checkbox searchParam" checked="" value="{{ $item->id }}">
                                {{$item->name}}
                            </label>    
                        </span>
                        {{--*/ $courseFlag = 1 /*--}}
                    @endif
                @endforeach
            @endif
            @if( $courseFlag == '0' )
                <span class="input-main-select">
                    <label for="course_{{ $item->id }}" class="input-top-select">
                        <input type="checkbox" id="course_{{ $item->id }}" name="course[]" class="ft-checkbox searchParam" value="{{ $item->id }}">
                        {{$item->name}}
                    </label>    
                </span>
            @endif
        @endforeach
        </div>
    </div>
</div>
@endif