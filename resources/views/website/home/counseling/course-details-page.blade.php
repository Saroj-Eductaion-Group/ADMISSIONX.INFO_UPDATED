@extends('website/new-design-layouts.master')

@section('styles')
@include('website.home.search-pages.search-field-partials.course-search-style-partial')
<style type="text/css">
.clientContactDetails{box-shadow:#e2e2e2 0 0 23px; background-color: #fff; border-radius: 7px !important; padding: 20px;}
</style>
@endsection
@section('content')
<div class="examsentranceTop padding-top80 padding-bottom80">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="examsentranceBoT">
					<h2 class="text-center padding-bottom15">Counseling Courses Details</h2>
					<div class="examsentranceInput">
						@include('website.home.search-pages.search-field-partials.course-search-partial')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- choose stream start -->
<div class="chooseStreamMain">
	<div class="container">
		<div class="chooseStreamTop">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12">
							<div class="chooseWhatNext">
								<h2>{{$counselingCoursesDetail->functionalAreaName}} : {{$counselingCoursesDetail->title}}</h2>
							</div>
							<div class="liketweet">
								<p>{!! $counselingCoursesDetail->description or ''!!}</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2>Course Details</h2>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center">
							@if(!empty($counselingCoursesDetail->image))
      							<img class="" height="300" src="/counselingimages/{{ $counselingCoursesDetail->image }}" alt="{{ $counselingCoursesDetail->title }}">
      						@else
								<img src="/assets/images/no-college-logo.jpg" style="width:100%;" alt="{{ $counselingCoursesDetail->title }}">
          					@endif
						</div>
					</div>

					@if(!empty($counselingCoursesDetail->bestChoiceOfCourse))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2> {{strtoupper($counselingCoursesDetail->name)}} Best Choice Of Course</h2>
								<p>{!! $counselingCoursesDetail->bestChoiceOfCourse or '' !!}</p>
							</div>
						</div>
					</div>
					@endif

				    <div class="row">
					@foreach($counselingCoursesMoreDetailObj as $item)
						<div class="col-md-12 clientContactDetails margin-bottom10 margin-top10">
		                <h2 class="jobProfileTop"><i class="fa fa-edit"></i> About {{$item->degreeName}} course details </h2>
							<label>Title : {{ $item->title or ''}} </label> <br>
							@if(!empty($item->popularCities))<label>Popular Cities : {{ $item->popularCities or ''}} </label><br>@endif
							@if(!empty($item->specialisations))<label>Specialisations : {{ $item->specialisations  or ''}} </label><br>@endif
							@if(!empty($item->entranceExamsName))<label>Entrance Exams Name : {{ $item->entranceExamsName or ''}} </label><br>@endif
							@if(sizeof($item->courseObj) > 0)
							<label>Courses :</label>
							<div class="row padding-left20">
				                @foreach($item->courseObj as $item2)
				                    <div class="col-md-4"><a href="javascript:void(0);">=> {{$item2->name}}</a></div>
				                @endforeach
			                </div>
			                @endif
							<label>Description : </label>
							{!! $item->description or ''!!}
						</div>
				    @endforeach
				    </div>

					@if(!empty($counselingCoursesDetail->jobsCareerOpportunityDesc))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2> {{strtoupper($counselingCoursesDetail->name)}} Jobs Career Opportunity Desc</h2>
								<p>{!! $counselingCoursesDetail->jobsCareerOpportunityDesc or '' !!}</p>
							</div>
						</div>
					</div>
					@endif

					@if(sizeof($counselingCoursesJobCareerObj) > 0)
					<div class="row margin-bottom10">
					    <div class="col-md-8">
					        <h3 class="text-uppercase text-primary">List of {{strtoupper($counselingCoursesDetail->title)}} Job Careers</h3>
					    </div>
					</div>
					<div class="row">
					    <div class="col-md-12">
					        <table class="table table-bordered table-hover">
					            <thead>
					                <tr>
					                    <th>Course Name</th>
					                    <th>Job Profiles</th>
					                    <th>Avg Salery</th>
					                    <th>Top Company</th>
					                </tr>
					            </thead>
					            <tbody>
					                @foreach($counselingCoursesJobCareerObj as $item)
					                    <tr>
					                        <td>
					                            {{ $item->courseName or '' }}
					                        </td>
					                        <td>
					                            {{ $item->jobProfiles or '' }}
					                        </td>
					                        <td>
					                            {{ $item->avgSalery or '' }}
					                        </td>
					                        <td>
					                            {{ $item->topCompany or '' }}
					                        </td>
					                    </tr>
					                @endforeach
					            </tbody>
					        </table>
					    </div>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end choose stream -->
@endsection
@section('scripts')
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js') !!}
@include('website.home.search-pages.autocomplete-script-partial.course-search-partial')
@endsection



