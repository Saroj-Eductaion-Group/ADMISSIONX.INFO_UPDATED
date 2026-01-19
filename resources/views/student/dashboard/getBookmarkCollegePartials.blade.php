<div class="profile-edit tab-pane fade in active">

	<div class="detail-page-signup">
		<div class="headline"><h2>Bookmark College</h2></div>
		@if(!empty($getBookmarkCollegeData))
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Url</th>
				</tr>
			</thead>
			<tbody>
				@foreach( $getBookmarkCollegeData as $getBookmarkCollege )
					<tr>
						<td>
							@if($getBookmarkCollege->url)
								<a href="{{ $getBookmarkCollege->url }}" target="_blank">{{ $getBookmarkCollege->url }}</a>
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		@else
			<div class="profile-bio">
				<div class="row">
					<div class="col-md-12">
						<h2>No Bookmark College</h2>
					</div>							
				</div>
			</div>
		@endif
	</div>
</div>



