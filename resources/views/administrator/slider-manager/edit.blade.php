@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Edit Slider Manager {{ $slidermanager->id }} <a href="{{ url($fetchDataServiceController->routeCall().'/slider-manager') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update Slider Manager details</h5>                            
            </div>
            <div class="ibox-content">
             {!! Form::model($slidermanager, [
                'method' => 'PATCH',
                'url' => [$fetchDataServiceController->routeCall().'/slider-manager', $slidermanager->id],
                'class' => 'form-horizontal',
                'files' => true,
                'data-parsley-validate' => '', 
                'enctype' => 'multipart/form-data'
            ]) !!}

             @include ('administrator.slider-manager.form', ['submitButtonText' => 'Update'])

            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>  
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function(){ 
        $('.bannerImage').on('change',function(){
            $('#refresh2').removeClass('hide');
        });
        $('#refresh2').on('click',function(e){
            $('.bannerImage').val('').trigger('chosen:updated');
            $('#refresh2').addClass('hide');
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
<script type="text/javascript">
    $("form").submit( function( e ) {
        var form = this;
        e.preventDefault(); //Stop the submit for now
                                    //Replace with your selector to find the file input in your form
        var fileInput = $(this).find("input[type=file]")[0],
            file = fileInput.files && fileInput.files[0];

        if( file ) {
            var img = new Image();

            img.src = window.URL.createObjectURL( file );

            img.onload = function() {
                var width = img.naturalWidth,
                    height = img.naturalHeight;

                window.URL.revokeObjectURL( img.src );

                if((width >= 1300 && width <= 1600)  && (height >= 350 && height <= 500) ) {
                    form.submit();
                }else {
                    alert("Sorry, this image doesn\'t look like the size we wanted. It\'s  width ("+width+") height ("+height+") but we require weight (1300 to 1600) x  height (350 to 500) size image.");
                }
            };
        }
        else { //No file was input or browser doesn't support client side reading
            form.submit();
        }
    });
</script>
@endsection