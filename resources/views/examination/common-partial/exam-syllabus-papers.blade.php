<form class="margin-top20" method="post" action="/update/exam-examination-syllabus/{{$examId}}" data-parsley-validate="">
	@foreach($examDegreeObj as $item)
	{{--*/ $flag2 = '0' /*--}}
    <div class="row">
    	<div class="col-lg-12 margin-top20">
    		<div class="panel panel-warning">
                <div class="panel-heading">
                    <i class="fa fa-edit"></i> {{$item->degreeName}} examination syllabus
                </div>
		        <div class="panel-body">
			        @foreach( $examSyllabusPapersObj as $key)                                    
			            @if( $key->degreeId == $item->degreeId )
		                	<div class="row">
		                		<div class="col-md-6">
									<label>Paper name</label>
									<input id="paperName" name="paperName[]" class="form-control paperName" type="text" @if($key->paperName) value="{{ $key->paperName or ''}}" @else value="" @endif  placeholder="Please paper name"  data-parsley-error-message="Please paper name">
								</div>
								<div class="col-md-6">
									<label>Total Mark</label>
									<input id="totalMark" name="totalMark[]" class="form-control totalMark" type="text" @if($key->totalMark) value="{{ $key->totalMark or ''}}" @else value="" @endif  placeholder="Please total mark"  data-parsley-error-message="Please total mark">
								</div>
		                	</div>
		                	<hr>
		            		<input type="hidden" class="form-control" value="{{$item->degreeName}}" name="degreeName[]">
		            		<input type="hidden" class="form-control" value="{{$item->degreeId}}" name="degreeId[]">
		            		<textarea class="form-control summernote description" id="description"  placeholder="Enter description." name="description[]">@if($key->description) {{ $key->description or ''}} @endif</textarea>
			                {{--*/ $flag2 = '1' /*--}}
			            @endif
			        @endforeach
			        @if( $flag2 == '0' )
		            	<div class="row">
	                		<div class="col-md-6">
								<label>Paper name</label>
								<input id="paperName" name="paperName[]" class="form-control paperName" type="text" value=""  placeholder="Please paper name"  data-parsley-error-message="Please paper name">
							</div>
							<div class="col-md-6">
								<label>Total Mark</label>
								<input id="totalMark" name="totalMark[]" class="form-control totalMark" type="text" value="" placeholder="Please total mark"  data-parsley-error-message="Please total mark">
							</div>
	                	</div>
	                	<hr>
	            		<input type="hidden" class="form-control" value="{{$item->degreeName}}" name="degreeName[]">
		            	<input type="hidden" class="form-control" value="{{$item->degreeId}}" name="degreeId[]">
	            		<textarea class="form-control summernote description" id="description"  placeholder="Enter description." name="description[]"></textarea>
			        @endif

			        <hr>
					<div class="row margin-bottom10">
					    <div class="col-md-9">
					        <h3 class="text-uppercase text-success">List of Exam Syllabus Paper</h3>
					    </div>
					    <div class="col-md-3">
					        <a href="javascript:void(0);" class="btn btn-block btn-sm btn-success" id="addExamSyllabusPaperMarksRow{{$item->degreeId}}"><i class="fa fa-plus"></i> Add Exam Syllabus Paper </a>
					    </div>
					</div>
					<div class="row">
					    <div class="col-md-12">
					        <table class="table table-bordered table-hover">
					            <thead>
					                <tr>
					                    <th>Unit Name</th>
					                    <th>Topic Name</th>
					                    <th>Topic Description</th>
					                    <th>Action</th>
					                </tr>
					            </thead>
					            <tbody class="tableExamSyllabusPaperMarksSection{{$item->degreeId}}">
					            	@foreach($examSyllabusPaperMarksObj as $obj2)
					            		@if( $obj2->degreeId == $item->degreeId )
				                        <tr>
						                    <td>
						                        <input type="text" class="form-control" value="{{$obj2->unitName}}" name="unitName{{$item->degreeId}}[]" placeholder="Unit Name">
						                    </td>
						                    <td>
						                        <input type="text" class="form-control" value="{{$obj2->topicname}}" name="topicname{{$item->degreeId}}[]" placeholder="Topic Name">
						                    </td>
						                    <td>
						                    	<textarea class="form-control topicDesc" id="topicDesc"  placeholder="Enter topic description." name="topicDesc{{$item->degreeId}}[]">@if($obj2->topicDesc) {{ $obj2->topicDesc or ''}} @endif</textarea>
						                    </td>
						                    <td>
						                        <a class="btn btn-outline btn-danger btn-xs removeExamSyllabusPaperMarksRow{{$item->degreeId}}"><i class="fa fa-remove"></i> Remove</a>
						                    </td>
						                </tr>
						                @endif
				                    @endforeach
					            </tbody>
					        </table>
					    </div>
					</div>
					{!! Html::script('assets/administrator/js/jquery-2.1.1.js') !!}
					<script type="text/javascript">
					    var countContact = 0;
					    $('#addExamSyllabusPaperMarksRow{{$item->degreeId}}').on('click', function(){
					        countContact++;
					        var HTML = ''+
					                '<tr>'+
					                    '<td>'+
					                        '<input type="text" class="form-control" name="unitName{{$item->degreeId}}[]" placeholder="Unit Name">'+
					                    '</td>'+
					                    '<td>'+
					                        '<input type="text" class="form-control" name="topicname{{$item->degreeId}}[]" placeholder="Topic Name">'+
					                    '</td>'+
					                    '<td>'+
					                        '<textarea class="form-control topicDesc" id="topicDesc"  placeholder="Enter topic description." name="topicDesc{{$item->degreeId}}[]"></textarea>'+
					                    '</td>'+
					                    '<td>'+
					                        '<a class="btn btn-outline btn-danger btn-xs removeExamSyllabusPaperMarksRow{{$item->degreeId}}"><i class="fa fa-remove"></i> Remove</a>'+
					                    '</td>'+
					                '</tr>'
					        $('.tableExamSyllabusPaperMarksSection{{$item->degreeId}}').append(HTML);
					    });

					    $(document).on('click','.removeExamSyllabusPaperMarksRow{{$item->degreeId}}', function(){
					        countContact--;
					        $(this).parent().parent().remove();
					    });
					</script>

	            </div>
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