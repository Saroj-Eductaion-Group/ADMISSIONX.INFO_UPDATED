@if(sizeof($getAllCityObj) > 0)
<div class="stream-type fillter-type @if(sizeof($getAllCityObj) > 5) sy @endif single-item">
    <div class="ft-title">City</div>
    <div class="ft-content content">
        <div style="margin-top:10px;">
        @foreach( $getAllCityObj as $item )
            {{--*/ $cityFlag = 0 /*--}}
            @if( !empty(Request::get('city')) )
                @foreach(Request::get('city') as $data)
                    @if( $data == $item->id )
                        <span class="input-main-select">
                            <label for="city_{{ $item->id }}" class="input-top-select">
                                <input type="checkbox" id="city_{{ $item->id }}" name="city[]" class="ft-checkbox searchParam" checked="" value="{{ $item->id }}">
                                {{$item->name}}
                            </label>    
                        </span>
                        {{--*/ $cityFlag = 1 /*--}}
                    @endif
                @endforeach
            @endif
            @if( $cityFlag == '0' )
                <span class="input-main-select">
                    <label for="city_{{ $item->id }}" class="input-top-select">
                        <input type="checkbox" id="city_{{ $item->id }}" name="city[]" class="ft-checkbox searchParam" value="{{ $item->id }}">
                        {{$item->name}}
                    </label>    
                </span>
            @endif
        @endforeach
        </div>
    </div>
</div>
@endif