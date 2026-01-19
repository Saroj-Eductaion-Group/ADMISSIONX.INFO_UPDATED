<form class="margin-top20" method="post" action="/update/exam-results/{{$examId}}" data-parsley-validate="">
	<div class="row">
		<div class="col-md-12">
			<label>Description of about exam results</label>
	        <textarea class="form-control summernote examResultDesc" id="examResultDesc"  placeholder="Enter description." name="examResultDesc">@if(isset($examinationDetailsObj) && $examinationDetailsObj->examResultDesc) {{ $examinationDetailsObj->examResultDesc or ''}} @endif</textarea>
	    </div>
	</div>
	<input type="hidden" name="examDetailId" value="{{ $examinationDetailsObj->id}}">
	<hr>
	@foreach($examDegreeObj as $item)
	{{--*/ $flag2 = '0' /*--}}
    <div class="row">
    	<div class="col-lg-12 margin-top20">
    		<div class="panel panel-warning">
                <div class="panel-heading">
                    <i class="fa fa-edit"></i> About {{$item->degreeName}} result details
                </div>
                <hr>
        		<input type="hidden" class="form-control" value="{{$item->degreeName}}" name="degreeName[]">
        		<input type="hidden" class="form-control" value="{{$item->degreeId}}" name="degreeId[]">
		        @foreach( $examResultsObj as $key)                                    
		            @if( $key->degreeId == $item->degreeId )
		                <div class="panel-body">
		                	<div class="row">
								<div class="col-md-12">
									<label>Result Details</label>
									<textarea class="form-control summernote description" id="description"  placeholder="Enter Result details" name="description[]">@if($key->description) {{ $key->description or ''}} @endif</textarea>
								</div>
		                	</div>
		                </div>
		                {{--*/ $flag2 = '1' /*--}}
		            @endif
		        @endforeach
		        @if( $flag2 == '0' )
		            <div class="panel-body">
	                	<div class="row">
							<div class="col-md-12">
								<label>Result Details</label>
								<textarea class="form-control summernote description" id="description"  placeholder="Enter Result details." name="description[]"></textarea>
							</div>
	                	</div>
	                </div>
		        @endif
		    </div>
        </div>
    </div>
    @endforeach
	<hr>
	<div class="col-sm-12 text-center">
		<div class="form-group mb-0 mt-20">
			<button type="submit" class="btn btn-primary fontMontserrat fontsize-15 pt-2 pb-2 submitBtn" data-loading-text="Please wait...">Submit</button>
		</div>
	</div>
</form>