
@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Update Faculty <!-- <a href="{{ url('employee/faculty') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update faculty details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::model($faculty, ['method' => 'PATCH', 'url' => ['employee/faculty', $faculty->id], 'class' => 'form-horizontal','data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}

            <div class="form-group">
                <label class="col-sm-2 control-label" >Name : </label>
                <div class="col-sm-10">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter name here', 'data-parsley-error-message' => 'Please enter entrance exam name here', 'data-parsley-trigger'=>'change','data-parsley-pattern'=>'^[a-zA-Z\\/s &().,-]*$']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Description : </label>
                <div class="col-sm-10">
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter description here', 'data-parsley-error-message' => 'Please enter description here', 'data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >College Profile : </label>
                <div class="col-sm-10">
                    <select name="collegeprofile_id" class="form-control chosen-select " data-placeholder="Choose college profile..."  data-parsley-error-message=" Please select college profile" data-parsley-trigger="change" required="">
                        <option value="" selected disabled>Select College Profile</option>  
                        @foreach( $usersObj as $users )
                            @if( $users->userRoleId == '2' )
                                @if( $faculty->collegeprofile_id == $users->id )
                                    <option value="{{ $users->id }}" selected="">{{ $users->firstname }} </option>
                                @else
                                    <option value="{{ $users->id }}">{{ $users->firstname }} </option>
                                @endif
                            @endif
                        @endforeach 
                    </select>     
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >College Course : </label>
                <div class="col-sm-10">
                    <select name="collegemaster_id" class="form-control chosen-select " data-placeholder="Choose college course name..."  data-parsley-error-message=" Please select college course name" data-parsley-trigger="change" >
                        <option value="" selected disabled>Select College Course</option>  
                        @foreach ($collegeCourseObj as $collegeCourse)
                            @if( $faculty->collegemaster_id == $collegeCourse->id )
                                <option value="{{ $collegeCourse->id }}" selected="">{{ $collegeCourse->id }} </option>
                            @else
                                <option value="{{ $collegeCourse->id }}">{{ $collegeCourse->id }}</option>
                            @endif
                        @endforeach     
                    </select>     
                </div>
            </div>
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

<script type="text/javascript">
    $('select[name=collegeprofile_id]').on('change', function(){
        var currentID = $(this).val();
        $.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {currentID: currentID},
            url: "{{ URL::to('getAllCollegeMasterName') }}",
            success: function(data) {
                var HTML = '';
                HTML += '<option selected="" disabled="">Select college master</option>';
                if( data.code == '200' ){
                    $.each(data.collegeMasterObj, function(i, item) {
                        HTML += '<option value="'+data.collegeMasterObj[i].collegemasterId+'">'+data.collegeMasterObj[i].collegemasterId+'</option>';
                    }); 
                }else{
                    HTML += '<option selected="" disabled="">No college master available</option>';
                }

                $('select[name="collegemaster_id"]').empty();
                $('select[name="collegemaster_id"]').html(HTML);
                $('select[name="collegemaster_id"]').trigger('chosen:updated');
            }
        });
    });
</script>

@endsection