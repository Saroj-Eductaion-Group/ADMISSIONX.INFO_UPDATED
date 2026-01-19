<p class="clearBothNow">
    @if(sizeof($collegeFeeObj) > 0)
        @if( $collegeFeeObj[0]->seats <= 5 && $collegeFeeObj[0]->seats > '0')
            <span class="pull-left text-left">Seats Available<br>{{ $collegeFeeObj[0]->seats }}</span>
        @endif
        @if(($collegeFeeObj[0]->fees == '0') || empty($collegeFeeObj[0]->fees))
            <span class="pull-right text-right"><b style="color: #cb3904;">Fee : N/A</b></span>
        @else
            <span style="" class="mobile-content-align text-right pull-right"><b style="color: #cb3904;">₹ {{ $collegeFeeObj[0]->fees }}</b></span><br> 
            <span class="mobile-content-align text-right pull-right" style="
             font-size: 10px;color: #5c952e;"> Per year </span>
        @endif
    @else
        <span class="pull-right text-right"><b style="color: #cb3904;">Fee : N/A</b></span>
    @endif
</p>