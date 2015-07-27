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
	<?=js('jquery-2.1.3.min.js')?>
	
	<?=js('bootstrap.js')?>
	<?=js('jquery-ui.js')?>	
	<?=js('jquery.ui.touch-punch.min.js')?>	
	<!--material desing-->
	<?=js('ripples.min.js')?>
	<?=js('material.min.js')?>
	
	
	
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
	</style>
	<script>$('#widget').draggable();</script>
	<script>
// This example uses a GroundOverlay to place an image on the map
// showing an antique map of Newark, NJ.

var historicalOverlay;
$( "#slider-range" ).slider({
      orientation: "vertical",
      range: true,
      values: [ 17, 67 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
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
	<div class="navbar navbar-inverse" >
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
	<!--NAV BAR MENU-->
	<div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
			<p style="margin-left: 20px;">
			  <label for="amount">Periodo de busqueda:</label>
			  <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
			</p>
            <div id="slider-range" style="height:50%; margin-left: 50px;"></div>
        </div>
        <!-- /#sidebar-wrapper -->

        
        <!-- /#page-content-wrapper -->
		 <div id="page-content-wrapper" style="height: 100%;">
            <div class="container-fluid">
                <div class="row">
                    <div id='div-map' class="col-lg-12"></div>
                </div>
            </div>
        </div>
    </div>
	
	<script>
	  $(function() {
		$( "#slider-range" ).slider({
		  orientation: "vertical",
		  range: true,
		  values: [ 17, 67 ],
		  slide: function( event, ui ) {
			$( "#amount" ).val( "" + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
		  }
		});
		$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
		  " - $" + $( "#slider-range" ).slider( "values", 1 ) );
	  });
	  </script>
	<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
	
</body>
</html>