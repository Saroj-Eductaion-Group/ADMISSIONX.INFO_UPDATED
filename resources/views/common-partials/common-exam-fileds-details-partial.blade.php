<tr>
    <th>Is Show On Top</th>
    <td>
        @if( isset($newUpdatedFields) && $newUpdatedFields->isShowOnTop == '1') 
        	<label class="label label-success">Enabled</label>
        @elseif( isset($newUpdatedFields) && $newUpdatedFields->isShowOnTop == '0')
            <label class="label label-warning">Disable</label>
        @endif   
    </td>
</tr>
<tr>
    <th>Is Show On Home</th>
    <td>
        @if( isset($newUpdatedFields) && $newUpdatedFields->isShowOnHome == '1') 
        	<label class="label label-success">Enabled</label>
        @elseif( isset($newUpdatedFields) && $newUpdatedFields->isShowOnHome == '0')
            <label class="label label-warning">Disable</label>
        @endif    
    </td>
</tr>