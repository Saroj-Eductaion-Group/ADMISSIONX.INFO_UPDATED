@extends('employee/admin-layouts.master')

@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
@endsection
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>Transaction Analytics Dashboard</h2>
        </div>
    </div>

  <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                     <h5>Here are the details</h5>              
                </div>

                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-12 text-right">   
                            <a href="javascript:void(0);" class="btn btn-primary filterout">Filter</a>
                        </div>
                    </div>
                    <div class="slideDown" style="visibility:hidden">
                        {!! Form::open(['url' => 'employee/search-transaction-analytics', 'class' => 'form-horizontal search-form', 'data-parsley-validate'=>'data-parsley-validate']) !!}
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                         <div class="col-md-3">
                                              <h4 for="usr">Payment Status<span class="pull-right"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                             <select name="paymentStatus" class="form-control paymentStatus chosen-select" data-placeholder="Choose Payment Status ..."  data-parsley-error-message=" Please select payment status " data-parsley-trigger="change" >
                                                  <option value="" disabled="" selected="">Select payment status</option>
                                                  @foreach( $paymentStatusObj as $payment )
                                                      <option value="{{ $payment->id }}">{{ $payment->name }} </option>
                                                  @endforeach
                                              </select>              
                                          </div> 
                                        <div class="col-md-9">
                                          <h4 for="usr">Transaction Date From &amp; To <span class="pull-right"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                          <div class="form-group" id="data_5">
                                              <div class="input-daterange input-group" id="datepicker">
                                                  <input type="text" id="txtFromCreateDate" class="form-control startRange" name="startRange" value="" placeholder="Transaction Form" data-parsley-trigger="change" data-parsley-error-message="Please select transaction date from" required>
                                                  <span class="input-group-addon">to</span>
                                                  <input type="text" id="txtToCreateDate" class="form-control endRange" name="endRange" value="" placeholder="Transactions To" data-parsley-trigger="change" data-parsley-error-message="Please select transaction date to" required>                            
                                              </div>
                                          </div> 
                                        </div>                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 text-right">
                                            <a href="{{ URL::to('employee/transaction-analytics') }}" class="btn btn-default btn-sm">Close</a>
                                            <button class="btn btn-primary btn-sm">Search</button>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        {!! Form::close() !!}
                    </div>  
                    <div class="hr-line-dashed"></div>
                    <div class="row analytic-box-content">
                        <div class="ibox float-e-margins transaction-graph">
                            <div class="ibox-content">
                                <h2>Updated transaction data</h2>
                                <hr class="hr-line-dashed"></hr>
                                <div id="morris-one-line-chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <p class="message-no-match center-block label label-danger hide">Transaction Analytics Match Not Found!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
{!! Html::script('js/moment.js') !!}
{!! Html::script('assets/js/morris/morris.js') !!}
{!! Html::script('assets/js/morris/raphael-2.1.0.min.js') !!}
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
    //Remove cross icon
     $(".chosen-select").chosen({
          placeholder_text_single: "Select an option",
          no_results_text: "Oops, nothing found!"
      });

    $('.startRange').on('blur',function(){
        $('#refresh1').removeClass('hide');
    });
    $('.endRange').on('blur',function(){
        $('#refresh1').removeClass('hide');
    });
    $('#refresh1').on('click',function(e){
      $('.startRange').val('');
      $('.endRange').val('');
      $('#refresh1').addClass('hide');
    });

    $('.paymentStatus').on('change',function(){
        $('#refresh2').removeClass('hide');
    });
    $('#refresh2').on('click',function(e){
        $('.paymentStatus').val('').trigger('chosen:updated');
        $('#refresh2').addClass('hide');
    });   
   });     
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('.slideDown').hide();
    $('.filterout').on('click',function(){
        $(".slideDown").toggle();
        $(".slideDown").css('visibility', 'visible');
        $(".resetfilter").addClass('hide');
        $(".exportToExcel").addClass('hide');
    });

    $("#txtFromCreateDate").datepicker({
        numberOfMonths: 1,
        onSelect: function(selected) {
          $("#txtToCreateDate").datepicker("option","minDate", selected)
        }
    });
    $("#txtToCreateDate").datepicker({ 
        numberOfMonths: 1,
        onSelect: function(selected) {
           $("#txtFromCreateDate").datepicker("option","maxDate", selected)
        }
    });   
});
</script>
<script type="text/javascript">
    $(function() {
        var transactionAnalytics = {!! $transactionAnalytics !!};
        if( transactionAnalytics != '0' ){
            Morris.Line({
                element: 'morris-one-line-chart',
                data: transactionAnalytics,
                xkey: 'transactionDate',
                ykeys: ['transactionAnalytics'],
                labels: ['Total Application'],
                parseTime: false,
                resize: true,
                lineWidth:5,
                pointSize:5,
                lineColors: ['#1ab394'],
            });    
        }
  });
</script>
@endsection


