<script type="text/javascript">
    $( function() {
        $("input[name=careercourse]").autocomplete({
            minLength: 1,
            source: function( request, response ) {
                $.ajax({
                    url: "/autocomplete/getCareerCoursesList",
                    data: {term: request.term},
                    success: function( data ) {
                        // response(data);
                        if(data.length == 0){
                            $('.resultForCourseList').empty();
                            $('.resultForCourseList').removeClass('hide');
                            $('.resultForCourseList').css({'height':'40px','overflow-y':'hidden'});
                            $('.resultForCourseList').html('<p class="padding-left15">No result found. Please try with another keyword</p>');    
                           // $("input[name=careercourse]").val('');
                        }else{
                            $('.resultForCourseList').empty();
                            var HTML = '<ul class="list-unstyled">';
                            $.each(data, function(i, item) {
                                HTML += '<li><a href="/careers-courses/'+data[i].educationLevelSlug+'/'+data[i].slug+'">After - '+data[i].eduLevelName+' ('+data[i].title+')</a><span class="pull-right">'+data[i].functionalAreaName+'</span></li>';
                            });


                            HTML += '</ul>';
                            $('.resultForCourseList').removeClass('hide');
                            $('.resultForCourseList').css({'height':'','overflow-y':''});
                            $('.resultForCourseList').html(HTML); 
                        }
                    }
                });
            }
        });
    });
    $(document).on('click','.resultForCourseList > ul > li > a', function(){
        $("input[name=careercourse]").val($(this).text());
        $('.resultForCourseList').addClass('hide').empty();
    });
</script>