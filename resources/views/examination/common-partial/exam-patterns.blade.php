<form class="margin-top20" method="post" action="/update/examination-patterns/{{$examId}}" data-parsley-validate="">
	@foreach($examDegreeObj as $item)
	{{--*/ $flag2 = '0' /*--}}
    <div class="row">
    	<div class="col-lg-12 margin-top20">
    		<div class="panel panel-warning">
                <div class="panel-heading">
                    <i class="fa fa-edit"></i> {{$item->degreeName}} examination pattern
                </div>
                <hr>
        		<input type="hidden" class="form-control" value="{{$item->degreeName}}" name="degreeName[]">
        		<input type="hidden" class="form-control" value="{{$item->degreeId}}" name="degreeId[]">
		        @foreach( $examPatternsObj as $key)                                    
		            @if( $key->degreeId == $item->degreeId )
		                <div class="panel-body">
		                	<div class="row">
		                		<div class="col-md-6">
									<label>Mode of exam</label>
						            <select class="form-control text-capitalize" name="modeOfExam[]" data-parsley-error-message="Please select exam mode">
						                <option disabled="" selected="">Please select</option>
						                @foreach( $examinationMode as $item )
						                	<option value="{{ $item->id }}"  @if($key->modeOfExam == $item->id) selected="" @endif>{{ $item->name }}</option>
						                @endforeach
						            </select>
								</div>
								<div class="col-md-6">
									<label>Total Mark</label>
									<input id="examDuration" name="examDuration[]" class="form-control examDuration" type="text" @if($key->examDuration) value="{{ $key->examDuration or ''}}" @else value="" @endif  placeholder="Please exam duration"  data-parsley-error-message="Please exam duration">
								</div>
		                	</div>
		                	<hr>
		                	<div class="row">
		                		<div class="col-md-6">
									<label>Total Question</label>
									<input id="totalQuestion" name="totalQuestion[]" class="form-control totalQuestion" type="text" @if($key->totalQuestion) value="{{ $key->totalQuestion or ''}}" @else value="" @endif  placeholder="Please total question"  data-parsley-error-message="Please total question">
								</div>
								<div class="col-md-6">
									<label>Total Mark</label>
									<input id="totalMarks" name="totalMarks[]" class="form-control totalMarks" type="text" @if($key->totalMarks) value="{{ $key->totalMarks or ''}}" @else value="" @endif  placeholder="Please total mark"  data-parsley-error-message="Please total mark">
								</div>
		                	</div>
		                	<hr>
		                	<div class="row">
		                		<div class="col-md-12">
									<label>Section name</label>
									<input id="section" name="section[]" class="form-control section" type="text" @if($key->section) value="{{ $key->section or ''}}" @else value="" @endif  placeholder="Please section name"  data-parsley-error-message="Please section name">
								</div>
							</div>
		                	<hr>
		                	<div class="row">
								<div class="col-md-12">
									<label>Language of paper</label>
									<input id="languageofpaper" name="languageofpaper[]" class="form-control languageofpaper" type="text" @if($key->languageofpaper) value="{{ $key->languageofpaper or ''}}" @else value="" @endif  placeholder="Please language of paper"  data-parsley-error-message="Please language of paper">
								</div>
		                	</div>
		                	<hr>
		                	<div class="row">
								<div class="col-md-12">
									<label>Marking Schem</label>
									<textarea class="form-control summernote markingSchem" id="markingSchem"  placeholder="Enter description." name="markingSchem[]">@if($key->markingSchem) {{ $key->markingSchem or ''}} @endif</textarea>
								</div>
		                	</div>
		                	<hr>
		                	<div class="row">
								<div class="col-md-12">
									<label>Pattern Desc</label>
									<textarea class="form-control summernote patternDesc" id="patternDesc"  placeholder="Enter description." name="patternDesc[]">@if($key->patternDesc) {{ $key->patternDesc or ''}} @endif</textarea>
								</div>
		                	</div>
		                </div>
		                {{--*/ $flag2 = '1' /*--}}
		            @endif
		        @endforeach
		        @if( $flag2 == '0' )
		            <div class="panel-body">
	                	<div class="row">
	                		<div class="col-md-6">
								<label>Mode of exam</label>
					            <select class="form-control text-capitalize" name="modeOfExam[]" data-parsley-error-message="Please select exam mode">
					                <option disabled="" selected="">Please select</option>
					                @foreach( $examinationMode as $item )
					                	<option value="{{ $item->id }}">{{ $item->name }}</option>
					                @endforeach
					            </select>
							</div>
							<div class="col-md-6">
								<label>Total Mark</label>
								<input id="examDuration" name="examDuration[]" class="form-control examDuration" type="text" value="" placeholder="Please exam duration"  data-parsley-error-message="Please exam duration">
							</div>
	                	</div>
	                	<hr>
	                	<div class="row">
	                		<div class="col-md-6">
								<label>Total Question</label>
								<input id="totalQuestion" name="totalQuestion[]" class="form-control totalQuestion" type="text" value=""  placeholder="Please total question"  data-parsley-error-message="Please total question">
							</div>
							<div class="col-md-6">
								<label>Total Mark</label>
								<input id="totalMarks" name="totalMarks[]" class="form-control totalMarks" type="text" value="" placeholder="Please total mark"  data-parsley-error-message="Please total mark">
							</div>
	                	</div>
	                	<hr>
	                	<div class="row">
	                		<div class="col-md-12">
								<label>Section name</label>
								<input id="section" name="section[]" class="form-control section" type="text" value=""  placeholder="Please section name"  data-parsley-error-message="Please section name">
							</div>
						</div>
	                	<hr>
	                	<div class="row">
							<div class="col-md-12">
								<label>Language of paper</label>
								<input id="languageofpaper" name="languageofpaper[]" class="form-control languageofpaper" type="text" value=""  placeholder="Please language of paper"  data-parsley-error-message="Please language of paper">
							</div>
	                	</div>
	                	<hr>
	                	<div class="row">
							<div class="col-md-12">
								<label>Marking Schem</label>
								<textarea class="form-control summernote markingSchem" id="markingSchem"  placeholder="Enter description." name="markingSchem[]"></textarea>
							</div>
	                	</div>
	                	<hr>
	                	<div class="row">
							<div class="col-md-12">
								<label>Pattern Desc</label>
								<textarea class="form-control summernote patternDesc" id="patternDesc"  placeholder="Enter description." name="patternDesc[]"></textarea>
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