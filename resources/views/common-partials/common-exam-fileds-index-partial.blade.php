<div class="checkbox checkbox-primary">
    <input class="isShowOnTop" type="checkbox" tablename="{{ $tablename }}" id="{{ $item->id }}" name="isShowOnTop" @if( $item->isShowOnTop == 1) checked="" @endif>
    <label>
        @if($item->isShowOnTop == 1)
            <span class="label label-info isShowOnTopEnabled{{ $item->id }}">Is Show On Top List Enable</span>
        @else
            <span class="label label-danger isShowOnTopDisabled{{ $item->id }}">Is Show On Top List Disabled</span>
        @endif
        <span class="label label-info hide isShowOnTopEnabled1{{ $item->id }}">Is Show On Top List Enable</span>
        <span class="label label-danger hide isShowOnTopDisabled1{{ $item->id }}">Is Show On Top List Disabled</span>
    </label>
</div>

<div class="checkbox checkbox-primary">
    <input class="isShowOnHome" type="checkbox" tablename="{{ $tablename }}" id="{{ $item->id }}" name="isShowOnHome" @if( $item->isShowOnHome == 1) checked="" @endif>
    <label>
        @if($item->isShowOnHome == 1)
            <span class="label label-info isShowOnHomeEnabled{{ $item->id }}">Is Show On Exam Page Enable</span>
        @else
            <span class="label label-danger isShowOnHomeDisabled{{ $item->id }}">Is Show On Exam Page Disabled</span>
        @endif
        <span class="label label-info hide isShowOnHomeEnabled1{{ $item->id }}">Is Show On Exam Page Enable</span>
        <span class="label label-danger hide isShowOnHomeDisabled1{{ $item->id }}">Is Show On Exam Page Disabled</span>
    </label>
</div>

