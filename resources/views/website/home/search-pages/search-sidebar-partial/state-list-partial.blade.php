@if(sizeof($getAllStateObj) > 0)
<div class="stream-type fillter-type @if(sizeof($getAllStateObj) > 5) sy @endif single-item">
    <div class="ft-title">State</div>
    <div class="ft-content content">
        <div style="margin-top:10px;">
        @foreach( $getAllStateObj as $item )
            {{--*/ $stateFlag = 0 /*--}}
            @if( !empty(Request::get('state')) )
                @foreach(Request::get('state') as $data)
                    @if( $data == $item->id )
                        <span class="input-main-select">
                            <label for="state_{{ $item->id }}" class="input-top-select">
                                <input type="checkbox" id="state_{{ $item->id }}" name="state[]" class="ft-checkbox searchParam" checked="" value="{{ $item->id }}">
                                {{$item->name}}
                            </label>    
                        </span>
                        {{--*/ $stateFlag = 1 /*--}}
                    @endif
                @endforeach
            @endif
            @if( $stateFlag == '0' )
                <span class="input-main-select">
                    <label for="state_{{ $item->id }}" class="input-top-select">
                        <input type="checkbox" id="state_{{ $item->id }}" name="state[]" class="ft-checkbox searchParam" value="{{ $item->id }}">
                        {{$item->name}}
                    </label>    
                </span>
            @endif
        @endforeach
        </div>
    </div>
</div>
@endif