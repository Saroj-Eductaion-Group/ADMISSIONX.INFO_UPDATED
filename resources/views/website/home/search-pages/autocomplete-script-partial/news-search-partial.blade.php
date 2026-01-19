<script type="text/javascript">
    $( function() {
        $("input[name=newstopic]").autocomplete({
            minLength: 1,
            source: function( request, response ) {
                $.ajax({
                    url: "/autocomplete/getNewsList",
                    data: {term: request.term},
                    success: function( data ) {
                        // response(data);
                        if(data.length == 0){
                            $('.resultForNewsList').empty();
                            $('.resultForNewsList').removeClass('hide');
                            $('.resultForNewsList').css({'height':'40px','overflow-y':'hidden'});
                            $('.resultForNewsList').html('<p class="padding-left15">No result found. Please try with another keyword</p>');    
                           // $("input[name=newstopic]").val('');
                        }else{
                            $('.resultForNewsList').empty();
                            var HTML = '<ul class="list-unstyled">';
                            $.each(data, function(i, item) {
                                HTML += '<li><a href="/news/'+data[i].slug+'">'+data[i].topic+'</a></li>';
                            });

                            HTML += '</ul>';
                            $('.resultForNewsList').removeClass('hide');
                            $('.resultForNewsList').css({'height':'','overflow-y':''});
                            $('.resultForNewsList').html(HTML); 
                        }
                    }
                });
            }
        });
    });
    $(document).on('click','.resultForNewsList > ul > li > a', function(){
        $("input[name=newstopic]").val($(this).text());
        $('.resultForNewsList').addClass('hide').empty();
    });
</script>