<script type="text/javascript">
    $( function() {
        $("input[name=stream]").autocomplete({
            minLength: 1,
            source: function( request, response ) {
                $.ajax({
                    url: "/autocomplete/getStreamList",
                    data: {term: request.term},
                    success: function( data ) {
                        // response(data);
                        if(data.length == 0){
                            $('.resultForStreamList').empty();
                            $('.resultForStreamList').removeClass('hide');
                            $('.resultForStreamList').css({'height':'40px','overflow-y':'hidden'});
                            $('.resultForStreamList').html('<p class="padding-left15">No result found. Please try with another keyword</p>');    
                           // $("input[name=stream]").val('');
                        }else{
                            $('.resultForStreamList').empty();
                            var HTML = '<ul class="list-unstyled">';
                            $.each(data, function(i, item) {
                                HTML += '<li><a href="/'+data[i].pageslug+'/colleges"><i class="fa fa-search" aria-hidden="true"></i>  '+data[i].name+' Colleges </a><span class="pull-right"><a href="/stream/'+data[i].pageslug+'/degree">All Degree</a></span></li>';
                            });
                            HTML += '</ul>';
                            $('.resultForStreamList').removeClass('hide');
                            $('.resultForStreamList').css({'height':'','overflow-y':''});
                            $('.resultForStreamList').html(HTML); 
                        }
                    }
                });
            }
        });
    });
    $(document).on('click','.resultForStreamList > ul > li > a', function(){
        $("input[name=stream]").val($(this).text());
        $('.resultForStreamList').addClass('hide').empty();
    });
</script>