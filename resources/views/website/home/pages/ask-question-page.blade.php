@extends('website/new-design-layouts.master')

@section('styles')
{!! Html::style('home-layout/assets/css/pages/blog.css') !!}
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
@include('website.home.search-pages.search-field-partials.ask-search-style-partial')
<script src='https://www.google.com/recaptcha/api.js'></script>
<style type="text/css">
	.clientContactDetails{box-shadow:#e2e2e2 0 0 23px; background-color: #fff; border-radius: 7px !important; padding: 20px;}
	.footer { padding: 50px 0 !important; }
    .msg-error {color: #c64848;  padding-left: 15px;}
	.g-recaptcha.error {border: solid 2px #c64848; padding: 1px; width: 22em;}
	#g-recaptcha-response {
	    display: block !important;
	    position: absolute;
	    margin: -78px 0 0 0 !important;
	    width: 302px !important;
	    height: 76px !important;
	    z-index: -999999;
	    opacity: 0;
	}
	body{background: #cadde3;}

.ask-ques-main{
    background: url(/assets/images/homepage/ask-ques-bg.png); background-size:cover; 
}	

</style>

@endsection

@section('content')
<div class="examsentranceTop padding-top60 padding-bottom80">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				@include('website.home.search-pages.search-field-partials.ask-search-partial')
			</div>
		</div>
	</div>
</div>
<div class="breadcrumbs">
	<div class="container">
		<h1 class="pull-left">{{ ucfirst($slugTagName) }} Ask Question & Answer</h1>
		<ul class="pull-right breadcrumb">
			<li><a href="{{ URL::to('/') }}">Home</a></li>
			<li class="active">Ask Question & Answer</li>
		</ul>
	</div>
</div>

<div class="ask-ques-main">
	<div class="container content">
		@if(Session::has('flash_message'))
	        <div class="row">
	            <div class="col-md-6 col-md-offset-3">
	                <div class="alert {{ Session::get('alert_class') }}  alert-dismissible fade in text-center" role="alert">
	                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                        <span aria-hidden="true">×</span>
	                    </button>
	                    <strong>{{ Session::get('flash_message') }}</strong>
	                </div>
	            </div>
	        </div>
	    @endif
	    @include('website.home.pages.ask-question-form-partial')
		<div class="row blog-page">
			<div class="padding-bottom10">
				<a class="btn btn-md btn-primary" href="{{ URL::to('/ask') }}">Ask Question & Answer <i class="fa fa-angle-double-right" ></i></a>
				<a class="btn btn-md btn-primary" href="{{ URL::to('/discussions') }}">Discussions <i class="fa fa-angle-double-right" ></i></a>
				<a class="btn btn-md btn-primary" href="{{ URL::to('/unanswers') }}">Unanswered Questions <i class="fa fa-angle-double-right" ></i></a>
			</div>
			<div class="col-md-8 md-margin-bottom-40">
				@if(sizeof($getAskQuestionObj) > 0)
					@foreach( $getAskQuestionObj as $item )
						<div class="row blog blog-medium margin-bottom-40 clientContactDetails">
							<div class="col-md-12">
								<h2>
									<span class="text-left">
										Question : <a href="{{ URL::to('ask', $item->slug) }}">{!! $item->question !!}</a>
									</span>
								</h2>
								<ul class="list-unstyled list-inline blog-info">
									<li><i class="fa fa-calendar"></i> {!! date('M d, Y', strtotime($item->questionDate)) !!}</li>
									@if(!empty($item->fullname))
										<li><i class="fa fa-user"></i> {{ $item->fullname }}</li>
									@endif
									<li><i class="fa fa-eye"></i> {{$item->views}} Views</li>
									<!-- <li><i class="fa fa-thumbs-up"></i> {{$item->likes}} Likes</li>
									<li><i class="fa fa-share-alt"></i> {{$item->share}} Share</li> -->
								</ul>
		                        <ul class="list-inline posted-info">
		                        	<i class="fa fa-tags"></i>
									@if($item->askQuestionTagIds) 
			                            @foreach( $item->tagname as $key1 => $item1 )
			                                <li class="margin-bottom10"> 
			                               	@if(!empty($item1->slug))
			                               		<a href="{{ URL::to('ask',['tags',$item1->slug]) }}" title="{{ $item1->name }}"> <span class="label label-info rounded-2x margin-top5"> {{ $item1->name }} </span> </a>
			                               	@else
			                               		 <span class="label label-info rounded-2x margin-top5"> {{ $item1->name }} </span>
			                               	@endif
			                               	</li>
			                            @endforeach
			                        @endif 	
								</ul>						
								<p>
									<a class="btn btn-danger btn-md" href="{{ URL::to('ask', $item->slug) }}">View More <i class="fa fa-angle-double-right margin-left-5" ></i></a>
									@if($item->totalAnswerCount > 0)
									<a class="btn btn-info btn-md" href="{{ URL::to('ask', $item->slug) }}">View Total {{$item->totalAnswerCount}} Answers <i class="fa fa-eye margin-left-5" ></i></a>
									@endif
									@if($item->totalCommentsCount > 0)
									<a class="btn btn-warning btn-md" href="{{ URL::to('ask', $item->slug) }}">View Total {{$item->totalCommentsCount}} Comments <i class="fa fa-eye margin-left-5" ></i></a>
									@endif
									<a class="btn btn-success btn-md" href="{{ URL::to('ask', $item->slug) }}">Answer<i class="fa fa-plus margin-left-5" ></i></a>
								</p>
							</div>
						</div>
					@endforeach
					<div class="text-center">
						{!! $getAskQuestionObj->render() !!}	
					</div>				
				@else
					<div class="headline text-center"><h1>No data found for {{  ucfirst($slugTagName) }} Question List, please try with different criteria</h1></div>			
				@endif
			</div>
			
			<div class="col-md-4">
				<div class="posts margin-bottom-40 clientContactDetails">
					<div class="headline headline-md"><h2>Recent Ask Question</h2></div>
					<ul class="list-unstyled blog-latest-posts margin-bottom-50">
					@if( $getNewAskQuestionObj )
						@foreach( $getNewAskQuestionObj as $item )
						<li>
							<h3><a href="{{ URL::to('ask', $item->slug) }}">{{ str_limit(strip_tags($item->question), 100) }}</a> | <small>{!! date('F d, Y', strtotime($item->questionDate)) !!}</small></h3>							
						</li>
						@endforeach
					@endif
					</ul>
				</div>
				@if(sizeof($getUnansweredQuestionObj) > 0)
				<div class="posts margin-bottom-40 clientContactDetails">
					<div class="headline headline-md"><h2>Unanswered Question</h2></div>
					<ul class="list-unstyled blog-latest-posts margin-bottom-50">
						@foreach( $getUnansweredQuestionObj as $item )
						<li>
							<h3><a href="{{ URL::to('ask', $item->slug) }}">{{ str_limit(strip_tags($item->question), 100) }}</a> | <small>{!! date('F d, Y', strtotime($item->questionDate)) !!}</small></h3>							
						</li>
						@endforeach
					</ul>
				</div>
				@endif
				<!-- Tags v3 -->
				<div class="margin-bottom-20 clientContactDetails">
					<div class="headline-v2"><h2>Ask Question Tags</h2></div>
					<ul class="list-inline tags-v3">
						@foreach( $askQuestionTagObj as $item )
							@if(!empty($item->slug))
								<li><a class="rounded-3x" title="{{$item->name}}" href="{{ URL::to('ask',['tags',$item->slug]) }}">{{$item->name}}</a></li>
							@endif
						@endforeach
					</ul>
				</div>
				<!-- End Tags v3 -->
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js') !!}
@include('website.home.search-pages.autocomplete-script-partial.ask-search-partial')
<script type="text/javascript">
	// $('#btnValidate').click(function(e){
	// 	e.preventDefault();
	//   	var $captcha = $('#recaptcha'),
	//     response = grecaptcha.getResponse();
	// 	if (response.length === 0) {
	// 		toastr.error('reCAPTCHA is mandatory');
	// 	    $( '.msg-error').text( "reCAPTCHA is mandatory" );
	// 	    if( !$captcha.hasClass( "error" ) ){
	// 	      $captcha.addClass( "error" );
	// 	    }
	// 	    return false;
	// 	}else{
	// 	    $('.msg-error').text('');
	// 	    $captcha.removeClass( "error" );
	// 	    //toastr.success('reCAPTCHA marked');
	// 	    this.form.submit();
	// 	}
	// });
</script>
<script type="text/javascript">
    window.onload = function() {
    var $recaptcha = document.querySelector('#g-recaptcha-response');

    if($recaptcha) {
        $recaptcha.setAttribute("required", "required");
    }
  };
  </script>
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
<!--  <script type="text/javascript">
// POST YOUR QUESTION AND THEN OPEN LOGIN FORM
$( '.submitNewTimeLineStatusBtn' ).submit(function(e) {
    e.preventDefault();
    var form = $(this).serialize();
    // $(this).find('button').addClass('pulse').addClass('hide');
    if ( $(this).parsley().isValid() ) {
        //PARSLEY RETURN TRUE
        $.ajax({
            type: "POST",
            url: "{{ URL::to('/api/set/ask-question') }}",
            data: form,
            success: function(data){
			    $('#loginCheckModal').modal({
			        show: 'true'
			    });
            },
            error: function(data){
            }
        });
    }else{
        
    }
});
</script> -->
@endsection