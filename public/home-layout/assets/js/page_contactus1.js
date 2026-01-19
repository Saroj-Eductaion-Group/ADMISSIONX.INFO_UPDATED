var ContactPage1 = function () {

    return {
        
    	//Basic Map
        initMap: function () {
			var map;
			$(document).ready(function(){
			  map = new GMaps({
				div: '#map1',
				scrollwheel: false,				
				lat: 19.1230155,
				lng: 72.8224506,
			  });
			  
			  var marker = map.addMarker({
				lat: 19.1230155,
				lng: 72.8224506,
	            title: 'Admssion X'
		       });
			});
        },

        //Panorama Map
        initPanorama: function () {
		    var panorama;
		    $(document).ready(function(){
		      panorama = GMaps.createPanorama({
		        el: '#panorama',
		        lat: 19.1230155,
				lng: 72.8224506,
		      });
		    });
		}        

    };
}();
