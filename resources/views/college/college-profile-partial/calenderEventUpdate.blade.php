<link href="/new-assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<style type="text/css"></style>
<div class="profile-edit tab-pane fade in active margin-top30 white-popup">
	<div class="detail-page-signup">
		<h2 class="heading-md text-center text-green"><a class="hover-effect" href="">Manage your event/calender details</a></h2>
		<hr>
		<!-- START ADDRESS FORM FOR REGISTER -->
		<div>
			<form method="POST" action="/college-calender-event-update" data-parsley-validate>
				<input type="hidden" name="eventId" value="{{ $getCalenderEventData->eventId }}">
				<input type="hidden" name="slugUrl" value="{{ $getCalenderEventData->slug }}">
			    <div class="row padding-top5 padding-bottom5">
			    	<div class="col-md-12">
			            <label>Event Name</label>
			            @if( $getCalenderEventData->name )
			            	<input type="text" class="form-control" name="name" placeholder="Please enter event name" data-parsley-error-message = "Please enter event name" data-parsley-trigger="change" value="{{ $getCalenderEventData->name }}" required data-parsley-trigger="change">
			            	<!--  data-parsley-pattern="^[a-zA-Z0-9\\/s ().,-]*$" -->
		            	@else
		            		<input type="text" class="form-control" name="name" placeholder="Please enter event name" data-parsley-error-message = "Please enter event name" data-parsley-trigger="change" required data-parsley-trigger="change">
		            		<!-- data-parsley-pattern="^[a-zA-Z0-9\\/s ().,-]*$"  -->
            			@endif
			        </div>
			    </div>
			    <div class="row padding-top5 padding-bottom5">
			    	<div class="col-md-6">
			            <label>Event Date</label>
			            @if( $getCalenderEventData->datetime )
			            	<input type="date" class="form-control form_datetime" name="datetime" id="datepicker" placeholder="Please enter event date" data-parsley-error-message = "Please enter event date" data-parsley-trigger="change" value="{{ date('d/m/Y', strtotime($getCalenderEventData->datetime)) }}" required>
			            	<div class="input-group date form_datetime col-md-12" data-date="{{date('Y-m-d')}}" data-date-format="dd MM yyyy - HH:ii p" data-link-field="datetime" placeholder="Please select event date" data-parsley-error-message = "Please select event date" data-parsley-trigger="change" required>
			                    <input class="form-control" size="16" type="text" value="" readonly>
			                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
								<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
			                </div>
			                <input type="hidden" name="datetime" id="datetime" value="" />
		            	@else
		            		<div class="input-group date form_datetime col-md-12" data-date="{{date('Y-m-d')}}" data-date-format="dd MM yyyy - HH:ii p" data-link-field="datetime" placeholder="Please select event date" data-parsley-error-message = "Please select event date" data-parsley-trigger="change" required>
			                    <input class="form-control" size="16" type="text" value="" readonly>
			                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
								<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
			                </div>
			                <input type="hidden" name="datetime" id="datetime" value="" />
	            		@endif
			        </div>
			    </div>
			    <div class="row padding-top5 padding-bottom5">
			    	<div class="col-md-12">
			            <label>Event Venue</label>
			            @if( $getCalenderEventData->venue )
			            	<input type="text" class="form-control" name="venue" placeholder="Please enter event venue" data-parsley-error-message = "Please enter event venue" data-parsley-trigger="change" value="{{ $getCalenderEventData->venue }}" required data-parsley-pattern="^[a-zA-Z0-9\\/s ().,-]*$" data-parsley-trigger="change">
		            	@else
		            		<input type="text" class="form-control" name="venue" placeholder="Please enter event venue" data-parsley-error-message = "Please enter event venue" data-parsley-trigger="change" required data-parsley-pattern="^[a-zA-Z0-9\\/s ().,-]*$" data-parsley-trigger="change">
            			@endif
			        </div>
			    </div>
			    <div class="row padding-top5 padding-bottom5">
			    	<div class="col-md-12">
			            <label>Event URL</label>
			            @if( $getCalenderEventData->link )
			            	<input type="text" class="form-control" name="link" placeholder="Please enter event url" data-parsley-type ="url" data-parsley-error-message = "Please enter valid url here (i.e https://xyz.com, https://www.xyz.com, http://xyz.com, http://www.xyz.com)" data-parsley-trigger="change"  value="{{ $getCalenderEventData->link }}" pattern="^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$">
		            	@else
		            		<input type="text" class="form-control" name="link" placeholder="Enter event url here" data-parsley-type ="url" data-parsley-error-message = "Please enter valid url here (i.e https://xyz.com, https://www.xyz.com, http://xyz.com, http://www.xyz.com)" data-parsley-trigger="change" pattern="^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$">
	            		@endif
			        </div>
			    </div>
			    <div class="row padding-top5 padding-bottom5">
			    	<div class="col-md-12">
			            <label>Event Description</label>
			            @if( $getCalenderEventData->description )
			            	<input type="textarea" class="form-control" name="description" placeholder="Please enter event description" value="{{ $getCalenderEventData->description }}" rows="8">
		            	@else
		            		<input type="textarea" class="form-control" name="description" placeholder="Please enter event description" rows="8">
	            		@endif
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
</div>



{!! Html::script('assets/js/parsley.min.js') !!}

<script type="text/javascript">
  $('form').parsley();
</script>

{!! Html::script('assets/js/plugins/datepicker.js') !!}
<script type="text/javascript">
		jQuery(document).ready(function() {
			Datepicker.initDatepicker();
		});
</script>
{!! Html::script('home-layout/assets/js/plugins/jquery-ui.min.js') !!}
<script type="text/javascript" src="/new-assets/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="/new-assets/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script type="text/javascript">
	$('.datetimepicker').css('z-index','1600');
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