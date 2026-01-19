<div class="school-type fillter-type single-item">
   <div class="ft-title">College Type</div>
   <div class="ft-content content">
        <div style="margin-top:10px;">
        @foreach( $collegeType as $item )
            {{--*/ $collegeTypeFlag = 0 /*--}}
            @if( !empty(Request::get('collegeType')) )
                @foreach(Request::get('collegeType') as $data)
                    @if( $data == $item->id )
                        <span>
                            <label class="input-main-select">
                                <input type="checkbox" id="collegeType_{{ $item->id }}" name="collegeType[]" class="ft-checkbox searchParam" checked="" value="{{ $item->id }}">
                            </label>
                            <label for="collegeType_{{ $item->id }}" class="input-top-select">
                                {{$item->name}}
                            </label>    
                        </span>
                        {{--*/ $collegeTypeFlag = 1 /*--}}
                    @endif
                @endforeach
            @endif
            @if( $collegeTypeFlag == '0' )
                <span>
                    <label class="input-main-select">
                        <input type="checkbox" id="collegeType_{{ $item->id }}" name="collegeType[]" class="ft-checkbox searchParam" value="{{ $item->id }}">
                    </label>
                    <label for="collegeType_{{ $item->id }}" class="input-top-select">
                        {{$item->name}}
                    </label>    
                </span>
            @endif
        @endforeach
        </div>
    </div>
</div>