@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Edit What We Offer {{ $whatweoffer->id }} <a href="{{ url($fetchDataServiceController->routeCall().'/what-we-offer') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update what we offer details</h5>                            
            </div>
            <div class="ibox-content">
             {!! Form::model($whatweoffer, [
                'method' => 'PATCH',
                'url' => [$fetchDataServiceController->routeCall().'/what-we-offer', $whatweoffer->id],
                'class' => 'form-horizontal',
                'files' => true,
                'data-parsley-validate' => '', 
                'enctype' => 'multipart/form-data'
            ]) !!}

            @include ('administrator.what-we-offer.form', ['submitButtonText' => 'Update'])

            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>  
@endsection
@section('script')
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script>
  $('textarea').ckeditor({
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
  });
</script>

<script type="text/javascript">
    $(document).ready(function(){ 
        $('.iconImage').on('change',function(){
            $('#refresh1').removeClass('hide');
        });
        $('#refresh1').on('click',function(e){
            $('.iconImage').val('').trigger('chosen:updated');
            $('#refresh1').addClass('hide');
        });

        $('.bannerImage').on('change',function(){
            $('#refresh2').removeClass('hide');
        });
        $('#refresh2').on('click',function(e){
            $('.bannerImage').val('').trigger('chosen:updated');
            $('#refresh2').addClass('hide');
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
            //Disable input file
        });    

        $('input[name=bannerImage]').change(function (e)
        {   
            var ext = $('input[name=bannerImage]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' ){
                $("input[name=bannerImage]").parsley().reset();
                $('#bannerImage').addClass('hide');
            }else{
                $('#bannerImage').removeClass('hide');
                $('input[name=bannerImage]').val('');
                $("input[name=bannerImage]").parsley().reset();
                return false;
            }
            //Disable input file
        });     
    });
</script>

@endsection