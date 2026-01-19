<div class="profile-edit tab-pane fade in active">

	<div class="detail-page-signup">
		<div class="headline"><h2>Bookmark Course</h2></div>
		@if(!empty($getBookmarkCourseData))
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>Url</th>
					</tr>
				</thead>
				<tbody>
					@foreach( $getBookmarkCourseData as $getBookmarkCourse )
						<tr>
							<td>
								@if($getBookmarkCourse->url)
									<a href="{{ $getBookmarkCourse->url }}" target="_blank">{{ $getBookmarkCourse->url }}</a>
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
						<h2>No Bookmark Course</h2>
					</div>							
				</div>
			</div>
		@endif
	</div>
</div>



