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
    var count = 0;
    $('#addApplicationFeeRow').on('click', function(){
        count++;
        var HTML = ''+
                '<tr>'+
                    '<td>'+
                        '<input type="text" class="form-control" name="category[]" placeholder="Category Name">'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" class="form-control" name="quota[]" placeholder="Quota Name">'+
                    '</td>'+
                    '<td>'+
                        '<select name="mode[]" class="form-control mode" data-parsley-error-message="Please select mode">'+
                            '<option value="" selected="">--Select mode--</option>'+
                            '<option value="1">Online</option>'+
                            '<option value="2">Offline</option>'+
                        '</select>'+
                    '</td>'+
                    '<td>'+
                        '<select name="gender[]" class="form-control gender" data-parsley-error-message="Please select gender">'+
                            '<option value="" selected="">--Select gender--</option>'+
                            '<option value="1">Male</option>'+
                            '<option value="2">Female</option>'+
                            '<option value="3">Other</option>'+
                        '</select>'+
                    '</td>'+
                    '<td>'+
                        '<input type="number" class="form-control" name="amount[]" placeholder="amount">'+
                    '</td>'+
                    '<td>'+
                        '<a class="btn btn-outline btn-danger btn-xs removeApplicationFeeRow"><i class="fa fa-remove"></i> Remove</a>'+
                    '</td>'+
                '</tr>'
        $('.tableApplicationFeesSection').append(HTML);
    });

    $(document).on('click','.removeApplicationFeeRow', function(){
        count--;
        $(this).parent().parent().remove();
    });
</script>
<script type="text/javascript">
    var getTopicObj = '';
    var option = '';
    getTopicObj = <?php echo json_encode($examDegreeObj); ?>;
    for (var i = 0; i <= getTopicObj.length - 1; i++) {
        var str = '<option value="'+getTopicObj[i]['degreeId']+'"';
        str += '>'+getTopicObj[i]['degreeName']+ '</option>';
        option += str; 
    }   

    var count = 0;
    $('#addExamDatesRow').on('click', function(){
        count++;
        var HTML = ''+
                '<tr>'+
                    '<td>'+
                        '<input type="text" class="form-control" name="eventDate[]" placeholder="Event Date">'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" class="form-control" name="eventName[]" placeholder="Event Name">'+
                    '</td>'+
                    '<td>'+
                        '<select name="eventStatus[]" class="form-control eventStatus" data-parsley-error-message="Please select event status">'+
                            '<option value="" selected="">--select event status--</option>'+
                            '<option value="1">Online</option>'+
                            '<option value="2">Offline</option>'+
                            '<option value="3">Closed</option>'+
                        '</select>'+
                    '</td>'+
                    '<td>'+
                        '<select name="degreeId[]" class="form-control text-capitalize" +data-parsley-error-message="Please select degree name" placeholder="Select Field Name1"><option selected="" value=""> --Select degree name --</option>'+option+'</select>'+
                    '</td>'+
                    '<td>'+
                        '<a class="btn btn-outline btn-danger btn-xs removeExamDatesRow"><i class="fa fa-remove"></i> Remove</a>'+
                    '</td>'+
                '</tr>'
        $('.tableExamDatesSection').append(HTML);
    });

    $(document).on('click','.removeExamDatesRow', function(){
        count--;
        $(this).parent().parent().remove();
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
    var countContactDetails = 0;
    $('#addNewFaqDetailRow').on('click', function(){
        countContactDetails++;
        var HTML = ''+
            '<div class="clientContactDetails margin-bottom20">'+
                '<h4 class="padding-bottom10">Faq Question & Answer Detail <a class="btn btn-outline btn-danger btn-xs removeFaqDetailsDetails pull-right"><i class="fa fa-remove"></i> Remove</a></h4>'+
                '<div class="row">'+
                    '<div class="col-md-12">'+
                        '<label class="">Question</label>'+
                        '<input type="text" name="question[]"  class="form-control question" data-parsley-trigger="change" data-parsley-error-message="Please enter valid Question"  id="question" placeholder="Please enter Question" value="" > '+
                    '</div>'+
                '</div>'+
                '<hr class="hr-line-dashed">'+
                '<div class="row">'+
                    '<div class="col-md-12">'+
                        '<label class="">Answer</label>'+
                        '<textarea class="form-control answer" id="answer[]"  placeholder="Enter answer." name="answer[]"></textarea>'+
                    '</div>'+
                '</div>'+
                '<hr class="hr-line-dashed">'+
                '<div class="row">'+
                    '<div class="col-md-12">'+
                        '<label class="">Reference Link</label>'+
                        '<input type="url" name="refLinks[]"  class="form-control refLinks" data-parsley-trigger="change" data-parsley-error-message="Please enter valid reference link"  id="refLinks" placeholder="Please enter reference link" value="" >'+
                    '</div>'+
                '</div>'+
            '</div>'
        $('.examFaqSection').append(HTML);
    });

    $(document).on('click','.removeFaqDetailsDetails', function(){
        countContactDetails--;
        $(this).parent().parent().remove();
    });
</script>
<script type="text/javascript">
    var count1 = 0;
    $('#addReferenceLinkRow').on('click', function(){
        count1++;
        var HTML = ''+
                '<tr>'+
                    '<td>'+
                        '<input type="text" class="form-control" name="title[]" placeholder="Title">'+
                    '</td>'+
                    '<td>'+
                        '<input type="url" class="form-control" name="url[]" placeholder="Reference link">'+
                    '</td>'+
                    '<td>'+
                        '<a class="btn btn-outline btn-danger btn-xs removeReferenceLinkRow"><i class="fa fa-remove"></i> Remove</a>'+
                    '</td>'+
                '</tr>'
        $('.tableReferenceLinkSection').append(HTML);
    });

    $(document).on('click','.removeReferenceLinkRow', function(){
        count1--;
        $(this).parent().parent().remove();
    });
</script>
