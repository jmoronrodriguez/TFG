
<?php 
			//Creamos el objeto imagen, como son png uilizamos esta funcion
			$im = imagecreatefrompng("./assets/img/VISIBILIDAD CASTILLO JAEN4.png"); 
			
			//Se ponen estas dos lineas para conservar las transparecinas de la imagen.
			imagealphablending($im, true);
			imagesavealpha($im, true);
			$color=imagecolorat($im, 0,0);
			$ancho=imagesx($im); //devuelve el ancho de la imagen
			$alto=imagesy($im); //devuelve el alto de la imagen
			echo $color;
			$rojo = imagecolorallocate($im,255,100,0);
			for ($i=0; $i<$ancho; $i++){
				for ($j=0; $j<$alto; $j++){
					if (imagecolorat($im, $i,$j)!=$color){
						imagesetpixel ( $im ,$i , $j , $rojo );
					}
				}
			}
			//header('Content-Type: image/png');
			imagepng($im, "./assets/img/VISIBILIDAD CASTILLO JAEN5.png");
			
		?>

<html>
<head>
	<title>Pruebas Imagenes</title>
	
</head>

<body>
	<img src='<?=asset_url();?>img/VISIBILIDAD CASTILLO JAEN5.png' />
</body>

</html>