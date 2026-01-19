@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Update College Profile <!-- <a href="{{ url('employee/collegeprofile') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update college profile details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::model($collegeprofile, [
                'method' => 'PATCH',
                'url' => ['employee/collegeprofile', $collegeprofile->id],
                'class' => 'form-horizontal','data-parsley-validate' => '', 'files'=>true, 'enctype' => 'multipart/form-data'
            ]) !!}

            @if($collegeDataObj)
                @foreach(  $collegeDataObj as  $collegeData )
                    <input type="hidden" name="galleryId" value="{{ $collegeData->galleryId }}">
                @endforeach
            @endif
            <div class="form-group">
                <label  class="col-sm-2 control-label">Upload College Logo</label>
                <div class="col-sm-7">
                    <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a> </span>
                    <input type="file" name="uploadCollegeLogo" class="collegeLogo form-control"  data-parsley-filemaxmegabytes="2" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/jpg, image/png">
                </div>
                @if($collegeDataObj)
                <div class="col-sm-3">
                    <p class="text-center">
                        <img class="img-thumbnail img-responsive" src="{{ asset('gallery') }}/{{ $collegeData->slug }}/{{ $collegeData->galleryFullImage }}">
                    </p>
                    <p class="text-center">
                        <a class="btn btn-info btn-sm" href="/administrator/users/{{ $collegeData->usersId }}/edit">{{ $collegeData->userstatusName }}</a>
                    </p>
                </div>
                @endif
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label">Upload College Banner Image</label>
                <div class="col-sm-10">
                    <p class="text-danger">(Please upload .png, .jpg and .jpeg file only, we require image weight (1200 to 1400) and image height (300 to 400) minimum.)</p>
                    <span class="pull-right text-danger"><a href="javascript:void(0);" id="bannerimage1" class="hide"><i class="fa fa-remove"></i></a> </span>
                    <input type="file" class="form-control bannerimage" name="bannerimage"  data-parsley-filemaxmegabytes="20" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/jpg, image/png" data-parsley-error-message="Please upload only png , jpg or jpeg.">
                    @if($collegeprofile->bannerimage != '')
                    <div class="row">
                        <div class="col-sm-12">
                            <img class="img-thumbnail img-responsive" src="{{ asset('gallery') }}/{{ $collegeprofile->slug }}/{{ $collegeprofile->bannerimage }}">
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >University : </label>
                <div class="col-sm-10">
                    <select name="university_id" class="form-control chosen-select " data-placeholder="Choose university name..."  data-parsley-error-message=" Please select university name" data-parsley-trigger="change">
                        <option value="" selected disabled>Select University Name</option>  
                        @foreach ($universityObj as $university)
                            @if( $collegeprofile->university_id == $university->id )
                                <option value="{{ $university->id }}" selected="">{{ $university->name }} </option>
                            @else
                                <option value="{{ $university->id }}">{{ $university->name }} </option>
                            @endif
                        @endforeach
                    </select>     
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >College Type : </label>
                <div class="col-sm-10">
                    <select name="collegetype_id" class="form-control chosen-select " data-placeholder="Choose college type name..."  data-parsley-error-message=" Please select college type name" data-parsley-trigger="change">
                        <option value="" selected disabled>Select College Type </option>  
                        @foreach ($collegeTypeObj as $collegeType)
                            @if( $collegeprofile->collegetype_id == $collegeType->id )
                                <option value="{{ $collegeType->id }}" selected="">{{ $collegeType->name }} </option>
                            @else
                                <option value="{{ $collegeType->id }}">{{ $collegeType->name }} </option>
                            @endif
                        @endforeach
                    </select>     
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >Approved By</label>
                <div class="col-sm-10">
                    <select name="approvedBy" class="form-control" value="{{ $collegeprofile->approvedBy }}" data-parsley-error-message=" Please select approved type " data-parsley-trigger="change">
                        <option value=""  selected disabled>Select approved type</option>
                            @if( $collegeprofile->approvedBy == 'AICTE')
                                <option selected="" value="AICTE">AICTE</option>
                                <option value="UGC">UGC</option>
                                <option value="PCI">PCI</option>
                                <option value="Others">Others</option>
                            @elseif( $collegeprofile->approvedBy == 'UGC')
                                <option value="AICTE">AICTE</option>
                                <option selected="" value="UGC">UGC</option>
                                <option value="PCI">PCI</option>
                                <option value="Others">Others</option>
                            @elseif( $collegeprofile->approvedBy == 'PCI')
                                <option value="AICTE">AICTE</option>
                                <option value="UGC">UGC</option>
                                <option selected="" value="PCI">PCI</option>
                                <option value="Others">Others</option>
                            @elseif( $collegeprofile->approvedBy == 'Others')
                                <option value="AICTE">AICTE</option>
                                <option value="UGC">UGC</option>
                                <option value="PCI">PCI</option>
                                <option selected="" value="Others">Others</option>
                            @else( $collegeprofile->approvedBy == '')
                                <option value="AICTE">AICTE</option>
                                <option value="UGC">UGC</option>
                                <option value="PCI">PCI</option>
                                <option value="Others">Others</option>
                            @endif        
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Est. Year : </label>
                <div class="col-sm-10">
                     {!! Form::text('estyear', null, ['class' => 'form-control', 'placeholder' => 'Enter est year here', 'data-parsley-error-message' => 'Please enter est year here','data-parsley-type' => 'number', 'data-parsley-trigger'=>'change','data-parsley-min'=>'1050', 'data-parsley-max'=>date("Y")]) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Website : </label>
                <div class="col-sm-10">
                    {!! Form::url('website', null, ['class' => 'form-control', 'placeholder' => 'Enter website url here', 'data-parsley-error-message' => 'Please enter valid url here (i.e https://xyz.com, https://www.xyz.com, http://xyz.com, http://www.xyz.com)', 'pattern' => '^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$', 'data-parsley-type' => 'url', 'data-parsley-trigger' => 'change']) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" >College Code : </label>
                <div class="col-sm-10">
                    {!! Form::text('collegecode', null, ['class' => 'form-control', 'placeholder' => 'Enter college code here', 'data-parsley-error-message' => 'Please enter college code here','data-parsley-trigger'=>'change']) !!}
                </div>
            </div>  
             <div class="form-group">
                <label class="col-sm-2 control-label" >Contact Person Name : </label>
                <div class="col-sm-10">
                    {!! Form::text('contactpersonname', null, ['class' => 'form-control', 'placeholder' => 'Enter contact person name here', 'data-parsley-error-message' => 'Please enter contact person name here', 'data-parsley-trigger'=>'change', 'data-parsley-pattern'=>'^[a-zA-Z\s .]*$']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Contact Person Email : </label>
                <div class="col-sm-10">
                    {!! Form::text('contactpersonemail', null, ['class' => 'form-control', 'placeholder' => 'Enter contact person email here', 'data-parsley-error-message' => 'Please enter contact person email here', 'data-parsley-trigger'=>'change', 'data-parsley-type'=>'email']) !!}
                </div>
            </div> 
            <div class="form-group">
                <label class="col-sm-2 control-label" >Contact Person Phone : </label>
                <div class="col-sm-10">
                    {!! Form::text('contactpersonnumber', null, ['class' => 'form-control', 'placeholder' => 'Enter contact person phone here', 'data-parsley-error-message' => 'Please enter valid mobile number', 'data-parsley-trigger'=>'change', 'data-parsley-type' =>'digits']) !!}<!-- , 'data-parsley-length'=>'[7, 11]','data-parsley-pattern'=>'^[7-9][0-9]{9}$' -->
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Review : </label>
                <div class="col-sm-10">
                    <select name="review" class="form-control chosen-select" data-placeholder="Choose review ..."  data-parsley-error-message=" Please select review " data-parsley-trigger="change" >
                        <option value=""  selected disabled>Select Review</option>
                            @if( $collegeprofile->review == '1')
                                <option selected="" value="1">Reviewed</option>
                                <option value="0">Not Reviewed</option>
                            @else( $collegeprofile->review == '0')
                                <option value="1">Reviewed</option>
                                 <option selected="" value="0">Not Reviewed</option>
                            @endif     
                    </select>
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >Agreement : </label>
                <div class="col-sm-10">
                    <select name="agreement" class="form-control chosen-select" data-placeholder="Choose agreement ..."  data-parsley-error-message=" Please select agreement " data-parsley-trigger="change" >
                       <option value=""  selected disabled>Select Agreement</option>
                            @if( $collegeprofile->agreement == '1')
                                <option selected="" value="1">Agreement Signed</option>
                                <option value="0">No Agreement Signed</option>
                            @else( $collegeprofile->agreement == '0')
                                <option value="1">Agreement Signed</option>
                                 <option selected="" value="0">No Agreement Signed</option>
                            @endif     
                    </select>
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >Verified : </label>
                <div class="col-sm-10">
                    <select name="verified" class="form-control chosen-select" data-placeholder="Choose verified ..."  data-parsley-error-message=" Please select verified " data-parsley-trigger="change" >
                       <option value=""  selected disabled>Select Verified</option>
                            @if( $collegeprofile->verified == '1')
                                <option selected="" value="1">Verified</option>
                                <option value="0">Not Verified</option>
                            @else( $collegeprofile->verified == '0')
                                <option value="1">Verified</option>
                                 <option selected="" value="0">Not Verified</option>
                            @endif     
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Advertisement or Not : </label>
                <div class="col-sm-10">
                    <select name="advertisement" class="form-control chosen-select" data-placeholder="Choose advertisement status ..."  data-parsley-error-message=" Please select advertisement status " data-parsley-trigger="change" >
                       <option value="" selected disabled>Select Advertisement Status</option>
                            @if( $collegeprofile->advertisement == '1')
                                <option selected="" value="1">Yes</option>
                                <option value="0">No</option>
                            @elseif( $collegeprofile->advertisement == '0')
                                <option value="1">Yes</option>
                                <option selected="" value="0">No</option>
                            @else
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            @endif     
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label">Advertisement Time Frame Date</label>
                <div class="col-sm-5">
                    <label>Date From</label>
                    <input type="text" class="form-control" name="advertisementTimeFrame" id="datePickerForSelection" readonly="" placeholder="Select advertisement time frame date here" required="" data-parsley-trigger="change" data-parsley-error-message="Please select advertisement time frame date here" value="{{ date('d/m/Y', strtotime($collegeprofile->advertisementTimeFrame)) }}">                   
                </div>
                <div class="col-sm-5">
                    <label>Date To</label>
                    <input type="text" class="form-control" name="advertisementTimeFrameEnd" id="datePickerForSelection1" readonly="" placeholder="Select advertisement time frame date here" required="" data-parsley-trigger="change" data-parsley-error-message="Please select advertisement time frame date here" value="{{ date('d/m/Y', strtotime($collegeprofile->advertisementTimeFrameEnd)) }}">                   
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Is Show On Top College : </label>
                <div class="col-sm-10">
                    <div class="radio radio-success radio-inline">
                        <input type="radio" id="isShowOnTopEnabled" value="1" name="isShowOnTop" required="" data-parsley-error-message="Please select isShowOnTop" data-parsley-trigger="change" @if(isset($collegeprofile) && $collegeprofile->isShowOnTop == '1') checked=""  @elseif(isset($collegeprofile) && $collegeprofile->isShowOnTop == '0')  @else checked="" @endif>
                        <label for="isShowOnTopEnabled"> Enabled </label>
                    </div>
                    <div class="radio radio-danger radio-inline">
                        <input type="radio" id="isShowOnTopDisable" value="0" name="isShowOnTop" required="" data-parsley-error-message="Please select isShowOnTop" data-parsley-trigger="change" @if(isset($collegeprofile) && $collegeprofile->isShowOnTop == 0) checked="" @endif>
                        <label for="isShowOnTopDisable"> Disable </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Is Show On Home : </label>
                <div class="col-sm-10">
                    <div class="radio radio-success radio-inline">
                        <input type="radio" id="isShowOnHomeEnabled" value="1" name="isShowOnHome" required="" data-parsley-error-message="Please select isShowOnHome" data-parsley-trigger="change" @if(isset($collegeprofile) && $collegeprofile->isShowOnHome == '1') checked=""  @elseif(isset($collegeprofile) && $collegeprofile->isShowOnHome == '0')  @else checked="" @endif>
                        <label for="isShowOnHomeEnabled"> Enabled </label>
                    </div>
                    <div class="radio radio-danger radio-inline">
                        <input type="radio" id="isShowOnHomeDisable" value="0" name="isShowOnHome" required="" data-parsley-error-message="Please select isShowOnHome" data-parsley-trigger="change" @if(isset($collegeprofile) && $collegeprofile->isShowOnHome == 0) checked="" @endif>
                        <label for="isShowOnHomeDisable"> Disable </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Medium of Instruction : </label>
                <div class="col-sm-10">
                    {!! Form::text('mediumOfInstruction', null, ['class' => 'form-control', 'placeholder' => 'Please enter medium Of instruction', 'data-parsley-error-message' => 'Please enter correct medium Of instruction', 'data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Study From & to : </label>
                <div class="col-md-5">
                    <label class="control-label" >Study From : </label>
                    {!! Form::text('studyForm', null, ['class' => 'form-control', 'placeholder' => 'Please enter which class starts study', 'data-parsley-error-message' => 'Please enter which class starts study', 'data-parsley-trigger'=>'change']) !!}
                </div>
                <div class="col-md-5">
                    <label class="control-label" >Study To : </label>
                    {!! Form::text('studyTo', null, ['class' => 'form-control', 'placeholder' => 'Please enter which class ends study', 'data-parsley-error-message' => 'Please enter which class ends study', 'data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Admission Start & End Date : </label>
                <div class="col-md-5">
                    <label class="control-label" >Admission Start Date : </label>
                    {!! Form::date('admissionStart', null, ['class' => 'form-control', 'placeholder' => 'Please enter admission start', 'data-parsley-error-message' => 'Please enter admission start', 'data-parsley-trigger'=>'change']) !!}
                </div>
                <div class="col-md-5">
                    <label class="control-label" >Admission End Date : </label>
                    {!! Form::date('admissionEnd', null, ['class' => 'form-control', 'placeholder' => 'Please enter admission end date', 'data-parsley-error-message' => 'Please enter admission end date', 'data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >CCTV Surveillance : </label>
                <div class="col-sm-10">
                    <select name="CCTVSurveillance" class="form-control" data-parsley-error-message=" Please select cctv surveillance option" data-parsley-trigger="change">
                        <option value=""  selected disabled>Select cctv surveillance option</option>
                        <option @if( $collegeprofile->CCTVSurveillance == '1') selected="" @endif value="1">Yes</option>
                        <option @if( $collegeprofile->CCTVSurveillance == '0') selected="" @endif value="0">No</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >AC Campus : </label>
                <div class="col-sm-10">
                    <select name="ACCampus" class="form-control chosen-select " data-parsley-error-message=" Please select ac campus option" data-parsley-trigger="change" required="">
                        <option value=""  selected disabled>Select ac campus option</option>
                        <option @if( $collegeprofile->ACCampus == '1') selected="" @endif value="1">Yes</option>
                        <option @if( $collegeprofile->ACCampus == '0') selected="" @endif value="0">No</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Total No Of Students : </label>
                <div class="col-sm-10">
                    {!! Form::text('totalStudent', null, ['class' => 'form-control', 'placeholder' => 'Please enter no of students', 'data-parsley-error-message' => 'Please enter correct no of students', 'data-parsley-trigger'=>'change', 'data-parsley-type'=>'number','data-parsley-min'=>'1']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Description : </label>
                <div class="col-sm-10">
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter description here', 'data-parsley-trigger'=>'change',  'data-parsley-error-message' => 'Please enter the college description' ]) !!}
                    <!-- <p class="text-danger">(Maximum character limit 700)</p> -->
                </div>
            </div>
            <!-- <div class="form-group">
                <label class="col-sm-2 control-label" >Calender Info : </label>
                <div class="col-sm-10">
                    {!! Form::textarea('calenderinfo', null, ['class' => 'form-control', 'placeholder' => 'Enter calender info here','data-parsley-trigger'=>'change']) !!}
                </div>
            </div> -->
            <!--  <div class="form-group">
                <label class="col-sm-2 control-label" >User Name : </label>
                <div class="col-sm-10">
                    <select name="users_id" class="form-control chosen-select " data-placeholder="Choose user name..."  data-parsley-error-message=" Please select user name" data-parsley-trigger="change">
                        <option value="" selected disabled>Select User Name</option>  
                        @foreach( $usersObj as $users )
                            @if( $collegeprofile->users_id == $users->id )
                                <option value="{{ $users->id }}" selected="">{{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }} | {{ $users->userRoleName }}</option>
                            @else
                                <option value="{{ $users->id }}">{{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }} | {{ $users->userRoleName }}</option>
                            @endif
                        @endforeach    
                    </select>     
                </div>
            </div> -->
            @include('administrator.collegeprofile.social-media-partial')


            <hr>
            <div class="row">
               <div class="col-md-12">
                   <div class="headline"><h2>SEO Content</h2></div>
                    <input type="hidden" name="seopagename" value="collegepage">
                    @if(isset($seocontent) && (sizeof($seocontent) > 0))
                        @if(!empty($seocontent[0]->seoContentId))
                            <input type="hidden" name="seoContentId" value="{{ $seocontent[0]->seoContentId }}">
                        @endif
                        @include ('administrator.seo-content.seo-update-partial')
                    @else
                        @include ('administrator.seo-content.seo-create-partial')
                    @endif
               </div> 
            </div>
            <hr>
            
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-3">
                    {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

@endsection

@section('script')
{!! Html::script('assets/js/jquery.min.js') !!}
{!! Html::script('assets/js/parsley.min.js') !!}
<script type="text/javascript">
    $(document).ready(function(){ 

        $('.collegeLogo').on('change',function(){
            $('#refresh1').removeClass('hide');
        });
        $('#refresh1').on('click',function(e){
            $('.collegeLogo').val('').trigger('chosen:updated');
            $('#refresh1').addClass('hide');
        });

        $('input[name=uploadCollegeLogo]').change(function (e)
        {   
            var ext = $('input[name=uploadCollegeLogo]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' ){
                $("input[name=uploadCollegeLogo]").parsley().reset();
            }else{
                $('input[name=uploadCollegeLogo]').val('');
                $("input[name=uploadCollegeLogo]").parsley().reset();
                return false;
            }
            //Disable input file
        });
    });
</script>
<script type="text/javascript">
    $('.bannerimage').on('change',function(){
        $('#bannerimage1').removeClass('hide');
    });
    $('#bannerimage1').on('click',function(e){
        $('.bannerimage').val('').trigger('chosen:updated');
        $('#bannerimage1').addClass('hide');
    });

    $('input[name=bannerimage]').change(function (e)
    {   
        var ext = $('input[name=bannerimage]').val().split('.').pop().toLowerCase();
        if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' ){
            $("input[name=bannerimage]").parsley().reset();
        }else{
            $('input[name=bannerimage]').val('');
            $("input[name=bannerimage]").parsley().reset();
            return false;
        }
        //Disable input file
    });

    $("form").submit( function( e ) {
    var form = this;
    e.preventDefault(); //Stop the submit for now
                                //Replace with your selector to find the file input in your form
    var fileInput = $(this).find("input[name=bannerimage]")[0],
        file = fileInput.files && fileInput.files[0];
    if( file ) {
        var img = new Image();

        img.src = window.URL.createObjectURL( file );

        img.onload = function() {
            var width = img.naturalWidth,
                height = img.naturalHeight;

            window.URL.revokeObjectURL( img.src );

            if((width >= 1200 && width <= 1400)  && (height >= 300 && height <= 400) ) {
                form.submit();
            }else {
                alert("Sorry, this image doesn\'t look like the size we wanted. It\'s  width ("+width+") height ("+height+") but we require weight (1200 to 1400) x  height (300 to 400) size image.");
            }
        };
    }
    else { //No file was input or browser doesn't support client side reading
        form.submit();
    }
});
</script>

@endsection