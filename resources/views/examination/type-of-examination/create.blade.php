@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Create New List Of Examination <a href="{{ url('examination/type-of-examination') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add new list of examination details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::open(['url' => 'examination/type-of-examination', 'class' => 'form-horizontal','data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
                @include ('examination.type-of-examination.form')
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
<script>
    $(function(){
        var dateFormat = "mm/dd/yy",
        from = $("#startdate1")
        .datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 2,
            endDate : 'today'
        })
        .on("change", function() {
            to.datepicker("option", "minDate", getDate(this));
        }),
        to = $("#enddate1").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 2,
            endDate : 'today',
        })
        .on("change", function() {
            from.datepicker("option", "maxDate", getDate(this));
        });
 
        function getDate(element) {
            var date;
            try {
                date = $.datepicker.parseDate(dateFormat, element.value);
            } catch( error ) {
                date = null;
            }
            return date;
        }
    });
</script>

<script>
    $(function(){
        var dateFormat = "mm/dd/yy",
        from = $("#startdate2")
        .datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 2,
            endDate : 'today'
        })
        .on("change", function() {
            to.datepicker("option", "minDate", getDate(this));
        }),
        to = $("#enddate2").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 2,
            endDate : 'today',
        })
        .on("change", function() {
            from.datepicker("option", "maxDate", getDate(this));
        });
 
        function getDate(element) {
            var date;
            try {
                date = $.datepicker.parseDate(dateFormat, element.value);
            } catch( error ) {
                date = null;
            }
            return date;
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){ 
        $('.universitylogo').on('change',function(){
            $('#refresh1').removeClass('hide');
        });
        $('#refresh1').on('click',function(e){
            $('.universitylogo').val('').trigger('chosen:updated');
            $('#refresh1').addClass('hide');
        });

        $('input[name=universitylogo]').change(function (e)
        {   
            var ext = $('input[name=universitylogo]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' ){
                $("input[name=universitylogo]").parsley().reset();
                $('#universitylogo').addClass('hide');
            }else{
                $('#universitylogo').removeClass('hide');
                $('input[name=universitylogo]').val('');
                $("input[name=universitylogo]").parsley().reset();
                return false;
            }
        });    
    });
</script>
<script type="text/javascript">
    $('select[name=university_id]').on('change', function(){
        var currentID = $(this).val();
        $.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {currentID: currentID},
            url: "{{ URL::to('getUniversityName') }}",
            success: function(data) {
                if( data.code == '200' ){
                    $.each(data.functionalareaObj, function(i, item) {
                        $('input[name=universityName]').val(data.functionalareaObj[i].name);
                    }); 
                }
            }
        });
    });
</script>
<script type="text/javascript">
    $('select[name=examsection_id]').on('change', function(){
        var currentID = $(this).val();
        $.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {currentID: currentID},
            url: "{{ URL::to('getAllExamDegreeName') }}",
            success: function(data) {
                var HTML = '';
                HTML += '<div class="form-group"><div class="col-md-12"><label class="control-label" >Degree name : </label><div class="row">';
                if( data.code == '200' ){
                    $.each(data.degreeObj, function(i, item) {
                        HTML += '<div class="col-md-3">';
                            HTML += '<div class="checkbox checkbox-primary checkbox-inline">';
                                HTML += '<input type="checkbox" data-parsley-error-message=" Please select degree" data-parsley-trigger="change" required=""  class="ads_Checkbox" name="degreeIds[]" id="degree'+data.degreeObj[i].degreeId+'" value="'+data.degreeObj[i].degreeId+'" />';
                                HTML += '<label for="degree'+data.degreeObj[i].degreeId+'">'+data.degreeObj[i].name+'</label>';
                            HTML += '</div>';
                        HTML += '</div>';
                    }); 
                    HTML += '</div></div></div>';
                }else{
                    HTML += '<p>No degree available for this stream</p>';
                }
                $('.appearDegreeCheckBox').html(HTML);
            }
        });
    });
</script>
@endsection