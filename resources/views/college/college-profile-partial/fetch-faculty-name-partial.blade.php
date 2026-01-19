
<script type="text/javascript">
    $(document).ready(function(){   
        $('.coursename').on('change', function(e){
            e.preventDefault();
            var courseId = $(this).val();
            var educationlevelId = $('select[name="educationlevel_id"]').val();
            var coursetypeId = $('select[name="coursetype_id"]').val();
            if ((educationlevelId != null) && (coursetypeId != null)) {
                fetchCourseDegreeLevelCourseTypeWiseFaculty(courseId, educationlevelId,coursetypeId);
            }
        });
    });

    $(document).ready(function(){   
        $('.educationlevel').on('change', function(e){
            e.preventDefault();
            var educationlevelId = $(this).val();
            var courseId = $('select[name="course_id"]').val();
            var coursetypeId = $('select[name="coursetype_id"]').val();
            if ((courseId != null) && (coursetypeId != null)) {
                fetchCourseDegreeLevelCourseTypeWiseFaculty(courseId, educationlevelId, coursetypeId);
            }
            
        });
    });

    $(document).ready(function(){   
        $('.coursetype').on('change', function(e){
            e.preventDefault();
            var coursetypeId = $(this).val();
            var courseId = $('select[name="course_id"]').val();
            var educationlevelId = $('select[name="educationlevel_id"]').val();
            if ((courseId != null) && (educationlevelId != null)) {
                fetchCourseDegreeLevelCourseTypeWiseFaculty(courseId, educationlevelId, coursetypeId);
            }/*else{
                alert("Sorry, Can\'t find model name please select child category first");
            }*/
        });
    });

    function fetchCourseDegreeLevelCourseTypeWiseFaculty(courseId, educationlevelId, coursetypeId) {
        var HTML = '';
        var slugUrl = "{!! $slugUrl !!}";
        $.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            data: { courseId: courseId, educationlevelId: educationlevelId, coursetypeId: coursetypeId, slugUrl: slugUrl},
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            url: "{{ URL::to('/fetch-asssociated-faculty-list') }}",
            success: function(data) {
            	if (data.code == 200) {
            		//$('.facultyNameBlock').removeClass('hide');
            		$(".facultyNameBlock").css("visibility","visible");
	                HTML += '<option value="" disabled="">Please Select faculty name</option>';
	                $.each(data.getAllFacultyName, function(key, value) {
	                    HTML += '<option value='+data.getAllFacultyName[key].id+'>'+data.getAllFacultyName[key].fullname+'</option>';
	                });
	                $('.facultyName').html(HTML);
	                $('.facultyName').trigger("chosen:updated");
	                $(".chosen-select").chosen();
            	}else{
            		//$('.facultyNameBlock').addClass('hide');
            		$(".facultyNameBlock").css("visibility","hidden");
            		$('.facultyName').val('');
            	}
            }
        });
    }
</script>