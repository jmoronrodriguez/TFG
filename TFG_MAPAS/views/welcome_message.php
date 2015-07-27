<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
	<?=js('jquery-2.1.3.min.js')?>
	
	<?=js('bootstrap.js')?>
	<?=js('jquery-ui.js')?>
	<?=css('bootstrap.min.css')?>
	<?=css('simple-sidebar.css')?>
	<?=css('jquery-ui.css')?>
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
	</style>
	
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
</head>
<body>
	<div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Start Bootstrap
                    </a>
                </li>
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li>
                    <a href="#">Shortcuts</a>
                </li>
                <li>
                    <a href="#">Overview</a>
                </li>
                <li>
                    <a href="#">Events</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <!--<div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Simple Sidebar</h1>
                        <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                        <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>
                        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
                    </div>
                </div>
            </div>
        </div>-->
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
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
	
</body>
</html>