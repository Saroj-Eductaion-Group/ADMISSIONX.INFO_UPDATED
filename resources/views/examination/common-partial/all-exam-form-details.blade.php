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
        <h2>{{$typeOfExaminationObj[0]->name}} Examination Details</h2>        
    </div>    
    <div class="col-lg-4">
        <p class="margin-top10 text-right">
            <a href="{{ URL::to('examination/type-of-examination')}}" class="btn btn-sm btn-warning"><i class="fa fa-arrow-left"></i> Back</a>
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
                        <h4>UPDATE "{{strtoupper($typeOfExaminationObj[0]->name)}}" EXAMINATION DETAILS</h4>
                    </div>
                    <div class="panel-body">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="" aria-expanded="true">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="" aria-expanded="true">EXAMINATION DETAILS</a>
                                        <span class="pull-right btn btn-info btn-xs">Update</span>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true" style="">
                                    <div class="panel-body">
                                        <h4 class="fontsize-20"><strong>EXAMINATION DETAILS</strong></h4>
                                        @include('examination.common-partial.examination-details')
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">APPLICATION PROCESSES</a>
                                        <span class="pull-right btn btn-info btn-xs">Update</span>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <h4 class="fontsize-20"><strong>APPLICATION PROCESSES</strong></h4>
                                        @include('examination.common-partial.exam-application-processes')
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" class="collapsed">
                                    <h5 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" class="collapsed">EXAM ELIGIBILITIES</a>
                                        <span class="pull-right btn btn-info btn-xs">Update</span>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <h4 class="fontsize-20"><strong>EXAM ELIGIBILITIES</strong></h4>
                                        @include('examination.common-partial.exam-eligibilities')
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" class="collapsed" aria-expanded="false">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" class="collapsed" aria-expanded="false">EXAM DATES</a>
                                        <span class="pull-right btn btn-info btn-xs">Update</span>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <h4 class="fontsize-20"><strong>EXAM DATES</strong></h4>
                                        @include('examination.common-partial.exam-dates')
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" class="collapsed" aria-expanded="false">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" class="collapsed" aria-expanded="false">EXAM SYLLABUS PAPERS</a>
                                        <span class="pull-right btn btn-info btn-xs">Update</span>
                                    </h4>
                                </div>
                                <div id="collapseFive" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <h4 class="fontsize-20"><strong>EXAM SYLLABUS PAPERS</strong></h4>
                                        @include('examination.common-partial.exam-syllabus-papers')
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" class="collapsed" aria-expanded="false">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix" class="collapsed" aria-expanded="false">EXAM PATTERNS</a>
                                        <span class="pull-right btn btn-info btn-xs">Update</span>
                                    </h4>
                                </div>
                                <div id="collapseSix" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <h4 class="fontsize-20"><strong>EXAM PATTERNS</strong></h4>
                                        @include('examination.common-partial.exam-patterns')
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" class="collapsed" aria-expanded="false">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" class="collapsed" aria-expanded="false">EXAM ADMIT CARDS</a>
                                        <span class="pull-right btn btn-info btn-xs">Update</span>
                                    </h4>
                                </div>
                                <div id="collapseSeven" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <h4 class="fontsize-20"><strong>EXAM ADMIT CARDS</strong></h4>
                                        @include('examination.common-partial.exam-admit-cards')
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" class="collapsed" aria-expanded="false">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseEight" class="collapsed" aria-expanded="false">EXAM RESULTS</a>
                                        <span class="pull-right btn btn-info btn-xs">Update</span>
                                    </h4>
                                </div>
                                <div id="collapseEight" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <h4 class="fontsize-20"><strong>EXAM RESULTS</strong></h4>
                                        @include('examination.common-partial.exam-results')
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseNine" class="collapsed" aria-expanded="false">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseNine" class="collapsed" aria-expanded="false">EXAM CUT OFFS</a>
                                        <span class="pull-right btn btn-info btn-xs">Update</span>
                                    </h4>
                                </div>
                                <div id="collapseNine" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <h4 class="fontsize-20"><strong>EXAM CUT OFFS</strong></h4>
                                        @include('examination.common-partial.exam-cut-offs')
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseTen" class="collapsed" aria-expanded="false">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTen" class="collapsed" aria-expanded="false">EXAM COUNSELLINGS</a>
                                        <span class="pull-right btn btn-info btn-xs">Update</span>
                                    </h4>
                                </div>
                                <div id="collapseTen" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <h4 class="fontsize-20"><strong>EXAM COUNSELLINGS</strong></h4>
                                        @include('examination.common-partial.exam-counsellings')
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseEleven" class="collapsed" aria-expanded="false">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseEleven" class="collapsed" aria-expanded="false">EXAM PREPRATION TIPS</a>
                                        <span class="pull-right btn btn-info btn-xs">Update</span>
                                    </h4>
                                </div>
                                <div id="collapseEleven" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <h4 class="fontsize-20"><strong>EXAM PREPRATION TIPS</strong></h4>
                                        @include('examination.common-partial.exam-prepration-tips')
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseTwelve" class="collapsed" aria-expanded="false">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwelve" class="collapsed" aria-expanded="false">EXAM ANSWER KEY</a>
                                        <span class="pull-right btn btn-info btn-xs">Update</span>
                                    </h4>
                                </div>
                                <div id="collapseTwelve" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <h4 class="fontsize-20"><strong>EXAM ANSWER KEY</strong></h4>
                                        @include('examination.common-partial.exam-answer-keys')
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseThirteen" class="collapsed" aria-expanded="false">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThirteen" class="collapsed" aria-expanded="false">EXAM ANALYSIS RECORDS</a>
                                        <span class="pull-right btn btn-info btn-xs">Update</span>
                                    </h4>
                                </div>
                                <div id="collapseThirteen" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <h4 class="fontsize-20"><strong>EXAM ANALYSIS RECORDS</strong></h4>
                                        @include('examination.common-partial.exam-analysis-records')
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseFourteen" class="collapsed" aria-expanded="false">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFourteen" class="collapsed" aria-expanded="false">EXAMINATION REFERENCE LINKS</a>
                                        <span class="pull-right btn btn-info btn-xs">Update</span>
                                    </h4>
                                </div>
                                <div id="collapseFourteen" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <h4 class="fontsize-20"><strong>EXAMINATION REFERENCE LINKS</strong></h4>
                                        @include('examination.common-partial.examination-reference-links')
                                    </div>
                                </div>
                            </div>
                            
                            <div class="panel panel-default">
                                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseFifteen" class="collapsed" aria-expanded="false">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFifteen" class="collapsed" aria-expanded="false">EXAM FAQS</a>
                                        <span class="pull-right btn btn-info btn-xs">Update</span>
                                    </h4>
                                </div>
                                <div id="collapseFifteen" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <h4 class="fontsize-20"><strong>EXAM FAQS</strong></h4>
                                        @include('examination.common-partial.exam-faqs')
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseSixteen" class="collapsed" aria-expanded="false">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseSixteen" class="collapsed" aria-expanded="false">ASK EXAM QUESTIONS & ANSWER</a>
                                        <span class="pull-right btn btn-info btn-xs">Update</span>
                                    </h4>
                                </div>
                                <div id="collapseSixteen" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <h4 class="fontsize-20"><strong>ASK EXAM QUESTIONS & ANSWER</strong></h4>
                                        @include('examination.common-partial.exam-questions')
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