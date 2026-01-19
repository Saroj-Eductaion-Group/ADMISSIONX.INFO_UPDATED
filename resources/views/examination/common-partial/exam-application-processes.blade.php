<form class="margin-top20" method="post" action="/update/exam-application-process/{{$examId}}" data-parsley-validate="">
	<div class="row">
		<div class="col-md-6">
			<label>Mode of application</label>
            <select class="form-control text-capitalize" required="" name="modeofapplication" data-parsley-error-message="Please select degree name">
                <option disabled="" selected="">Please select</option>
                @foreach( $applicationMode as $item )
                	<option value="{{ $item->id }}"  @if(isset($examApplicationProcessesObj) && $examApplicationProcessesObj->modeofapplication == $item->id) selected="" @endif>{{ $item->name }}</option>
                @endforeach
            </select>
		</div>
		<div class="col-md-6">
			<label>Mode of payment</label>
            <select class="form-control text-capitalize" required="" name="modeofpayment" data-parsley-error-message="Please select degree name">
                <option disabled="" selected="">Please select</option>
                <option value="1"  @if(isset($examApplicationProcessesObj) && $examApplicationProcessesObj->modeofpayment == 1) selected="" @endif>Online</option>
                <option value="2"  @if(isset($examApplicationProcessesObj) && $examApplicationProcessesObj->modeofpayment == 2) selected="" @endif>Offline</option>
                <option value="3"  @if(isset($examApplicationProcessesObj) && $examApplicationProcessesObj->modeofpayment == 3) selected="" @endif>Online & Offline</option>
            </select>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-6">
			<label>Examination Type</label>
            <select class="form-control text-capitalize" required="" name="examinationtype" data-parsley-error-message="Please select degree name">
                <option disabled="" selected="">Please select</option>
                @foreach( $examinationType as $item )
                	<option value="{{ $item->id }}"  @if(isset($examApplicationProcessesObj) && $examApplicationProcessesObj->examinationtype == $item->id) selected="" @endif>{{ $item->name }}</option>
                @endforeach
            </select>
		</div>
		<div class="col-md-6">
			<label>Application & Exam Status</label>
            <select class="form-control text-capitalize" required="" name="applicationandexamstatus" data-parsley-error-message="Please select degree name">
                <option disabled="" selected="">Please select</option>
                @foreach( $applicationAndExamStatus as $item )
                	<option value="{{ $item->id }}"  @if(isset($examApplicationProcessesObj) && $examApplicationProcessesObj->applicationandexamstatus == $item->id) selected="" @endif>{{ $item->name }}</option>
                @endforeach
            </select>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-6">
			<label>Mode of examination</label>
            <select class="form-control text-capitalize" required="" name="examinationmode" data-parsley-error-message="Please select degree name">
                <option disabled="" selected="">Please select</option>
                @foreach( $examinationMode as $item )
                	<option value="{{ $item->id }}"  @if(isset($examApplicationProcessesObj) && $examApplicationProcessesObj->examinationmode == $item->id) selected="" @endif>{{ $item->name }}</option>
                @endforeach
            </select>
		</div>
		<div class="col-md-6">
			<label>Eligibility Criteria</label>
            <select class="form-control text-capitalize" required="" name="eligibilitycriteria" data-parsley-error-message="Please select degree name">
                <option disabled="" selected="">Please select</option>
                @foreach( $eligibilityCriterion as $item )
                	<option value="{{ $item->id }}"  @if(isset($examApplicationProcessesObj) && $examApplicationProcessesObj->eligibilitycriteria == $item->id) selected="" @endif>{{ $item->name }}</option>
                @endforeach
            </select>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12">
			<label>Description</label>
	        <textarea class="form-control summernote description" id="description"  placeholder="Enter description." name="description">@if(isset($examApplicationProcessesObj) && $examApplicationProcessesObj->description) {{ $examApplicationProcessesObj->description or ''}} @endif</textarea>
	    </div>
	</div>
	<hr>
	<div class="row margin-bottom10">
	    <div class="col-md-10">
	        <h3 class="text-uppercase text-success">List of application fees</h3>
	    </div>
	    <div class="col-md-2">
	        <a href="javascript:void(0);" class="btn btn-block btn-sm btn-success" id="addApplicationFeeRow"><i class="fa fa-plus"></i> Add application fees</a>
	    </div>
	</div>
	<div class="row">
	    <div class="col-md-12">
	        <table class="table table-bordered table-hover">
	            <thead>
	                <tr>
	                    <th>Category</th>
	                    <th>Quota</th>
	                    <th>Mode</th>
	                    <th>Gender</th>
	                    <th>Amount</th>
	                    <th>Action</th>
	                </tr>
	            </thead>
	            <tbody class="tableApplicationFeesSection">
	            	@foreach($examApplicationFeesObj as $item)
                        <tr>
		                    <td>
		                        <input type="text" class="form-control" value="{{$item->category}}" name="category[]" placeholder="Category Name">
		                    </td>
		                    <td>
		                        <input type="text" class="form-control" value="{{$item->quota}}" name="quota[]" placeholder="Quota Name">
		                    </td>
		                    <td>
		                        <select name="mode[]" class="form-control mode" data-parsley-error-message="Please select mode">
		                            <option value="" selected="">--Select mode--</option>
		                            <option value="1" @if( $item->mode == 1) selected="" @endif>Online</option>
		                            <option value="2" @if( $item->mode == 2) selected="" @endif>Offline</option>
		                        </select>
		                    </td>
		                    <td>
		                        <select name="gender[]" class="form-control gender" data-parsley-error-message="Please select gender">
		                            <option value="" selected="">--Select gender--</option>
		                            <option value="1" @if( $item->gender == 1) selected="" @endif>Male</option>
		                            <option value="2" @if( $item->gender == 2) selected="" @endif>Female</option>
		                            <option value="3" @if( $item->gender == 3) selected="" @endif>Other</option>
		                        </select>
		                    </td>
		                    <td>
		                        <input type="number" class="form-control" name="amount[]" placeholder="Amount" value="{{$item->amount}}">
		                    </td>
		                    <td>
		                        <a class="btn btn-outline btn-danger btn-xs removeApplicationFeeRow"><i class="fa fa-remove"></i> Remove</a>
		                    </td>
		                </tr>
                    @endforeach
	            </tbody>
	        </table>
	    </div>
	</div>
	<hr>
	<div class="col-sm-12 text-center">
		<div class="form-group mb-0 mt-20">
			<button type="submit" class="btn btn-primary fontMontserrat fontsize-15 pt-2 pb-2 submitBtn" data-loading-text="Please wait...">Submit</button>
		</div>
	</div>
</form>