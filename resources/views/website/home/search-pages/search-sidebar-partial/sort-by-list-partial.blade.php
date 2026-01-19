<select name="filterBy" id="filterBy" class="form-control searchParam">
    <option selected="" disabled="">Sort By</option>
    @if( Request::get('filterBy') == '1' )
        <option value="1" selected="">Fees -- Low to High</option>
    @else
        <option value="1">Fees -- Low to High</option>
    @endif
    @if( Request::get('filterBy') == '2' )
        <option value="2" selected="">Fees -- High to Low</option>
    @else
        <option value="2">Fees -- High to Low</option>
    @endif
    @if( Request::get('filterBy') == '3' )
        <option value="3" selected="">Newest First</option>
    @else
        <option value="3">Newest First</option>
    @endif
</select>