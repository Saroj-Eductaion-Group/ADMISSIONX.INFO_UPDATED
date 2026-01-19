<div class="profile-edit tab-pane fade in active">
	<!-- <h2 class="heading-md text-center">Manage your address details</h2> -->
	
	<div class="tag-box tag-box-v3">
		<div class="row margin-bottom-30">
			<div class="col-md-12">
				<div class="headline"><h2>Add Registered College Address </h2></div>
				<div class="col-md-6 col-md-offset-3">
					 <!-- <a href="javascript:void(0);" class="btn btn-u btn-block  registeredFilterout">Add Now</a> -->
					<button class="btn btn-u btn-block registeredFilterout" id="registeredFilterout">Update Now</button>
				</div>
				
				<!-- START ADDRESS FORM FOR REGISTER -->
					<div class="registeredSlideDown" id="registeredSlideDown">
						<!-- style="visibility:hidden" -->
						{!! Form::model($collegeRegisteredAddressDataObj , ['url' => 'college-registered-address-partial', 'method' => 'POST','class' => 'sky-form detail-page-signup regAddressUpdate','role'=>'form', 'id'=>'registeredAddress', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
							<!-- START -->
							<div class="row padding-top5 padding-bottom5">
								<div class="col-md-12">
									<label class="checkbox"><input type="checkbox" id="agreeForSameCampus" name="checkbox-inline"><i></i>Please check this if your registered &amp; campus addresses are same</label>	
								</div>
							</div>
							<!-- FORM DESIGN -->
							<input type="hidden" name="addresstype_id" value="1">
							@foreach(  $collegeRegisteredAddressDataObj as  $collegeRegisteredAddressData )
								<input type="hidden" name="slug" value="{{ $collegeRegisteredAddressData->slug }}">
							@endforeach
							<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
							<div class="row padding-top5 padding-bottom5">
								<div class="col-md-12">
									<label>College Address</label>
								</div>
								<div class="col-md-12">
									@if( $collegeRegisteredAddressDataObj )
										@foreach(  $collegeRegisteredAddressDataObj as  $collegeRegisteredAddressData )
											<input type="text" class="form-control" name="name" value="{{ $collegeRegisteredAddressData->name }}" placeholder="Enter college address"  data-parsley-trigger="change" data-parsley-error-message="Please enter valid address">
											<!-- data-parsley-pattern="^[a-zA-Z0-9\\/s ().,-]*$" -->
										@endforeach
									@else
										<input type="text" class="form-control" name="name" placeholder="Enter address" data-parsley-trigger="change" data-parsley-error-message="Please enter valid address">
										<!-- data-parsley-pattern="^[a-zA-Z0-9\\/s ().,-]*$" -->
									@endif
								</div>
							</div>
							<div class="row padding-top5 padding-bottom5">
								<div class="col-md-12">
									<label>Address 1</label>
								</div>
								<div class="col-md-12">
									@if( $collegeRegisteredAddressDataObj )
										@foreach(  $collegeRegisteredAddressDataObj as  $collegeRegisteredAddressData )
											<input type="text" class="form-control" name="address1" value="{{ $collegeRegisteredAddressData->address1 }}" placeholder="Enter address 1" data-parsley-trigger="change" data-parsley-error-message="Please enter valid address">
										@endforeach
									@else
										<input type="text" class="form-control" name="address1" placeholder="Enter address 1"  data-parsley-trigger="change" data-parsley-error-message="Please enter valid address">
									@endif
								</div>
							</div>
							<div class="row padding-top5 padding-bottom5">
								<div class="col-md-12">
									<label>Address 2</label>
								</div>
								<div class="col-md-12">
									@if( $collegeRegisteredAddressDataObj )
										@foreach(  $collegeRegisteredAddressDataObj as  $collegeRegisteredAddressData )
											<input type="text" class="form-control" name="address2" value="{{ $collegeRegisteredAddressData->address2 }}" placeholder="Enter address 2"  data-parsley-trigger="change" data-parsley-error-message="Please enter valid address">
										@endforeach
									@else
										<input type="text" class="form-control" name="address2" placeholder="Enter address 2"  data-parsley-trigger="change" data-parsley-error-message="Please enter valid address">
									@endif
								</div>
							</div>
							<div class="row padding-top5 padding-bottom5">
								<div class="col-md-12">
									<label>Landmark</label>
								</div>
								<div class="col-md-12">
									@if( $collegeRegisteredAddressDataObj )
										@foreach(  $collegeRegisteredAddressDataObj as  $collegeRegisteredAddressData )
											<input type="text" class="form-control" name="landmark" value="{{ $collegeRegisteredAddressData->landmark }}" placeholder="Enter landmark"  data-parsley-trigger="change" data-parsley-error-message="Please enter valid address">
										@endforeach
									@else
										<input type="text" class="form-control" name="landmark" placeholder="Enter landmark"  data-parsley-trigger="change" data-parsley-error-message="Please enter valid address">
									@endif
								</div>
							</div>
		                    <div class="row padding-top5 padding-bottom5">
								<div class="col-md-12">
									<label>Select Country</label>
								</div>
								<div class="col-md-12">
									@if( $collegeRegisteredAddressDataObj )
										@foreach(  $collegeRegisteredAddressDataObj as  $collegeRegisteredAddressData )
											<select name="countryName" class="form-control chosen-select countryName" id="countryName" data-parsley-trigger="change" data-parsley-error-message="Please select your country" required="">
								                <option value="" selected disabled>Select country</option> 
								                @if( $collegeRegisteredAddressData->countryId )
								                    <option value="{{ $collegeRegisteredAddressData->countryId }}" selected="">{{ $collegeRegisteredAddressData->countryName }}</option>
								                @endif 
								              	@foreach ($country as $count)
								                    <option value="{{ $count->id }}">{{ $count->name }}</option>
								                @endforeach         
								            </select>
										@endforeach
									@else
										<select name="countryName" class="form-control chosen-select " data-parsley-error-message=" Please select country" data-parsley-trigger="change" required="">
					                        <option value="" selected disabled>Select Country</option>  
					                        @foreach ($country as $count)
						                    <option value="{{ $count->id }}">{{ $count->name }}</option>
						                	@endforeach     
					                    </select>
									@endif
									<input type="text" class="getCountryName form-control hide" disabled="" readonly="">
								</div>
							</div>
							<div class="row padding-top5 padding-bottom5">
								<div class="col-md-12">
									<label>Select State</label>
								</div>
								<div class="col-md-12">
									@if( $collegeRegisteredAddressDataObj )
										@foreach(  $collegeRegisteredAddressDataObj as  $collegeRegisteredAddressData )
											<select name="stateName" class="form-control chosen-select stateName" id="stateName" data-parsley-trigger="change" data-parsley-error-message="Please select your state" required="">
								                <option value="" selected disabled>Select state</option> 
								                @if( $collegeRegisteredAddressData->stateId )
								                    <option value="{{ $collegeRegisteredAddressData->stateId }}" selected="">{{ $collegeRegisteredAddressData->stateName }}</option>
								                @endif 
								              	@foreach ($states as $state)
								                    <option value="{{ $state->id }}">{{ $state->name }}</option>
								                @endforeach         
								            </select>
										@endforeach
									@else
										<select name="stateName" class="form-control chosen-select " data-parsley-error-message=" Please select state" data-parsley-trigger="change" required="">
					                        <option value="" selected disabled>Select state</option>  
					                        @foreach ($states as $state)
						                    <option value="{{ $state->id }}">{{ $state->name }}</option>
						                	@endforeach     
					                    </select>
									@endif
									<input type="text" class="getStateName form-control hide" disabled="" readonly="">
								</div>
							</div>
							<div class="row padding-top5 padding-bottom5">
								<div class="col-md-12">
									<label>Select City</label>
								</div>
								<div class="col-md-12">
									@if( $collegeRegisteredAddressDataObj )
										@foreach(  $collegeRegisteredAddressDataObj as  $collegeRegisteredAddressData )
											<select name="city_id" class="form-control chosen-select cityName" data-parsley-trigger="change" data-parsley-error-message="Please select your city" required="">
								                <option value="" selected disabled>Select city</option> 
								                @if( $collegeRegisteredAddressData->cityId )
								                    <option value="{{ $collegeRegisteredAddressData->cityId }}" selected="">{{ $collegeRegisteredAddressData->cityName }}</option>
								                @endif 
								              	@foreach ($city as $city)
								                    <option value="{{ $city->id }}">{{ $city->name }}</option>
								                @endforeach         
								            </select>
										@endforeach
									@else
										<select name="city_id" class="form-control chosen-select " data-parsley-error-message=" Please select city" data-parsley-trigger="change" required="">
					                        <option value="" selected disabled>Select city</option>  
					                        @foreach ($city as $city)
							                    <option value="{{ $city->id }}">{{ $city->name }}</option>
							                @endforeach    
					                    </select>
									@endif
									<input type="text" class="getCityName form-control hide" disabled="" readonly="">
								</div>
							</div>
							<div class="row padding-top5 padding-bottom5">
								<div class="col-md-12">
									<label>Postal Code</label>
								</div>
								<div class="col-md-12">
									@if( $collegeRegisteredAddressDataObj )
										@foreach(  $collegeRegisteredAddressDataObj as  $collegeRegisteredAddressData )
											<input type="text" class="form-control" name="postalCode" value="{{ $collegeRegisteredAddressData->postalCode }}" placeholder="Enter postalCode" data-parsley-type="alphanum" data-parsley-trigger="change" data-parsley-length="[5, 7]" data-parsley-trigger="change" data-parsley-error-message="Please enter valid postal code of 5 to 7 characters" maxlength="7">
										@endforeach
									@else
										<input type="text" class="form-control" name="postalCode" placeholder="Enter postalCode" data-parsley-type="alphanum" data-parsley-trigger="change" data-parsley-length="[5, 7]" data-parsley-trigger="change" data-parsley-error-message="Please enter valid postal code of 5 to 7 characters" maxlength="7">
									@endif
								</div>
							</div>
							<div class="row padding-top5 padding-bottom5">
								<div class="col-md-12 col-lg-12 text-right">
									<button class="btn-u" type="submit">Submit</button>
								</div>
							</div>

							<!-- END FOR DESIGN -->
						{!! Form::close() !!}
					</div>
				</div>
				<!-- END -->
			</div>			
		</div>
	</div>

	<div class="tag-box tag-box-v3">
		<div class="row margin-bottom-30">
			<div class="col-md-12">
				
				<div class="headline"><h2>Add Campus College Address</h2></div>
				<div class="col-md-6 col-md-offset-3">
					<button class="btn btn-u btn-block campusFilterout" id="campusFilterout">Update Now</button>
				</div>
				<div class="campusSlideDown" id="campusSlideDown">	
					<!-- style="visibility:hidden" -->
					{!! Form::model($collegeCampusAddressDataObj , ['url' => 'college-campus-address-partial', 'method' => 'POST','class' => 'sky-form detail-page-signup campusAddressUpdate','role'=>'form', 'id'=>'campusAddress', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
							
							<!-- START -->
							<div class="row padding-top5 padding-bottom5">
								<div class="col-md-12">
									<label class="checkbox"><input type="checkbox" id="agreeForSame" name="checkbox-inline"><i></i>Please check this if your registered &amp; campus addresses are same</label>	
								</div>
							</div>
							<!-- END -->
							<!-- FORM DESIGN -->
							<input type="hidden" name="addresstype_id" value="2">
							@foreach(  $collegeCampusAddressDataObj as  $collegeCampusAddressData )
								<input type="hidden" name="slug" value="{{ $collegeCampusAddressData->slug }}">
							@endforeach
							<input type="hidden" name="slugUrl1" value="{{ $slugUrl1 }}">
							<div class="row padding-top5 padding-bottom5">
								<div class="col-md-12">
									<label>College Address</label>
								</div>
								<div class="col-md-12">
									@if( $collegeCampusAddressDataObj )
										@foreach(  $collegeCampusAddressDataObj as  $collegeCampusAddressData )
											<input type="text" class="form-control" name="name" value="{{ $collegeCampusAddressData->name }}" placeholder="Enter college address" data-parsley-trigger="change" data-parsley-error-message="Please enter valid address">
										@endforeach
									@else
										<input type="text" class="form-control" name="name" placeholder="Enter college address" data-parsley-trigger="change" data-parsley-error-message="Please enter valid address">
									@endif
								</div>
							</div>
							<div class="row padding-top5 padding-bottom5">
								<div class="col-md-12">
									<label>Address 1</label>
								</div>
								<div class="col-md-12">
									@if( $collegeCampusAddressDataObj )
										@foreach(  $collegeCampusAddressDataObj as  $collegeCampusAddressData )
											<input type="text" class="form-control" name="address1" value="{{ $collegeCampusAddressData->address1 }}" placeholder="Enter address 1" data-parsley-trigger="change" data-parsley-error-message="Please enter valid address">
										@endforeach
									@else
										<input type="text" class="form-control" name="address1" placeholder="Enter address 1" data-parsley-trigger="change" data-parsley-error-message="Please enter valid address">
									@endif
								</div>
							</div>
							<div class="row padding-top5 padding-bottom5">
								<div class="col-md-12">
									<label>Address 2</label>
								</div>
								<div class="col-md-12">
									@if( $collegeCampusAddressDataObj )
										@foreach(  $collegeCampusAddressDataObj as  $collegeCampusAddressData )
											<input type="text" class="form-control" name="address2" value="{{ $collegeCampusAddressData->address2 }}" placeholder="Enter address 2" data-parsley-trigger="change" data-parsley-error-message="Please enter valid address">
										@endforeach
									@else
										<input type="text" class="form-control" name="address2" placeholder="Enter address 2" data-parsley-trigger="change" data-parsley-error-message="Please enter valid address">
									@endif
								</div>
							</div>
							<div class="row padding-top5 padding-bottom5">
								<div class="col-md-12">
									<label>Landmark</label>
								</div>
								<div class="col-md-12">
									@if( $collegeCampusAddressDataObj )
										@foreach(  $collegeCampusAddressDataObj as  $collegeCampusAddressData )
											<input type="text" class="form-control" name="landmark" value="{{ $collegeCampusAddressData->landmark }}" placeholder="Enter landmark"  data-parsley-trigger="change" data-parsley-error-message="Please enter valid address">
										@endforeach
									@else
										<input type="text" class="form-control" name="landmark" placeholder="Enter landmark"  data-parsley-trigger="change" data-parsley-error-message="Please enter valid address">
									@endif
								</div>
							</div>
							<div class="row padding-top5 padding-bottom5">
								<div class="col-md-12">
									<label>Select Country</label>
								</div>
								<div class="col-md-12">
									@if( $collegeCampusAddressDataObj )
										@foreach(  $collegeCampusAddressDataObj as  $collegeCampusAddressData )
											<select name="countryName" class="form-control chosen-select countryName" id="countryName" data-parsley-trigger="change" data-parsley-error-message="Please select your country" required="">
								                <option value="" selected disabled>Select country</option> 
								                @if( $collegeCampusAddressData->countryId )
								                    <option value="{{ $collegeCampusAddressData->countryId }}" selected="">{{ $collegeCampusAddressData->countryName }}</option>
								                @endif 
								              	@foreach ($country1 as $count)
								                    <option value="{{ $count->id }}">{{ $count->name }}</option>
								                @endforeach         
								            </select>
										@endforeach
									@else
										<select name="countryName" class="form-control chosen-select " data-parsley-error-message=" Please select country" data-parsley-trigger="change" required="">
					                        <option value="" selected disabled>Select Country</option>  
					                        @foreach ($country1 as $count)
						                    <option value="{{ $count->id }}">{{ $count->name }}</option>
						                	@endforeach     
					                    </select>
									@endif
									<input type="text" class="getStateName form-control hide" disabled="" readonly="">
								</div>
							</div>
							<div class="row padding-top5 padding-bottom5">
								<div class="col-md-12">
									<label>Select State</label>
								</div>
								<div class="col-md-12">
									@if( $collegeCampusAddressDataObj )
										@foreach(  $collegeCampusAddressDataObj as  $collegeCampusAddressData )
											<select name="stateName" class="form-control chosen-select stateName" id="stateName" data-parsley-trigger="change" data-parsley-error-message="Please select your state" required="">
								                <option value="" selected disabled>Select state</option> 
								                @if( $collegeCampusAddressData->stateId )
								                    <option value="{{ $collegeCampusAddressData->stateId }}" selected="">{{ $collegeCampusAddressData->stateName }}</option>
								                @endif 
								              	@foreach ($states1 as $state)
								                    <option value="{{ $state->id }}">{{ $state->name }}</option>
								                @endforeach         
								            </select>
										@endforeach
									@else
										<select name="stateName" class="form-control chosen-select " data-parsley-error-message=" Please select state" data-parsley-trigger="change" required="">
					                        <option value="" selected disabled>Select state</option>  
					                        @foreach ($states1 as $state)
						                    <option value="{{ $state->id }}">{{ $state->name }}</option>
						                	@endforeach     
					                    </select>
									@endif
									<input type="text" class="getStateName form-control hide" disabled="" readonly="">
								</div>
							</div>
							<div class="row padding-top5 padding-bottom5">
								<div class="col-md-12">
									<label>Select City</label>
								</div>
								<div class="col-md-12">
									@if( $collegeCampusAddressDataObj )
										@foreach(  $collegeCampusAddressDataObj as  $collegeCampusAddressData )
											<select name="city_id" class="form-control chosen-select cityName" data-parsley-trigger="change" data-parsley-error-message="Please select your city" required="">
								                <option value="" selected disabled>Select city</option> 
								                @if( $collegeCampusAddressData->cityId )
								                    <option value="{{ $collegeCampusAddressData->cityId }}" selected="">{{ $collegeCampusAddressData->cityName }}</option>
								                @endif 
								              	@foreach ($city1 as $city)
								                    <option value="{{ $city->id }}">{{ $city->name }}</option>
								                @endforeach         
								            </select>
										@endforeach
									@else
										<select name="city_id" class="form-control chosen-select " data-parsley-error-message=" Please select city" data-parsley-trigger="change" required="">
					                        <option value="" selected disabled>Select city</option>  
					                        @foreach ($city1 as $city)
							                    <option value="{{ $city->id }}">{{ $city->name }}</option>
							                @endforeach    
					                    </select>
									@endif
									<input type="text" class="getCityName form-control hide" disabled="" readonly="">
								</div>
							</div>
							<div class="row padding-top5 padding-bottom5">
								<div class="col-md-12">
									<label>Postal Code</label>
								</div>
								<div class="col-md-12">
									@if( $collegeCampusAddressDataObj )
										@foreach(  $collegeCampusAddressDataObj as  $collegeCampusAddressData )
											<input type="text" class="form-control" name="postalCode" value="{{ $collegeCampusAddressData->postalCode }}" placeholder="Enter postalCode" data-parsley-type="alphanum" data-parsley-trigger="change" data-parsley-length="[5, 7]" data-parsley-trigger="change" data-parsley-error-message="Please enter valid postal code of 5 to 7 characters" maxlength="7">
										@endforeach
									@else
										<input type="text" class="form-control" name="postalCode" placeholder="Enter postalCode" data-parsley-type="alphanum" data-parsley-trigger="change" data-parsley-length="[5, 7]" data-parsley-trigger="change" data-parsley-error-message="Please enter valid postal code of 5 to 7 characters" maxlength="7">
									@endif
								</div>
							</div>
							<div class="row padding-top5 padding-bottom5">
								<div class="col-md-12 col-lg-12 text-right">
									<button class="btn-u" type="submit">Submit</button>
								</div>
							</div>

							<!-- END FOR DESIGN -->
						{!! Form::close() !!}
				</div>

				<!-- START ADDRESS FORM FOR CAMPUS -->
				<!-- END -->
			</div>
		</div>
	</div>
	
	<!-- <button type="button" class="btn-u btn-u-default">Cancel</button>
	<button type="button" class="btn-u">Save Changes</button> -->
</div>
{!! Html::script('assets/js/parsley.min.js') !!}
<script type="text/javascript">
  $('form').parsley();
</script>

{!! Html::script('assets/js/chosen/chosen.jquery.js') !!}
<script type="text/javascript">
    $(document).ready(function(){
        var config = {
            '.chosen-select'           : {},
            '.chosen-select-deselect'  : {allow_single_deselect:true},
            '.chosen-select-no-single' : {disable_search_threshold:10},
            '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
            '.chosen-select-width'     : {width:"100%"}
            }
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }

        //-------------------------------------------------------------------------------------//
        /*$(document).on('change', '.stateName', function(){
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
        //-------------------------------------------------------------------------------------//
    });
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('.registeredSlideDown').hide();
    	var clickCountRegi = '1';
        $(document).on('click', '.registeredFilterout', function(){
			if( clickCountRegi % 2 === 0 ){
				$(".registeredSlideDown").show();	
			}else{
				$(".registeredSlideDown").hide();
			}
			clickCountRegi++;
        	$(".registeredSlideDown").toggle();
            $(".registeredSlideDown").css("visibility","visible");
        }); 
    });  
</script>

<script type="text/javascript">
$(document).ready(function(){
    $('.campusSlideDown').hide();
    var clickCountCampus = '1';
        $(document).on('click', '.campusFilterout', function(){
        	if( clickCountCampus % 2 === 0 ){
				$(".campusSlideDown").show();	
			}else{
				$(".campusSlideDown").hide();
			}
			clickCountCampus++;
        	$(".campusSlideDown").toggle();
            $(".campusSlideDown").css("visibility","visible");
        }); 
    });  
</script>

<script type="text/javascript">
	$(document).on('click', '#agreeForSame', function(){
		if($('#agreeForSame').attr('checked')) {
			var name = $('#registeredAddress  input[name="name"]').val();
			var address1 = $('#registeredAddress  input[name="address1"]').val();
			var address2 = $('#registeredAddress  input[name="address2"]').val();
			var landmark = $('#registeredAddress  input[name="landmark"]').val();
			var postalCode = $('#registeredAddress  input[name="postalCode"]').val();
			var countryName = $('#registeredAddress #countryName').val();
			var stateName = $('#registeredAddress #stateName').val();
			var cityName = $('#registeredAddress .cityName').val();
			//SET
			$('#campusAddress input').attr('readonly', 'readonly');
			$('#campusAddress  #countryName').next('.chosen-container').addClass('hide');
			$('#campusAddress  #stateName').next('.chosen-container').addClass('hide');
			$('#campusAddress  .cityName').next('.chosen-container').addClass('hide');
			
			$('#campusAddress  .getCountryName').removeClass('hide');
			$('#campusAddress  .getStateName').removeClass('hide');
			$('#campusAddress  .getCityName').removeClass('hide');
			$('#campusAddress  .getCountryName').val($('#registeredAddress #countryName :selected').text());
			$('#campusAddress  .getStateName').val($('#registeredAddress #stateName :selected').text());
			$('#campusAddress  .getCityName').val($('#registeredAddress .cityName :selected').text());

			$('#campusAddress  input[name="name"]').val(name);
			$('#campusAddress  input[name="address1"]').val(address1);
			$('#campusAddress  input[name="address2"]').val(address2);
			$('#campusAddress  input[name="landmark"]').val(landmark);
			$('#campusAddress  input[name="postalCode"]').val(postalCode);
			$('#campusAddress  #countryName').val(countryName);
			$('#campusAddress  #stateName').val(stateName);
			$('#campusAddress  .cityName').val(cityName);
			$('#campusAddress  #countryName').trigger("chosen:updated");
			$('#campusAddress  #stateName').trigger("chosen:updated");
			$('#campusAddress  .cityName').trigger("chosen:updated");
		}else{
			$('#campusAddress input').removeAttr('readonly', '');
			$('#campusAddress  #stateName').next('.chosen-container').removeClass('hide');
			$('#campusAddress  .cityName').next('.chosen-container').removeClass('hide');	
			$('#campusAddress  .getStateName').addClass('hide');
			$('#campusAddress  .getCityName').addClass('hide');
		}
	});
</script>

<script type="text/javascript">
	//AJAX
	$( '.regAddressUpdate' ).submit(function(e) {
		$('.updateProfileBlock').addClass('hide');
  		e.preventDefault();
  		var form = $(this).serialize();
  		$.ajax({
	        type: "POST",
	        url: '{{ URL::to("college-registered-address-partial") }}',
	        data: form,
	        success: function(data){
	            if( data.code =='200' ){
	            	//window.location.reload();
	            	$('.updateProfileBlock').removeClass('hide');
	            	$('.updateProfileBlock .profileUpdateMessage').html(data.message);
	            	$('#profileUpdate').modal({show: 'true'}); 
	            }
	        }
	    });	
	});

	$( '.campusAddressUpdate' ).submit(function(e) {
		$('.updateProfileBlock').addClass('hide');
  		e.preventDefault();
  		var form = $(this).serialize();
  		$.ajax({
	        type: "POST",
	        url: '{{ URL::to("college-campus-address-partial") }}',
	        data: form,
	        success: function(data){
	            if( data.code =='200' ){
	            	//window.location.reload();
	            	$('.updateProfileBlock').removeClass('hide');
	            	$('.updateProfileBlock .profileUpdateMessage').html(data.message);
	            	$('#profileUpdate').modal({show: 'true'}); 
	            }
	        }
	    });	
	});
</script>

<script type="text/javascript">
	$(document).on('click', '#agreeForSameCampus', function(){
		if($('#agreeForSameCampus').attr('checked')) {
			var name = $('#campusAddress  input[name="name"]').val();
			var address1 = $('#campusAddress  input[name="address1"]').val();
			var address2 = $('#campusAddress  input[name="address2"]').val();
			var landmark = $('#campusAddress  input[name="landmark"]').val();
			var postalCode = $('#campusAddress  input[name="postalCode"]').val();
			var stateName = $('#campusAddress #stateName').val();
			var cityName = $('#campusAddress .cityName').val();
			//SET
			$('#registeredAddress input').attr('readonly', 'readonly');
			$('#registeredAddress  #stateName').next('.chosen-container').addClass('hide');
			$('#registeredAddress  .cityName').next('.chosen-container').addClass('hide');
			
			$('#registeredAddress  .getStateName').removeClass('hide');
			$('#registeredAddress  .getCityName').removeClass('hide');
			$('#registeredAddress  .getStateName').val($('#registeredAddress #stateName :selected').text());
			$('#registeredAddress  .getCityName').val($('#registeredAddress .cityName :selected').text());

			$('#registeredAddress  input[name="name"]').val(name);
			$('#registeredAddress  input[name="address1"]').val(address1);
			$('#registeredAddress  input[name="address2"]').val(address2);
			$('#registeredAddress  input[name="landmark"]').val(landmark);
			$('#registeredAddress  input[name="postalCode"]').val(postalCode);
			$('#registeredAddress  #stateName').val(stateName);
			$('#registeredAddress  .cityName').val(cityName);
			$('#registeredAddress  #stateName').trigger("chosen:updated");
			$('#registeredAddress  .cityName').trigger("chosen:updated");
		}else{
			$('#registeredAddress input').removeAttr('readonly', '');
			$('#registeredAddress  #stateName').next('.chosen-container').removeClass('hide');
			$('#registeredAddress  .cityName').next('.chosen-container').removeClass('hide');	
			$('#registeredAddress  .getStateName').addClass('hide');
			$('#registeredAddress  .getCityName').addClass('hide');
		}
	});
</script>

<script type="text/javascript">
		$('select[name=countryName]').on('change', function(){
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

	            	$('select[name="city_id"]').empty();
	            	$('select[name="city_id"]').html(HTML);
	            	$('select[name="city_id"]').trigger('chosen:updated');
	            }
	        });
		});
	</script>