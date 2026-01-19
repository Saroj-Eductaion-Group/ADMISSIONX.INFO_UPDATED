<script type="text/javascript">
    $( function() {
        $("input[name=blogtopic]").autocomplete({
            minLength: 1,
            source: function( request, response ) {
                $.ajax({
                    url: "/autocomplete/getBlogsList",
                    data: {term: request.term},
                    success: function( data ) {
                        // response(data);
                        if(data.length == 0){
                            $('.resultForBlogList').empty();
                            $('.resultForBlogList').removeClass('hide');
                            $('.resultForBlogList').css({'height':'40px','overflow-y':'hidden'});
                            $('.resultForBlogList').html('<p class="padding-left15">No result found. Please try with another keyword</p>');    
                           // $("input[name=blogtopic]").val('');
                        }else{
                            $('.resultForBlogList').empty();
                            var HTML = '<ul class="list-unstyled">';
                            $.each(data, function(i, item) {
                                HTML += '<li><a href="/blogs/'+data[i].slug+'">'+data[i].topic+'</a></li>';
                            });

                            HTML += '</ul>';
                            $('.resultForBlogList').removeClass('hide');
                            $('.resultForBlogList').css({'height':'','overflow-y':''});
                            $('.resultForBlogList').html(HTML); 
                        }
                    }
                });
            }
        });
    });
    $(document).on('click','.resultForBlogList > ul > li > a', function(){
        $("input[name=blogtopic]").val($(this).text());
        $('.resultForBlogList').addClass('hide').empty();
    });
</script>