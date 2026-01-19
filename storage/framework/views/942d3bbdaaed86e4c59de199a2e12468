<script type="text/javascript">
    $( function() {
        $("input[name=college]").autocomplete({
            minLength: 1,
            source: function( request, response ) {
                $.ajax({
                    url: "/autocomplete/getCollegeList",
                    data: {term: request.term},
                    success: function( data ) {
                        // response(data);
                        if(data.length == 0){
                            $('.resultForCollegeList').empty();
                            $('.resultForCollegeList').removeClass('hide');
                            $('.resultForCollegeList').css({'height':'40px','overflow-y':'hidden'});
                            $('.resultForCollegeList').html('<p class="padding-left15">No result found. Please try with another keyword</p>');    
                           // $("input[name=college]").val('');
                        }else{
                            $('.resultForCollegeList').empty();
                            var HTML = '<ul class="list-unstyled">';
                            $.each(data, function(i, item) {
                                HTML += '<li><div class=""><a href="'+data[i].collegeUrl+'">'+data[i].collegelogo+' '+data[i].collegename+' ('+data[i].collegeplace+')<br class="hidden-sm hidden-md hidden-lg"></div></a></li>';
                            });
                            HTML += '</ul>';
                            $('.resultForCollegeList').removeClass('hide');
                            $('.resultForCollegeList').css({'height':'','overflow-y':''});
                            $('.resultForCollegeList').html(HTML); 
                        }
                    }
                });
            }
        });
    });
    $(document).on('click','.resultForCollegeList > ul > li > a', function(){
        $("input[name=college]").val($(this).text());
        $('.resultForCollegeList').addClass('hide').empty();
    });
</script>