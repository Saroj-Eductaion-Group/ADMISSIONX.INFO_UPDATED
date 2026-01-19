@extends('website/new-design-layouts.master')

@section('styles')
@include('website.home.search-pages.search-field-partials.exam-search-style-partial')

<style type="text/css">
	.clientContactDetails{box-shadow:#e2e2e2 0 0 23px; background-color: #fff; border-radius: 7px !important; padding: 20px;}
	.wrapper{ position:relative;margin:0 auto;overflow:hidden;padding:5px; height:50px;}
	.list {position:absolute;left:0px;top:0px;min-width:3000px;margin-left:12px;margin-top:0px;}
	.list li{display:table-cell;position:relative;text-align:center;cursor:grab;cursor:-webkit-grab;color:#efefef;vertical-align:middle;}
	.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {color: #fff; cursor: default; background-color: #d40d12; border: 1px solid #ddd; border-bottom-color: transparent;}
	.scroller {text-align:center;cursor:pointer;display:none;padding:7px;padding-top:11px;white-space:no-wrap;vertical-align:middle;background-color:#fff;}
	.scroller-right{float:right;}
	.scroller-left {float:left;}
</style>
<style type="text/css">
	.rating_reviews_info{background-color: #fbfbfb; border: 1px solid #e4e4e4;border-radius: 10px;box-shadow: 2px 1px 2px 0px #eaeaea; margin: 20px 0;}
	.rating_reviews_info h2{font-size: 22px;color: #f34a4e;font-weight: 600;letter-spacing: 2px;margin: 0px;padding: 0;font-family: 'Open Sans';}
	.rating_reviews_info h3{color: #000;font-size: 16px;font-weight: 400;margin: 0;}
	.rating_reviews_info p{color: #333;font-weight: 400;text-align: justify;font-family: 'Open Sans';}
	</style>
@endsection
@section('content')

<!-- govt exam detail page start -->
<div class="govtexamDetailTop padding-top80 padding-bottom80">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="searchindiaTop">
					@include('website.home.search-pages.search-field-partials.exam-search-partial')
					<h2 class="text-center padding-bottom15">{{$typeOfExaminationObj->sortname}} - {{$typeOfExaminationObj->name}} details</h2>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="govtexamDetailMain">
	<div class="container">
		<div class="row">
			<div class="col-md-12"> 
				@if(Session::has('counsellingForm'))
				<div class="padding-top20">
					<div class="alert alert-success  text-center" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>{{ Session::get('counsellingForm') }}</strong>
					</div>
				</div>
				@endif
			    <div class="card padding-bottom30">
			    	<div class="row padding-top20 clientContactDetails margin-top20">
						<div class="col-md-9">
							<div class="table-search-v1 margin-bottom-20">
								@if(sizeof($examFaqsObj) > 0)
								<div class="profile-edit tab-pane fade in active tag-box tag-box-v7">
								    <div class="row padding-top5 padding-bottom5">
								        <div class="col-md-12">
								            <div class="headline"><h2>{{$typeOfExaminationObj->sortname}} - {{$typeOfExaminationObj->name}} Faqs List </h2></div>
								        </div>
								    </div>
								    @foreach( $examFaqsObj as $key => $item )
								    <div class="rating_reviews_info padding-top20 padding-bottom20 padding-left20 padding-right20">
								    	<div>
					                        <label class="font-noraml"><i class="fa-fw fa  fa-question"></i> Question : 
					                        @if($item->question)
												{{ $item->question }}
											@else
												<span class="label label-warning">Not updated yet</span>
											@endif
					                        </label>
					                    </div>
					                    <div>
					                        <label class="font-noraml"><i class="fa-fw fa  fa-sticky-note"></i> Answer :</label> 
					                        <br>
					                        @if($item->answer)
												{!! $item->answer !!}
											@else
												<span class="label label-warning">Not updated yet</span>
											@endif
					                    </div>
					                    @if($item->refLinks)
					                    <div>
					                        <label class="font-noraml"><i class="fa-fw fa  fa-link"></i> Reference Link : 
					                        @if($item->refLinks)
												<a href="{{$item->refLinks}}">{{$item->refLinks}}</a>
											@else
												<span class="label label-warning">Not updated yet</span>
											@endif
					                        </label>
					                    </div>
					                    @endif
								    </div>
								    @endforeach
								</div>
								<div class="row indexPagination">
                    				<div class="col-md-12 text-center">
	                                <div class="custom-pagination">{!! $examFaqsObj->render() !!}</div>
		                            </div>
		                        </div>
		                        @else
		                        <div class="profile-bio">
									<div class="row">
										<div class="col-md-12">
											<div class="headline text-center">
												<h2 class="">No Faqs Added...</h2>
											</div>
										</div>							
									</div>
								</div>
		                        @endif
							</div>
						</div>
						<div class="col-md-3">
			      			@include('website.home.examination.examination-detail-getmoreinfo-link')
			      		</div>
					</div>
			    </div>
      		</div>
		</div>
	</div>
</div>
<!-- end govt exam detail page -->
@endsection

@section('scripts')
{!! Html::script('assets/js/parsley.min.js') !!}

<script type="text/javascript">
  $('form').parsley();
</script>
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js') !!}
@include('website.home.search-pages.autocomplete-script-partial.examination-search-partial')
<script type="text/javascript">
	$(function(){
	  var hash = window.location.hash;
	  hash && $('ul.nav a[href="' + hash + '"]').tab('show');

	  $('.nav-tabs a').click(function (e) {
	    $(this).tab('show');
	    var scrollmem = $('body').scrollTop();
	    window.location.hash = this.hash;
	    $('html,body').scrollTop(scrollmem);
	  });
	});

</script>	
@endsection



