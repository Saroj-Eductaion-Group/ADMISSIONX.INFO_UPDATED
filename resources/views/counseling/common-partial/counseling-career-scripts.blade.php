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
    var countExamDates = 0;
    $('#addNewCounslingSkillRow').on('click', function(){
        countExamDates++;
        var HTML = ''+
                '<tr>'+
                    '<td width="95%">'+
                        '<input type="text" class="form-control" value="" name="skillTitle[]" placeholder="Skill">'+
                    '</td>'+
                    '<td>'+
                        '<a class="btn btn-outline btn-danger btn-xs removeCounslingSkill"><i class="fa fa-remove"></i> Remove</a>'+
                    '</td>'+
                '</tr>'
        $('.tableCounslingSkillSection').append(HTML);
    });

    $(document).on('click','.removeCounslingSkill', function(){
        countExamDates--;
        $(this).parent().parent().remove();
    });
</script>
<script type="text/javascript">
    var countExamDates = 0;
    $('#addNewCounslingJobRoleSaleryRow').on('click', function(){
        countExamDates++;
        var HTML = ''+
                '<tr>'+
                    '<td>'+
                        '<input type="text" class="form-control" value="" name="jobTitle[]" placeholder="Job Title">'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" class="form-control" value="" name="jobAvgSalery[]" placeholder="Avg Salery">'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" class="form-control" value="" name="jobTopCompany[]" placeholder="Top Company">'+
                    '</td>'+
                    '<td>'+
                        '<a class="btn btn-outline btn-danger btn-xs removeCounslingJobRoleSalery"><i class="fa fa-remove"></i> Remove</a>'+
                    '</td>'+
                '</tr>'
        $('.tableCounslingJobRoleSalerySection').append(HTML);
    });

    $(document).on('click','.removeCounslingJobRoleSalery', function(){
        countExamDates--;
        $(this).parent().parent().remove();
    });
</script>

<script type="text/javascript">
    var countExamDates = 0;
    $('#addNewCounslingWhereToStudyRow').on('click', function(){
        countExamDates++;
        var HTML = ''+
                '<tr>'+
                    '<td>'+
                        '<input type="text" class="form-control" value="" name="studyInstituteName[]" placeholder="Institute Name">'+
                    '</td>'+
                    '<td>'+
                        '<input type="url" class="form-control" value="" name="studyInstituteUrl[]" placeholder="Institute Url">'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" class="form-control" value="" name="studyCity[]" placeholder="Institute Place">'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" class="form-control" value="" name="studyProgrammeFees[]" placeholder="Programme Fees">'+
                    '</td>'+
                    '<td>'+
                        '<a class="btn btn-outline btn-danger btn-xs removeCounslingWhereToStudy"><i class="fa fa-remove"></i> Remove</a>'+
                    '</td>'+
                '</tr>'
        $('.tableCounslingWhereToStudySection').append(HTML);
    });

    $(document).on('click','.removeCounslingWhereToStudy', function(){
        countExamDates--;
        $(this).parent().parent().remove();
    });
</script>
