var ContactPage = function () {

    return {
        
    	//Basic Map
        initMap: function () {
			var map;
			$(document).ready(function(){
			  map = new GMaps({
				div: '#map',
				scrollwheel: false,				
				lat: 28.569226,
				lng: 77.2393805,
			  });
			  
			  var marker = map.addMarker({
				lat: 28.569226,
				lng: 77.2393805,
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
		        lat: 28.569226,
				lng: 77.2393805,
		      });
		    });
		}        

    };
}();