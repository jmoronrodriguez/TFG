<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Admin</title>
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
        height: 50%;
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
		  min-width: 180px;
		}
	</style>
	<script>$('#widget').draggable();</script>
	<!--AÑADIMOS LA ETIQUETA META PARA QUE SE VEA BIEN EN LOS NAVEGADORES MOVILIES-->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	</head>
<body>	
	<?=js('nouislider.min.js')?>
	<!--NAV BAR Principal-->
	<div class="navbar navbar-material-light-green" style="border-radius: 0px; margin-bottom: 0px;">
        <div class="container" style="margin-left: 0px;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" id='menu-toggle' data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= site_url(array('admin', 'administracion')) ?>">TFG-Administracion</a>
            </div>
			<div class="navbar-collapse collapse">
                          
			</div>
                        <!--/.nav-collapse -->
        </div>
    </div>
	<!--NAV BAR MENU-->
	<div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
			 <ul class="sidebar-nav">
                <li class='active'>
                    <a href="<?= site_url(array('adminConfiguracion', 'get_configurations')) ?>">Configuraciones</a>
                </li>
                <li>
                    <a href="<?= site_url(array('adminBandos', 'get_bandos')) ?>">Bandos</a>
                </li>
				<li>
                    <a href="<?= site_url(array('adminTipoPOI', 'get_tipoPOIs')) ?>">Tipos POI's</a>
                </li>
                
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->