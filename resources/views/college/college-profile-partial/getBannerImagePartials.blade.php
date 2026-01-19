<div class="profile-edit tab-pane fade in active">

	<div class="detail-page-signup">
		<div class="headline"><h2>Upload Banner Image</h2><span class="pull-right"><a href="javascript:void(0);" class="btn btn-xs btn-danger closePartialBlade"><i class="fa fa-close"></i> Close</a></span></div>
		{!! Form::open(['url' => 'get-banner-image-partials/college/update', 'method' => 'POST', 'class' => 'form-horizontal', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
			<div class="row">
				<div class="col-md-12">
					<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
            		<label for="file" class="input input-file">
		                <p class="text-danger">(Please upload .png, .jpg and .jpeg file only, we require image weight (1200 to 1400) and image height (300 to 400) minimum.)</p>
		                <span class="pull-right text-danger"><a href="javascript:void(0);" id="bannerimage1" class="hide"><i class="fa fa-remove"></i></a> </span>
		                <input type="file" class="form-control bannerimage" name="bannerimage"  data-parsley-filemaxmegabytes="20" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/jpg, image/png" data-parsley-error-message="Please upload only png , jpg or jpeg." required="">
		            </label>
		    	</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					@if( $collegeDataObj )
						@foreach( $collegeDataObj as $collegeData )
							@if( $collegeData->bannerimage != '' )
								<img class="img-responsive" src="{{asset('gallery/')}}/{{ $slugUrl }}/{{ $collegeData->bannerimage }}" alt="College Banner Image">
							@endif
						@endforeach
					@endif
				</div>
			</div>
			<div class="row margin-top10">
				<div class="col-md-4 col-md-offset-4">
					<button class="btn btn-u btn-block">Update</button>
				</div>
			</div>
		{!! Form::close() !!}
	</div>
</div>


{!! Html::script('assets/js/parsley.min.js') !!}
<script type="text/javascript">
	$('.bannerimage').on('change',function(){
        $('#bannerimage1').removeClass('hide');
    });
    $('#bannerimage1').on('click',function(e){
        $('.bannerimage').val('').trigger('chosen:updated');
        $('#bannerimage1').addClass('hide');
    });

    $('input[name=bannerimage]').change(function (e)
	{   
		var ext = $('input[name=bannerimage]').val().split('.').pop().toLowerCase();
		if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' ){
			$("input[name=bannerimage]").parsley().reset();
		}else{
			$('input[name=bannerimage]').val('');
			$("input[name=bannerimage]").parsley().reset();
			return false;
		}
		//Disable input file
	});

	$("form").submit( function( e ) {
    var form = this;
    e.preventDefault(); //Stop the submit for now
                                //Replace with your selector to find the file input in your form
    var fileInput = $(this).find("input[name=bannerimage]")[0],
        file = fileInput.files && fileInput.files[0];
    if( file ) {
        var img = new Image();

        img.src = window.URL.createObjectURL( file );

        img.onload = function() {
            var width = img.naturalWidth,
                height = img.naturalHeight;

            window.URL.revokeObjectURL( img.src );

            if((width >= 1200 && width <= 1400)  && (height >= 300 && height <= 400) ) {
                form.submit();
            }else {
                alert("Sorry, this image doesn\'t look like the size we wanted. It\'s  width ("+width+") height ("+height+") but we require weight (1200 to 1400) x  height (300 to 400) size image.");
            }
        };
    }
    else { //No file was input or browser doesn't support client side reading
        form.submit();
    }
});
</script>
