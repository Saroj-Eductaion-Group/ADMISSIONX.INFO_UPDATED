<div class="form-group">
    <div class="col-md-8">
        <label class="" >Select Method Type : </label>
        <select class="form-control chosen-select method_type" name="method_type" data-parsley-error-message=" Please select method type" data-parsley-trigger="change" required="" data-parsley-errors-container="#method-type-validation-error-block">
            <option value="" selected disabled >Select method type</option>
            <option value="Functional Area" @if(isset($adstopcollegelist) && $adstopcollegelist->method_type == "Functional Area") selected="" @endif>Functional Area (Stream)</option>
            <option value="Degree" @if(isset($adstopcollegelist) && $adstopcollegelist->method_type == "Degree") selected="" @endif>Degree</option>
            <option value="Course" @if(isset($adstopcollegelist) && $adstopcollegelist->method_type == "Course") selected="" @endif>Course</option>
            <option value="Country" @if(isset($adstopcollegelist) && $adstopcollegelist->method_type == "Country") selected="" @endif>Country</option>
            <option value="State" @if(isset($adstopcollegelist) && $adstopcollegelist->method_type == "State") selected="" @endif>State</option>
            <option value="City" @if(isset($adstopcollegelist) && $adstopcollegelist->method_type == "City") selected="" @endif>City</option>
            <option value="University" @if(isset($adstopcollegelist) && $adstopcollegelist->method_type == "University") selected="" @endif>University</option>
            <option value="Education Level" @if(isset($adstopcollegelist) && $adstopcollegelist->method_type == "Education Level") selected="" @endif>Education Level</option>
        </select>
        <div class="mb-2" id="method-type-validation-error-block"></div>
    </div>
    <div class="col-md-4">
        <label class="" >Status : </label>
        <select class="form-control chosen-select" name="status" data-parsley-error-message=" Please select status" data-parsley-trigger="change" required="" data-parsley-errors-container="#status-validation-error-block">
            <option value="" selected disabled >Select status</option>
            <option value="1" @if(isset($adstopcollegelist) && $adstopcollegelist->status == 1) selected="" @endif>Active</option>
            <option value="0" @if(isset($adstopcollegelist) && $adstopcollegelist->status == 0) selected="" @endif>Inactive</option>
        </select>
        <div class="mb-2" id="status-validation-error-block"></div>
    </div>
</div>
<div class="row selected_method_block hide margin-bottom30">
    <div class="col-md-12">
        <label class="selected_method_action">Select Page Name</label>
        <select class="form-control chosen-select page_name_id checkExistingAdsCollegeList" style="width: 100%" name="page_name_id" data-parsley-error-message=" Please select page name" data-parsley-trigger="change" required="" data-parsley-errors-container="#page-type-validation-error-block">
            <option value="" selected disabled >Select option</option>
        </select>
        <div class="mb-2" id="page-type-validation-error-block"></div>
    </div>
</div>
<p class="text-danger checkExistingAdsCollegeListMsg hide">This ads college list is already exist, try again with another method or edit previous details. <a href="" id="checkExistingAdsCollegeListBtn" target="_blank"> Click Here</a></p>


<div class="row @if(isset($collegeListObj) && isset($adstopcollegelist)) @else hide @endif college-section">
    <div class="col-md-12">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th width="10%">SR. No.</th>
                    <th>College Name</th>
                </tr>
            </thead>
            <tbody class="tableImportantDateSection">
                {{--*/  
                    $totalCount = 3;
                    $totalRecords = 0;
                    $totalRemaning = $totalCount - $totalRecords;
                /*--}}
                @if(isset($collegeListObj) && sizeof($collegeListObj) > 0)
                    {{--*/  
                        $totalRecords = sizeof($collegeListObj);
                        $totalRemaning = $totalCount - $totalRecords;
                    /*--}}
                    @foreach($collegeListObj as $key => $item)
                        <tr>
                            <td>{{ $key+1 }}.</td>
                            <td>
                                <input type="text" id="collegeName{{ $key+1 }}" class="form-control collegeName{{ $key+1 }} callPopupForContactSeller" name="collegeName[]" value="{{ $item->fullname }}" itemId="{{ $key+1 }}" placeholder="Enter college name" data-parsley-error-message="Please enter college name" data-parsley-trigger="change" @if($key == 0) required="" @endif data-toggle="modal" data-target="#filterCollegeProfileModal" readonly>
                                <input type="hidden" class="collegeId{{ $key+1 }}" id="collegeId{{ $key+1 }}" name="collegeId[]" value="{{ $item->id }}">
                            </td>
                        </tr>
                    @endforeach
                    @for ($i = 0; $i < $totalRemaning; $i++)
                        {{--*/  
                            $counter = $i+1+$totalRecords;
                        /*--}}
                        <tr>
                            <td>{{ $counter }}.</td>
                            <td>
                                <input type="text" id="collegeName{{ $counter }}" class="form-control collegeName{{ $counter }} callPopupForContactSeller" name="collegeName[]" value="" itemId="{{ $counter }}" placeholder="Enter college name" data-parsley-error-message=" Please enter college name" data-parsley-trigger="change" @if($counter == 1) required="" @endif data-toggle="modal" data-target="#filterCollegeProfileModal" readonly>
                                <input type="hidden" class="collegeId{{ $counter }}" id="collegeId{{ $counter }}" name="collegeId[]" value="">
                            </td>
                        </tr>
                    @endfor  
                @else
                    @for ($i = 0; $i < $totalRemaning; $i++)
                        <tr>
                            <td>{{ $i+1 }}.</td>
                            <td>
                                <input type="text" id="collegeName{{ $i+1 }}" class="form-control collegeName{{ $i+1 }} callPopupForContactSeller" name="collegeName[]" value="" itemId="{{ $i+1 }}" placeholder="Enter college name" data-parsley-error-message=" Please enter college name" data-parsley-trigger="change" @if($i == 0) required="" @endif data-toggle="modal" data-target="#filterCollegeProfileModal" readonly>
                                <input type="hidden" class="collegeId{{ $i+1 }}" id="collegeId{{ $i+1 }}" name="collegeId[]" value="">
                            </td>
                        </tr>
                    @endfor    
                @endif
            </tbody>
        </table>
    </div>
</div>
<hr>


<div class="form-group margin-top30">
    <div class="col-md-12 text-center ">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary ads-button']) !!}
    </div>
</div>


<div class="modal fade emailLeadModalForm" id="filterCollegeProfileModal" tabindex="-1" role="dialog" aria-labelledby="contactForSellerModal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-design" style="background: #fbb927;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="contactForSellerModal" style="color: #fff;">Search College Name</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger errorMessageBlock hide">
                    <strong class="errorMessage"></strong>
                </div>
                <p class="text-danger">Please enter college name, atleaset 3 character</p>
                <form method="GET" action="/search" id="searchForm">
                    <div class="header-search-container">
                        <input type="hidden" name="itemId" value="">
                        <input type="hidden" name="methodTypeId" value="">
                        <input type="hidden" name="pageNameId" value="">
                        

                        <input type="text" name="searchAdsCollegeName" class="searchAdsCollegeName form-control" value="" placeholder="Search by Name - College" id="header-search" style="font-size: 13px;">
                        <div class="resultForCollegeAdsList scroll hide">
                            <ul class="list-unstyled padding-top10" style="font-size: 14px;">
                                <li><a href="javascript:void(0);"></a></li>
                            </ul>
                        </div>  
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>