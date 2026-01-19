@if(sizeof($getCountryObj) > 0)
<div class="stream-type fillter-type @if(sizeof($getCountryObj) > 5) sy @endif single-item">
    <div class="ft-title">Country</div>
    <div class="ft-content content">
        <div style="margin-top:10px;">
        @foreach( $getCountryObj as $item )
            {{--*/ $countryFlag = 0 /*--}}
            @if( !empty(Request::get('country')) )
                @foreach(Request::get('country') as $data)
                    @if( $data == $item->id )
                        <span class="input-main-select">
                            <label for="country_{{ $item->id }}" class="input-top-select">
                                <input type="checkbox" id="country_{{ $item->id }}" name="country[]" class="ft-checkbox searchParam" checked="" value="{{ $item->id }}">
                                {{$item->name}}
                            </label>    
                        </span>
                        {{--*/ $countryFlag = 1 /*--}}
                    @endif
                @endforeach
            @endif
            @if( $countryFlag == '0' )
                <span class="input-main-select">
                    <label for="country_{{ $item->id }}" class="input-top-select">
                        <input type="checkbox" id="country_{{ $item->id }}" name="country[]" class="ft-checkbox searchParam" value="{{ $item->id }}">
                        {{$item->name}}
                    </label>    
                </span>
            @endif
        @endforeach  
        </div> 
    </div>
</div>
@endif