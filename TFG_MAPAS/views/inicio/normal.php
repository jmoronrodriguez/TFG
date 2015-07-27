<script>
// This example uses a GroundOverlay to place an image on the map
// showing an antique map of Newark, NJ.
  <?php
$nombre_fichero= asset_url().'img/VISIBILIDAD CASTILLO JAEN4.png';
list($ancho, $alto, $tipo, $atributos) = getimagesize("./assets/img/VISIBILIDAD CASTILLO JAEN4.png");
 // Ejemplo aprenderaprogramar.com
// Iremos leyendo línea a línea del fichero.txt hasta llegar al fin (feof($fp))
// fichero.txt tienen que estar en la misma carpeta que el fichero php
// fichero.txt es un archivo de texto normal creado con notepad, por ejemplo.
$fp = fopen("assets/img/VISIBILIDAD CASTILLO JAEN4.pgw", "r");
$lineas;
$i=0;
while(!feof($fp)) {
	$lineas[$i] = fgets($fp);
	$i=$i+1;
}
fclose($fp);
$infIzqX=$lineas[4];
$infIzqY=$lineas[5]+($alto*$lineas[3]);
$supDerchX=$lineas[4]+($ancho*$lineas[0]);
$supDerchY=$lineas[5];
?>
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
	</head>
	<body>
	<!--NAV BAR Principal-->
	<div class="navbar" style="margin-bottom: 0px; ">
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
        <div id="sidebar-wrapper">
			<p style="margin-left: 20px;">
			  <label for="amount">Periodo de busqueda:</label>
			  <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
			</p>
            <div id="slider-range"  style="height:50%; margin-left: 50px; margin-top: 10px;"></div>
			
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
	start: [ 200, 800 ],
	step: 50,
	margin: 20,
	connect: true,
	direction: 'rtl',
	orientation: 'vertical',
	
	// Configure tapping, or make the selected range dragable.
	behaviour: 'drag',
	
	// Full number format support.
	format: wNumb({
		mark: ',',
		decimals: 1
	}),
	
	// Support for non-linear ranges by adding intervals.
	range: {
		'min': -400,
		'max': 700
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