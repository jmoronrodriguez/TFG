<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="utf-8">
        <title>Administraci&oacute;n</title>
        <?= css('bootstrap.min.css') ?>
        <?= css('sb-admin-2.css') ?>

        <!--material desing-->
        <?= css('roboto.min.css') ?>
        <?= css('material.min.css') ?>
        <?= css('ripples.min.css') ?>
        <?= css('estilos.css') ?>
        <?= css('nouislider.min.css') ?>
        <?= css('bootstrap-colorpicker.css') ?>


        <?= js('jquery-2.1.3.min.js') ?>

        <?= js('bootstrap.js') ?>

        <!--material desing-->
        <?= js('ripples.min.js') ?>
        <?= js('material.min.js') ?>
        <?= js('bootstrap-colorpicker.js') ?>
        <?= js('metisMenu.min.js') ?>
        <?= js('sb-admin-2.js') ?>	
        <link rel="stylesheet" href="http://openlayers.org/en/v3.6.0/css/ol.css" type="text/css">
        <style>
            .map {
                height: 100%;
                width: 100%;
            }
        </style>
        <script src="http://openlayers.org/en/v3.6.0/build/ol.js" type="text/javascript"></script>
        <?= js('proj4.js') ?>
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
            .popover-title {
                color: #000;
            }
        </style>
        <script>$('#widget').draggable();</script>
        <!--AÑADIMOS LA ETIQUETA META PARA QUE SE VEA BIEN EN LOS NAVEGADORES MOVILIES-->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    </head>
    <body>	
        <?= js('nouislider.min.js') ?>
        <!--NAV BAR Principal-->
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
                    <a class="navbar-brand" href="<?= site_url(array('admin')) ?>">TFG ADMIN</a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a href="bootstrap-elements.html" data-target="#" class="dropdown-toggle navbar-brand" data-toggle="dropdown">
                            <i class="mdi-social-person"></i><b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu ">

                            <li><a href="<?= site_url(array('admin', 'cambiarUsuario')) ?>"><i class="mdi-action-perm-identity"></i> Configuraci&oacute;n</a>
                            </li>
                            <li><a href="<?= site_url(array('admin', 'logout')) ?>"><i class="mdi-action-settings-power"></i> Logout</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="<?= site_url() ?>"><i class="mdi-maps-layers"></i>Inicio</a>
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
                                <a href="<?= site_url(array('adminPOI', 'nuevo')) ?>"><i class="mdi-maps-map mdi-fw"></i>POI's</a>
                            </li>

                            <li>
                                <a href="<?= site_url(array('adminTipoPOI', 'get_tipoPOIs')) ?>"><i class="mdi-maps-pin-drop"></i>Tipos POI's</a>
                            </li>
                            <li>
                                <a href="<?= site_url(array('adminBandos', 'get_bandos')) ?>"><i class="mdi-image-assistant-photo"></i>Culturas</a>
                            </li>
                            <li>
                                <a href="<?= site_url(array('adminConfiguracion', 'get_configurations')) ?>"><i class="mdi-action-settings"></i>Configuraciones</a>
                            </li>

                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>