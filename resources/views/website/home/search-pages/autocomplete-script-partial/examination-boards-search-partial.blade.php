<script type="text/javascript">
    $( function() {
        $("input[name=examinationboards]").autocomplete({
            minLength: 1,
            source: function( request, response ) {
                $.ajax({
                    url: "/autocomplete/getExaminationBoardsList",
                    data: {term: request.term},
                    success: function( data ) {
                        // response(data);
                        if(data.length == 0){
                            $('.resultForExaminationBoards').empty();
                            $('.resultForExaminationBoards').removeClass('hide');
                            $('.resultForExaminationBoards').css({'height':'40px','overflow-y':'hidden'});
                            $('.resultForExaminationBoards').html('<p class="padding-left15">No result found. Please try with another keyword</p>');    
                           // $("input[name=examinationboards]").val('');
                        }else{
                            $('.resultForExaminationBoards').empty();
                            var HTML = '<ul class="list-unstyled">';
                            $.each(data, function(i, item) {
                                HTML += '<li><a href="/board/'+data[i].misc.toLowerCase()+'/'+data[i].slug+'">'+data[i].name+'-'+data[i].title+'</a><span class="pull-right">'+data[i].misc+'</span></li>';
                            });

                            HTML += '</ul>';
                            $('.resultForExaminationBoards').removeClass('hide');
                            $('.resultForExaminationBoards').css({'height':'','overflow-y':''});
                            $('.resultForExaminationBoards').html(HTML); 
                        }
                    }
                });
            }
        });
    });
    $(document).on('click','.resultForExaminationBoards > ul > li > a', function(){
        $("input[name=examinationboards]").val($(this).text());
        $('.resultForExaminationBoards').addClass('hide').empty();
    });
</script>