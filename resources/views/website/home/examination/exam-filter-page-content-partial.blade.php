<div class="detailCoursemainTop padding-bottom20 margin-bottom20">
	<div class="row">
		<div class="col-md-1">
			<div class="detailCoursebotIcon" style="cursor: pointer;">
				@if(!empty($searchKeyObj->universitylogo))
				<a href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug) }}" target="_blank">
					<img class="" width="60" src="/examinationlogo/{{ $searchKeyObj->universitylogo }}" width="120" alt="{{ $searchKeyObj->name }}">
				</a>
				@else
					<a target="_blank" href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug) }}">
						<i class="fa fa-university"></i>
					</a>
				@endif
			</div>
		</div>
		<div class="col-md-9">
			<div class="detailCoursebotContent">
				<a target="_blank" href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug) }}">
					<h2>{{ $searchKeyObj->sortname }} - {{$searchKeyObj->name}}</h2>
					<p>{{ $searchKeyObj->universityName }}</p>
				<p>{{ $searchKeyObj->title }}</p>
				</a>		
			</div>
		</div>
	</div>
	<div class="row padding-top20 padding-bottom10">
		<div class="col-md-4">
			<div class="applicationCome">
				<a target="_blank" href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug) }}">
					{{ $searchKeyObj->applicationexamstatusesName or 'Not updated yet'}}</a>
			</div>
		</div>
		<div class="col-md-2 pull-right">
			<div class="detailApplyNow">
				<a target="_blank" href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug) }}" style="background: #ff7900; color: #fff;">apply now</a>
			</div>
		</div>
	</div>
	<div class="row padding-bottom20">
		<div class="col-md-4">
			<div class="appFormExam">
				<h2>@if(!empty($searchKeyObj->applicationFrom) && !empty($searchKeyObj->applicationTo)) {{ date('d F Y', strtotime($searchKeyObj->applicationFrom)) }} - {{ date('d F Y', strtotime($searchKeyObj->applicationTo)) }} @else Not updated yet @endif</h2>
				<p>application form</p>
			</div>
		</div>
		<div class="col-md-4">
			<div class="appFormExam">
				<h2>@if(!empty($searchKeyObj->exminationDate)){{ $searchKeyObj->exminationDate}} @else Not updated yet @endif</h2>
				<p>examination</p>
			</div>
		</div>
		<div class="col-md-4">
			<div class="appFormExam">
				<h2>@if(!empty($searchKeyObj->resultAnnounce)){{ $searchKeyObj->resultAnnounce}} @else Not updated yet @endif</h2>
				<p>result announce</p>
			</div>
		</div>
	</div>
	<div class="row padding-top20 padding-bottom20" style="border-top: 1px solid #eee;">
		<div class="col-md-4">
			<div class="appFormExam">
				<h2>@if(!empty($searchKeyObj->examination_typesName)){{ $searchKeyObj->examination_typesName}} @else Not updated yet @endif</h2>
				<p>Examination Type</p>
			</div>
		</div>
		<div class="col-md-4">
			<div class="appFormExam">
				<h2>@if(!empty($searchKeyObj->application_modesName)){{ $searchKeyObj->application_modesName}} @else Not updated yet @endif</h2>
				<p>Application Mode</p>
			</div>
		</div>
		<div class="col-md-4">
			<div class="appFormExam">
				<h2>@if(!empty($searchKeyObj->examination_modesName)){{ $searchKeyObj->examination_modesName}} @else Not updated yet @endif</h2>
				<p>Examination Mode</p>
			</div>
		</div>
	</div>
	<div class="row padding-top20 padding-bottom20" style="border-top: 1px solid #eee;">
		<div class="col-md-12">
			<div class="appProcess margin-top10">
				<label>Important Links :</label>
				<div class="bigSecion_{{ $searchKeyObj->id }} hide">
					<ul>
						<li>
		          		<a class="active" style="background-color: #efefef; color: #ff7900;" target="_blank" href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug.'#tab1') }}"><span>Overview</span></a>
		          	</li>
		          	<li>
		          		<a class="active" style="background-color: #efefef; color: #ff7900;" target="_blank" href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug.'#tab2') }}"><span>Application Processes</span></a>
		          	</li>
		          	<li>
		          		<a class="active" style="background-color: #efefef; color: #ff7900;" target="_blank" href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug.'#tab3') }}"><span>Eligibilities</span></a>
		          	</li>
		          	<li>
		          		<a class="active" style="background-color: #efefef; color: #ff7900;" target="_blank" href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug.'#tab4') }}"><span>Dates</span></a>
		          	</li>
		          	<li>
		          		<a class="active" style="background-color: #efefef; color: #ff7900;" target="_blank" href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug.'#tab5') }}"><span>Syllabus</span></a>
		          	</li>
		          	<li>
		          		<a class="active" style="background-color: #efefef; color: #ff7900;" target="_blank" href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug.'#tab6') }}"><span>Patterns</span></a>
		          	</li>
		          	<li>
		          		<a class="active" style="background-color: #efefef; color: #ff7900;" target="_blank" href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug.'#tab7') }}"><span>Admit CARDS</span></a>
		          	</li>
		          	<li>
		          		<a class="active" style="background-color: #efefef; color: #ff7900;" target="_blank" href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug.'#tab8') }}"><span>Results</span></a>
		          	</li>
		          	<li>
		          		<a class="active" style="background-color: #efefef; color: #ff7900;" target="_blank" href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug.'#tab9') }}"><span>Cut offs</span></a>
		          	</li>
		          	<li>
		          		<a class="active" style="background-color: #efefef; color: #ff7900;" target="_blank" href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug.'#tab10') }}"><span>Counsellings</span></a>
		          	</li>
		          	<li>
		          		<a class="active" style="background-color: #efefef; color: #ff7900;" target="_blank" href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug.'#tab11') }}"><span>Prepration Tips</span></a>
		          	</li>
		          	<li>
		          		<a class="active" style="background-color: #efefef; color: #ff7900;" target="_blank" href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug.'#tab12') }}"><span>Answer Key</span></a>
		          	</li>
		          	<li>
		          		<a class="active" style="background-color: #efefef; color: #ff7900;" target="_blank" href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug.'#tab13') }}"><span>Analysis Records</span></a>
		          	</li>
		          	<li>
		          		<a class="active" style="background-color: #efefef; color: #ff7900;" target="_blank" href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug.'#tab14') }}"><span>Reference Links</span></a>
		          	</li>
		          	<li>
		          		<a class="active" style="background-color: #efefef; color: #ff7900;" target="_blank" href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug.'#tab15') }}"><span>Faqs</span></a>
		          	</li>
		          	<li>
		          		<a class="active" style="background-color: #efefef; color: #ff7900;" target="_blank" href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug.'#tab16') }}"><span>Questions & Answer</span></a>
		          	</li>
						<li>
							<a href="javascript:void(0);" onclick="showHideSection('smallSection_{{ $searchKeyObj->id }}', 'bigSecion_{{ $searchKeyObj->id }}', 'moreButton_{{ $searchKeyObj->id }}', 'lessButton_{{ $searchKeyObj->id }}')" class="active btn more_info moreButton_{{ $searchKeyObj->id }}"><i class="fa fa-plus"></i> More Info</a>
                        <a href="javascript:void(0);" onclick="showHideSection('bigSecion_{{ $searchKeyObj->id }}','smallSection_{{ $searchKeyObj->id }}', 'lessButton_{{ $searchKeyObj->id }}', 'moreButton_{{ $searchKeyObj->id }}')" class="active btn more_info lessButton_{{ $searchKeyObj->id }} hide">Less Info</a>
						</li>
					</ul>
				</div>
				<div class="smallSection_{{ $searchKeyObj->id }}">
					<ul>
						<li>
		          		<a class="active" style="background-color: #efefef; color: #ff7900;" target="_blank" href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug.'#tab1') }}"><span>Overview</span></a>
		          	</li>
		          	<li>
		          		<a class="active" style="background-color: #efefef; color: #ff7900;" target="_blank" href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug.'#tab2') }}"><span>Application Processes</span></a>
		          	</li>
		          	<li>
		          		<a class="active" style="background-color: #efefef; color: #ff7900;" target="_blank" href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug.'#tab4') }}"><span>Dates</span></a>
		          	</li>
		          	<li>
		          		<a class="active" style="background-color: #efefef; color: #ff7900;" target="_blank" href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug.'#tab8') }}"><span>Results</span></a>
		          	</li>
		          	<li>
		          		<a class="active" style="background-color: #efefef; color: #ff7900;" target="_blank" href="{{ URL::to('/examination-details/'.$searchKeyObj->streamSlug.'/'.$searchKeyObj->slug.'#tab16') }}"><span>Questions & Answer</span></a>
		          	</li>
						<li>
                        <a href="javascript:void(0);" onclick="showHideSection('smallSection_{{ $searchKeyObj->id }}', 'bigSecion_{{ $searchKeyObj->id }}', 'moreButton_{{ $searchKeyObj->id }}', 'lessButton_{{ $searchKeyObj->id }}')" class="active btn more_info moreButton_{{ $searchKeyObj->id }}"><i class="fa fa-plus"></i> More Info</a>
                        <a href="javascript:void(0);" onclick="showHideSection('bigSecion_{{ $searchKeyObj->id }}','smallSection_{{ $searchKeyObj->id }}', 'lessButton_{{ $searchKeyObj->id }}', 'moreButton_{{ $searchKeyObj->id }}')" class="active btn more_info lessButton_{{ $searchKeyObj->id }} hide">Less Info</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>