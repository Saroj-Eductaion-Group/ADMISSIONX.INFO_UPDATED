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
<script type="text/javascript">
    var countJobCareer = 0;
    $('#addNewCoursesJobCareerRow').on('click', function(){
        countJobCareer++;
        var HTML = ''+
                '<tr>'+
                    '<td>'+
                        '<input type="text" class="form-control" value="" name="courseName[]" placeholder="Course Name">'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" class="form-control" value="" name="jobProfiles[]" placeholder="Job Profiles">'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" class="form-control" value="" name="avgSalery[]" placeholder="Avg Salery">'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" class="form-control" value="" name="topCompany[]" placeholder="Top Company">'+
                    '</td>'+
                    '<td>'+
                        '<a class="btn btn-outline btn-danger btn-xs removeCoursesJobCareer"><i class="fa fa-remove"></i> Remove</a>'+
                    '</td>'+
                '</tr>'
        $('.tableCoursesJobCareerSection').append(HTML);
    });

    $(document).on('click','.removeCoursesJobCareer', function(){
        countJobCareer--;
        $(this).parent().parent().remove();
    });
</script>
