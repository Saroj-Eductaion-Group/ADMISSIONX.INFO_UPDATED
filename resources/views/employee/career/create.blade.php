@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Create New Career Profile <!-- <a href="{{ URL::to('employee/career') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add new career details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::open(['url' => 'employee/career', 'class' => 'form-horizontal', 'data-parsley-validate' => '','files'=>true, 'enctype' => 'multipart/form-data']) !!}

            <div class="form-group">
                <label class="col-sm-2 control-label" >Name : </label>
                <div class="col-sm-10">
                    {!! Form::text('firstname', null, ['class' => 'form-control', 'placeholder' => 'Enter name here', 'data-parsley-error-message' => 'Please enter name here', 'data-parsley-trigger'=>'change' ,'required'=>'','data-parsley-pattern'=>'^[a-zA-Z\s .]*$']) !!}
                </div>
            </div>
            <!--  <div class="form-group">
                <label class="col-sm-2 control-label" >Middle Name : </label>
                <div class="col-sm-10">
                    {!! Form::text('middlename', null, ['class' => 'form-control', 'placeholder' => 'Enter middle name here', 'data-parsley-error-message' => 'Please enter middle name here', 'data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >Last Name : </label>
                <div class="col-sm-10">
                    {!! Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Enter last name here', 'data-parsley-error-message' => 'Please enter last name here', 'data-parsley-trigger'=>'change']) !!}
                </div>
            </div> -->
            <div class="form-group">
                <label class="col-sm-2 control-label" >Email : </label>
                <div class="col-sm-10">
                    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter email here', 'data-parsley-error-message' => 'Please enter email here', 'data-parsley-trigger'=>'change', 'required'=> '' , 'data-parsley-type' => 'email']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Phone Number : </label>
                <div class="col-sm-10">
                    {!! Form::text('phonenumber', null, ['class' => 'form-control', 'placeholder' => 'Enter phone number here', 'data-parsley-error-message' => 'Please enter phone number here', 'data-parsley-trigger'=>'change' ])!!}<!-- ,'data-parsley-pattern' =>'^[7-9][0-9]{9}$', 'data-parsley-maxlength'=>'10' ,'maxlength'=>'10' -->
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Gender : </label>
                <div class="col-sm-10">
                    <select name="gender" class="form-control chosen-select" data-placeholder="Choose sex ..." data-parsley-error-message=" Please select sex " data-parsley-trigger="change" required="">
                        <option value="" selected disabled >Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>      
            <div class="form-group">
                <label  class="col-sm-2 control-label">Date Of Birth</label>
                <div class="col-sm-10">
                     {!! Form::date('dateOfBirth', null, ['class' => 'form-control', 'id' => 'datepicker', 'placeholder' => 'Enter date of birth here ', 'data-parsley-error-message' => 'Please enter your date of birth', 'required' => '','data-parsley-trigger'=>'change']) !!}
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >Post applied for : </label>
                <div class="col-sm-10">
                    {!! Form::text('postappliedfor', null, ['class' => 'form-control', 'placeholder' => 'Enter post here', 'data-parsley-error-message' => 'Please enter your post', 'required' => '','data-parsley-trigger'=>'change']) !!}

                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label">Upload Your CV</label>
                <div class="col-sm-10">
                    <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh2"class="hide"><i class="fa fa-remove"></i></a> </span>
                     <input type="file" class="form-control" name="cvFIle" class="input input-file cvFile"  data-parsley-trigger="change" data-parsley-error-message="Please upload .jpg, .jpeg, .png, .doc, .docx and .pdf file only">
                    <p class="text-danger hide" id="cvDoc">(please upload .jpg, .jpeg, .png, .doc, .docx and .pdf file only)</p>
                </div>
            </div>
            <!-- <div class="form-group">
                <label class="col-sm-2 control-label" >Address : </label>
                <div class="col-sm-10">
                    {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Enter address here', 'data-parsley-error-message' => 'Please enter address ', 'data-parsley-trigger'=>'change']) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" >Postal Code : </label>
                <div class="col-sm-10">
                    {!! Form::text('pincode', null, ['class' => 'form-control', 'placeholder' => 'Enter postal code here', 'data-parsley-error-message' => 'Please enter postal code here',  'data-parsley-type'=>'digits', 'data-parsley-trigger' => 'change', 'data-parsley-length' => '[5, 7]', 'data-parsley-error-message'=>'Please enter valid postal code of 5 to 7 digits']) !!}
                </div>
            </div>
            
            <div class="row padding-top5 padding-bottom5">
                <label class="col-md-2 control-label">Select State</label>
                <div class="col-md-10">
                    <select name="stateName" class="form-control chosen-select stateName" id="stateName" data-parsley-trigger="change" data-parsley-error-message="Please select your state" required="">
                        <option value="" selected disabled>Select state</option>  
                        @foreach ($stateNameObj as $state)
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach         
                    </select>
                </div>
            </div>

            <div class="row padding-top5 padding-bottom5">
                <label class="col-md-2 control-label">Select City</label>
                <div class="col-md-10">
                    <select name="city_id" class="form-control chosen-select cityName" data-parsley-trigger="change" data-parsley-error-message="Please select your city" required="">
                        <option value="" selected disabled>Select city</option>  
                          
                    </select>
                </div>
            </div> -->
          <!--  @foreach ($cityNameObj as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach     -->  

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
    $(document).ready(function(){   

        $('.cvFile').on('change',function(){
            $('#refresh2').removeClass('hide');
        });
        $('#refresh2').on('click',function(e){
            $('.cvFile').val('').trigger('chosen:updated');
            $('#refresh2').addClass('hide');
        });


        $('input[name=cv]').change(function (e)
        {  
            var ext = $('input[name=cv]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' || ext == 'pdf' || ext == 'doc' || ext == 'docx'){
                $('#cvDoc').addClass('hide');
            }else{
                $('input[name=cv]').val('');
                $('#cvDoc').removeClass('hide');
                return false;
            }
            //Disable input file
        });

        $('.stateName').on('change', function(){
            var stateId = $(this).val();
            var HTML = '';
            $.ajax({
                headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
                },
                method: "GET",
                data: { stateId: stateId },
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                url: "{{ URL::to('/getAllCityNameData') }}",
                success: function(data) {
                    $.each(data.cityData, function(key, value) {
                        HTML += '<option value='+data.cityData[key].id+'>'+data.cityData[key].name+'</option>';
                    });
                    $('.cityName').html(HTML);
                    $('.cityName').trigger("chosen:updated");
                }
            });
        });
    });
</script>

@endsection