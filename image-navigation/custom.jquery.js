$(document).on("ready", function(){		


	/* para que el plugin map funcione tiehe que tener una imagen y un <ul> con hotspots*/
	$('#map-container').initMap({
		
		
	});
				
});




(function($) {

	// jQuery plugin definition
	$.fn.initMap = function(params) {

		params = $.extend( {
			posX: 				0, 
			posY: 				0,  
		}, params);

		// traverse all nodes
		this.each(function() {
			
			var $t = $(this);
			var imgMapa	= $t.find('img').first(); 
			var hotSpots	= $t.find('ul').first(); 			/* TO_DO: permitir customizar la lista de hotspots */
			
			if ( imgMapa.length !== 1  )  
				{  alert('error in plugin to intialize Map. No e encuentra img del mapa o hay más de un mapa');   return; }

			var offset = imgMapa.offset();
	
			//set
			hotSpots.css({  "position" : "absolute"   }).offset({ top: offset.top, left: offset.left})
			
			
		
		});

		// allow jQuery chaining
		return this;
	};

})(jQuery);

