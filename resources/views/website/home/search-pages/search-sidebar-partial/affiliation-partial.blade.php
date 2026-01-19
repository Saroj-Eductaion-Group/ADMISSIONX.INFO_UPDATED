<div class="affiliation-type fillter-type single-item">
    <div class="ft-title">Affiliation</div>
    <div class="ft-content content ftn-content">
        <div style="margin-top:10px;">
            {{--*/ $approvedBy = [['name'=> 'AICTE'],['name'=> 'UGC'],['name'=> 'PCI'],['name'=> 'Others']] /*--}}
            @foreach( $approvedBy as $item )
                {{--*/ $approvedByFlag = 0 /*--}}
                @if( !empty(Request::get('approvedBy')) )
                    @foreach(Request::get('approvedBy') as $data)
                        @if( $data == $item['name'] )
                            <span>
                                <label class="input-main-select">
                                    <input type="checkbox" id="affiliation_{{ $item['name'] }}" name="approvedBy[]" checked="" value="{{ $item['name'] }}" class="ft-checkbox searchParam">
                                </label>
                                <label for="affiliation_{{ $item['name']}}" class="input-top-select">
                                    {{ $item['name'] }}
                                </label>    
                            </span>
                            {{--*/ $approvedByFlag = 1 /*--}}
                        @endif
                    @endforeach
                @endif
                @if( $approvedByFlag == '0' )
                    <span>
                        <label class="input-main-select">
                            <input type="checkbox" id="affiliation_{{ $item['name'] }}" name="approvedBy[]" value="{{ $item['name'] }}" class="ft-checkbox searchParam">
                        </label>
                        <label for="affiliation_{{ $item['name']}}" class="input-top-select">
                            {{ $item['name'] }}
                        </label>    
                    </span>
                @endif
            @endforeach
        </div>
     </div>
</div>