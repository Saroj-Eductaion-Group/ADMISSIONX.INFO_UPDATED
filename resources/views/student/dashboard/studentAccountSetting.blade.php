<div class="profile-edit tab-pane fade in active">
	<div class="detail-page-signup">
		{!! Form::model($getPreviousData , ['url' => '/student-account-setting-partials-update', 'method' => 'POST', 'class' => 'form-horizontal profileUpdateNow', 'data-parsley-validate' => '','enctype' => 'multipart/form-data']) !!}
			<div class="row">
				<div class="col-md-12">
					<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
					<label>First Name</label>
					{!! Form::text('firstname', null, ['class' => 'form-control', 'placeholder' => 'Enter first name here', 'data-parsley-error-message' => 'Please enter first name here','data-parsley-trigger'=>'change', 'required' => '' ,'data-parsley-pattern'=>'^[a-zA-Z\s .()-]*$']) !!} 
		    	</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
					<label>Middle Name</label>
					{!! Form::text('middlename', null, ['class' => 'form-control', 'placeholder' => 'Enter middle name here','data-parsley-error-message' => 'Please enter middle name here','data-parsley-trigger'=>'change','data-parsley-pattern'=>'^[a-zA-Z\s .()-]*$']) !!}
		    	</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
					<label>Last Name</label>
					{!! Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Enter last name here','data-parsley-error-message' => 'Please enter last name here','data-parsley-trigger'=>'change','data-parsley-pattern'=>'^[a-zA-Z\s .()-]*$']) !!}
		    	</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
					<label>Email Address</label>
					{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter email address here', 'data-parsley-error-message' => 'Please enter email address here','data-parsley-trigger'=>'change', 'data-parsley-type'=>'email', 'required' => '']) !!}
		    	</div>
			</div>

			<div class="row margin-top10">
				<div class="col-md-12">
		            <label>Registered Contact Number</label>
		            {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Enter registered contact number here','data-parsley-type' =>'digits', 'data-parsley-trigger'=>'change','data-parsley-error-message'=>'Please enter valid mobile nubmer']) !!}		<!-- ,'data-parsley-length'=>'[8, 11]' , 'data-parsley-pattern'=>'^[7-9][0-9]{9}$','maxlength'=>'10'-->		
		    	</div>
			</div>

			<div class="row margin-top10">
				<div class="col-md-12">
					<a href="javascript:void(0);" class="btn-u" id="changePassword">Change Password</a>
				</div>
				<div class="col-md-12 passwordBlock hide">
					<label>New Password</label>
					<input type="password" name="password" class="form-control password" id="confirmpassword" placeholder="Enter password here" data-parsley-error-message="Please enter at least 6 characters" minlength="6" data-parsley-minlength="6" data-parsley-trigger="change">
		    	</div>
		    	<div class="col-md-12 passwordBlock hide">
					<label>Confirm Password</label>
					<input type="password" class="form-control password" placeholder="Enter confirm password here" data-parsley-error-message="Confirm password does not match" data-parsley-trigger="change" minlength="6" data-parsley-minlength="6" data-parsley-equalto="#confirmpassword">	
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
  $('form').parsley();

  //$('.passwordBlock').hide();
  $(document).on('click', '#changePassword', function(){
	//$(this).hide();
  	//$('.passwordBlock').toggle();
  	$('.passwordBlock').removeClass('hide');
  	$('#changePassword').addClass('hide');
  	$('.password').attr('required', 'required');
  });
</script>



