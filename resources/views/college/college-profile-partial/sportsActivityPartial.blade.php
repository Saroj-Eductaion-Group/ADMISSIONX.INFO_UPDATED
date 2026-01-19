<div class="detail-page-signup margin-bottom40 table-responsive">
	<div class="headline"><h2>Manage Your College Sports & Activity</h2></div>
	<!-- Updated Course List -->
	@if( sizeof($collegeSportsActivityDataObj) > 0 )
		
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>Type Of Activity</th>
				<th>Activity Name</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach( $collegeSportsActivityDataObj as $item )
				<tr>
					<td>
						@if($item->typeOfActivity == 1)
							Outdoor Sports
						@elseif($item->typeOfActivity == 2)
							Indoor Sports
						@elseif($item->typeOfActivity == 3)
							Co-curricular Activity
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					</td>
					<td>
						@if($item->name)
							{{ $item->name }}
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					</td>
					<td>
						<button class="btn btn-xs rounded btn-info" id="updateCollegeSportsActivityId" data-effect="mfp-zoom-in">Update</button> / <input type="hidden" name="collegeSportsActivityId" class="collegeSportsActivityId" value="{{ $item->collegeSportsActivityId }}"><a class="btn btn-xs rounded btn-danger" href="{{ url('college/delete-sports-activity/') }}/{{ $item->collegeSportsActivityId }}/{{ $slugUrl }}">Remove</a>
					</td>
				</tr>
			@endforeach
		</tbody>
		
	</table>
	@else
		<h5>No college sports & activity listed.</h5>
	@endif
</div>

<div class="col-md-4 col-md-offset-4"><button class="btn btn-u" id="addNewCollegeSportsActivity"><i class="fa fa-plus"></i>Add New College Sports & Activity</button></div>
{!! Form::open(['url' => '/college-sports-activity-create', 'class' => 'form-horizontal collegeSportsActivityForm', 'data-parsley-validate' => '']) !!} <!-- , 'style' => 'visibility: hidden' -->
	<div class="row padding-top5 padding-bottom5">
		<div class="col-md-12">								
			<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
		</div>
	</div>
	<div class="row padding-top5 padding-bottom5">
		<div class="col-md-12"><label>Type Of Activity</label></div>
		<div class="col-md-12">
			<select name="typeOfActivity" class="form-control chosen-select " data-parsley-error-message=" Please select type of activity" data-parsley-trigger="change" required="">
                <option value="" selected disabled>Select Type Of Activity</option>   
                <option value="1">Outdoor Sports</option>   
                <option value="2">Indoor Sports</option>   
                <option value="3">Co-curricular Activity</option>   
            </select>
		</div>
	</div>
 	<div class="row padding-top5 padding-bottom5">
		<div class="col-md-12">
			<label>Activity Name</label>
			{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter activity name', 'data-parsley-error-message' => 'Please enter activity name here', 'required' => '']) !!}
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
	$('table > tbody tr > td > #updateCollegeSportsActivityId').click(function(){
   		var collegeSportsActivityId = $(this).next('.collegeSportsActivityId').val();
   		var slugUrl = "{!! $slugUrl !!}";
	    $.ajax({
	        type: "GET",
	        url: '/sportsActivityUpdatePartial',
	        data: {
	            collegeSportsActivityId: collegeSportsActivityId,
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