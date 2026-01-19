<form class="margin-top20" method="post" action="/update/exam-answer-keys/{{$examId}}" data-parsley-validate="" files=" true"  enctype="multipart/form-data">
	@foreach($examDegreeObj as $item)
	{{--*/ $flag2 = '0' /*--}}
    <div class="row">
    	<div class="col-lg-12 margin-top20">
    		<div class="panel panel-warning">
                <div class="panel-heading">
                    <i class="fa fa-edit"></i> {{$item->degreeName}} Answer Keys
                </div>
		        <div class="panel-body">
			        @foreach( $examAnswerKeysObj as $key)                                    
			            @if( $key->degreeId == $item->degreeId )
		            		<input type="hidden" class="form-control" value="{{$item->degreeName}}" name="degreeName[]">
		            		<input type="hidden" class="form-control" value="{{$item->degreeId}}" name="degreeId[]">
		            		<div class="row">
		            			<div class="col-md-12">
		            				<label>Paper names</label>
		            				<textarea class="form-control summernote papername" id="papername"  placeholder="Enter papername." name="papername[]">@if($key->papername) {{ $key->papername or ''}} @endif</textarea>
		            			</div>
		            		</div>
		            		<hr>
		            		<div class="row">
		            			<div class="col-md-12">
		            				<label>Description</label>
		            				<textarea class="form-control summernote description" id="description"  placeholder="Enter description." name="description[]">@if($key->description) {{ $key->description or ''}} @endif</textarea>
		            			</div>
		            		</div>
		            		<hr>
		            		<div class="row">
		            			<div class="col-md-12">
		            				<label>Important Description</label>
		            				<textarea class="form-control summernote importantDesc" id="importantDesc"  placeholder="Enter importantDesc." name="importantDesc[]">@if($key->importantDesc) {{ $key->importantDesc or ''}} @endif</textarea>
		            			</div>
		            		</div>
			                {{--*/ $flag2 = '1' /*--}}
			            @endif
			        @endforeach
			        @if( $flag2 == '0' )
		            	<div class="row">
	            			<div class="col-md-12">
	            				<label>Paper names</label>
	            				<textarea class="form-control summernote papername" id="papername"  placeholder="Enter papername." name="papername[]"></textarea>
	            			</div>
	            		</div>
	            		<hr>
	            		<div class="row">
	            			<div class="col-md-12">
	            				<label>Description</label>
	            				<textarea class="form-control summernote description" id="description"  placeholder="Enter description." name="description[]"></textarea>
	            			</div>
	            		</div>
	            		<hr>
	            		<div class="row">
	            			<div class="col-md-12">
	            				<label>Important Description</label>
	            				<textarea class="form-control summernote importantDesc" id="importantDesc"  placeholder="Enter importantDesc." name="importantDesc[]"></textarea>
	            			</div>
	            		</div>
	            		<input type="hidden" class="form-control" value="{{$item->degreeName}}" name="degreeName[]">
		            	<input type="hidden" class="form-control" value="{{$item->degreeId}}" name="degreeId[]">
			        @endif

			        <hr>
					<div class="row margin-bottom10">
					    <div class="col-md-9">
					        <h3 class="text-uppercase text-success">List of Exam Answer Key</h3>
					    </div>
					    <div class="col-md-3">
					        <a href="javascript:void(0);" class="btn btn-block btn-sm btn-success" id="addExamAnswerKeyRow{{$item->degreeId}}"><i class="fa fa-plus"></i> Add Exam Answer Key </a>
					    </div>
					</div>
					<div class="row">
					    <div class="col-md-12">
					        <table class="table table-bordered table-hover">
					            <thead>
					                <tr>
					                    <th>Paper Name</th>
					                    <th>Dates</th>
					                    <th>Files</th>
					                    <th>Links</th>
					                    <th>Action</th>
					                </tr>
					            </thead>
					            <tbody class="tableExamAnswerKeySection{{$item->degreeId}}">
					            	@foreach($examAnswerKeyEventsObj as $obj2)
					            		@if( $obj2->degreeId == $item->degreeId )
					            		<input type="hidden" name="examAnswerKeyEventId[]" value="{{$obj2->id}}">
				                        <tr>
						                    <td>
						                        <input type="text" class="form-control" value="{{$obj2->paperName}}" name="paperName{{$item->degreeId}}[]" placeholder="Paper name">
						                    </td>
						                    <td>
						                        <input type="text" class="form-control" value="{{$obj2->dates}}" name="dates{{$item->degreeId}}[]" placeholder="Dates">
						                    </td>
						                    <td>
						                    	<span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh3" class="hide"><i class="fa fa-remove"></i></a> </span>
						                    	<input type="file" name="files{{$item->degreeId}}[]" class="examAnswerKeyEventsFiles form-control" data-parsley-filemaxmegabytes="20" data-parsley-trigger="change" accept=".doc,.docx,.ppt,.pptx,.txt,.pdf" data-parsley-error-message="Please upload files">
		                        				<p class="text-danger hide" id="examAnswerKeyEventsFiles">(please upload .doc, .docx and .pdf file only)</p>
						                        @if(!empty($obj2->files))
							                    	{{--*/  $answerFile = $obj2->files;  /*--}}
				                                    {{--*/  $answerext1=pathinfo($answerFile,PATHINFO_EXTENSION); /*--}}
							                        <div class="col-md-4 margin-top20">
							                            @if($answerext1 == 'pdf' )
							                                <a href="{{asset('examinationlogo/')}}/{{ $obj2->files }}" target="_blank" title="Click to view" download=""><img class="img-thumbnail img-responsive padding-bottom15" src="/assets/img/filetypes/pdf.png" style="width: 80px; height: 80px;"></a>
							                            @elseif($answerext1 == 'doc' )
							                                <a href="{{asset('examinationlogo/')}}/{{ $obj2->files }}" target="_blank" title="Click to view" download=""><img class="img-thumbnail img-responsive padding-bottom15" src="/assets/img/filetypes/doc.png" style="width: 80px; height: 80px;"></a>
							                            @elseif($answerext1 == 'docx' )
							                                <a href="{{asset('examinationlogo/')}}/{{ $obj2->files }}" target="_blank" title="Click to view" download=""><img class="img-thumbnail img-responsive padding-bottom15" src="/assets/img/filetypes/docx.png" style="width: 80px; height: 80px;"></a>
							                            @elseif($answerext1 == 'ppt' )
							                                <a href="{{asset('examinationlogo/')}}/{{ $obj2->files }}" target="_blank" title="Click to view" download=""><img class="img-thumbnail img-responsive padding-bottom15" src="/assets/img/filetypes/ppt.png" style="width: 80px; height: 80px;"></a>
							                            @elseif($answerext1 == 'pptx' )
							                                <a href="{{asset('examinationlogo/')}}/{{ $obj2->files }}" target="_blank" title="Click to view" download=""><img class="img-thumbnail img-responsive padding-bottom15" src="/assets/img/filetypes/pptx.png" style="width: 80px; height: 80px;"></a>
							                            @else
							                            @endif
							                        </div>
							                    @endif
						                    </td>
						                    <td>
						                        <input type="url" class="form-control" value="{{$obj2->links}}" name="links{{$item->degreeId}}[]" placeholder="Links">
						                    </td>
						                    <td>
						                        <a class="btn btn-outline btn-danger btn-xs removeExamAnswerKeyRow{{$item->degreeId}}"><i class="fa fa-remove"></i> Remove</a>
						                        <a href="/delete/exam-answer-key-events/{{$examId}}/{{$obj2->id}}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>
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
					    var countAnswerKeys = 0;
					    $('#addExamAnswerKeyRow{{$item->degreeId}}').on('click', function(){
					        countAnswerKeys++;
					        var HTML = ''+
					                '<tr><input type="hidden" name="examAnswerKeyEventId{{$item->degreeId}}[]" value="">'+
					                    '<td>'+
					                        '<input type="text" class="form-control" name="paperName{{$item->degreeId}}[]" placeholder="Paper Name">'+
					                    '</td>'+
					                    '<td>'+
					                        '<input type="text" class="form-control" name="dates{{$item->degreeId}}[]" placeholder="Dates">'+
					                    '</td>'+
					                    '<td>'+
					                        '<input type="file" name="files{{$item->degreeId}}[]" class="examAnswerKeyEventsFiles form-control" data-parsley-filemaxmegabytes="20" data-parsley-trigger="change" accept=".doc,.docx,.ppt,.pptx,.txt,.pdf" data-parsley-error-message="Please upload files"><p class="text-danger hide" id="examAnswerKeyEventsFiles">(please upload .doc, .docx and .pdf file only)</p>'+
					                    '</td>'+
					                    '<td>'+
					                        '<input type="url" class="form-control" name="links{{$item->degreeId}}[]" placeholder="Links">'+
					                    '</td>'+
					                    '<td>'+
					                        '<a class="btn btn-outline btn-danger btn-xs removeExamAnswerKeyRow{{$item->degreeId}}"><i class="fa fa-remove"></i> Remove</a>'+
					                    '</td>'+
					                '</tr>'
					        $('.tableExamAnswerKeySection{{$item->degreeId}}').append(HTML);
					    });

					    $(document).on('click','.removeExamAnswerKeyRow{{$item->degreeId}}', function(){
					        countAnswerKeys--;
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

<script type="text/javascript">
	 $('.examAnswerKeyEventsFiles').on('click',function(){
            $('#refresh3').removeClass('hide');
        });
        $('#refresh3').on('click',function(e){
            $('.examAnswerKeyEventsFiles').val('').trigger('chosen:updated');
            $('#refresh3').addClass('hide');
        });

        $('.examAnswerKeyEventsFiles').change(function (e)
        {  
            var ext = $('.examAnswerKeyEventsFiles').val().split('.').pop().toLowerCase();
            if( ext == 'pdf' || ext == 'doc' || ext == 'docx' ||  ext == 'ppt' || ext == 'pptx'){
                $('#examAnswerKeyEventsFiles').addClass('hide');
            }else{
                $('.examAnswerKeyEventsFiles').val('');
                $('#examAnswerKeyEventsFiles').removeClass('hide');
                return false;
            }
            //Disable input file
        }); 
</script>