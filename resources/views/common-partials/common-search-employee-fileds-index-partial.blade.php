@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')

{{--*/
    if(Auth::user()->userrole_id == 4):
        $userEmployeeObj = $fetchDataServiceController->fetchUserList([4]);
    else:
        $userEmployeeObj = $fetchDataServiceController->fetchUserList([1,4]);
    endif;
/*--}}

<div class="col-md-3">                                    
    <h4 for="usr">Last Updated By (Employee/Admin)<span class="pull-right"><a href="javascript:void(0);" id="searchByEmployeeId" class="hide"><i class="fa fa-remove"></i></a></span></h4>
   <select class="form-control chosen-select searchByEmployeeId" name="searchByEmployeeId" data-parsley-trigger="change" data-parsley-error-message="Please select employee">
        <option value="" disabled="" selected="">Select employee</option>
        @foreach( $userEmployeeObj as $user )
            <option value="{{ $user->userID }}" @if(Request::get('searchByEmployeeId') == $user->userID) selected="" @endif>{{ $user->fullname }} ({{ ($user->userrole_id == 4) ? 'Employee' : 'Admin'}} Id - {{$user->userID}})</option>
        @endforeach
    </select>
</div>