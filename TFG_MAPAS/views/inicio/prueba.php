<!DOCTYPE html>
<html lang="es">

    <head>
	<meta charset="utf-8">
	<title>Admin</title>
	<?=css('bootstrap.min.css')?>
	<?=css('sb-admin-2.css')?>
	<?=css('jquery-ui.css')?>
	<!--material desing-->
	<?=css('roboto.min.css')?>
	<?=css('material.min.css')?>
	<?=css('ripples.min.css')?>
	<?=css('estilos.css')?>
	<?=css('nouislider.min.css')?>
	<?=css('bootstrap-colorpicker.css')?>
	
	
	<?=js('jquery-2.1.3.min.js')?>
	
	<?=js('bootstrap.js')?>
	<?=js('jquery-ui.js')?>	
	<?=js('jquery.ui.touch-punch.min.js')?>	
	<!--material desing-->
	<?=js('ripples.min.js')?>
	<?=js('material.min.js')?>
	<?=js('bootstrap-colorpicker.js')?>
	<?=js('metisMenu.min.js')?>
	<?=js('sb-admin-2.js')?>	
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
		.colorDiv{
			height: 100%;
			width: 100px;
		}
		.leyendaControl {
		  top: 65px;
		  left: .5em;
		}
		.buttonDeselec {
		  background: #FFFFFF !important;
		  border: thin solid;
		}
	</style>
	<script>$('#widget').draggable();</script>
	<!--AÑADIMOS LA ETIQUETA META PARA QUE SE VEA BIEN EN LOS NAVEGADORES MOVILIES-->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
	</head>


<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top navbar-material-light-green" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">SB Admin v2.0</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a href="bootstrap-elements.html" data-target="#" class="dropdown-toggle navbar-brand" data-toggle="dropdown">
					<i class="mdi-social-person"></i><b class="caret"></b>
					</a>
                    <ul class="dropdown-menu ">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default navbar-material-light-green sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?= site_url(array('adminPOI', 'nuevo')) ?>">POI's</a>
                        </li>
                        
                        <li>
                            <a href="<?= site_url(array('adminBandos', 'get_bandos')) ?>">Bandos</a>
                        </li>
						<li>
                            <a href="<?= site_url(array('adminTipoPOI', 'get_tipoPOIs')) ?>">Tipos POI's</a>
                        </li>
						<li>
                            <a href="<?= site_url(array('adminConfiguracion', 'get_configurations')) ?>">Configuraciones</a>
                        </li>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

<!------------------------------ Page Content -------------------------------------------------------------------->
        <div id="page-wrapper" style="overflow: auto;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Admin Index</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
				<div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="mdi-maps-map mdi-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">&nbsp;</div>
                                    <div>POI's</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ir a...</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
				<div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="mdi-maps-pin-drop mdi-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">&nbsp;</div>
                                    <div>Tipos de POI</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ir a...</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
				<div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="mdi-image-assistant-photo mdi-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">&nbsp;</div>
                                    <div>Culturas</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ir a...</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
				<div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="mdi-action-settings mdi-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">&nbsp;</div>
                                    <div>Configuraciones</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ir a...</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                
                
                
            </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    

</body>

</html>
