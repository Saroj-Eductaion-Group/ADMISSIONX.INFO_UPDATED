<form class="margin-top20" method="post" action="/update/exam-reference-links/{{$examId}}" data-parsley-validate="">
	<div class="row margin-bottom10">
	    <div class="col-md-8">
	        <h3 class="text-uppercase text-success">List of important reference links</h3>
	    </div>
	    <div class="col-md-4">
	        <a href="javascript:void(0);" class="btn btn-block btn-sm btn-success" id="addReferenceLinkRow"><i class="fa fa-plus"></i> Add important reference links</a>
	    </div>
	    <input type="hidden" name="examDetailId" value="{{ $examinationDetailsObj->id}}">
	</div>
	<div class="row">
	    <div class="col-md-12">
	        <table class="table table-bordered table-hover">
	            <thead>
	                <tr>
	                    <th>Title</th>
	                    <th>Url</th>
	                    <th>Action</th>
	                </tr>
	            </thead>
	            <tbody class="tableReferenceLinkSection">
	            	@foreach($examinationImportantLinksObj as $item)
                        <tr>
		                    <td>
		                        <input type="text" class="form-control" value="{{$item->title}}" name="title[]" placeholder="Title name">
		                    </td>
		                    <td>
		                        <input type="url" class="form-control" value="{{$item->url}}" name="url[]" placeholder="Reference link">
		                    </td>
		                    <td>
		                        <a class="btn btn-outline btn-danger btn-xs removeReferenceLinkRow"><i class="fa fa-remove"></i> Remove</a>
		                    </td>
		                </tr>
                    @endforeach
	            </tbody>
	        </table>
	    </div>
	</div>
	<hr>
	<div class="col-sm-12 text-center">
		<div class="form-group mb-0 mt-20">
			<button type="submit" class="btn btn-primary fontMontserrat fontsize-15 pt-2 pb-2 submitBtn" data-loading-text="Please wait...">Submit</button>
		</div>
	</div>
</form>