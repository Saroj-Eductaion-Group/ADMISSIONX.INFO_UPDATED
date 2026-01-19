<form class="margin-top20" method="post" action="/update/exam-cut-offs/{{$examId}}" data-parsley-validate="">
	@foreach($examDegreeObj as $item)
	{{--*/ $flag2 = '0' /*--}}
    <div class="row">
    	<div class="col-lg-12 margin-top20">
    		<div class="panel panel-warning">
                <div class="panel-heading">
                    <i class="fa fa-edit"></i> About {{$item->degreeName}} exam cut offs details
                </div>
                <hr>
        		<input type="hidden" class="form-control" value="{{$item->degreeName}}" name="degreeName[]">
        		<input type="hidden" class="form-control" value="{{$item->degreeId}}" name="degreeId[]">
		        @foreach( $examCutOffsObj as $key)                                    
		            @if( $key->degreeId == $item->degreeId )
		                <div class="panel-body">
		                	<div class="row">
								<div class="col-md-12">
									<label>Cut offs details</label>
									<textarea class="form-control summernote description" id="description"  placeholder="Enter Cut offs details" name="description[]">@if($key->description) {{ $key->description or ''}} @endif</textarea>
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
								<label>Cut offs details</label>
								<textarea class="form-control summernote description" id="description"  placeholder="Enter Cut offs details." name="description[]"></textarea>
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