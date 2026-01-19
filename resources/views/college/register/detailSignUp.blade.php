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
				{!! Form::open(['url' => 'college-profile-action', 'method' => 'POST','class' => 'sky-form detail-page-signup','role'=>'form', 'id'=>'', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
					<div class="reg-header">
						<a href="{{ URL::to('/') }}">
							<img src="{{asset('assets/images/logo.png')}}" class="img-responsive" alt="">
						</a>
						<p class="margin-top10">COLLEGE PROFILE DETAILS</p>
					</div>

					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12">
							<input type="hidden" name="collegeuserID" value="{{ $collegeUserId }}">
							<input type="hidden" name="slug" value="{{ $slug }}">
							<h4 class="margin-bottom30">Hi, <span class="color-green">{{ $collegeName }} ({{  $emailAddress }})</span></h4>
						</div>
					</div>

					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12">
							<label>Select College Type</label>
						</div>
						<div class="col-md-12">
							<select name="collegeType" class="form-control chosen-select" data-parsley-trigger="change" data-parsley-error-message="Please select your college type" required="">
	                        	<option value="" selected disabled>Select college type</option>  
	                          	@foreach ($collegeType as $college)
		                            <option value="{{ $college->id }}">{{ $college->name }}</option>
		                        @endforeach     
	                        </select>  
						</div>	
					</div>
					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12"><label>Select Address Type</label></div>
						<div class="col-md-12">
							<select name="addressTypeName" class="form-control chosen-select" data-parsley-trigger="change" data-parsley-error-message="Please select your college address type" required="">
	                            <option value="" selected disabled>Select address type</option>  
	                            <option value="1">Registered Address</option>
	                          	<option value="2">Campus Address</option>
	                        </select> 
						</div>
					</div>

					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12">
							<label>College Address</label>
							<input type="text"  class="form-control" id="careOfName" name="careOfName" placeholder="" data-parsley-trigger="change" data-parsley-error-message="Please enter valid college address" data-parsley-pattern="^[a-zA-Z0-9\\/s ().,-]*$">
						</div>
					</div>
					

					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12">
							<label>Address 1</label>
							<input type="text" class="form-control" id="address1" name="address1" placeholder="" data-parsley-pattern="^[a-zA-Z0-9\\/s ().,-]*$" data-parsley-trigger="change" data-parsley-error-message="Please enter valid address">
						</div>	
					</div>

					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12">
							<label>Address 2</label>
							<input type="text" class="form-control" id="address2" name="address2" placeholder="" data-parsley-pattern="^[a-zA-Z0-9\\/s ().,-]*$" data-parsley-trigger="change" data-parsley-error-message="Please enter valid address">
						</div>	
					</div>

					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12">
							<label>Nearest Landmark</label>
							<input type="text" class="form-control" id="landmark" name="landmark" placeholder="" data-parsley-pattern="^[a-zA-Z0-9\\/s ().,-]*$" data-parsley-trigger="change" data-parsley-error-message="Please enter valid address">
						</div>					
					</div>
					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12"><label>Select Country</label></div>
						<div class="col-md-12">
							<select name="country_id" class="form-control chosen-select country_id search-blocks-textbox" id="country_id" >
								<option selected="" disabled="" data-parsley-trigger="change" data-parsley-error-message="Please select your country" required="">Select Country</option>
								@if( $countryObj )
									<option value="99">India</option>
									@foreach( $countryObj as $item )
										@if( $item->id == '99' )
											<option value="99">{{ $item->name }}</option>
										@else
											<option value="{{ $item->id }}">{{ $item->name }}</option>
										@endif
									@endforeach
								@endif
							</select>
                        </div>
                    </div>

					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12"><label>Select State</label></div>
						<div class="col-md-12">
							<select name="stateName" class="form-control chosen-select stateName" id="stateName" data-parsley-trigger="change" data-parsley-error-message="Please select your state" required="">
	                            <option value="" selected disabled>Select state</option>  
	                          	<!-- @foreach ($states as $state)
		                            <option value="{{ $state->id }}">{{ $state->name }}</option>
		                        @endforeach          -->
	                        </select>

                        </div>
                    </div>

					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12"><label>Select City</label></div>
						<div class="col-md-12">
							<select name="cityName" class="form-control chosen-select cityName" data-parsley-trigger="change" data-parsley-error-message="Please select your city" required="">
	                            <option value="" selected disabled>Select city</option>  
	                          	<!-- @foreach ($cityID as $city)
		                            <option value="{{ $city->id }}">{{ $city->name }}</option>
		                        @endforeach      -->    
	                        </select>
                        <!-- <label class="padding-top5 padding-bottom5 hide stateDetail text-danger">Your State Is : <span id="stateName" class="text-success"></span></label>
                        <br>
                        <label class="padding-top5 padding-bottom5 hide countryDetail text-danger">Your Country Is : <span id="countryName" class="text-success"></span></label> -->
                        </div>
					</div>	

					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12">
							<label>Postal Code</label>
							<input type="text" class="form-control" name="postalCode" placeholder="" data-parsley-type="alphanum" data-parsley-trigger="change" data-parsley-length="[5, 7]" data-parsley-trigger="change" data-parsley-error-message="Please enter valid postal code of 5 to 7 characters"  maxlength="7">
						</div>					
					</div>

					<div class="row margin-top10 margin-bottom10">
						<div class="col-md-12">
							<label class="checkbox"><input type="checkbox" id="agreeForSameCampus" name="checkboxInline"><i></i>Please check this if your registered &amp; campus addresses are same</label>	
						</div>
					</div>

					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12">
							<label>Contact Person / Administrator Officer Name</label>
							<input type="text" class="form-control" name="administratorName" id="administratorName" placeholder="" data-parsley-trigger="change" data-parsley-error-message="Please enter valid contact/administrator name" data-parsley-pattern="^[a-zA-Z\s .]*$">
						</div>
					</div>

					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12">
							<label>Contact Person / Administrator Officer Email</label>
							<input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" class="form-control" name="emailAddress" id="emailAddress" data-parsley-type="email" placeholder="" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address">
						</div>
					</div>

					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12">
							<label>
								Contact Person / Administrator Officer Phone
								<br><span class="text-info">(Please exclude country code before mobile number [For India : +91])</span>
							</label>
							<input type="text" class="form-control" id="phoneNo" name="phoneNo" placeholder="" data-parsley-type="digits" data-parsley-trigger="change"  data-parsley-error-message="Please enter valid mobile number">
							<!-- data-parsley-pattern="^[7-9][0-9]{9}$" data-parsley-length="[10, 10]"  maxlength="10" data-parsley-trigger="change" -->
						</div>
					</div>

					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12">
							<label>Upload Your College Logo </label>
							<label for="file" class="input input-file">
								<span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a> </span>
								<div class="">
									<input type="file" name="collegeLogo" class="collegeLogo" onchange="this.parentNode.nextSibling.value = this.value" data-parsley-filemaxmegabytes="2" data-parsley-trigger="change">
								</div>
								<p class="text-danger hide" id="logoDoc">(please upload .png, .jpg and .jpeg file only)</p>
							</label>
							
						</div>
					</div>

					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12">
							<label>Upload Your AICTE Certificate</label>
							<label for="file" class="input input-file">
								<span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh2"class="hide"><i class="fa fa-remove"></i></a> </span>
								<div class=""><input type="file" name="aicteDocument" class="aicteDocument" onchange="this.parentNode.nextSibling.value = this.value" data-parsley-trigger="change"></div>
								<!-- data-parsley-pattern="([a-zA-Z0-9\s_\\.\-:])+(.jpeg|.jpg|.png|.pdf)$" -->
								<!-- data-parsley-filemimetypes="image/jpeg, image/jpg, image/png, application/pdf" -->
							</label>
							<p class="text-danger hide" id="aicteDoc">(please upload .jpg, .jpeg, .png and .pdf file only)</p>
						</div>
					</div>

					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12">
							<label>Upload Your UGC Certificate</label>
							<label for="file" class="input input-file">
								<span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh3"class="hide"><i class="fa fa-remove"></i></a> </span>
								<div class=""><input type="file" name="ugcDocument" class="ugcDocument" onchange="this.parentNode.nextSibling.value = this.value" placeholder=""  data-parsley-filemaxmegabytes="2" data-parsley-trigger="change" ></div>
							</label>
							<p class="text-danger hide" id="ugcDoc">(please upload .jpg, .jpeg, .png and .pdf file only)</p>
						</div>
					</div>

					<hr>

					<div class="row padding-top5 padding-bottom5">
						<div class="col-md-12 col-lg-12 text-right">
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
{!! Html::script('assets/js/forms/signup-detail.js') !!}
{!! Html::script('assets/js/parsley.min.js') !!}

<script type="text/javascript">
	jQuery(document).ready(function() {
		SignUpDetailForm.initSignUpForm();
	});
</script>

<script type="text/javascript">
	$('body').addClass('padding-bottom0');
	$(".image-block").backstretch([
		"assets/images/bg/1.jpg",
		"assets/images/bg/18.jpg",
	], {
		fade: 1000,
		duration: 7000
	});
</script>


<script type="text/javascript">
    $(document).ready(function(){   

	    $('.collegeLogo').on('change',function(){
	        $('#refresh1').removeClass('hide');
	    });
	    $('#refresh1').on('click',function(e){
	        $('.collegeLogo').val('').trigger('chosen:updated');
	        $('#refresh1').addClass('hide');
	    });

	    $('.aicteDocument').on('change',function(){
	        $('#refresh2').removeClass('hide');
	    });
	    $('#refresh2').on('click',function(e){
	        $('.aicteDocument').val('').trigger('chosen:updated');
	        $('#refresh2').addClass('hide');
	    });

	    $('.ugcDocument').on('change',function(){
	        $('#refresh3').removeClass('hide');
	    });
	    $('#refresh3').on('click',function(e){
	        $('.ugcDocument').val('').trigger('chosen:updated');
	        $('#refresh3').addClass('hide');
	    });
	    
	    
	    //-------------------------------------------------------------------------------------//
		/*$('.stateName').on('change', function(){
			var stateId = $(this).val();
			var HTML = '';
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            data: { stateId: stateId },
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            url: "{{ URL::to('/getCityTotal') }}",
	            success: function(data) {
	        		$.each(data.cityData, function(key, value) {
						HTML += '<option value='+data.cityData[key].id+'>'+data.cityData[key].name+'</option>';
					});
					$('.cityName').html(HTML);
	        		$('.cityName').trigger("chosen:updated");
	            }
	        });
		});*/
	});
    //-------------------------------------------------------------------------------------//
</script>
	<script type="text/javascript">
		$('select[name=country_id]').on('change', function(){
			var countryID = $(this).val();
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {countryID: countryID},
	            url: "{{ URL::to('getAllStateName') }}",
	            success: function(data) {
	            	var HTML = '';
	            	HTML += '<option selected="" disabled="">Select State</option>';
	            	if( data.code == '200' ){
	            		$.each(data.stateObj, function(i, item) {
	            			HTML += '<option value="'+data.stateObj[i].stateId+'">'+data.stateObj[i].name+'</option>';
		            	});	
	            	}else{
	            		HTML += '<option selected="" disabled="">No state available</option>';
	            	}

	            	$('select[name="stateName"]').empty();
	            	$('select[name="stateName"]').html(HTML);
	            	$('select[name="stateName"]').trigger('chosen:updated');
	            }
	        });
		});

		$('select[name=stateName]').on('change', function(){
			var currentID = $(this).val();
			$.ajax({
	            headers: {
	              'X-CSRF-Token': $('input[name="_token"]').val()
	            },
	            method: "GET",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            data: {currentID: currentID},
	            url: "{{ URL::to('getAllCityName') }}",
	            success: function(data) {
	            	var HTML = '';
	            	HTML += '<option selected="" disabled="">Select City</option>';
	            	if( data.code == '200' ){
	            		$.each(data.cityObj, function(i, item) {
	            			HTML += '<option value="'+data.cityObj[i].cityId+'">'+data.cityObj[i].name+'</option>';
		            	});	
	            	}else{
	            		HTML += '<option selected="" disabled="">No city available</option>';
	            	}

	            	$('select[name="cityName"]').empty();
	            	$('select[name="cityName"]').html(HTML);
	            	$('select[name="cityName"]').trigger('chosen:updated');
	            }
	        });
		});
	</script>

<script type="text/javascript">
	$(document).ready(function(){ 
		$('input[name=collegeLogo]').change(function (e)
		{  
			var ext = $('input[name=collegeLogo]').val().split('.').pop().toLowerCase();
			if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' ){
				$('#logoDoc').addClass('hide');
			}else{
				$('input[name=collegeLogo]').val('');
				$('#logoDoc').removeClass('hide');
				return false;
			}
			//Disable input file
		});

		$('input[name=aicteDocument]').change(function (e)
		{  
			var ext = $('input[name=aicteDocument]').val().split('.').pop().toLowerCase();
			if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf'){
				$('#aicteDoc').addClass('hide');
			}else{
				$('input[name=aicteDocument]').val('');
				$('#aicteDoc').removeClass('hide');
				return false;
			}
			//Disable input file
		});

		$('input[name=ugcDocument]').change(function (e)
		{  
			var ext = $('input[name=ugcDocument]').val().split('.').pop().toLowerCase();
			if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf'){
				$('#ugcDoc').addClass('hide');
			}else{
				$('input[name=ugcDocument]').val('');
				$('#ugcDoc').removeClass('hide');
				return false;
			}
			//Disable input file
		});


		
	});
</script>
@endsection