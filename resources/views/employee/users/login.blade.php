 @extends('website/website-layouts.master')

@section('styles')
<!-- CSS Page Style -->
{!! Html::style('assets/css/pages/page_log_reg_v4.css') !!}
@endsection

@section('content')
<!--=== Content Part ===-->
<div class="background-form">
	<div class="container content">
		<!-- Session block -->
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				@if(Session::has('confirmDisabledEmail'))
					<div class="alert alert-danger alert-dismissable text-center">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        {{ Session::get('confirmDisabledEmail') }}                        
                    </div>
            	@endif
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				@if(Session::has('confirmBlockedEmail'))
					<div class="alert alert-danger alert-dismissable text-center">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        {{ Session::get('confirmBlockedEmail') }}                        
                    </div>
            	@endif
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				@if(Session::has('verifiedEmail'))
					<div class="alert alert-success alert-dismissable text-center">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        {{ Session::get('verifiedEmail') }}                        
                    </div>
            	@endif
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				@if(Session::has('confirmEmail'))
					<div class="alert alert-success alert-dismissable text-center">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        {{ Session::get('confirmEmail') }}
                        <br>
                        <a href="{{ url('resend-email-link', Session::get('emailAdd')) }}" class="btn btn-sm btn-u margin-top10 margin-bottom10" title="Resend email now">Resend Email Now</a>
                    </div>
            	@endif
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				@if(Session::has('pleaseVierfyYourEmail'))
					<div class="alert alert-warning alert-dismissable text-center">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        {{ Session::get('pleaseVierfyYourEmail') }}
                    </div>
            	@endif
			</div>
		</div>
		<!-- End Sessio Block -->
		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
				{!! Form::open(['url' => 'user/doLogin', 'method' => 'POST','class' => 'reg-page detail-page-signup', 'data-parsley-validate' => '']) !!}
					<div class="reg-header">
						<a href="{{ URL::to('/') }}">
							<img class="img-responsive" src="{{asset('assets/images/logo.png')}}" alt="Admission X">
						</a>
					</div>

					<div class="reg-header">
						<h2>Login to your account</h2>
						@if ($errors->any())
						    <div class="alert alert-danger alert-dismissable text-center">
						    	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
						        @foreach ($errors->all() as $error)
						            {{ $error }}
						        @endforeach
					        </div>
						@endif
					</div>
					<div >
						@if(Session::has('success'))
	                    <div class="alert alert-success alert-dismissible" id="dialog" role="alert">
	                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                            <span aria-hidden="true">&times;</span>
	                        </button>
	                        <strong>{{ Session::get('success') }}</strong>
	                    </div>                        
	                	@endif
					</div>

					<div class="margin-bottom-20">
						<label>Email</label>
						<input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" class="form-control" name="email" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="" placeholder="">						
					</div>

					<div class="margin-bottom-30">
						<label>Password</label>
						<input type="password" class="form-control" id="password" name="password" data-parsley-trigger="change" data-parsley-error-message="Please enter valid password" required="" placeholder="">
					</div>				

					<button type="submit" class="btn-u btn-block rounded">Login</button>

					<hr>

					<h4>Forget your Password ?</h4>
					<p>No worries, <a class="color-green" data-toggle="modal" data-target="#forgetPasswordModal" data-whatever="" href="">click here</a> to reset your password.</p>
				{!! Form::close() !!}				
			</div>
		</div><!--/row-->
	</div>
</div>

<div class="modal fade" id="forgetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form  action="forget-password" method="POST" data-parsley-validate="">
      <div class="modal-header modal-header-design">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        
          <div class="form-group">
            <label for="recipient-name" class="control-label">Registered Email Address:</label>
            <input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" name="email" class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="" id="recipient-name">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-u">Send message</button>
      </div>
      </form>
    </div>
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
<script type="text/javascript">
	$(".alert").fadeTo(10000, 500).slideUp(500, function(){
    $(".alert").alert('close');
});
</script>
@endsection