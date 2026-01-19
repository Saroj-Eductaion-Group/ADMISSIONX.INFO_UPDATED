{!! Html::style('assets/plugins/magnific-popup/magnific-popup.css') !!}
{!! Html::style('home-layout/assets/css/plugins/fancybox/source/jquery.fancybox.css') !!}

<style type="text/css">
	/* text-based popup styling */
	.white-popup {
	  position: relative;
	  background: #FFF;
	  padding: 25px;
	  width: auto;
	  max-width: 800px;
	  margin: 0 auto;
	}

	/* 

	====== Zoom effect ======

	*/
	.mfp-zoom-in {
	  /* start state */
	  /* animate in */
	  /* animate out */
	}
	.mfp-zoom-in .mfp-with-anim {
	  opacity: 0;
	  transition: all 0.2s ease-in-out;
	  transform: scale(0.8);
	}
	.mfp-zoom-in.mfp-bg {
	  opacity: 0;
	  transition: all 0.3s ease-out;
	}
	.mfp-zoom-in.mfp-ready .mfp-with-anim {
	  opacity: 1;
	  transform: scale(1);
	}
	.mfp-zoom-in.mfp-ready.mfp-bg {
	  opacity: 0.8;
	}
	.mfp-zoom-in.mfp-removing .mfp-with-anim {
	  transform: scale(0.8);
	  opacity: 0;
	}
	.mfp-zoom-in.mfp-removing.mfp-bg {
	  opacity: 0;
	}
</style>

<div class="profile-edit tab-pane fade in active">
	<!-- <h2 class="heading-md text-center">Manage your gallery and videos details</h2> -->
	<br>

	<div class="row detail-page-signup">
		@if( $getOldUploadedImages )
		<div class="row">
			<div class="col-md-12">
				<ul class="list-inline photosWidth">
					@foreach( $getOldUploadedImages as $item )
						<li>
							@if( $item['documentsName'] )
	                            @if( $item['documentsName'] != 'no-image-upload' )
									<div class="thumbnails thumbnail-style thumbnail-border max-width-on-blocks">
										<div class="thumbnail-img">
			                                <div class="overflow-hidden">
			                                    @if( $item['ext'] != 'pdf' )
			                                        <a href="{{asset('document/')}}/{{ $slugUrl }}/{{ $item['documentsName'] }}" alt="{{ $item['documentsName'] }}" class="fancybox" title="{{ $item['description'] }}">
			                                            <img class="" src="{{asset('document/')}}/{{ $slugUrl }}/{{ $item['documentsName'] }}" alt="{{ $item['documentsName'] }}" width="160" height="160">
			                                        </a>
			                                    @else
			                                        <a href="{{asset('document/')}}/{{ $slugUrl }}/{{ $item['documentsName'] }}" target="_blank" title="Click to view">
			                                            <img class="" src="{{asset('assets/images/pdf.png') }}" alt="{{ $item['documentsName'] }}" width="160" height="160">    
			                                        </a>                                        
			                                    @endif
			                                </div>
			                                <a class="btn-more hover-effect" href="{{ url('student/delete-uploaded-document/') }}/{{ $item['documentsId'] }}/{{ $slugUrl }}"><i class="fa fa-trash"></i> Delete</a>
			                            </div>
		                            @endif
		                        @endif
		                        <div class="caption text-center">
		                            <h6>
		                                @if( $item['description'] )
		                                   <span class="no-word-wrap minimize">{{ $item['description'] }}</span>
		                                    @if( $item['documentsName'] == 'no-image-upload' )
		                                       <p class="margin-top5 margin-bottom5"><a class="delete-now" href="{{ url('student/delete-uploaded-document/') }}/{{ $item['documentsId'] }}/{{ $slugUrl }}"><i class="fa fa-trash"></i></a></p>
		                                    @endif
		                                @endif
		                            </h6>
		                            <h6>
		                                <a class="hover-effect" id="addACaptionDocument" href="javascript:void(0);">
		                                    @if( $item['description'] )
		                                        
		                                        <i class="fa fa-pencil"></i> Update a caption
		                                    @else
		                                        <i class="fa fa-plus"></i> Add a caption
		                                    @endif
		                                </a>
		                                <input type="hidden" name="documentId" id="documentId" value="{{ $item['documentsId'] }}">
		                                <input type="hidden" name="description" id="description" value="{{ $item['description'] }}">
		                            </h6>
		                        </div>
	                        </div>
                        </li>
					@endforeach			
				</ul>
			</div>
		</div>
		@endif

		<div class="col-md-8 col-sm-8">			
			<div class="row">
				<hr>
				<div class="headline"><h2>Upload New Document To Your Academic Record</h2></div>
				<div class="col-md-4 col-md-offset-4">
					{!! Form::open(['url' => 'student/upload-acedemic-record-image', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                		<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
                		<div class="fileUpload">
						<span class="custom-span">+</span>
							<p class="custom-para">Add Images</p>
							<input id="uploadBtn" type="file" name="uploadAcademicRecordImage[]" multiple="" class="upload" required="" />
						</div>
						<input id="uploadFile" class="form-control" placeholder="0 files selected" disabled="disabled" />
						<p class="text-center errorUploadFile text-danger hide">(Please select only png, jpg and jpeg files only)</p>
						<p class="text-center">
							<button class="btn btn-sm btn-u margin-top10"><i class="fa fa-upload"></i> Upload Now</button>
						</p>
						<p class="text-center">
							<span class="label label-danger hide" id="clearAllInputs"><i class="fa fa-times"></i> Clear</span>
						</p>
						
		            {!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
	
</div>


{!! Html::script('assets/administrator/js/jquery-2.1.1.js') !!}
{!! Html::script('assets/plugins/magnific-popup/jquery.magnific-popup.js') !!}
{!! Html::script('home-layout/assets/css/plugins/fancybox/source/jquery.fancybox.pack.js') !!}
{!! Html::script('home-layout/assets/js/plugins/fancy-box.js') !!}
{!! Html::script('assets/js/parsley.min.js') !!}

<script type="text/javascript">
	jQuery(document).ready(function() {
		FancyBox.initFancybox();
	});
</script>

<script type="text/javascript">
	$('input[type="file"]').change(function () {
	  $('#uploadFile').val($(this)[0].files.length+' file(s) selected');
	});
</script>

<script type="text/javascript">
    /*var minimized_elements = $('span.minimize');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 0) return;
        
        $(this).html(
            t.slice(0,0)+'<span></span><a href="#" class="more">View</a>'+
            '<span style="display:none;word-break: break-all !important;">'+ t.slice(0,t.length)+'<br><a href="#" class="less">Hide</a></span>'
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
    });*/
</script>


<script type="text/javascript">
	$('#uploadBtn').change(function (e)
		{   
			$('#clearAllInputs').removeClass('hide');
			var ext = $('#uploadBtn').val().split('.').pop().toLowerCase();
			if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf' ){
				$("#uploadBtn").parsley().reset();
				$('.errorUploadFile').addClass('hide');
			}else{
				$('#uploadBtn').val('');
				$('#uploadFile').val('');				
				$("#uploadBtn").parsley().reset();
				$('.errorUploadFile').removeClass('hide');
				$('#clearAllInputs').addClass('hide');
				return false;
			}
			//Disable input file
		});
	$('#clearAllInputs').on('click', function(){
		$('#uploadBtn').val('');
		$('#uploadFile').val('');				
		$("#uploadBtn").parsley().reset();
		$('#clearAllInputs').addClass('hide');
	});
</script>
<script type="text/javascript">
    $('.thumbnails > .caption > h6 > #addACaptionDocument').on('click', function(){
        var documentId = $(this).next().val();
        var slugUrl = "{!! $slugUrl !!}";
        var description = $(this).next().next().val();
        $.ajax({
            type: "GET",
            url: '/documentPartialLoadStudent',
            data: {
                documentId: documentId,
                slugUrl : slugUrl,
                description: description,
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
                    closeMarkup: '<button class="mfp-close mfp-new-close" type="button" title="Close (Esc)"> { costume button with close icon image } </button>'
                })
            }
        });
    });

    $('h5 > span >  #addACaptionDocument').on('click', function(){
        var documentId = $(this).next().val();
        var slugUrl = "{!! $slugUrl !!}";
        var description = $(this).next().next().val();
        $.ajax({
            type: "GET",
            url: '/documentPartialLoadStudent',
            data: {
                documentId: documentId,
                slugUrl : slugUrl,
                description: description,
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
                    closeMarkup: '<button class="mfp-close mfp-new-close" type="button" title="Close (Esc)"> { costume button with close icon image } </button>'
                })
            }
        });
    });
</script>