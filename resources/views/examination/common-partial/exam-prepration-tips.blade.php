<form class="margin-top20" method="post" action="/update/examination-prepration/{{$examId}}" data-parsley-validate="">
	@foreach($examDegreeObj as $item)
	{{--*/ $flag2 = '0' /*--}}
    <div class="row">
    	<div class="col-lg-12 margin-top20">
    		<div class="panel panel-warning">
                <div class="panel-heading">
                    <i class="fa fa-edit"></i> {{$item->degreeName}} examination prepration details
                </div>
                <hr>
        		<input type="hidden" class="form-control" value="{{$item->degreeName}}" name="degreeName[]">
        		<input type="hidden" class="form-control" value="{{$item->degreeId}}" name="degreeId[]">
		        @foreach( $examPreprationTipsObj as $key)     
		            @if( $key->degreeId == $item->degreeId )
		                <div class="panel-body">
		                	<div class="row">
								<div class="col-md-12">
									<label>Description</label>
									<textarea class="form-control summernote description" id="description"  placeholder="Enter description." name="description[]">@if($key->description) {{ $key->description or ''}} @endif</textarea>
								</div>
		                	</div>
		                	<hr>
		                	<div class="row">
								<div class="col-md-12">
									<label>Books Name</label>
									<textarea class="form-control summernote booksName" id="booksName"  placeholder="Enter books name." name="booksName[]">@if($key->booksName) {{ $key->booksName or ''}} @endif</textarea>
								</div>
		                	</div>
		                	<hr>
		                	<div class="row">
								<div class="col-md-12">
									<label>Pattern Desc</label>
									<textarea class="form-control summernote importantTopics" id="importantTopics"  placeholder="Enter important topics." name="importantTopics[]">@if($key->importantTopics) {{ $key->patternDesc or ''}} @endif</textarea>
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
								<label>Description</label>
								<textarea class="form-control summernote description" id="description"  placeholder="Enter description." name="description[]"></textarea>
							</div>
	                	</div>
	                	<hr>
	                	<div class="row">
							<div class="col-md-12">
								<label>Books Name</label>
								<textarea class="form-control summernote booksName" id="booksName"  placeholder="Enter books name." name="booksName[]"></textarea>
							</div>
	                	</div>
	                	<hr>
	                	<div class="row">
							<div class="col-md-12">
								<label>Pattern Desc</label>
								<textarea class="form-control summernote importantTopics" id="importantTopics"  placeholder="Enter important topics." name="importantTopics[]"></textarea>
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