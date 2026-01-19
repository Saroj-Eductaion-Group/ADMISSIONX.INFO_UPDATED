@extends('website/new-design-layouts.master')

@section('styles')
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.2.1/jssocials.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.2.1/jssocials-theme-flat.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
@include('website.home.search-pages.search-field-partials.ask-search-style-partial')
<script src='https://www.google.com/recaptcha/api.js'></script>
<style type="text/css">
	.clientContactDetails{box-shadow:#e2e2e2 0 0 23px; background-color: #fff; border-radius: 7px !important; padding: 20px;}
	.footer { padding: 50px 0 !important; }
    .msg-error {color: #c64848;  padding-left: 15px;}
	.g-recaptcha.error {border: solid 2px #c64848; padding: 1px; width: 22em;}
	body{background: #cadde3 !important;}
	.ask-ques-main{background: url(/assets/images/homepage/ask-ques-bg.png); background-size:cover;}	

</style>
@endsection

@section('content')
<div class="examsentranceTop padding-top80 padding-bottom80">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				@include('website.home.search-pages.search-field-partials.ask-search-partial')
			</div>
		</div>
	</div>
</div>
<div class="ask-ques-main"><!-- bg-color-light -->
	<div class="container content-sm">
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
		<div class="row">
			<div class="padding-bottom10">
				<a class="btn btn-md btn-primary" href="{{ URL::to('/ask') }}">Ask Question & Answer <i class="fa fa-angle-double-right" ></i></a>
				<a class="btn btn-md btn-primary" href="{{ URL::to('/discussions') }}">Discussions <i class="fa fa-angle-double-right" ></i></a>
				<a class="btn btn-md btn-primary" href="{{ URL::to('/unanswers') }}">Unanswered Questions <i class="fa fa-angle-double-right" ></i></a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 clientContactDetails">
				@if(sizeof($getAskQuestionDetailObj) > 0)
					@foreach( $getAskQuestionDetailObj as $que )
						<div class="news-v3 bg-color-white">
							<div class="news-v3-in">
								<ul class="list-inline posted-info">
									<li>By <a href="#">{{ $que->fullname }} (@if($que->userrole_id == 1) Admin  @elseif($que->userrole_id == 2) College  @elseif($que->userrole_id == 3) Student  @elseif($que->userrole_id == 4) Employee @endif ) </a></li>
									<li>Posted {!! date('F d, Y', strtotime($que->questionDate)) !!}</li>
									@if($que->askQuestionTagIds) 
                                    @foreach( $tags as $key1 => $item1 )
	                                       <li class="margin-bottom10">
	                                       	@if(!empty($item1->slug))
	                                       		<a href="{{ URL::to('news',['tags',$item1->slug]) }}" title="{{ $item1->name }}"> <span class="label rounded-2x label-info margin-right5 margin-top5"> {{ $item1->name }} </span> </a>
	                                       	@else
	                                       		 <span class="label rounded-2x label-info margin-right5 margin-top5"> {{ $item1->name }} </span>
	                                       	@endif
	                                       	</li>
	                                    @endforeach
	                                @endif 
								</ul>
								<h4 class="">Question :- {!! strip_tags($que->question) !!}</h4>
								<ul class="list-inline posted-info">
									<li>{{$que->views}} Views</li>
									<!-- <li>{{$que->likes}} Likes</li>
									<li>{{$que->share}} Share</li> -->
								</ul>
								<span class="blog-slider-badge"></span>
                                
								<div id="share"></div>
							</div>
						</div>
						@foreach($askQuestionAnswersObj as $key1 => $item1)
		                <div class="row">
		                    <div class="col-lg-12">
		                        <div class="panel panel-warning">
		                            <div class="panel-heading">
		                                <i class="fa fa-book"></i> Answer By {{ $item1->firstname.' '.$item1->lastname}} (@if($item1->userrole_id == 1) Admin  @elseif($item1->userrole_id == 2) College  @elseif($item1->userrole_id == 3) Student  @elseif($item1->userrole_id == 4) Employee @endif )
		                                <span class="pull-right">
		                                    <label>Date : {{ date('d F Y h:s a', strtotime($item1->answerDate)) }}</label> 
		                                    @if(Auth::check()) 
                                            	@if((Auth::user()->userrole_id == 1) || ($item1->userId == Auth::id()))
                                            		<a href="javascript:void(0);" class="answerBlock_{{$item1->id}} answerEdit" answerId="{{$item1->id}}"><button type="submit" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</button></a> 
                                            	@endif
                                            @endif
		                                </span>
		                            </div>
		                            <div class="panel-body">
		                                <div class="row">
		                                    <div class="col-md-12">
		                                        <label class="displayanswer_{{$item1->id}}">Answer :- {!! $item1->answer !!}</label>
		                                        @if(Auth::check()) 
                                            		@if((Auth::user()->userrole_id == 1) || ($item1->userId == Auth::id()))
			                                        <div class="answerEditBlock_{{$item1->id}} hide"> 
			                                            <form class="margin-top20" method="post" action="/update/ask-question-answer/{{$que->id}}/{{$item1->id}}" data-parsley-validate="">
			                                                <div class="row">
			                                                    <div class="col-md-12">
			                                                        <label>Answer</label>
			                                                        <textarea class="form-control summernote answer" id="answer"  placeholder="Enter description." name="answer">{!! $item1->answer !!}</textarea>
			                                                    </div>
			                                                </div>
			                                                <div class="form-group text-center">
			                                                    <button type="submit" class="btn btn-warning fontMontserrat fontsize-15 pt-2 pb-2 submitBtn" data-loading-text="Please wait...">Update Answer</button>
			                                                </div>
			                                            </form>
			                                        </div>
			                                        @endif
                                           		@endif
		                                        <br>
		                                        @foreach($item1->askQuestionAnswerCommentsObj as $key2 => $item2)
		                                        <div class="row">
		                                            <div class="col-lg-12 margin-top10">
		                                                <div class="panel panel-info">
		                                                    <div class="panel-heading">
		                                                        <i class="fa fa-comments"></i> Comments By {{ $item2->firstname.' '.$item2->lastname}} (@if($item2->userrole_id == 1) Admin  @elseif($item2->userrole_id == 2) College  @elseif($item2->userrole_id == 3) Student  @elseif($item2->userrole_id == 4) Employee @endif ) 
		                                                        <span class="pull-right">
		                                                            <label>Date : {{ date('d F Y h:s a', strtotime($item2->answerDate)) }}</label>
		                                                            @if(Auth::check()) 
		                                                            	@if((Auth::user()->userrole_id == 1) || ($item2->userId == Auth::id()))
		                                                            		<a href="javascript:void(0);" class="answerCommentBlock_{{$item1->id}}_{{$item2->id}} answerCommentEdit" answerId="{{$item1->id}}" commentId="{{$item2->id}}"><button type="submit" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> Edit</button></a> 
		                                                            	@endif
		                                                            @endif
		                                                        </span>
		                                                    </div>
		                                                    <div class="panel-body">
		                                                        <div class="row">
		                                                            <div class="col-md-12">
		                                                                <label class="displayanswercomment__{{$item1->id}}_{{$item2->id}}">Comments :- {!! $item2->replyanswer !!}</label>
		                                                                @if(Auth::check()) 
		                                                            		@if((Auth::user()->userrole_id == 1) || ($item2->userId == Auth::id()))
			                                                                <div class="answerCommentEditBlock__{{$item1->id}}_{{$item2->id}} hide"> 
			                                                                    <form class="margin-top20" method="post" action="/update/ask-question-answer-comment/{{$que->id}}/{{$item1->id}}/{{$item2->id}}" data-parsley-validate="">
			                                                                        <div class="row">
			                                                                            <div class="col-md-12">
			                                                                                <label>Comment</label>
			                                                                                <textarea class="form-control summernote replyanswer" id="replyanswer"  placeholder="Enter description." name="replyanswer">{!! $item2->replyanswer !!}</textarea>
			                                                                            </div>
			                                                                        </div>
			                                                                        <div class="form-group text-center">
			                                                                            <button type="submit" class="btn btn-warning fontMontserrat fontsize-15 pt-2 pb-2 submitBtn" data-loading-text="Please wait...">Update Comment</button>
			                                                                        </div>
			                                                                    </form>
			                                                                </div>
			                                                            	@endif
                                           								@endif
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        @endforeach
		                                    </div>
		                                </div>
		                                <div class="commentBlock_{{$item1->id}} hide"> 
		                                	@if(Auth::check()) 
			                                	<form class="margin-top20" method="post" action="/add/ask-question-answer-comment/{{$que->id}}/{{$item1->id}}" data-parsley-validate="">
											@else
												<form class="checkLoginStatusAskCommentSubmit" data-parsley-validate ="" enctype = "multipart/form-data">
											@endif 
		                        				<input type="hidden" name="askQuestionId" value="{{$que->id}}">
		                        				<input type="hidden" name="askAnswerId" value="{{$item1->id}}">
			                                    <div class="row">
			                                        <div class="col-md-12">
			                                            <label>Add Comments  </label>
			                                            <textarea class="form-control replyanswer summernote" id="replyanswer" placeholder="Enter description." name="replyanswer"></textarea>
			                                        </div>
			                                    </div>
			                                    <div class="col-sm-12 text-center">
			                                        <div class="form-group margin-top20">
			                                            <button type="submit" class="btn btn-info fontMontserrat fontsize-15 pt-2 pb-2 submitBtn" data-loading-text="Please wait...">Submit Comment</button>
			                                            <a href="javascript:void(0);" class="btn btn-danger fontMontserrat fontsize-15 pt-2 pb-2 commentCancelBtnBlock_{{$item1->id}} commentCancelBtn" answerId="{{$item1->id}}">Cancel</a>
			                                        </div>
			                                    </div>
			                                </form>
			                            </div>
			                            <div class="col-sm-12 text-center">
	                                        <div class="form-group margin-top20">
	                                        	<a href="javascript:void(0);" class="btn btn-info fontMontserrat fontsize-15 pt-2 pb-2 commentBtnBlock_{{$item1->id}} commentBtn" answerId="{{$item1->id}}">Add Comment</a>
	                                        </div>
	                                    </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		                @endforeach
		                <div class="row">
		                    <div class="col-md-12">
		                    	@if(Auth::check()) 
		                        	<form class="margin-top20" method="post" action="/add/ask-question-answer/{{$que->id}}" data-parsley-validate="">
								@else
									<form class="checkLoginStatusAskAnswerSubmit" data-parsley-validate ="" enctype = "multipart/form-data">
								@endif  
		                        	<input type="hidden" name="askQuestionId" value="{{$que->id}}">
		                            <div class="row">
		                                <div class="col-md-12">
		                                    <label>Add New Answer  </label>
		                                    <textarea class="form-control summernote answer" id="answer"  placeholder="Enter description." name="answer"></textarea>
		                                </div>
		                            </div>
		                            <div class="col-sm-12 text-center">
		                                <div class="form-group margin-top20">
		                                    <button type="submit" class="btn btn-warning fontMontserrat fontsize-15 pt-2 pb-2 submitBtn" data-loading-text="Please wait...">Submit Answer</button>
		                                </div>
		                            </div>
		                        </form>
		                    </div>
		                </div>						
					@endforeach
				@else
					<div class="headline text-center"><h3>No data found for Blog Details, please try with different criteria</h3></div>			
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.2.1/jssocials.min.js"></script>
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js') !!}
@include('website.home.search-pages.autocomplete-script-partial.ask-search-partial')
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
<!-- <script type="text/javascript">
	$('#btnValidate').click(function(e){
		e.preventDefault();
	  	var $captcha = $('#recaptcha'),
	    response = grecaptcha.getResponse();
		if (response.length === 0) {
			toastr.error('reCAPTCHA is mandatory');
		    $( '.msg-error').text( "reCAPTCHA is mandatory" );
		    if( !$captcha.hasClass( "error" ) ){
		      $captcha.addClass( "error" );
		    }
		    return false;
		}else{
		    $('.msg-error').text('');
		    $captcha.removeClass( "error" );
		    //toastr.success('reCAPTCHA marked');
		    this.form.submit();
		}
	});
</script> -->
<script type="text/javascript">
    window.onload = function() {
	    var $recaptcha = document.querySelector('#g-recaptcha-response');

	    if($recaptcha) {
	        $recaptcha.setAttribute("required", "required");
	    }
  	};
</script>
<script type="text/javascript">
    jQuery('.answerEdit').click(function(e){
        var answerId = $(this).attr("answerId");
        var answerBlock = '.answerEditBlock_'+$(this).attr("answerId");
        $(answerBlock).removeClass('hide');
        var answerBlockHide = '.displayanswer_'+$(this).attr("answerId");
        $(answerBlockHide).addClass('hide');
    });

    jQuery('.answerCommentEdit').click(function(e){
        var answerId = $(this).attr("answerId");
        var commentId = $(this).attr("commentId");
        var answerCommentBlock = '.answerCommentEditBlock__'+answerId+'_'+commentId;
        $(answerCommentBlock).removeClass('hide');
        var answerCommentBlockHide = '.displayanswercomment__'+answerId+'_'+commentId;
        $(answerCommentBlockHide).addClass('hide');
    });

    jQuery('.commentBtn').click(function(e){
        var answerId = $(this).attr("answerId");
        var commentId = $(this).attr("commentId");
        var answerCommentBlock = '.commentBtnBlock_'+answerId+'_'+commentId;
        $(answerCommentBlock).removeClass('hide');
        var answerCommentBlockHide = '.displayanswercomment__'+answerId+'_'+commentId;
        $(answerCommentBlockHide).addClass('hide');
    });

    jQuery('.commentBtn').click(function(e){
        var answerId = $(this).attr("answerId");
        var commentBlock = '.commentBlock_'+$(this).attr("answerId");
        $(commentBlock).removeClass('hide');

        var commentBtnBlock = '.commentBtnBlock_'+$(this).attr("answerId");
        $(commentBtnBlock).addClass('hide');
    });

    jQuery('.commentCancelBtn').click(function(e){
        var answerId = $(this).attr("answerId");
        var commentBlock = '.commentBlock_'+$(this).attr("answerId");
        $(commentBlock).addClass('hide');

        var commentBtnBlock = '.commentBtnBlock_'+$(this).attr("answerId");
        $(commentBtnBlock).removeClass('hide');
    });
</script>
<script>
    $("#share").jsSocials({
    	shareIn: 'popup',
        shares: ["twitter", "facebook", "googleplus", "linkedin", "pinterest"]
    });
</script>
@endsection