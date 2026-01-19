<div class="profile-edit tab-pane fade in active margin-top30 white-popup">
	<div class="detail-page-signup">
		<h2 class="heading-md text-center text-green"><a class="hover-effect" href="">Manage your college sports & activity details</a></h2>
		<div>
			<form method="POST" action="/college-sports-activity-update" data-parsley-validate>
				<input type="hidden" name="collegeSportsActivityId" value="{{ $collegeSportsActivityDataObj->collegeSportsActivityId }}">
				<input type="hidden" name="slugUrl" value="{{ $collegeSportsActivityDataObj->slug }}">
			    <div class="row padding-top5 padding-bottom5">
			     	<div class="col-md-12"><label>Type Of Activity</label></div>
			    	<div class="col-md-12">
			            <select name="typeOfActivity" class="form-control chosen-select " data-parsley-error-message=" Please select type of activity" data-parsley-trigger="change" required="">
		                    <option value="" selected disabled>Select Type Of Activity</option>
		                    <option value="1" @if( $collegeSportsActivityDataObj->typeOfActivity == 1) selected="" @endif>Outdoor Sports</option>   
			                <option value="2" @if( $collegeSportsActivityDataObj->typeOfActivity == 2) selected="" @endif>Indoor Sports</option>   
			                <option value="3" @if( $collegeSportsActivityDataObj->typeOfActivity == 3) selected="" @endif>Co-curricular Activity</option>     
		                </select>
			        </div>
			    </div>
			    <div class="row padding-top5 padding-bottom5">
			    	<div class="col-md-12">
			            <label>Activity Name</label>
			            @if( $collegeSportsActivityDataObj->name )
			            	<input type="text" class="form-control" name="name" placeholder="Please enter activity name" data-parsley-error-message = "Please enter activity name" data-parsley-trigger="change" value="{{ $collegeSportsActivityDataObj->name }}" required >
		            	@else
		            		<input type="text" class="form-control" name="name" placeholder="Please enter activity name" data-parsley-error-message = "Please enter activity name" data-parsley-trigger="change" required >
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
