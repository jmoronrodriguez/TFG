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
	<?=css('bootstrap-theme.css')?>
	<?=css('jquery-ui.css')?>
	
	
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
		new google.maps.LatLng(37.37648421358102,  -4.279837694064774),
		//superior derecha
		new google.maps.LatLng(38.53208740463818,  -2.432230840078577)
      
      );
	
  var mapOptions = {
    zoom: 8,
    center: newark
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
  var marker = new google.maps.Marker({
    position: newark,
    map: map,
	icon: image,
    title: 'Click to zoom'
  });
  historicalOverlay = new google.maps.GroundOverlay(
      '<?=asset_url();?>img/castillo_JAEN.png',
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

<nav class="navbar navbar-default" role="navigation">
  <!-- El logotipo y el icono que despliega el menú se agrupan
       para mostrarlos mejor en los dispositivos móviles -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse"
            data-target=".navbar-ex1-collapse">
      <span class="sr-only">Desplegar navegación</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">Logotipo</a>
  </div>
 
  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
       otro elemento que se pueda ocultar al minimizar la barra -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Enlace #1</a></li>
      <li><a href="#">Enlace #2</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Menú #1 <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="#">Acción #1</a></li>
          <li><a href="#">Acción #2</a></li>
          <li><a href="#">Acción #3</a></li>
          <li class="divider"></li>
          <li><a href="#">Acción #4</a></li>
          <li class="divider"></li>
          <li><a href="#">Acción #5</a></li>
        </ul>
      </li>
    </ul>
 
    <form class="navbar-form navbar-left" role="search">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Buscar">
      </div>
      <button type="submit" class="btn btn-default">Enviar</button>
    </form>
 
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#">Enlace #3</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Menú #2 <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="#">Acción #1</a></li>
          <li><a href="#">Acción #2</a></li>
          <li><a href="#">Acción #3</a></li>
          <li class="divider"></li>
          <li><a href="#">Acción #4</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>

</body>
</html>