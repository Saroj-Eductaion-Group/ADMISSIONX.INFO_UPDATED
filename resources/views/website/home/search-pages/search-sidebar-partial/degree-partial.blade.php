@if(sizeof($getDegreeObj) > 0)
<div class="stream-type fillter-type @if(sizeof($getDegreeObj) > 5) sy @endif single-item">
    <div class="ft-title">Degree</div>
    <div class="ft-content content">
        <div style="margin-top:10px;">
        @foreach( $getDegreeObj as $item )
            {{--*/ $degreeFlag = 0 /*--}}
            @if( !empty(Request::get('degree')) )
                @foreach(Request::get('degree') as $data)
                    @if( $data == $item->id )
                        <span class="input-main-select">
                            <label for="degree_{{ $item->id }}" class="input-top-select">
                                <input type="checkbox" id="degree_{{ $item->id }}" name="degree[]" class="ft-checkbox searchParam" checked="" value="{{ $item->id }}">
                                {{$item->name}}
                            </label>    
                        </span>
                        {{--*/ $degreeFlag = 1 /*--}}
                    @endif
                @endforeach
            @endif
            @if( $degreeFlag == '0' )
                <span class="input-main-select">
                    <label for="degree_{{ $item->id }}" class="input-top-select">
                        <input type="checkbox" id="degree_{{ $item->id }}" name="degree[]" class="ft-checkbox searchParam" value="{{ $item->id }}">
                        {{$item->name}}
                    </label>    
                </span>
            @endif
        @endforeach
        </div>
    </div>
</div>
@endif