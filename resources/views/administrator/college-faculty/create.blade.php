@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())


@section('styles')
  {!! Html::style('home-layout/assets/css/pages/profile.css') !!}
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
  <style type="text/css">
    .clientContactDetails{box-shadow:#e2e2e2 0 0 23px; background-color: #fff; border-radius: 7px !important; padding: 20px;}
  </style>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js" type="text/javascript"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Create New College Faculty<a href="{{ url($fetchDataServiceController->routeCall().'/faculty') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add new College Faculty</h5>                            
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
            {!! Form::open(['url' => $fetchDataServiceController->routeCall().'/faculty', 'class' => 'form-horizontal','data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
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
<script type="text/javascript">
  $('select[name=collegeprofile_id]').on('change', function(){
    var HTML = '';
    //HTML += '<option value="" selected="">-- Select an option --</option>';
    $.ajax({
        method: "GET",
        data: { collegeId: $(this).val() },
        url: "{{ URL::to('/getAllCollegeCourseNameData') }}",
        success: function(data) {
            if (data.code == 200) {
              $('.coursemasterblock').removeClass('hide');
              $('.emptyblock').addClass('hide');
            }else{
              $('.coursemasterblock').addClass('hide');
              $('.emptyblock').removeClass('hide');
            }
            $.each(data.collegeCourseObj, function(key, value) {
                HTML += '<option value='+data.collegeCourseObj[key].collegemasterId+'>'+data.collegeCourseObj[key].courseName+ '(Degree : '+data.collegeCourseObj[key].degreeName+' | Stream : '+data.collegeCourseObj[key].functionalareaName+' ) (Course Type : '+data.collegeCourseObj[key].coursetypeName+') (Degree Level : '+data.collegeCourseObj[key].educationlevelName+')</option>';
            });
            $('.coursemaster').html(HTML);
            $('.coursemaster').trigger("chosen:updated");
        }
    });
});
</script>
@endsection