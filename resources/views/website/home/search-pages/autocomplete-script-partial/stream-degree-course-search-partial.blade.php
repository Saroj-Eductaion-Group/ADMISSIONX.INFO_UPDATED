<script type="text/javascript">
    $( function() {
        $("input[name=course]").autocomplete({
            minLength: 1,
            source: function( request, response ) {
                $.ajax({
                    url: "/autocomplete/getStreamDegreeCourseList",
                    data: {term: request.term},
                    success: function( data ) {
                        // response(data);
                        if(data.length == 0){
                            $('.resultForStreamDegreeCourseList').empty();
                            $('.resultForStreamDegreeCourseList').removeClass('hide');
                            $('.resultForStreamDegreeCourseList').css({'height':'40px','overflow-y':'hidden'});
                            $('.resultForStreamDegreeCourseList').html('<p class="padding-left15">No result found. Please try with another keyword</p>');    
                           // $("input[name=course]").val('');
                        }else{
                            $('.resultForStreamDegreeCourseList').empty();
                            var HTML = '<ul class="list-unstyled">';
                            $.each(data, function(i, item) {
                                HTML += '<li><a href="/'+data[i].functionalareapageslug+'/'+data[i].degreepageslug+'/'+data[i].pageslug+'/colleges">'+data[i].name+'</a></li>';
                            });
                            HTML += '</ul>';
                            $('.resultForStreamDegreeCourseList').removeClass('hide');
                            $('.resultForStreamDegreeCourseList').css({'height':'','overflow-y':''});
                            $('.resultForStreamDegreeCourseList').html(HTML); 
                        }
                    }
                });
            }
        });
    });
    $(document).on('click','.resultForStreamDegreeCourseList > ul > li > a', function(){
        $("input[name=course]").val($(this).text());
        $('.resultForStreamDegreeCourseList').addClass('hide').empty();
    });
</script>