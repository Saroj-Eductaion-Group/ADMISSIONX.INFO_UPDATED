@extends('website/new-design-layouts.master')

@section('page-title-name')
Manage Your Admission Procedure
@endsection
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">

	{!! Html::style('home-layout/assets/css/pages/profile.css') !!}
@endsection

@section('content')
<div class="wrapper">
	<div class="container content profile">
		<div class="row">
			<div class="col-md-12 text-right"><a href="{{ URL::to('college/admission-procedure', $slug) }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a></div>
			<div class="col-md-12">
			<div class="profile-body">					
				<div class="profile-bio">
					<div class="row">
						<div class="col-md-12">
							<h2>{!! App\Models\CollegeProfile::getCollegeName($slug) !!}</h2>
							<span><strong>Admission Procedure Details</strong></span>
						</div>				
						
					</div>
				</div>
				<hr class="hr-gap">
				<div class="bg-color-white padding20">
					<form method="POST" action="{{ URL::to('college/admission-procedure/'.$slug.'/update') }}" data-parsley-validate="" enctype="multipart/form-data">
						<input type="hidden" name="id" value="{{ $getAdmissionProcedureObj->id }}">
						@include('college/admission-procedure.form_fields')
						<hr class="hr-gap">
						<div class="row">
							<div class="col-md-2 col-md-offset-5 text-center">
								<button type="submit" class="btn btn-u">Update</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
@include('college/admission-procedure.ajax-script-partial')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
<script type="text/javascript">
    //$('.summernote').summernote();
    $('.summernote').summernote({
        placeholder: 'write here...',
        height: 150,
        toolbar: [
          ['font', ['bold', 'underline', 'italic']],
          ['para', ['ul', 'ol', 'paragraph']],
        ],
        popover: {
        image: [
            ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
            ['float', ['floatLeft', 'floatRight', 'floatNone']],
            ['remove', ['removeMedia']]
        ],
        link: [
            ['link', ['linkDialogShow', 'unlink']]
        ],
        air: [
            ['color', ['color']],
            ['font', ['bold', 'underline', 'clear']],
            ['para', ['ul', 'paragraph']],
            ['table', ['table']],
        ]
        },
        codemirror: {
            mode: 'text/html',
            htmlMode: true,
            lineNumbers: true,
            theme: 'monokai'
        },
        dialogsInBody: true
    });
    $('#summernote').summernote('fontSize', 18);
</script>
@endsection