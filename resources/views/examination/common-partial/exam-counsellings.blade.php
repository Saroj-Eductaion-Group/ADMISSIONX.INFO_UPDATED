<form class="margin-top20" method="post" action="/update/exam-counselling-procedure/{{$examId}}" data-parsley-validate="">
	@foreach($examDegreeObj as $item)
	{{--*/ $flag2 = '0' /*--}}
    <div class="row">
    	<div class="col-lg-12 margin-top20">
    		<div class="panel panel-warning">
                <div class="panel-heading">
                    <i class="fa fa-edit"></i> {{$item->degreeName}} counselling procedure
                </div>
                <hr>
        		<input type="hidden" class="form-control" value="{{$item->degreeName}}" name="degreeName[]">
        		<input type="hidden" class="form-control" value="{{$item->degreeId}}" name="degreeId[]">
        		<div class="panel-body">
		        @foreach( $examCounsellingsObj as $key)                                    
		            @if( $key->degreeId == $item->degreeId )
		                
	                	<div class="row">
	                		<div class="col-md-6">
								<label>Mode of exam</label>
					            <select class="form-control text-capitalize" name="modeofcounselling[]" data-parsley-error-message="Please select mode of counselling">
					                <option disabled="" selected="">Please select</option>
					                <option value="1"  @if($key->modeofcounselling == 1) selected="" @endif>Online</option>
					                <option value="2"  @if($key->modeofcounselling == 2) selected="" @endif>Offline</option>
					            </select>
							</div>
	                	</div>
	                	<hr>
	                	<div class="row">
							<div class="col-md-12">
								<label>Website Link</label>
								<input id="websiteLink" name="websiteLink[]" class="form-control websiteLink" type="url" @if($key->websiteLink) value="{{ $key->websiteLink or ''}}" @else value="" @endif  placeholder="Please website link"  data-parsley-error-message="Please website link">
							</div>
	                	</div>
	                	<hr>
	                	<div class="row">
							<div class="col-md-12">
								<label>Description</label>
								<textarea class="form-control summernote description" id="description"  placeholder="Enter description." name="description[]">@if($key->description) {{ $key->description or ''}} @endif</textarea>
							</div>
	                	</div>
	                	<hr>
	                	<div class="row">
							<div class="col-md-12">
								<label>Counselling Procedure</label>
								<textarea class="form-control summernote counsellingProcedure" id="counsellingProcedure"  placeholder="Enter counselling procedure." name="counsellingProcedure[]">@if($key->counsellingProcedure) {{ $key->counsellingProcedure or ''}} @endif</textarea>
							</div>
	                	</div>
	                	<hr>
	                	<div class="row">
							<div class="col-md-12">
								<label>Documents Required</label>
								<textarea class="form-control summernote documentsRequired" id="documentsRequired"  placeholder="Enter description." name="documentsRequired[]">@if($key->documentsRequired) {{ $key->documentsRequired or ''}} @endif</textarea>
							</div>
	                	</div>
		                {{--*/ $flag2 = '1' /*--}}
		            @endif
		        @endforeach
		        @if( $flag2 == '0' )
                	<div class="row">
                		<div class="col-md-12">
							<label>Mode of Counselling</label>
				            <select class="form-control text-capitalize" name="modeofcounselling[]" data-parsley-error-message="Please select mode of counselling">
				                <option disabled="" selected="">Please select</option>
				                <option value="1">Online</option>
				                <option value="2">Offline</option>
				            </select>
						</div>
                	</div>
                	<hr>
                	<div class="row">
						<div class="col-md-12">
							<label>Website Link</label>
							<input id="websiteLink" name="websiteLink[]" class="form-control websiteLink" type="url" value="" placeholder="Please website link"  data-parsley-error-message="Please website link">
						</div>
                	</div>
                	<hr>
                	<div class="row">
						<div class="col-md-12">
							<label>Description</label>
							<textarea class="form-control summernote description" id="description"  placeholder="Enter description." name="description[]"></textarea>
						</div>
                	</div>
                	<hr>
                	<div class="row">
						<div class="col-md-12">
							<label>Counselling Procedure</label>
							<textarea class="form-control summernote counsellingProcedure" id="counsellingProcedure"  placeholder="Enter counselling procedure." name="counsellingProcedure[]"></textarea>
						</div>
                	</div>
                	<hr>
                	<div class="row">
						<div class="col-md-12">
							<label>Documents Required</label>
							<textarea class="form-control summernote documentsRequired" id="documentsRequired"  placeholder="Enter description." name="documentsRequired[]"></textarea>
						</div>
                	</div>
		        @endif
		        	<hr>
					<div class="row margin-bottom10">
					    <div class="col-md-8">
					        <h3 class="text-uppercase text-success">List of Counselling dates</h3>
					    </div>
					    <div class="col-md-4">
					        <a href="javascript:void(0);" class="btn btn-block btn-sm btn-success" id="addApplicationFeeRow{{$item->degreeId}}"><i class="fa fa-plus"></i> Add counselling dates</a>
					    </div>
					</div>
					<div class="row">
					    <div class="col-md-12">
					        <table class="table table-bordered table-hover">
					            <thead>
					                <tr>
					                    <th>Mode of Counselling</th>
					                    <th>Event Name </th>
					                    <th>Event Date</th>
					                    <th>Action</th>
					                </tr>
					            </thead>
					            <tbody class="tableApplicationFeesSection{{$item->degreeId}}">
					            	@foreach($examCounsellingDatesObj as $obj)
					            		@if( $obj->degreeId == $item->degreeId )
					                        <tr>
							                    <td>
										            <select class="form-control text-capitalize" name="mode{{$item->degreeId}}[]" data-parsley-error-message="Please select mode of counselling">
										                <option disabled="" selected="">Please select</option>
										                <option value="1"  @if($obj->modeofcounselling == 1) selected="" @endif>Online</option>
											            <option value="2"  @if($obj->modeofcounselling == 2) selected="" @endif>Offline</option>
										            </select>
							                    </td>
							                    <td>
							                        <input type="text" class="form-control" value="{{$obj->eventName}}" name="eventName{{$item->degreeId}}[]" placeholder="Event Name">
							                    </td>
							                    <td>
							                        <input type="text" class="form-control" value="{{$obj->eventDate}}" name="eventDate{{$item->degreeId}}[]" placeholder="Event Dates">
							                    </td>
							                    <td>
							                        <a class="btn btn-outline btn-danger btn-xs removeApplicationFeeRow{{$item->degreeId}}"><i class="fa fa-remove"></i> Remove</a>
							                    </td>
							                </tr>
							            @endif
				                    @endforeach
					            </tbody>
					        </table>
					    </div>
					</div>

					<hr>
					<div class="row margin-bottom10">
					    <div class="col-md-7">
					        <h3 class="text-uppercase text-success">List of Exam Counselling Contacts</h3>
					    </div>
					    <div class="col-md-5">
					        <a href="javascript:void(0);" class="btn btn-block btn-sm btn-success" id="addExamCounsellingContactsRow{{$item->degreeId}}"><i class="fa fa-plus"></i> Add Exam Counselling Contacts</a>
					    </div>
					</div>
					<div class="row">
					    <div class="col-md-12">
					        <table class="table table-bordered table-hover">
					            <thead>
					                <tr>
					                    <th>Contact Person Name</th>
					                    <th>Contact Number</th>
					                    <th>Action</th>
					                </tr>
					            </thead>
					            <tbody class="tableExamCounsellingContactsSection{{$item->degreeId}}">
					            	@foreach($examCounsellingContactsObj as $obj1)
					            		@if( $obj1->degreeId == $item->degreeId )
				                        <tr>
						                    <td>
						                        <input type="text" class="form-control" value="{{$obj1->contactPersonName}}" name="contactPersonName{{$item->degreeId}}[]" placeholder="Contact Person Name">
						                    </td>
						                    <td>
						                        <input type="text" class="form-control" value="{{$obj1->contactNumber}}" name="contactNumber{{$item->degreeId}}[]" placeholder="Contact Number">
						                    </td>
						                    <td>
						                        <a class="btn btn-outline btn-danger btn-xs removeExamCounsellingContactsRow{{$item->degreeId}}"><i class="fa fa-remove"></i> Remove</a>
						                    </td>
						                </tr>
						                @endif
				                    @endforeach
					            </tbody>
					        </table>
					    </div>
					</div>
					{!! Html::script('assets/administrator/js/jquery-2.1.1.js') !!}
					<script type="text/javascript">
					    var count = 0;
					    $('#addApplicationFeeRow{{$item->degreeId}}').on('click', function(){
					        count++;
					        var HTML = ''+
					                '<tr>'+
					                    '<td>'+
					                        '<select name="mode{{$item->degreeId}}[]" class="form-control mode" data-parsley-error-message="Please select mode">'+
					                            '<option value="" selected="">--Select mode--</option>'+
					                            '<option value="1">Online</option>'+
					                            '<option value="2">Offline</option>'+
					                        '</select>'+
					                    '</td>'+
					                    '<td>'+
					                        '<input type="text" class="form-control" name="eventName{{$item->degreeId}}[]" placeholder="Event Name">'+
					                    '</td>'+
					                    '<td>'+
					                        '<input type="text" class="form-control" name="eventDate{{$item->degreeId}}[]" placeholder="Event Date">'+
					                    '</td>'+
					                    '<td>'+
					                        '<a class="btn btn-outline btn-danger btn-xs removeApplicationFeeRow{{$item->degreeId}}"><i class="fa fa-remove"></i> Remove</a>'+
					                    '</td>'+
					                '</tr>'
					        $('.tableApplicationFeesSection{{$item->degreeId}}').append(HTML);
					    });

					    $(document).on('click','.removeApplicationFeeRow{{$item->degreeId}}', function(){
					        count--;
					        $(this).parent().parent().remove();
					    });
					</script>
					<script type="text/javascript">
					    var countContact = 0;
					    $('#addExamCounsellingContactsRow{{$item->degreeId}}').on('click', function(){
					        countContact++;
					        var HTML = ''+
					                '<tr>'+
					                    '<td>'+
					                        '<input type="text" class="form-control" name="contactPersonName{{$item->degreeId}}[]" placeholder="Contact Person Name">'+
					                    '</td>'+
					                    '<td>'+
					                        '<input type="text" class="form-control" name="contactNumber{{$item->degreeId}}[]" placeholder="Contact Number">'+
					                    '</td>'+
					                    '<td>'+
					                        '<a class="btn btn-outline btn-danger btn-xs removeExamCounsellingContactsRow{{$item->degreeId}}"><i class="fa fa-remove"></i> Remove</a>'+
					                    '</td>'+
					                '</tr>'
					        $('.tableExamCounsellingContactsSection{{$item->degreeId}}').append(HTML);
					    });

					    $(document).on('click','.removeExamCounsellingContactsRow{{$item->degreeId}}', function(){
					        countContact--;
					        $(this).parent().parent().remove();
					    });
					</script>
				</div>
		    </div>
        </div>
    </div>
    @endforeach
	<hr>
	<div class="col-sm-12 text-center">
		<div class="form-group mb-0 mt-20">
			<button type="submit" class="btn btn-primary fontMontserrat fontsize-15 pt-2 pb-2 submitBtn" data-loading-text="Please wait...">Submit</button>
		</div>
	</div>
</form>