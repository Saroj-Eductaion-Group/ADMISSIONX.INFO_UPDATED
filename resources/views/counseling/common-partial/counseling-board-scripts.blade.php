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
  // $(document).ready(function() {
  //   $('.summernote').summernote();
  // });
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
<!-- GET STATE NAME LIST -->
<script type="text/javascript">
    $(document).ready(function(){   
    $('.countryName').on('change', function(){
      var counrtyid = $(this).val();
      var HTML = '<option value="" selected="">--Select State--</option> ';
      $.ajax({
        headers: {
        'X-CSRF-Token': $('input[name="_token"]').val()
        },
        method: "GET",
        data: { counrtyid: counrtyid },
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: "{{ URL::to('/fetch-state') }}",
        success: function(data) {
          $.each(data.getAllStateObj, function(key, value) {
            HTML += '<option value='+data.getAllStateObj[key].id+'>'+data.getAllStateObj[key].name+'</option>';
          });
          $('.stateName').html(HTML);
          $('.stateName').trigger("chosen:updated");

          $('.cityName').html('');
          $('.cityName').html('<option value="" selected="">--Select City--</option> ');
          $('.cityName').trigger("chosen:updated");
        }
      });
    });
  });
</script>

<!-- GET CITY NAME LIST -->
<script type="text/javascript">
    $(document).ready(function(){   
        $('.stateName').on('change', function(){
            var stateid = $(this).val();
            var HTML = '<option value="" selected="">--Select City--</option> ';
            $.ajax({
                headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
                },
                method: "GET",
                data: { stateid: stateid },
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                url: "{{ URL::to('/fetch-city') }}",
                success: function(data) {
                    $.each(data.getAllCityObj, function(key, value) {
                      HTML += '<option value='+data.getAllCityObj[key].id+'>'+data.getAllCityObj[key].name+'</option>';
                    });
                    $('.cityName').html(HTML);
                    $('.cityName').trigger("chosen:updated");
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.dateofbirth').on('change', function(){
            var dateofbirth = $(this).val();
            $.ajax({
                headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
                },
                method: "GET",
                data: { dateofbirth: dateofbirth},
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                url: "{{ URL::to('/calculate-date-of-birth') }}",
                success: function(data) {
                    if( data.code == '200' ){
                        $("input[name=age]").val(data.calculateAge);
                    }else{
                        $('.dateofbirth').val('');
                    }
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){ 
        $('.image').on('change',function(){
            $('#refresh1').removeClass('hide');
        });
        $('#refresh1').on('click',function(e){
            $('.image').val('').trigger('chosen:updated');
            $('#refresh1').addClass('hide');
        });

        $('input[name=image]').change(function (e)
        {   
            var ext = $('input[name=image]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' ){
                $("input[name=image]").parsley().reset();
                $('#image').addClass('hide');
            }else{
                $('#image').removeClass('hide');
                $('input[name=image]').val('');
                $("input[name=image]").parsley().reset();
                return false;
            }
        });    
    });
</script>
<script type="text/javascript">
    var countHighlights = 0;
    $('#addNewCounslingHighlightsRow').on('click', function(){
        countHighlights++;
        var HTML = ''+
            '<div class="clientContactDetails margin-bottom20">'+
                '<h4 class="padding-bottom10">{{strtoupper($counselingBoard->name)}} highlights<a class="btn btn-outline btn-danger btn-xs removeCounslingHighlights pull-right"><i class="fa fa-remove"></i> Remove</a></h4>'+
                '<div class="row">'+
                    '<div class="col-md-12">'+
                        '<label class="">Dates</label>'+
                        '<input type="text" name="highlightsTitle[]"  class="form-control title" data-parsley-trigger="change" data-parsley-error-message="Please enter valid title"  id="highlightsTitle" placeholder="Please enter title" value="" > '+
                    '</div>'+
                '</div>'+
                '<hr class="hr-line-dashed">'+
                '<div class="row">'+
                    '<div class="col-md-12">'+
                        '<label class="">Details</label>'+
                        '<textarea class="form-control Details" id="highlightsDescription[]"  placeholder="Enter Details." name="highlightsDescription[]"></textarea>'+
                    '</div>'+
                '</div>'+
            '</div>'
        $('.counslingHighlightsSection').append(HTML);
    });

    $(document).on('click','.removeCounslingHighlights', function(){
        countHighlights--;
        $(this).parent().parent().remove();
    });
</script>

<script type="text/javascript">
    var countExamSamplePaper = 0;
    $('#addNewCounslingExamSamplePaperRow').on('click', function(){
        countExamSamplePaper++;
        var HTML = ''+
            '<div class="clientContactDetails margin-bottom20">'+
                '<h4 class="padding-bottom10">{{strtoupper($counselingBoard->name)}} sample paper<a class="btn btn-outline btn-danger btn-xs removeCounslingExamSamplePaper pull-right"><i class="fa fa-remove"></i> Remove</a></h4>'+
                '<div class="row">'+
                    '<div class="col-md-6">'+
                        '<label class="">Class</label>'+
                        '<input type="text" name="samplePaperClass[]"  class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid class name"  id="samplePaperClass" placeholder="Please enter class name" value="" >'+
                    '</div>'+
                    '<div class="col-md-6">'+
                        '<label class="">Subject</label>'+
                        '<input type="text" name="samplePaperSubject[]"  class="form-control subject" data-parsley-trigger="change" data-parsley-error-message="Please enter valid subject"  id="samplePaperSubject" placeholder="Please enter subject" value="" >'+
                    '</div>'+
                '</div>'+
                '<hr class="hr-line-dashed">'+
                '<div class="row">'+
                    '<div class="col-md-12">'+
                        '<label class="">Details</label>'+
                        '<textarea class="form-control description" id="samplePaperDescription"  placeholder="Enter description." name="samplePaperDescription[]"></textarea>'+
                    '</div>'+
                '</div>'+
            '</div>'
        $('.counslingExamSamplePaperSection').append(HTML);
    });

    $(document).on('click','.removeCounslingExamSamplePaper', function(){
        countExamSamplePaper--;
        $(this).parent().parent().remove();
    });
</script>

<script type="text/javascript">
    var countExamSyllabus = 0;
    $('#addNewCounslingExamSyllabusRow').on('click', function(){
        countExamSyllabus++;
        var HTML = ''+
            '<div class="clientContactDetails margin-bottom20">'+
                '<h4 class="padding-bottom10">{{strtoupper($counselingBoard->name)}} syllabus<a class="btn btn-outline btn-danger btn-xs removeCounslingExamSyllabus pull-right"><i class="fa fa-remove"></i> Remove</a></h4>'+
                '<div class="row">'+
                    '<div class="col-md-6">'+
                        '<label class="">Class</label>'+
                        '<input type="text" name="syllabusClass[]"  class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid class name"  id="syllabusClass" placeholder="Please enter class name" value="" >'+
                    '</div>'+
                    '<div class="col-md-6">'+
                        '<label class="">Subject</label>'+
                        '<input type="text" name="syllabusSubject[]"  class="form-control subject" data-parsley-trigger="change" data-parsley-error-message="Please enter valid subject"  id="syllabusSubject" placeholder="Please enter subject" value="" >'+
                    '</div>'+
                '</div>'+
                '<hr class="hr-line-dashed">'+
                '<div class="row">'+
                    '<div class="col-md-12">'+
                        '<label class="">Details</label>'+
                        '<textarea class="form-control description" id="syllabusDescription"  placeholder="Enter description." name="syllabusDescription[]"></textarea>'+
                    '</div>'+
                '</div>'+
            '</div>'
        $('.counslingExamSyllabusSection').append(HTML);
    });

    $(document).on('click','.removeCounslingExamSyllabus', function(){
        countExamSyllabus--;
        $(this).parent().parent().remove();
    });
</script>

<script type="text/javascript">
    var countExamDates = 0;
    $('#addNewCounslingExaminationDatesRow').on('click', function(){
        countExamDates++;
        var HTML = ''+
                '<tr>'+
                    '<td>'+
                        '<input type="text" class="form-control" name="examclass[]" placeholder="exam class">'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" class="form-control" name="examdates[]" placeholder="exam dates">'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" class="form-control" name="examsubject[]" placeholder="exam subject">'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" class="form-control" name="examsetting[]" placeholder="exam setting">'+
                    '</td>'+
                    '<td>'+
                        '<a class="btn btn-outline btn-danger btn-xs removeCounslingExaminationDates"><i class="fa fa-remove"></i> Remove</a>'+
                    '</td>'+
                '</tr>'
        $('.tableCounslingExaminationDatesSection').append(HTML);
    });

    $(document).on('click','.removeCounslingExaminationDates', function(){
        countExamDates--;
        $(this).parent().parent().remove();
    });
</script>


<script type="text/javascript">
    var countExamDates = 0;
    $('#addNewCounslingAdmissionDatesRow').on('click', function(){
        countExamDates++;
        var HTML = ''+
                '<tr>'+
                    '<td>'+
                        '<input type="text" class="form-control" value="" name="admissionClass[]" placeholder="Class Name">'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" class="form-control" value="" name="admissionDates[]" placeholder="Admission Dates">'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" class="form-control" value="" name="admissionSubjects[]" placeholder="Subjects">'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" class="form-control" value="" name="admissionFees[]" placeholder="Fees Amount">'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" class="form-control" value="" name="admissionPlace[]" placeholder="Place">'+
                    '</td>'+
                    '<td>'+
                        '<a class="btn btn-outline btn-danger btn-xs removeCounslingAdmissionDates"><i class="fa fa-remove"></i> Remove</a>'+
                    '</td>'+
                '</tr>'
        $('.tableCounslingAdmissionDatesSection').append(HTML);
    });

    $(document).on('click','.removeCounslingAdmissionDates', function(){
        countExamDates--;
        $(this).parent().parent().remove();
    });
</script>
<script type="text/javascript">
    var countImpDates = 0;
    $('#addNewCounslingImportantDatesRow').on('click', function(){
        countImpDates++;
        var HTML = ''+
                '<tr>'+
                    '<td>'+
                        '<input type="text" class="form-control" value="" name="importantDates[]" placeholder="Dates">'+
                    '</td>'+
                    '<td>'+
                        ' <textarea class="form-control description" id="importantDescription"  placeholder="Enter description." name="importantDescription[]"></textarea>'+
                    '</td>'+
                    '<td>'+
                        '<a class="btn btn-outline btn-danger btn-xs removeCounslingImportantDates"><i class="fa fa-remove"></i> Remove</a>'+
                    '</td>'+
                '</tr>'
        $('.tableCounslingImportantDatesSection').append(HTML);
    });

    $(document).on('click','.removeCounslingImportantDates', function(){
        countImpDates--;
        $(this).parent().parent().remove();
    });
</script>

<script type="text/javascript">
    var countLatestUpdate = 0;
    $('#addNewCounslingLatestUpdateRow').on('click', function(){
        countLatestUpdate++;
        var HTML = ''+
                '<tr>'+
                    '<td>'+
                        '<input type="text" class="form-control" value="" name="latestUpdateDates[]" placeholder="Dates">'+
                    '</td>'+
                    '<td>'+
                        ' <textarea class="form-control description" id="latestUpdateDescription"  placeholder="Enter description." name="latestUpdateDescription[]"></textarea>'+
                    '</td>'+
                    '<td>'+
                        '<a class="btn btn-outline btn-danger btn-xs removeCounslingLatestUpdate"><i class="fa fa-remove"></i> Remove</a>'+
                    '</td>'+
                '</tr>'
        $('.tableCounslingLatestUpdateSection').append(HTML);
    });

    $(document).on('click','.removeCounslingLatestUpdate', function(){
        countLatestUpdate--;
        $(this).parent().parent().remove();
    });
</script>
