@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())


@section('page-title-name')
Examination Details
@endsection
@section('style')
<link rel="stylesheet" type="text/css" crossorigin="anonymous" media="all" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script rel="prefetch" type="text/javascript" crossorigin="anonymous" media="all" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style type="text/css">
  p{font-size: 16px; font-family: 'Montserrat', sans-serif;}
.clientContactDetails{box-shadow:#e2e2e2 0 0 23px; background-color: #fff; border-radius: 7px !important; padding: 20px;}
#canvasDiv{box-shadow:#e2e2e2 0 0 23px; background-color: #fff; border-radius: 7px !important;}

</style>
{{ Html::style('website-assets/css/bootstrap.min.css') }}
@endsection
@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('TypeOfExamination'); /*--}}
<div class="row border-bottom white-bg dashboard-header">
    <div class="col-lg-8">
        <h2>{{ $typeOfExaminationObj->name }} Examination Details</h2>        
    </div>    
    <div class="col-lg-4">
        <p class="margin-top10 text-right">
            <a href="{{ URL::to('examination/type-of-examination/'.$examId)}}" class="btn btn-sm btn-warning"><i class="fa fa-arrow-left"></i> Back</a>
        </p>
    </div>    
</div>
<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
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
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h4>UPDATE "{{ strtoupper($typeOfExaminationObj->name) }}" EXAMINATION DETAILS</h4>
                    </div>
                    <div class="panel-body">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="" aria-expanded="true">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="" aria-expanded="true">EXAM COUNSELLINGS</a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true" style="">
                                    <div class="panel-body">
                                        <h4 class="fontsize-20"><strong>EXAM COUNSELLINGS</strong></h4>
                                        @include('examination.common-partial.exam-counsellings')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@include('examination.common-partial.examination-scripts')
<script type="text/javascript">
    var date = new Date();
    date.setDate(date.getDate());

    $('.finalAppoinmentDate').datepicker({ 
        startDate: date,
        dateFormat: 'dd/mm/yy'
    });

</script>
@endsection