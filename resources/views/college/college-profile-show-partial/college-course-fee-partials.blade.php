<div class="profile-edit tab-pane fade in active tag-box tag-box-v7">
	<div class="detail-page-signup margin-bottom40 tag-box tag-box-v7 table-responsive">
		<div class="headline"><h2>College Highlights</h2></div>
		<h5 class="h5">The institute offers undergraduate, postgraduate and doctoral programs. All the programs are examined below :</h5>
		<br>
		<!-- Updated Course List -->
		@if( $getCourseListCount > 0 )
			{{--*/ $counterVal = 0 /*--}}
			@foreach( $getCollegeMasterCoursesObj as $index => $getUpdatedCourses )
			{{--*/ $counterVal = $index /*--}}
				<div class="col-md-6 md-margin-bottom-40 margin-top10">
					<div class="funny-boxes funny-boxes-colored collegecoursebox
					@if (substr($getUpdatedCourses->collegemasterId, -1) == 0) funny-boxes-red 
					@elseif(substr($getUpdatedCourses->collegemasterId, -1) == 1) funny-boxes-blue 
					@elseif(substr($getUpdatedCourses->collegemasterId, -1) == 2) funny-boxes-sea 
					@elseif(substr($getUpdatedCourses->collegemasterId, -1) == 3) funny-boxes-grey 
					@elseif(substr($getUpdatedCourses->collegemasterId, -1) == 4) bg-color-brown 
					@elseif(substr($getUpdatedCourses->collegemasterId, -1) == 5) funny-boxes-purple 
					@elseif(substr($getUpdatedCourses->collegemasterId, -1) == 6) bg-color-orange  
					@elseif(substr($getUpdatedCourses->collegemasterId, -1) == 7) bg-color-teal 
					@elseif(substr($getUpdatedCourses->collegemasterId, -1) == 8) bg-color-darker  
					@elseif(substr($getUpdatedCourses->collegemasterId, -1) == 9) bg-color-light-green
					@else funny-boxes-sea @endif">
						<div class="row">
							<div class="col-md-4 funny-boxes-img">
								@if($getUpdatedCourses->functionalareaName)
								<h2 class="collegecourse"><a href="#">
									@if($getUpdatedCourses->functionalareaName)
										{{ $getUpdatedCourses->functionalareaName }}
									@else
										--
									@endif</a>
								</h2>
								@endif
								<ul class="list-unstyled">
									@if($getUpdatedCourses->courseName)
									<li><i class="fa-fw fa fa-book"></i>Course : 
										@if($getUpdatedCourses->courseName)
											{{ $getUpdatedCourses->courseName }}
										@else
											--
										@endif
									</li>
									@endif
									@if($getUpdatedCourses->degreeName)
									<li><i class="fa-fw fa  fa-graduation-cap"></i>Degree : 
										@if($getUpdatedCourses->degreeName)
											{{ $getUpdatedCourses->degreeName }}
										@else
											--
										@endif
									</li>
									@endif
								</ul>
							</div>
							<div class="col-md-5">
								@if($getUpdatedCourses->educationlevelName)
								<h2 class="collegecourse">
									<a href="#">Degree Level : 
									@if($getUpdatedCourses->educationlevelName)
										{{ $getUpdatedCourses->educationlevelName }}
									@else
										--
									@endif</a>
								</h2>
								@endif
								@if($getUpdatedCourses->coursetypeName)
								<p><i class="fa-fw fa fa-arrow-right"></i>Course Type : 
									@if($getUpdatedCourses->coursetypeName)
										{{ $getUpdatedCourses->coursetypeName }}
									@else
										--
									@endif
								</p>
								@endif
								@if($getUpdatedCourses->courseduration != '')
								<p><i class="fa-fw fa fa-arrow-right"></i>Course Duration : 
									@if($getUpdatedCourses->courseduration != '')
										@if(is_numeric($getUpdatedCourses->courseduration))
											@if( $getUpdatedCourses->courseduration == '1' )
												{{ $getUpdatedCourses->courseduration }} Year
											@else
												{{ $getUpdatedCourses->courseduration }} Years
											@endif
										@else
											{{ $getUpdatedCourses->courseduration }}
										@endif
									@else
										--
									@endif
								</p>
								@endif
								@if( $getUpdatedCourses->others )
								<p><i class="fa-fw fa fa-arrow-right"></i>Course Eligibility : 
									@if( $getUpdatedCourses->others )
										{{ $getUpdatedCourses->others }}
									@else
										--
									@endif
								</p>
								@endif
								@if($getUpdatedCourses->twelvemarks)
								<p><i class="fa-fw fa fa-arrow-right"></i>12th Marks : 
									@if($getUpdatedCourses->twelvemarks)
										{{ $getUpdatedCourses->twelvemarks }}
									@else
										--
									@endif
								</p>
								@endif
								
							</div>
							<div class="col-md-3 ">
								<h2 class="collegecourse"><a href="#">Total Fees  <b>₹ 
									@if(  $getUpdatedCourses->fees )
										{{  $getUpdatedCourses->fees }}
									@else
										N/A
									@endif</b></a>
								</h2>
								<p style="margin-top: -10px;">(per year)</p>
								@if( $getUpdatedCourses->agreement == '1' )
									<a class="btn-u btn-u-dark rounded margin-top30 pull-right" target="_blank" href="{{ url('college/detail-course/') }}/{{ $getUpdatedCourses->collegemasterId }}/{{ $slugUrl }}" >Admission</a>
								@endif 
							</div>
						</div>
					</div>
				</div>
			@endforeach
		<table class="table table-hover hidden table-bordered">
			<thead>
				<tr>
					<th>Course Duration</th>
					<th>Degree Level</th>
					<th>Stream</th>
					<th>Degree</th>
					<th>Course Type</th>
					<th>Course</th>
					<th>12th Marks</th>
					<th>Course Eligibility</th>
					<th>Total Fees (per year)</th>
					@if($getCollegeMasterCoursesObj[0]->agreement == '1')
						<th>
							Action 
						</th>
					@endif
				</tr>
			</thead>
			<tbody>
				@foreach( $getCollegeMasterCoursesObj as $index => $getUpdatedCourses )
					<tr>
						<td>
							@if($getUpdatedCourses->courseduration)
								@if(is_numeric($getUpdatedCourses->courseduration))
									@if( $getUpdatedCourses->courseduration == '1' )
										{{ $getUpdatedCourses->courseduration }} Year
									@else
										{{ $getUpdatedCourses->courseduration }} Years
									@endif
								@else
									{{ $getUpdatedCourses->courseduration }}
								@endif
							@else
								--<!-- <span class="label label-warning">Not updated yet</span> -->
							@endif
						</td>
						<td>
							@if($getUpdatedCourses->educationlevelName)
								{{ $getUpdatedCourses->educationlevelName }}
							@else
								--<!-- <span class="label label-warning">Not updated yet</span> -->
							@endif
						</td>
						<td>
							@if($getUpdatedCourses->functionalareaName)
								{{ $getUpdatedCourses->functionalareaName }}
							@else
								--<!-- <span class="label label-warning">Not updated yet</span> -->
							@endif
						</td>
						<td>
							@if($getUpdatedCourses->degreeName)
								{{ $getUpdatedCourses->degreeName }}
							@else
								--<!-- <span class="label label-warning">Not updated yet</span> -->
							@endif
						</td>
						<td>
							@if($getUpdatedCourses->coursetypeName)
								{{ $getUpdatedCourses->coursetypeName }}
							@else
								--<!-- <span class="label label-warning">Not updated yet</span> -->
							@endif
						</td>
						<td>
							@if($getUpdatedCourses->courseName)
								{{ $getUpdatedCourses->courseName }}
							@else
								--<!-- <span class="label label-warning">Not updated yet</span> -->
							@endif
						</td>
						<td>
							@if($getUpdatedCourses->twelvemarks)
								{{ $getUpdatedCourses->twelvemarks }}
							@else
								--<!-- <span class="label label-warning">Not updated yet</span> -->
							@endif
						</td>
					
						<td>
							@if( $getUpdatedCourses->others )
								{{ $getUpdatedCourses->others }}
							@else
								--<!-- <span class="label label-warning">Not updated yet</span> -->
							@endif
						</td>
						<td>
							Rs.
							@if(  $getUpdatedCourses->fees )
								{{  $getUpdatedCourses->fees }}
							@else
								--<!-- <span class="label label-warning">Not updated yet</span> -->
							@endif 
						</td>
						<!-- <td>
							@if(  $getUpdatedCourses->seats )
								<a class="course-details" target="_blank" href="{{ url('college/detail-course/') }}/{{ $getUpdatedCourses->collegemasterId }}/{{ $slugUrl }}" >{{  $getUpdatedCourses->seats }}</a>
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
						</td> -->
						<!-- <td>
							@if( $getUpdatedCourses->seatsallocatedtobya == '0')
								<span class="label label-success">All Seats Full</span>
							@elseif( $getUpdatedCourses->seatsallocatedtobya )
								{{ $getUpdatedCourses->seatsallocatedtobya }}
							@else												
							@endif
						</td> -->
						@if( $getUpdatedCourses->agreement == '1' )
							<td>
							@if ($index % 2 == 0)
							  <a class="btn btn-warning" target="_blank" href="{{ url('college/detail-course/') }}/{{ $getUpdatedCourses->collegemasterId }}/{{ $slugUrl }}" >Admission</a>
							@else
								<a class="btn btn-u" target="_blank" href="{{ url('college/detail-course/') }}/{{ $getUpdatedCourses->collegemasterId }}/{{ $slugUrl }}" >Admission</a>

							@endif
							</td> 
						@endif 
					</tr>
				@endforeach
			</tbody>
		</table>
		@else
			<h5>No courses listed.</h5>
		@endif
		<!-- End -->
		<!-- FORM -->
	</div>
	<!-- END -->
	<div class="detail-page-signup margin-bottom40 tag-box tag-box-v7 table-responsive">
		<div class="headline"><h2>Calender Event Information.</h2></div>
		<br>
		@if( $getEventListCount > 0 )
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Event Name</th>
					<th>Date</th>
					<th>Venue </th>
					<!-- <th>Website</th> -->
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				@foreach( $getCollegeCalender as $getEvents )
					<tr>
						<td>
							@if($getEvents->name)
								{{ $getEvents->name }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
						</td>
						<td>
							@if($getEvents->datetime)
								{{ date('d/m/Y', strtotime($getEvents->datetime)) }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
						</td>
						<td>
							@if($getEvents->venue)
								{{ $getEvents->venue }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
						</td>
						<!-- <td>
							@if($getEvents->link)
								{{ $getEvents->link }}
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
						</td> -->
						<td>
							@if( $getEvents->description )
								<span class="minimize2">{{ $getEvents->description }}</span></p>
							@else
								<span class="label label-warning">Not updated yet</span>
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		@else
			<h5>No event listed.</h5>
		@endif
	</div>
</div>