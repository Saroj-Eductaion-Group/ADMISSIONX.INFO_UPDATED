<style type="text/css">
    .dropdownheader {border: 1px solid #bfdef6;cursor: default;color: #17639f;background: #ecf5fc;font-weight: 700;}
    .disabledLink a {pointer-events:none; opacity:0.6;}
</style>
<script type="text/javascript">
jQuery('.searchAdsCollegeName').click(function(e){
    $("input[name=searchAdsCollegeName]").val('');
    var methodTypeId = $("input[name=methodTypeId]").val();
    var pageNameId = $("input[name=pageNameId]").val();
    $(".searchAdsCollegeName").autocomplete({
        minLength: 1,
        delay: 300,
        source: function( request, response ) {
            $.ajaxQ.abortAll();
            $.ajax({
                url: "/autocomplete/getAdsCollegeProfileList",
                data: {term: request.term, methodTypeId: methodTypeId, pageNameId: pageNameId},
                success: function( response ) {
                    if(response.status == false){
                        $('.resultForCollegeAdsList').empty();
                        $('.resultForCollegeAdsList').removeClass('hide');
                        $('.resultForCollegeAdsList').css({'height':'75px','overflow-y':'hidden'});
                        $('.resultForCollegeAdsList').html('<p style="padding-left : 10px;">No results were found in this list for "'+request.term+'"</a></p>');  
                    }else{
                        $('.resultForCollegeAdsList').empty();
                        var HTML = '<ul class="list-unstyled padding-left0 padding-right0">';

                        if(response.college.length > 0){
                            HTML += '<li disabled="" class="disabledLink dropdownheader"><a href="javascript:void(0);">College List</a></li>';
                        }
                        $.each(response.college, function(i, item) {
                            HTML += '<li><a href="javascript:void(0);" college_id="'+response.college[i].id+'">'+response.college[i].collegelogo+' '+response.college[i].collegename+' ('+response.college[i].collegeplace+')</a></li>';
                        });

                        HTML += '</ul>';
                        $('.resultForCollegeAdsList').removeClass('hide');
                        $('.resultForCollegeAdsList').css({'height':'','overflow-y':''});
                        $('.resultForCollegeAdsList').html(HTML); 
                    
                    }
                }
            });
        }
    });

    $(document).on('click','.resultForCollegeAdsList > ul > li > a', function(){
        var itemId = $("input[name=itemId]").val();
        var collegeNameClass = '#collegeName'+itemId;
        var collegeIdClass = '#collegeId'+itemId;
        $(collegeNameClass).val($(this).text());
        $(collegeIdClass).val($(this).attr('college_id'));
        $('.resultForCollegeAdsList').addClass('hide').empty();
        $("#filterCollegeProfileModal").modal('hide');
        $("input[name=searchAdsCollegeName]").val('');
        $("input[name=itemId]").val('');
    });
});
</script>
<script type="text/javascript">
    /*$( function() {
        $(".searchAdsCollegeName").autocomplete({
            minLength: 3,
            delay: 300,
            source: function( request, response ) {
                $.ajaxQ.abortAll();
                $.ajax({
                    url: "/autocomplete/getAdsCollegeProfileList",
                    data: {term: request.term},
                    success: function( response ) {
                        if(response.status == false){
                            $('.resultForCollegeAdsList').empty();
                            $('.resultForCollegeAdsList').removeClass('hide');
                            $('.resultForCollegeAdsList').css({'height':'75px','overflow-y':'hidden'});
                            $('.resultForCollegeAdsList').html('<p style="padding-left : 10px;">No results were found in this list for "'+request.term+'"</a></p>');  
                            // setTimeout(function(){
                            //    window.location     = window.location.pathname+"search?q="+request.term;
                            // }, 2000);
                            //$(".searchAdsCollegeName").val('');  
                        }else{
                            $('.resultForCollegeAdsList').empty();
                            var HTML = '<ul class="list-unstyled padding-left0 padding-right0">';

                            if(response.college.length > 0){
                                HTML += '<li disabled="" class="disabledLink dropdownheader"><a href="javascript:void(0);">College List</a></li>';
                            }
                            $.each(response.college, function(i, item) {
                            	HTML += '<li><div class=""><a href="javascript:void(0);" college_id="'+response.college[i].id+'">'+response.college[i].collegelogo+' '+response.college[i].collegename+' ('+response.college[i].collegeplace+')<br class="hidden-sm hidden-md hidden-lg"></div></a></li>';
                            });

                            HTML += '</ul>';
                            $('.resultForCollegeAdsList').removeClass('hide');
                            $('.resultForCollegeAdsList').css({'height':'','overflow-y':''});
                            $('.resultForCollegeAdsList').html(HTML); 
                        }
                        
                    }
                });
            }
        });
    });

    $(document).on('click','.resultForCollegeAdsList > ul > li > a', function(){
        $(".searchAdsCollegeName").val($(this).text());
        $('.resultForCollegeAdsList').addClass('hide').empty();
    });*/

    $.ajaxQ = (function(){
      var id = 0, Q = {};

      $(document).ajaxSend(function(e, jqx){
        jqx._id = ++id;
        Q[jqx._id] = jqx;
      });
      $(document).ajaxComplete(function(e, jqx){
        delete Q[jqx._id];
      });

      return {
        abortAll: function(){
          var r = [];
          $.each(Q, function(i, jqx){
            r.push(jqx._id);
            jqx.abort();
          });
          return r;
        }
      };

    })();
</script>