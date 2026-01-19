<div class="detail-page-signup margin-bottom40 table-responsive">
	<div class="headline"><h2>Manage Your Social Links </h2><span class="pull-right"><a href="javascript:void(0);" class="btn btn-xs btn-danger closePartialBlade"><i class="fa fa-close"></i> Close</a></span></div>
	<!-- MANAGE THEIR FACEBOOK PAGE -->
	<form method="POST" action="/college-profile-partial" accept-charset="UTF-8" class="form-horizontal profileUpdateNow1">	
		<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
		<div class="row">
			<div class="col-md-12 facebookBlock">
				<label>
					Facebook Page Link
				</label>
				<p class="errorFacebookMsg text-info">Just add a link to the Facebook page (i.e https://www.facebook.com/AdmissionX) here, do not put a link to the Facebook group page, otherwise your Facebook widget will not work.</p>
				<input type="text" class="form-control" id="facebookPageUrl" name="facebookPageUrl" placeholder="Please enter valid facebook page url like : https://www.facebook.com/AdmissionX" value="@if( $collegeDataObj[0]->facebookurl ){{ $collegeDataObj[0]->facebookurl }}@endif">
				<span class="errorFacebookMsg text-danger hide">Please enter valid facebook page url like : https://www.facebook.com/AdmissionX</span>
				<p class="text-center fbloader hide">
					<img src="{{asset('assets/images/loading.gif')}}" width="64">	
				</p>
			</div>
		</div>
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12 col-lg-12 text-right">
				<button class="btn-u submitButton" type="submit">Submit</button>
			</div>
		</div>	
	</form>
	<!-- END -->
</div>

<script type="text/javascript">
	//AJAX
	$( '.profileUpdateNow1' ).submit(function(e) {
		$('.updateProfileBlock').addClass('hide');
  		e.preventDefault();
  		var form = $(this).serialize();

  		$('.fbloader').removeClass('hide');

		var facebookPageUrl = $('#facebookPageUrl').val();
		$.ajax({
	        type: "POST",
	        url: '{{ URL::to("check-facebook-page-exists") }}',
	        data: {facebookPageUrl: facebookPageUrl},
	        success: function(data){
        		$('.fbloader').addClass('hide');
	            if( data !== '404' ){
	            	$.ajax({
				        type: "POST",
				        url: '{{ URL::to("update-facebook-widget-partials") }}',
				        data: form,
				        success: function(data){
				            if( data.code =='200' ){
				            	//window.location.reload();
				            	$('.updateProfileBlock').removeClass('hide');
				            	$('.updateProfileBlock .profileUpdateMessage').html(data.facebookMessage);
				            	$('#profileUpdate').modal({show: 'true'}); 
				            }
				        }
				    });	
	            }else{
	            	$('.errorFacebookMsg').removeClass('hide');
	            }
	        }
	    });  		
	});
</script>