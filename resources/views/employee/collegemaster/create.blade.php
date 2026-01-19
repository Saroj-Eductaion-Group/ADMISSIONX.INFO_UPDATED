@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Create New College Course <!-- <a href="{{ url('employee/collegemaster') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add new college course details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::open(['url' => 'employee/collegemaster', 'class' => 'form-horizontal','data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
            <!-- <div class="row padding-top5 padding-bottom5">
                <label  class="col-sm-2 control-label">Course Duration</label>
                <div class="col-md-10">
                    <select name="courseduration" class="form-control">
                        <option value="" selected disabled>Select Course Duration</option>   
                        @for ($i = 1; $i < 11; $i++)
                            @if( $i == '1' )
                                <option value="{{ $i }}">{{ $i }} Year</option>
                            @else
                                <option value="{{ $i }}">{{ $i }} Years</option>
                            @endif
                        @endfor
                    </select>
                </div>
            </div> -->
             <div class="row padding-top5 padding-bottom5">
                <div class="col-sm-2 control-label"><label>Course Duration</label></div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6">
                            <select name="courseduration" class="form-control">
                                <option value="" selected disabled>Select Course Duration</option>   
                                @for ($yearName = 1; $yearName < 11; $yearName++)
                                    @if( $yearName == '1')
                                        <option value="{{ $yearName }} Year">{{ $yearName }} Year</option>
                                    @else
                                        <option value="{{ $yearName }} Years">{{ $yearName }} Years</option>
                                    @endif
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select name="courseduration1" class="form-control">
                                <option value="" selected disabled>Select Course Duration</option>   
                                @for ($monthName = 1; $monthName < 13; $monthName++)
                                    @if( $monthName == '1' )
                                        <option value="{{ $monthName }} month">{{ $monthName }} month(s)</option>
                                    @else
                                        <option value="{{ $monthName }} months">{{ $monthName }} month(s)</option>
                                    @endif
                                @endfor
                            </select>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="row padding-top5 padding-bottom5">
                <label class="col-sm-2 control-label" >Course Eligibility : </label>
                <div class="col-sm-10">
                    {!! Form::text('twelvemarks', null, ['class' => 'form-control', 'placeholder' => 'Please enter minimum required 12th percentage',  'data-parsley-type'=>'number','data-parsley-length' => '[2, 3]', 'data-parsley-trigger'=>'change','data-parsley-error-message'=>'Please enter valid 12th marks here','data-parsley-type'=>'digits','data-parsley-minlength'=>'1','data-parsley-maxlength'=>'3','maxlength'=>'3','data-parsley-max'=>'100']) !!}
                </div>
            </div>
            <div class="row padding-top5 padding-bottom5">
                <label class="col-sm-2 control-label" >Other Course Eligibility : </label>
                <div class="col-sm-10">
                    {!! Form::text('others', null, ['class' => 'form-control', 'placeholder' => 'Please mention entrance exam and their score, if any','data-parsley-pattern'=>'^[0-9a-zA-Z\s -.,]*$', 'data-parsley-error-message' =>'Please enter correct course eligibility here', 'data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
            <div class="row padding-top5 padding-bottom5">
                <label class="col-sm-2 control-label" >Total Fees (per year) : </label>
                <div class="col-sm-10">
                    {!! Form::text('fees', null, ['class' => 'form-control', 'placeholder' => 'Enter total fees', 'data-parsley-error-message' => 'Please enter total fees here', 'data-parsley-type'=>'number','data-parsley-trigger'=>'change','data-parsley-type'=>'digits','data-parsley-minlength'=>'1','data-parsley-maxlength'=>'8','maxlength'=>'8','required' => '']) !!}
                </div>
            </div>
            <div class="row padding-top5 padding-bottom5">
                <label class="col-sm-2 control-label" >Total Seats : </label>
                <div class="col-sm-10">
                    {!! Form::text('seats', null, ['class' => 'form-control', 'placeholder' => 'Enter total seats', 'data-parsley-trigger'=>'change','data-parsley-error-message'=>'Please enter total available seats in the course of 1 to 5 digits','data-parsley-type'=>'digits','data-parsley-minlength'=>'1','data-parsley-maxlength'=>'5','maxlength'=>'5','required' => '']) !!}
                </div>
            </div>
            <div class="row padding-top5 padding-bottom5">
                <label class="col-sm-2 control-label" >Seats Allocated To Admission X : </label>
                <div class="col-sm-10">
                    {!! Form::text('seatsallocatedtobya', null, ['class' => 'form-control', 'placeholder' => 'Enter seats ','data-parsley-trigger'=>'change','data-parsley-error-message'=>'Please enter total available seats in the course of 1 to 5 digits','data-parsley-type'=>'digits','data-parsley-minlength'=>'1','data-parsley-maxlength'=>'5','maxlength'=>'5','required' => '']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >College Profile : </label>
                <div class="col-sm-10">
                    <select name="collegeprofile_id" class="form-control chosen-select " data-placeholder="Choose college profile..."  data-parsley-error-message=" Please select college profile" data-parsley-trigger="change" required="">
                        <option value="" selected disabled>Select College Profile</option>  
                        @foreach( $usersObj as $users )
                            @if( $users->userRoleId == '2' )
                            <option value="{{ $users->id }}">{{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }} </option>
                            @endif
                        @endforeach    
                    </select>     
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Stream : </label>
                <div class="col-sm-10">
                    <select name="functionalarea_id" class="form-control chosen-select " data-placeholder="Choose stream..."  data-parsley-error-message=" Please select stream" data-parsley-trigger="change" >
                        <option value="" selected disabled>Select Stream </option>  
                        @foreach ($functionalAreaObj as $functional)
                            <option value="{{ $functional->id }}">{{ $functional->name }}</option>
                        @endforeach    
                    </select>     
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Degree : </label>
                <div class="col-sm-10">
                    <select name="degree_id" class="form-control chosen-select " data-placeholder="Choose degree name..."  data-parsley-error-message=" Please select degree name" data-parsley-trigger="change" >
                        <option value="" selected disabled>Select Degree</option>  
                        <!-- @foreach ($degreeObj as $degree)
                            <option value="{{ $degree->id }}">{{ $degree->name }}</option>
                        @endforeach     -->
                    </select>     
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Course : </label>
                <div class="col-sm-10">
                    <select name="course_id" class="form-control chosen-select " data-placeholder="Choose course name..."  data-parsley-error-message=" Please select course name" data-parsley-trigger="change">
                        <option value="" selected disabled>Select Course</option>  
                       <!--  @foreach ($courseObj as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach     -->
                    </select>     
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Degree Level : </label>
                <div class="col-sm-10">
                    <select name="educationlevel_id" class="form-control chosen-select " data-placeholder="Choose education level..."  data-parsley-error-message=" Please select education level" data-parsley-trigger="change" >
                        <option value="" selected disabled>Select Degree Level</option>  
                        @foreach ($educationLevelObj as $education)
                            <option value="{{ $education->id }}">{{ $education->name }}</option>
                        @endforeach    
                    </select>     
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Course Type : </label>
                <div class="col-sm-10">
                    <select name="coursetype_id" class="form-control chosen-select " data-placeholder="Choose course type..."  data-parsley-error-message=" Please select course type" data-parsley-trigger="change">
                        <option value="" selected disabled>Select Course Type</option>  
                        @foreach ($courseTypeObj as $courseType)
                            <option value="{{ $courseType->id }}">{{ $courseType->name }}</option>
                        @endforeach    
                    </select>     
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Description : </label>
                <div class="col-sm-10">
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter description  here', 'data-parsley-error-message' => 'Please enter description here','data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-3">
                    {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
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

<script type="text/javascript">
    $('select[name=functionalarea_id]').on('change', function(){
        var currentID = $(this).val();
        $.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {currentID: currentID},
            url: "{{ URL::to('getAllDegreeName') }}",
            success: function(data) {
                var HTML = '';
                HTML += '<option selected="" disabled="">Select degree</option>';
                if( data.code == '200' ){
                    $.each(data.degreeObj, function(i, item) {
                        HTML += '<option value="'+data.degreeObj[i].degreeId+'">'+data.degreeObj[i].name+'</option>';
                    }); 
                }else{
                    HTML += '<option selected="" disabled="">No degree available for this stream</option>';
                }

                $('select[name="degree_id"]').empty();
                $('select[name="degree_id"]').html(HTML);
                $('select[name="degree_id"]').trigger('chosen:updated');
            }
        });
    });
</script>

<script type="text/javascript">
    $('select[name=degree_id]').on('change', function(){
        var currentID = $(this).val();
        $.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {currentID: currentID},
            url: "{{ URL::to('getAllCourseName') }}",
            success: function(data) {
                var HTML = '';
                HTML += '<option selected="" disabled="">Select course</option>';
                if( data.code == '200' ){
                    $.each(data.courseObj, function(i, item) {
                        HTML += '<option value="'+data.courseObj[i].courseId+'">'+data.courseObj[i].name+'</option>';
                    }); 
                }else{
                    HTML += '<option selected="" disabled="">No course available for this degree</option>';
                }

                $('select[name="course_id"]').empty();
                $('select[name="course_id"]').html(HTML);
                $('select[name="course_id"]').trigger('chosen:updated');
            }
        });
    });
</script>


@endsection