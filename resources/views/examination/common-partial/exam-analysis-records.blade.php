<form class="margin-top20" method="post" action="/update/exam-analysis-records/{{$examId}}" data-parsley-validate="" files=" true"  enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-12">
			<label>Description of exam analysis</label>
	        <textarea class="form-control summernote examAnalysisDesc" id="examAnalysisDesc"  placeholder="Enter description of exam analysis." name="examAnalysisDesc">@if(isset($examinationDetailsObj) && $examinationDetailsObj->examAnalysisDesc) {{ $examinationDetailsObj->examAnalysisDesc or ''}} @endif</textarea>
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
                    <i class="fa fa-edit"></i> About {{$item->degreeName}} exam analysis details
                </div>
                <hr>
        		<input type="hidden" class="form-control" value="{{$item->degreeName}}" name="degreeName[]">
        		<input type="hidden" class="form-control" value="{{$item->degreeId}}" name="degreeId[]">
		        @foreach( $examAnalysisRecordsObj as $key)                                    
		            @if( $key->degreeId == $item->degreeId )
		            	<input type="hidden" name="examAnalysisRecordId[]" value="{{ $key->id}}">
		                <div class="panel-body">
		                	<div class="row">
								<div class="col-md-12">
									<label>Paper name</label>
									<textarea class="form-control summernote papername" id="papername"  placeholder="Enter rebember points." name="papername[]">@if($key->papername) {{ $key->papername or ''}} @endif</textarea>
								</div>
		                	</div>
		                	<hr>
		                	<div class="row">
								<div class="col-md-12">
									<label>Description</label>
									<textarea class="form-control summernote description" id="description"  placeholder="Enter description" name="description[]">@if($key->description) {{ $key->description or ''}} @endif</textarea>
								</div>
		                	</div>
		                	<div class="row">
		                		<div class="col-md-8">
			                        <label>Upload File : </label>
			                        <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a> </span>
			                        <input type="file" name="analysisfiles[]" class="analysisfiles form-control" data-parsley-filemaxmegabytes="20" data-parsley-trigger="change" accept=".doc,.docx,.ppt,.pptx,.txt,.pdf" data-parsley-error-message="Please upload files">
			                        <p class="text-danger hide" id="analysisfiles">(please upload .doc, .docx and .pdf file only)</p>
			                    </div>
			                    @if(!empty($key->files))
			                    	{{--*/  $analysisFileName = $key->files;  /*--}}
                                    {{--*/  $analysisFileExt=pathinfo($analysisFileName,PATHINFO_EXTENSION); /*--}}
			                        <div class="col-md-4 margin-top20">
			                            @if($analysisFileExt == 'pdf' )
			                                <a href="{{asset('examinationlogo/')}}/{{ $key->files }}" target="_blank" title="Click to view" download=""><img class="img-thumbnail img-responsive padding-bottom15" src="/assets/img/filetypes/pdf.png" style="width: 80px; height: 80px;"></a>
			                            @elseif($analysisFileExt == 'doc' )
			                                <a href="{{asset('examinationlogo/')}}/{{ $key->files }}" target="_blank" title="Click to view" download=""><img class="img-thumbnail img-responsive padding-bottom15" src="/assets/img/filetypes/doc.png" style="width: 80px; height: 80px;"></a>
			                            @elseif($analysisFileExt == 'docx' )
			                                <a href="{{asset('examinationlogo/')}}/{{ $key->files }}" target="_blank" title="Click to view" download=""><img class="img-thumbnail img-responsive padding-bottom15" src="/assets/img/filetypes/docx.png" style="width: 80px; height: 80px;"></a>
			                            @elseif($analysisFileExt == 'ppt' )
			                                <a href="{{asset('examinationlogo/')}}/{{ $key->files }}" target="_blank" title="Click to view" download=""><img class="img-thumbnail img-responsive padding-bottom15" src="/assets/img/filetypes/ppt.png" style="width: 80px; height: 80px;"></a>
			                            @elseif($analysisFileExt == 'pptx' )
			                                <a href="{{asset('examinationlogo/')}}/{{ $key->files }}" target="_blank" title="Click to view" download=""><img class="img-thumbnail img-responsive padding-bottom15" src="/assets/img/filetypes/pptx.png" style="width: 80px; height: 80px;"></a>
			                            @else
			                            @endif
			                        </div>
			                    @endif
					        </div>
		                	<hr>
		                </div>
		                {{--*/ $flag2 = '1' /*--}}
		            @endif
		        @endforeach
		        @if( $flag2 == '0' )
		            <div class="panel-body">
		            	<input type="hidden" name="examAnalysisRecordId[]" value="">
	                	<div class="row">
							<div class="col-md-12">
								<label>Paper name</label>
								<textarea class="form-control summernote rebemberPoints" id="rebemberPoints"  placeholder="Enter rebember points." name="rebemberPoints[]"></textarea>
							</div>
	                	</div>
	                	<hr>
	                	<div class="row">
							<div class="col-md-12">
								<label>Description</label>
								<textarea class="form-control summernote description" id="description"  placeholder="Enter description" name="description[]"></textarea>
							</div>
	                	</div>
	                	<hr>
	                	<div class="row">
		                	<div class="col-md-12">
		                        <label>Upload File : </label>
		                        <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a> </span>
		                        <input type="file" name="analysisfiles[]" class="analysisfiles form-control" data-parsley-filemaxmegabytes="20" data-parsley-trigger="change" accept=".doc,.docx,.ppt,.pptx,.txt,.pdf" data-parsley-error-message="Please upload files">
		                        <p class="text-danger hide" id="analysisfiles">(please upload .doc, .docx and .pdf file only)</p>
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
<script type="text/javascript">
	 $('.analysisfiles').on('click',function(){
            $('#refresh2').removeClass('hide');
        });
        $('#refresh2').on('click',function(e){
            $('.analysisfiles').val('').trigger('chosen:updated');
            $('#refresh2').addClass('hide');
        });

        $('input[name=analysisfiles]').change(function (e)
        {  
            var ext = $('input[name=analysisfiles]').val().split('.').pop().toLowerCase();
            if( ext == 'pdf' || ext == 'doc' || ext == 'docx' ||  ext == 'ppt' || ext == 'pptx'){
                $('#analysisfiles').addClass('hide');
            }else{
                $('input[name=analysisfiles]').val('');
                $('#analysisfiles').removeClass('hide');
                return false;
            }
            //Disable input file
        }); 
</script>