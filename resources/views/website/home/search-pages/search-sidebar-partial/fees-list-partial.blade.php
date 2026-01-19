<div class="stream-type fillter-type single-item">
    <div class="ft-title">Fees</div>
    <div class="ft-content content">
        <div style="margin-top:10px;">
            <span>
                <label class="input-main-select">
                    <input type="radio" id="fees_1" name="fees" value="1" @if(Request::get('fees') == '1') checked="" @endif ><i class="rounded-x"></i>
                </label>
                <label for="fees_1" class="input-top-select">< 1 Lakh </label>    
            </span>
            <span>
                <label class="input-main-select">
                    <input type="radio" id="fees_2" name="fees" value="2" @if(Request::get('fees') == '2') checked="" @endif ><i class="rounded-x"></i>
                </label>
                <label for="fees_2" class="input-top-select"> 1 - 2 Lakh </label>
            </span>
            <span>
                <label class="input-main-select">
                    <input type="radio" id="fees_3" name="fees" value="3" @if(Request::get('fees') == '3') checked="" @endif ><i class="rounded-x"></i>
                </label>
                <label for="fees_3" class="input-top-select"> 2 - 3 Lakh </label>
            </span>
            <span>
                <label class="input-main-select">
                    <input type="radio" id="fees_4" name="fees" value="4" @if(Request::get('fees') == '4') checked="" @endif ><i class="rounded-x"></i>
                </label>
                <label for="fees_4" class="input-top-select"> 3 - 5 Lakh </label>
            </span>
            <span>
                <label class="input-main-select">
                    <input type="radio" id="fees_5" name="fees" value="5" @if(Request::get('fees') == '5') checked="" @endif ><i class="rounded-x"></i>
                </label>
                <label for="fees_5" class="input-top-select"> > 5 Lakh </label>
            </span>
        </div>
     </div>
</div>