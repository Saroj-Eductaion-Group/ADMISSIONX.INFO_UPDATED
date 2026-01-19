@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Edit Counseling Career Relevant <a href="{{ url('counseling/counseling-career-relevant') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update Counseling Career Relevant </h5>
                <a class="pull-right" href="{{ url('counseling/career/update-form-details/' . $counselingcareerrelevant->id) }}">
                    <button type="submit" class="btn btn-warning btn-xs">Update Career Details</button>
                </a>
            </div>
            <div class="ibox-content">
            {!! Form::model($counselingcareerrelevant, [
                'method' => 'PATCH',
                'url' => ['/counseling/counseling-career-relevant', $counselingcareerrelevant->id],
                'class' => 'form-horizontal',
                'data-parsley-validate' => '', 
                'enctype' => 'multipart/form-data',
                'files' => true
            ]) !!}

            @include ('counseling.counseling-career-relevant.form', ['submitButtonText' => 'Update'])

            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>  
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function(){ 
        $('.image').on('change',function(){
            $('#refresh1').removeClass('hide');
        });
        $('#refresh1').on('click',function(e){
            $('.image').val('').trigger('chosen:updated');
            $('#refresh1').addClass('hide');
        });

        $('input[name=image]').change(function (e)
        {   
            var ext = $('input[name=image]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' ){
                $("input[name=image]").parsley().reset();
                $('#image').addClass('hide');
            }else{
                $('#image').removeClass('hide');
                $('input[name=image]').val('');
                $("input[name=image]").parsley().reset();
                return false;
            }
        });    
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $(window).keydown(function(event){
        if(event.keyCode == 13) {
          event.preventDefault();
          return false;
        }
      });
    });
  $('.summernote').summernote();
</script>
@endsection