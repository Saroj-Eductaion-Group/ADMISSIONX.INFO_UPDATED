
<style type="text/css">
	.getmoreIn{ color:#f00 !important; font-size:20px !important; }
	.getmoreHeader{ border-bottom:unset !important; }
	.getmoreHeaderTop h2{ font-family: 'Open Sans', sans-serif;  font-size: 22px; font-weight: 700;
	 color: #ff7900; margin:0px 0 10px;}
	.getmoreHeaderTop p{ font-family: 'Open Sans', sans-serif;  font-size:14px; color: #333333; }   
	.modelmoreinput{  font-family: 'Open Sans', sans-serif;  font-size: 14px !important; 
	color:#999999 !important;  border-radius: 4px !important;border: unset !important;  box-shadow: #cfcfcf 0 1px 4px; height: 40px; }
	.modelmoreText a{ font-family: 'Open Sans', sans-serif;  font-size:14px; color:#ff7900; }
	.modelpopmoreButton{ font-family: 'Open Sans', sans-serif; border:none !important; 
   padding: 10px 50px;  font-size:16px; color: #fff; background:#ff7900; }
	.modelpopmoreButton:hover, .modelpopmoreButton:hover{ background:#ff7900 !important; border:#ff7900 !important; box-shadow:unset !important; }

</style>

<div class="overviewRight margin-bottom30">
	<a href="{{ isset($examinationDetailsObj) && $examinationDetailsObj->getMoreInfoLink }}"  target="_blank">get more information</a>
</div>
<div class="overviewRight margin-bottom30">
	<a href="#getmoreinform"  data-toggle="modal" target="_blank">FREE Counselling </a>
</div>


<div class="searchindiaBotNotifi">
	<div class="notificationTop">
		<h2>Notifications</h2>
	</div>
	@foreach( $examNotificationList as $item )
		<div class="notificationBot padding-top20">
			<div class="row">
  				<div class="col-md-2 margin-left15" style="cursor: pointer;">
  					<div class="detailCoursebotIcon">
  						<div style="cursor:pointer;">
      						@if(!empty($item->universitylogo))
      						<a style="cursor:pointer;"  target="_blank" href="{{ URL::to('/examination-details/'.$item->streamSlug.'/'.$item->slug) }}">
      							<img class="" width="40" src="/examinationlogo/{{ $item->universitylogo }}" width="120" alt="{{ $item->universitylogo }}">
      						</a>
      						@else
          					<a style="cursor:pointer;" target="_blank" href="{{ URL::to('/examination-details/'.$item->streamSlug.'/'.$item->slug) }}">
          						<i class="fa fa-university"></i>
          					</a>
          					@endif
  						</div>
  					</div>
  				</div>
  				<div class="col-md-8">
  					<div class="detailCoursebotContent">
  						<a target="_blank" href="{{ URL::to('/examination-details/'.$item->streamSlug.'/'.$item->slug) }}">
  							<h2 style="font-size: 15px !important;">{{ $item->sortname }}</h2>
  						</a>		
  					</div>
  				</div>
  			</div>
			<h2 style="margin-top:0px; font-size: 12px !important;">{{$item->name}}</h2>
			<p style="font-size: 11px !important;">{{$item->universityName}}</p>
			<p style="font-size: 11px !important;">{{$item->title}} 
				<div class="pull-right">
				<a style="font-size:12px;" target="_blank" href="{{ URL::to('/examination-details/'.$item->streamSlug.'/'.$item->slug) }}">Read More.. </a>
				</div>
			</p>
			<hr style="margin-bottom:0px;">
		</div>
	@endforeach
</div>

<div class="detailexamUpcoming margin-top30">
	<div class="notificationTop">
		<h2>UPCOMING EXAMS</h2>
	</div>
	@foreach( $latestExaminationList as $latest => $latestObj)
		<div class="notificationBot">
			<h2>{{ $latestObj->sortname }} - {{$latestObj->name}}</h2>
			<p style="color:#ff7900; font-size:14px;">@if(!empty($latestObj->applicationFrom) &&  !empty($latestObj->applicationTo)) {{ date('d F Y', strtotime($latestObj->applicationFrom)) }} - {{ date('d F Y', strtotime($latestObj->applicationTo)) }} @else Not updated yet @endif</p>
			<p class="text-center padding-right10"><a class="btn btn-xs rounded" style="background:#ff7900; color:#fff; font-size:14px;" target="_blank" href="{{ URL::to('/examination-details/'.$latestObj->streamSlug.'/'.$latestObj->slug) }}">View Details</a></p>
		</div>
		<hr>
  	@endforeach
</div>

<div class="modal fade" id="getmoreinform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      	<div class="modal-content">
        	<div class="modal-header getmoreHeader padding-top20 padding-bottom20">
	        	<div class="row">
	        		<div class="col-md-8">
	        			<div class="row">
	        				<div class="col-md-3">
	        					<img src="/assets/images/govt-exams/get-more-inform-img.png" style="width:100%; ">
	        				</div>
	        				<div class="col-md-9">
			        			<div class="getmoreHeaderTop">
				        			<h2>Register Now To Apply</h2>
				        			<p>{{$typeOfExaminationObj->sortname}} - {{$typeOfExaminationObj->name}}</p> 
			        			</div>
	        				</div>
	        			</div>
	        		</div>
	        		<div class="col-md-4">
	        			<button type="button" class="close popupheaderBtn" data-dismiss="modal" aria-hidden="true">×</button>
	        		</div>
	        	</div>
	        	<hr>
	        	<div class="row">
	        		<div class="col-md-12">
	        			<div class="getmorebottom">
	        				<form method="POST" action="/examination/counselling/forms" data-parsley-validate="">
  								<input type="text" class="form-control modelmoreinput margin-top20" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" placeholder="Full Name" data-parsley-trigger="change" data-parsley-error-message="Please enter your name" data-parsley-pattern="^[a-zA-Z\\/s .-]*$" required="" value="{{ Auth::check() ? Auth::user()->firstname.' '.Auth::user()->middlename.' '.Auth::user()->lastname : ''}}">

    							<input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" name="email" class="form-control modelmoreinput margin-top20" placeholder="Email Address" id="exampleInputPassword1" data-parsley-type="email" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="" value="{{ Auth::check() ? Auth::user()->email : ''}}">

    							<input type="text" name="phone" class="form-control modelmoreinput margin-top20" placeholder="Mobile Number" id="exampleInputPassword1" data-parsley-trigger="change" data-parsley-error-message="Please enter valid mobile number" data-parsley-pattern="^[6-9][0-9]{9}$" minlength="10" maxlength="10" required="" value="{{ Auth::check() ? Auth::user()->phone : ''}}">

    							<input type="hidden" name="misc" value="examination-page">
    							<input type="hidden" name="exam_id" value="{{$examId}}">

    							<select name="city_id" class="js-example-placeholder-single js-states margin-top20 modelmoreinput form-control" required="" data-parsley-trigger="change" data-parsley-error-message="Please select city">
									<option selected="" disabled="">City You Live In</option>
									@foreach($cityListObj as $item)
										<option value="{{ $item->id }}">{{ $item->name }} ({{ $item->stateName }})</option>
									@endforeach
								</select>

								<select name="course_id" class="js-example-placeholder-single js-states margin-top20 modelmoreinput form-control" required="" data-parsley-trigger="change" data-parsley-error-message="Please select course">
									<option selected="" disabled="">Select Interested In Course</option>
									@foreach($cousesListObj as $item)
										<option value="{{ $item->id }}">{{ $item->name }} - {{ $item->degreeName }}</option>
									@endforeach
								</select>
								<button type="submit" class="btn btn-primary modelpopmoreButton margin-top20">Submit</button>
							</form>
	        			</div>
	        		</div>
	        	</div>
          	</div>
        </div>
    </div>
</div>
