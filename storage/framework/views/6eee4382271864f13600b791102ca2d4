<style type="text/css">
    .dropdownheader {border: 1px solid #bfdef6;cursor: default;color: #17639f;background: #ecf5fc;font-weight: 700;}
    .disabledLink a {pointer-events:none; opacity:0.6;}
</style>
<script type="text/javascript">
    $( function() {
        $(".searchname").autocomplete({
            minLength: 2,
            delay: 300,
            source: function( request, response ) {
                // var request_autocomplete=jQuery.ajax({});
                // if( request_autocomplete ) {
                //     request_autocomplete.abort();
                // }
                $.ajaxQ.abortAll();
                $.ajax({
                    url: "/autocomplete/getAllSearchTypeList",
                    data: {term: request.term},
                    success: function( response ) {
                        if(response.status == false){
                            $('.resultForCollegeList').empty();
                            $('.resultForCollegeList').removeClass('hide');
                            $('.resultForCollegeList').css({'height':'75px','overflow-y':'hidden'});
                            $('.resultForCollegeList').html('<p style="padding-left : 10px;"><a href="/search?q='+request.term+'" style="cursor: pointer;">No results were found in this list for "'+request.term+'", please "click here" or "press enter button" so that we can get results from any other process.</a></p>');  
                            // setTimeout(function(){
                            //    window.location     = window.location.pathname+"search?q="+request.term;
                            // }, 2000);
                            //$(".searchname").val('');  
                        }else{
                            $('.resultForCollegeList').empty();
                            var HTML = '<ul class="list-unstyled padding-left0 padding-right0">';

                            if((response.functionalarea.length > 0) || (response.educationlevel.length > 0) || (response.degree.length > 0) || (response.courses.length > 0)){
                                HTML += '<li disabled="" class="disabledLink dropdownheader"><a href="javascript:void(0);">Stram/Degree/Courses/Education Levels - Colleges</a></li>';
                            }
                            $.each(response.functionalarea, function(i, item) {
                               	HTML += '<li><a href="'+response.functionalarea[i].streamCollegeUrl+'"><i class="fa fa-search" aria-hidden="true"></i>  '+response.functionalarea[i].name+' Colleges </a><span class="pull-right"><a href="'+response.functionalarea[i].degreePageUrl+'">All Degree</a></span></li>';
                            });

                            $.each(response.educationlevel, function(i, item) {
                               	HTML += '<li><a href="'+response.educationlevel[i].collegePageUrl+'"><i class="fa fa-search" aria-hidden="true"></i>  '+response.educationlevel[i].name+' Colleges </a></li>';
                            });

                            $.each(response.degree, function(i, item) {
                                 HTML += '<li><a href="'+response.degree[i].degreeCollegePageUrl+'"><i class="fa fa-search" aria-hidden="true"></i>  '+response.degree[i].name+' Colleges </a><span class="pull-right"><a href="'+response.degree[i].coursePageUrl+'">All Courses</a></span></li>';
                            });

                            $.each(response.courses, function(i, item) {
                                 HTML += '<li><a href="'+response.courses[i].courseCollegePageUrl+'"><i class="fa fa-search" aria-hidden="true"></i>  '+response.courses[i].name+' Colleges </a></li>';
                            });


                            if((response.resultCountry.length > 0) || (response.resultState.length > 0) || (response.resultCity.length > 0)){
                                HTML += '<li disabled="" class="disabledLink dropdownheader"><a href="javascript:void(0);">Country/State/Cities</a></li>';
                            }
                            
                            $.each(response.resultCountry, function(i, item) {
                                HTML += '<li><a href="'+response.resultCountry[i].countryCollegePageUrl+'"><i class="fa fa-search" aria-hidden="true"></i>  '+response.resultCountry[i].countryname+' Colleges </a><span class="pull-right"><a href="'+response.resultCountry[i].countryStatePageUrl+'">All States</a></span></li>';
                            });

                            $.each(response.resultState, function(i, item) {
                                HTML += '<li><a href="'+response.resultState[i].stateCollegePageUrl+'"><i class="fa fa-search" aria-hidden="true"></i>  '+response.resultState[i].statename+' Colleges </a><span class="pull-right"><a href="'+response.resultState[i].stateCitiesPageUrl+'">All Cities</a></span></li>';
                            });
                            
                            $.each(response.resultCity, function(i, item) {
                                HTML += '<li><a href="'+response.resultCity[i].cityCollegePageUrl+'"><i class="fa fa-search" aria-hidden="true"></i>  '+response.resultCity[i].cityname+'</a><span class="pull-right">College list</span></li>';
                            });

                            if(response.college.length > 0){
                                HTML += '<li disabled="" class="disabledLink dropdownheader"><a href="javascript:void(0);">College List</a></li>';
                            }
                            $.each(response.college, function(i, item) {
                            	HTML += '<li><div class=""><a href="'+response.college[i].collegeUrl+'">'+response.college[i].collegelogo+' '+response.college[i].collegename+' ('+response.college[i].collegeplace+')<br class="hidden-sm hidden-md hidden-lg"></div></a></li>';
                            });


                            if(response.university.length > 0){
                                HTML += '<li disabled="" class="disabledLink dropdownheader"><a href="javascript:void(0);">University List</a></li>';
                            }
                            $.each(response.university, function(i, item) {
                                HTML += '<li><div class=""><a href="'+response.university[i].universityurl+'">'+response.university[i].logo+' '+response.university[i].universityname+'<br class="hidden-sm hidden-md hidden-lg"></div></a></li>';
                            });

                            if((response.examsection.length > 0) || (response.examlist.length > 0) || (response.examdegree.length > 0)){
                                HTML += '<li disabled="" class="disabledLink dropdownheader"><a href="javascript:void(0);">Examinations</a></li>';
                            }
                            $.each(response.examsection, function(i, item) {
                                HTML += '<li><a href="'+response.examsection[i].examSectionUrl+'"><i class="fa fa-search" aria-hidden="true"></i>  '+response.examsection[i].name+'</a><span class="pull-right">Exam Section</span></li>';
                            });
                            
                            $.each(response.examlist, function(i, item) {
                                HTML += '<li><a href="'+response.examlist[i].examUrl+'"><i class="fa fa-search" aria-hidden="true"></i>  '+response.examlist[i].name+'</a></li>';
                            });

                            $.each(response.examdegree, function(i, item) {
                                HTML += '<li><a href="'+response.examdegree[i].degreeUrl+'"><i class="fa fa-search" aria-hidden="true"></i>  '+response.examdegree[i].degreeName+'</a><span class="pull-right">Degree</span></li>';
                            });

                            if((response.counselingCourses.length > 0) || (response.popularCareer.length > 0) || (response.examinationBoards.length > 0)){
                                HTML += '<li disabled="" class="disabledLink dropdownheader"><a href="javascript:void(0);">Counseling/Career/Jobs</a></li>';
                            }
                            $.each(response.counselingCourses, function(i, item) {
                                HTML += '<li><a href="'+response.counselingCourses[i].careersCoursesUrl+'">After - '+response.counselingCourses[i].eduLevelName+' ('+response.counselingCourses[i].title+')</a><span class="pull-right">'+response.counselingCourses[i].functionalAreaName+'</span></li>';
                            });

                            $.each(response.popularCareer, function(i, item) {
                                HTML += '<li><a href="'+response.popularCareer[i].popularCareerUrl+'"><i class="fa fa-search" aria-hidden="true"></i>  '+response.popularCareer[i].title+'</a><span class="pull-right">Popular Careers</span></li>';
                            });

                            $.each(response.examinationBoards, function(i, item) {
                                HTML += '<li><a href="'+response.examinationBoards[i].boardUrl+'">'+response.examinationBoards[i].name+'-'+response.examinationBoards[i].title+'</a><span class="pull-right">'+response.examinationBoards[i].misc+'</span></li>';
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
        $(".searchname").val($(this).text());
        $('.resultForCollegeList').addClass('hide').empty();
    });

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