
	<!--NAV BAR Principal-->
	<div class="navbar navbar-material-light-green" style="border-radius: 0px; margin-bottom: 0px; background: #8bc34a">
        <div class="container" style="margin-left: 0px;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" id='menu-toggle' data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= site_url(array('inicio', 'index')) ?>">TFG</a>
            </div>
			<div class="navbar-collapse collapse">
                          
			</div>
                        <!--/.nav-collapse -->
        </div>
    </div>
	<!--<div id="wrapper">

        <!-- Sidebar -->
		<!--<div id="sidebar-wrapper">
			<div class="row">
				<div class="col-md-12">
					Rango: <span id='minEdad'>10</span> - <span id='maxEdad'>100</span>
				</div>
			</div>
			 <div class="row">
				<div class="col-md-12">
					<div id='slider-range' style="height: 80%; color:#000"></div>
				</div>
			</div>
        </div>
        <!-- /#sidebar-wrapper -->

        
        <!-- /#page-content-wrapper -->
		 <!--<div id="page-content-wrapper" style="height: 100%; padding: 2px;">
            <div class="container-fluid">
                <div class="row">
                    <div id='basicMap' class="col-lg-12"></div>
                </div>
            </div>
        </div>
    </div> -->
	<div id='basicMap' ></div>
	<div style="display: none;">
	  <div id="popup" title="Coordenadas">
		
	  </div>
	</div>
	<div class="modal fade bs-example-modal-sm" id="confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-sm" role="document">
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
					<h4 class="modal-title" id="title">Leyenda</h4>
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
	<script>
		/*var softSlider = document.getElementById('PopupSlider');

		noUiSlider.create(softSlider, {
			start: 50,
			range: {
				min: 0,
				max: 100
			}
		});*/
	</script>
	<?=js('TFG/inicio/normal.js')?>
	
	
	
   