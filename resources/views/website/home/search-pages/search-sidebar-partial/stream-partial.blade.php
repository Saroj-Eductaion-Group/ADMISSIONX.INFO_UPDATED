@if(sizeof($getFunctionalAreaObj) > 0)
<div class="category-type fillter-type @if(sizeof($getFunctionalAreaObj) > 5) sy @endif single-item">
    <div class="ft-title">Stream</div>
    <div class="ft-content content">
        <div style="margin-top:10px;">
        @foreach( $getFunctionalAreaObj as $item )
            {{--*/ $functionalareaFlag = 0 /*--}}
            @if( !empty(Request::get('functionalarea')) )
                @foreach(Request::get('functionalarea') as $data)
                    @if( $data == $item->id )
                        <span class="input-main-select">
                            <label for="functionalarea_{{ $item->id }}" class="input-top-select">
                                <input type="checkbox" id="functionalarea_{{ $item->id }}" name="functionalarea[]" class="ft-checkbox searchParam" checked="" value="{{ $item->id }}">
                                {{$item->name}}
                            </label>    
                        </span>
                        {{--*/ $functionalareaFlag = 1 /*--}}
                    @endif
                @endforeach
            @endif
            @if( $functionalareaFlag == '0' )
                <span class="input-main-select">
                    <label for="functionalarea_{{ $item->id }}" class="input-top-select">
                        <input type="checkbox" id="functionalarea_{{ $item->id }}" name="functionalarea[]" class="ft-checkbox searchParam" value="{{ $item->id }}">
                        {{$item->name}}
                    </label>    
                </span>
            @endif
        @endforeach
        </div>
    </div>
</div>
@endif