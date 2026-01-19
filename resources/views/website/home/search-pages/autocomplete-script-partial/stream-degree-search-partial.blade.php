<script type="text/javascript">
    $( function() {
        $("input[name=degree]").autocomplete({
            minLength: 1,
            source: function( request, response ) {
                $.ajax({
                    url: "/autocomplete/getStreamDegreeList",
                    data: {term: request.term},
                    success: function( data ) {
                        // response(data);
                        if(data.length == 0){
                            $('.resultForStreamDegreeList').empty();
                            $('.resultForStreamDegreeList').removeClass('hide');
                            $('.resultForStreamDegreeList').css({'height':'40px','overflow-y':'hidden'});
                            $('.resultForStreamDegreeList').html('<p class="padding-left15">No result found. Please try with another keyword</p>');    
                           // $("input[name=degree]").val('');
                        }else{
                            $('.resultForStreamDegreeList').empty();
                            var HTML = '<ul class="list-unstyled">';
                            $.each(data, function(i, item) {
                                HTML += '<li><a href="/'+data[i].functionalareapageslug+'/'+data[i].pageslug+'/colleges"><i class="fa fa-search" aria-hidden="true"></i>  '+data[i].name+' Colleges </a><span class="pull-right"><a href="/stream/'+data[i].functionalareapageslug+'/'+data[i].pageslug+'/courses">All Courses</a></span></li>';
                            });
                            HTML += '</ul>';
                            $('.resultForStreamDegreeList').removeClass('hide');
                            $('.resultForStreamDegreeList').css({'height':'','overflow-y':''});
                            $('.resultForStreamDegreeList').html(HTML); 
                        }
                    }
                });
            }
        });
    });
    $(document).on('click','.resultForStreamDegreeList > ul > li > a', function(){
        $("input[name=degree]").val($(this).text());
        $('.resultForStreamDegreeList').addClass('hide').empty();
    });
</script>