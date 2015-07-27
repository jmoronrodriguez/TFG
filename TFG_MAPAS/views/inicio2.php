<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
	<?=css('bootstrap.min.css')?>
	<?=css('simple-sidebar.css')?>
	<?=css('jquery-ui.css')?>
	<!--material desing-->
	<?=css('roboto.min.css')?>
	<?=css('material.min.css')?>
	<?=css('ripples.min.css')?>
	<?=css('jquery.nouislider.min.css')?>
	
	
	
	<?=js('jquery-2.1.3.min.js')?>
	
	<?=js('bootstrap.js')?>
	<?=js('jquery-ui.js')?>	
	<?=js('jquery.ui.touch-punch.min.js')?>	
	<!--material desing-->
	<?=js('ripples.min.js')?>
	<?=js('material.min.js')?>
	<?=js('jquery.nouislider.all.min.js')?>
	
	
	<style>
		#page-content-wrapper {
			height: 100%;
			overflow-y: auto;
			position: fixed;
			transition: all 0.5s ease 0s;
			z-index: 1000;
		}
		.container-fluid{
			height: 100%;
		}
		.row{
			height: 100%;
		}
		#div-map{
			height: 100%;
		}
		html { overflow:hidden; }
		.noUi-handle.noUi-active {
			transform: scale3d(1, 1, 1);
		}
		.noUi-vertical .noUi-handle {
			cursor: ns-resize;
			margin-left: 0;
		}
		.noUi-marker-vertical.noUi-marker {
			height: 2px;
			margin-top: -1px;
			width: 5px;
		}
		.noUi-marker {
			background: #ccc none repeat scroll 0 0;
			position: absolute;
		}
				
		.noUi-pips-vertical {
			height: 100%;
			left: 100%;
			padding: 0 10px;
			top: 0;
		}
		.noUi-pips {
			color: #999;
			font: 400 12px Arial;
			position: absolute;
		}
		.noUi-pips, .noUi-pips * {
			box-sizing: border-box;
		}
		noUi-value-vertical {
			margin-left: 20px;
			margin-top: -5px;
			width: 15px;
		}
		.noUi-value-sub {
			color: #ccc;
			font-size: 10px;
		}
		.noUi-value {
			position: absolute;
			text-align: center;
			width: 40px;
		}
		.noUi-value-sub {
			color: #ccc;
			font-size: 10px;
		}
		.noUi-marker-vertical.noUi-marker {
			height: 2px;
			margin-top: -1px;
			width: 5px;
		}
		.noUi-marker-vertical.noUi-marker-sub {
			width: 10px;
		}
		.noUi-marker-vertical.noUi-marker-large {
			width: 15px;
		}
		.noUi-connect {
			background: #3fb8af none repeat scroll 0 0;
			box-shadow: 0 0 3px rgba(51, 51, 51, 0.45) inset;
			transition: background 450ms ease 0s;
		}
	</style>
	<script>$('#widget').draggable();</script>
	<script>
// This example uses a GroundOverlay to place an image on the map
// showing an antique map of Newark, NJ.

var historicalOverlay;
function initialize() {
  var image='<?=asset_url();?>img/castle.png'
  var newark = new google.maps.LatLng(37.767369, -3.799976);
  var imageBounds = new google.maps.LatLngBounds(
		//inferior izquierda
		//4 16 44.4441 W 37 22 34.0911 N
		
		new google.maps.LatLng(37.37613642,  -4.27901225),
		//superior derecha
		//2 25 53.2943 W 38 32 0.5946 N
		new google.maps.LatLng(39.12793333,  -2.431470639)
      
      );
	
  var mapOptions = {
    zoom: 8,
    center: newark
  };

  var map = new google.maps.Map(document.getElementById('div-map'),
      mapOptions);
  var marker = new google.maps.Marker({
    position: newark,
    map: map,
	icon: image,
    title: 'Click to zoom'
  });
  historicalOverlay = new google.maps.GroundOverlay(
      '<?=asset_url();?>img/VISIBILIDAD CASTILLO JAEN4.png',
      imageBounds);
  historicalOverlay.setMap(map);
  
  google.maps.event.addListener(marker, 'click', function() {
	if (historicalOverlay.getOpacity()==1)
		historicalOverlay.setOpacity(0);
	else
		historicalOverlay.setOpacity(1);
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
	<script>
            $(document).ready(function() {
                // This command is used to initialize some elements and make them work properly
                $.material.init();
            });
        </script>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

</head>
<body>
	<!--NAV BAR Principal-->
	<div class="navbar navbar-inverse" style="margin-bottom: 0px; ">
                    <div class="container" style="margin-left: 0px;">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" id='menu-toggle' data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">TFG</a>
                        </div>
                        <div class="navbar-collapse collapse">
                           
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
	<div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper" style="background-color: #3f51b5; ">
			<p style="margin-left: 20px;">
			  <label for="amount">Periodo de busqueda:</label>
			  <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
			</p>
            <div id="slider-range"  style="height:50%; margin-left: 50px;"></div>
        </div>
        <!-- /#sidebar-wrapper -->

        
        <!-- /#page-content-wrapper -->
		 <div id="page-content-wrapper" style="height: 100%; padding: 2px;">
            <div class="container-fluid">
                <div class="row">
                    <div id='div-map' class="col-lg-12"></div>
                </div>
            </div>
        </div>
    </div>
	
	
	<script>
	$('#slider-range').noUiSlider({
	start: [ 20, 80 ],
	step: 10,
	margin: 20,
	connect: true,
	direction: 'rtl',
	orientation: 'vertical',
	
	// Configure tapping, or make the selected range dragable.
	behaviour: 'tap-drag',
	
	// Full number format support.
	format: wNumb({
		mark: ',',
		decimals: 1
	}),
	
	// Support for non-linear ranges by adding intervals.
	range: {
		'min': 0,
		'max': 100
	}
	});
	$('#slider-range').noUiSlider_pips({
	mode: 'steps',
	density: 2
});
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
	
</body>
</html>
