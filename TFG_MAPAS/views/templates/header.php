<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Mapas Visibilidad Total</title>
	<?=css('bootstrap.min.css')?>
	<?=css('simple-sidebar.css')?>
	<?=css('jquery-ui.css')?>
	<!--material desing-->
	<?=css('roboto.min.css')?>
	<?=css('material.min.css')?>
	<?=css('ripples.min.css')?>
	<?=css('estilos.css')?>
	<?=css('nouislider.min.css')?>
	
	
	<?=js('jquery-2.1.3.min.js')?>
	
	<?=js('bootstrap.js')?>
	<?=js('jquery-ui.js')?>	
	<?=js('jquery.ui.touch-punch.min.js')?>	
	<!--material desing-->
	<?=js('ripples.min.js')?>
	<?=js('material.min.js')?>
	<link rel="stylesheet" href="http://openlayers.org/en/v3.6.0/css/ol.css" type="text/css">
    <style>
      .map {
        height: 100%;
        width: 100%;
      }
    </style>
    <script src="http://openlayers.org/en/v3.6.0/build/ol.js" type="text/javascript"></script>
	<?=js('proj4.js')?>
	<style>
		.adminMenu lu{ withd:75%}
		.adminMenu li {
			background: #00ff00 none repeat scroll 0 0;
			border: 3px solid #555;
			display: inline-block;
			height: 100px;
			margin: 10px;
			width: 100px;
			text-decoration: none;
		}
		.popover-content {
		  min-width: 200px;
		}
	</style>
	<script>$('#widget').draggable();</script>
	<!--AÑADIMOS LA ETIQUETA META PARA QUE SE VEA BIEN EN LOS NAVEGADORES MOVILIES-->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	
	</head>
	<body>
	<?=js('nouislider.min.js')?>