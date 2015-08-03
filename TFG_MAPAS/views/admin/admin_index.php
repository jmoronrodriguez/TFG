
	<div id="page-content-wrapper" style="height: 100%;">
            <div class="container-fluid">
				<div class="row">
				
					<ul class='adminMenu'>
						<li> <a href="<?= site_url(array('adminPOI', 'nuevo')) ?>"><img src="<?=asset_url();?>icons/POI MAP.svg" width='95px' height=' 95px'/></a></li>
						<li> <a href="<?= site_url(array('adminConfiguracion', 'get_configurations')) ?>"><img src="<?=asset_url();?>icons/configure.svg" width='95px' height=' 95px'/></a> </li>
						
					</ul>
				</div>
				
				<div class="row">
					<ul class='adminMenu'>
						<li> <a href="<?= site_url(array('adminTipoPOI', 'get_tipoPOIs')) ?>"><img src="<?=asset_url();?>icons/POI MAP.svg" width='95px' height=' 95px'/></a> </li>
						<li> <a href="<?= site_url(array('adminBandos', 'get_bandos')) ?>"><img src="<?=asset_url();?>icons/POI MAP.svg" width='95px' height=' 95px'/></a></li>
					</ul>
				</div>
			</div>
	</div>
</div>

<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>