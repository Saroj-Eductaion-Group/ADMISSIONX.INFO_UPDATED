//STABILIZTION
var functionalareaID = $('#functionalareaID').val();
if( functionalareaID == null ){
    $('#sortBy' ).addClass('hide');
    $('#degreeID').find('option').remove().end();
    $('#courseID').find('option').remove().end();
}


//GET ALL DEGREE AND COURSES AS PER STREAM
$('#functionalareaID').on('change', function(){
    //CLEAN ON HIT
    $('#degreeID').find('option').remove().end();
    $('#courseID').find('option').remove().end();
    
    var functionalareaID = $(this).val();
    var optionListDegree = '';
    var optionListCourse = '';
    $.ajax({
        type: "POST",
    url: '/get-all-degree-multi-by-stream',
        data: {
            functionalareaID: functionalareaID,
        },
        dataType: "json",
        success: function(data){
            if(data.code == '200'){
                $(data.getAllDegreeObj).each(function(key,item){
                    optionListDegree += '<option value="'+data.getAllDegreeObj[key].id+'">'+data.getAllDegreeObj[key].name+'</option>';                    
                });
                $('#degreeID').html(optionListDegree);                
                $("#degreeID").trigger("chosen:updated");

                $(data.getAllCourseObj).each(function(key,item){
                    optionListCourse += '<option value="'+data.getAllCourseObj[key].id+'">'+data.getAllCourseObj[key].name+'</option>';                    
                });
                $('#courseID').html(optionListCourse);                
                $("#courseID").trigger("chosen:updated");
            }
        }
    });
});

//SELECT SEARCH
$('select').on('change', function(){

	//GET PARAMS
	var functionalareaID = $('#functionalareaID').val();
	var degreeID = $('#degreeID').val();
	var courseID = $('#courseID').val();
	var educationLevelID = $('#educationLevelID').val();
	var stateID = $('#stateID').val();
	var cityID = $('#cityID').val();
    var sortBy = $('#sortBy').val();

	var HTML = '';
    var structure = '';

    $('.loader').removeClass('hide');
	$('.filter-results-blocks').html('');

	$.ajax({
        type: "POST",
        url: '/explore/multi/college',
        data: {
            functionalareaID: functionalareaID,
            degreeID: degreeID,
            courseID: courseID,
            educationLevelID: educationLevelID,
            stateID: stateID,
            cityID: cityID,
            sortBy: sortBy,
        },
        dataType: "json",
        success: function(data){
            $('.loader').addClass('hide');
            $('input[name=oldUsersId]').val(data.getFilterOutDataObj1+"', '"+oldUsersId);
            $('#oldUsersId').val(data.getFilterOutDataObj1+"', '"+oldUsersId);
            if( data.code == '200' ){
                var structure = createBodyForResult(functionalareaID, degreeID, courseID, data);
                if( functionalareaID != null ){
                    $('#sortBy' ).removeClass('hide');
                }else{
                    $('#sortBy' ).addClass('hide');
                }
                $('.filter-results-blocks').html(structure);

                var total = functionalareaID+degreeID;
                if( courseID != null ){
                    if( total != '0' ){
                        // $('.hideDataAfterFilter').removeClass('hide');    
                    }else{
                        // $('.hideDataAfterFilter').addClass('hide');
                    }
                }else{
                    // $('.hideDataAfterFilter').addClass('hide');
                }

            }else{
                HTML += '<div class="headline text-center"><h3>No match found, please try with different search criteria</h3></div>';
                $('.filter-results-blocks').html(HTML);
            }      
        }
    });
});

$('.resetNow').on('click', function(){
    $("select option:selected").removeAttr("selected");
    $("select").trigger("chosen:updated");
    window.location.reload();
});

// Read the slider value.
$('.slider-snap').on('change', function(){
    var lowerFees = $('.slider-snap-value-lower').text();
    var highFees = $('.slider-snap-value-upper').text();
    //GET PARAMS
    var functionalareaID = $('#functionalareaID').val();
    var degreeID = $('#degreeID').val();
    var courseID = $('#courseID').val();
    var educationLevelID = $('#educationLevelID').val();
    var stateID = $('#stateID').val();
    var cityID = $('#cityID').val();
    var sortBy = $('#sortBy').val();    

    var HTML = '';
    var structure = '';
    
    $('.loader').removeClass('hide');

    $.ajax({
        type: "POST",
        url: '/explore/multi/college',
        data: {
            lowerFees: lowerFees,
            highFees: highFees,
            functionalareaID: functionalareaID,
            degreeID: degreeID,
            courseID: courseID,
            educationLevelID: educationLevelID,
            stateID: stateID,
            cityID: cityID,
            sortBy: sortBy,
        },
        dataType: "json",
        success: function(data){
            $('.loader').addClass('hide');
            $('input[name=oldUsersId]').val(data.getFilterOutDataObj1+"', '"+oldUsersId);
            $('#oldUsersId').val(data.getFilterOutDataObj1+"', '"+oldUsersId);
            if( data.code == '200' ){
                var structure = createBodyForResult(functionalareaID, degreeID, courseID, data);
                if( functionalareaID != null ){
                    $('#sortBy' ).removeClass('hide');
                }else{
                    $('#sortBy' ).addClass('hide');
                }
                $('.filter-results-blocks').html(structure);

                var total = functionalareaID+degreeID;
                if( courseID != null ){
                    if( total != '0' ){
                        // $('.hideDataAfterFilter').removeClass('hide');    
                    }else{
                        // $('.hideDataAfterFilter').addClass('hide');
                    }
                }else{
                    // $('.hideDataAfterFilter').addClass('hide');
                }

            }else{
                HTML += '<div class="headline text-center"><h3>No match found, please try with different search criteria</h3></div>';
                $('.filter-results-blocks').html(HTML);
            }      
        }
    });

});

//SROLL DOWN AJAX CALL
var win = $(window);

    // Each time the user scrolls
    win.scroll(function() {
        // End of the document reached?
        // if ($(document).height() - win.height() == win.scrollTop()) {
        if ($(window).scrollTop() >= ($(document).height() - $(window).height())*0.8) {
            
            //GET PARAMS
            var functionalareaID = $('#functionalareaID').val();
            var degreeID = $('#degreeID').val();
            var courseID = $('#courseID').val();
            var educationLevelID = $('#educationLevelID').val();
            var stateID = $('#stateID').val();
            var cityID = $('#cityID').val();
            var sortBy = $('#sortBy').val();
            var oldUsersId = $('input[name=oldUsersId]').val();

            var HTML = '';
            var structure = '';

            $('.scrollDownLoader').removeClass('hide');
            
            $.ajax({
                type: "POST",
                url: '/explore/multi/college',
                async: false,
                data: {
                    functionalareaID: functionalareaID,
                    degreeID: degreeID,
                    courseID: courseID,
                    educationLevelID: educationLevelID,
                    stateID: stateID,
                    cityID: cityID,
                    sortBy: sortBy,
                    oldUsersId: oldUsersId,
                },
                dataType: "json",
                success: function(data){
                    $('.scrollDownLoader').addClass('hide');
                    $('input[name=oldUsersId]').val(data.getFilterOutDataObj1+"', '"+oldUsersId);
                    $('#oldUsersId').val(data.getFilterOutDataObj1+"', '"+oldUsersId);
                    if( data.code == '200' ){                        
                        var structure = createBodyForResult(functionalareaID, degreeID, courseID, data);
                        if( functionalareaID != null ){
                            $('#sortBy' ).removeClass('hide');
                        }else{
                            $('#sortBy' ).addClass('hide');
                        }
                        $('.filter-results-blocks').append(structure);

                        var total = functionalareaID+degreeID;
                        if( courseID != null ){
                            if( total != '0' ){
                                // $('.hideDataAfterFilter').removeClass('hide');    
                            }else{
                                // $('.hideDataAfterFilter').addClass('hide');
                            }
                        }else{
                            // $('.hideDataAfterFilter').addClass('hide');
                        }

                    }else{
                        $('.scrollDownLoader').addClass('hide');
                    }      
                }
            });
        }
    });


function createBodyForResult(functionalareaID, degreeID, courseID, data) {
    var HTML = '';
    $.each( data.getTotalCollegeDataObj, function( key, value ) {
        HTML += '<div class="col-xs-12 col-sm-6 col-md-6 col-md-6">';
            HTML += '<div class="row row-block-border marginall10">';
                HTML += '<a href="/college/'+data.getTotalCollegeDataObj[key].slug+'" title="'+data.getTotalCollegeDataObj[key].firstname+'">';
                    if( data.getTotalCollegeDataObj[key].caption == 'College Logo' ){
                        if( data.getTotalCollegeDataObj[key].galleryName != '' ){
                            HTML += '<div class="col-md-4 col-left-block-img" style="background-image: url(../gallery/'+data.getTotalCollegeDataObj[key].slug+'/'+data.getTotalCollegeDataObj[key].galleryName+');"></div>';
                        }else{
                            HTML += '<div class="col-md-4 col-left-block-img" style="background-image: url(../assets/images/no-college-logo.png);"></div>';
                        }
                    }else{
                        HTML += '<div class="col-md-4 col-left-block-img" style="background-image: url(../assets/images/no-college-logo.png);"></div>';
                    }                    
                HTML += '</a>';
                
                HTML += '<div class="col-md-8">';
                    HTML += '<em>'+data.getTotalCollegeDataObj[key].cityName+', '+data.getTotalCollegeDataObj[key].stateName+'</em>     ';
                    HTML += '<h6><a href="/college/'+data.getTotalCollegeDataObj[key].slug+'" title="'+data.getTotalCollegeDataObj[key].firstname+'">'+data.getTotalCollegeDataObj[key].firstname+'</a></h6>';
                    HTML += '<div class="row">';
                    //START
                    if( functionalareaID == '' || functionalareaID == null ){
                        HTML += '<div class="col-md-12 sky-form sky-form-no-block">';
                            HTML += '<h6>Available Streams : </h6>';
                            HTML += '<label class="select">';
                                HTML += '<select>';
                                    var functionalNameArray = data.getTotalCollegeDataObj[key].functionalareaName.split(',');
                                    $.each(functionalNameArray, function(key, value) {
                                        HTML += '<option disabled="" selected="">'+value+'</option>';
                                    });
                                HTML += '</select>';
                                HTML += '<i></i>';
                            HTML += '</label>';
                        HTML += '</div>';                        
                    }else if( functionalareaID != '' && degreeID == null && courseID == null ){
                         HTML += '<div class="col-md-12 sky-form sky-form-no-block">';
                            HTML += '<h6>Available Streams : </h6>';
                            HTML += '<label class="select">';
                                HTML += '<select>';
                                    var functionalNameArray = data.getTotalCollegeDataObj[key].functionalareaName.split(',');
                                    $.each(functionalNameArray, function(key, value) {
                                        HTML += '<option disabled="" selected="">'+value+'</option>';
                                    });
                                HTML += '</select>';
                                HTML += '<i></i>';
                            HTML += '</label>';
                        HTML += '</div>';
                    }else if( functionalareaID != '' && degreeID != '' && courseID == null ){
                         HTML += '<div class="col-md-12 sky-form sky-form-no-block">';
                            HTML += '<h6>Available Streams : </h6>';
                            HTML += '<label class="select">';
                                HTML += '<select>';
                                    var functionalNameArray = data.getTotalCollegeDataObj[key].functionalareaName.split(',');
                                    $.each(functionalNameArray, function(key, value) {
                                        HTML += '<option disabled="" selected="">'+value+'</option>';
                                    });
                                HTML += '</select>';
                                HTML += '<i></i>';
                            HTML += '</label>';
                        HTML += '</div>';
                    }else{
                        HTML += '<div class="col-md-12 sky-form sky-form-no-block">';
                            HTML += '<span class="pull-left"><a href="/college/detail-course/'+data.getTotalCollegeDataObj[key].collegemasterID+'/'+data.getTotalCollegeDataObj[key].slug+'" class="anchorTagText">'+data.getTotalCollegeDataObj[key].degreeName+' | '+data.getTotalCollegeDataObj[key].courseName+'</a></span>';
                            HTML += '<p class="clearBothNow hideDataAfterFilter">';
                                if (data.getTotalCollegeDataObj[key].seats <= 5 && data.getTotalCollegeDataObj[key].seats > '0') {
                                    HTML += '<span class="pull-left">Seats Available : '+data.getTotalCollegeDataObj[key].seats+'</span>';
                                }                                   
                                HTML += '<span class="pull-right text-right badge badge-sea rounded">Total fees (per year)<br>Rs. '+data.getTotalCollegeDataObj[key].fees+'</span>';
                            HTML += '</p>';
                        HTML += '</div>';
                    }
                    //END
                    HTML += '</div>';
                   /* if( functionalareaID == '' || functionalareaID == null ){
                        //NO FUNCTIONAL AREA DEFINED
                    }else{
                        HTML += '<p class="clearBothNow hideDataAfterFilter">';
                            HTML += '<span class="pull-left">Seats Available : '+data.getTotalCollegeDataObj[key].seats+'</span>';
                            HTML += '<span class="pull-right"><strong>Rs. '+data.getTotalCollegeDataObj[key].fees+'</strong></span>';
                        HTML += '</p>';
                    }*/
                    
                    HTML += '<p class="clearBothNow">';
                        if( data.getTotalCollegeDataObj[key].collegefacilitiesID != '' ){
                            HTML += '<p class="clearBothNow"><a href="javascript:void(0);" id="collegeAmenitiesView" class="'+data.getTotalCollegeDataObj[key].collegeprofileID+'">View College Amenities</a></p>';    
                        }        
                    HTML += '</p>';
                    HTML += '<p class="clearBothNow">';
                        HTML += '<span class="pull-right">';
                        HTML += '<a class="btn btn-sm btn-windows" href="/college/'+data.getTotalCollegeDataObj[key].slug+'">Query</a>';
                        if( data.getTotalCollegeDataObj[key].agreement == '1'){
                            HTML += ' <a class="btn btn-sm btn-windows" href="/college/'+data.getTotalCollegeDataObj[key].slug+'">Admission</a>'; 
                        }                        
                        HTML += '</span>';
                    HTML += '</p>';
                HTML += '</div>';
            HTML += '</div>';
        HTML += '</div>';
    });
    return HTML;        
}
