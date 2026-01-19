<script type="text/javascript">
    $( function() {
        $("input[name=popularcareer]").autocomplete({
            minLength: 1,
            source: function( request, response ) {
                $.ajax({
                    url: "/autocomplete/getPopularCareerCoursesList",
                    data: {term: request.term},
                    success: function( data ) {
                        // response(data);
                        if(data.length == 0){
                            $('.resultForPopularCareerList').empty();
                            $('.resultForPopularCareerList').removeClass('hide');
                            $('.resultForPopularCareerList').css({'height':'40px','overflow-y':'hidden'});
                            $('.resultForPopularCareerList').html('<p class="padding-left15">No result found. Please try with another keyword</p>');    
                           // $("input[name=popularcareer]").val('');
                        }else{
                            $('.resultForPopularCareerList').empty();
                            var HTML = '<ul class="list-unstyled">';
                            $.each(data, function(i, item) {
                                HTML += '<li><a href="/popular-careers/'+data[i].slug+'">'+data[i].title+'</a><span class="pull-right">Popular Careers</span></li>';
                            });

                            HTML += '</ul>';
                            $('.resultForPopularCareerList').removeClass('hide');
                            $('.resultForPopularCareerList').css({'height':'','overflow-y':''});
                            $('.resultForPopularCareerList').html(HTML); 
                        }
                    }
                });
            }
        });
    });
    $(document).on('click','.resultForPopularCareerList > ul > li > a', function(){
        $("input[name=popularcareer]").val($(this).text());
        $('.resultForPopularCareerList').addClass('hide').empty();
    });
</script>