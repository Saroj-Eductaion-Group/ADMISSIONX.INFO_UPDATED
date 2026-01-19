<tr>
    <th>Page Title</th>
    <th>
        {{ isset($newUpdatedFields) && isset($newUpdatedFields->pagetitle) ? $newUpdatedFields->pagetitle : ''}}
    </th>
</tr>
<tr>
    <th>Page Description</th>
    <th>
        {!! isset($newUpdatedFields) && isset($newUpdatedFields->pagedescription) ? $newUpdatedFields->pagedescription : '' !!}
    </th>
</tr>
<tr class="@if(isset($tablename) && ($tablename == 'state')) hide @elseif(isset($tablename) && ($tablename == 'city')) hide @else @endif">
    <th> Logo Image </th>
    <td> 
        @if(isset($newUpdatedFields) && isset($newUpdatedFields->logoimage))
            <img class="img-thumbnail img-responsive" src="{{ asset('common-logo') }}/{{ $newUpdatedFields->logoimage }}" style="width: 120px; height: 120px; ">
        @endif
    </td>
</tr>
<tr>
    <th> Banner Image </th>
    <td> 
        @if(isset($newUpdatedFields) && isset($newUpdatedFields->bannerimage))
            <img class="img-thumbnail img-responsive" src="{{ asset('common-banner') }}/{{ $newUpdatedFields->bannerimage }}">
        @endif
    </td>
</tr>
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