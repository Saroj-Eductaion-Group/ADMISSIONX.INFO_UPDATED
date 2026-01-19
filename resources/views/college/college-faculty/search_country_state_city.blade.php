<script type="text/javascript">
    {!! Html::script('home-layout/assets/js/plugins/jquery-ui.min.js') !!}
    // $(document).ready(function() {
    //     $('.js-example-basic-single').select2();
    // });
</script>
<script type="text/javascript">
$('select[name=country_id]').on('change', function(){
    var HTML = '';
    HTML += '<option value="" selected="">-- Select an option --</option>';
    $.ajax({
        method: "GET",
        data: { countryID: $(this).val() },
        url: "{{ URL::to('getAllStateName') }}",
        success: function(data) {
            $.each(data.stateObj, function(key, value) {
                HTML += '<option value='+data.stateObj[key].stateId+'>'+data.stateObj[key].name+'</option>';
            });
            $('select[name=state_id]').html(HTML);
        }
    });
});
$('select[name=state_id]').on('change', function(){
    var HTML = '';
    HTML += '<option value="" selected="">-- Select an option --</option>';
    $.ajax({
        method: "GET",
        data: { stateId: $(this).val() },
        url: "{{ URL::to('/getAllCityNameData') }}",
        success: function(data) {
            $.each(data.cityData, function(key, value) {
                HTML += '<option value='+data.cityData[key].id+'>'+data.cityData[key].name+'</option>';
            });
            $('select[name=city_id]').html(HTML);
        }
    });
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
<script type="text/javascript">
    //$('.summernote').summernote();
    $('.summernote').summernote({
        placeholder: 'write here...',
        height: 150,
        toolbar: [
          ['font', ['bold', 'underline', 'italic']],
          ['para', ['ul', 'ol', 'paragraph']],
        ],
        popover: {
        image: [
            ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
            ['float', ['floatLeft', 'floatRight', 'floatNone']],
            ['remove', ['removeMedia']]
        ],
        link: [
            ['link', ['linkDialogShow', 'unlink']]
        ],
        air: [
            ['color', ['color']],
            ['font', ['bold', 'underline', 'clear']],
            ['para', ['ul', 'paragraph']],
            ['table', ['table']],
        ]
        },
        codemirror: {
            mode: 'text/html',
            htmlMode: true,
            lineNumbers: true,
            theme: 'monokai'
        },
        dialogsInBody: true
    });
    $('#summernote').summernote('fontSize', 18);
</script>
<script type="text/javascript">
    var countExperience = 0;
    $('#addExperienceRow').on('click', function(){
        countExperience++;
        var HTML = ''+
                '<tr>'+
                    '<td>'+
                        '<input type="text" class="form-control" name="organisation[]" placeholder="Organization Name" required="">'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" class="form-control" name="role[]" placeholder="Role" required="">'+
                    '</td>'+
                    '<td>'+
                        '<input type="number" class="form-control" name="fromyear[]" placeholder="Form year" min="1940" max="{{date('Y')}}" required="">'+
                    '</td>'+
                    '<td>'+
                        '<input type="number" class="form-control" name="toyear[]" placeholder="To year" min="1940" max="{{date('Y')}}" required="">'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" class="form-control" name="city[]" placeholder="City Name" required="">'+
                    '</td>'+
                    '<td>'+
                        '<a class="btn btn-outline btn-danger text-white btn-xs removeExperience"><i class="fa fa-remove"></i> Remove</a>'+
                    '</td>'+
                '</tr>'
        $('.tableExperienceSection').append(HTML);
    });

    $(document).on('click','.removeExperience', function(){
        countExperience--;
        $(this).parent().parent().remove();
    });
</script>

<script type="text/javascript">
    var countContactDetails = 0;
    $('#addNewQualificationDetailRow').on('click', function(){
        countContactDetails++;
        var HTML = ''+
            '<div class="clientContactDetails margin-bottom20">'+
                '<h4 class="padding-bottom10">Faculty Qualification Detail <a class="btn btn-outline btn-danger text-white btn-xs removeQualificationDetails pull-right"><i class="fa fa-remove"></i> Remove</a></h4>'+
                '<div class="row margin-bottom10">'+
                    '<div class="col-md-6">'+
                        '<label class="">Qualification</label>'+
                        '<input type="text" name="qualification[]"  class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid qualification"  placeholder="Please enter qualification" value="" required="">'+ 
                    '</div>'+
                    '<div class="col-md-6">'+
                        '<label class="">Course</label>'+
                        '<input type="text" name="course[]"  class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid course"  placeholder="Please enter course" value="" required="">'+ 
                    '</div>'+
                '</div>'+
                '<div class="row margin-bottom10">'+
                    '<div class="col-md-6">'+
                        '<label class="">Subject</label>'+
                        '<input type="text" name="subjects[]"  class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid subjects"  placeholder="Please enter subjects" value="" required="">'+ 
                    '</div>'+
                    '<div class="col-md-6">'+
                        '<label class="">Passing Year</label>'+
                        '<input type="number" name="year[]"   class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid passing year"  placeholder="Please enter passing year" value="" data-parsley-type="digits" data-parsley-minlength="4" data-parsley-maxlength="4" maxlength="4" min="1940" max="{{date('Y')}}" required="">'+ 
                    '</div>'+
                '</div>'+
                '<div class="row">'+
                    '<div class="col-md-6">'+
                        '<label class="">College Name</label>'+
                        '<input type="text" name="collegename[]"  class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid college name"  placeholder="Please enter college name" value="" required="">'+ 
                    '</div>'+
                    '<div class="col-md-6">'+
                        '<label class="">Board Name</label>'+
                        '<input type="text" name="boardName[]"  class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid board name"  placeholder="Please enter board name" value="" >'+ 
                    '</div>'+
                '</div>'+
            '</div>'
        $('.qualificationSection').append(HTML);
    });

    $(document).on('click','.removeQualificationDetails', function(){
        countContactDetails--;
        $(this).parent().parent().remove();
    });
</script>

<script type="text/javascript">
    var courseObj = '';
    var courseOptions = '';
    courseObj = <?php echo json_encode($allCourseObj); ?>;
    for (var i = 0; i <= courseObj.length - 1; i++) {
        var str = '<option value="'+courseObj[i]['collegemasterId']+'"';
        str += '>'+courseObj[i]['courseName']+ ' (Degree : '+courseObj[i]['degreeName']+' | Stream : '+courseObj[i]['functionalareaName']+') (Course Type : '+courseObj[i]['coursetypeName']+') (Degree Level : '+courseObj[i]['educationlevelName']+') </option>';
        courseOptions += str; 
    }   

    var countDepartmentDetails = 0;
    $('#addNewDepartmentDetailRow').on('click', function(){
        countDepartmentDetails++;
        var HTML = ''+
            '<div class="clientContactDetails margin-bottom20">'+
                '<h4 class="padding-bottom10">Associate Department Detail <a class="btn btn-outline btn-danger text-white btn-xs removeFacultyDepartmentList pull-right"><i class="fa fa-remove"></i> Remove</a></h4>'+
                '<div class="row margin-bottom10">'+
                    '<div class="col-md-12">'+
                        '<label class="">Course</label>'+
                        '<select name="collegemaster_id[]" class="form-control text-capitalize js-example-basic-single" +data-parsley-error-message="Please select course name" placeholder="Select course"><option selected="" value="" required=""> --Select course name --</option>'+courseOptions+'</select>'+ 
                    '</div>'+
                '</div>'+
            '</div>'
        $('.facultyDepartmentSection').append(HTML);
        $('.js-example-basic-single').select2();
    });

    $(document).on('click','.removeFacultyDepartmentList', function(){
        countDepartmentDetails--;
        $(this).parent().parent().remove();
    });
</script>
<script type="text/javascript">
    var config = {
        '.chosen-select'           : {},
        '.chosen-select-deselect'  : {allow_single_deselect:true},
        '.chosen-select-no-single' : {disable_search_threshold:10},
        '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
        '.chosen-select-width'     : {width:"100%"}
        }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
</script>