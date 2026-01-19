@if(sizeof($collegeManagementDataObj) > 0 )
<table class="table table-hover table-bordered">
	<thead>
		<tr>
			<th>Sr. No</th>
			<th>Contact Person Name</th>
			<th>Designation</th>
			<th>Gender</th>
			<th>Picture</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Office No</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach( $collegeManagementDataObj as $key => $item )
			<tr>
				<td>{{$key+1 }}</td>
				<td>
					@if($item->name)
						{{$item->suffix}} {{ $item->name }}
					@else
						<span class="label label-warning">Not updated yet</span>
					@endif
				</td>
				<td>
					@if($item->designation)
						{{ $item->designation }}
					@else
						<span class="label label-warning">Not updated yet</span>
					@endif
				</td>
				<td>
					@if($item->gender)
						@if($item->gender == "1") Male @elseif($item->gender == "2") Female @elseif($item->gender == "3") Other @endif
					@else
						<span class="label label-warning">Not updated yet</span>
					@endif
				</td>
				<td>
					@if($item->picture != '')
						<img class="img-responsive" src="{{asset('gallery/')}}/{{ $slugUrl }}/{{ $item->picture }}" alt="College Banner Image" height="100" width="100">
					@else
						<span class="label label-warning">Not updated yet</span>
					@endif
				</td>
				<td>
					@if($item->emailaddress)
						{{ $item->emailaddress }}
					@else
						<span class="label label-warning">Not updated yet</span>
					@endif
				</td>
				<td>
					@if($item->phoneno)
						{{ $item->phoneno }}
					@else
						<span class="label label-warning">Not updated yet</span>
					@endif
				</td>
				<td>
					@if($item->landlineNo)
						{{ $item->landlineNo }}
					@else
						<span class="label label-warning">Not updated yet</span>
					@endif
				</td>
				<td>
					<button class="btn btn-xs rounded btn-info" id="updateCollegeManagementDetailsId" data-effect="mfp-zoom-in">Update</button>
					<input type="hidden" name="collegeManagementDetailsId" class="collegeManagementDetailsId" value="{{ $item->collegeManagementDetailsId }}"> / <a class="btn btn-xs rounded btn-danger" href="{{ url('college/delete-college-management-details/') }}/{{ $item->collegeManagementDetailsId }}/{{ $slugUrl }}">Remove</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
@else
	<h5>Management details not listed.</h5>
@endif

<div class="col-md-4 col-md-offset-4"><button class="btn btn-u" id="addNewManagement"><i class="fa fa-plus"></i>Add New Management Details</button></div>
{!! Form::open(['url' => '/college-management-partial', 'class' => 'form-horizontal managementDetailForm', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!} <!-- , 'style' => 'visibility: hidden' -->
	<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
	<div class="row">
		<div class="col-md-12">
			<h4 class="headline">Management Information</h4>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<label>Select Title</label>
			<select class="form-control" name="suffix">
				<option disabled="" selected="">Please select suffix</option>
				<option value="Dr.">Dr.</option>
				<option value="Prof.">Prof.</option>
				<option value="Mr.">Mr.</option>
				<option value="Miss">Miss</option>
				<option value="Mrs.">Mrs.</option>
			</select>
		</div>
		<div class="col-md-9">
			<label>Contact Person Name</label>
			<input type="text" class="form-control" name="name" placeholder="Enter contact person name here" data-parsley-error-message = "Please enter valid contact person name" data-parsley-pattern="^[a-zA-Z\s .]*$" data-parsley-trigger="change">
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-4">
			<label>Designation</label>
			<input type="text" class="form-control" name="designation" placeholder="Enter designation here" data-parsley-error-message = "Please enter valid designation" data-parsley-pattern="^[a-zA-Z\s .]*$" data-parsley-trigger="change">
		</div>
		<div class="col-md-4">
			<label>Gender</label>
			<select class="form-control" name="gender" required="" data-parsley-error-message="Please select an option">
				<option value="" selected="">-- Select an option --</option>
				<option value="1">Male</option>
				<option value="2">Female</option>
				<option value="3">Other</option>
			</select>
		</div>
		<div class="col-md-4">
			<label>Profile Picture</label>
            <span class="pull-right text-danger"><a href="javascript:void(0);" id="picture1" class="hide"><i class="fa fa-remove"></i></a> </span>
            <input type="file" class="form-control picture" name="picture"  data-parsley-filemaxmegabytes="20" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/jpg, image/png" data-parsley-error-message="Please upload only png , jpg or jpeg." required="">
			<p class="text-danger">(please upload .png, .jpg and .jpeg file only.)</p>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-4">
			<label>Email</label>
			<input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" class="form-control" name="emailaddress" placeholder="Enter email address" required="" data-parsley-error-message="Please enter email" value="">
		</div>
		<div class="col-md-4">
			<label>Phone</label>
			<input type="text" class="form-control" name="phoneno" placeholder="Enter phone number here" data-parsley-trigger="change"  data-parsley-error-message="Please enter valid phone number" required="" data-parsley-pattern="^[6-9][0-9]{9}$" maxlength="10" data-parsley-length="[8, 11]">
		</div>
		<div class="col-md-4">
			<label>Office No</label>
			<input type="text" class="form-control" name="landlineNo" placeholder="Enter office landline no here" data-parsley-trigger="change"  data-parsley-error-message="Please enter valid office landline no" data-parsley-pattern="^[0-9]{2,4}[-][0-9]{6,8}" maxlength="15" minlength="10">
		</div>
	</div>
	<div class="row padding-top15 padding-bottom5">
		<div class="col-md-12 col-lg-12 text-center">
			<button class="btn-u" id="btnSubmit" type="submit">Submit</button>
		</div>
	</div>
{!! Form::close() !!}

{!! Html::script('assets/js/parsley.min.js') !!}
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

<script type="text/javascript">
	//---------------- Ajax Call for management details modal-------------------------------------------------------//
   	$('table > tbody tr > td > #updateCollegeManagementDetailsId').click(function(){
   		var collegeManagementDetailsId = $(this).next('.collegeManagementDetailsId').val();
   		var slugUrl = "{!! $slugUrl !!}";
	    $.ajax({
	        type: "GET",
	        url: '/managementDetailsPartial',
	        data: {
	            collegeManagementDetailsId: collegeManagementDetailsId,
	            slugUrl: slugUrl,
	        },
	        success: function(data){
	            $.magnificPopup.open({
	                type: 'inline',
	                items: {
	                    src: data
	                },
	                closeOnContentClick : false, 
			        closeOnBgClick :true, 
			        showCloseBtn : false, 
			        enableEscapeKey : false,
			        closeMarkup: '<button class="mfp-close mfp-new-close" type="button" title="Close (Esc)">   </button>'
	            })
	        }
	    });
	});
	//---------------- Ajax Call for management details modal-------------------------------------------------------//
</script>