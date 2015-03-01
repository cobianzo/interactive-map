$(document).on("ready", function(){		


	/* para que el plugin map funcione tiehe que tener una imagen y un <ul> con hotspots*/
	$('#map-container').initMap({
		
		
	});


	$(window).resize(function () { 
		$('#map-container').initMap({
		
		
		});	
	});
	
});





(function($) {

	/* definition of constants for all the plugin */

	/** ... */
	

	// jQuery plugin definition.   INIT
	//* ------------------------------------------------------------------------------------------------------------------------------------------------------
	//* ------------------------------------------------------------------------------------------------------------------------------------------------------
	
	
	
	$.fn.initMap = function(params) {

		/* par�metros a pasar a la funci�n del plugin  $(mielemento).initMap({  'posX' : 20,  etc...  });  */
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
				{  alert('error in plugin to intialize Map. No e encuentra img del mapa o hay m�s de un mapa');   return; }

			
			
			// here the code empieza: ponemos el contenedor de los hotspots en la misma posici�n de la imagen del mapa
			
			var offset = imgMapa.offset();
	
			//set
			hotSpots.css({  "position" : "absolute"   }).offset({ top: offset.top + params.posY, left: offset.left + params.posX})
		
		});
		//  Finito recorrer cada nodo
		
		
		
		// allow jQuery chaining
		return this;
	};
	//* ------------------------------------------------------------------------------------------------------------------------------------------------------
	//* ------------------------------------------------------------------------------------------------------------------------------------------------------	
	
	
})(jQuery);

