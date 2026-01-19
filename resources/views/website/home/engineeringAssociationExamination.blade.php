@extends('website/new-design-layouts.master')

@section('styles')
<script src='https://www.google.com/recaptcha/api.js'></script>
<style type="text/css">
	.footer { padding: 50px 0 !important; }
    .msg-error {color: #c64848;  padding-left: 15px;}
	.g-recaptcha.error {border: solid 2px #c64848; padding: 1px; width: 22em;}

    #g-recaptcha-response {
	    display: block !important;
	    position: absolute;
	    margin: -78px 0 0 0 !important;
	    width: 302px !important;
	    height: 76px !important;
	    z-index: -999999;
	    opacity: 0;
	}
</style>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
@endsection


@section('content')
<div class="container-fluid">
	
<img src="assets/images/aieaexam.png" alt="All India Engineering Association">
</div>
<div class="breadcrumbs">
	<div class="container">
		<h1 class="pull-left">All India Engineering Association</h1>		
	</div>
</div>


<div class="content container">
	<div class="row">
		
		@if(Session::has('flash_message'))
		    <div class="col-md-6 col-md-offset-3">
		    	<div class="alert alert-{{ Session::get('alert-color-success') }}  alert-dismissible fade in text-center" role="alert">
		            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                <span aria-hidden="true">×</span>
		            </button>
		            <strong>{{ Session::get('flash_message') }}</strong>
		        </div>
		    </div>
		@endif

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			{!! Form::open(['url' => '/administrator/engineering-exam', 'class' => 'sky-form','data-parsley-validate' => '','method'=>'POST', 'files'=>true, 'enctype' => 'multipart/form-data']) !!}
				<header>Take The Exam</header>
				<fieldset>
					<div class="row">
						<div class="col-md-12 headline"><h4 class="heading-sm">Candidate Name</h4></div>
					</div>
					<div class="row">
						<section class="col-md-3">
							<label class="label">Title</label>
							<label class="select">
								<select name="title" required="">
									<option value="Mr." selected="">Mr.</option>
									<option value="Mrs.">Mrs.</option>
									<option value="Miss">Miss</option>
								</select>
								<i></i>
							</label>
						</section>
						<section class="col-md-3">
							<label class="label">First Name</label>
							<label class="input">
								<input type="text" name="firstname" id="firstname" required="" data-parsley-error-message="Enter first name">
							</label>
						</section>
						<section class="col-md-3">
							<label class="label">Middle Name</label>
							<label class="input">
								<input type="text" name="middlename">
							</label>
						</section>
						<section class="col-md-3">
							<label class="label">Last Name</label>
							<label class="input">
								<input type="text" name="lastname" id="lastname" required="" data-parsley-error-message="Enter last name">
							</label>
						</section>
					</div>

					<div class="row">
						<section class="col-md-6">
							<label class="label">Email</label>
							<label class="input">
								<input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" name="email" id="examemail" required="" data-parsley-error-message="Enter valid email address">
							</label>
						</section>
						<section class="col-md-6">
							<label class="label">Phone Number</label>
							<label class="input">
								<input type="text" name="phone" id="phone" required="" data-parsley-error-message="Enter phone number">
							</label>
						</section>
					</div>

					<div class="row">
						<section class="col-md-3">
							<label class="label">Father's/Husband's Name</label>
							<label class="input">
								<input type="text" name="fathername" id="fathername" required="" data-parsley-error-message="Enter father's/husband's name">
							</label>
						</section>

						<section class="col-md-3">
							<label class="label">Category</label>
							<label class="select">
								<select name="category" required="" data-parsley-error-message="Select category">
									<option value="GEN" selected="">GEN</option>
									<option value="SC/ST">SC/ST</option>									
									<option value="OBC">OBC</option>
									<option value="Other">Other</option>
								</select>
								<i></i>
							</label>
						</section>

						<section class="col-md-3">
							<label class="label">Gender</label>
							<label class="select">
								<select name="gender" required="" data-parsley-error-message="Select gender">
									<option value="Male" selected="">Male</option>
									<option value="Female">Female</option>
									<option value="Other">Other</option>
								</select>
								<i></i>
							</label>
						</section>

						<section class="col-md-3">
							<label class="label">Nationality</label>
							<label class="input">
								<input type="text" name="nationality" id="nationality" required="" data-parsley-error-message="Enter nationality">
							</label>
						</section>
					</div>				

					<div class="row">
						<div class="col-md-12 headline"><h4 class="heading-sm">Choice of Center</h4></div>
					</div>

					<div class="row">
						<section class="col-md-4">
							<label class="label">Choice 1st</label>
							<label class="select">
								<select name="choice1st" class="choice1st" required="" data-parsley-error-message="Select city">
									<option disabled="" selected="">Select City</option>
									@foreach( $getAllCityObj as $item )
										<option value="{{ $item->name }}">{{ $item->name }}</option>
									@endforeach
								</select>
								<i></i>
							</label>
						</section>

						<section class="col-md-4">
							<label class="label">Choice 2nd</label>
							<label class="select">
								<select name="choice2nd" class="choice2nd" required="" data-parsley-error-message="Select city" >
									<option disabled="" selected="">Select City</option>
									@foreach( $getAllCityObj as $item )
										<option value="{{ $item->name }}">{{ $item->name }}</option>
									@endforeach
								</select>
								<i></i>
							</label>
						</section>

						<section class="col-md-4">
							<label class="label">Choice 3rd</label>
							<label class="select">
								<select name="choice3rd" class="choice3rd" required="" data-parsley-error-message="Select city">
									<option disabled="" selected="">Select City</option>
									@foreach( $getAllCityObj as $item )
										<option value="{{ $item->name }}">{{ $item->name }}</option>
									@endforeach
								</select>
								<i></i>
							</label>
						</section>
					</div>	


					<div class="row">						
						<section class="col-md-6">
							<div class="col-md-12 headline"><h4 class="heading-sm">Correspondence Address</h4></div>
							<div class="margin-top20 padding-top10">
								<label class="label">Address Line 1</label>
								<label class="input">
									<input type="text" name="firstaddress1" id="firstaddress1" required="" data-parsley-error-message="Enter address line 1">
								</label>
							</div>
							<div class="margin-top20 padding-top10">
								<label class="label">Address Line 2</label>
								<label class="input">
									<input type="text" name="firstaddress2" id="firstaddress2" required="" data-parsley-error-message="Enter address line 2">
								</label>
							</div>
							<div class="margin-top20 padding-top10">
								<label class="label">Address Line 3</label>
								<label class="input">
									<input type="text" name="firstaddress3" id="firstaddress3" required="" data-parsley-error-message="Enter address line 3">
								</label>
							</div>
							<div class="margin-top20 padding-top10">
								<label class="label">State</label>
								<label class="select">
									<select name="firststate" required="" data-parsley-error-message="Select state">
										<option disabled="" selected="">Select State</option>
										@foreach( $getAllStateObj as $item )
											<option value="{{ $item->name }}">{{ $item->name }}</option>
										@endforeach
									</select>
									<i></i>
								</label>
							</div>
							<div class="margin-top20 padding-top10">
								<label class="label">City</label>
								<label class="select">
									<select data-parsley-trigger="change" data-parsley-error-message="Please select city" name="firstcity" required="" data-parsley-error-message="Select city">
										<option disabled="" selected="">Select City</option>
									</select>
									<i></i>
								</label>

							</div>
							
							<div class="margin-top20 padding-top10">
								<label class="label">Pin Code</label>
								<label class="input">
									<input type="text" name="firstpincode" required="" data-parsley-error-message="Enter pin code">
								</label>
							</div>
							<div class="margin-top20 padding-top10">
								<label class="label">Contact Number</label>
								<label class="input">
									<input type="text" name="firstcontact" required="" data-parsley-error-message="Enter contact number">
								</label>
							</div>

							<div class="margin-top20 padding-top10">
								<label class="checkbox"><input id="addresssame" type="checkbox" name="addresssame" value="1"><i></i> Please Tick If Correspondence And Permanent Address Are Same.</label>
							</div>
						</section>

						<section class="col-md-6">
							<div class="col-md-12 headline"><h4 class="heading-sm">Permanent Address</h4></div>
							<div class="margin-top20 padding-top10">
								<label class="label">Address Line 1</label>
								<label class="input">
									<input type="text" class="secondaddress1" name="secondaddress1" id="secondaddress1">
								</label>
							</div>
							<div class="margin-top20 padding-top10">
								<label class="label">Address Line 2</label>
								<label class="input">
									<input type="text" class="secondaddress2" name="secondaddress2" id="secondaddress2">
								</label>
							</div>
							<div class="margin-top20 padding-top10">
								<label class="label">Address Line 3</label>
								<label class="input">
									<input type="text" class="secondaddress3" name="secondaddress3" id="secondaddress3">
								</label>
							</div>
							<div class="margin-top20 padding-top10">
								<label class="label">State</label>
								<label class="select">
									<select class="secondstate" name="secondstate" >
										<option disabled="" selected="">Select State</option>
										@foreach( $getAllStateObj as $item )
											<option value="{{ $item->name }}">{{ $item->name }}</option>
										@endforeach
									</select>
									<i></i>
								</label>
							</div>
							<div class="margin-top20 padding-top10">
								<label class="label">City</label>
								<label class="select">
									<select class="secondcity" data-parsley-trigger="change" data-parsley-error-message="Please select city" name="secondcity" required="" data-parsley-error-message="Select city">
										<option disabled="" selected="">Select City</option>
									</select>
									<i></i>
								</label>
							</div>
							
							<div class="margin-top20 padding-top10">
								<label class="label">Pin Code</label>
								<label class="input">
									<input type="text" class="secondpincode"  name="secondpincode">
								</label>
							</div>
							<div class="margin-top20 padding-top10">
								<label class="label">Contact Number</label>
								<label class="input">
									<input type="text" class="secondcontact" name="secondcontact">
								</label>
							</div>
						</section>
					</div>

					<div class="row">
						<div class="col-md-12 headline"><h4 class="heading-sm">Qualification Details</h4></div>
					</div>

					<div class="row">
						<div class="col-md-12 headline"><h3 class="heading-sm">Matriculation</h3></div>
					</div>

					<div class="row">
						<section class="col-md-2">
							<label class="label">Board</label>
							<label class="input">
								<input type="text" name="board1" required="" data-parsley-error-message="Enter board name">
							</label>
						</section>
						<section class="col-md-2">
							<label class="label">Subjects</label>
							<label class="input">
								<input type="text" name="subject1" required="" data-parsley-error-message="Enter subjects">
							</label>
						</section>
						<section class="col-md-2">
							<label class="label">Passing Year</label>
							<label class="input">
								<input type="text" name="passingyr1" required="" data-parsley-error-message="Enter passing year">
							</label>
						</section>
						<section class="col-md-2">
							<label class="label">Percentage</label>
							<label class="input">
								<input type="text" name="percentage1" required="" data-parsley-error-message="Enter percentage">
							</label>
						</section>
						<section class="col-md-2">
							<label class="label">CGPA</label>
							<label class="input">
								<input type="text" name="cgpa1" required="" data-parsley-error-message="Enter CGPA">
							</label>
						</section>
						<section class="col-md-2">
							<label class="label">Division</label>
							<label class="input">
								<input type="text" name="division1" required="" data-parsley-error-message="Enter division">
							</label>
						</section>
					</div>

					<div class="row">
						<div class="col-md-12 headline"><h3 class="heading-sm">Intermediate</h3></div>
					</div>

					<div class="row">
						<section class="col-md-2">
							<label class="label">Board</label>
							<label class="input">
								<input type="text" name="board2" required="" data-parsley-error-message="Enter board name">
							</label>
						</section>
						<section class="col-md-2">
							<label class="label">Subjects</label>
							<label class="input">
								<input type="text" name="subject2" required="" data-parsley-error-message="Enter subjects">
							</label>
						</section>
						<section class="col-md-2">
							<label class="label">Passing Year</label>
							<label class="input">
								<input type="text" name="passingyr2" required="" data-parsley-error-message="Enter passing year">
							</label>
						</section>
						<section class="col-md-2">
							<label class="label">Percentage</label>
							<label class="input">
								<input type="text" name="percentage2" required="" data-parsley-error-message="Enter percentage">
							</label>
						</section>
						<section class="col-md-2">
							<label class="label">CGPA</label>
							<label class="input">
								<input type="text" name="cgpa2" required="" data-parsley-error-message="Enter CGPA">
							</label>
						</section>
						<section class="col-md-2">
							<label class="label">Division</label>
							<label class="input">
								<input type="text" name="division2"  required="" data-parsley-error-message="Enter division">
							</label>
						</section>
					</div>

					<div class="row">
						<div class="col-md-12 headline">
							<h3 class="heading-sm">Declaration</h3>
							<div class="padding-top10">
								<label class="checkbox"><input type="checkbox" name="iagree" required="" data-parsley-error-message="Please check the checkbox"><i></i> All statements made in this application form are true, complete and correct to the best of my knowledge and belief. In the form if any information found false or incorrect, necessary action can be taken against me by the organization (Admissionx.com).</label>
							</div>
						</div>
					</div>

					<div class="row">
						<section class="col-md-6">
							<label class="label">Place</label>
							<label class="input">
								<input type="text" name="place"  required="" data-parsley-error-message="Enter place">

								<i></i>
							</label>
						</section>
						<section class="col-md-6">
							<label class="label">Date</label>
							<label class="input">
								<input type="date" name="date" data-parsley-error-message="Select date" min="<?php echo date("Y-m-d"); ?>">
							</label>
						</section>
					</div>
					<div class="row margin-bottom-20">
						<div class="col-md-12">
							<div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}" required=""></div>
							{!! $errors->first('g-recaptcha-response', '<p class="alert alert-danger">:message</p>') !!}
						</div>
					</div>
					<div class="row">
						<section class="col-md-12">
							<p class="text-right">
								<button class="btn btn-danger" id="btnValidate">Submit</button>
							</p>
						</section>
					</div>

				</fieldset>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
	// $('#btnValidate').click(function(e){
	// 	e.preventDefault();
	//   	var $captcha = $('#recaptcha'),
	//     response = grecaptcha.getResponse();
	// 	if (response.length === 0) {
	// 		toastr.error('reCAPTCHA is mandatory');
	// 	    $( '.msg-error').text( "reCAPTCHA is mandatory" );
	// 	    if( !$captcha.hasClass( "error" ) ){
	// 	      $captcha.addClass( "error" );
	// 	    }
	// 	    return false;
	// 	}else{
	// 	    $('.msg-error').text('');
	// 	    $captcha.removeClass( "error" );
	// 	    //toastr.success('reCAPTCHA marked');
	// 	    this.form.submit();
	// 	}
	// });
</script>
<script type="text/javascript">
	$('form').parsley();
    window.onload = function() {
		var $recaptcha = document.querySelector('#g-recaptcha-response-3');

		if($recaptcha) {
		    $recaptcha.setAttribute("required", "required");
		}
	};
</script>

<script type="text/javascript">
	$(document).on('click', '#addresssame', function(){
		if($('#addresssame').attr('checked')) {
			$('.secondaddress1').attr('readonly', 'readonly');
			$('.secondaddress2').attr('readonly', 'readonly');
			$('.secondaddress3').attr('readonly', 'readonly');
			$('.secondstate').attr('disabled', 'disabled');
			$('.secondcity').attr('disabled', 'disabled');
			$('.secondpincode').attr('readonly', 'readonly');
			$('.secondcontact').attr('readonly', 'readonly');
		}else{
			$('.secondaddress1').removeAttr('readonly', '');
			$('.secondaddress2').removeAttr('readonly', '');
			$('.secondaddress3').removeAttr('readonly', '');
			$('.secondstate').removeAttr('disabled');
			$('.secondcity').removeAttr('disabled');
			$('.secondpincode').removeAttr('readonly', '');
			$('.secondcontact').removeAttr('readonly', '');
		}
	});
</script>
<script type="text/javascript">
    $('.choice1st').on('change', function(){
    	var choice1st = $(this).val();
    	
    	$(".choice2nd option").filter(function(){
	    	return $.trim($(this).text()) == choice1st
		}).remove();

		$(".choice3rd option").filter(function(){
	    	return $.trim($(this).text()) == choice1st
		}).remove();
    });

    $('.choice2nd').on('change', function(){
    	var choice2nd = $(this).val();
        
  		$(".choice3rd option").filter(function(){
	    	return $.trim($(this).text()) == choice2nd
		}).remove();
    });

    $('select[name=firststate]').on('change', function(){
        var currentID = $(this).val();
        $('.cityHide').css('visibility', 'visible');
        $.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {currentID: currentID},
            url: "{{ URL::to('getAllExamCityName') }}",
            success: function(data) {
                var HTML = '';
                HTML += '<option selected="" disabled="">City</option>';
                if( data.code == '200' ){
                    $.each(data.cityObj, function(i, item) {
                        HTML += '<option value="'+data.cityObj[i].name+'">'+data.cityObj[i].name+'</option>';
                    }); 
                }else{
                    HTML += '<option selected="" disabled="">No city available</option>';
                }

                $('select[name="firstcity"]').empty();
                $('select[name="firstcity"]').html(HTML);
                $('select[name="firstcity"]').trigger('chosen:updated');
            }
        });
    });

    $('select[name=secondstate]').on('change', function(){
        var currentID = $(this).val();
        $('.cityHide').css('visibility', 'visible');
        $.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {currentID: currentID},
            url: "{{ URL::to('getAllExamCityName') }}",
            success: function(data) {
                var HTML = '';
                HTML += '<option selected="" disabled="">City</option>';
                if( data.code == '200' ){
                    $.each(data.cityObj, function(i, item) {
                        HTML += '<option value="'+data.cityObj[i].name+'">'+data.cityObj[i].name+'</option>';
                    }); 
                }else{
                    HTML += '<option selected="" disabled="">No city available</option>';
                }

                $('select[name="secondcity"]').empty();
                $('select[name="secondcity"]').html(HTML);
                $('select[name="secondcity"]').trigger('chosen:updated');
            }
        });
    });

</script>    
@endsection