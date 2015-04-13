<?php 
	get_header();
?> 

<div class="container">
	
	<br><br>
	<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
		<div class='panel panel-default'>
			<div class='panel-heading'> 
				<h1><?php _e("Sin acceso"); ?></h1>
			</div>
			<div class="panel-body">
				<p>
					<?php _e("Lo siento, no puedes acceder a esta aplicación web sin la clave de acceso inicial facilitada en la url del folleto de la Editorial Verás" ); ?>				
				</p>
				<p>
					<?php _e("Revisa el código QR de tu material imprimido Verás para poder acceder a la web con credenciales de acceso" ); ?>				
				</p>
			</div>
		</div>
	</div>
</div>



<?php 
	get_footer(); 
?>
