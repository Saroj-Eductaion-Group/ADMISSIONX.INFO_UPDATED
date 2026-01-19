<form class="margin-top20" method="post" action="/update/exam-eligibilities/{{$examId}}" data-parsley-validate="">
	<div class="row">
		<input type="hidden" name="examDetailId" value="{{ $examinationDetailsObj->id}}">
		<div class="col-md-12">
			<label>Description of examination eligibilities</label>
	        <textarea class="form-control summernote examEligibilityCriteria" id="examEligibilityCriteria"  placeholder="Enter description." name="examEligibilityCriteria">@if(isset($examinationDetailsObj) && $examinationDetailsObj->examEligibilityCriteria) {{ $examinationDetailsObj->examEligibilityCriteria or ''}} @endif</textarea>
	    </div>
	</div>
	@foreach($examDegreeObj as $item)
	{{--*/ $flag1 = '0' /*--}}
    <div class="row">
    	<div class="col-lg-12 margin-top20">
    		<div class="panel panel-info">
                <div class="panel-heading">
                    <i class="fa fa-edit"></i> Description of {{$item->degreeName}} examination eligibilities
                </div>
        		<input type="hidden" class="form-control" value="{{$item->degreeName}}" name="degreeName[]">
        		<input type="hidden" class="form-control" value="{{$item->degreeId}}" name="degreeId[]">
		        @foreach( $examEligibilitiesObj as $key)                                    
		            @if( $key->degreeId == $item->degreeId )
		                <div class="panel-body">
		            		<textarea class="form-control summernote description" id="description"  placeholder="Enter description." name="description[]">@if($key->description) {{ $key->description or ''}} @endif</textarea>
		                </div>
		                {{--*/ $flag1 = '1' /*--}}
		            @endif
		        @endforeach
		        @if( $flag1 == '0' )
		            <div class="panel-body">
	            		<textarea class="form-control summernote description" id="description"  placeholder="Enter description." name="description[]"></textarea>
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