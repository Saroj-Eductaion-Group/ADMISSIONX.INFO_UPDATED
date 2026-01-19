@extends('website/new-design-layouts.master')

@section('styles')
{!! Html::style('assets/plugins/magnific-popup/magnific-popup.css') !!}
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
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

	.course-details { color: #000; }
</style>
@endsection

@section('content')
	<div class="wrapper">
		
		<div class="container content profile">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					@if(Session::has('rightNowCollegeLogIn'))
						<div class="alert alert-info fade in text-center">
	                        <strong>{{ Session::get('rightNowCollegeLogIn') }} <a class="alert-link" href="{{ URL::to('login') }}">dashboard</a>.</strong>                        
	                    </div>
	            	@endif
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="thumbnails thumbnail-style thumbnail-border" style="width: 200px;">
						<div class="thumbnail-img">
							<div class="overflow-hidden">
								@if( $getStudentProfileDataObj )
									@foreach( $getStudentProfileDataObj as $studentProfileData )
										<img class="img-responsive" src="{{asset('gallery/')}}/{{ $slugUrl }}/{{ $studentProfileData->galleryName }}" alt="{{ $studentProfileData->galleryName }}">
									@endforeach
								@else
									<img class="img-responsive" src="/assets/images/no-college-logo.jpg" alt="Student Profile Images">
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-9">
					<h1 class="">
						<a class="hover-effect college-name-style-black fontSize37" href="{{ URL::to('student/dashboard/edit', $slugUrl) }}">
							@if( $getStudentDetailObj )
								@foreach( $getStudentDetailObj as $getStudentName )
									{{ $getStudentName->firstname }} {{ $getStudentName->middlename }} {{ $getStudentName->lastname }} 
								@endforeach
							@endif						
						</a>
					</h1>
					<p>
						<span id="combinedAddress" class="fontSize17 hide"></span>
						@foreach( $getStudentAddressObj as $getAddress )
							@if( $getAddress->addresstypeId  == '3' )
								@if( !empty( $getAddress->name ) )
									<p id="redAdd" class="hide"><span class="label label-success">{{ $getAddress->addresstypeName }}</span> : <span class="minimizeRegiAddress">{{ $getAddress->name }}, {{ $getAddress->address1 }} {{ $getAddress->address2 }}, {{ $getAddress->cityName }}, {{ $getAddress->stateName }}, <strong>{{ $getAddress->countryName }}</strong>, {{ $getAddress->postalcode }}</span></p>
						    	@else
						    		
						    	@endif
	                        @elseif( $getAddress->addresstypeId  == '4' )
	                        	@if( !empty( $getAddress->name ) )
	                        		<p id="camAdd" class="hide"><span class="label label-warning">{{ $getAddress->addresstypeName }}</span> : <span class="minimizeCampusAddress">{{ $getAddress->name }}, {{ $getAddress->address1 }} {{ $getAddress->address2 }}, {{ $getAddress->cityName }}, {{ $getAddress->stateName }}, <strong>{{ $getAddress->countryName }}</strong>, {{ $getAddress->postalcode }}</span></p>
						    	@else
						    		
						    	@endif			                        	
	                        @else
	                        	
	                        @endif
	                    @endforeach
					</p>
					<div>
						<span class="label label-primary">D.O.B. | Phone No &nbsp;</span> : 
						@foreach( $studentDOBDataObj as $getDobPhone )
							<label class="text-primary">{{ $getDobPhone->dateofbirth }} </label>
							<label class="text-primary">( Age as on {!! date('d-m-Y') !!} : </label>
							<label class="text-primary calculatedDateFromNow">{{ $calculateDate }} )</label>
							| {{ $getDobPhone->userPhone }}
						@endforeach
					</div>
				</div>
			</div>
		</div>
		
		<!--=== Profile ===-->
		<div class="container content profile padding0">
			<div class="row">
				<!-- Profile Content -->
				<div class="col-md-12">
					<div class="profile-body margin-bottom-20">
						<div class="tab-v1">
							<ul class="nav nav-justified nav-tabs">
								<li class="active"><a href="#profile" class="profilePartialShowButton" id="profilePartialShowButton" href="javascript:void(0);">Profile</a></li>
								<li><a href="#address" class="addressPartialShowButton" id="addressPartialShowButton" href="javascript:void(0);">Address</a></li>
								<li><a href="#photosvideos" class="photoDocumentPartialShowButton" id="photoDocumentPartialShowButton" href="javascript:void(0);">Academic Document Records</a></li>
								<li><a href="#awardsach" class="projectPartialShowButton" id="projectPartialShowButton" href="javascript:void(0);">Projects</a></li>
							</ul>
							<div class="tab-content">
								<!-- START COLLECTION OF PARTAILS TAB -->
								<p class="text-center loader">
									<img src="{{asset('assets/images/loading.gif')}}" width="64">	
								</p>								
								<div id="loadPartialsTemplates"> </div>
								<!-- END PROFILE TAB -->
								
								
							</div>
						</div>
					</div>
					<!-- COURSE FORM DATA -->
					<div class="detail-page-signup margin-bottom40 tag-box tag-box-v7 table-responsive">
						<div class="headline"><h2>Academic Marks</h2></div>
						<!-- Updated Course List -->
						@if( $getStudentmarksListCount > 0 )
						<table class="table table-hover table-bordered">
							<thead>
								<tr>
									<th>Class / Course</th>
									<th>Marks </th>
									<th>Percentage</th>
								</tr>
							</thead>
							<tbody>
								@foreach( $studentMarksDataObj as $getstudentMarks )
									<tr>
										<td>
											@if($getstudentMarks->marksName)
												{{ $getstudentMarks->marksName }}
											@else
												<span class="label label-warning">Not updated yet</span>
											@endif
										</td>
										<td>
											@if($getstudentMarks->marks)
												{{ $getstudentMarks->marks }}
											@else
												<span class="label label-warning">Not updated yet</span>
											@endif
										</td>
										<td>
											@if($getstudentMarks->percentage)
												{{ $getstudentMarks->percentage }}
											@else
												<span class="label label-warning">Not updated yet</span>
											@endif
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						@else
							<h5>No Academic Marks Listed.</h5>
						@endif
						<!-- End -->
						<!-- FORM -->
					</div>
					<!-- END -->

				</div>
				<!-- End Profile Content -->
			</div><!--/end row-->
		</div>
		<!--=== End Profile ===-->
	</div><!--/wrapper-->

@endsection

@section('scripts')

{!! Html::script('assets/plugins/magnific-popup/jquery.magnific-popup.js') !!}

<script type="text/javascript">
//--ON LOAD PROFILE FORM-----------------------------------------------------------------------------------//
	$(document).ready(function(){
		var slug = "{{ $slugUrl }}";
		$('.profilePartialShowButton').parent().addClass('active');
		$('#loadPartialsTemplates').html('');
		$('.loader').removeClass('hide');
		$.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "POST",
            dataType: "json",
            data: {slug: slug},
            url: "{{ URL::to('/student/profilePartialShow') }}",
            success: function(data) {
            	$('.loader').addClass('hide');
            	$('#loadPartialsTemplates').html(data);
            }
        });


        //LOAD AS PER URL
        var hash = window.location.hash;
		if(hash){
			$('.tab-v1 > .nav-tabs > li').removeClass('active');
	    	$('a[href="' + hash +'"]').parent('li').addClass('active');
	        var currentATagID = $('a[href="' + hash +'"]').attr("id");
	        loadPartialsUrl(currentATagID);	        
	    } else {
	    }

	    //FUNCTION FOR PARTAILS
	    function loadPartialsUrl(currentATagID) {
    		var URL = '';
	    	if( currentATagID == 'profilePartialShowButton' ){
	    		URL = "{{ URL::to('/student/profilePartialShow') }}";
	    	}else if( currentATagID == 'addressPartialShowButton' ){
	    		URL = "{{ URL::to('/student/addressPartialShow') }}";
	    	}else if( currentATagID == 'photoDocumentPartialShowButton' ){
	    		URL = "{{ URL::to('/student/photoDocumentPartialShow') }}";
	    	}else if( currentATagID == 'projectPartialShowButton' ){
	    		URL = "{{ URL::to('/student/projectPartialShow') }}";
	    	}
	    	var slug = "{{ $slugUrl }}";
	    	$('#loadPartialsTemplates').html('');
	    	$('.loader').removeClass('hide');
	    	$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "POST",
	            dataType: "json",
	            data: {slug: slug},
	            url: URL,
	            success: function(data) {
	            	//Clear OLD
	            	$('.loader').addClass('hide');
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
	    }

		//GET PARTAILS FOR PROFILE
		$('li > .profilePartialShowButton').on('click',function(){
			$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$(this).parent().addClass('active');
			var slug = "{{ $slugUrl }}";
			$('#loadPartialsTemplates').html('');
			$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "POST",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/student/profilePartialShow') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

		//GET PARTAILS FOR PHOTOS AND VIDEOS
    	$('li > .addressPartialShowButton').on('click',function(){
    		$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$(this).parent().addClass('active');
			var slug = "{{ $slugUrl }}";
			$('#loadPartialsTemplates').html('');
			$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "POST",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/student/addressPartialShow') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

		//GET PARTAILS FOR PHOTOS AND VIDEOS
    	$('li > .photoDocumentPartialShowButton').on('click',function(){
    		$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$(this).parent().addClass('active');
    		var slug = "{{ $slugUrl }}";
    		$('#loadPartialsTemplates').html('');
    		$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "POST",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/student/photoDocumentPartialShow') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

		//GET PARTAILS FOR Awards + Achievements 
    	$('li > .projectPartialShowButton').on('click',function(){
    		$('.tab-v1 > .nav-tabs > li').removeClass('active');
    		$(this).parent().addClass('active');
			var slug = "{{ $slugUrl }}";
			$('#loadPartialsTemplates').html('');
			$('.loader').removeClass('hide');
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "POST",
	            dataType: "json",
	            data: {slug: slug},
	            url: "{{ URL::to('/student/projectPartialShow') }}",
	            success: function(data) {
	            	$('.loader').addClass('hide');
	            	//Clear OLD
	            	$('#loadPartialsTemplates').html(data);
	            }
	        });
		});

	});
//-------------------------------------------------------------------------------------//
</script>

<script type="text/javascript">
	$(document).ready(function(){
		
		if ($('.minimizeRegiAddress').text() === $('.minimizeCampusAddress').text()){
			$("#combinedAddress").text($('.minimizeRegiAddress').text());
			$("#combinedAddress").removeClass('hide');
			$('#redAdd').addClass('hide');
			$('#camAdd').addClass('hide');
		}else{
			$("#combinedAddress").addClass('hide');
			$('#redAdd').removeClass('hide');
			$('#camAdd').removeClass('hide');
		}

	});
	
</script>

<script type="text/javascript">
	var minimized_elements = $('span.collegeDesc');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 180) return;
        
        $(this).html(
            t.slice(0,180)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(180,t.length)+' <a href="#" class="less">Less</a></span>'
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
	var minimized_elements = $('span.minimize1');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 100) return;
        
        $(this).html(
            t.slice(0,100)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(100,t.length)+' <a href="#" class="less">Less</a></span>'
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
	var minimized_elements = $('span.minimize2');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 50) return;
        
        $(this).html(
            t.slice(0,50)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(50,t.length)+' <a href="#" class="less">Less</a></span>'
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
	var minimized_elements = $('span.minimizeRegiAddress');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 190) return;
        
        $(this).html(
            t.slice(0,190)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(190,t.length)+' <a href="#" class="less">Less</a></span>'
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
	var minimized_elements = $('span.minimizeCampusAddress');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 190) return;
        
        $(this).html(
            t.slice(0,190)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(190,t.length)+' <a href="#" class="less">Less</a></span>'
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

    $('#viewMorePopup').on('click', function(){
		$('#thanksModal').removeClass('hide');
		$.magnificPopup.open({
	        items: {
	            src: '#thanksModal',
	        },
	        type: 'inline'
	    });		
	});

</script>
@endsection






