@extends('administrator/admin-layouts.master')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>College Contacts</h2>
    </div>
</div>
<div class="row">
    <div class="col-md-7 col-md-offset-3 margin-top20">
        @if(Session::has('sendEmailMsg'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>{{ Session::get('sendEmailMsg') }}</strong>
            </div>                        
        @endif
    </div>    
</div>
<div class="ibox-content">
    <div class="row">
        
        <div class="col-md-12 text-right">   
            <!-- <a href="javascript:void(0);" class="btn btn-info exportToExcel hide">Export</a>    -->  
            <a href="javascript:void(0);" class="btn btn-danger resetfilter hide">Reset Filter</a>     
            <a href="javascript:void(0);" class="btn btn-primary filterout">Filter</a>
        </div>
    </div>
    <div class="slideDown" style="visibility:hidden">
         <div class="hr-line-dashed"></div>    
        <form action="/administrator/collegeprofile-info/contact-card" method="GET" class="form-horizontal" data-parsley-validate>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 for="usr">College Name<span class="pull-right"><a href="javascript:void(0);" id="refresh3" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <select class="form-control chosen-select collegeName" name="college" data-parsley-trigger="change" data-parsley-error-message="Please select college">
                                <option value="" disabled="" selected="">Select college</option>
                                @foreach( $collegeProfileObj as $college )
                                    <option value="{{ $college->firstname }}" @if(Request::get('college') == $college->firstname) selected="" @endif>{{ $college->firstname }}</option>
                                @endforeach
                            </select> 
                        </div> 
                        <div class="col-md-4">
                            <h4 for="usr">Email Address<span class="pull-right"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <input type="text" class="form-control userEmailAddress" name="email" placeholder="Enter user email address here" data-parsley-error-message="Please enter valid email address" data-parsley-trigger="change" data-parsley-type="email" value="{{ Request::get('email') }}">
                        </div>  
                        
                        <div class="col-md-4">
                            <h4>College Type
                            <span class="pull-right"> <a href="javascript:void(0);" id="refresh6" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                           <select class="form-control collegetype_id" name="type" data-parsley-trigger="change" data-parsley-error-message="Please select college type">
                                <option value="" disabled="" selected="">Select college type</option>
                                <option value="1" @if(Request::get('type') == '1') selected="" @endif)>Private College</option>
                                <option value="2" @if(Request::get('type') == '2') selected="" @endif)>Government College</option>
                                <option value="3" @if(Request::get('type') == '3') selected="" @endif)>Government University</option>
                                <option value="4" @if(Request::get('type') == '4') selected="" @endif)>Private University</option>
                            </select>
                        </div>    
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="col-md-3">
                            <h4 for="usr">University
                            <span class="pull-right"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <select class="form-control chosen-select university_id" name="university" data-parsley-trigger="change" data-parsley-error-message="Please select university">
                                <option value="" disabled="" selected="">Select university</option>
                                @foreach( $universityObj as $university )
                                    <option value="{{ $university->id }}" @if(Request::get('university') == $university->id) selected="" @endif>{{ $university->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <h4 for="usr">Review<span class="pull-right"><a href="javascript:void(0);" id="refresh5" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <select name="review" class="form-control  review" data-placeholder="Choose review ..."  data-parsley-error-message=" Please select review " data-parsley-trigger="change" >
                                <option value="" selected disabled >Select Review</option>
                                <option value="1" @if(Request::get('review') == '1' ) selected="" @endif>Reviewed</option>
                                <option value="0" @if(Request::get('review') == '0') selected="" @endif>Not Reviewed</option>
                            </select>
                            
                        </div>    
                        <div class="col-md-3">                                    
                            <h4 for="usr">Agreement<span class="pull-right"><a href="javascript:void(0);" id="refresh4" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                           <select name="agreement" class="form-control agreement " data-placeholder="Choose agreement ..."  data-parsley-error-message=" Please select agreement " data-parsley-trigger="change" >
                                <option value="" selected disabled >Select Agreement</option>
                                <option value="1" @if(Request::get('agreement') == '1') selected="" @endif>Yes</option>
                                <option value="0" @if(Request::get('agreement') == '0') selected="" @endif>No  </option>
                            </select>                              
                        </div>  
                        <div class="col-md-3">                                    
                            <h4 for="usr">Verified<span class="pull-right"><a href="javascript:void(0);" id="refresh7" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                           <select name="verified" class="form-control verified " data-placeholder="Choose verified ..."  data-parsley-error-message=" Please select verified " data-parsley-trigger="change" >
                                <option value="" selected disabled >Select Verified</option>
                                <option value="1" @if(Request::get('verified') == '1') selected="" @endif>Verified</option>
                                <option value="0" @if(Request::get('verified') == '0') selected="" @endif>Not Verified</option>
                            </select>                            
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="col-md-3">
                            <h4 for="usr">Address Type<span class="pull-right"><a href="javascript:void(0);" id="refresh12" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <select class="form-control  addresstype_id" name="address" data-parsley-trigger="change" data-parsley-error-message="Please select address type">
                                <option value="" disabled="" selected="">Select address type</option>
                                <option value="1" @if(Request::get('address') == '1') selected="" @endif>Registered Address</option>
                                <option value="2" @if(Request::get('address') == '2') selected="" @endif>Campus Address</option>       
                            </select> 
                        </div> 
                       <div class="col-md-3">
                            <h4 for="usr">Country Name<span class="pull-right"><a href="javascript:void(0);" id="refresh8" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <select name="country" class="form-control chosen-select countryName">
                                <option selected="" disabled="">Country</option>
                                @if( $countryObj )
                                    <option value="99">India</option>
                                    @foreach( $countryObj as $item )
                                        @if( $item->id == '99' )
                                            <option value="99" @if(Request::get('country') == '99') selected="" @endif>{{ $item->name }}</option>
                                        @else
                                            <option value="{{ $item->id }}" @if(Request::get('country') == $item->id) selected="" @endif>{{ $item->name }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div> 
                        <div class="col-md-3">
                            <h4 for="usr">Select State<span class="pull-right"><a href="javascript:void(0);" id="refresh14" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <select name="state" class="form-control chosen-select stateName" id="stateName" data-parsley-trigger="change" data-parsley-error-message="Please select state name">
                                <option selected="" disabled="">Select state name</option>                                
                                @if( Request::has('country') )
                                    {{--*/ $getStateId = DB::table('state')
                                                        ->where('country_id', '=', Request::get('country'))
                                                        ->select('id', 'name')
                                                        ->orderBy('name', 'ASC')
                                                        ->get(); 
                                    /*--}}
                                    @foreach($getStateId as $item)
                                        <option value="{{ $item->id }}" @if(Request::get('state') == $item->id) selected="" @endif>{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                      
                        <div class="col-md-3">
                            <h4 for="usr">City<span class="pull-right"><a href="javascript:void(0);" id="refresh13" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                            <select class="form-control chosen-select city_id cityName" name="city" data-parsley-trigger="change" data-parsley-error-message="Please select city">
                                <option value="" disabled="" selected="">Select city</option>
                                 @if( Request::has('state') )
                                    {{--*/ $getCityId = DB::table('city')
                                                        ->where('state_id', '=', Request::get('state'))
                                                        ->select('id', 'name')
                                                        ->orderBy('name', 'ASC')
                                                        ->get(); 
                                    /*--}}
                                    @foreach($getCityId as $item)
                                        <option value="{{ $item->id }}" @if(Request::get('state') == $item->id) selected="" @endif>{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select> 
                        </div>
                        
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="col-md-12 text-right">      
                        <a href="{{ URL::to('administrator/collegeprofile-info/contact-card') }}" class="btn btn-default btn-sm">Close</a>
                        <button class="btn btn-primary btn-sm">Search</button>                                            
                    </div>  
                </div>  
            </div>   
        </form>     
    </div>  
    <div class="hr-line-dashed"></div>
    <div> <!-- table-responsive -->
        <label class="pull-right hide returnHide">Total Result :- <span class="" id="returnCountResult"></span></label>
        @if( $collegeprofile == '0' )
            <input type="text" class="result-zero hide" value="{{ $collegeprofile }}">
            <h2 class="message-no-match center-block">No Result Found!</h2>
        @else
       	<div class="wrapper wrapper-content animated bounceInRight">
			<div class="row filtercard">
				@foreach( $collegeprofile as $item )
				<div class="col-lg-4">
					<div class="contact-box">
					    <a href="{{ url('/administrator/collegeprofile', $item->id) }}">
					    <div class="col-sm-4">
					        <div class="text-center">
					        	@if( $item->galleryName )
					            	<img alt="image" class="img-circle m-t-xs img-responsive" src="{{asset('gallery/')}}/{{ $item->slug }}/{{ $item->galleryName }}">
				            	@else
				            		<img alt="image" class="img-circle m-t-xs img-responsive" src="{{asset('assets/images/')}}/no-college-logo.png">
				            	@endif
					            <div class="m-t-xs font-bold">{{ $item->collegetypeName }}</div>
					        </div>
					    </div>
					    <div class="col-sm-8">
					        <h3><strong>{{ $item->firstname }}</strong></h3>
					        @if(!empty($item->universityName))
					        	<p><i class="fa fa-building"></i> {{$item->universityName}}</p>
					        @endif
					        <address>
					        	@if( $item->address1 )
				        			<br>
				        			<strong>{{ $item->address1 }}</strong><br>
						            {{ $item->address2 }} {{ $item->landmark }}<br>
						            {{ $item->cityName }}, {{ $item->stateName }} {{ $item->postalcode }}<br>
				        		@endif			            
					            <a href="mailto:{{$item->email}}" class="word-wrap-text"><abbr title="Email">E:</abbr> {{ $item->email }}</a><br>
					            <abbr title="Phone">P:</abbr> {{ $item->phone }}
					        </address>
					        <a href="{{ url('/administrator/sendWelcomeEmail/' . $item->id) }}">
		                        <button type="submit" class="btn btn-outline btn-sm btn-primary">Send welcome email</button>
		                    </a>
					    </div>
					    <div class="clearfix"></div>
					        </a>
					</div>
				</div>
				@endforeach
			</div>
			<div class="row indexPagination">
		        <div class="col-md-12">
		            <div class="pull-right custom-pagination">{!! $collegeprofile->appends(\Input::except('page'))->render() !!}</div>
		        </div>
		    </div>
		</div>
        @endif
        <input type="text" class="totalReturnRow hide" value="">

        <div class="spiner-example hide text-center">
            <div class="sk-spinner sk-spinner-three-bounce">
                <div class="sk-bounce1"></div>
                <div class="sk-bounce2"></div>
                <div class="sk-bounce3"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <p class="message-no-match center-block label label-danger hide">No Match Found!</p>
            </div>
        </div>

        <div class="row numPage hide text-right">
            <div class="col-md-12 pull-right">
                <ul class="pagination"><li><span class="currentCounter"></span></li></ul>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
   <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            
            $('.addresstype_id').on('change', function(){
                var addressTypeId = $(this).val();
                $('.countryHide').css('visibility', 'visible');
            });

            //Activate Chosen for Select
            $(".chosen-select").chosen({
                placeholder_text_single: "Select an option",
                no_results_text: "Oops, nothing found!"
            });
            $('.slideDown').hide();
            $('.filterout').on('click',function(){
                $(".slideDown").toggle();
                $(".slideDown").css('visibility', 'visible');
                $(".resetfilter").addClass('hide');
                $(".exportToExcel").addClass('hide');
            });
            var resultZeroValue = $('.result-zero').val();
            if( resultZeroValue == '0' ){
                $('.filterout').addClass('hide');
            }
          

            $('.university_id').on('change',function(){
                $('#refresh1').removeClass('hide');
            });
            $('#refresh1').on('click',function(e){
                $('.university_id').val('').trigger('chosen:updated');
                $('#refresh1').addClass('hide');
            });


            $('.userEmailAddress').on('blur',function(){
                $('#refresh2').removeClass('hide');
            });
            $('#refresh2').on('click',function(e){
                $('.userEmailAddress').val('');
                $('#refresh2').addClass('hide');
            });

            $('.collegeName').on('change',function(){
                $('#refresh3').removeClass('hide');
            });
            $('#refresh3').on('click',function(e){
                $('.collegeName').val('').trigger('chosen:updated');
                $('#refresh3').addClass('hide');
            });

            $('.agreement').on('change',function(){
                $('#refresh4').removeClass('hide');
            });
            $('#refresh4').on('click',function(e){
                $('.agreement').val('').trigger('chosen:updated');
                $('#refresh4').addClass('hide');
            });
            
            $('.review').on('change',function(){
                $('#refresh5').removeClass('hide');
            });
            $('#refresh5').on('click',function(e){
                $('.review').val('').trigger('chosen:updated');
                $('#refresh5').addClass('hide');
            });

            $('.collegetype_id').on('change',function(){
                $('#refresh6').removeClass('hide');
            });
            $('#refresh6').on('click',function(e){
                $('.collegetype_id').val('').trigger('chosen:updated');
                $('#refresh6').addClass('hide');
            });

            $('.verified').on('change',function(){
                $('#refresh7').removeClass('hide');
            });
            $('#refresh7').on('click',function(e){
                $('.verified').val('').trigger('chosen:updated');
                $('#refresh7').addClass('hide');
            });

            $('.addresstype_id').on('change',function(){
                $('#refresh12').removeClass('hide');
            });
            $('#refresh12').on('click',function(e){
                $('.addresstype_id').val('').trigger('chosen:updated');
                $('#refresh12').addClass('hide');
                $('.country_id').val('').trigger('chosen:updated');
                $('#refresh8').addClass('hide');
                $('.stateName').val('').trigger('chosen:updated');
                $('#refresh14').addClass('hide');
                $('.city_id').val('').trigger('chosen:updated');
                $('#refresh13').addClass('hide');
            });

            $('.city_id').on('change',function(){
                $('#refresh13').removeClass('hide');
            });
            $('#refresh13').on('click',function(e){
                $('.city_id').val('').trigger('chosen:updated');
                $('#refresh13').addClass('hide');
            });

            $('.stateName').on('change',function(){
                $('#refresh14').removeClass('hide');
            });
            $('#refresh14').on('click',function(e){
                $('.stateName').val('').trigger('chosen:updated');
                $('#refresh14').addClass('hide');
                $('.city_id').val('').trigger('chosen:updated');
                $('#refresh13').addClass('hide');
            });

            $('.country_id').on('change',function(){
                $('#refresh8').removeClass('hide');
            });
            $('#refresh8').on('click',function(e){
                $('.country_id').val('').trigger('chosen:updated');
                $('#refresh8').addClass('hide');
                $('.stateName').val('').trigger('chosen:updated');
                $('#refresh14').addClass('hide');
                $('.city_id').val('').trigger('chosen:updated');
                $('#refresh13').addClass('hide');
            });
        });  
    </script>
    
    <script type="text/javascript">
        $('.countryName').on('change', function(){
                
            $('.stateHide').css('visibility', 'visible');
            var countryID = $(this).val();
            $.ajax({
                headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
                },
                method: "GET",
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: {countryID: countryID},
                url: "{{ URL::to('getAllStateName') }}",
                success: function(data) {
                    var HTML = '';
                    HTML += '<option selected="" disabled="">State</option>';
                    if( data.code == '200' ){
                        $.each(data.stateObj, function(i, item) {
                            HTML += '<option value="'+data.stateObj[i].stateId+'">'+data.stateObj[i].name+'</option>';
                        }); 
                    }else{
                        HTML += '<option selected="" disabled="">No state available</option>';
                    }

                    $('.stateName').empty();
                    $('.stateName').html(HTML);
                    $('.stateName').trigger('chosen:updated');
                }
            });
        });

        $('.stateName').on('change', function(){
            var currentID = $(this).val();
            $('.cityHide').css('visibility', 'visible');
            $.ajax({
                headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
                },
                method: "GET",
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: {currentID: currentID},
                url: "{{ URL::to('getAllCityName') }}",
                success: function(data) {
                    var HTML = '';
                    HTML += '<option selected="" disabled="">City</option>';
                    if( data.code == '200' ){
                        $.each(data.cityObj, function(i, item) {
                            HTML += '<option value="'+data.cityObj[i].cityId+'">'+data.cityObj[i].name+'</option>';
                        }); 
                    }else{
                        HTML += '<option selected="" disabled="">No city available</option>';
                    }

                    $('.cityName').empty();
                    $('.cityName').html(HTML);
                    $('.cityName').trigger('chosen:updated');
                }
            });
        });
    </script>
   
@endsection