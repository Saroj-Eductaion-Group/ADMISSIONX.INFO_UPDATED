@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Edit College Faculty <a href="{{ url($fetchDataServiceController->routeCall().'/faculty') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update College Faculty </h5>
            </div>
            @if(Session::has('flash_message'))
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="alert {{ Session::get('alert_class') }}  alert-dismissible fade in text-center" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>{{ Session::get('flash_message') }}</strong>
                        </div>
                    </div>
                </div>
            @endif
            <div class="ibox-content">
            {!! Form::model($getFacultyObj, [
                'method' => 'PATCH',
                'url' => [$fetchDataServiceController->routeCall().'/faculty', $getFacultyObj->id],
                'class' => 'form-horizontal',
                'data-parsley-validate' => '', 
                'enctype' => 'multipart/form-data',
                'files' => true
            ]) !!}

            @include ('administrator.college-faculty.form', ['submitButtonText' => 'Update'])

            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>  
@endsection
@section('script')
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
@include('college/college-faculty.search_country_state_city')

@endsection