@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Update Student Profile <!-- <a href="{{ url('employee/studentprofile') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update student profile details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::model($studentprofile, [
                'method' => 'PATCH',
                'url' => ['employee/studentprofile', $studentprofile->id],
                'class' => 'form-horizontal','data-parsley-validate' => '', 'enctype' => 'multipart/form-data'
            ]) !!}

                <!-- <div class="form-group">
                    <label class="col-sm-2 control-label" >Student Name : </label>
                    <div class="col-sm-10">
                        <select name="usersName" class="form-control chosen-select " data-placeholder="Choose student name..." data-parsley-error-message=" Please select student name" data-parsley-trigger="change" required="">
                            <option value="" selected disabled>Select Student Name</option> 
                            @foreach ($userObj as $user)
                                @if( $studentprofile->users_id == $user->id )
                                    <option value="{{ $user->id }}" selected="">{{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}</option>
                                @else
                                    <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }} </option>
                                @endif
                            @endforeach
                        </select>     
                    </div>
                </div>
                <div class="hr-line-dashed"></div> -->
                <div class="row">
                    <div class="col-md-12">
                        <h1><i class="fa fa-user"></i> Student Profile</h1>
                        <hr>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    @if($studentDataObj)
                        @foreach(  $studentDataObj as  $studentData )
                            <input type="hidden" name="galleryId" value="{{ $studentData->galleryId }}">
                        @endforeach
                    @endif
                    <div class="col-sm-12">
                        <label>Upload Student Profile Pic</label>
                        <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a> </span>
                         <input type="file" name="uploadStudentProfilePic" class="studentPic form-control"  data-parsley-filemaxmegabytes="2" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/jpg, image/png">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Date Of Birth</label>
                        {!! Form::date('dateofbirth', null, ['class' => 'form-control', 'id' => 'dateChange', 'placeholder' => 'Enter date of birth here ', 'data-parsley-error-message' => 'Please enter your date of birth', 'required' => '','data-parsley-trigger'=>'change']) !!}

                        <label class="text-primary">Age as on {!! date('d-m-Y') !!} : </label>
                        <label class="text-primary calculatedDateFromNow">{{ $calculateDate }}</label>

                    </div>
                    <div class="col-md-6">
                        <label>Gender</label>
                        <select name="gender" class="form-control chosen-select" value="{{ $studentprofile->gender }}" data-placeholder="Choose sex ..."  data-parsley-error-message=" Please select sex " data-parsley-trigger="change" required="">
                            <option value=""  selected disabled>Select Sex</option>
                            <option @if($studentprofile->gender == 'Male') selected="" @endif value="Male">Male</option>
                            <option @if($studentprofile->gender == 'Female') selected="" @endif value="Female">Female</option>
                            <option @if($studentprofile->gender == 'Other') selected="" @endif value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Parent Name</label>
                        {!! Form::text('parentsname', null, ['class' => 'form-control', 'placeholder' => 'Enter parent name here', 'data-parsley-error-message' => 'Please enter your parent name', 'data-parsley-trigger'=>'change', 'data-parsley-pattern'=>'^[a-zA-Z\s .]*$']) !!}
                    </div>
                    <div class="col-md-6">
                        <label>Parent Phone No</label>
                        {!! Form::text('parentsnumber', null, ['class' => 'form-control', 'placeholder' => 'Enter parent phone no here', 'data-parsley-error-message' => 'Please enter valid mobile number', 'data-parsley-trigger'=>'change', 'data-parsley-type' =>'digits']) !!}<!-- , 'data-parsley-length'=>'[7, 11]','data-parsley-pattern'=>'^[7-9][0-9]{9}$' -->
                    </div>
                </div>
                <!-- <div class="hr-line-dashed"></div>
                <div class="row hide gurdianBlock">
                    <div class="col-md-6">
                        <label>Parent Name</label>
                        {!! Form::text('parentsname', null, ['class' => 'form-control', 'placeholder' => 'Enter parent name here', 'data-parsley-error-message' => 'Please enter your parent name', 'data-parsley-trigger'=>'change']) !!}
                    </div>
                    <div class="col-md-6">
                        <label>Parent Phone No</label>
                        {!! Form::text('parentsnumber', null, ['class' => 'form-control', 'placeholder' => 'Enter parent phone no here', 'data-parsley-error-message' => 'Please enter your parent phone no', 'data-parsley-trigger'=>'change']) !!}
                    </div>
                </div> -->
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="col-md-12">
                        <h1><i class="fa fa-book"></i> Student Acedemic Details</h1>
                        <hr>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="col-md-4">
                        <label>10th Marks</label>
                         @if( $getStudent10thmarksObj )
                            @foreach(  $getStudent10thmarksObj as  $student10thMarksData )
                                @if( $student10thMarksData->marksName == '10th' )
                                <input type="text" class="form-control" name="tenthMarks" value="{{ $student10thMarksData->marks }}" placeholder="Please enter 10th mark here" data-parsley-length="[2, 3]" data-parsley-trigger="change" data-parsley-error-message="Please enter 10th mark here" data-parsley-type="number"  data-parsley-type="digits" data-parsley-length="[2, 4]" data-parsley-minlength="1" data-parsley-maxlength="4" maxlength="4" data-parsley-max="1000" >
                                @endif
                            @endforeach
                        @else
                            <input type="text" class="form-control" name="tenthMarks" placeholder="Please enter 10th mark here" data-parsley-trigger="change" data-parsley-length="[2, 3]" data-parsley-type="number"  data-parsley-error-message="Please enter 10th mark here" >
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label>10th Marks Type</label>
                         @if( $getStudent10thmarksObj )
                            @foreach(  $getStudent10thmarksObj as  $student10thMarksData )
                                <select name="tenthMarkType" class="form-control" value="{{ $student10thMarksData->studentMarkType }}" data-parsley-error-message=" Please select mark type " data-parsley-trigger="change" required="">
                                    <option value=""  selected disabled>Select mark type</option>
                                    <option value="PCB" @if( $student10thMarksData->studentMarkType == 'PCB') selected="" @endif>PCB (Physics, Chemistry, Biology)</option>
                                    <option value="PCM" @if( $student10thMarksData->studentMarkType == 'PCM') selected="" @endif>PCB (Physics, Chemistry, Math)</option>
                                    <option value="BEST 4" @if( $student10thMarksData->studentMarkType == 'BEST 4') selected="" @endif>BEST 4</option>
                                    <option value="BEST 5" @if( $student10thMarksData->studentMarkType == 'BEST 5') selected="" @endif>BEST 5</option>
                                    <option value="BEST 6" @if( $student10thMarksData->studentMarkType == 'BEST 6') selected="" @endif>BEST 6</option>    
                                </select>
                            @endforeach
                        @else
                            <select name="tenthMarkType" class="form-control chosen-select" data-placeholder="Choose mark type ..." data-parsley-error-message=" Please select mark type " data-parsley-trigger="change" required="">
                                <option value="" selected disabled >Select Mark Type</option>
                                <option value="" disabled ></option>
                                <option value="PCB">PCB</option>
                                <option value="PCM">PCM</option>
                                <option value="BEST 4">BEST 4</option>
                                <option value="BEST 5">BEST 5</option>
                                <option value="BEST 6">BEST 6</option>
                            </select>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label>10th Percentage</label>
                        @if( $getStudent10thmarksObj )
                            @foreach(  $getStudent10thmarksObj as  $student10thMarksData )
                                @if( $student10thMarksData->marksName == '10th' )
                                <select class="form-control chosen-select" name="tenthMarksPercentage">
                                    <option value="" disabled="" selected="">Please Select 10 Percentage</option>
                                    {{--*/ $tenPercentage = '0' /*--}}
                                    @for( $tenPercentage = '0'; $tenPercentage < '101'; $tenPercentage++ )
                                        @if( $student10thMarksData->percentage == $tenPercentage )
                                            <option value="{{ $tenPercentage }}" selected="">{{ $tenPercentage }}%</option>
                                        @else
                                            <option value="{{ $tenPercentage }}">{{ $tenPercentage }}%</option>
                                        @endif
                                    @endfor
                                </select>
                                @endif
                            @endforeach
                        @else
                            
                            <select class="form-control chosen-select" name="tenthMarksPercentage">
                                <option value="" disabled="" selected="">Please Select 10 Percentage</option>
                                {{--*/ $tenPercentage = '0' /*--}}
                                @for( $tenPercentage = '0'; $tenPercentage < '101'; $tenPercentage++ )
                                    <option value="{{ $tenPercentage }}">{{ $tenPercentage }}%</option>
                                @endfor
                            </select>
                        @endif
                        <!-- @if( $getStudent10thmarksObj )
                            @foreach(  $getStudent10thmarksObj as  $student10thMarksData )
                                @if( $student10thMarksData->marksName == '10th' )
                                <input type="text" class="form-control" name="tenthMarksPercentage" value="{{ $student10thMarksData->percentage }}" placeholder="Enter 10th percentage" data-parsley-trigger="change" data-parsley-error-message="Please enter 10th percentage here"  required="">
                                @endif
                            @endforeach
                        @else
                            <input type="text" class="form-control" name="tenthMarksPercentage" placeholder="Enter 10th percentage" data-parsley-trigger="change" data-parsley-error-message="Please enter 10th percentage here"  required="">
                        @endif -->
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="col-md-4">
                        <label>11th Marks</label>
                        @if( $getStudent11thmarksObj )
                            @foreach(  $getStudent11thmarksObj as $student11thMarksData )
                                @if( $student11thMarksData->marksName == '11th' )
                                <input type="text" class="form-control" name="eleventhmarks" value="{{ $student11thMarksData->marks }}" placeholder="Please enter 11th mark here" data-parsley-length="[2, 3]" data-parsley-trigger="change" data-parsley-error-message="Please enter 11th mark here" data-parsley-type="number"   data-parsley-type="digits" data-parsley-length="[2, 4]" data-parsley-minlength="1" data-parsley-maxlength="4" maxlength="4" data-parsley-max="1000">
                                @endif
                            @endforeach
                        @else
                            <input type="text" class="form-control" name="eleventhmarks" placeholder="Please enter 11th mark here" data-parsley-trigger="change" data-parsley-length="[2, 3]" data-parsley-error-message="Please enter 11th mark here"  data-parsley-type="number" >
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label>11th Marks Type</label>
                         @if( $getStudent11thmarksObj )
                            @foreach(  $getStudent11thmarksObj as  $student11thMarksData )
                                <select name="eleventhMarkType" class="form-control" value="{{ $student11thMarksData->studentMarkType }}" data-parsley-error-message=" Please select mark type " data-parsley-trigger="change" required="">
                                    <option value=""  selected disabled>Select mark type</option>
                                    <option value="PCB" @if( $student11thMarksData->studentMarkType == 'PCB') selected="" @endif>PCB (Physics, Chemistry, Biology)</option>
                                    <option value="PCM" @if( $student11thMarksData->studentMarkType == 'PCM') selected="" @endif>PCB (Physics, Chemistry, Math)</option>
                                    <option value="BEST 4" @if( $student11thMarksData->studentMarkType == 'BEST 4') selected="" @endif>BEST 4</option>
                                    <option value="BEST 5" @if( $student11thMarksData->studentMarkType == 'BEST 5') selected="" @endif>BEST 5</option>
                                    <option value="BEST 6" @if( $student11thMarksData->studentMarkType == 'BEST 6') selected="" @endif>BEST 6</option>     
                                </select>
                            @endforeach
                        @else
                            <select name="eleventhMarkType" class="form-control chosen-select" data-placeholder="Choose mark type ..." data-parsley-error-message=" Please select mark type " data-parsley-trigger="change" required="">
                                <option value="" selected disabled >Select Mark Type</option>
                                <option value="" disabled ></option>
                                <option value="PCB">PCB</option>
                                <option value="PCM">PCM</option>
                                <option value="BEST 4">BEST 4</option>
                                <option value="BEST 5">BEST 5</option>
                                <option value="BEST 6">BEST 6</option>
                            </select>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label>11th Percentage</label>
                        @if( $getStudent11thmarksObj )
                            @foreach(  $getStudent11thmarksObj as  $student11thMarksData )
                                @if( $student11thMarksData->marksName == '11th' )
                                <select class="form-control chosen-select" name="eleventhMarksPercentage">
                                    <option value="" disabled="" selected="">Please Select 10 Percentage</option>
                                    {{--*/ $eleventhPercentage = '0' /*--}}
                                    @for( $eleventhPercentage = '0'; $eleventhPercentage < '101'; $eleventhPercentage++ )
                                        @if( $student11thMarksData->percentage == $eleventhPercentage )
                                            <option value="{{ $eleventhPercentage }}" selected="">{{ $eleventhPercentage }}%</option>
                                        @else
                                            <option value="{{ $eleventhPercentage }}">{{ $eleventhPercentage }}%</option>
                                        @endif
                                    @endfor
                                </select>
                                @endif
                            @endforeach
                        @else
                            
                            <select class="form-control chosen-select" name="eleventhMarksPercentage">
                                <option value="" disabled="" selected="">Please Select 10 Percentage</option>
                                {{--*/ $eleventhPercentage = '0' /*--}}
                                @for( $eleventhPercentage = '0'; $eleventhPercentage < '101'; $eleventhPercentage++ )
                                    <option value="{{ $eleventhPercentage }}">{{ $eleventhPercentage }}%</option>
                                @endfor
                            </select>
                        @endif
                        <!-- @if( $getStudent11thmarksObj )
                            @foreach(  $getStudent11thmarksObj as  $student11thMarksData )
                                @if( $student11thMarksData->marksName == '11th' )
                                <input type="text" class="form-control" name="eleventhMarksPercentage" value="{{ $student11thMarksData->percentage }}" placeholder="Enter 11th percentage" data-parsley-trigger="change" data-parsley-error-message="Please enter 11th percentage here" required="" >
                                @endif
                            @endforeach
                        @else
                            <input type="text" class="form-control" name="eleventhMarksPercentage" placeholder="Enter 11th percentage" data-parsley-trigger="change" data-parsley-error-message="Please enter 11th percentage here" required="">
                        @endif -->
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="col-md-4">
                        <label>12th Marks</label>
                         @if( $getStudent12thmarksObj )
                            @foreach( $getStudent12thmarksObj as  $student12thMarksData )
                                @if( $student12thMarksData->marksName == '12th')
                                <input type="text" class="form-control" name="twelvemarks" value="{{ $student12thMarksData->marks }}" placeholder="Please enter 12th mark here" data-parsley-length="[2, 3]" data-parsley-trigger="change" data-parsley-error-message="Please enter 12th mark here"   data-parsley-type="number"   data-parsley-type="digits" data-parsley-length="[2, 4]" data-parsley-minlength="1" data-parsley-maxlength="4" maxlength="4" data-parsley-max="1000">
                                
                                @endif
                            @endforeach
                        @else
                            <input type="text" class="form-control" name="twelvemarks" placeholder="Please enter 12th mark here" data-parsley-trigger="change" data-parsley-length="[2, 3]" data-parsley-error-message="Please enter 12th mark here"  data-parsley-type="number" >
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label>12th Marks Type</label>
                         @if( $getStudent12thmarksObj )
                            @foreach(  $getStudent12thmarksObj as  $student12thMarksData )
                                <select name="twelveMarkType" class="form-control" value="{{ $student12thMarksData->studentMarkType }}" data-parsley-error-message=" Please select mark type " data-parsley-trigger="change" required="">
                                    <option value=""  selected disabled>Select mark type</option>
                                    <option value="PCB" @if( $student12thMarksData->studentMarkType == 'PCB') selected="" @endif>PCB (Physics, Chemistry, Biology)</option>
                                    <option value="PCM" @if( $student12thMarksData->studentMarkType == 'PCM') selected="" @endif>PCB (Physics, Chemistry, Math)</option>
                                    <option value="BEST 4" @if( $student12thMarksData->studentMarkType == 'BEST 4') selected="" @endif>BEST 4</option>
                                    <option value="BEST 5" @if( $student12thMarksData->studentMarkType == 'BEST 5') selected="" @endif>BEST 5</option>
                                    <option value="BEST 6" @if( $student12thMarksData->studentMarkType == 'BEST 6') selected="" @endif>BEST 6</option>          
                                </select>
                            @endforeach
                        @else
                            <select name="twelveMarkType" class="form-control chosen-select" data-placeholder="Choose mark type ..." data-parsley-error-message=" Please select mark type " data-parsley-trigger="change" required="">
                                <option value="" selected disabled >Select Mark Type</option>
                                <option value="" disabled ></option>
                                <option value="PCB">PCB</option>
                                <option value="PCM">PCM</option>
                                <option value="BEST 4">BEST 4</option>
                                <option value="BEST 5">BEST 5</option>
                                <option value="BEST 6">BEST 6</option>
                            </select>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label>12th Percentage</label>
                        @if( $getStudent12thmarksObj )
                            @foreach(  $getStudent12thmarksObj as $student12thMarksData )
                                @if( $student12thMarksData->marksName == '12th' )
                                <select class="form-control chosen-select" name="twelveMarksPercentage">
                                    <option value="" disabled="" selected="">Please Select 12 Percentage</option>
                                    {{--*/ $twelthPercentage = '0' /*--}}
                                    @for( $twelthPercentage = '0'; $twelthPercentage < '101'; $twelthPercentage++ )
                                        @if( $student12thMarksData->percentage == $twelthPercentage )
                                            <option value="{{ $twelthPercentage }}" selected="">{{ $twelthPercentage }}%</option>
                                        @else
                                            <option value="{{ $twelthPercentage }}">{{ $twelthPercentage }}%</option>
                                        @endif
                                    @endfor
                                </select>
                                @endif
                            @endforeach
                        @else
                            <select class="form-control chosen-select" name="twelveMarksPercentage">
                                <option value="" disabled="" selected="">Please Select 12 Percentage</option>
                                {{--*/ $twelthPercentage = '0' /*--}}
                                @for( $twelthPercentage = '0'; $twelthPercentage < '101'; $twelthPercentage++ )
                                    <option value="{{ $twelthPercentage }}">{{ $twelthPercentage }}%</option>
                                @endfor
                            </select>
                        @endif
                       <!--  @if( $getStudent12thmarksObj )
                            @foreach(  $getStudent12thmarksObj as  $student12thMarksData )
                                @if( $student12thMarksData->marksName == '12th' )
                                <input type="text" class="form-control" name="twelveMarksPercentage" value="{{ $student12thMarksData->percentage }}" placeholder="Enter 12th percentage" data-parsley-trigger="change" data-parsley-error-message="Please enter 12th percentage here" required="" >
                                
                                @endif
                            @endforeach
                        @else
                            <input type="text" class="form-control" name="twelveMarksPercentage" placeholder="Enter 12th percentage" data-parsley-trigger="change" data-parsley-error-message="Please enter 12th percentage here"  required="">
                        @endif -->
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="col-md-4">
                        <label>Graduation Marks</label>
                         @if( $getStudentGraduationMarksObj )
                            @foreach( $getStudentGraduationMarksObj as  $studentGraduationMarkData )
                                @if( $studentGraduationMarkData->marksName == 'Graduation')
                                <input type="text" class="form-control" name="graduationmarks" value="{{ $studentGraduationMarkData->marks }}" placeholder="Please enter Graduation mark here" data-parsley-length="[2, 4]" data-parsley-trigger="change" data-parsley-error-message="Please enter Graduation mark here"  data-parsley-type="number" >
                                
                                @endif
                            @endforeach
                        @else
                            <input type="text" class="form-control" name="graduationmarks" placeholder="Please enter Graduation mark here" data-parsley-trigger="change" data-parsley-length="[2, 4]" data-parsley-error-message="Please enter Graduation mark here" data-parsley-type="number" >
                        @endif
                    </div>
                     <div class="col-md-4">
                        <label>Graduation Marks Type</label>
                         @if( $getStudentGraduationMarksObj )
                            @foreach(  $getStudentGraduationMarksObj as  $studentGraduationMarkData )
                                <select name="graduationMarkType" class="form-control" value="{{ $studentGraduationMarkData->studentMarkType }}" data-parsley-error-message=" Please select mark type " data-parsley-trigger="change" required="">
                                    <option value=""  selected disabled>Select mark type</option>    
                                    <option value="Art / Design" @if( $studentGraduationMarkData->studentMarkType == 'Art / Design') selected="" @endif>Art / Design</option>
                                    <option value="Business / Management" @if( $studentGraduationMarkData->studentMarkType == 'Business / Management') selected="" @endif>Business / Management </option>
                                    <option value="Computers / Technology" @if( $studentGraduationMarkData->studentMarkType == 'Computers / Technology') selected="" @endif>Computers / Technology </option>
                                    <option value="Criminal Justice / Legal" @if( $studentGraduationMarkData->studentMarkType == 'Criminal Justice / Legal') selected="" @endif>Criminal Justice / Legal </option>
                                    <option value="Education / Teaching" @if( $studentGraduationMarkData->studentMarkType == 'Education / Teaching') selected="" @endif>Education / Teaching </option>
                                    <option value="Liberal Arts / Humanities" @if( $studentGraduationMarkData->studentMarkType == 'Liberal Arts / Humanities') selected="" @endif>Liberal Arts / Humanities </option>
                                    <option value="Nursing / Healthcare" @if( $studentGraduationMarkData->studentMarkType == 'Nursing / Healthcare') selected="" @endif>Nursing / Healthcare </option>
                                    <option value="Psychology / Counseling" @if( $studentGraduationMarkData->studentMarkType == 'Psychology / Counseling') selected="" @endif>Psychology / Counseling </option>
                                    <option value="Science / Engineering" @if( $studentGraduationMarkData->studentMarkType == 'Science / Engineering') selected="" @endif>Science / Engineering </option>
                                    <option value="Trades / Careers" @if( $studentGraduationMarkData->studentMarkType == 'Trades / Careers') selected="" @endif>Trades / Careers</option>  
                                    <option value="None Of These" @if( $studentGraduationMarkData->studentMarkType == 'None Of These') selected="" @endif>None Of These</option> 
                                </select>
                            @endforeach
                        @else
                            <select name="graduationMarkType" class="form-control chosen-select" data-placeholder="Choose mark type ..." data-parsley-error-message=" Please select mark type " data-parsley-trigger="change" required="">
                                <option value="" selected disabled >Select Mark Type</option>
                                <option value="" disabled ></option>
                                <option value="Art / Design">Art / Design</option>
                                <option value="Business / Management">Business / Management</option>
                                <option value="Computers / Technology">Computers / Technology</option>
                                <option value="Criminal Justice / Legal">Criminal Justice / Legal</option>
                                <option value="Education / Teaching">Education / Teaching</option>
                                <option value="Liberal Arts / Humanities">Liberal Arts / Humanities</option>
                                <option value="Nursing / Healthcare">Nursing / Healthcare</option>
                                <option value="Psychology / Counseling">Psychology / Counseling</option>
                                <option value="Science / Engineering">Science / Engineering</option>
                                <option value="Trades / Careers">Trades / Careers</option>
                                <option value="None Of These">None Of These</option>
                            </select>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label>Graduation Percentage</label>
                        @if( $getStudentGraduationMarksObj )
                            @foreach(  $getStudentGraduationMarksObj as $studentGraduationMarkData )
                                @if( $studentGraduationMarkData->marksName == 'Graduation' )
                                <select class="form-control chosen-select" name="graduationMarksPercentage">
                                    <option value="" disabled="" selected="">Please Select Graduation Percentage</option>
                                    {{--*/ $graduationPercentage = '0' /*--}}
                                    @for( $graduationPercentage = '0'; $graduationPercentage < '101'; $graduationPercentage++ )
                                        @if( $studentGraduationMarkData->percentage == $graduationPercentage )
                                            <option value="{{ $graduationPercentage }}" selected="">{{ $graduationPercentage }}%</option>
                                        @else
                                            <option value="{{ $graduationPercentage }}">{{ $graduationPercentage }}%</option>
                                        @endif
                                    @endfor
                                </select>
                                @endif
                            @endforeach
                        @else
                            <select class="form-control chosen-select" name="graduationMarksPercentage">
                                <option value="" disabled="" selected="">Please Select Graduation Percentage</option>
                                {{--*/ $graduationPercentage = '0' /*--}}
                                @for( $graduationPercentage = '0'; $graduationPercentage < '101'; $graduationPercentage++ )
                                    <option value="{{ $graduationPercentage }}">{{ $graduationPercentage }}%</option>
                                @endfor
                            </select>
                        @endif
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Entrance Exam Name</label>

                        <select name="entranceexamname" class="form-control chosen-select" data-parsley-trigger="change" data-parsley-error-message="Please select your entrance exam" >
                            <option selected="" disabled>Please select an entrance exam</option>
                            @foreach ($entranceExam as $entrance)
                                @if( $studentprofile->entranceexamname == $entrance->id )
                                    <option value="{{ $entrance->id }}" selected="">{{ $entrance->name }} </option>
                                @else
                                    <option value="{{ $entrance->id }}">{{ $entrance->name }}</option>
                                @endif
                            @endforeach
                            <option value="Others">Others</option>
                       </select>   
                       <div class="hide other_entrance_exam_name margin-top10">
                           <input type="text" class="form-control other_entranceexamname" name="other_entranceexamname" placeholder="Please enter entrance exam name here" data-parsley-trigger="change" data-parsley-error-message="Please enter entrance exam name here">
                       </div>
                    </div>
                    <div class="col-md-6">
                        <label>Entrance Exam No</label>
                        {!! Form::text('entranceexamnumber', null, ['class' => 'form-control', 'placeholder' => 'Enter entrance exam number here', 'data-parsley-error-message' => 'Please enter your entrance exam number', 'data-parsley-trigger'=>'change','data-parsley-type'=>'digits','data-parsley-minlength'=>'1','data-parsley-maxlength'=>'5','maxlength'=>'5','data-parsley-max'=>'10000']) !!}
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="col-md-12">
                        <h1><i class="fa fa-thumbs-up"></i> Interest </h1>
                        <hr>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Hobbies</label>
                        {!! Form::text('hobbies', null, ['class' => 'form-control', 'placeholder' => 'Enter hobbies here', 'data-parsley-error-message' => 'Please enter your hobbies', 'data-parsley-trigger'=>'change','data-parsley-pattern'=>'^[a-zA-Z0-9\\/s ().,-]*$']) !!}
                    </div>
                    <div class="col-md-6">
                        <label>Interest</label>
                        {!! Form::text('interests', null, ['class' => 'form-control', 'placeholder' => 'Enter interests here', 'data-parsley-error-message' => 'Please enter your interests', 'data-parsley-trigger'=>'change','data-parsley-pattern'=>'^[a-zA-Z0-9\\/s ().,-]*$']) !!}
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Achievement Awards</label>
                        {!! Form::textarea('achievementsawards', null, ['class' => 'form-control', 'placeholder' => 'Enter achievement awards here', 'data-parsley-error-message' => 'Please enter your achievement awards', 'data-parsley-trigger'=>'change','data-parsley-pattern'=>'^[a-zA-Z0-9\\/s ().,-]*$']) !!}
                    </div>
                    <div class="col-md-6">
                        <label>Projects</label>
                        {!! Form::textarea('projects', null, ['class' => 'form-control', 'placeholder' => 'Enter projects here', 'data-parsley-error-message' => 'Please enter your projects', 'data-parsley-trigger'=>'change']) !!}
                    </div>
                </div>
               <div class="hr-line-dashed"></div>

               <div class="row">
                   <div class="col-md-12">
                       <div class="headline"><h2>SEO Content</h2></div>
                        <input type="hidden" name="seopagename" value="studentpage">
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

@section('scripts')
{!! Html::script('assets/js/jquery.min.js') !!}
{!! Html::script('assets/js/parsley.min.js') !!}
<script type="text/javascript">
    $(document).ready(function(){
        $('#dateChange').on('change', function(){
            var dateofbirth = $(this).val();
            var HTML = '';
            var year = '';
            $.ajax({
                headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
                },
                method: "GET",
                data: { dateofbirth: dateofbirth },
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                url: "{{ URL::to('/getStudentDOBCalculate') }}",
                success: function(data) {
                    if( data.code == '200' ){
                        $('.calculatedDateFromNow').text(data.calculateDate);   
                        year = data.year;
                        if( year < 18 ){
                            $('input[name=parentsname]').val('');
                            $('input[name=parentsnumber]').val('');
                            $('.gurdianBlock').removeClass('hide');
                        }else{
                            $('input[name=parentsname]').val('');
                            $('input[name=parentsnumber]').val('');
                            $('.gurdianBlock').addClass('hide');
                        }
                    }else{

                    }  
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){ 

        $('.studentPic').on('change',function(){
            $('#refresh1').removeClass('hide');
        });
        $('#refresh1').on('click',function(e){
            $('.studentPic').val('').trigger('chosen:updated');
            $('#refresh1').addClass('hide');
        });

        $('input[name=uploadStudentProfilePic]').change(function (e)
        {   
            var ext = $('input[name=uploadStudentProfilePic]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' ){
                $("input[name=uploadStudentProfilePic]").parsley().reset();
            }else{
                $('input[name=uploadStudentProfilePic]').val('');
                $("input[name=uploadStudentProfilePic]").parsley().reset();
                return false;
            }
            //Disable input file
        });
    });
</script>

<script type="text/javascript">
    $('select[name=entranceexamname]').on('change', function(){
        checkRequiredFields($(this).val());
    });

    var other_entranceexamname = $('select[name=entranceexamname]').val();
    checkRequiredFields(other_entranceexamname);

    function checkRequiredFields(entranceexamname) {
        if(entranceexamname == "Others"){
            $('.other_entrance_exam_name').removeClass('hide');
            $('input[name=other_entranceexamname]').attr("required", true);
        }else{
            $('.other_entrance_exam_name').addClass('hide');
            $('input[name=other_entranceexamname]').attr("required", false);
        }
    }

</script>
@endsection