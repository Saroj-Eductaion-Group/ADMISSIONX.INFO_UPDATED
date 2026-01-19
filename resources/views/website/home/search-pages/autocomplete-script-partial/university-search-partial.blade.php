<script type="text/javascript">
    $( function() {
        $("input[name=university]").autocomplete({
            minLength: 1,
            source: function( request, response ) {
                $.ajax({
                    url: "/autocomplete/getUniversityList",
                    data: {term: request.term},
                    success: function( data ) {
                        // response(data);
                        if(data.length == 0){
                            $('.resultForUniversityList').empty();
                            $('.resultForUniversityList').removeClass('hide');
                            $('.resultForUniversityList').css({'height':'40px','overflow-y':'hidden'});
                            $('.resultForUniversityList').html('<p class="padding-left15">No result found. Please try with another keyword</p>');    
                           // $("input[name=university]").val('');
                        }else{
                            $('.resultForUniversityList').empty();
                            var HTML = '<ul class="list-unstyled">';
                            $.each(data, function(i, item) {
                                HTML += '<li><a href="/university/'+data[i].pageslug+'">'+data[i].name+'</a></li>';
                            });
                            HTML += '</ul>';
                            $('.resultForUniversityList').removeClass('hide');
                            $('.resultForUniversityList').css({'height':'','overflow-y':''});
                            $('.resultForUniversityList').html(HTML); 
                        }
                    }
                });
            }
        });
    });
    $(document).on('click','.resultForUniversityList > ul > li > a', function(){
        $("input[name=university]").val($(this).text());
        $('.resultForUniversityList').addClass('hide').empty();
    });
</script>