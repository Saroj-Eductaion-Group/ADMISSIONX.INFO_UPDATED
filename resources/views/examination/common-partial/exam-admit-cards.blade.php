<form class="margin-top20" method="post" action="/update/exam-admit-card/{{$examId}}" data-parsley-validate="">
	<div class="row">
		<div class="col-md-12">
			<label>Description of about admit card</label>
	        <textarea class="form-control summernote admidCardDesc" id="admidCardDesc"  placeholder="Enter description." name="admidCardDesc">@if(isset($examinationDetailsObj) && $examinationDetailsObj->admidCardDesc) {{ $examinationDetailsObj->admidCardDesc or ''}} @endif</textarea>
	    </div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12">
			<label>Admid Card Instructions</label>
	        <textarea class="form-control summernote admidCardInstructions" id="admidCardInstructions"  placeholder="Enter description." name="admidCardInstructions">@if(isset($examinationDetailsObj) && $examinationDetailsObj->admidCardInstructions) {{ $examinationDetailsObj->admidCardInstructions or ''}} @endif</textarea>
	    </div>
	</div>
	<input type="hidden" name="examDetailId" value="{{ $examinationDetailsObj->id}}">
	@foreach($examDegreeObj as $item)
	{{--*/ $flag2 = '0' /*--}}
    <div class="row">
    	<div class="col-lg-12 margin-top20">
    		<div class="panel panel-warning">
                <div class="panel-heading">
                    <i class="fa fa-edit"></i> About {{$item->degreeName}} admit card details
                </div>
                <hr>
        		<input type="hidden" class="form-control" value="{{$item->degreeName}}" name="degreeName[]">
        		<input type="hidden" class="form-control" value="{{$item->degreeId}}" name="degreeId[]">
		        @foreach( $examAdmitCardsObj as $key)                                    
		            @if( $key->degreeId == $item->degreeId )
		                <div class="panel-body">
		                	<div class="row">
								<div class="col-md-12">
									<label>Admit card Details</label>
									<textarea class="form-control summernote description" id="description"  placeholder="Enter admit card details" name="description[]">@if($key->description) {{ $key->description or ''}} @endif</textarea>
								</div>
		                	</div>
		                	<hr>
		                	<div class="row">
								<div class="col-md-12">
									<label>Rebember Points</label>
									<textarea class="form-control summernote rebemberPoints" id="rebemberPoints"  placeholder="Enter rebember points." name="rebemberPoints[]">@if($key->rebemberPoints) {{ $key->rebemberPoints or ''}} @endif</textarea>
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
								<label>Admit card Details</label>
								<textarea class="form-control summernote description" id="description"  placeholder="Enter admit card details." name="description[]"></textarea>
							</div>
	                	</div>
	                	<hr>
	                	<div class="row">
							<div class="col-md-12">
								<label>Rebember Points</label>
								<textarea class="form-control summernote rebemberPoints" id="rebemberPoints"  placeholder="Enter rebember points." name="rebemberPoints[]"></textarea>
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