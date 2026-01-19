//Book Mark Ajax Calls

//Book mark home page blogs
$(document).on('click', '.featured-blog > div > .featuredCollegeBlock > .feature-strip-college-blogs > .blogBookMarkButton', function(){
	var blogName = $(this).find('input[name=blogName]').val();
	var url = $(this).find('input[name=blogURL]').val();
    var thisPointer = $(this);
	$.ajax({
        headers: {
          'X-CSRF-Token': $('input[name="_token"]').val()
        },
        method: "POST",
        url: "/student/add-bookmark",
        data: { blogName: blogName, url: url },
        dataType: "json",	            
        success: function(data) {
    		if(data.code == '200'){
                if( data.otherUser == '210' ){
                    $('.ajax-response-bookmarked-action').removeClass('hide');
                    $('.ajax-response-bookmarked-action > .bookmarkedMessage').html(data.message);
                    $.magnificPopup.open({
                        items: {src: '.ajax-response-bookmarked-action'},
                        type: 'inline'
                    }, 0);
                    
                }else{
                    $(thisPointer).addClass('bookmarkedHeartIcon');
                    $(thisPointer).removeClass('blogBookMarkButton');
                    $(thisPointer).append('<input type="hidden" name=bookmarkTableID value='+data.bookmarkedID+'>');

                    $(thisPointer).find('.bookmarkHeart').css('background', '#18BA98');
                    $(thisPointer).find('.bookmarkHeart').css('color', '#FFFFFF');    
                }
    		}else{
                setBlogBookmarkSession(blogName, url);
                getLoggedInStatus(blogName, url);    			
    		}
        }
    });
});

//Book mark home page colleges
$(document).on('click', '.featCollegeBookmark > ul > div > div > div > li > div > .featuredCollegeBlock > div >  .collegeBookMarkButton', function(){
    var collegeName = $(this).find('.collegeName').val();
    var url = $(this).find('input[name=collegeURL]').val();
    var thisPointer = $(this);
    $.ajax({
        headers: {
          'X-CSRF-Token': $('input[name="_token"]').val()
        },
        method: "POST",
        url: "/student/add-bookmark",
        data: { collegeProfile: collegeName, url: url },
        dataType: "json",               
        success: function(data) {
            if(data.code == '200'){
                if( data.otherUser == '210' ){
                    $('.ajax-response-bookmarked-action').removeClass('hide');
                    $('.ajax-response-bookmarked-action > .bookmarkedMessage').html(data.message);
                    $.magnificPopup.open({
                        items: {src: '.ajax-response-bookmarked-action'},
                        type: 'inline'
                    }, 0);
                    
                }else{
                    $(thisPointer).addClass('bookmarkedHeartIcon');
                    $(thisPointer).removeClass('collegeBookMarkButton');
                    $(thisPointer).append('<input type="hidden" name=bookmarkTableID value='+data.bookmarkedID+'>');

                    $(thisPointer).find('.bookmarkHeart').css('background', '#18BA98');
                    $(thisPointer).find('.bookmarkHeart').css('color', '#FFFFFF');    
                }
            }else{
                setCollegeBookmarkSession(collegeName, url);
                getLoggedInStatusCollegeHome(collegeName, url);         
            }
        }
    });
});

//BLOGS LISTING PAGE UNDER BLOG MENU
$(document).on('click', '.blog > div > h2 > span > .blogBookMarkButton', function(){
    var blogName = $(this).find('input[name=blogName]').val();
    var url = $(this).find('input[name=blogURL]').val();
    var thisPointer = $(this);
    $.ajax({
        headers: {
          'X-CSRF-Token': $('input[name="_token"]').val()
        },
        method: "POST",
        url: "/student/add-bookmark",
        data: { blogName: blogName, url: url },
        dataType: "json",               
        success: function(data) {
            if(data.code == '200'){
                if( data.otherUser == '210' ){
                    $('.ajax-response-bookmarked-action').removeClass('hide');
                    $('.ajax-response-bookmarked-action > .bookmarkedMessage').html(data.message);
                    $.magnificPopup.open({
                        items: {src: '.ajax-response-bookmarked-action'},
                        type: 'inline'
                    }, 0);
                    
                }else{
                    $(thisPointer).addClass('bookmarkedHeartIcon');
                    $(thisPointer).removeClass('blogBookMarkButton');
                    $(thisPointer).append('<input type="hidden" name=bookmarkTableID value='+data.bookmarkedID+'>');

                    $(thisPointer).find('.bookmarkHeart').css('background', '#18BA98');
                    $(thisPointer).find('.bookmarkHeart').css('color', '#FFFFFF');    
                }                
            }else{
                setBlogBookmarkSession(blogName, url);
                getLoggedInStatus(blogName, url);               
            }
        }
    });
});

//BLOGS LISTING PAGE UNDER BLOG MENU
$(document).on('click', '.news-v3 > .news-v3-in > .blogBookMarkButton', function(){
    var blogName = $(this).find('input[name=blogName]').val();
    var url = $(this).find('input[name=blogURL]').val();
    var thisPointer = $(this);
    $.ajax({
        headers: {
          'X-CSRF-Token': $('input[name="_token"]').val()
        },
        method: "POST",
        url: "/student/add-bookmark",
        data: { blogName: blogName, url: url },
        dataType: "json",               
        success: function(data) {
            if(data.code == '200'){
                if( data.otherUser == '210' ){
                    $('.ajax-response-bookmarked-action').removeClass('hide');
                    $('.ajax-response-bookmarked-action > .bookmarkedMessage').html(data.message);
                    $.magnificPopup.open({
                        items: {src: '.ajax-response-bookmarked-action'},
                        type: 'inline'
                    }, 0);
                    
                }else{
                    $(thisPointer).addClass('bookmarkedHeartIcon');
                    $(thisPointer).removeClass('blogBookMarkButton');
                    $(thisPointer).append('<input type="hidden" name=bookmarkTableID value='+data.bookmarkedID+'>');

                    $(thisPointer).find('.bookmarkHeart').css('background', '#18BA98');
                    $(thisPointer).find('.bookmarkHeart').css('color', '#FFFFFF');    
                } 
            }else{
                setBlogBookmarkSession(blogName, url);
                getLoggedInStatus(blogName, url);               
            }
        }
    });
});

//BOOKMARK FROM COLLEGE PUBLIC PROFILE
$(document).on('click', '.list-inline > li > .collegeBookMarkButton', function(){
    var collegeName = $(this).find('.collegeName').val();
    var url = $(this).find('input[name=collegeURL]').val();
    var thisPointer = $(this);
    $.ajax({
        headers: {
          'X-CSRF-Token': $('input[name="_token"]').val()
        },
        method: "POST",
        url: "/student/add-bookmark",
        data: { collegeProfile: collegeName, url: url },
        dataType: "json",               
        success: function(data) {
            if(data.code == '200'){
                if( data.otherUser == '210' ){
                    $('.ajax-response-bookmarked-action').removeClass('hide');
                    $('.ajax-response-bookmarked-action > .bookmarkedMessage').html(data.message);
                    $.magnificPopup.open({
                        items: {src: '.ajax-response-bookmarked-action'},
                        type: 'inline'
                    }, 0);
                    
                }else{
                    $(thisPointer).addClass('bookmarkedHeartIcon');
                    $(thisPointer).removeClass('collegeBookMarkButton');
                    $(thisPointer).append('<input type="hidden" name=bookmarkTableID value='+data.bookmarkedID+'>');

                    $(thisPointer).find('.bookmarkHeart').css('background', '#18BA98');
                    $(thisPointer).find('.bookmarkHeart').css('color', '#FFFFFF');    
                } 
            }else{
                setCollegeBookmarkSession(collegeName, url);
                getLoggedInStatusCollegeHome(collegeName, url);         
            }
        }
    });
});

//BOOKMARK FROM COURSE PROFILE
$(document).on('click', '.list-inline > li > .courseBookMarkButton', function(){
    var courseName = $(this).find('.courseName').val();
    var url = $(this).find('input[name=collegeURL]').val();
    var thisPointer = $(this);
    $.ajax({
        headers: {
          'X-CSRF-Token': $('input[name="_token"]').val()
        },
        method: "POST",
        url: "/student/add-bookmark",
        data: { courseName: courseName, url: url },
        dataType: "json",               
        success: function(data) {
            if(data.code == '200'){
                if( data.otherUser == '210' ){
                    $('.ajax-response-bookmarked-action').removeClass('hide');
                    $('.ajax-response-bookmarked-action > .bookmarkedMessage').html(data.message);
                    $.magnificPopup.open({
                        items: {src: '.ajax-response-bookmarked-action'},
                        type: 'inline'
                    }, 0);
                    
                }else{
                    $(thisPointer).addClass('bookmarkedHeartIcon');
                    $(thisPointer).removeClass('courseBookMarkButton');
                    $(thisPointer).append('<input type="hidden" name=bookmarkTableID value='+data.bookmarkedID+'>');
                    
                    $(thisPointer).find('.bookmarkHeart').css('background', '#18BA98');
                    $(thisPointer).find('.bookmarkHeart').css('color', '#FFFFFF');    
                } 
            }else{
                setCourseBookMarkSession(courseName, url);
                getLoggedInStatusCourseHome(courseName, url);         
            }
        }
    });
});

//Function
function getLoggedInStatus(blogName, url) {
    var HTML = '';
    HTML += '<input type="hidden" name="blogName" value="'+blogName+'">';
    HTML += '<input type="hidden" name="url" value="'+url+'">';
    
    $('#loginModal1').find('.ifNotLoggedInBlock').html(HTML);
    $('#loginModal1').modal({
        show: 'true'
    });
}

//LOGIN AJAX CALL FOR BLOGS
$( '.homeLoginPopupWindow1' ).submit(function(e) {
    $('.homeLoginPopupWindow1 .errorMessageBlock').addClass('hide');
    e.preventDefault();
    var form = $(this).serialize();
    var blogName = $('input[name=blogName]').val();
    
    $.ajax({
        type: "POST",
        url: '/ajax-do-login',
        data: form,
        success: function(data){
            if( data.code =='200' ){
                $('.homeLoginPopupWindow1').modal('hide');
                $.ajax({
                    headers: {
                      'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    method: "POST",
                    url: "/student/add-bookmark",
                    data: form,
                    dataType: "json",               
                    success: function(data) {
                        if(data.code == '200'){
                            window.location.reload();
                        }else{
                                     
                        }
                    }
                });
            }else if( data.code == '401' ){
                $('.homeLoginPopupWindow1 .errorMessageBlock').removeClass('hide');
                $('.homeLoginPopupWindow1 .errorMessage').html(data.response);
            }else if( data.code == '210' ){
                $('.homeLoginPopupWindow1 .errorMessageBlock').removeClass('hide');
                $('.homeLoginPopupWindow1 .errorMessage').html(data.response);
            }else if( data.code == '220' ){
                $('.homeLoginPopupWindow1 .errorMessageBlock').removeClass('hide');
                $('.homeLoginPopupWindow1 .errorMessage').html(data.response);
            }else{
                $('.homeLoginPopupWindow1 .errorMessageBlock').removeClass('hide');
                $('.homeLoginPopupWindow1 .errorMessage').html(data.response);
            }
        }
    }); 
});

function getLoggedInStatusCollegeHome(collegeName, url) {
    var HTML = '';
    HTML += '<input type="hidden" name="collegeProfile" value="'+collegeName+'">';
    HTML += '<input type="hidden" name="url" value="'+url+'">';
    
    $('#loginModal2').find('.ifNotLoggedInBlock').html(HTML);
    $('#loginModal2').modal({
        show: 'true'
    });
}

//LOGIN AJAX CALL FOR COLLEGES
$( '.homeLoginPopupWindow2' ).submit(function(e) {
    $('.homeLoginPopupWindow2 .errorMessageBlock').addClass('hide');
    e.preventDefault();
    var form = $(this).serialize();
    var collegeProfile = $('input[name=collegeProfile]').val();
    var url = $('input[name=url]').val();
    
    $.ajax({
        type: "POST",
        url: '/ajax-do-login',
        data: form,
        success: function(data){
            if( data.code =='200' ){
                $('.homeLoginPopupWindow2').modal('hide');
                $.ajax({
                    headers: {
                      'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    method: "POST",
                    url: "/student/add-bookmark",
                    data: form,
                    dataType: "json",               
                    success: function(data) {
                        if(data.code == '200'){
                            window.location.reload();
                        }else{
                                     
                        }
                    }
                });
            }else if( data.code == '401' ){
                $('.homeLoginPopupWindow2 .errorMessageBlock').removeClass('hide');
                $('.homeLoginPopupWindow2 .errorMessage').html(data.response);
            }else if( data.code == '210' ){
                $('.homeLoginPopupWindow2 .errorMessageBlock').removeClass('hide');
                $('.homeLoginPopupWindow2 .errorMessage').html(data.response);
            }else if( data.code == '220' ){
                $('.homeLoginPopupWindow2 .errorMessageBlock').removeClass('hide');
                $('.homeLoginPopupWindow2 .errorMessage').html(data.response);
            }else{
                $('.homeLoginPopupWindow2 .errorMessageBlock').removeClass('hide');
                $('.homeLoginPopupWindow2 .errorMessage').html(data.response);
            }
        }
    }); 
});

function getLoggedInStatusCourseHome(courseName, url) {
    var HTML = '';
    HTML += '<input type="hidden" name="courseName" value="'+courseName+'">';
    HTML += '<input type="hidden" name="url" value="'+url+'">';
    
    $('#loginModal3').find('.ifNotLoggedInBlock').html(HTML);
    $('#loginModal3').modal({
        show: 'true'
    });
}

//LOGIN AJAX CALL FOR Course
$( '.homeLoginPopupWindow3' ).submit(function(e) {
    $('.homeLoginPopupWindow3 .errorMessageBlock').addClass('hide');
    e.preventDefault();
    var form = $(this).serialize();
    var courseName = $('input[name=courseName]').val();
    var url = $('input[name=collegeURL]').val();
    
    $.ajax({
        type: "POST",
        url: '/ajax-do-login',
        data: form,
        success: function(data){
            if( data.code =='200' ){
                $('.homeLoginPopupWindow3').modal('hide');
                $.ajax({
                    headers: {
                      'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    method: "POST",
                    url: "/student/add-bookmark",
                    data: form,
                    dataType: "json",               
                    success: function(data) {
                        if(data.code == '200'){
                            window.location.reload();
                        }else{
                                     
                        }
                    }
                });
            }else if( data.code == '401' ){
                $('.homeLoginPopupWindow3 .errorMessageBlock').removeClass('hide');
                $('.homeLoginPopupWindow3 .errorMessage').html(data.response);
            }else if( data.code == '210' ){
                $('.homeLoginPopupWindow3 .errorMessageBlock').removeClass('hide');
                $('.homeLoginPopupWindow3 .errorMessage').html(data.response);
            }else if( data.code == '220' ){
                $('.homeLoginPopupWindow3 .errorMessageBlock').removeClass('hide');
                $('.homeLoginPopupWindow3 .errorMessage').html(data.response);
            }else{
                $('.homeLoginPopupWindow3 .errorMessageBlock').removeClass('hide');
                $('.homeLoginPopupWindow3 .errorMessage').html(data.response);
            }
        }
    }); 
});


// REMOVE BOOKMARK FROM TABLE ON CLICK OF ICON
// 1. Remove Blog Bookmark from webite/home/index.blade.php
$(document).on('click', '.featured-blog > div > .featuredCollegeBlock > .feature-strip-college-blogs > .bookmarkedHeartIcon', function(){
    var bookmarkTableID = $(this).find('input[name=bookmarkTableID]').val();
    removeBookmarkedIDFromTable(bookmarkTableID);
    window.location.reload;
});

// 1. Remove College Bookmark from webite/home/index.blade.php
$(document).on('click', '.featCollegeBookmark > ul > div > div > div > li > div > .featuredCollegeBlock > div >  .bookmarkedHeartIcon', function(){
    var bookmarkTableID = $(this).find('input[name=bookmarkTableID]').val();
    removeBookmarkedIDFromTable(bookmarkTableID);
    window.location.reload; 
});

// 2. Blogs Listing Page when click on blogs menu
$(document).on('click', '.blog > div > h2 > span > .bookmarkedHeartIcon', function(){
    var bookmarkTableID = $(this).find('input[name=bookmarkTableID]').val();
    removeBookmarkedIDFromTable(bookmarkTableID);
    window.location.reload; 
});

// 3. Blogs Detail Page
$(document).on('click', '.news-v3 > .news-v3-in > .bookmarkedHeartIcon', function(){
    var bookmarkTableID = $(this).find('input[name=bookmarkTableID]').val();
    removeBookmarkedIDFromTable(bookmarkTableID);
    window.location.reload;  
});

// 4. Bookmark College Profile
$(document).on('click', '.list-inline > li > .bookmarkedHeartIcon', function(){
    var bookmarkTableID = $(this).find('input[name=bookmarkTableID]').val();
    removeBookmarkedIDFromTable(bookmarkTableID);
    window.location.reload;  
});

// 4. Bookmark College Course
$(document).on('click', '.list-inline > li > .bookmarkedHeartIcon', function(){
    var bookmarkTableID = $(this).find('input[name=bookmarkTableID]').val();
    removeBookmarkedIDFromTable(bookmarkTableID);
    window.location.reload;  
});

function removeBookmarkedIDFromTable(bookmarkedID){
    $.ajax({
        headers: {
          'X-CSRF-Token': $('input[name="_token"]').val()
        },
        method: "POST",
        url: "/remove-selected-bookmarked",
        data: {bookmarkedID: bookmarkedID},
        dataType: "json",               
        success: function(data) {
            if(data.code == '200'){
                window.location.reload();
            }else{
                         
            }
        }
    });
    return true;
}


function setBlogBookmarkSession(blogName, url) {
    $.ajax({
        type: "POST",
        url: "/api/set/blog-bookmark",
        data: { blogName: blogName, url: url },
        success: function(data){
        },
        error: function(data){
        }
    });
}

function setCollegeBookmarkSession(collegeName, url) {
    $.ajax({
        type: "POST",
        url: "/api/set/college-bookmark",
        data: { collegeName: collegeName, url: url },
        success: function(data){
        },
        error: function(data){
        }
    });
}

function setCourseBookMarkSession(courseName, url) {
    $.ajax({
        type: "POST",
        url: "/api/set/course-bookmark",
        data: { courseName: courseName, url: url },
        success: function(data){
        },
        error: function(data){
        }
    });
}