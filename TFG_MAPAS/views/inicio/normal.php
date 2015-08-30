
<div class="navbar navbar-material-light-green" style="margin-bottom: 0px;">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-warning-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">TFG</a>
    </div>
    <div class="navbar-collapse collapse navbar-warning-collapse">
        <ul class="nav navbar-nav navbar-right">
            <li><a href="<?= site_url(array('admin')) ?>"><i class="mdi-social-person"></i>Administración</a></li>
        </ul>
    </div>
</div>

<div id='basicMap' ></div>
<div style="display: none;">
    <div id="popup" title="Coordenadas">

    </div>
</div>
<div class="modal fade bs-example-modal-sm" id="leyenda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document" id='contentLeyenda'>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="titleConfirm">Leyenda</h4>
            </div>
            <div class="modal-body" id='bodyConfirm'>


            </div>
            <div class="modal-footer">


            </div>
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-lg" id="leyendaRango" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document" id='contentLeyendaRango'>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="title">Leyenda Rango</h4>
            </div>
            <div class="modal-body" id='bodyConfirm'>
                <div class="container-fluid">
                    <div class='row'>
                        <div class='col-xs-3 '><label id='minEdad'>0000</label></div>
                        <div class='col-xs-6 '>&nbsp;</div>
                        <div class='col-xs-3 ' style='text-align: right;'><label id='maxEdad' >0000</label></div>
                        <input type='hidden' id='MaxEdad' value='0'/><input type='hidden' id='MinEdad' value='0'/>
                    </div>
                    <div class='row'>
                        <div class='col-md-12' style='text-align: center;'><div id='sliderLeyenda'></div></div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">


            </div>

        </div>
    </div>
</div>

<?= js('TFG/inicio/normal.js') ?>
	


