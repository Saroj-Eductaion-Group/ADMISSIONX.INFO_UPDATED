@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Create New Gallery / Affiliation / Accreditation Letters<!-- <a href="{{ url('employee/galleries') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add New Gallery details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::open(['url' => 'employee/galleries', 'class' => 'form-horizontal','data-parsley-validate' => '','method'=>'POST', 'files'=>true, 'enctype' => 'multipart/form-data']) !!}

            <div class="form-group">
                <label  class="col-sm-2 control-label">Upload Your Document</label>
                <div class="col-sm-10">
                    <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh2"class="hide"><i class="fa fa-remove"></i></a> </span>
                     <input type="file" class="form-control input input-file uploadCollegeImg" name="uploadCollegeImg" data-parsley-filemaxmegabytes="2" data-parsley-trigger="change" required="">
                     <p class="text-danger hide" id="galleryImage">(please upload .png, .jpg and .jpeg file only)</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Caption : </label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="caption" placeholder="Enter caption here" data-parsley-trigger="change" data-parsley-error-message="Please enter caption" >
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label" >User Name : </label>
                <div class="col-sm-10">
                    <select name="usersName" class="form-control chosen-select " data-parsley-error-message=" Please select user name" data-parsley-trigger="change"  required="">
                        <option value="" selected disabled>Select User Name</option>  
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

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add New Affiliation / Accreditation Letters Details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::open(['url' => 'employee/affiliation-accreditation', 'class' => 'form-horizontal','data-parsley-validate' => '','method'=>'POST', 'files'=>true, 'enctype' => 'multipart/form-data']) !!}

            <div class="form-group">
                <label  class="col-sm-2 control-label">Upload Your Document</label>
                <div class="col-sm-10">
                    <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh3"class="hide"><i class="fa fa-remove"></i></a> </span>
                     <input type="file" class="form-control input input-file uploadAffiliationLettersImage" name="uploadAffiliationLettersImage" data-parsley-filemaxmegabytes="2" data-parsley-trigger="change" required="">
                     <p class="text-danger hide" id="AffiliationLettersImage">(please upload .png, .jpg and .jpeg file only)</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Caption : </label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="caption" placeholder="Enter caption here" data-parsley-trigger="change" data-parsley-error-message="Please enter caption" >
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label" >User Name : </label>
                <div class="col-sm-10">
                    <select name="usersName" class="form-control chosen-select " data-parsley-error-message=" Please select user name" data-parsley-trigger="change"  required="">
                        <option value="" selected disabled>Select User Name</option>  
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

@section('scripts')
{!! Html::script('assets/js/parsley.min.js') !!}

<script type="text/javascript">
  $('form').parsley();
</script>
<script type="text/javascript">
    $(document).ready(function(){ 
        
        $('.uploadCollegeImg').on('change',function(){
            $('#refresh2').removeClass('hide');
        });
        $('#refresh2').on('click',function(e){
            $('.uploadCollegeImg').val('').trigger('chosen:updated');
            $('#refresh2').addClass('hide');
        });

        $('.uploadAffiliationLettersImage').on('change',function(){
            $('#refresh3').removeClass('hide');
        });
        $('#refresh3').on('click',function(e){
            $('.uploadAffiliationLettersImage').val('').trigger('chosen:updated');
            $('#refresh3').addClass('hide');
        });


        $('input[name=uploadCollegeImg]').change(function (e)
        {  
            var ext = $('input[name=uploadCollegeImg]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg'  ){
                $('#galleryImage').addClass('hide');
            }else{
                $('input[name=uploadCollegeImg]').val('');
                $('#galleryImage').removeClass('hide');
                return false;
            }
            //Disable input file
        }); 

        $('input[name=uploadCollegeImg]').change(function (e)
        {   
            var ext = $('input[name=uploadCollegeImg]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg'  ){
                $("input[name=uploadCollegeImg]").parsley().reset();
            }else{
                $('input[name=uploadCollegeImg]').val('');
                $("input[name=uploadCollegeImg]").parsley().reset();
                return false;
            }
            //Disable input file
        });

        $('input[name=uploadAffiliationLettersImage]').change(function (e)
        {  
            var ext = $('input[name=uploadAffiliationLettersImage]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf' ){
                $('#AffiliationLettersImage').addClass('hide');
            }else{
                $('input[name=uploadAffiliationLettersImage]').val('');
                $('#AffiliationLettersImage').removeClass('hide');
                return false;
            }
            //Disable input file
        }); 

        $('input[name=uploadAffiliationLettersImage]').change(function (e)
        {   
            var ext = $('input[name=uploadAffiliationLettersImage]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf' ){
                $("input[name=uploadAffiliationLettersImage]").parsley().reset();
            }else{
                $('input[name=uploadAffiliationLettersImage]').val('');
                $("input[name=uploadAffiliationLettersImage]").parsley().reset();
                return false;
            }
            //Disable input file
        });            
    });
</script>

@endsection