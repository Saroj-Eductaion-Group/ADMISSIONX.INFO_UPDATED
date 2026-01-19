<div class="profile-edit tab-pane fade in active">

	<div class="detail-page-signup">
		<div class="headline"><h2>Bookmark Blogs</h2></div>
		@if(!empty($getBookmarkBlogData))
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>Url</th>
					</tr>
				</thead>
				<tbody>
					@foreach( $getBookmarkBlogData as $getBookmarkBlog )
						<tr>
							<td>
								@if($getBookmarkBlog->url)
									<a href="{{ $getBookmarkBlog->url }}" target="_blank">{{ $getBookmarkBlog->url }}</a>
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
						<h2>No Bookmark Blogs</h2>
					</div>							
				</div>
			</div>
		@endif
	</div>
</div>



