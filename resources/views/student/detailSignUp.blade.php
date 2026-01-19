@extends('website/new-design-layouts.master')

@section('styles')
<!-- CSS Page Style -->
<!-- {!! Html::style('assets/css/pages/page_log_reg_v4.css') !!} -->
<script src='https://www.google.com/recaptcha/api.js'></script>
{!! Html::style('/new-assets/css/plugins/datapicker/datepicker3.css') !!}
{!! Html::style('/new-assets/css/plugins/daterangepicker/daterangepicker-bs3.css') !!}

<style type="text/css">
    .msg-error {color: #c64848;  padding-left: 15px;}
	.g-recaptcha.error {border: solid 2px #c64848; padding: 1px; width: 22em;}
    .login-box1 a {font-family: open sans, serif; display: inline-block; background: #3b5998; color: #fff; font-size: 18px; margin-bottom: 15px;
        text-align: center; font-weight: 500; padding: 5px;}
    .login-box1 a span { font-family: open sans, serif;}
    .login-box1 a.active { background: #d40d12;}
    .background-form {background: url(/assets/css/1.jpg) 50% fixed;padding: 60px 0;position: relative;background-size: cover;}
</style>

@endsection

@section('content')
<!--=== Content Part ===-->
<div class="background-form">
	<div class="container content">
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
		<div class="row">
			<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
				{!! Form::open(['url' => '/student-profile-details', 'method' => 'POST','class' => 'sky-form detail-page-signup','role'=>'form', 'id'=>'', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
					<div class="reg-header">
						<a href="{{ URL::to('/') }}">
							<img src="{{asset('assets/images/logo.png')}}" class="img-responsive" alt="">
						</a>
						<p class="margin-top10">STUDENT PROFILE DETAILS</p>
					</div>
					

					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12">
							<input type="hidden" name="studentUserId" value="{{ $studentUserId }}">
							<input type="hidden" name="slug" value="{{ $slug }}">
							@foreach(  $getStudentNameObj as  $student )
								<h4 class="margin-bottom30">Hi, <span class="color-green">{{ $student->firstName }} {{ $student->middleName }}  {{ $student->lastName }}  ({{  $student->email }})</span></h4>
							@endforeach
							
						</div>
					</div>

					<div class="row padding-top5 padding-bottom5">
						<!-- <div class="col-md-6">
							<label>10th Marks</label>
							{!! Form::text('tenthMarks', null, ['class' => 'form-control', 'placeholder' => 'Enter 10th mark',  'required' => '','data-parsley-type'=>'number','data-parsley-length' => '[2, 3]', 'data-parsley-trigger'=>'change','data-parsley-error-message'=>'Please enter 10th mark here']) !!}
						</div> -->
						<div class="col-md-12">
							<label>10th Percentage</label>
							<!-- {!! Form::text('tenthMarksPercentage', null, ['class' => 'form-control', 'placeholder' => 'Enter 10th percentage','data-parsley-trigger'=>'change','data-parsley-error-message'=>'Please enter 10th percentage here','data-parsley-type'=>'digits','data-parsley-length' => '[2, 3]','data-parsley-minlength'=>'1','data-parsley-maxlength'=>'3','maxlength'=>'3','data-parsley-max'=>'100']) !!} -->
							<select class="form-control chosen-select" name="tenthMarksPercentage">
                                <option value="" disabled="" selected="">Please Select 10 Percentage</option>
                                {{--*/ $Percent10 = '0' /*--}}
                                @for( $Percent10 = '0'; $Percent10 < '101'; $Percent10++ )
                                    <option value="{{ $Percent10 }}">{{ $Percent10 }}%</option>
                                @endfor
                            </select>
						</div>
					</div>

					<div class="row padding-top5 padding-bottom5">
						<!-- <div class="col-md-6">
							<label>11th Marks</label>
							{!! Form::text('eleventhmarks', null, ['class' => 'form-control', 'placeholder' => 'Enter 11th mark',  'data-parsley-type'=>'number','data-parsley-length' => '[2, 3]', 'data-parsley-trigger'=>'change','data-parsley-error-message'=>'Please enter 11th mark here']) !!}
						</div> -->
						<div class="col-md-12">
							<label>11th Percentage</label>
							<!-- {!! Form::text('eleventhMarksPercentage', null, ['class' => 'form-control', 'placeholder' => 'Enter 11th percentage','data-parsley-trigger'=>'change','data-parsley-error-message'=>'Please enter valid 11th percentage here','data-parsley-type'=>'digits','data-parsley-length' => '[2, 3]','data-parsley-minlength'=>'1','data-parsley-maxlength'=>'3','maxlength'=>'3','data-parsley-max'=>'100']) !!} -->
							<select class="form-control chosen-select" name="eleventhMarksPercentage">
                                <option value="" disabled="" selected="">Please Select 11 Percentage</option>
                                {{--*/ $Percent11 = '0' /*--}}
                                @for( $Percent11 = '0'; $Percent11 < '101'; $Percent11++ )
                                    <option value="{{ $Percent11 }}">{{ $Percent11 }}%</option>
                                @endfor
                            </select>
						</div>
					</div>

					<div class="row padding-top5 padding-bottom5">
						<!-- <div class="col-md-6">
							<label>12th Marks</label>
							{!! Form::text('twelvemarks', null, ['class' => 'form-control', 'placeholder' => 'Enter 12th mark',  'data-parsley-type'=>'number','data-parsley-length' => '[2, 3]', 'data-parsley-trigger'=>'change','data-parsley-error-message'=>'Please enter 12th mark here']) !!}
						</div> -->
						<div class="col-md-12">
							<label>12th Percentage</label>
							<!-- {!! Form::text('twelveMarksPercentage', null, ['class' => 'form-control', 'placeholder' => 'Enter 12th percentage','data-parsley-trigger'=>'change','data-parsley-error-message'=>'Please enter 12th percentage here','data-parsley-type'=>'digits','data-parsley-length' => '[2, 3]','data-parsley-minlength'=>'1','data-parsley-maxlength'=>'3','maxlength'=>'3','data-parsley-max'=>'100']) !!} -->
							<select class="form-control chosen-select" name="twelveMarksPercentage">
                                <option value="" disabled="" selected="">Please Select 12 Percentage</option>
                                {{--*/ $Percent12 = '0' /*--}}
                                @for( $Percent12 = '0'; $Percent12 < '101'; $Percent12++ )
                                    <option value="{{ $Percent12 }}">{{ $Percent12 }}%</option>
                                @endfor
                            </select>
						</div>
					</div>
					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12">
							<label>Upload Your 10th Marksheet</label>
							<label for="file" class="input input-file">
								<span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh2"class="hide"><i class="fa fa-remove"></i></a> </span>
								<div class=""><input type="file" name="tenthDocument" class="tenthDocument" onchange="this.parentNode.nextSibling.value = this.value" data-parsley-trigger="change"></div>
							</label>
							<p class="text-danger hide" id="10thDoc">(please upload .jpg, .jpeg, .png and .pdf file only)</p>
						</div>
					</div>

					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12">
							<label>Upload Your 12th Marksheet</label>
							<label for="file" class="input input-file">
								<span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh3"class="hide"><i class="fa fa-remove"></i></a> </span>
								<div class=""><input type="file" name="twelveDocument" class="twelveDocument" onchange="this.parentNode.nextSibling.value = this.value" placeholder=""  data-parsley-filemaxmegabytes="2" data-parsley-trigger="change" ></div>
							</label>
							<p class="text-danger hide" id="12thDoc">(please upload .jpg, .jpeg, .png and .pdf file only)</p>
						</div>
					</div>
					<div class="row padding-top5 padding-bottom5">
				        <div class="col-md-12 ">
				            <label>Gender </label>
							<select name="gender" class="form-control">
		                        <option value="" selected disabled >Select Gender</option>
		                        <option value="Male">Male</option>
		                        <option value="Female">Female</option>
		                        <option value="Other">Other</option>
		                    </select>
				        </div>
				    </div>
				    <div class="row padding-top5 padding-bottom5">
						<div class="col-md-12">
							<label>Date Of Birth</label>
							<input type="text" class="form-control" id="dateChange" name="dateofbirth" placeholder="Enter date of birth here" readonly=""> 


							<label class="text-primary">Age as on {!! date('d-m-Y') !!} : </label>
							<label class="text-primary calculatedDateFromNow"></label>
							<div class="hide gurdianBlock">
								<label>Parent Name</label>
								<input type="text" class="form-control" name="parentsname" placeholder="Enter parent name here" data-parsley-error-message = "Please enter your parent name" data-parsley-trigger="change" ><!-- data-parsley-pattern="^[a-zA-Z\s .]*$" -->
								<br/>
								<label>
									Parent Phone No
									<br><span class="text-info">(Please exclude country code before mobile number [For India : +91])</span>
								</label>
								<input type="text" class="form-control" name="parentsnumber" placeholder="Please enter mobile number" data-parsley-type ="digits" data-parsley-error-message = "Please enter valid mobile number"  data-parsley-trigger="change"><!-- data-parsley-length="[7, 11]" data-parsley-pattern="^[7-9][0-9]{9}$" -->
							</div>

						</div>
					</div>
					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12">
							<label>Hobbies</label>
							<input type="text" class="form-control" name="hobbies" placeholder="Enter hobbies here"  data-parsley-error-message = "Please enter your hobbies" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z0-9\s .,-]*$">
						</div>
					</div>

					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12">
							<label>Interest </label>
							<input type="text" class="form-control" name="interests" placeholder="Enter interests here"  data-parsley-error-message = "Please enter your interests" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z0-9\s .,-]*$">
						</div>
					</div>
					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12">
							<label>Achievement Awards <span class="tooltips hide glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="right" title="For multiple achivement / awards please use comma ( , ) separator"></span> <span class="label label-primary hide" style="color: #ffffff;"> <i class="fa fa-arrow-right"></i> For multiple achivement / awards please use comma ( , ) separator</span></label></label>
							<input type="textarea" class="form-control" name="achievementsawards" placeholder="Enter achievement awards here"  data-parsley-error-message = "Please enter valid achievement awards" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z0-9\s .,-]*$">
						</div>
					</div>

					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12">
							<label>Projects </label>
							<input type="textarea" class="form-control" name="projects" placeholder="Enter projects here"  data-parsley-error-message = "Please enter valid projects" data-parsley-trigger="change" data-parsley-pattern="^[a-zA-Z0-9\s .,-]*$">
						</div>
					</div>
					<!-- <div class="row padding-top5 padding-bottom5">
						<div class="col-md-12">
							<label>Select Entrance Exam Name</label>
						</div>
						<div class="col-md-12">
							<select name="entranceExam" class="form-control chosen-select" data-parsley-trigger="change" data-parsley-error-message="Please select your entrance exam">
	                        	<option value="" selected disabled>Select entrance exam</option>  
	                          	@foreach ($entranceExam as $entrance)
		                            <option value="{{ $entrance->id }}">{{ $entrance->name }}</option>
		                        @endforeach     
	                        </select>  
						</div>	
					</div>
					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12">
							<label>Entrance Exam No </label>
							<input type="text" class="form-control" name="entranceexamnumber" placeholder="Enter entrance exam number here"  data-parsley-error-message = "Please enter your entrance exam number" data-parsley-trigger="change">
						</div>
					</div> -->

					<hr>

					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-3 col-lg-3 text-left">
							<a class="btn-u btn-block" href="{{ URL::to('return-back') }}">Skip Now</a>
						</div>
						<div class="col-md-9 col-lg-9 text-right">
							<button class="btn-u" type="submit">Register</button>
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div><!--/container-->
<!--=== End Content Part ===-->

<!--=== Sticky Footer ===-->
<!-- <div class="container sticky-footer">
	<ul class="list-unstyled list-inline social-links margin-bottom-30">
		<li><a href="http://www.facebook.com/itsadmissionx" target="_blank" title="Like &amp; Share with us on Facebook"><i class="icon-custom icon rounded-x icon-bg-u fa fa-facebook"></i></a></li>
		<li><a href="https://twitter.com/admission_x" target="_blank" title="Follow us on Twitter"><i class="icon-custom icon rounded-x icon-bg-u fa fa-twitter"></i></a></li>
		<li><a href="javascript:void(0);" title="Connect with us on LinkedIn"><i class="icon-custom icon rounded-x icon-bg-u fa fa-linkedin"></i></a></li>
	</ul>
	<p class="copyright-space">
		<i class="fa fa-envelope"></i> <a href="mailto:support@admissionx.info" target="_top" title="Email us anytime">support@admissionx.info</a> | <i class="fa fa-phone"></i> 011-4224-9249
	</p>
</div> -->
<!--=== End Sticky Footer ===-->
@endsection


@section('scripts')
{!! Html::script('/new-assets/js/plugins/datapicker/bootstrap-datepicker.js') !!}

{!! Html::script('assets/js/forms/login.js') !!}
{!! Html::script('assets/js/forms/signup-detail.js') !!}
<script src="/assets/js/parsley.min.js"></script>

<script type="text/javascript">
	jQuery(document).ready(function() {
		SignUpDetailForm.initSignUpForm();
	});
</script>

<script type="text/javascript">
	$.backstretch([
		"/assets/img/bg/11.jpg",
		"/assets/img/bg/19.jpg",
		"/assets/css/1.jpg",
		"/assets/img/main/img12.jpg",
		"/assets/images/bg/1.jpg",
		"/assets/images/bg/18.jpg",
		], {
			fade: 1000,
			duration: 7000
		});
</script>
<script type="text/javascript">
	// $(function(){ 
	// 	$( "#dateChange" ).datepicker({ changeYear: true, changeMonth: true, yearRange: '1970:2017',maxDate: new Date(), dateFormat: 'dd/mm/yy' }); 
	// });

	// $('#dateChange').datepicker({
 //        todayBtn: "linked",
 //        keyboardNavigation: false,
 //        forceParse: false,
 //        autoclose: true,
 //        changeMonth: true,
 //        changeYear: true,
 //        minDate: '-15Y',
 //        maxDate: '+5Y',
 //        format: "dd/mm/yy"
 //    });

    $('#dateChange').datepicker({
    	'autoclose': true,
        'changeMonth': true,
        'changeYear': true,
        'yearRange':  '1940:'+"{!! $lastYear !!}",
        'setDate' : "{!! $prevYear !!}",
        'endDate' : "{!! $prevYear !!}",
    });
   // $("#dateChange").datepicker("setDate", "{!!$prevYear !!}");
</script>


<script type="text/javascript">
    $(document).ready(function(){   

	    $('.tenthDocument').on('change',function(){
	        $('#refresh2').removeClass('hide');
	    });
	    $('#refresh2').on('click',function(e){
	        $('.tenthDocument').val('').trigger('chosen:updated');
	        $('#refresh2').addClass('hide');
	    });

	    $('.twelveDocument').on('change',function(){
	        $('#refresh3').removeClass('hide');
	    });
	    $('#refresh3').on('click',function(e){
	        $('.twelveDocument').val('').trigger('chosen:updated');
	        $('#refresh3').addClass('hide');
	    });

	    $( 'input[name=achievementsawards]' ).focusin(function() {
	  		$('span.label-primary').removeClass('hide');
		});
		$( 'input[name=achievementsawards]' ).focusout(function() {
	  		$('span.label-primary').addClass('hide');
		});
	});
    //-------------------------------------------------------------------------------------//
</script>

<script type="text/javascript">
	$(document).ready(function(){ 
		
		$('input[name=tenthDocument]').change(function (e)
		{  
			var ext = $('input[name=tenthDocument]').val().split('.').pop().toLowerCase();
			if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf'){
				$('#10thDoc').addClass('hide');
			}else{
				$('input[name=tenthDocument]').val('');
				$('#10thDoc').removeClass('hide');
				return false;
			}
			//Disable input file
		});

		$('input[name=twelveDocument]').change(function (e)
		{  
			var ext = $('input[name=twelveDocument]').val().split('.').pop().toLowerCase();
			if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf'){
				$('#12thDoc').addClass('hide');
			}else{
				$('input[name=twelveDocument]').val('');
				$('#12thDoc').removeClass('hide');
				return false;
			}
			//Disable input file
		});

	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
	    $('#dateChange').on('change', function(){
			var dateofbirth = $(this).val();
			var HTML = '';
			var year = '';
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            data: { dateofbirth: dateofbirth },
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            url: "{{ URL::to('/getCurrentDOBCalculate') }}",
	            success: function(data) {
            		if( data.code == '200' ){
            			$('.calculatedDateFromNow').text(data.calculateDate);	
            			year = data.year;
           	 			if( year < 18 ){
           	 				$('input[name=parentsname]').val('');
           	 				$('input[name=parentsnumber]').val('');
           	 				$('.gurdianBlock').removeClass('hide');
           	 				$('input[name=parentsname]').attr('required', 'required');
           	 				$('input[name=parentsnumber]').attr('required', 'required');
            			}else{
            				$('input[name=parentsname]').val('');
           	 				$('input[name=parentsnumber]').val('');
            				$('.gurdianBlock').addClass('hide');
            				$('input[name=parentsname]').removeAttr('required', '');
           	 				$('input[name=parentsnumber]').removeAttr('required', '');
            			}
            		}else{

            		}
	        		
	        		
	            }
	        });
		});
	});
</script>



@endsection


