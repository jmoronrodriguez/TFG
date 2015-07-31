<!doctype html>
<html lang="en">
  <head>
    <?=css('bootstrap.min.css')?>
	<?=css('simple-sidebar.css')?>
	<?=css('jquery-ui.css')?>
	<!--material desing-->
	<?=css('roboto.min.css')?>
	<?=css('material.min.css')?>
	<?=css('ripples.min.css')?>
	<?=css('estilos.css')?>
	<?=css('nouislider.min.css')?>
	
	
	<?=js('jquery-2.1.3.min.js')?>
	
	<?=js('bootstrap.js')?>
	<?=js('jquery-ui.js')?>	
	<?=js('jquery.ui.touch-punch.min.js')?>	
	<!--material desing-->
	<?=js('ripples.min.js')?>
	<?=js('material.min.js')?>
	<link rel="stylesheet" href="http://openlayers.org/en/v3.6.0/css/ol.css" type="text/css">
    <style>
      .map {
        height: 100%;
        width: 100%;
      }
    </style>
    <script src="http://openlayers.org/en/v3.6.0/build/ol.js" type="text/javascript"></script>
	<?=js('proj4.js')?>
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
	</style>
	<script>$('#widget').draggable();</script>
	<!--AÑADIMOS LA ETIQUETA META PARA QUE SE VEA BIEN EN LOS NAVEGADORES MOVILIES-->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
    <title>OpenLayers 3 example</title>
  </head>
  <body>
  <?php
$nombre_fichero= asset_url().'img/VISIBILIDAD CASTILLO JAEN4.png';
list($ancho, $alto, $tipo, $atributos) = getimagesize("./assets/img/VISIBILIDAD CASTILLO JAEN4.png");

$offsetX=97923.859554131;
$offsetY=378560.279617581;
$coorX=384198.17585;
$coorY=4263025.44553;
$maxCoorX=$coorX-$ancho*50;
$maxCoorY=$coorY-$alto*50;
?>
    <h2>My Map</h2>
<div id="mouse-position" class='custom-mouse-position'></div>
<div id="basicMap" class='map'></div>


    <script type="text/javascript">
	//DEFINIMOS LA PROYECCION ED50 USO 30N
	proj4.defs("EPSG:23030", "+proj=utm +zone=30 +ellps=intl"+
    " +towgs84=-131,-100.3,-163.4,-1.244,-0.020,-1.144,9.39 "+
    " +units=m +no_defs");
	var proje = ol.proj.get('EPSG:3857');
	//CREACION DE LOS MARKERT 
	//CONSULTAMOS MEDIANTE AJAX LA LISTA DE POIS
	var URL = "<?= site_url(array('adminPOI', 'get_poi_json')) ?>";
	var iconFeatures=[];
	var arrayCapasMapas=new ol.Collection();
	var vectorSource = new ol.source.Vector({
      //create empty vector
    })
	$.getJSON( URL)
	.done(function( data ) {
		$.each( data, function( i, item ) {
			var coordinates=[item.poi_X,item.poi_Y];
			var iconFeature = new ol.Feature({
			  geometry: new ol.geom.Point(coordinates),
			  name: item.poi_des,
			  population: 4000,
			  rainfall: 500
			});	
			//CREAMOS EL ARRAY DE iconFeatures			
			vectorSource.addFeature(iconFeature);
		});
	});
	
	
	
	var iconStyle = new ol.style.Style({
	  image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
		anchor: [1, 1],
		anchorXUnits: 'fraction',
		anchorYUnits: 'fraction',
		opacity: 1,
		src: '<?=asset_url();?>img/castle.png'//'http://ol3js.org/en/master/examples/data/icon.png'
	  }))
	});
	//CREAMOS LA CAPA DE MARKETS
	var marketsLayer = new ol.layer.Vector({
	  source: vectorSource,
	  style: iconStyle
	});
	
	
	
	//CREMOS LA BOUNDIND BOX DE LA IMAGEN [minX, minY, MaxX, MaxY] 
	var extent1 = [ <?= ($coorX)?>,<?= ($coorY)?>, <?= ($coorX+($ancho*50))?>, <?=($coorY-($alto*50))?> ];
	//CREAMOS LA CAPA
	var newLayer = new ol.layer.Image({
		  source: new ol.source.ImageStatic({
			url: '<?=asset_url();?>img/VISIBILIDAD CASTILLO JAEN4.png',
			imageExtent: ol.proj.transformExtent(extent1, 'EPSG:23030', 'EPSG:3857'),//Transformamos la BB de ED50 a WGS84 Web Mercator
			projection: proje
		  })
		});
		
		
		var layer2=new ol.layer.Tile({
      source: new ol.source.OSM()
    });
  var mousePositionControl = new ol.control.MousePosition({
  coordinateFormat: ol.coordinate.createStringXY(4),
  projection: proje,
  // comment the following two lines to have the mouse position
  // be placed within the map.
  className: 'custom-mouse-position',
  target: document.getElementById('mouse-position'),
  undefinedHTML: '&nbsp;'
});
      var map = new ol.Map({
 		  layers: [
			layer2,
			newLayer,
			marketsLayer
		  ],
		  target: 'basicMap',
		  controls: ol.control.defaults({
			attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
			  collapsible: false
			})
		  }).extend([mousePositionControl]),
		  view: new ol.View({
			projection: proje,//Utilizamos la proyeccion por defecto WGS84 Web Mercator UTM
			center: [-423014.1592, 4546636.6720],
			zoom: 7
		  })
		});
    </script>



  </body>