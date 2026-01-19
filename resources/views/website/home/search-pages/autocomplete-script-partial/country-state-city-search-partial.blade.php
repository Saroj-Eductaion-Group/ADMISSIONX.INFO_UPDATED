<script type="text/javascript">
    $( function() {
        $("input[name=studyabroad]").autocomplete({
            minLength: 2,
            source: function( request, response ) {
                $.ajax({
                    url: "/autocomplete/getCountryStateCityList",
                    data: {term: request.term},
                    success: function( response ) {
                        if(response.status == false){
                            $('.resultForCountryList').empty();
                            $('.resultForCountryList').removeClass('hide');
                            $('.resultForCountryList').css({'height':'40px','overflow-y':'hidden'});
                            $('.resultForCountryList').html('<p style="padding-left : 10px;">No result found. Please try with another keyword</p>');  
                            //$("input[name=studyabroad]").val('');  
                        }else{
                            $('.resultForCountryList').empty();
                            var HTML = '<ul class="list-unstyled padding-left0 padding-right0">';

                            $.each(response.resultCountry, function(i, item) {
                                HTML += '<li><a href="'+response.resultCountry[i].countryCollegePageUrl+'"><i class="fa fa-search" aria-hidden="true"></i>  '+response.resultCountry[i].countryname+' Colleges </a><span class="pull-right"><a href="'+response.resultCountry[i].countryStatePageUrl+'">All States</a></span></li>';
                            });

                            $.each(response.resultCountryWiseState, function(i, item) {
                                HTML += '<li><a href="'+response.resultCountryWiseState[i].stateCollegePageUrl+'"><i class="fa fa-search" aria-hidden="true"></i>  '+response.resultCountryWiseState[i].statename+' Colleges </a><span class="pull-right"><a href="'+response.resultCountryWiseState[i].stateCitiesPageUrl+'">All Cities</a></span></li>';
                            });
                            
                            $.each(response.resultStateWiseCity, function(i, item) {
                                HTML += '<li><a href="'+response.resultStateWiseCity[i].cityCollegePageUrl+'"><i class="fa fa-search" aria-hidden="true"></i>  '+response.resultStateWiseCity[i].cityname+'</a><span class="pull-right">College list</span></li>';
                            });

                            HTML += '</ul>';
                            $('.resultForCountryList').removeClass('hide');
                            $('.resultForCountryList').css({'height':'','overflow-y':''});
                            $('.resultForCountryList').html(HTML); 
                        }
                        
                    }
                });
            }
        });
    });

    $(document).on('click','.resultForCountryList > ul > li > a', function(){
        $("input[name=studyabroad]").val($(this).text());
        $('.resultForCountryList').addClass('hide').empty();
    });
</script>