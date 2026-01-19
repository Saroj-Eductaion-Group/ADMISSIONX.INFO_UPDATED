@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Edit New Exam Section <a href="{{ url('examination/exam-section') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update exam section details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::model($examsection, [
                'method' => 'PATCH',
                'url' => ['/examination/exam-section', $examsection->id],
                'class' => 'form-horizontal',
                'data-parsley-validate' => '', 
                'enctype' => 'multipart/form-data',
                'files' => true
            ]) !!}

            @include ('examination.exam-section.form', ['submitButtonText' => 'Update'])

            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>  
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function(){ 
        $('.iconImage').on('change',function(){
            $('#refresh1').removeClass('hide');
        });
        $('#refresh1').on('click',function(e){
            $('.iconImage').val('').trigger('chosen:updated');
            $('#refresh1').addClass('hide');
        });

        $('input[name=iconImage]').change(function (e)
        {   
            var ext = $('input[name=iconImage]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' ){
                $("input[name=iconImage]").parsley().reset();
                $('#iconImage').addClass('hide');
            }else{
                $('#iconImage').removeClass('hide');
                $('input[name=iconImage]').val('');
                $("input[name=iconImage]").parsley().reset();
                return false;
            }
        });    
    });
</script>
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
            url: "{{ URL::to('getFunctionalAreaName') }}",
            success: function(data) {
                if( data.code == '200' ){
                    $.each(data.functionalareaObj, function(i, item) {
                        $('input[name=name]').val(data.functionalareaObj[i].name);
                    }); 
                }
            }
        });
    });
</script>
@endsection