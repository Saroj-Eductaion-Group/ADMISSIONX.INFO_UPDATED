<script type="text/javascript">
    $( function() {
        $("input[name=examination]").autocomplete({
            minLength: 2,
            source: function( request, response ) {
                $.ajax({
                    url: "/autocomplete/getExaminationList",
                    data: {term: request.term},
                    success: function( response ) {
                        if(response.status == false){
                            $('.resultForExaminationList').empty();
                            $('.resultForExaminationList').removeClass('hide');
                            $('.resultForExaminationList').css({'height':'40px','overflow-y':'hidden'});
                            $('.resultForExaminationList').html('<p style="padding-left : 10px;">No result found. Please try with another keyword</p>');  
                            //$("input[name=examination]").val('');  
                        }else{
                            $('.resultForExaminationList').empty();
                            var HTML = '<ul class="list-unstyled padding-left0 padding-right0">';

                            $.each(response.examsection, function(i, item) {
                                HTML += '<li><a href="'+response.examsection[i].examSectionUrl+'"><i class="fa fa-search" aria-hidden="true"></i>  '+response.examsection[i].name+'</a><span class="pull-right">Exam Section</span></li>';
                            });
                            
                            $.each(response.examlist, function(i, item) {
                                HTML += '<li><a href="'+response.examlist[i].examUrl+'"><i class="fa fa-search" aria-hidden="true"></i>  '+response.examlist[i].name+'</a></li>';
                            });

                            $.each(response.examdegree, function(i, item) {
                                HTML += '<li><a href="'+response.examdegree[i].degreeUrl+'"><i class="fa fa-search" aria-hidden="true"></i>  '+response.examdegree[i].degreeName+'</a><span class="pull-right">Degree</span></li>';
                            });
                            HTML += '</ul>';
                            $('.resultForExaminationList').removeClass('hide');
                            $('.resultForExaminationList').css({'height':'','overflow-y':''});
                            $('.resultForExaminationList').html(HTML); 
                        }
                        
                    }
                });
            }
        });
    });

    $(document).on('click','.resultForExaminationList > ul > li > a', function(){
        $("input[name=examination]").val($(this).text());
        $('.resultForExaminationList').addClass('hide').empty();
    });
</script>
<script type="text/javascript">
// POST YOUR QUESTION AND THEN OPEN LOGIN FORM
$('.checkLoginStatusQuestionSubmit' ).submit(function(e) {
    e.preventDefault();
    var form = $(this).serialize();
    // $(this).find('button').addClass('pulse').addClass('hide');
    if ($(this).parsley().isValid()) {
        //PARSLEY RETURN TRUE
        $.ajax({
            type: "POST",
            url: "{{ URL::to('/api/set/examination-question') }}",
            data: form,
            success: function(data){
                $('#loginModal').modal({
                    show: 'true'
                });
            },
            error: function(data){
            }
        });
    }else{
        
    }
});
</script>

<script type="text/javascript">
// POST YOUR QUESTION AND THEN OPEN LOGIN FORM
$('.checkLoginStatusAnswerSubmit' ).submit(function(e) {
    e.preventDefault();
    var form = $(this).serialize();
    // $(this).find('button').addClass('pulse').addClass('hide');
    if ($(this).parsley().isValid()) {
        //PARSLEY RETURN TRUE
        $.ajax({
            type: "POST",
            url: "{{ URL::to('/api/set/examination-answer') }}",
            data: form,
            success: function(data){
                $('#loginModal').modal({
                    show: 'true'
                });
            },
            error: function(data){
            }
        });
    }else{
        
    }
});
</script>

<script type="text/javascript">
// POST YOUR QUESTION AND THEN OPEN LOGIN FORM
$('.checkLoginStatusCommentSubmit' ).submit(function(e) {
    e.preventDefault();
    var form = $(this).serialize();
    // $(this).find('button').addClass('pulse').addClass('hide');
    if ($(this).parsley().isValid()) {
        //PARSLEY RETURN TRUE
        $.ajax({
            type: "POST",
            url: "{{ URL::to('/api/set/examination-comments') }}",
            data: form,
            success: function(data){
                $('#loginModal').modal({
                    show: 'true'
                });
            },
            error: function(data){
            }
        });
    }else{
        
    }
});
</script>