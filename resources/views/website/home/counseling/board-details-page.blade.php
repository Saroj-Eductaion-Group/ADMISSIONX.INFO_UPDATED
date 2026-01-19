@extends('website/new-design-layouts.master')

@section('styles')
@include('website.home.search-pages.search-field-partials.board-search-style-partial')
<style type="text/css">
.clientContactDetails{box-shadow:#e2e2e2 0 0 23px; background-color: #fff; border-radius: 7px !important; padding: 20px;}
</style>
@endsection
@section('content')
@include('website.home.search-pages.search-field-partials.board-search-partial')
<!-- choose stream start -->
<div class="chooseStreamMain">
	<div class="container">
		<div class="chooseStreamTop">
			<div class="row">
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-12">
							<div class="chooseWhatNext">
								<h2>{{$counselingBoard->name}} : {{$counselingBoard->title}}</h2>
							</div>
							<div class="liketweet">
								<!-- <ul>
									<li>
										<a href="javascript:void(0);"><i class="fa fa-thumbs-up"></i>Like 2</a>
									</li>
									<li>
										<a href="javascript:void(0);"><i class="fa fa-eye"></i>Views</a>
									</li>
								</ul> -->
								<h2>{{ $counselingBoardDetailObj->title or ''}}</h2>
								<p>{!! $counselingBoardDetailObj->description or ''!!}</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2>Board Details</h2>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center">
							@if(!empty($counselingBoardDetailObj->image))
      							<img class="" src="/counselingimages/{{ $counselingBoardDetailObj->image }}" alt="{{ $counselingBoardDetailObj->title }}">
      						@else
								<img src="/assets/images/no-college-logo.jpg" style="width:100%;" alt="{{ $counselingBoardDetailObj->title }}">
          					@endif
						</div>
					</div>
					@if(sizeof($counselingBoardLatestUpdateObj) > 0)
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileRight">
								<h2>{{strtoupper($counselingBoard->name)}} latest updates</h2>
								<ul>
				                @foreach($counselingBoardLatestUpdateObj as $item)
				                    <li><span class="" style="color: orange;"> <strong> 	=> {{ $item->dates or '' }} </strong></span>: <span>{!! $item->description or '' !!}</span></li>
				                @endforeach
				                </ul>
							</div>
						</div>
					</div>
					@endif

					@if(sizeof($counselingBoardImpDateObj) > 0)
					<div class="row margin-top10">
						<div class="col-md-12">
							<div class="jobSkillReq">
								<h2>Important Dates</h2>
								<ul>
									@foreach($counselingBoardImpDateObj as $item)
										<li>
											<a href="javascript:void(0);"><i class="fa fa-check"></i>&nbsp;{{$item->dates}} : {!! $item->description or '' !!}</a>
										</li>
					                @endforeach
								</ul>
							</div>
						</div>
					</div>
					@endif

					@if(!empty($counselingBoardDetailObj->aboutBoard))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2>About {{strtoupper($counselingBoard->name)}} Board</h2>
								<p>{!! $counselingBoardDetailObj->aboutBoard or '' !!}</p>
							</div>
						</div>
					</div>
					@endif

					@if(sizeof($counselingBoardHighlightObj) > 0)
					<div class="row">
						<div class="col-md-12">
							<h2 class="jobProfileTop">List of {{strtoupper($counselingBoard->name)}} highlights</h2>
							<table class="table table-bordered table-hover">
					            <thead>
					                <tr>
					                    <th>Feature</th>
					                    <th>Details</th>
					                </tr>
					            </thead>
					            <tbody>
					                @foreach($counselingBoardHighlightObj as $item)
					                    <tr>
					                        <td width="25%">
					                            {{ $item->title or '' }}
					                        </td>
					                        <td>
					                           {!! $item->description or '' !!}
					                        </td>
					                    </tr>
					                @endforeach
					            </tbody>
					        </table>
					    </div>
					</div>
					@endif

					@if(!empty($counselingBoardDetailObj->admissionDesc))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2>Admission Process {{strtoupper($counselingBoard->name)}} Board</h2>
								<p>{!! $counselingBoardDetailObj->admissionDesc or '' !!}</p>
							</div>
						</div>
					</div>
					@endif

					@if(sizeof($counselingBoardAdmissionDateObj) > 0)
					<div class="row margin-bottom10">
					    <div class="col-md-8">
					        <h3 class="text-uppercase text-primary">List of {{strtoupper($counselingBoard->name)}} Admission Dates</h3>
					    </div>
					</div>
					<div class="row">
					    <div class="col-md-12">
					        <table class="table table-bordered table-hover">
					            <thead>
					                <tr>
					                    <th>Class</th>
					                    <th>Dates</th>
					                    <th>Subjects</th>
					                    <th>Fees</th>
					                    <th>Place</th>
					                </tr>
					            </thead>
					            <tbody>
					                @foreach($counselingBoardAdmissionDateObj as $item)
					                    <tr>
					                        <td>
					                            {{ $item->class or '' }}
					                        </td>
					                        <td>
					                            {{ $item->dates or '' }}
					                        </td>
					                        <td>
					                            {{ $item->subjects or '' }}
					                        </td>
					                        <td>
					                            {{ $item->fees or '' }}
					                        </td>
					                        <td>
					                            {{ $item->place or '' }}
					                        </td>
					                    </tr>
					                @endforeach
					            </tbody>
					        </table>
					    </div>
					</div>
					@endif

					@if(!empty($counselingBoardDetailObj->boardDesc))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2> {{strtoupper($counselingBoard->name)}} Board Details</h2>
								<p>{!! $counselingBoardDetailObj->boardDesc or '' !!}</p>
							</div>
						</div>
					</div>
					@endif

					@if(!empty($counselingBoardDetailObj->syllabusDesc))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2> {{strtoupper($counselingBoard->name)}} Syllabus Details</h2>
								<p>{!! $counselingBoardDetailObj->syllabusDesc or '' !!}</p>
							</div>
						</div>
					</div>
					@endif
					@if(sizeof($counselingBoardSyllabusObj) > 0)
					<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered table-hover">
					            <thead>
					                <tr>
					                    <th>Class</th>
					                    <th>Subjects</th>
					                    <th>Details</th>
					                </tr>
					            </thead>
					            <tbody>
					                @foreach($counselingBoardSyllabusObj as $item)
					                    <tr>
					                        <td>
					                            {{ $item->class or '' }}
					                        </td>
					                        <td>
					                            {{ $item->subject or '' }}
					                        </td>
					                        <td>
					                            {!! $item->description or '' !!}
					                        </td>
					                    </tr>
					                @endforeach
					            </tbody>
					        </table>
						</div>
					</div>
					@endif

					@if(!empty($counselingBoardDetailObj->samplePaper))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2> {{strtoupper($counselingBoard->name)}} Sample Paper Details</h2>
								<p>{!! $counselingBoardDetailObj->samplePaper or '' !!}</p>
							</div>
						</div>
					</div>
					@endif
					@if(sizeof($counselingBoardSamplePaperObj) > 0)
					<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered table-hover">
					            <thead>
					                <tr>
					                    <th>Class</th>
					                    <th>Subjects</th>
					                    <th>Details</th>
					                </tr>
					            </thead>
					            <tbody>
					                @foreach($counselingBoardSamplePaperObj as $item)
					                    <tr>
					                        <td>
					                            {{ $item->class or '' }}
					                        </td>
					                        <td>
					                            {{ $item->subject or '' }}
					                        </td>
					                        <td>
					                            {!! $item->description or '' !!}
					                        </td>
					                    </tr>
					                @endforeach
					            </tbody>
					        </table>
						</div>
					</div>
					@endif

					@if(!empty($counselingBoardDetailObj->admitCardDetails))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2> {{strtoupper($counselingBoard->name)}} Admit Card Details</h2>
								<p>{!! $counselingBoardDetailObj->admitCardDetails or '' !!}</p>
							</div>
						</div>
					</div>
					@endif
					@if(sizeof($counselingBoardSamplePaperObj) > 0)
					<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered table-hover">
					            <thead>
					                <tr>
					                    <th>Class</th>
					                    <th>Dates</th>
					                    <th>Subject</th>
					                    <th>Setting</th>
					                </tr>
					            </thead>
					            <tbody>
					                @foreach($counselingBoardSamplePaperObj as $item)
					                    <tr>
					                        <td>
					                            {{ $item->class or '' }}
					                        </td>
					                        <td>
					                            {{ $item->dates or '' }}
					                        </td>
					                        <td>
					                            {!! $item->subject or '' !!}
					                        </td>
					                        <td>
					                            {!! $item->setting or '' !!}
					                        </td>
					                    </tr>
					                @endforeach
					            </tbody>
					        </table>
						</div>
					</div>
					@endif

					@if(!empty($counselingBoardDetailObj->preprationTips))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2> {{strtoupper($counselingBoard->name)}} Board Prepration Tips</h2>
								<p>{!! $counselingBoardDetailObj->preprationTips or '' !!}</p>
							</div>
						</div>
					</div>
					@endif

					@if(!empty($counselingBoardDetailObj->resultDesc))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2> {{strtoupper($counselingBoard->name)}} Result Details</h2>
								<p>{!! $counselingBoardDetailObj->resultDesc or '' !!}</p>
							</div>
						</div>
					</div>
					@endif

					@if(!empty($counselingBoardDetailObj->entranceExam))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2> {{strtoupper($counselingBoard->name)}} Entrance Exam Details</h2>
								<p>{!! $counselingBoardDetailObj->entranceExam or '' !!}</p>
							</div>
						</div>
					</div>
					@endif

					@if(!empty($counselingBoardDetailObj->chooseRightCollege))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2> {{strtoupper($counselingBoard->name)}} Choose Right College Details</h2>
								<p>{!! $counselingBoardDetailObj->chooseRightCollege or '' !!}</p>
							</div>
						</div>
					</div>
					@endif
				</div>
				<div class="col-md-3">
					<div class="bExamresultRight margin-bottom10">
						<h2>{{ ucfirst($category) }} Board List</h2>
						<ul>
							@foreach( $relatedBoards as $item )
							<li class="margin-bottom10">
								<a target="_blank" href="{{ URL::to('/board/'.strtolower($item->misc).'/'.$item->slug) }}">
									@if(!empty($item->image))<img class="" style="max-width: 40px;" src="/counselingimages/{{ $item->image }}" alt="{{ $item->name }}">@else <i class="fa fa-university"></i>@endif {{$item->name}} 
									<i class="fa fa-chevron-right pull-right"></i>
								</a>
							</li>
							@endforeach
						</ul>
					</div>
					<div class="bExamresultRight margin-top10">
						<h2>@if($category == 'state') National @elseif($category == 'national') State @else Other @endif Board List</h2>
						<ul>
							@foreach( $otherBoards as $item )
							<li  class="margin-bottom10">
								<a target="_blank" href="{{ URL::to('/board/'.strtolower($item->misc).'/'.$item->slug) }}">
									@if(!empty($item->image))<img class="" style="max-width: 40px;" src="/counselingimages/{{ $item->image }}" alt="{{ $item->name }}">@else <i class="fa fa-university"></i>@endif {{$item->name}} 
									<i class="fa fa-chevron-right pull-right"></i>
								</a>
							</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end choose stream -->
@endsection

@section('scripts')
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js') !!}
@include('website.home.search-pages.autocomplete-script-partial.examination-boards-search-partial')
@endsection



