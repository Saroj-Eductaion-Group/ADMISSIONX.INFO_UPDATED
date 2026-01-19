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
						@if(file_exists(public_path().'/gallery/'.$slugUrl.'/'.$item->galleryFullImage))
						<li>
						<div class="thumbnails thumbnail-style thumbnail-border max-width-on-blocks">
							<div class="thumbnail-img">
								<div class="overflow-hidden">
									<a href="{{asset('gallery/')}}/{{ $slugUrl }}/{{ $item->galleryFullImage }}" class="fancybox" title="{{ $item->caption }}">
										<img class="" src="{{asset('gallery/')}}/{{ $slugUrl }}/{{ $item->galleryName }}" alt="{{ $item->galleryName }}" width="160" height="160">	
									</a>
									
								</div>
								<a class="btn-more hover-effect" href="{{ url('college/delete-college-gallery/') }}/{{ $item->galleryId }}/{{ $slugUrl }}"><i class="fa fa-trash"></i> Delete</a>
							</div>
							<div class="caption text-center">
								<h6>
									@if( $item->caption )
										<span class="minimize"><p class="no-word-wrap">{{ $item->caption }}</p></span>
									@endif
								</h6>
								<h6>
									<a class="hover-effect" id="addACaptionGallery" href="javascript:void(0);">
										@if( $item->caption )
											
											<i class="fa fa-pencil"></i> Update the caption
										@else
											<i class="fa fa-plus"></i> Add a caption
										@endif
									</a>
									<input type="hidden" name="galleryId" id="galleryId" value="{{ $item->galleryId }}">
									<input type="hidden" name="caption" id="caption" value="{{ $item->caption }}">
								</h6>
							</div>
						</div>
						</li>
						@endif
					@endforeach			
				</ul>
			</div>
		</div>
		@endif

		@if( $getOldUploadedVideos )
		<div class="row">
			<hr>
			<div class="col-md-12">
				<div class="headline">
					<h4>Manage your videos</h4>
				</div>
				@foreach( $getOldUploadedVideos as $item )
					<div class="col-md-4">
						<div class="embed-responsive embed-responsive-16by9">
						    <iframe class="embed-responsive-item" src="http://www.youtube.com/embed/{{ $item->galleryName }}" border="1" frameborder="0" allowfullscreen></iframe>
					    </div>
					    <p class="text-center"><a class="btn-more hover-effect" href="{{ url('college/delete-college-gallery/') }}/{{ $item->galleryId }}/{{ $slugUrl }}"><i class="fa fa-trash"></i> Delete</a></p>
					</div>
				@endforeach
			</div>
		</div>
		@endif

		<div class="col-md-12">			
			<div class="row">
				<hr>
				<div class="headline"><h2>Upload New Photo To Your Gallery</h2></div>
				<div class="col-md-4 col-md-offset-4">
					{!! Form::open(['url' => 'college/upload-gallery-image', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                		<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
                		<div class="fileUpload">
						<span class="custom-span">+</span>
							<p class="custom-para">Add Images</p>
							<input id="uploadBtn" type="file" name="uploadGalleryImage[]" multiple="" class="upload" required="" />
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

		            <div class="heading heading-v4 margin-bottom-40">
                        <h2>OR</h2>
                        <br>
                        <small>Update youtube / vimeo videos in your college profile (like : https://www.youtube.com/watch?v=kSERaMjlKIM).</small>
                        {!! Form::open(['url' => 'college/updatecollege-video-url', 'class' => 'form-horizontal form-video-upload', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
                        <div class="row">
                        	<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
                        	{!! Form::text('name', null, ['class' => 'form-control fromDesc', 'placeholder' => 'Enter video url here', 'data-parsley-error-message' => 'Please enter valid url here (https://www.youtube.com/watch?v=fioEL45t49w)', 'required' => '']) !!}
                        	<p class="text-danger hide" id="errorYoutubeUrl">Youtube video url does not exist.</p>
                        </div>
                        <div class="row">
                        	<button class="btn btn-sm btn-u margin-top10"><i class="fa fa-check"></i> Submit</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
				</div>
			</div>
		</div>
	</div>
	
</div>


{!! Html::script('assets/administrator/js/jquery-2.1.1.js') !!}
{!! Html::script('assets/plugins/magnific-popup/jquery.magnific-popup.js') !!}
{!! Html::script('home-layout/assets/css/plugins/fancybox/source/jquery.fancybox.pack.js') !!}
{!! Html::script('home-layout/assets/js/plugins/fancy-box.js') !!}

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
	$('.thumbnails > .caption > h6 > #addACaptionGallery').on('click', function(){
		var galleryId = $(this).next().val();
		var slugUrl = "{!! $slugUrl !!}";
		var caption = $(this).next().next().val();
		$.ajax({
	        type: "GET",
	        url: '/galleryPartialLoad',
	        data: {
	            galleryId: galleryId,
	            slugUrl : slugUrl,
	            caption: caption,
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
			        closeMarkup: '<button class="mfp-close mfp-new-close" type="button" title="Close (Esc)">   </button>'
	            })
	        }
	    });
	});
</script>

{!! Html::script('assets/js/parsley.min.js') !!}
<script type="text/javascript">
  //$('.fromDesc').parsley();

	$( ".form-video-upload" ).submit(function(e) {
  		e.preventDefault();
  		var youtubeUrl = $('.fromDesc').val();
  		if( youtubeUrl != '' ){
  			$.ajax({
		        type: "POST",
		        url: '/college/updatecollege-video-url',
		        data: {
		            youtubeUrl: youtubeUrl,
		        },
		        success: function(data){
		            if( data.code =='200' ){
		            	window.location.reload();
		            }else{
		            	$('#errorYoutubeUrl').removeClass('hide');
		            	setTimeout(function () {
					        $('#errorYoutubeUrl').addClass('hide');
					    }, 2000);
		            }
		        }
		    });	
  		}  		
	});

</script>
<script type="text/javascript">
	$('#uploadBtn').change(function (e)
		{   
			$('#clearAllInputs').removeClass('hide');
			var ext = $('#uploadBtn').val().split('.').pop().toLowerCase();
			if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' ){
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
    /*var minimized_elements = $('span.minimize');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 0) return;
        
        $(this).html(
            t.slice(0,0)+'<span></span><a href="#" class="more">View</a>'+
            '<span style="display:none;word-break: break-all !important;">'+ t.slice(0,t.length)+'<br> <a href="#" class="less">Hide</a></span>'
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