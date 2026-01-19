<div class="detail-page-signup margin-bottom40 table-responsive">
	<div class="headline"><h2>Manage Your College Facilities</h2></div>
	<!-- Updated Course List -->
	@if( sizeof($collegeFacilityDataObj) > 0 )
		
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>Facility Name </th>
				<!-- <th>Name</th> -->
				
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach( $collegeFacilityDataObj as $getCollegeFacility )
				<tr>
					<td>
						@if($getCollegeFacility->facilitiesName)
							{{ $getCollegeFacility->facilitiesName }}
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
						<div class="hr-line-dashed"></div>
						<label >Description :- </label>
						@if( $getCollegeFacility->description )
							<span class="minimize1">{{ $getCollegeFacility->description }}</span></p>	<!-- {{ str_limit($getCollegeFacility->description, $limit = 100, $end = '...') }}  -->
						@else
							<button class="btn btn-xs rounded btn-warning" id="updateCollegeFacilityID" data-effect="mfp-zoom-in">Not udpated yet</button> <input type="hidden" name="collegefacilitiesId" class="collegefacilitiesId" value="{{ $getCollegeFacility->collegefacilitiesId }}">
							<!-- <span class="label label-warning">Not udpated yet</span> -->
						@endif
					</td>
					<!-- <td>
						@if($getCollegeFacility->name)
							{{ $getCollegeFacility->name }}
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					</td> -->
					
					<td>
						<button class="btn btn-xs rounded btn-info" id="updateCollegeFacilityID" data-effect="mfp-zoom-in">Update</button> / <input type="hidden" name="collegefacilitiesId" class="collegefacilitiesId" value="{{ $getCollegeFacility->collegefacilitiesId }}"><a class="btn btn-xs rounded btn-danger" href="{{ url('college/delete-college-facility/') }}/{{ $getCollegeFacility->collegefacilitiesId }}/{{ $slugUrl }}">Remove</a>
					</td>
				</tr>
			@endforeach
		</tbody>
		
	</table>
	@else
		<h5>No college facilities listed.</h5>
	@endif
</div>
	<!-- End -->
	<!-- FORM -->
	<div class="col-md-4 col-md-offset-4"><button class="btn btn-u" id="addNewCollegeFacility"><i class="fa fa-plus"></i>Add New College Facility Details</button></div>
	{!! Form::open(['url' => '/college-facilities-partial', 'class' => 'form-horizontal collegeFacilityForm', 'data-parsley-validate' => '']) !!} <!-- , 'style' => 'visibility: hidden' -->
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">								
				<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
			</div>
		</div>
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12"><label>Facility Type</label></div>
			<div class="col-md-12">
				<select name="facilities_id" class="form-control chosen-select " data-parsley-error-message=" Please select facilities type" data-parsley-trigger="change" required="">
                    <option value="" selected disabled>Select facilities type</option>   
                    @foreach ($facilitiesTypeObj as $facilities)
	                    <option value="{{ $facilities->id }}">{{ $facilities->name }}</option>
	                @endforeach       
                </select>
			</div>
		</div>
	 	<!-- <div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<label>Name</label>
				{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter name', 'data-parsley-error-message' => 'Please enter name here', 'required' => '']) !!}
			</div>
		</div> -->
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<label>Description</label>
				{!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter description']) !!}
			</div>
		</div>
		
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12 col-lg-12 text-right">
				<button class="btn-u" type="submit">Submit</button>
			</div>
		</div>
	{!! Form::close() !!}


<script type="text/javascript">
	//-------------------Ajax Call for College Facility modal-----------------------------------------------------//
	$('table > tbody tr > td > #updateCollegeFacilityID').click(function(){
   		var collegefacilitiesId = $(this).next('.collegefacilitiesId').val();
   		var slugUrl = "{!! $slugUrl !!}";
	    $.ajax({
	        type: "GET",
	        url: '/collegeFacilityPartial',
	        data: {
	            collegefacilitiesId: collegefacilitiesId,
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
	//-------------------Ajax Call for Event modal-----------------------------------------------------//
</script>