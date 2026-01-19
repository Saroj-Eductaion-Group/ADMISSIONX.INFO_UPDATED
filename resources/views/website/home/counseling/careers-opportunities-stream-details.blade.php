@extends('website/new-design-layouts.master')

@section('content')

<!-- choose stream start -->
<div class="chooseStreamMain">
	<div class="container">
		<div class="chooseStreamTop">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12">
							<div class="chooseWhatNext">
								<h2>Career as {{$careersReleventDetailObj->title}}</h2>
								<div class="mechBusiness">
									<ul class="padding-top15">
										@if(!empty($careersReleventDetailObj->stream))
										<li>
											<a href="javascript:void(0);">
											Std XII Stream: <span>{{$careersReleventDetailObj->stream or ''}}</span></a>
										</li>
										@endif
										@if(!empty($careersReleventDetailObj->mandatorySubject))
										<li>
											<a href="javascript:void(0);">Mandatory Subjects: <span> {{$careersReleventDetailObj->mandatorySubject or ''}}</span></a>
										</li>
										@endif
										@if(!empty($careersReleventDetailObj->salery))
										<li>
											<a href="javascript:void(0);">Salary: <span> {{$careersReleventDetailObj->salery or ''}}</span></a>
										</li>
										@endif
										@if(!empty($careersReleventDetailObj->interestsTitle))
										<li>
											<a href="javascript:void(0);">
											Career Interest: <span>{{$careersReleventDetailObj->interestsTitle or ''}}</span></a>
										</li>
										@endif
										@if(!empty($careersReleventDetailObj->academicDifficulty))
										<li>
											<a href="javascript:void(0);">Academic Difficulty: <span>{{$careersReleventDetailObj->academicDifficulty or ''}}</span></a>
										</li>
										@endif
									</ul>
								</div>
							</div>
							<div class="liketweet">
								<!-- <ul>
									<li>
										<a href="javascript:void(0);"><i class="fa fa-thumbs-up"></i>Like 2</a>
									</li>
									<li>
										<a href="javascript:void(0);"><i class="fa fa-twitter"></i>Tweet</a>
									</li>
								</ul> -->
								<p>{!! $careersReleventDetailObj->description !!}</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								{{-- <h2>Job profile : {{$counselingcareerdetail->title}}</h2> --}}
								<h2>{{$counselingcareerdetail->title}}</h2>
								<p>{!! $counselingcareerdetail->description !!}</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							@if(!empty($counselingcareerdetail->image))
      							<img class="" src="/counselingimages/{{ $counselingcareerdetail->image }}" alt="{{ $counselingcareerdetail->title }}" style="width:100%;">
      						@else
								<img src="/assets/images/no-college-logo.jpg" style="width:100%;" alt="{{ $counselingcareerdetail->title }}">
          					@endif
						</div>
						<div class="col-md-7">
							<div class="jobProfileRight">
								@if(sizeof($counselingCareerSkillRequirementObj) > 0)
								<div class="jobSkillReq margin-top20">
									<h2>Skill Requirement</h2>
									<ul>
										@foreach($counselingCareerSkillRequirementObj as $key => $item)
										<li>
											<a href="javascript:void(0);"><i class="fa fa-check"></i>&nbsp;{{$item->title}}</a>
										</li>
										@endforeach
									</ul>
								</div>
								@endif
							</div>
						</div>
					</div>
					@if(!empty($counselingcareerdetail->jobProfileDesc))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2>Job Profile Description</h2>
								<p>{!! $counselingcareerdetail->jobProfileDesc or '' !!}</p>
							</div>
						</div>
					</div>
					@endif

					@if(sizeof($counselingCareerJobRoleSaleryObj) > 0)
					<div class="row margin-bottom10">
					    <div class="col-md-8">
					        <h3 class="text-uppercase text-primary">List of job roles & saleries</h3>
					    </div>
					</div>
					<div class="row">
					    <div class="col-md-12">
					        <table class="table table-bordered table-hover">
					            <thead>
					                <tr>
					                    <th>Job Title</th>
					                    <th>Avg Salery</th>
					                    <th>Top Company</th>
					                </tr>
					            </thead>
					            <tbody>
					                @foreach($counselingCareerJobRoleSaleryObj as $item)
					                    <tr>
					                        <td>
					                            {{ $item->title or '' }}
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

					@if(!empty($counselingcareerdetail->pros))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2>Pros.</h2>
								<p>{!! $counselingcareerdetail->pros or '' !!}</p>
							</div>
						</div>
					</div>
					@endif
					@if(!empty($counselingcareerdetail->cons))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2>Cons.</h2>
								<p>{!! $counselingcareerdetail->cons or '' !!}</p>
							</div>
						</div>
					</div>
					@endif
					@if(!empty($counselingcareerdetail->purpose_desc))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2>Purpose</h2>
								<p>{!! $counselingcareerdetail->purpose_desc or '' !!}</p>
							</div>
						</div>
					</div>
					@endif
					@if(!empty($counselingcareerdetail->futureGrowthPurpose))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2>Future Growth Purpose</h2>
								<p>{!! $counselingcareerdetail->futureGrowthPurpose or '' !!}</p>
							</div>
						</div>
					</div>
					@endif
					@if(!empty($counselingcareerdetail->eligibility))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2>Eligibility</h2>
								<p>{!! $counselingcareerdetail->eligibility or '' !!}</p>
							</div>
						</div>
					</div>
					@endif
					@if(!empty($counselingcareerdetail->qualification))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2>Qualification</h2>
								<p>{!! $counselingcareerdetail->qualification or '' !!}</p>
							</div>
						</div>
					</div>
					@endif
					@if(!empty($counselingcareerdetail->syllabus))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2>Syllabus</h2>
								<p>{!! $counselingcareerdetail->syllabus or '' !!}</p>
							</div>
						</div>
					</div>
					@endif
					@if(!empty($counselingcareerdetail->exam_pattern))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2>Exam Pattern</h2>
								<p>{!! $counselingcareerdetail->exam_pattern or '' !!}</p>
							</div>
						</div>
					</div>
					@endif
					@if(!empty($counselingcareerdetail->selection_criteria))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2>Selection Criteria</h2>
								<p>{!! $counselingcareerdetail->selection_criteria or '' !!}</p>
							</div>
						</div>
					</div>
					@endif
					@if(!empty($counselingcareerdetail->frequency))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2>Frequency</h2>
								<p>{!! $counselingcareerdetail->frequency or '' !!}</p>
							</div>
						</div>
					</div>
					@endif
					@if(!empty($counselingcareerdetail->employeeOpportunities))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2>Employee Opportunities</h2>
								<p>{!! $counselingcareerdetail->employeeOpportunities or '' !!}</p>
							</div>
						</div>
					</div>
					@endif
					@if(!empty($counselingcareerdetail->studyMaterial))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2>Study Material</h2>
								<p>{!! $counselingcareerdetail->studyMaterial or '' !!}</p>
							</div>
						</div>
					</div>
					@endif
					@if(!empty($counselingcareerdetail->other_details))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								{{-- <h2>Other Details</h2> --}}
								<p>{!! $counselingcareerdetail->other_details or '' !!}</p>
							</div>
						</div>
					</div>
					@endif
					@if(!empty($counselingcareerdetail->whereToStudy))
					<div class="row">
						<div class="col-md-12">
							<div class="jobProfileTop">
								<h2>Where To Study</h2>
								<p>{!! $counselingcareerdetail->whereToStudy or '' !!}</p>
							</div>
						</div>
					</div>
					@endif

					@if(sizeof($counselingCareerWhereToStudyObj) > 0)
					<div class="row margin-top20">
					    <div class="col-md-12">
					        <table class="table table-bordered table-hover">
					            <thead>
					                <tr>
					                    <th>Institute Name</th>
					                    <th>Institute Url</th>
					                    <th>City</th>
					                    <th>Programme Fees</th>
					                </tr>
					            </thead>
					            <tbody>
					                @foreach($counselingCareerWhereToStudyObj as $item)
					                    <tr>
					                        <td>
					                            {{ $item->instituteName or '' }}
					                        </td>
					                        <td>
					                            <a href="{{ $item->instituteUrl or '' }}" target="_blank">{{ $item->instituteUrl or '' }}</a>
					                        </td>
					                        <td>
					                            {{ $item->city or '' }}
					                        </td>
					                        <td>
					                            {{ $item->programmeFees or '' }}
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
	
@endsection



