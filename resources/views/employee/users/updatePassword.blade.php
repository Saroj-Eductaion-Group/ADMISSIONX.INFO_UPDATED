@extends('website/website-layouts.master')
@section('styles')
<!-- CSS Page Style -->
{!! Html::style('assets/css/pages/page_log_reg_v4.css') !!}
@endsection

@section('content')
<!--=== Content Part ===-->
<div class="background-form">
	<div class="container content">
		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
				{!! Form::open(['url' => 'password-update-sucess', 'method' => 'POST','class' => 'reg-page detail-page-signup','data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
					<div class="reg-header">
						<a href="{{ URL::to('/') }}">
							<img class="img-responsive" src="../assets/images/logo.png" alt="Admission X">
						</a>
					</div>
					<div class="reg-header">
						<h2>Update your old password</h2>
					</div>

					<div class="margin-bottom-20">
						<label>New Password</label>
						<input type="hidden" name="userID" value="{{ $userID }}">						
						<input type="password" class="form-control" id="password" name="password" data-parsley-trigger="change" data-parsley-error-message="Please enter password" required="" placeholder="">						
					</div>

					<div class="margin-bottom-30">
						<label>Re-type Password</label>
						<input type="password" class="form-control" id="confirmpassword" data-parsley-trigger="change" data-parsley-error-message="Confirm password do not match" required="" 	data-parsley-equalto="#password"	 placeholder="">
					</div>				
					<hr>
					<button type="submit" class="btn-u btn-block rounded">Update Now</button>

				{!! Form::close() !!}
			</div>
		</div><!--/row-->
	</div>
</div>

<!--/container-->
<!--=== End Content Part ===-->

<!--=== Sticky Footer ===-->
<div class="container sticky-footer">
	<ul class="list-unstyled list-inline social-links margin-bottom-30">
		<li><a href="https://www.facebook.com/AdmissionX" target="_blank" title="Like &amp; Share with us on Facebook"><i class="icon-custom icon rounded-x icon-bg-u fa fa-facebook"></i></a></li>
		<li><a href="https://twitter.com/admission_x" target="_blank" title="Follow us on Twitter"><i class="icon-custom icon rounded-x icon-bg-u fa fa-twitter"></i></a></li>
		<li><a href="javascript:void(0);" title="Connect with us on LinkedIn"><i class="icon-custom icon rounded-x icon-bg-u fa fa-linkedin"></i></a></li>
	</ul>
	<p class="copyright-space">
		<i class="fa fa-envelope"></i> <a href="mailto:support@admissionx.info" target="_top" title="Email us anytime">support@admissionx.info</a> | <i class="fa fa-phone"></i> 011-4224-9249
	</p>
</div>
<!--=== End Sticky Footer ===-->
@endsection


@section('scripts')

{!! Html::script('assets/js/forms/login.js') !!}


<script type="text/javascript">
	$('body').addClass('padding-bottom0');
	// $(".image-block").backstretch([
	// 	"assets/images/bg/1.jpg",
	// ]);
</script>
<script type="text/javascript">
	$('#forgetPasswordModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('If your are unable to remember your password. Kindly help us to get you back.')
  modal.find('.modal-body input').val()
})

</script>


@endsection