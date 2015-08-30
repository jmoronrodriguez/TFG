<div id="page-wrapper" style="overflow: auto;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Panel de Administraci&oacute;n</h1>
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
                    <a href="<?= site_url(array('adminPOI', 'nuevo')) ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Ir a...</span>
                            <span class="pull-right"><i class="mdi-navigation-arrow-forward"></i></span>
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
                    <a href="<?= site_url(array('adminTipoPOI', 'get_tipoPOIs')) ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Ir a...</span>
                            <span class="pull-right"><i class="mdi-navigation-arrow-forward"></i></span>
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
                    <a href="<?= site_url(array('adminBandos', 'get_bandos')) ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Ir a...</span>
                            <span class="pull-right"><i class="mdi-navigation-arrow-forward"></i></span>
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
                    <a href="<?= site_url(array('adminConfiguracion', 'get_configurations')) ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Ir a...</span>
                            <span class="pull-right"><i class="mdi-navigation-arrow-forward"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>



        </div>
    </div>
    <!-- /.container-fluid -->
</div>
</div>