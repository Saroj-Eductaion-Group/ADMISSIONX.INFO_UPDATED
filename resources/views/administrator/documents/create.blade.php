@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Create New Document <!-- <a href="{{ url('administrator/documents') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add new document details</h5>
            </div>
            <div class="ibox-content">
            {!! Form::open(['url' => 'administrator/documents', 'class' => 'form-horizontal','data-parsley-validate' => '','method'=>'POST', 'files'=>true, 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                <label  class="col-sm-2 control-label">Upload Your Document</label>
                <div class="col-sm-10">
                    <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a> </span>
                     <input type="file" name="uploadCollegeDoc" class="uploadCollegeDoc form-control" data-parsley-filemaxmegabytes="2" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/jpg, image/png" required="" >
                     <p class="text-danger hide" id="documentImage">(please upload .png, .jpg and .jpeg file only)</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Description : </label>
                <div class="col-sm-10">
                    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Enter description here', 'data-parsley-error-message' => 'Please enter description here', 'data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
            
            
            <div class="form-group">
                <label class="col-sm-2 control-label" >College / Student Name : </label>
                <div class="col-sm-10">
                    <select name="users_id" class="form-control chosen-select " data-parsley-error-message=" Please select college / student name" data-parsley-trigger="change"  required="">
                        <option value="" selected disabled>Select College / Student Name</option>  
                        @foreach ($userObj as $user)
                            <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}</option>
                        @endforeach    
                    </select>     
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
{!! Html::script('assets/js/parsley.min.js') !!}

<script type="text/javascript">
  $('form').parsley();
</script>
<script type="text/javascript">
    $(document).ready(function(){ 
        
        $('.uploadCollegeDoc').on('click',function(){
            $('#refresh2').removeClass('hide');
        });
        $('#refresh2').on('click',function(e){
            $('.uploadCollegeDoc').val('').trigger('chosen:updated');
            $('#refresh2').addClass('hide');
        });

        $('input[name=uploadCollegeDoc]').change(function (e)
        {  
            var ext = $('input[name=uploadCollegeDoc]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' ){
                $('#documentImage').addClass('hide');
            }else{
                $('input[name=uploadCollegeDoc]').val('');
                $('#documentImage').removeClass('hide');
                return false;
            }
            //Disable input file
        }); 

        $('input[name=uploadCollegeDoc]').change(function (e)
        {   
            var ext = $('input[name=uploadCollegeDoc]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' ){
                $("input[name=uploadCollegeDoc]").parsley().reset();
            }else{
                $('input[name=uploadCollegeDoc]').val('');
                $("input[name=uploadCollegeDoc]").parsley().reset();
                return false;
            }
            //Disable input file
        });      
    });
</script>

@endsection