<div class="profile-edit tab-pane fade in active margin-top30 white-popup">
	<div class="detail-page-signup">
		<!-- START ADDRESS FORM FOR REGISTER -->
		<div>
			<form method="POST" action="/college-scholarship-update" data-parsley-validate  enctype="multipart/form-data">
				<input type="hidden" name="collegeScholarshipId" value="{{ $collegeScholarshipsDataObj->collegeScholarshipId }}">
				<input type="hidden" name="slugUrl" value="{{ $collegeScholarshipsDataObj->slug }}">
				<div class="row">
					<div class="col-md-12">
						<h4 class="headline">Scholarship Information</h4>
					</div>
				</div>
				<div class="row">
			        <div class="col-md-12">
			            <label>Title</label>
			            <input type="text" class="form-control" name="title" placeholder="Enter scholarship title" required="" data-parsley-error-message="Please enter scholarship title" value="{{ $collegeScholarshipsDataObj->title }}">
			        </div>
			    </div>
			    <div class="row">
			        <div class="col-md-12">
			            <label>Description</label>
			            <textarea class="form-control summernote" name="description" rows="8" data-parsley-error-message = "Please enter the scholarship description" data-parsley-trigger="change">{{ $collegeScholarshipsDataObj->description }}</textarea>
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