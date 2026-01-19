<div class="form-group">
    <div class="col-sm-12">
        <label class="control-label" >College Name : </label>
        <select name="collegeprofile_id" class="form-control chosen-select " data-placeholder="Choose stream..."  data-parsley-error-message=" Please select stream" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select college name </option>  
            @foreach( $collegeProfileObj as $college )
                <option value="{{ $college->collegeprofileID }}" @if(isset($getFacultyObj) && $getFacultyObj->collegeprofile_id == $college->collegeprofileID) selected="" @endif>{{ $college->firstname }}</option>
            @endforeach
        </select>  
    </div>
</div>
<div class="row padding-top5 padding-bottom5">
    <div class="col-md-12">
        <div class="headline"><h2>Faculty Personal Details</h2></div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <label>Profile Picture</label>
        <input type="file" class="form-control" name="imagename" placeholder="Select profile picture">
        @if(!empty($getFacultyObj->imagename))
            <img class="img-circle" src="{{ asset('gallery'.'/'.$slug.'/'.$getFacultyObj->imagename) }}" width="80" height="80">
        @endif
    </div>
    <div class="col-md-3">
        <label>Suffix</label>
        <select class="form-control" name="suffix" required="" data-parsley-error-message="Please select an option">
            <option value="" selected="">-- Select an option --</option>
            <option value="Dr." @if($getFacultyObj->suffix == 'Dr.') selected="" @endif>Dr.</option>
            <option value="Prof." @if($getFacultyObj->suffix == 'Prof.') selected="" @endif>Prof.</option>
            <option value="Mr." @if($getFacultyObj->suffix == 'Mr.') selected="" @endif>Mr.</option>
            <option value="Miss" @if($getFacultyObj->suffix == 'Miss.') selected="" @endif>Miss</option>
            <option value="Mrs." @if($getFacultyObj->suffix == 'Mrs.') selected="" @endif>Mrs.</option>
        </select>
    </div>
    <div class="col-md-3">
        <label>Faculty Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter faculty name" required="" data-parsley-error-message="Please enter faculty name" value="{{ $getFacultyObj->name }}">
    </div>
    <div class="col-md-3">
        <label>Faculty Contact</label>
        <input type="text" class="form-control" name="phone" placeholder="Enter faculty contact" required="" data-parsley-error-message="Please enter faculty contact" value="{{ $getFacultyObj->phone }}">
    </div>
</div>
<hr class="hr-gap">
<div class="row">
    <div class="col-md-3">
        <label>Faculty Email</label>
        <input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" class="form-control" name="email" placeholder="Enter faculty email address" required="" data-parsley-error-message="Please enter faculty email" value="{{ $getFacultyObj->email }}">
    </div>
    <div class="col-md-3">
        <label>Date of Birth</label>
        <input type="date" class="form-control" name="dob" placeholder="Enter faculty dob" required="" data-parsley-error-message="Please enter faculty dob" value="{{ $getFacultyObj->dob }}">
    </div>
    <div class="col-md-3">
        <label>Gender</label>
        <select class="form-control" name="gender" required="" data-parsley-error-message="Please select an option">
            <option value="" selected="">-- Select an option --</option>
            <option value="1" @if( $getFacultyObj->gender == 1) selected="" @endif>Male</option>
            <option value="2" @if( $getFacultyObj->gender == 2) selected="" @endif>Female</option>
            <option value="3" @if( $getFacultyObj->gender == 3) selected="" @endif>Other</option>
        </select>
    </div>
    <div class="col-md-3">
        <label>Designation</label>
        <input type="text" class="form-control" name="designation" placeholder="Enter designation here" data-parsley-error-message = "Please enter valid designation" data-parsley-pattern="^[a-zA-Z\s .]*$" data-parsley-trigger="change" value="{{ $getFacultyObj->designation }}" required="">
    </div>
</div>
<hr class="hr-gap">
<div class="row">
    <div class="col-md-12">
        <label>Language Known (If add multiple language please use comma ( , ) ex:- English,Hindi,Urdu etc....)</label>
        <input type="text" class="form-control" name="languageKnown" placeholder="Enter language known here" data-parsley-error-message = "Please enter valid language known" data-parsley-pattern="^[a-zA-Z\s .,]*$" data-parsley-trigger="change" value="{{ $getFacultyObj->languageKnown }}" required="">
    </div>
</div>
<hr class="hr-gap">
<div class="row padding-top5 padding-bottom5">
    <div class="col-md-12">
        <div class="headline"><h2>Faculty Address Details</h2></div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <label>Address Line 1</label>
        <input type="text" class="form-control" name="addressline1" required="" data-parsley-error-message="Please enter address line 1" placeholder="Enter address line 1" value="{{ $getFacultyObj->addressline1 }}">
    </div>
    <div class="col-md-3">
        <label>Address Line 2</label>
        <input type="text" class="form-control" name="addressline2" placeholder="Enter address line 2" value="{{ $getFacultyObj->addressline2 }}">
    </div>
    <div class="col-md-3">
        <label>Landmark</label>
        <input type="text" class="form-control" name="landmark" placeholder="Enter landmark" value="{{ $getFacultyObj->landmark }}">
    </div>
    <div class="col-md-3">
        <label>Pincode</label>
        <input type="text" class="form-control" name="pincode" placeholder="Enter pincode" required="" data-parsley-error-message="Please enter pincode" value="{{ $getFacultyObj->pincode }}">
    </div>
</div>
<hr class="hr-gap">
<div class="row">
    <div class="col-md-3">
        <label>Country</label>
        <select class="form-control" name="country_id" required="" data-parsley-error-message="Please select an option">
            <option value="" selected="">-- Select an option --</option>
            @foreach($getCountryObj as $item)
                @if(isset($getFacultyObj) && $getFacultyObj->country_id)
                    <option value="{{ $item->id }}" @if($item->id == $getFacultyObj->country_id) selected="" @endif>{{ $item->name }}</option>
                @else
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <label>State</label>
        <select class="form-control" name="state_id" required="" data-parsley-error-message="Please select an option">
            <option value="" selected="">-- Select an option --</option>
            @if(isset($getStateObj) && $getFacultyObj->state_id)
                @foreach($getStateObj as $item)
                    <option value="{{ $item->id }}" @if($item->id == $getFacultyObj->state_id) selected="" @endif>{{ $item->name }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="col-md-3">
        <label>City</label>
        <select class="form-control" name="city_id" required="" data-parsley-error-message="Please select an option">
            <option value="" selected="">-- Select an option --</option>
            @if(isset($getCityObj) && $getFacultyObj->city_id)
                @foreach($getCityObj as $item)
                    <option value="{{ $item->id }}" @if($item->id == $getFacultyObj->city_id) selected="" @endif>{{ $item->name }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>
<hr class="hr-gap">
<div class="row padding-top5 padding-bottom5">
    <div class="col-md-12">
        <div class="headline"><h2>Faculty Infotmation</h2></div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <label></label>
        <textarea class="form-control summernote" rows="4" placeholder="Enter the about faculty" name="description" required="">{{ $getFacultyObj->description }}</textarea>
    </div>
</div>
<hr class="hr-gap">
<div class="row padding-top5 padding-bottom5">
    <div class="col-md-12">
        <div class="headline"><h2>Faculty Qualification</h2></div>
    </div>
</div>
<div class="row margin-bottom10">
    <div class="col-md-12">
        <h3 class="text-uppercase text-success">List of all qualification</h3>
    </div>
</div>
<div class="qualificationSection">
    @if(isset($qualificationsObj))
    @foreach($qualificationsObj as $key => $item)
    <div class="clientContactDetails margin-bottom10">
        <h4 class="padding-bottom10">Qualification Detail <a class="btn btn-outline btn-danger text-white btn-xs removeQualificationDetails pull-right"><i class="fa fa-remove"></i> Remove</a></h4>
        <div class="row margin-bottom10">
            <div class="col-md-6">
                <label class="">Qualification</label>
                <input type="text" name="qualification[]"  class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid qualification"  placeholder="Please enter qualification" value="{{$item->qualification}}" required=""> 
            </div>
            <div class="col-md-6">
                <label class="">Course</label>
                <input type="text" name="course[]"  class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid course"  placeholder="Please enter course" value="{{$item->course}}" required=""> 
            </div>
        </div>
        <div class="row margin-bottom10">
            <div class="col-md-6">
                <label class="">Subject</label>
                <input type="text" name="subjects[]"  class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid subjects"  placeholder="Please enter subjects" value="{{$item->subjects}}" required=""> 
            </div>
            <div class="col-md-6">
                <label class="">Passing Year</label>
                <input type="text" name="year[]"   class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid passing year"  placeholder="Please enter passing year" value="{{$item->year}}" data-parsley-type="digits" data-parsley-minlength="4" data-parsley-maxlength="4" maxlength="4" required="" min="1940" max="{{date('Y')}}"> 
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label class="">College Name</label>
                <input type="text" name="collegename[]"  class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid college name"  placeholder="Please enter college name" value="{{$item->collegename}}" required=""> 
            </div>
            <div class="col-md-6">
                <label class="">Board Name</label>
                <input type="text" name="boardName[]"  class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid board name"  placeholder="Please enter board name" value="{{$item->boardName}}" required=""> 
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
<div class="row">
    <div class="col-md-2 pull-right margin-top20">
        <a href="javascript:void(0);" class="btn btn-block btn-sm btn-success" id="addNewQualificationDetailRow"><i class="fa fa-plus"></i> Add Qualification</a>
    </div>
</div>

<hr class="hr-gap">
<div class="row padding-top5 padding-bottom5">
    <div class="col-md-12">
        <div class="headline"><h2>Faculty Experience</h2></div>
    </div>
</div>
<div class="row margin-bottom10">
    <div class="col-md-10">
        <h3 class="text-uppercase text-success">List of all experience</h3>
    </div>
    <div class="col-md-2">
        <a href="javascript:void(0);" class="btn btn-block btn-sm btn-success" id="addExperienceRow"><i class="fa fa-plus"></i> Add Experience</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Organization Name</th>
                    <th>Role</th>
                    <th>Form Year</th>
                    <th>To Year</th>
                    <th>City</th>
                    <th>Remove Action</th>
                </tr>
            </thead>
            <tbody class="tableExperienceSection">
            @if(isset($experienceObj))
            @foreach($experienceObj as $item)
                <tr>
                    <td><input type="text" class="form-control" name="organisation[]" value="{{ $item->organisation }}" placeholder="Enter url name" required=""></td>
                    <td><input type="text" class="form-control" name="role[]" value="{{ $item->role }}" placeholder="Enter url name" required=""></td>
                    <td><input type="number" class="form-control" name="fromyear[]" value="{{ $item->fromyear }}" placeholder="Enter form year" min="1940" max="{{date('Y')}}" required=""></td>
                    <td><input type="number" class="form-control" name="toyear[]" value="{{ $item->toyear }}" placeholder="Enter to year" min="1940" max="{{date('Y')}}" required=""></td>
                    <td><input type="text" class="form-control" name="city[]" value="{{ $item->city }}" placeholder="Enter url name" required=""></td>
                    <td><a class="btn btn-outline btn-danger text-white btn-xs removeExperience"><i class="fa fa-remove"></i> Remove</a></td>
                </tr>
            @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>

<hr class="hr-gap">
<div class="row padding-top5 padding-bottom5">
    <div class="col-md-12">
        <div class="headline"><h2>Which departments are connected, add them here</h2></div>
    </div>
</div>
@if(sizeof($allCourseObj) > 0)
<div class="row margin-bottom10">
    <div class="col-md-12">
        <h3 class="text-uppercase text-success">List of all the departments with which you are connected</h3>
    </div>
</div>
<div class="clientContactDetails margin-bottom10">
    <h4 class="padding-bottom10">Associate Department Detail New</h4>
    <div class="row padding-top5 padding-bottom5">
        <div class="col-md-12"><label>Course</label></div>
        <div class="col-md-12">
            @if(isset($facultyDepartmentObj) && sizeof($facultyDepartmentObj))
                <select name="collegemaster_id[]" class="form-control chosen-select " data-parsley-error-message=" Please select course" data-parsley-trigger="change" required="" multiple="multiple" data-placeholder="Choose a course...">
                    @foreach($allCourseObj as $course )
                        {{--*/ $flag = 0; /*--}}
                        @foreach( $facultyDepartmentObj as $item)
                            @if($item->collegemaster_id == $course->collegemasterId)
                                {{--*/ $flag = 1; /*--}}
                                <option value="{{ $course->collegemasterId }}" selected="">{{ $course->courseName }} (Degree : {{$course->degreeName}} | Stream : {{$course->functionalareaName}}) (Course Type : {{ $course->coursetypeName }}) (Degree Level : {{ $course->educationlevelName }})</option>
                                {{--*/ break; /*--}}
                            @endif                                    
                        @endforeach
                        @if($flag == 0)
                            <option value="{{ $course->collegemasterId }}">{{ $course->courseName }} (Degree : {{$course->degreeName}} | Stream : {{$course->functionalareaName}}) (Course Type : {{ $course->coursetypeName }}) (Degree Level : {{ $course->educationlevelName }})</option>
                        @endif
                    @endforeach
                </select>
            @else
                <select name="collegemaster_id[]" class="form-control chosen-select " data-parsley-error-message=" Please select course" data-parsley-trigger="change" required="" multiple="multiple" data-placeholder="Choose a course...">
                    @foreach ($allCourseObj as $course)                     
                    <option value="{{ $course->collegemasterId }}">{{ $course->courseName }} (Degree : {{$course->degreeName}} | Stream : {{$course->functionalareaName}}) (Course Type : {{ $course->coursetypeName }}) (Degree Level : {{ $course->educationlevelName }})</option>
                    @endforeach   
                </select>
            @endif
        </div>
    </div>
</div>
@else
@if($submitButtonText == 'update')
<div class="row margin-bottom10">
    <div class="col-md-12">
        <h3 class="text-uppercase text-success">The college has not added any course, update the course first, then you can associate with that course.</h3>
    </div>
</div>
@endif
<div class="row margin-bottom10 emptyblock hide">
    <div class="col-md-12">
        <h3 class="text-uppercase text-success">The college has not added any course, update the course first, then you can associate with that course.</h3>
    </div>
</div>
<div class="clientContactDetails margin-bottom10 coursemasterblock">
    <h4 class="padding-bottom10">Associate Department Detail New</h4>
    <div class="row padding-top5 padding-bottom5">
        <div class="col-md-12"><label>Course</label></div>
        <div class="col-md-12">
            <select name="collegemaster_id[]" class="form-control coursemaster chosen-select " data-parsley-error-message=" Please select course" data-parsley-trigger="change" required="" multiple="multiple" data-placeholder="Choose a course...">
            </select>
        </div>
    </div>
</div>
@endif
<hr>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>