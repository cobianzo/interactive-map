Esta web se ha hecho

* Added php.ini para permitir subir archivos de más tamaño. Había varias modos de conseguirlo, no sé si es ese archivo el que hace que vaya.


* Basada en Whiteboard, limpiando elementos
* bootstrap usado. Me llevó un tiempo instalarlo, la compilación da error, pero al final va bien. Hay dos sass a compilar:
	- bootstrap.sass
	- style.sass
 Ambos usan _mapa-variables-mixins.scss
 
* Descargando el plugin jquery llamado mapplic, y adaptándolo a la web para crear sus elementos:
	- El JS q carga el jquery plugin (y todo el JS del proyecto) está directamente en el footer.php, no en archivos externos
	- Este plugin de jquery funciona leyendo un json. WP ha sido customizado para que cada vez que se salva un mapa o hotspot (q es el mismo custom type "mapa"), actualice el file "nombre-de-mapa.json" en la carpeta uploads.
	- Las funciones destinadas a controlar la creación de estos archivos están en una sección de functions.php
	- Se ha incluído incluso un botón "Create Json" para crear todos los json para todos los mapas
	- Creado un custom image size (mapa_hi) sólo para los mapas, de 3000x3000. 
	
* Los custom post types definidos en "functions.custom-pt.php"
* ACF empleado. Los campos de ACF guardados en "functions-acf-php"
* Los mapas están en los custom post types "mapa", si un mapa es hijo de otro mapa entonces es un hotspot, no un mapa, con diferentes ACF asociados.

* Instalado Polylang
	- Loco translation fue usado para las cadenas escritas en código, en el text domain "map". Su pot está en themes/map/languages y sus .mo y .po en wp-content/languages/themes
	
	
* Como funciona un hotspot en el mapa de Yucatán:
		- redireccionamiento
		- protección de un mapa
		
* la hotspot card (popup)
		- Muestra un carrusel standar de bootstrap, contenido y un antes/ahora, si procede. 
		- distribución del contenido depende de si hay redirección a mapa (se muestra en dos cols) o no (una col).
		
		
 * METODO DE TRABAJO:
	- Para importar la DB uso el plugin DB Manage. En el folder wp-content/backup-db están los backups. Cada vez que se importa la BD hay que actualizar la sección Database -> DB Options, dejar que el sistema calcule los campos "Path To mysqldump" y así, y 
		"Path To Backup" => /home2/radiofq1/public_html/maps/wp-content/backup-db
	