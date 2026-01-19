<div class="form-group">
    <div class="col-sm-12">
        <label class="control-label" >Examination Name : </label>
        <select name="exam_id" class="form-control chosen-select " data-placeholder="Choose examination..."  data-parsley-error-message=" Please select examination" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select examination name </option>  
            @foreach( $listOfExamObj as $item )
                <option value="{{ $item->id }}" @if(isset($examcounsellingform) && $examcounsellingform->exam_id == $item->id) selected="" @endif>{{ $item->sortname }} - {{ $item->name }}</option>
            @endforeach
        </select>  
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Name</label>
        <input type="text" class="form-control modelmoreinput" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" placeholder="Full Name" data-parsley-trigger="change" data-parsley-error-message="Please enter your name" data-parsley-pattern="^[a-zA-Z\\/s .-]*$" required="" @if(isset($examcounsellingform) && $examcounsellingform->name) value="{{  $examcounsellingform->name }}" @else value="" @endif>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Email</label>
        <input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" name="email" class="form-control modelmoreinput" placeholder="Email Address" id="exampleInputPassword1" data-parsley-type="email" data-parsley-trigger="change" data-parsley-error-message="Please enter valid email address" required="" @if(isset($examcounsellingform) && $examcounsellingform->email) value="{{  $examcounsellingform->email }}" @else value="" @endif>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control modelmoreinput" placeholder="Mobile Number" id="exampleInputPassword1" data-parsley-trigger="change" data-parsley-error-message="Please enter valid mobile number" data-parsley-pattern="^[6-9][0-9]{9}$" minlength="10" maxlength="10" required="" @if(isset($examcounsellingform) && $examcounsellingform->phone) value="{{  $examcounsellingform->phone }}" @else value="" @endif>
    </div>
</div>
<hr>
<input type="hidden" name="misc" value="examination-page">
<hr>
<div class="form-group">
    <div class="col-sm-12">
        <label class="control-label" >City You Live In : </label>
        <select name="city_id" class="form-control chosen-select " data-placeholder="Choose stream..."  data-parsley-error-message=" Please select stream" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select city name </option>  
            @foreach( $cityListObj as $item )
                <option value="{{ $item->id }}" @if(isset($examcounsellingform) && $examcounsellingform->city_id == $item->id) selected="" @endif>{{ $item->name }} ({{ $item->stateName }})</option>
            @endforeach
        </select>  
    </div>
</div>

<hr>
<div class="form-group">
    <div class="col-sm-12">
        <label class="control-label" >Course Name : </label>
        <select name="course_id" class="form-control chosen-select " data-placeholder="Choose stream..."  data-parsley-error-message=" Please select stream" data-parsley-trigger="change" required="">
            <option value="" selected disabled>Select Interested In Course </option>  
            @foreach( $cousesListObj as $item )
                <option value="{{ $item->id }}" @if(isset($examcounsellingform) && $examcounsellingform->course_id == $item->id) selected="" @endif>{{ $item->name }} - {{ $item->degreeName }}</option>
            @endforeach
        </select>  
    </div>
</div>
<hr>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>