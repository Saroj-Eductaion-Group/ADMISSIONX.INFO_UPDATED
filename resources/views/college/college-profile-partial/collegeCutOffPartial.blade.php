<!-- COURSE FORM DATA -->
<style type="text/css">
.rating_reviews_info{background-color: #fbfbfb; border: 1px solid #e4e4e4;border-radius: 10px;box-shadow: 2px 1px 2px 0px #eaeaea; margin: 20px 0;}
.rating_reviews_info h2{font-size: 22px;color: #f34a4e;font-weight: 600;letter-spacing: 2px;margin: 0px;padding: 0;font-family: 'Open Sans';}
.rating_reviews_info h3{color: #000;font-size: 16px;font-weight: 400;margin: 0;}
.rating_reviews_info p{color: #333;font-weight: 400;text-align: justify;font-family: 'Open Sans';}
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">

<div class="detail-page-signup margin-bottom40 table-responsive">
	<div class="headline"><h2>Manage Your College Cut Offs</h2></div>
	<!-- Updated Course List -->
	@if( sizeof($collegeCutOffsDataObj) > 0 )
		@foreach( $collegeCutOffsDataObj as $item )
			<div class="row margin-bottom20 gray-bg padding-top10 padding-bottom20 rating_reviews_info">
	            <div class="col-md-8">
	                <div class=" padding-top10  padding-left10 padding-right10">
						<div>
		                    <label class="font-noraml"><i class="fa-fw fa  fa-list"></i> Title : 
		                	@if($item->title)
								{{ $item->title }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
		                    </label>
		                </div>
	                    <div>
	                        <label class="font-noraml"><i class="fa-fw fa  fa-graduation-cap"></i> Stream : 
	                    	@if($item->functionalareaName)
								{{ $item->functionalareaName }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
	                        </label>
	                    </div>
	                    <div class="">
	                        <label class="font-noraml"><i class="fa-fw fa  fa-graduation-cap"></i> Degree : 
	                		@if($item->degreeName)
								{{ $item->degreeName }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
							</label>
	                    </div>
	                    <div class="">
	                        <label class="font-noraml"><i class="fa-fw fa fa-list"></i> Degree Level : 
	                        @if($item->educationlevelName)
								{{ $item->educationlevelName }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
	                        </label>
	                    </div>
	                    <div class="">
	                        <label class="font-noraml"><i class="fa-fw fa fa-book"></i> Course Type : 
	                        @if($item->coursetypeName)
								{{ $item->coursetypeName }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
	                        </label>
	                    </div>
	                    <div class="">
	                        <label class="font-noraml"><i class="fa-fw fa fa-book"></i> Course : 
	                        @if($item->courseName)
								{{ $item->courseName }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
	                        </label>
	                    </div>
	                </div>
	            </div>
	            <div class="col-md-4">
	                <div class=" padding-top10  padding-left10 padding-right10">
	                    <div class="row">
	                    	<div class="col-md-6">
								<button class="btn btn-xs btn-block rounded btn-info updateCollegeCutOffId" id="updateCollegeCutOffId" data-effect="mfp-zoom-in">Update</button>
								<input type="hidden" name="collegeCutOffId" class="collegeCutOffId" value="{{ $item->collegeCutOffId }}">
	                    	</div>
	                    	<div class="col-md-6">
								<a class="btn btn-xs btn-block rounded btn-danger" href="{{ url('college/delete-cut-offs/') }}/{{ $item->collegeCutOffId }}/{{ $slugUrl }}">Remove</a>
	                    	</div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-md-12">
	            	<div class="padding-bottom10 padding-left10 padding-right10">
                        <label class="font-noraml"><i class="fa-fw fa fa-sticky-note"></i> Cut Offs Details : </label>
                        <br>
                        @if($item->description)
                            <span class="minimize2">{!! $item->description !!}</span>
                        @else
                            <span class="label label-warning">Not updated yet</span>
                        @endif
                    </div>
	            </div>
	        </div>
		@endforeach
	@else
		<h5>No cutoffs listed.</h5>
	@endif
	<!-- End -->
	<!-- FORM -->
	<div class="col-md-4 col-md-offset-4"><button class="btn btn-u" id="addNewCutOffs"><i class="fa fa-plus"></i>Add New Cut Offs Details</button></div>
	{!! Form::open(['url' => '/college-cut-offs-create', 'class' => 'form-horizontal collegeCutOffsForm', 'data-parsley-validate' => '']) !!} <!-- , 'style' => 'visibility: hidden' -->
		<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12"><label>Title</label></div>
			<div class="col-md-12">
				<input type="text" class="form-control" name="title" placeholder="Enter cut offs title here" data-parsley-trigger="change" data-parsley-error-message="Please enter cut offs title here" required="">
			</div>
		</div>
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12"><label>Stream</label></div>
			<div class="col-md-12">
				<select name="functionalarea_id" class="form-control chosen-select " data-parsley-error-message=" Please select stream" data-parsley-trigger="change" required="">
                    <option value="" selected disabled>Select stream</option>   
                    @foreach ($functionalAreaObj as $functional)
	                    <option value="{{ $functional->id }}">{{ $functional->name }}</option>
	                @endforeach       
                </select>
			</div>
		</div>
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12"><label>Degree</label></div>
			<div class="col-md-12">
				<select name="degree_id" class="form-control chosen-select " data-parsley-error-message=" Please select degree" data-parsley-trigger="change" required="">
                    <option value="" selected disabled>Select stream first for degree selection</option>   
                </select>
			</div>
		</div>
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12"><label>Course</label></div>
			<div class="col-md-12">
				<select name="course_id" class="form-control chosen-select " data-parsley-error-message=" Please select course" data-parsley-trigger="change" required="">
                    <option value="" selected disabled>Select degree first for course selection</option>   
                </select>
			</div>
		</div>
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<label>Degree Level</label>
			</div>
			<div class="col-md-12">
				<select name="educationlevel_id" class="form-control chosen-select " data-parsley-error-message=" Please select degree level" data-parsley-trigger="change" required="">
                    <option value="" selected disabled>Select degree level</option>   
                    @foreach ($educationLevelObj as $education)
	                    <option value="{{ $education->id }}">{{ $education->name }}</option>
	                @endforeach       
                </select>
			</div>
		</div>
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12"><label>Course Type</label></div>
			<div class="col-md-12">
        		<select name="coursetype_id" class="form-control chosen-select " data-parsley-error-message=" Please select course type" data-parsley-trigger="change" required="">
                    <option value="" selected disabled>Select course type</option>   
                    @foreach ($courseTypeObj as $courseType)
	                    <option value="{{ $courseType->id }}">{{ $courseType->name }}</option>
	                @endforeach       
                </select>
			</div>
		</div>
		<div class="row padding-top5 padding-bottom5">
            <div class="col-sm-12">
            	<label>Description : </label>
            	 <textarea class="form-control summernote" rows="4" placeholder="Enter the description" name="description"></textarea>
            </div>
        </div>

		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12 col-lg-12 text-right">
				<button class="btn-u" id="btnSubmit" type="submit">Submit</button>
			</div>
		</div>
	{!! Form::close() !!}
</div>
<!-- END -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>

<script type="text/javascript">
	//---------------- Ajax Call for course modal-------------------------------------------------------//
    $('.updateCollegeCutOffId').click(function(){
   		var collegeCutOffId = $(this).next('.collegeCutOffId').val();
   		var slugUrl = "{!! $slugUrl !!}";
	    $.ajax({
	        type: "GET",
	        url: '/collegeCutOffUpdatePartial',
	        data: {
	            collegeCutOffId: collegeCutOffId,
	            slugUrl: slugUrl,
	        },
	        success: function(data){
	            $.magnificPopup.open({
	                type: 'inline',
	                items: {
	                    src: data
	                },
	                closeOnContentClick : false, 
			        closeOnBgClick :true, 
			        showCloseBtn : false, 
			        enableEscapeKey : false,
			        closeMarkup: '<button class="mfp-close mfp-new-close" type="button" title="Close (Esc)"></button>'
	            })
	        }
	    });
	});
	//---------------- Ajax Call for course modal-------------------------------------------------------//
</script>

<script type="text/javascript">
    var minimized_elements = $('span.minimize2');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 350) return;
        
        $(this).html(
            t.slice(0,350)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(350,t.length)+' <a href="#" class="less">Less</a></span>'
        );
        
    }); 
    
    $('a.more', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).hide().prev().hide();
        $(this).next().show();        
    });
    
    $('a.less', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).parent().hide().prev().show().prev().show();    
    });
</script>

<script type="text/javascript">
	$('select[name=functionalarea_id]').on('change', function(){
		var currentID = $(this).val();
		$.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {currentID: currentID},
            url: "{{ URL::to('getAllDegreeName') }}",
            success: function(data) {
            	var HTML = '';
            	HTML += '<option selected="" disabled="">Select degree</option>';
            	if( data.code == '200' ){
            		$.each(data.degreeObj, function(i, item) {
            			HTML += '<option value="'+data.degreeObj[i].degreeId+'">'+data.degreeObj[i].name+'</option>';
	            	});	
            	}else{
            		HTML += '<option selected="" disabled="">No degree available for this stream</option>';
            	}

            	$('select[name="degree_id"]').empty();
            	$('select[name="degree_id"]').html(HTML);
            	$('select[name="degree_id"]').trigger('chosen:updated');
            }
        });
	});
</script>

<script type="text/javascript">
	$('select[name=degree_id]').on('change', function(){
		var currentID = $(this).val();
		$.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {currentID: currentID},
            url: "{{ URL::to('getAllCourseName') }}",
            success: function(data) {
            	var HTML = '';
            	HTML += '<option selected="" disabled="">Select course</option>';
            	if( data.code == '200' ){
            		$.each(data.courseObj, function(i, item) {
            			HTML += '<option value="'+data.courseObj[i].courseId+'">'+data.courseObj[i].name+'</option>';
	            	});	
            	}else{
            		HTML += '<option selected="" disabled="">No course available for this degree</option>';
            	}

            	$('select[name="course_id"]').empty();
            	$('select[name="course_id"]').html(HTML);
            	$('select[name="course_id"]').trigger('chosen:updated');
            }
        });
	});
</script>

<script type="text/javascript">
    //$('.summernote').summernote();
    $('.summernote').summernote({
        placeholder: 'write here...',
        height: 150,
        toolbar: [
          ['font', ['bold', 'underline', 'italic']],
          ['para', ['ul', 'ol', 'paragraph']],
        ],
        popover: {
        image: [
            ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
            ['float', ['floatLeft', 'floatRight', 'floatNone']],
            ['remove', ['removeMedia']]
        ],
        link: [
            ['link', ['linkDialogShow', 'unlink']]
        ],
        air: [
            ['color', ['color']],
            ['font', ['bold', 'underline', 'clear']],
            ['para', ['ul', 'paragraph']],
            ['table', ['table']],
        ]
        },
        codemirror: {
            mode: 'text/html',
            htmlMode: true,
            lineNumbers: true,
            theme: 'monokai'
        },
        dialogsInBody: true
    });
    $('#summernote').summernote('fontSize', 18);
</script>