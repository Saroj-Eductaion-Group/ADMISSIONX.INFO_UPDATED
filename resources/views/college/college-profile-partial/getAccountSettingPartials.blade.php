<div class="profile-edit tab-pane fade in active">

	<div class="detail-page-signup">
		<div class="headline"><h2>Account Settings</h2></div>
		{!! Form::model($getPreviousData , ['url' => '/get-account-setting-partials/college/update', 'method' => 'POST', 'class' => 'form-horizontal profileUpdateNow', 'data-parsley-validate' => '','enctype' => 'multipart/form-data']) !!}
			<div class="row">
				<div class="col-md-12">
					<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
					<label>College Name</label>
					{!! Form::text('firstname', null, ['class' => 'form-control', 'placeholder' => 'Enter college name here', 'data-parsley-error-message' => 'Please enter college name here','data-parsley-trigger'=>'change', 'required' => '','data-parsley-pattern'=>'^[a-zA-Z0-9\\/s ().,-]*$']) !!}
		    	</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
					<label>Email Address</label>
					{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter email address here', 'data-parsley-error-message' => 'Please enter email address here','data-parsley-trigger'=>'change','data-parsley-type' => 'email' , 'required' => '']) !!}
		    	</div>
			</div>

			<div class="row margin-top10">
				<div class="col-md-12">
		            <label>Registered Contact Number</label>
		            {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Enter registered contact number here', 'data-parsley-error-message' => 'Please enter registered contact number', 'data-parsley-type' => 'number' ,'data-parsley-trigger'=>'change', 'required' => '', 'data-parsley-type'=>'digits']) !!}		
		            <!-- , 'data-parsley-maxlength'=>'12', 'data-parsley-minlength'=>'7', 'maxlength'=>'12' -->			
		    	</div>
			</div>

			<!-- <div class="row margin-top10">
				<div class="col-md-12">
					<a href="javascript:void(0);" class="btn-u" id="changePassword">Change Password</a>
				</div>
				<div class="col-md-12 passwordBlock">
					<label>New Passowrd</label>
					<input type="password" name="password" class="form-control" id="confirmpassword" placeholder="Enter password here" data-parsley-error-message="Please enter password here" data-parsley-trigger="change">
					<div class="margin-top10">
						<label>Confirm Passowrd</label>
						<input type="password" class="form-control" placeholder="Enter confirm password here" data-parsley-error-message="Confirm password does not match" data-parsley-trigger="change" data-parsley-equalto="#confirmpassword">	
					</div>
		    	</div>
			</div> -->
			<div class="form-group margin-top10">
                <div class="col-sm-12 ">
                	<a href="javascript:void(0);" id="changePassword" class="btn-u">Change Password</a>
	                <div class="hide change-password-box">
	                	<label>New Password : </label>
	                    <input type="password" name="password" value="" id="confirmpassword" class="form-control" placeholder="Enter password here" data-parsley-error-message="Please enter password here" data-parsley-trigger="change">
	                
		                <div class="margin-top10">
							<label>Confirm Passowrd</label>
							<input type="password" class="form-control" placeholder="Enter confirm password here" data-parsley-error-message="Confirm password does not match" data-parsley-trigger="change" data-parsley-equalto="#confirmpassword">	
						</div>
					</div>
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
<!-- <script type="text/javascript">
  $('form').parsley();

  $('.passwordBlock').hide();
  $(document).on('click', '#changePassword', function(){
	$(this).hide();
  	$('.passwordBlock').toggle();
  });
</script> -->

<script type="text/javascript">
    $('#changePassword').on('click',function(){
        $('#changePassword').addClass('hide');
        $('.change-password-box').val('');
        $('.change-password-box').removeClass('hide');
        $('.change-password-box').addClass('animated');
        $('.change-password-box').addClass('fadeInDown');
        $('.change-password-box').attr('required', 'required');
        $('.change-password-box').attr('data-parsley-error-message', 'Please enter password of minimum 5 characters');
        $('.change-password-box').attr('data-parsley-trigger', 'change');
        $('.change-password-box').attr('data-parsley-minlength', '5');
        $('.change-password-box').attr('data-parsley-maxlength', '20');
    });
</script>
