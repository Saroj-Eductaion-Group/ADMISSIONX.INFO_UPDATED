@extends('website/new-design-layouts.master')

@section('styles')
	{!! Html::style('home-layout/assets/css/pages/profile.css') !!}
@endsection

{{--*/ $sturentFullName = ''; /*--}}
@if( $getStudentNameDetailObj )
	@foreach( $getStudentNameDetailObj as $item )
		{{--*/ $sturentFullName =  $item->firstname.' '.$item->middlename.' '.$item->lastname; /*--}}
	@endforeach
@endif

@section('content')
<div class="wrapper">
	<div class="container content profile">
		<div class="row">
			<div class="col-md-12 text-right">
				<a href="{{ URL::to('student/check-queries', $option) }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a>
			</div>
			<div class="col-md-12">
				<div class="profile-body">
					<div class="profile-bio">
						<div class="row">
							<div class="col-md-12">
								<h2>{{ $sturentFullName }}</h2>							
							</div>
						</div>
						<div class="row margin-top10">
							<div class="col-md-6">
								@if( $getQueriesDataObj )
									@foreach( $getQueriesDataObj as $item )
									<p class="text-info"><i aria-hidden="true" class="fa fa-calendar"></i> Query Date : {{ date('M d, Y ', strtotime($item->created_at)) }}</p>
									@endforeach
								@endif
							</div>
							
						</div>
					</div>
					<hr class="hr-gap">
					
					<div class="row">
						<div class="col-sm-12 sm-margin-bottom-30">
							<div class="panel panel-profile">
								<div class="panel-heading overflow-h">
									@if( $getQueriesDataObj )
										{{--*/ $chatkey = ''; /*--}}
										@foreach( $getQueriesDataObj as $item )
											{{--*/ $chatkey = $item->chatkey; /*--}}
											<h4 class="panel-title heading-sm pull-left">
												<strong><i class="fa fa-comments-o"></i> {{ $item->subject }}</strong>
											</h4>
										@endforeach
									@endif
								</div>
								<div class="panel-body">
									<ul class="list-unstyled social-contacts-v2">
										@if( $getQueriesDataObj )
											@foreach( $getQueriesDataObj as $item )
												<li><i class="fa fa-user"></i>{{ $sturentFullName }} : {{ $item->message }} | {{ date('M d, Y ', strtotime($item->created_at)) }}</li>
											@endforeach
										@endif

										@if( $getQueryDataForReplies )
											@foreach( $getQueryDataForReplies as $item )
												@if( $item->queryflowtype != 'student-to-college' )
													<li class="text-right"><i class="fa fa-graduation-cap "></i>{{ $item->firstname }} : {{ $item->message }} | {{ date('M d, Y ', strtotime($item->created_at)) }}</li>
												@else
													<li class="text-left"><i class="fa fa-user"></i>{{ $sturentFullName }} : {{ $item->message }} | {{ date('M d, Y ', strtotime($item->created_at)) }}</li>
												@endif
											@endforeach
										@endif											
									</ul>
								</div>
							</div>							
							<hr>
							<div class="panel panel-profile">
								<div class="panel-body">
									<form action="/student/update-comment-query" method="POST">
										<input type="hidden" name="chatkey" value="{{ $chatkey }}">
										<div class="row">
											<div class="col-md-12">
												<textarea name="message" class="form-control" rows="3" maxlength="250" placeholder="Reply to student" required=""></textarea>
												<p class="text-danger">(Place your query in 250 characters. Thanks Team Admission X)</p>
											</div>
										</div>
										<div class="row margin-top10 margin-bottom10">
											<div class="col-md-2 col-md-offset-10">
												<button class="btn-u btn-block">Reply</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
						
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>		


@endsection


