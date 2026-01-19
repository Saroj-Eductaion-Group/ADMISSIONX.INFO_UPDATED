<div class="profile-edit tab-pane fade in active margin-top30 white-popup">
	<div class="detail-page-signup">
		<!-- START ADDRESS FORM FOR REGISTER -->
		<div>
			<form method="POST" action="/college-management-update" data-parsley-validate  enctype="multipart/form-data">
				<input type="hidden" name="collegeManagementDetailsId" value="{{ $getCollegeManagementData->collegeManagementDetailsId }}">
				<input type="hidden" name="slugUrl" value="{{ $getCollegeManagementData->slug }}">
				<div class="row">
					<div class="col-md-12">
						<h4 class="headline">Management Information</h4>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<label>Select Title</label>
						<select class="form-control" name="suffix" required="" data-parsley-error-message="Please select an option">
							<option value="" selected="">-- Select an option --</option>
							<option value="Dr." @if($getCollegeManagementData->suffix == 'Dr.') selected="" @endif>Dr.</option>
							<option value="Prof." @if($getCollegeManagementData->suffix == 'Prof.') selected="" @endif>Prof.</option>
							<option value="Mr." @if($getCollegeManagementData->suffix == 'Mr.') selected="" @endif>Mr.</option>
							<option value="Miss" @if($getCollegeManagementData->suffix == 'Miss.') selected="" @endif>Miss</option>
							<option value="Mrs." @if($getCollegeManagementData->suffix == 'Mrs.') selected="" @endif>Mrs.</option>
						</select>
					</div>
					<div class="col-md-9">
						<label>Contact Person Name</label>
						<input type="text" class="form-control" name="name" placeholder="Enter contact person name here" data-parsley-error-message = "Please enter valid contact person name" data-parsley-pattern="^[a-zA-Z\s .]*$" data-parsley-trigger="change" value="{{ $getCollegeManagementData->name }}">
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-4">
						<label>Designation</label>
						<input type="text" class="form-control" name="designation" placeholder="Enter designation here" data-parsley-error-message = "Please enter valid designation" data-parsley-pattern="^[a-zA-Z\s .]*$" data-parsley-trigger="change" value="{{ $getCollegeManagementData->designation }}">
					</div>
					<div class="col-md-4">
						<label>Gender</label>
						<select class="form-control" name="gender" required="" data-parsley-error-message="Please select an option">
							<option value="" selected="">-- Select an option --</option>
							<option value="1" @if( $getCollegeManagementData->gender == 1) selected="" @endif>Male</option>
							<option value="2" @if( $getCollegeManagementData->gender == 2) selected="" @endif>Female</option>
							<option value="3" @if( $getCollegeManagementData->gender == 3) selected="" @endif>Other</option>
						</select>
					</div>
					<div class="col-md-4">
						<label>Profile Picture</label>
			            <span class="pull-right text-danger"><a href="javascript:void(0);" id="picture1" class="hide"><i class="fa fa-remove"></i></a> </span>
			            <input type="file" class="form-control picture" name="picture"  data-parsley-filemaxmegabytes="20" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/jpg, image/png" data-parsley-error-message="Please upload only png , jpg or jpeg." required="">
						<p class="text-danger">(please upload .png, .jpg and .jpeg file only.)</p>

						@if($getCollegeManagementData->picture != '')
							<div class="row">
								<div class="col-md-12">
									<img class="img-responsive" src="{{asset('gallery/')}}/{{ $getCollegeManagementData->slug }}/{{ $getCollegeManagementData->picture }}" alt="College Banner Image" height="100" width="100">
								</div>
							</div>
						@endif
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-4">
						<label>Email</label>
						<input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" class="form-control" name="emailaddress" placeholder="Enter email address" required="" data-parsley-error-message="Please enter email" value="{{ $getCollegeManagementData->emailaddress }}">
					</div>
					<div class="col-md-4">
						<label>Phone</label>
						<input type="text" class="form-control" name="phoneno" placeholder="Enter phone number here" data-parsley-trigger="change"  data-parsley-error-message="Please enter valid phone number" required="" data-parsley-pattern="^[6-9][0-9]{9}$" maxlength="11" data-parsley-length="[8, 11]" value="{{ $getCollegeManagementData->phoneno }}">
					</div>
					<div class="col-md-4">
						<label>Office No</label>
						<input type="text" class="form-control" name="landlineNo" placeholder="Enter office landline no here" data-parsley-trigger="change"  data-parsley-error-message="Please enter valid office landline no" value="{{ $getCollegeManagementData->landlineNo }}" data-parsley-pattern="^[0-9]{2,4}[-][0-9]{6,8}" maxlength="15" minlength="10">
					</div>
				</div>


				<div class="row padding-top5 padding-bottom5">
					<div class="col-md-12 col-lg-12 text-right">
						<button class="btn-u" type="submit">Submit</button>
					</div>
				</div>
			</form>			
		</div>
	</div>
</div>
{!! Html::script('assets/js/parsley.min.js') !!}

<script type="text/javascript">
  $('form').parsley();
</script>
<script type="text/javascript">
	$('.picture').on('change',function(){
        $('#picture1').removeClass('hide');
    });
    $('#picture1').on('click',function(e){
        $('.picture').val('').trigger('chosen:updated');
        $('#picture1').addClass('hide');
    });

    $('input[name=picture]').change(function (e)
	{   
		var ext = $('input[name=picture]').val().split('.').pop().toLowerCase();
		if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' ){
			$("input[name=picture]").parsley().reset();
		}else{
			$('input[name=picture]').val('');
			$("input[name=picture]").parsley().reset();
			return false;
		}
		//Disable input file
	});
</script>