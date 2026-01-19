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
            	HTML += '<option selected="" disabled="">Select degree</option>';
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
</script>

<script type="text/javascript">
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
            	HTML += '<option selected="" disabled="">Select course</option>';
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
<script type="text/javascript">
    var countImportantDate = 0;
    $('#addAdmissionDatesRow').on('click', function(){
        countImportantDate++;
        var HTML = ''+
                '<tr>'+
                    '<td>'+
                        '<input type="text" class="form-control" name="eventName[]" value="" placeholder="Enter event name" data-parsley-error-message=" Please enter event name" data-parsley-trigger="change" required="">'+
                    '</td>'+
                    '<td width="10%">'+
                        '<input type="date" class="form-control" name="fromdate[]" value="" placeholder="Enter form date" data-parsley-error-message=" Please enter form date" data-parsley-trigger="change" required="">'+
                    '</td>'+
                    '<td width="10%">'+
                        '<input type="date" class="form-control" name="todate[]" value="" placeholder="Enter to date" data-parsley-error-message=" Please enter to date" data-parsley-trigger="change" required="">'+
                    '</td>'+
                    '<td width="10%">'+
                        '<a class="btn btn-outline btn-danger btn-xs text-white removeExperience"><i class="fa fa-remove"></i> Remove</a>'+
                    '</td>'+
                '</tr>'
        $('.tableImportantDateSection').append(HTML);
    });

    $(document).on('click','.removeAdmissionDatesRow', function(){
        countImportantDate--;
        $(this).parent().parent().remove();
    });
</script>