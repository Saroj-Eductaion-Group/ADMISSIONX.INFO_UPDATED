@if(sizeof($getEducationLevelObj) > 0)
<div class="stream-type fillter-type @if(sizeof($getEducationLevelObj) > 5) sy @endif single-item">
    <div class="ft-title">Education Level</div>
    <div class="ft-content content">
        <div style="margin-top:10px;">
        @foreach( $getEducationLevelObj as $item )
            {{--*/ $educationLevelFlag = 0 /*--}}
            @if( !empty(Request::get('educationlevel')) )
                @foreach(Request::get('educationlevel') as $data)
                    @if( $data == $item->id )
                        <span class="input-main-select">
                            <label for="educationlevel_{{ $item->id }}" class="input-top-select">
                                <input type="checkbox" id="educationlevel_{{ $item->id }}" name="educationlevel[]" class="ft-checkbox searchParam" checked="" value="{{ $item->id }}">
                                {{$item->name}}
                            </label>    
                        </span>
                        {{--*/ $educationLevelFlag = 1 /*--}}
                    @endif
                @endforeach
            @endif
            @if( $educationLevelFlag == '0' )
                <span class="input-main-select">
                    <label for="educationlevel_{{ $item->id }}" class="input-top-select">
                        <input type="checkbox" id="educationlevel_{{ $item->id }}" name="educationlevel[]" class="ft-checkbox searchParam" value="{{ $item->id }}">
                        {{$item->name}}
                    </label>    
                </span>
            @endif
        @endforeach
        </div>
    </div>
</div>
@endif