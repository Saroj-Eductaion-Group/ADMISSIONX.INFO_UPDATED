<script type="text/javascript">
    $( function() {
        $("input[name=askquestion]").autocomplete({
            minLength: 2,
            source: function( request, response ) {
                $.ajax({
                    url: "/autocomplete/getAskQuestionList",
                    data: {term: request.term},
                    success: function( response ) {
                        if(response.status == false){
                            $('.resultForAskQuestionList').empty();
                            $('.resultForAskQuestionList').removeClass('hide');
                            $('.resultForAskQuestionList').css({'height':'40px','overflow-y':'hidden'});
                            $('.resultForAskQuestionList').html('<p style="padding-left : 10px;">No result found. Please try with another keyword</p>');  
                            //$("input[name=askquestion]").val('');  
                        }else{
                            $('.resultForAskQuestionList').empty();
                            var HTML = '<ul class="list-unstyled padding-left0 padding-right0">';

                            $.each(response.resultAskQuestion, function(i, item) {
                                HTML += '<li><a href="'+response.resultAskQuestion[i].askPageUrl+'"><i class="fa fa-search" aria-hidden="true"></i>  '+response.resultAskQuestion[i].question+'</a><span class="pull-right">Question</span></li>';
                            });
                            
                            $.each(response.resultAskQuestionTag, function(i, item) {
                                HTML += '<li><a href="'+response.resultAskQuestionTag[i].tagUrl+'"><i class="fa fa-search" aria-hidden="true"></i>  '+response.resultAskQuestionTag[i].name+'</a> <span class="pull-right">Tag</span></li>';
                            });

                            $.each(response.resultAskQuestionAnswer, function(i, item) {
                                HTML += '<li><a href="'+response.resultAskQuestionAnswer[i].answerUrl+'"><i class="fa fa-search" aria-hidden="true"></i>  '+response.resultAskQuestionAnswer[i].question+'</a><span class="pull-right">Answer</span></li>';
                            });

                            HTML += '</ul>';
                            $('.resultForAskQuestionList').removeClass('hide');
                            $('.resultForAskQuestionList').css({'height':'','overflow-y':''});
                            $('.resultForAskQuestionList').html(HTML); 
                        }
                        
                    }
                });
            }
        });
    });

    $(document).on('click','.resultForAskQuestionList > ul > li > a', function(){
        $("input[name=askquestion]").val($(this).text());
        $('.resultForAskQuestionList').addClass('hide').empty();
    });
</script>

<script type="text/javascript">
// POST YOUR QUESTION AND THEN OPEN LOGIN FORM
$('.checkLoginStatusAskQuestionSubmit' ).submit(function(e) {
    e.preventDefault();
    var form = $(this).serialize();
    // $(this).find('button').addClass('pulse').addClass('hide');
    if ($(this).parsley().isValid()) {
        //PARSLEY RETURN TRUE
        $.ajax({
            type: "POST",
            url: "{{ URL::to('/api/set/ask-question') }}",
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
$('.checkLoginStatusAskAnswerSubmit' ).submit(function(e) {
    e.preventDefault();
    var form = $(this).serialize();
    // $(this).find('button').addClass('pulse').addClass('hide');
    if ($(this).parsley().isValid()) {
        //PARSLEY RETURN TRUE
        $.ajax({
            type: "POST",
            url: "{{ URL::to('/api/set/ask-answer') }}",
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
$('.checkLoginStatusAskCommentSubmit' ).submit(function(e) {
    e.preventDefault();
    var form = $(this).serialize();
    // $(this).find('button').addClass('pulse').addClass('hide');
    if ($(this).parsley().isValid()) {
        //PARSLEY RETURN TRUE
        $.ajax({
            type: "POST",
            url: "{{ URL::to('/api/set/ask-comments') }}",
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