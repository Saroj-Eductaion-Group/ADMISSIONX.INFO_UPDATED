@extends('administrator/admin-layouts.master')
@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>Generate Reports</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-md-7 col-md-offset-3">
                @if(Session::has('warning'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>{{ Session::get('warning') }}</strong>
                    </div>                        
                @endif
            </div>    
        </div> 
        <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">
                    <h2><span class="text-navy">College Profile Search Report</span></h2>
                    <button id="generateReport2" class="btn btn-primary" >Generate Reports</button>
                    <div class="collegeProfileReport">     
                    <div class="hr-line-dashed"></div>
                    {!! Form::open(['url' => 'export/search-result', 'class' => 'form-horizontal search-form', 'data-parsley-validate'=>'data-parsley-validate']) !!}
                        <div class="row">
                            <div class="col-md-3">
                                <h4 for="usr">College Name<span class="pull-right"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                <select class="form-control chosen-select collegeName"  name="collegeName" data-parsley-trigger="change" data-parsley-error-message="Please select college" data-placeholder="Please select college">
                                    <option value="" disabled="" selected="">Select college</option>
                                    @foreach( $collegeProfileObj as $college )
                                        <option value="{{ $college->firstname }}">{{ $college->firstname }}</option>
                                    @endforeach
                                </select> 
                            </div>
                            <div class="col-md-3">
                                <h4 for="usr">University
                                <span class="pull-right"><a href="javascript:void(0);" id="refresh4" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                <select class="form-control chosen-select university_id"  name="university_id" data-parsley-trigger="change" data-parsley-error-message="Please select university" data-placeholder="Please select university">
                                    <option value="" disabled="" selected="">Select university</option>
                                    @foreach( $universityObj as $university )
                                        <option value="{{ $university->id }}">{{ $university->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <h4 for="usr">Application Applied From &amp; To <span class="pull-right"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                <div class="form-group" id="data_5">
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" id="txtFromCreateDate1" class="form-control createdDateStart" name="createdDateStart" value="" placeholder="Application Applied Created Form" data-parsley-trigger="change" data-parsley-error-message="Please select application applied created date from" required="">
                                        <span class="input-group-addon">to</span>
                                        <input type="text" id="txtToCreateDate1" class="form-control createdDateEnd" name="createdDateEnd" value="" placeholder="Application Applied Created To" data-parsley-trigger="change" data-parsley-error-message="Please select application applied created date to" required="">
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="row">
                            <div class="col-md-3">
                                <h4 for="usr">Application Status<span class="pull-right"><a href="javascript:void(0);" id="refresh5" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                <select class="form-control chosen-select applicationStatus" name="applicationStatus" data-parsley-trigger="change" data-parsley-error-message="Please select application status">
                                    <option value="" disabled="" selected="">Select application status</option>
                                    @foreach( $applicationStatusObj as $app )
                                        <option value="{{ $app->id }}">{{ $app->name }}</option>
                                    @endforeach
                                </select> 
                            </div>
                            <!-- <div class="col-md-3">
                                <h4>Stream<span class="pull-right"> <a href="javascript:void(0);" id="refresh3" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                               <select class="form-control chosen-select functionalarea_id" name="functionalarea_id" data-parsley-trigger="change" data-parsley-error-message="Please select stream">
                                    <option value="" disabled="" selected="">Select stream</option>
                                    @foreach( $functionalAreaObj as $functional )
                                        <option value="{{ $functional->id }}">{{ $functional->name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="col-md-3">
                                <h4 for="usr">Degree
                                <span class="pull-right"><a href="javascript:void(0);" id="refresh6" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                <select class="form-control chosen-select degree_id " name="degree_id" data-parsley-trigger="change" data-parsley-error-message="Please select degree">
                                    <option value="" disabled="" selected="">Select degree</option>
                                </select>
                            </div> 
                            <div class="col-md-3">
                                <h4 for="usr">Course
                                <span class="pull-right"><a href="javascript:void(0);" id="refresh7" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                <select class="form-control chosen-select course_id" name="course_id" data-parsley-trigger="change" data-parsley-error-message="Please select course">
                                    <option value="" disabled="" selected="">Select course</option>
                                </select>
                            </div> -->

                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 text-right">
                                <button class="btn btn-primary btn-sm">Generate</button>
                                <a href="{{ URL::to('administrator/reports') }}" class="btn btn-default btn-sm">Cancel</a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    
    <div class="wrapper wrapper-content animated fadeInRight">
        
    </div>

@endsection

@section('script')
{!! Html::script('js/moment.js') !!}
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript">
        $(document).ready(function(){
            window.setTimeout(function() { $(".alert-danger").alert('close'); }, 8000);
        });
    </script>
<script type="text/javascript">

    $('.collegeName').on('change',function(){
        $('#refresh1').removeClass('hide');
    });
    $('#refresh1').on('click',function(e){
        $('.collegeName').val('').trigger('chosen:updated');
        $('#refresh1').addClass('hide');
    });

    $('#txtFromCreateDate1').on('blur',function(){
        $('#refresh2').removeClass('hide');
    });
    $('#refresh2').on('click',function(e){
        $('#txtFromCreateDate1').val('');
        $('#refresh2').addClass('hide');
    });

    $('#txtToCreateDate1').on('blur',function(){
        $('#refresh2').removeClass('hide');
    });
    $('#refresh2').on('click',function(e){
        $('#txtToCreateDate1').val('');
        $('#refresh2').addClass('hide');
    });

    $('.functionalarea_id').on('change',function(){
        $('#refresh3').removeClass('hide');
    });
    $('#refresh3').on('click',function(e){
        $('.functionalarea_id').val('').trigger('chosen:updated');
        $('#refresh3').addClass('hide');
    });

    $('.university_id').on('change',function(){
        $('#refresh4').removeClass('hide');
    });
    $('#refresh4').on('click',function(e){
        $('.university_id').val('').trigger('chosen:updated');
        $('#refresh4').addClass('hide');
    });

    $('.applicationStatus').on('change',function(){
        $('#refresh5').removeClass('hide');
    });
    $('#refresh5').on('click',function(e){
        $('.applicationStatus').val('').trigger('chosen:updated');
        $('#refresh5').addClass('hide');
    });
    
    $('.applicationStatus').on('change',function(){
        $('#refresh5').removeClass('hide');
    });
    $('#refresh5').on('click',function(e){
        $('.applicationStatus').val('').trigger('chosen:updated');
        $('#refresh5').addClass('hide');
    });

    $('.degree_id').on('change',function(){
        $('#refresh6').removeClass('hide');
    });
    $('#refresh6').on('click',function(e){
        $('.degree_id').val('').trigger('chosen:updated');
        $('#refresh6').addClass('hide');
    });

    $('.course_id').on('change',function(){
        $('#refresh7').removeClass('hide');
    });
    $('#refresh7').on('click',function(e){
        $('.course_id').val('').trigger('chosen:updated');
        $('#refresh7').addClass('hide');
    });
    
</script>
<script type="text/javascript">
    $(document).ready(function(){
         $(".chosen-select").chosen({
            placeholder_text_single: "Select an option",
            no_results_text: "Oops, nothing found!"
        });

        $("#txtFromCreateDate1").datepicker({
            numberOfMonths: 1,
            onSelect: function(selected) {
              $("#txtToCreateDate1").datepicker("option","minDate", selected)
            }
        });
        $("#txtToCreateDate1").datepicker({ 
            numberOfMonths: 1,
            onSelect: function(selected) {
               $("#txtFromCreateDate1").datepicker("option","maxDate", selected)
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#generateReport2').on('click',function(){
            $('.collegeProfileReport').removeClass('hide');
            $('.collegeProfileReport').addClass('animated');
            $('.collegeProfileReport').addClass('fadeInDown');
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
            url: "{{ URL::to('getAllDegreeName') }}",
            success: function(data) {
                var HTML = '';
                HTML += '<option selected="" disabled="">Degree</option>';
                if( data.code == '200' ){
                    $.each(data.degreeObj, function(i, item) {
                        HTML += '<option value="'+data.degreeObj[i].degreeId+'">'+data.degreeObj[i].name+'</option>';
                    }); 
                }else{
                    HTML += '<option selected="" disabled="">No degree available for this stream</option>';
                }

                $('select[name="degree_id"]').empty();
                $('select[name="degree_id"]').html(HTML);
                $('select[name="degree_id"]').trigger('chosen:updated');
            }
        });
    });

    $('select[name=degree_id]').on('change', function(){
        var currentID = $(this).val();
        $.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {currentID: currentID},
            url: "{{ URL::to('getAllCourseName') }}",
            success: function(data) {
                var HTML = '';
                HTML += '<option selected="" disabled="">Branch</option>';
                if( data.code == '200' ){
                    $.each(data.courseObj, function(i, item) {
                        HTML += '<option value="'+data.courseObj[i].courseId+'">'+data.courseObj[i].name+'</option>';
                    }); 
                }else{
                    HTML += '<option selected="" disabled="">No course available for this degree</option>';
                }

                $('select[name="course_id"]').empty();
                $('select[name="course_id"]').html(HTML);
                $('select[name="course_id"]').trigger('chosen:updated');
            }
        });
    });
</script>
@endsection
