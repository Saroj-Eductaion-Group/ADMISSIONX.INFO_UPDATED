@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Create New Testimonial <!-- <a href="{{ url('administrator/testimonial') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add new testimonial details</h5>
            </div>
            <div class="ibox-content">
            {!! Form::open(['url' => 'administrator/testimonial', 'class' => 'form-horizontal','data-parsley-validate' => '','method'=>'POST', 'files'=>true, 'enctype' => 'multipart/form-data']) !!}
            
            <div class="form-group">
                <label class="col-sm-2 control-label" >Author Name : </label>
                <div class="col-sm-10">
                        {!! Form::text('author', null, ['class' => 'form-control', 'placeholder' => 'Enter author here', 'data-parsley-error-message' => 'Please enter author here', 'data-parsley-trigger'=>'change','required' => '']) !!}                    
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Designation : </label>
                <div class="col-sm-10">
                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter designation here', 'data-parsley-error-message' => 'Please enter designation here', 'data-parsley-trigger'=>'change','required' => '']) !!}
                </div>
            </div> 
            <div class="form-group">
                <label  class="col-sm-2 control-label">Upload Testimonial Image : </label>
                <div class="col-sm-10">
                    <span class="pull-right text-danger"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a> </span>
                     <input type="file" name="uploadTestimonialDoc" class="uploadTestimonialDoc form-control" data-parsley-filemaxmegabytes="2" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/jpg, image/png" required="" data-parsley-error-message="Please upload image">
                     <p class="text-danger hide" id="testimonialImage">(please upload .png, .jpg and .jpeg file only)</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Description : </label>
                <div class="col-sm-10">
                    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Enter description here','data-parsley-error-message' => 'Please enter description here maximum 350 character', 'data-parsley-trigger'=>'change','required' => '','data-parsley-maxlength'=>'350','maxlength'=>'350']) !!}
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
        
        $('.uploadTestimonialDoc').on('click',function(){
            $('#refresh2').removeClass('hide');
        });
        $('#refresh2').on('click',function(e){
            $('.uploadTestimonialDoc').val('').trigger('chosen:updated');
            $('#refresh2').addClass('hide');
        });

        $('input[name=uploadTestimonialDoc]').change(function (e)
        {  
            var ext = $('input[name=uploadTestimonialDoc]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' ){
                $('#testimonialImage').addClass('hide');
            }else{
                $('input[name=uploadTestimonialDoc]').val('');
                $('#testimonialImage').removeClass('hide');
                return false;
            }
            //Disable input file
        }); 

        $('input[name=uploadTestimonialDoc]').change(function (e)
        {   
            var ext = $('input[name=uploadTestimonialDoc]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' ){
                $("input[name=uploadTestimonialDoc]").parsley().reset();
            }else{
                $('input[name=uploadTestimonialDoc]').val('');
                $("input[name=uploadTestimonialDoc]").parsley().reset();
                return false;
            }
            //Disable input file
        });      
    });
</script>

@endsection