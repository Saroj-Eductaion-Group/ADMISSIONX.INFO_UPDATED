<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="school-info section">
    <div class="section-title">
        <h3>College Help Center</h3>
    </div>
    <div class="section-content">
    	@if(Auth::check()) 
			{!! Form::open(['url' => '/student-for-college', 'method' =>'POST','class' => 'sky-form' ,'role'=>'form','id'=>'sky-form4', 'data-parsley-validate' => '','enctype' => 'multipart/form-data']) !!}
		@else
			<form class="checkLoginStatusFormSubmit" data-parsley-validate="" enctype ="multipart/form-data">
		@endif
			<h4 class="modal-title" id="exampleModalLabel" style="color: #fff;">Write a Query to "{{ $collegeFullName }}"</h4>
			<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
			<div class="margin-bottom-20">
				<label>Recipient</label>
				<input class="form-control rounded-right" type="text" value="{{ $collegeFullName }}" disabled="">
			</div>

			<div class="margin-bottom-20">
				<label>Subject</label>
				<input class="form-control rounded-right" type="text" name="subject" maxlength="100" placeholder="Enter the subject" required="" data-parsley-trigger="change" data-parsley-error-message="Please enter valid subject" >
			</div>
			<div class="margin-bottom-20">
				<label>Message</label>
				<textarea class="form-control" rows="3" placeholder="Enter the message" name="message" required="" maxlength="250" data-parsley-trigger="change" data-parsley-error-message="Please enter valid message"></textarea>
				<p class="text-danger margin-top-20">(Place your query in 250 characters. Thanks Team Admission X)</p>
			</div>
			<div class="row margin-bottom-20">
				<div class="col-md-12">
					<div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}" required=""></div>
					{!! $errors->first('g-recaptcha-response', '<p class="alert alert-danger">:message</p>') !!}
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<button type="submit" class="btn-u btn-block rounded">Submit</button>
				</div>
			</div>
		{!! Form::close() !!}
    </div>
</div>