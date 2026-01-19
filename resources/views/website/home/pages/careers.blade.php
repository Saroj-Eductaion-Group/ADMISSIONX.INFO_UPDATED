@extends('website/new-design-layouts.master')
@section('styles')

<style type="text/css">
	/*Job
------------------------------------*/
.job-img {
	overflow: hidden;
	position: relative;
	min-height: 300px;
	background: url(/assets/img/bg/11.jpg) 70% 40% no-repeat;
  background-size: cover;
  background-position: center center;	
}

.job-img .job-banner {
	padding: 20px;
	max-width: 450px;
	margin: 60px auto 0px;	
	background: rgba(255,255,255,0.8);
}

.job-img .job-banner h2 {
	font-size: 20px;
	line-height: 27px;
	text-align: center;
	text-transform: uppercase;
}

@media (max-width: 768px) {
	.job-img .job-banner {
		padding: 10px;
		margin: 30px auto 100px;	
	}
}

.job-img .job-img-inputs {
	left: 0;
	right: 0;
	bottom: -7px;
	padding: 20px 0;
	position: absolute;
	background: rgba(0,0,0,0.9);
}

/*Job-Content
------------------------------------*/
.job-content .categories li {
	padding: 6px 0;
	border-bottom: 1px dotted #eee;
}

.job-content .hex {
	color: #999
}

/*High-Rated
------------------------------------*/
.high-rated .carousel-indicators {
	top: 10px;
	left: 65%;
	text-align: right;
}

.high-rated .carousel-indicators .active {
	background: #555;
}

.high-rated .carousel-indicators li {
	border-color: #555;
}

.high-rated .carousel-inner > .item {
	margin: 0;
}

.high-rated .star-vote {
	float: right;
	margin-top: 8px;
}

.high-rated .star-vote ul {
	margin-bottom: 0;
}

.high-rated .star-vote li {
	padding: 0;
}

.job-partners {
    padding-bottom: 50px;
}

/*Our-clients*/
.our-clients {
    margin-bottom: 0;
    text-align: center;
}

.our-clients li {
    padding: 0;
    width: 105px;
    margin: 3px;
    margin-bottom: 6px;
    /* background: #f7f7f7; */
    border: 1px solid #eee;
    border-radius: 2px !important;
}

.our-clients img {
    padding: 15px;
    width: 142px;
    height: auto;
    vertical-align: middle;
}

/*Image-hover*/
figure {
    margin: 0;
    position: relative;
}
figure img {
    z-index: 10;
    height: auto;
    max-width: 100%;
    text-align: center;
    position: relative;
    display: inline-block;
}
figure .img-hover {
    z-index: 5;
    display: block;
    position: absolute;
}
figure h4 {
    color: #fff;
    font-size: 14px;
    font-weight: 600 !important;
}

#effect-2 figure .img-hover {
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    padding: 0 10px;
    line-height: 8.5em;
    text-align: center;
    background-color: #72c02c;
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    -ms-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-transform: rotateY(-180deg);
    -moz-transform: rotateY(-180deg);
    -ms-transform: rotateY(-180deg);
    -o-transform: rotateY(-180deg);
    transform: rotateY(-180deg);
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
    -ms-transition: all 0.5s;
    -o-transition: all 0.5s;
    transition: all 0.5s;
}

.img-hover {}
#effect-2 figure .img-hover h4 {
  font-weight: 200;
  line-height: 24px;
  display: inline-block;
  vertical-align: middle;
}
#effect-2 figure img {
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    -ms-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
    -ms-transition: all 0.5s;
    -o-transition: all 0.5s;
    transition: all 0.5s;
}
.no-touch #effect-2 figure:hover img,
#effect-2 figure.hover img {
    -webkit-transform: rotateY(180deg);
    -moz-transform: rotateY(180deg);
    -ms-transform: rotateY(180deg);
    -o-transform: rotateY(180deg);
    transform: rotateY(180deg);
}
.no-touch #effect-2 figure:hover .img-hover,
#effect-2 figure.hover .img-hover {
    -webkit-transform: rotateY(0);
    -moz-transform: rotateY(0);
    -ms-transform: rotateY(0);
    -o-transform: rotateY(0);
    transform: rotateY(0);
}
</style>
@endsection

@section('content')


		<div class="job-img">
			<div class="job-banner">
				<h2>Discover the reasons you should work for <a herf="/why-work-with-us">AdmissionX</a></h2>
				<p class="text-center"><a class="btn-u" type="button"  data-toggle="modal" data-target="#careerJobModel" data-whatever="" href="">Apply For Job</a></p>
			</div>			
		</div>

		<!-- <div class="container content"> -->
			
			<!-- <div class="headline margin-bottom-35"><h2>Highest Rated Jobs</h2></div> -->

			<!-- Easy Blocks v1 -->
			<!-- <div class="row high-rated margin-bottom-20"> -->
				<!-- Easy Block -->
				<!-- <div class="col-md-3 col-sm-6 md-margin-bottom-40">
					<div class="easy-block-v1">
						<div class="easy-block-v1-badge rgba-default">Marketing</div>
						<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<li class="rounded-x" data-target="#carousel-example-generic" data-slide-to="0"></li>
								<li class="rounded-x" data-target="#carousel-example-generic" data-slide-to="1"></li>
								<li class="rounded-x active" data-target="#carousel-example-generic" data-slide-to="2"></li>
							</ol>
							<div class="carousel-inner">
								<div class="item">
									<img alt="" src="assets/img/main/img3.jpg">
								</div>
								<div class="item">
									<img alt="" src="assets/img/main/img1.jpg">
								</div>
								<div class="item active">
									<img alt="" src="assets/img/main/img7.jpg">
								</div>
							</div>
						</div>
						<div class="overflow-h">
							<h3>Savoy Hotel London</h3>
							<div class="star-vote pull-right">
								<ul class="list-inline">
									<li><i class="color-green fa fa-star"></i></li>
									<li><i class="color-green fa fa-star"></i></li>
									<li><i class="color-green fa fa-star"></i></li>
									<li><i class="color-green fa fa-star-half-o"></i></li>
									<li><i class="color-green fa fa-star-o"></i></li>
								</ul>
							</div>
						</div>
						<ul class="list-unstyled">
							<li><span class="color-green">Position:</span> Manager / Executive</li>
							<li><span class="color-green">Required:</span> 5 - years of experience</li>
						</ul>
						<a class="btn-u btn-u-sm" href="#">View More</a>
					</div>
				</div> -->
				<!-- End Easy Block -->

				<!-- Easy Block -->
				<!-- <div class="col-md-3 col-sm-6 md-margin-bottom-40">
					<div class="easy-block-v1">
						<div class="easy-block-v1-badge rgba-red">Marketing</div>
						<div id="carousel-example-generic-2" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<li class="rounded-x" data-target="#carousel-example-generic-2" data-slide-to="0"></li>
								<li class="rounded-x active" data-target="#carousel-example-generic-2" data-slide-to="1"></li>
								<li class="rounded-x" data-target="#carousel-example-generic-2" data-slide-to="2"></li>
							</ol>
							<div class="carousel-inner">
								<div class="item">
									<img alt="" src="assets/img/main/img12.jpg">
								</div>
								<div class="item active">
									<img alt="" src="assets/img/main/img10.jpg">
								</div>
								<div class="item">
									<img alt="" src="assets/img/main/img21.jpg">
								</div>
							</div>
						</div>
						<div class="overflow-h">
							<h3>Thomas Cook Holidays</h3>
							<ul class="list-inline star-vote">
								<li><i class="color-green fa fa-star"></i></li>
								<li><i class="color-green fa fa-star"></i></li>
								<li><i class="color-green fa fa-star"></i></li>
								<li><i class="color-green fa fa-star"></i></li>
								<li><i class="color-green fa fa-star-half-o"></i></li>
							</ul>
						</div>
						<ul class="list-unstyled">
							<li><span class="color-green">Position:</span> Marketing / Advertising</li>
							<li><span class="color-green">Required:</span> 7 - years of experience</li>
						</ul>
						<a class="btn-u btn-u-sm" href="#">View More</a>
					</div>
				</div> -->
				<!-- End Easy Block -->

				<!-- Easy Block -->
				<!-- <div class="col-md-3 col-sm-6 md-margin-bottom-40">
					<div class="easy-block-v1">
						<div class="easy-block-v1-badge rgba-blue">Education</div>
						<div id="carousel-example-generic-3" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<li class="rounded-x" data-target="#carousel-example-generic-3" data-slide-to="0"></li>
								<li class="rounded-x active" data-target="#carousel-example-generic-3" data-slide-to="1"></li>
								<li class="rounded-x" data-target="#carousel-example-generic-3" data-slide-to="2"></li>
							</ol>
							<div class="carousel-inner">
								<div class="item">
									<img alt="" src="assets/img/main/img4.jpg">
								</div>
								<div class="item active">
									<img alt="" src="assets/img/main/img14.jpg">
								</div>
								<div class="item">
									<img alt="" src="assets/img/main/img8.jpg">
								</div>
							</div>
						</div>
						<div class="overflow-h">
							<h3>University of Aberdeen</h3>
							<ul class="list-inline star-vote">
								<li><i class="color-green fa fa-star"></i></li>
								<li><i class="color-green fa fa-star"></i></li>
								<li><i class="color-green fa fa-star"></i></li>
								<li><i class="color-green fa fa-star-o"></i></li>
								<li><i class="color-green fa fa-star-o"></i></li>
							</ul>
						</div>
						<ul class="list-unstyled">
							<li><span class="color-green">Position:</span> Education / Training</li>
							<li><span class="color-green">Required:</span> 10 - years of experience</li>
						</ul>
						<a class="btn-u btn-u-sm" href="#">View More</a>
					</div>
				</div> -->
				<!-- End Easy Block -->

				<!-- Easy Block -->
				<!-- <div class="col-md-3 col-sm-6">
					<div class="easy-block-v1">
						<div class="easy-block-v1-badge rgba-purple">IT Management</div>
						<div id="carousel-example-generic-4" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<li class="rounded-x" data-target="#carousel-example-generic-4" data-slide-to="0"></li>
								<li class="rounded-x active" data-target="#carousel-example-generic-4" data-slide-to="1"></li>
								<li class="rounded-x" data-target="#carousel-example-generic-4" data-slide-to="2"></li>
							</ol>
							<div class="carousel-inner">
								<div class="item">
									<img alt="" src="assets/img/main/img20.jpg">
								</div>
								<div class="item active">
									<img alt="" src="assets/img/main/img23.jpg">
								</div>
								<div class="item">
									<img alt="" src="assets/img/main/img25.jpg">
								</div>
							</div>
						</div>
						<div class="overflow-h">
							<h3>IT Project Management</h3>
							<ul class="list-inline star-vote">
								<li><i class="color-green fa fa-star"></i></li>
								<li><i class="color-green fa fa-star"></i></li>
								<li><i class="color-green fa fa-star"></i></li>
								<li><i class="color-green fa fa-star"></i></li>
								<li><i class="color-green fa fa-star-o"></i></li>
							</ul>
						</div>
						<ul class="list-unstyled">
							<li><span class="color-green">Position:</span> Project / Program Management</li>
							<li><span class="color-green">Required:</span> 2 - years of experience</li>
						</ul>
						<a class="btn-u btn-u-sm" href="#">View More</a>
					</div>
				</div> -->
				<!-- End Easy Block -->
			<!-- </div> -->
			<!-- End Easy Blocks v1 -->

			<!-- <div class="clearfix margin-bottom-20"><hr></div> -->

			<!-- Easy Blocks v2 -->
			<!-- <div class="row"> -->
				<!-- Begin Easy Block -->
				<!-- <div class="col-md-3 col-sm-6 md-margin-bottom-40">
					<div class="easy-block-v2">
						<div class="easy-bg-v2 rgba-default">New</div>
						<img alt="" src="assets/img/main/img9.jpg">
						<h3>UBS Headquarter Zürich</h3>
						<ul class="list-unstyled">
							<li><span class="color-green">Position:</span> Manager / Executive</li>
							<li><span class="color-green">Required:</span> 5 - years of experience</li>
							<li><span class="color-green">Gender:</span> Male</li>
						</ul>
						<a class="btn-u btn-u-sm" href="#">View More</a>
					</div>
				</div> -->
				<!-- End Begin Easy Block -->

				<!-- Begin Easy Block -->
				<!-- <div class="col-md-3 col-sm-6 md-margin-bottom-40">
					<div class="easy-block-v2">
						<div class="easy-bg-v2 rgba-red">New</div>
						<img alt="" src="assets/img/main/img18.jpg">
						<h3>Royal Dutch Shell</h3>
						<ul class="list-unstyled">
							<li><span class="color-green">Position:</span> Marketing / Advertising</li>
							<li><span class="color-green">Required:</span> 7 - years of experience</li>
							<li><span class="color-green">Gender:</span> Any</li>
						</ul>
						<a class="btn-u btn-u-sm" href="#">View More</a>
					</div>
				</div> -->
				<!-- End Begin Easy Block -->

				<!-- Begin Easy Block -->
				<!-- <div class="col-md-3 col-sm-6 md-margin-bottom-40">
					<div class="easy-block-v2">
						<div class="easy-bg-v2 rgba-blue">New</div>
						<img alt="" src="assets/img/main/img26.jpg">
						<h3>University of Warwick</h3>
						<ul class="list-unstyled">
							<li><span class="color-green">Position:</span> Education / Training</li>
							<li><span class="color-green">Required:</span> 10 - years of experience</li>
							<li><span class="color-green">Gender:</span> Male</li>
						</ul>
						<a class="btn-u btn-u-sm" href="#">View More</a>
					</div>
				</div> -->
				<!-- End Begin Easy Block -->

				<!-- Begin Easy Block -->
				<!-- <div class="col-md-3 col-sm-6">
					<div class="easy-block-v2">
						<div class="easy-bg-v2 rgba-purple">New</div>
						<img alt="" src="assets/img/main/img19.jpg">
						<h3>IT Project Management</h3>
						<ul class="list-unstyled">
							<li><span class="color-green">Position:</span> Project / Program Management</li>
							<li><span class="color-green">Required:</span> 2 - years of experience</li>
							<li><span class="color-green">Gender:</span> Female</li>
						</ul>
						<a class="btn-u btn-u-sm" href="#">View More</a>
					</div>
				</div> -->
				<!-- End Begin Easy Block -->
			<!-- </div> -->
			<!-- End Easy Blocks v2 -->
		<!-- </div> -->

		
		
<div class="modal fade" id="careerJobModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			{!! Form::open(['url' => 'apply-for-job','method' => 'POST','class' => 'sky-form' ,'role'=>'form','id'=>'sky-form4', 'data-parsley-validate' => '','enctype' => 'multipart/form-data']) !!}
				<div class="modal-header modal-header-design" style="background:#b52411;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="exampleModalLabel" style="color: #fff;">Apply for job</h4>
				</div>
				<p class="duplicateEmaill text-danger"></p>
				
				<div class="modal-body">
					
					<div class="margin-bottom-20">
						<!-- <span class="input-group-addon rounded-left"><i class="icon-user color-green"></i></span> -->
						<label>Name</label>
						<input class="form-control rounded-right" type="text" name="firstname" placeholder="Enter your name here" data-parsley-trigger="change" data-parsley-error-message="Please enter your name" data-parsley-pattern="^[a-zA-Z\\/s .-]*$" required="">
					</div>
					<!-- <div class="margin-bottom-20">
						<label>Middle Name</label>
						<input class="form-control" type="text" name="middlename" placeholder="Enter middle name here" data-parsley-trigger="change" data-parsley-error-message="Please enter your middle name" data-parsley-pattern="^[a-zA-Z\\/s .-]*$">
					</div>
					<div class="margin-bottom-20">
						<label>Last Name</label>
						<input class="form-control" type="text" name="lastname" placeholder="Enter last name here" data-parsley-pattern="^[a-zA-Z\\/s .-]*$" data-parsley-trigger="change" data-parsley-error-message="Please enter your last name" required="">
					</div> -->
					<div class="margin-bottom-20">
						<!-- <span class="input-group-addon rounded-left"><i class="icon-envelope color-green"></i></span> -->
						<label>Email Address</label>
						<input class="form-control" type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" name="email" placeholder="Enter email here" data-parsley-type="email" placeholder="" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="">
					</div>
					<div class="margin-bottom-20">
						<!-- <span class="input-group-addon rounded-left"><i class="icon-call-end color-green"></i></span> -->
						<label>Phone Number</label>
						<input type="text" class="form-control" name="phonenumber" placeholder="Enter phone number here" data-parsley-trigger="change"  data-parsley-error-message="Please enter valid mobile nubmer" required=""> <!--  data-parsley-pattern="^[7-9][0-9]{9}$" data-parsley-length="[8, 11]" -->
					</div>
					<div class="margin-bottom-20">
						<!-- <span class="input-group-addon rounded-left"><i class="icon-calendar color-green"></i></span> -->
						<label>Date Of Birth</label>
						<input type="date" class="form-control" name="dateOfBirth" placeholder="Enter date of birth here" required=""  data-parsley-error-message = "Please enter your date of birth"  data-parsley-trigger="change">
					</div>
					<div class="margin-bottom-20">
						<!-- <span class="input-group-addon rounded-left"><i class="icon-users color-green"></i></span> -->
						<label>Gender</label>
						<select name="gender" class="form-control" data-placeholder="Choose sex ..." data-parsley-error-message=" Please select sex " data-parsley-trigger="change" required="">
	                        <option value="" selected disabled >Select Sex</option>
	                        <option value="Male">Male</option>
	                        <option value="Female">Female</option>
	                    </select>
					</div>
					<!-- <div class="margin-bottom-20">
						<label>Address</label>
						<input class="form-control" type="text" name="address" placeholder="Enter address here" data-parsley-trigger="change" data-parsley-error-message="Please enter your address" required="">
					</div>
					<div class="margin-bottom-20">
						<label>Pincode</label>
						<input class="form-control" type="text" name="pincode" placeholder="Enter pincode here" data-parsley-pattern="^[0-9]*$" data-parsley-trigger="change" data-parsley-error-message="Please enter your pincode" required="">
					</div>
					<div class="margin-bottom-20">
						<label>State Name</label>
						<select name="stateName" class="form-control stateName" id="stateName" data-parsley-trigger="change" data-parsley-error-message="Please select your state" required="">
	                        <option value="" selected disabled>Select state</option>  
	                        @foreach ($stateNameObj as $state)
	                            <option value="{{ $state->id }}">{{ $state->name }}</option>
	                        @endforeach         
	                    </select>
					</div>
					<div class="margin-bottom-20">
						<label>City Name</label>
						<select name="city_id" class="form-control cityName" data-parsley-trigger="change" data-parsley-error-message="Please select your city" required="">
	                        <option value="" selected disabled>Select city</option>  
	                           
	                    </select>
					</div>
						@foreach ($cityNameObj as $city)
	                            <option value="{{ $city->id }}">{{ $city->name }}</option>
	                        @endforeach       -->
					<div class="margin-bottom-20">
						<!-- <span class="input-group-addon rounded-left"><i class="icon-user color-green"></i></span> -->
						<label>Post For Applied</label>
						<input class="form-control" type="text" name="postappliedfor" placeholder="Enter post here"  data-parsley-trigger="change" data-parsley-error-message="Please enter post" required="" data-parsley-pattern="^[a-zA-Z0-9\\/s ().,-]*$">
					</div>
					<div class="row margin-bottom-20">
						<div class="col-md-12">
							<label>Upload Your CV</label>
							<label for="file" class="input input-file">
								<span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh2"class="hide"><i class="fa fa-remove"></i></a> </span>
								<div class=""><input type="file" name="cv" class="cvFile" onchange="this.parentNode.nextSibling.value = this.value" data-parsley-trigger="change"></div>
							</label>
							<p class="text-danger hide" id="cvDoc">(please upload .jpg, .jpeg, .png, .doc, .docx and .pdf file only)</p>
						</div>
					</div>		
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<button type="submit" class="btn-u btn-block rounded"><i class="fa fa-spinner fa-pulse hide" id="loader"></i> Apply Now</button>
						</div>
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection

@section('scripts')
{!! Html::script('assets/js/jquery.min.js') !!}
{!! Html::script('assets/js/parsley.min.js') !!}
 <script type="text/javascript">
    $(document).ready(function(){   

	    $('.cvFile').on('change',function(){
	        $('#refresh2').removeClass('hide');
	    });
	    $('#refresh2').on('click',function(e){
	        $('.cvFile').val('').trigger('chosen:updated');
	        $('#refresh2').addClass('hide');
	    });


	    $('input[name=cv]').change(function (e)
		{  
			var ext = $('input[name=cv]').val().split('.').pop().toLowerCase();
			if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf' || ext == 'doc' || ext == 'docx'){
				$('#cvDoc').addClass('hide');
			}else{
				$('input[name=cv]').val('');
				$('#cvDoc').removeClass('hide');
				return false;
			}
			//Disable input file
		});

		$('.stateName').on('change', function(){
            var stateId = $(this).val();
            var HTML = '';
            $.ajax({
                headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
                },
                method: "GET",
                data: { stateId: stateId },
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                url: "{{ URL::to('/getAllCityNameData') }}",
                success: function(data) {
                    $.each(data.cityData, function(key, value) {
                        HTML += '<option value='+data.cityData[key].id+'>'+data.cityData[key].name+'</option>';
                    });
                    $('.cityName').html(HTML);
                    $('.cityName').trigger("chosen:updated");
                }
            });
        });

	});
   
</script>

@endsection