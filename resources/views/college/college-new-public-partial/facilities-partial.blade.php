<div class="school-info section">
    <div class="section-title">
        <h3>College Facilities</h3>
    </div>
    <div class="section-content">
		@if( sizeof($collegeFacilityDataObj) > 0 )
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Facility Name </th>
				</tr>
			</thead>
			<tbody>
				@foreach( $collegeFacilityDataObj as $item )
					<tr>
						<td>
							@if($item->facilitiesName)
								<img src="/home-layout/assets/img/facility/{{ $item->iconname }}" width="32" alt="{{ $item->facilitiesName }}">  {{ $item->facilitiesName }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
							<div class="hr-line-dashed"></div>
							<label >Description :- </label>
							@if( $item->description )
								<span class="minimize1">{{ $item->description }}</span></p>
							@else
								<button class="btn btn-xs rounded btn-warning" id="updateCollegeFacilityID" data-effect="mfp-zoom-in">Not udpated yet</button> <input type="hidden" name="collegefacilitiesId" class="collegefacilitiesId" value="{{ $item->collegefacilitiesId }}">
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		@else
			<h5>No college facilities listed.</h5>
		@endif
	</div>
</div>
