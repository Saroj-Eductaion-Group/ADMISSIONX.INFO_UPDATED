<script type="text/javascript">
    $( function() {
        $("input[name=search]").autocomplete({
            minLength: 1,
            source: function( request, response ) {
                $.ajax({
                    url: "/autocomplete/getStreamDegreeCourseEduList",
                    data: {term: request.term},
                    success: function( response ) {
                        if(response.status == false){
                            $('.resultForCommonSearchList').empty();
                            $('.resultForCommonSearchList').removeClass('hide');
                            $('.resultForCommonSearchList').css({'height':'75px','overflow-y':'hidden'});
                            $('.resultForCommonSearchList').html('<p style="padding-left : 10px;"><a href="/search?q='+request.term+'" style="cursor: pointer;">No results were found in this list for "'+request.term+'", please "click here" or "press enter button" so that we can get results from any other process.</a></p>');  
                            // setTimeout(function(){
                            //    window.location     = window.location.pathname+"search?q="+request.term;
                            // }, 2000);
                            //$(".searchname").val('');  
                        }else{
                            $('.resultForCommonSearchList').empty();
                            var HTML = '<ul class="list-unstyled padding-left0 padding-right0">';

                            if(response.functionalarea.length > 0){
                                //HTML += '<li disabled="" class="disabledLink dropdownheader"><a href="javascript:void(0);">Stram - Colleges</a></li>';
                            }
                            $.each(response.functionalarea, function(i, item) {
                               	HTML += '<li><a href="'+response.functionalarea[i].streamCollegeUrl+'"><i class="fa fa-search" aria-hidden="true"></i>  '+response.functionalarea[i].name+' Colleges </a><span class="pull-right"><a href="'+response.functionalarea[i].degreePageUrl+'">All Degree</a></span></li>';
                            });

                            if(response.educationlevel.length > 0){
                                //HTML += '<li disabled="" class="disabledLink dropdownheader"><a href="javascript:void(0);">Stram/Degree/Courses/Education Levels - Colleges</a></li>';
                            }
                            $.each(response.educationlevel, function(i, item) {
                               	HTML += '<li><a href="'+response.educationlevel[i].collegePageUrl+'"><i class="fa fa-search" aria-hidden="true"></i>  '+response.educationlevel[i].name+' Colleges </a></li>';
                            });

                            if(response.degree.length > 0){
                                //HTML += '<li disabled="" class="disabledLink dropdownheader"><a href="javascript:void(0);">Stram/Degree/Courses/Education Levels - Colleges</a></li>';
                            }
                            $.each(response.degree, function(i, item) {
                                 HTML += '<li><a href="'+response.degree[i].degreeCollegePageUrl+'"><i class="fa fa-search" aria-hidden="true"></i>  '+response.degree[i].name+' Colleges </a><span class="pull-right"><a href="'+response.degree[i].coursePageUrl+'">All Courses</a></span></li>';
                            });

                            if(response.courses.length > 0){
                                //HTML += '<li disabled="" class="disabledLink dropdownheader"><a href="javascript:void(0);">Stram/Degree/Courses/Education Levels - Colleges</a></li>';
                            }
                            $.each(response.courses, function(i, item) {
                                 HTML += '<li><a href="'+response.courses[i].courseCollegePageUrl+'"><i class="fa fa-search" aria-hidden="true"></i>  '+response.courses[i].name+' Colleges </a></li>';
                            });

                            HTML += '</ul>';
                            $('.resultForCommonSearchList').removeClass('hide');
                            $('.resultForCommonSearchList').css({'height':'','overflow-y':''});
                            $('.resultForCommonSearchList').html(HTML); 
                        }
                    }
                });
            }
        });
    });
    $(document).on('click','.resultForCommonSearchList > ul > li > a', function(){
        $("input[name=search]").val($(this).text());
        $('.resultForCommonSearchList').addClass('hide').empty();
    });
</script>