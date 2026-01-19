<div class="profile-edit tab-pane fade in active margin-top30 white-popup">
	<div class="detail-page-signup">
		<!-- <h2 class="heading-md text-center text-green"><a class="hover-effect" href="">Manage your facility details</a></h2> -->
		<!-- START ADDRESS FORM FOR REGISTER -->
		<div>
			<form method="POST" action="/college-facility-update" data-parsley-validate>
				<input type="hidden" name="collegefacilitiesId" value="{{ $getCollegeFacilityData->collegefacilitiesId }}">
				<input type="hidden" name="slugUrl" value="{{ $getCollegeFacilityData->slug }}">
			    <div class="row padding-top5 padding-bottom5">
			     	<div class="col-md-12"><label>Facilities Type</label></div>
			    	<div class="col-md-12">
			            <select name="facilities_id" class="form-control chosen-select " data-parsley-error-message=" Please select facilities type" data-parsley-trigger="change" required="">
		                    <option value="" selected disabled>Select facilities type</option>   
		                    @foreach ($facilitiesTypeObj as $facility)
		                    	@if( $getCollegeFacilityData->facilities_id == $facility->id)
			                    	<option value="{{ $facility->id }}" selected="">{{ $facility->name }}</option>
		                    	@else
		                    		<option value="{{ $facility->id }}">{{ $facility->name }}</option>
	                    		@endif
			                @endforeach       
		                </select>
			        </div>
			    </div>
			    <!-- <div class="row padding-top5 padding-bottom5">
			    	<div class="col-md-12">
			            <label>College Facilities Name</label>
			            @if( $getCollegeFacilityData->name )
			            	<input type="text" class="form-control" name="name" placeholder="Please enter college facilities name" data-parsley-error-message = "Please enter college facilities name" data-parsley-trigger="change" value="{{ $getCollegeFacilityData->name }}" required >
		            	@else
		            		<input type="text" class="form-control" name="name" placeholder="Please enter college facilities name" data-parsley-error-message = "Please enter college facilities name" data-parsley-trigger="change" required >
            			@endif
			        </div>
			    </div> -->
			    <div class="row padding-top5 padding-bottom5">
			    	<div class="col-md-12">
			            <label>Description</label>
			            @if( $getCollegeFacilityData->description )
			            	<input type="textarea" class="form-control" name="description" placeholder="Please enter college facilities description" data-parsley-error-message = "Please enter college facilities description" data-parsley-trigger="change" value="{{ $getCollegeFacilityData->description }}">
		            	@else
		            		<input type="textarea" class="form-control" name="description" placeholder="Please enter college facilities description" data-parsley-error-message = "Please enter college facilities description" data-parsley-trigger="change">
	            		@endif
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
