$.typeahead({
 input: ".js-typeahead-user_v2",
 minLength: 3,
 maxItem: 1500,
 //limit: Infinity,
 hint: !0,
 group: {
  template: "{{group}}"
 },
 maxItemPerGroup: null,
 searchOnFocus: !0,
 order: "asc",
 dynamic: !0,
 delay: 500,
 backdrop: {
  "background-color": "#fff"
 },
 template: function(a, t) {
  return '<span class="row"><span class="drugname text-capitalize">{{query}}</span></span>'
 },
 emptyTemplate: '<a href="/search?q={{query}}" style="cursor: pointer;">No results were found in this list for "{{query}}", please "Click here" or "Press enter button" so that we can get the result from some other process.</a>',
 source: {
  College: {
   display: "collegename",
   href: "{{collegeUrl}}",
   ajax: [{
    type: "GET",
    url: "/api/home-page-search-list",
    data: {
     q: "{{query}}"
    }
   }, "data.college"],
   template: '<div class="">{{collegelogo}} {{collegename}} ({{collegeplace}})<br class="hidden-sm hidden-md hidden-lg"></div>'
  },
  University: {
   display: "universityname",
   href: "{{universityurl}}",
   ajax: [{
    type: "GET",
    url: "/api/home-page-search-list",
    data: {
     q: "{{query}}"
    }
   }, "data.university"],
   template: '<div class="">{{logo}} {{universityname}} <span class="pull-right">University</span></div>'
  },
  Examination: {
   display: "name",
   href: "{{examUrl}}",
   ajax: [{
    type: "GET",
    url: "/api/home-page-search-list",
    data: {
     q: "{{query}}"
    }
   }, "data.examination"],
   template: '<div class="padding-top10 padding-bottom10">{{name}} <span class="pull-right">Examination</span></div>'
  },
  "Popular Career Courses": {
   display: "title",
   href: "{{careerCoursesUrl}}",
   ajax: [{
    type: "GET",
    url: "/api/home-page-search-list",
    data: {
     q: "{{query}}"
    }
   }, "data.popularCareer"],
   template: '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12 padding-top10 padding-bottom10">{{title}}</div></div>'
  },
  "Stream": {
   display: "name",
   href: "{{funcationalAreaUrl}}",
   ajax: [{
    type: "GET",
    url: "/api/home-page-search-list",
    data: {
     q: "{{query}}"
    }
   }, "data.functionalarea"],
   template: '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12 padding-top10 padding-bottom10">{{name}}</div></div>'
  },
  "Degree": {
   display: "name",
   href: "{{degreeUrl}}",
   ajax: [{
    type: "GET",
    url: "/api/home-page-search-list",
    data: {
     q: "{{query}}"
    }
   }, "data.degree"],
   template: '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12 padding-top10 padding-bottom10">{{name}}</div></div>'
  },
  "Courses": {
   display: "name",
   href: "{{coursesUrl}}",
   ajax: [{
    type: "GET",
    url: "/api/home-page-search-list",
    data: {
     q: "{{query}}"
    }
   }, "data.courses"],
   template: '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12 padding-top10 padding-bottom10">{{name}}</div></div>'
  },
  "Blogs": {
   display: "topic",
   href: "{{blogUrl}}",
   ajax: [{
    type: "GET",
    url: "/api/home-page-search-list",
    data: {
     q: "{{query}}"
    }
   }, "data.blogs"],
   template: '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12 padding-top10 padding-bottom10">{{topic}}</div></div>'
  },
  "News": {
   display: "topic",
   href: "{{newsUrl}}",
   ajax: [{
    type: "GET",
    url: "/api/home-page-search-list",
    data: {
     q: "{{query}}"
    }
   }, "data.news"],
   template: '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12 padding-top10 padding-bottom10">{{topic}}</div></div>'
  },
  "Questions": {
   display: "question",
   href: "{{askPageUrl}}",
   ajax: [{
    type: "GET",
    url: "/api/home-page-search-list",
    data: {
     q: "{{query}}"
    }
   }, "data.question"],
   template: '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12 padding-top10 padding-bottom10">{{question}}</div></div>'
  },
  "Country": {
   display: "countryname",
   href: "{{countryCollegePageUrl}}",
   ajax: [{
    type: "GET",
    url: "/api/home-page-search-list",
    data: {
     q: "{{query}}"
    }
   }, "data.resultCountry"],
   template: '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12 padding-top10 padding-bottom10">{{countryname}} Colleges</div></div>'
  },
  "State": {
   display: "statename",
   href: "{{stateCollegePageUrl}}",
   ajax: [{
    type: "GET",
    url: "/api/home-page-search-list",
    data: {
     q: "{{query}}"
    }
   }, "data.resultState"],
   template: '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12 padding-top10 padding-bottom10">{{statename}} Colleges</div></div>'
  },
  "City": {
   display: "cityname",
   href: "{{cityCollegePageUrl}}",
   ajax: [{
    type: "GET",
    url: "/api/home-page-search-list",
    data: {
     q: "{{query}}"
    }
   }, "data.resultCity"],
   template: '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12 padding-top10 padding-bottom10">{{cityname}} Colleges</div></div>'
  },
 },
 callback: {
  onClick: function(a, t, e, s) {},
  onSendRequest: function(a, t) {},
  onReceiveRequest: function(a, t) {},
  onResult: function(a, t, e, s) {
   var i = "";
   "" !== t && (i = s + ' elements matching "' + t + '"'), $(".js-result-container").text(i)
  }
 },
 debug: !0
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