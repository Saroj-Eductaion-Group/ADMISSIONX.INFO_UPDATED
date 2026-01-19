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
<div class="row border-bottom white-bg dashboard-header">
    <div class="col-lg-8">
        <h2>{{$counselingBoard->name}} Examination Details</h2>        
    </div>    
    <div class="col-lg-4">
        <p class="margin-top10 text-right">
            <a href="{{ URL::to('counseling/counseling-boards')}}" class="btn btn-sm btn-warning"><i class="fa fa-arrow-left"></i> Back</a>
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
                        <h4>UPDATE "{{strtoupper($counselingBoard->title)}}" Details</h4>
                    </div>
                    <div class="panel-body">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="" aria-expanded="true">{{strtoupper($counselingBoard->title)}} Details</a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true" style="">
                                    <form class="margin-top20" method="post" action="/update/counseling-boards-details/{{$boardId}}" data-parsley-validate="" files=" true"  enctype="multipart/form-data">
                                        <div class="panel-body">
                                            @include('counseling.common-partial.board-detail-partial')
                                            <div class="col-sm-12 text-center">
                                                <div class="form-group mb-0 mt-20">
                                                    <button type="submit" class="btn btn-primary fontMontserrat fontsize-15 pt-2 pb-2 submitBtn" data-loading-text="Please wait...">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
@include('counseling.common-partial.counseling-board-scripts')
<script type="text/javascript">
    var date = new Date();
    date.setDate(date.getDate());

    $('.finalAppoinmentDate').datepicker({ 
        startDate: date,
        dateFormat: 'dd/mm/yy'
    });

</script>
@endsection