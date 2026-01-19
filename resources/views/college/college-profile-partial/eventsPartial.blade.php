<style type="text/css">
.rating_reviews_info{background-color: #fbfbfb; border: 1px solid #e4e4e4;border-radius: 10px;box-shadow: 2px 1px 2px 0px #eaeaea; margin: 20px 0;}
.rating_reviews_info h2{font-size: 22px;color: #f34a4e;font-weight: 600;letter-spacing: 2px;margin: 0px;padding: 0;font-family: 'Open Sans';}
.rating_reviews_info h3{color: #000;font-size: 16px;font-weight: 400;margin: 0;}
.rating_reviews_info p{color: #333;font-weight: 400;text-align: justify;font-family: 'Open Sans';}
</style>
<link href="/new-assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<!-- CALENDER FORM DATA -->
<div class="detail-page-signup margin-bottom40 table-responsive">
	<div class="headline"><h2>Manage Your Calender Information</h2></div>
	<!-- Updated Course List -->
	<?php
	/*@if(sizeof($collegeCalenderDataObj) > 0)
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>Event Name</th>
				<th>Date</th>
				<th>Venue </th>
				<th>Event URL</th>
				<th>Description</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach( $collegeCalenderDataObj as $getUpdatedEvents )
				<tr>
					<td>
						@if( $getUpdatedEvents->name )
							{{ $getUpdatedEvents->name }}
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					</td>
					<td>
						@if( $getUpdatedEvents->datetime )
							{{ date('d/m/Y', strtotime($getUpdatedEvents->datetime)) }}
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					</td>
					<td>
						@if( $getUpdatedEvents->venue )
							{{ $getUpdatedEvents->venue }}
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					</td>
					<td>
						@if( $getUpdatedEvents->link )
							{{ $getUpdatedEvents->link }}
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					</td>
					<td>
						@if( $getUpdatedEvents->description )
						<span class="minimize2">{{ $getUpdatedEvents->description }}</span></p>	<!-- {{ str_limit($getUpdatedEvents->description, $limit = 100, $end = '...') }}  -->
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					</td>
					<td>
						<button class="btn btn-xs rounded btn-info" id="updateCalenderEventID" data-effect="mfp-zoom-in">Update</button> / <input type="hidden" name="eventId" class="eventId" value="{{ $getUpdatedEvents->eventId }}">
						<a class="btn btn-xs rounded btn-danger" href="{{ url('college/delete-event/') }}/{{ $getUpdatedEvents->eventId }}/{{ $slugUrl }}">Remove</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	@else
		<h5>No event listed.</h5>
	@endif*/
	?>

	@if( sizeof($collegeCalenderDataObj) > 0 )
		@foreach( $collegeCalenderDataObj as $getUpdatedEvents )
			<div class="row margin-bottom20 gray-bg padding-top10 padding-bottom20 rating_reviews_info">
	            <div class="col-md-8">
	                <div class=" padding-top10 padding-left10 padding-right10">
	                    <div>
	                        <label class="font-noraml"><i class="fa-fw fa  fa-calendar-o"></i> Event Name : 
	                    	@if($getUpdatedEvents->name)
								{{ $getUpdatedEvents->name }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
	                        </label>
	                    </div>
	                	<div>
	                        <label class="font-noraml"><i class="fa-fw fa  fa-calendar"></i> Event Date : 
	                        @if( $getUpdatedEvents->datetime )
								{{ date('d F Y h:i a', strtotime($getUpdatedEvents->datetime)) }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
	                        </label>
	                    </div>
	                    <div class="">
	                        <label class="font-noraml"><i class="fa-fw fa  fa-map-marker"></i> Event Venue : 
	                		@if($getUpdatedEvents->venue)
								{{ $getUpdatedEvents->venue }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
							</label>
	                    </div>
	                </div>
	            </div>
	            <div class="col-md-4">
	                <div class=" padding-top10 padding-left10 padding-right10">
	                    <div class="row">
	                    	<div class="col-md-6">
								<!-- <button class="btn btn-xs btn-block rounded btn-info updateCalenderEventID" id="updateCalenderEventID" data-effect="mfp-zoom-in">Update</button> 
								<input type="hidden" name="eventId" class="eventId" value="{{ $getUpdatedEvents->eventId }}">-->
								<a href="javascript:void(0);"
									 title="Email Details" 
			                    	class="btn btn-xs btn-block rounded btn-info eventUpdateModal click-contact"
			                    	eventId="{{ $getUpdatedEvents->eventId }}"
			                    	eventName="{{ $getUpdatedEvents->name }}"
			                    	eventVenue="{{ $getUpdatedEvents->venue }}" 
			                    	eventLink="{{$getUpdatedEvents->link }}"
			                    	eventDatetime="{{$getUpdatedEvents->datetime }}"
			                    	eventDescription="{{$getUpdatedEvents->description }}"
			                    	slugUrl="{{ $slugUrl }}"
			                    	data-toggle="modal" data-target="#eventModel" data-whatever=""
		                    	>Update</a>
	                    	</div>
	                    	<div class="col-md-6">
								<a class="btn btn-xs btn-block rounded btn-danger" href="{{ url('college/delete-event/') }}/{{ $getUpdatedEvents->eventId }}/{{ $slugUrl }}">Remove</a>
	                    	</div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-md-12">
	            	<div class="padding-bottom10 padding-left10 padding-right10">
		            	<div class="">
	                        <label class="font-noraml"><i class="fa-fw fa fa-link"></i> Event URL : 
	                        @if($getUpdatedEvents->link)
								{{ $getUpdatedEvents->link }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
	                        </label>
	                    </div>
	                    <div>
	                        <label class="font-noraml"><i class="fa-fw fa fa-sticky-note"></i> Description : 
	                       	@if( $getUpdatedEvents->description )
							<span class="minimize2">{{ $getUpdatedEvents->description }}</span></p>	<!-- {{ str_limit($getUpdatedEvents->description, $limit = 100, $end = '...') }}  -->
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
	                        </label>
	                    </div>
	                    
	                </div>
	            </div>
	        </div>
		@endforeach
	@else
		<h5>No courses listed.</h5>
	@endif
	
	<!-- End -->
	<!-- FORM -->
	<div class="col-md-4 col-md-offset-4"><button class="btn btn-u" id="addNewEvent"><i class="fa fa-plus"></i>Add New Event Details</button></div>
	{!! Form::open(['url' => '/college-event-partial', 'class' => 'form-horizontal eventForm', 'data-parsley-validate' => '']) !!} <!-- , 'style' => 'visibility: hidden' -->
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">								
				<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
			</div>
		</div>
	 	<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<label>Event Name</label>
				{!! Form::text('name', null, ['class' => 'form-control eventName', 'placeholder' => 'Enter event name', 'data-parsley-error-message' => 'Please enter valid event name here', 'required' => '','data-parsley-trigger'=>'change']) !!}
				<!-- 'data-parsley-pattern'=> '^[a-zA-Z\\/s ().,-]*$' -->
				<p class="text-danger errorMgs hide">Please enter event name</p>
			</div>
		</div>
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-6">
				<label>Event Date</label>
                <div class="input-group date form_datetime col-md-12" data-date="{{date('Y-m-d')}}" data-date-format="dd MM yyyy - HH:ii p" data-link-field="datetime" placeholder="Please select event date" data-parsley-error-message = "Please select event date" data-parsley-trigger="change" required>
                    <input class="form-control" size="16" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
				<p class="text-danger errorMgs1 hide">Please select event date</p>
				<input type="hidden" name="datetime" id="datetime" value="" />
			</div>
			<div class="col-md-6">
				<label>Venue</label>
				{!! Form::text('venue', null, ['class' => 'form-control eventVenue', 'placeholder' => 'Enter event venue', 'data-parsley-error-message' => 'Please enter valid event venue here', 'required' => '','data-parsley-pattern'=> '^[a-zA-Z\\/s ().,-]*$','data-parsley-trigger'=>'change']) !!}
				<p class="text-danger errorMgs2 hide">Please enter valid event venue here</p>
			</div>
		</div>
		<div class="row padding-bottom5">
			<div class="col-md-12">
				<label>Event URL</label>
				{!! Form::text('link', null, ['class' => 'form-control', 'placeholder' => 'Enter event url', 'data-parsley-type' => 'url', 'data-parsley-error-message' => 'Please enter valid url here (i.e https://xyz.com, https://www.xyz.com, http://xyz.com, http://www.xyz.com)','data-parsley-trigger' =>'change', 'pattern' => "^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$"]) !!}
			</div>
		</div>
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<label>Description</label>
				{!! Form::textarea('description', null, ['class' => 'form-control', 'rows'=>'8', 'placeholder' => 'Enter event description']) !!}
			</div>
		</div>
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12 col-lg-12 text-right">
				<button class="btn-u" id="btnValidate" type="submit">Submit</button>
			</div>
		</div>
	{!! Form::close() !!}
</div>
<div class="modal fade" id="eventModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content" style="border:unset !important; border-radius:0px !important; ">
			<form  action="/college-calender-event-update" method="POST" data-parsley-validate="">
				<div class="modal-header modal-header-design" style="background: #d3070c;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="exampleModalLabel" style="color: #fff;">Manage your event/calender details</h4>
				</div>
				<div class="modal-body">
					<div class="detail-page-signup">
						<form method="POST" action="/college-calender-event-update" data-parsley-validate>
							<input type="hidden" name="eventId" value="">
							<input type="hidden" name="slugUrl" value="">
						    <div class="row padding-top5 padding-bottom5">
						    	<div class="col-md-12">
						            <label>Event Name</label>
					            	<input type="text" class="form-control eventNameUpdate" name="name" placeholder="Please enter event name" data-parsley-error-message = "Please enter event name" data-parsley-trigger="change" required data-parsley-trigger="change">
					            		<!-- data-parsley-pattern="^[a-zA-Z0-9\\/s ().,-]*$"  -->
						        </div>
						    </div>
						    <div class="row padding-top5 padding-bottom5">
						    	<div class="col-md-12">
						            <label>Event Date : </label> <span class="eventDatetimeUpdate"></span>
					            	<div class="input-group date form_datetime col-md-12" data-date="" data-date-format="dd MM yyyy - HH:ii p" data-link-field="datetime1" placeholder="Please select event date" data-parsley-error-message = "Please select event date" data-parsley-trigger="change" required>
					                    <input class="form-control" size="16" type="text" value="" readonly>
					                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
										<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
					                </div>
					                <input type="hidden" class="eventDatetimeUpdateVal" name="datetime" id="datetime1" value="" />
						        </div>
						    </div>
						    <div class="row padding-top5 padding-bottom5">
						    	<div class="col-md-12">
						            <label>Event Venue</label>
					            	<input type="text" class="form-control eventVenueUpdate" name="venue" placeholder="Please enter event venue" data-parsley-error-message = "Please enter event venue" data-parsley-trigger="change" required data-parsley-pattern="^[a-zA-Z0-9\\/s ().,-]*$" data-parsley-trigger="change">
						        </div>
						    </div>
						    <div class="row padding-top5 padding-bottom5">
						    	<div class="col-md-12">
						            <label>Event URL</label>
					            	<input type="text" class="form-control eventLinkUpdate" name="link" placeholder="Enter event url here" data-parsley-type ="url" data-parsley-error-message = "Please enter valid url here (i.e https://xyz.com, https://www.xyz.com, http://xyz.com, http://www.xyz.com)" data-parsley-trigger="change" pattern="^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$">
						        </div>
						    </div>
						    <div class="row padding-top5 padding-bottom5">
						    	<div class="col-md-12">
						            <label>Event Description</label>
					            	<textarea class="form-control eventDescriptionUpdate" name="description" rows="6" data-parsley-error-message = "Please enter the event description" data-parsley-trigger="change"></textarea>
						        </div>
						    </div>
							<div class="row padding-top5 padding-bottom5">
								<div class="col-md-12 col-lg-12 text-right">
									<button class="btn-u" type="submit">Submit</button>
								</div>
							</div>
						</form>			
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END -->
{!! Html::script('home-layout/assets/js/plugins/jquery-ui.min.js') !!}
<script type="text/javascript" src="/new-assets/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="/new-assets/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1,
        minDate: 0, 
        dateFormat: 'dd/mm/yy'
    });
</script>
<script type="text/javascript">
	$('#btnValidate').click(function(e){
		e.preventDefault();
	  	if( $('.eventName').val() == ''){
	  		$('.errorMgs').removeClass('hide');
			return false;
  		}else if( $('#datetime').val() == ''){
  			$('.errorMgs1').removeClass('hide');
  			return false;
  		}else if($('.eventVenue').val() == ''){
  			$('.errorMgs2').removeClass('hide');
  			return false;
  		}else if( $('.eventName').val() != '' &&$('.eventVenue').val() != '' && $('#datetime').val() != ''){
  			this.form.submit();
  			$('.errorMgs').addClass('hide');
  			$('.errorMgs1').addClass('hide');
  			$('.errorMgs2').addClass('hide');
  		}else{
  			$('.errorMgs').removeClass('hide');
  			$('.errorMgs1').removeClass('hide');
  			$('.errorMgs2').removeClass('hide');
  			return false;
  		}  	

	 //  	var checkDateTimeVal = $('#datetime').val();
		// if (checkDateTimeVal == "" || checkDateTimeVal == null ) {
		// 	$('.errorMgs').removeClass('hide');
		//     return false;
		// }else{
		// 	$('.errorMgs').addClass('hide');
		//     this.form.submit();
		// }
	});
</script>


<!-- <script type="text/javascript">
	//-------------------Ajax Call for Event modal-----------------------------------------------------//
 	$('table > tbody tr > td > #updateCalenderEventID').click(function(){
   		var eventId = $(this).next('.eventId').val();
   		var slugUrl = "{!! $slugUrl !!}";
	    $.ajax({
	        type: "GET",
	        url: '/calenderEventPartial',
	        data: {
	            eventId: eventId,
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
			        closeMarkup: '<button class="mfp-close mfp-new-close" type="button" title="Close (Esc)">   </button>'
	            })
	        }
	    });
	});
	//-------------------Ajax Call for Event modal-----------------------------------------------------//
</script> -->
<script type="text/javascript">
	//-------------------Ajax Call for Event modal-----------------------------------------------------//
 	$('.updateCalenderEventID').click(function(){
   		var eventId = $(this).next('.eventId').val();
   		var slugUrl = "{!! $slugUrl !!}";
	    $.ajax({
	        type: "GET",
	        url: '/calenderEventPartial',
	        data: {
	            eventId: eventId,
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
			        closeMarkup: '<button class="mfp-close mfp-new-close" type="button" title="Close (Esc)">   </button>'
	            })
	        }
	    });
	});
	//-------------------Ajax Call for Event modal-----------------------------------------------------//
</script>
<script type="text/javascript">
	//-------------------Ajax Call for Event modal-----------------------------------------------------//
	$('.eventUpdateModal').on('click', function(){
		$('input[name=eventId]').val($(this).attr('eventId'));
		$('input[name=slugUrl]').val($(this).attr('slugUrl'));
		$('.eventNameUpdate').val($(this).attr('eventName'));
		$('.eventDatetimeUpdateVal').val($(this).attr('eventDatetime'));
		$('.eventVenueUpdate').val($(this).attr('eventVenue'));
		$('.eventLinkUpdate').val($(this).attr('eventLink'));
	    $('.eventDescriptionUpdate').val($(this).attr('eventDescription'));	
		$('.eventDatetimeUpdate').text($(this).attr('eventDatetime'));
	    $(this).attr('data-date').text($(this).attr('eventDatetime'));	
	});
	//-------------------Ajax Call for Event modal-----------------------------------------------------//
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
{!! Html::script('home-layout/assets/js/plugins/jquery-ui.min.js') !!}
<script type="text/javascript">
  $(function() {
    $("#datepicker").datepicker({ minDate: 0, dateFormat: 'dd/mm/yy' }).datepicker("setDate", new Date());
  });
</script>

