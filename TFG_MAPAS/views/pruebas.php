<!doctype html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="http://openlayers.org/en/v3.6.0/css/ol.css" type="text/css">
    <style>
      .map {
        height: 100%;
        width: 100%;
      }
    </style>
    <script src="http://openlayers.org/en/v3.6.0/build/ol.js" type="text/javascript"></script>
	<?=js('proj4.js')?>
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
	var image = new ol.style.Circle({
	  radius: 3,
	  fill: null,
	  stroke: new ol.style.Stroke({color: 'red', width: 1})
	});

	var styles = {
	  'Point': [new ol.style.Style({
		image: image
	 })]
	 };
	var styleFunction = function(feature, resolution) {
		return styles[feature.getGeometry().getType()];
	};

	var geojsonObject = {
	  'type': 'FeatureCollection',
	  'crs': {
		'type': 'name',
		'properties': {
		  'name': 'EPSG:3857'
		}
	  },
	  'features': [
		{
		  'type': 'Feature',
		  'geometry': {
			'type': 'Point',
			'coordinates': [<?=(-1)*($coorX+$offsetX)?>,  <?=($coorY+$offsetY)?>]
		  }
		},
		{
		  'type': 'Feature',
		  'geometry': {
			'type': 'Point',
			'coordinates': [<?=(-1)*($coorX+$offsetX)?>,  <?= ($coorY+$offsetY-($alto*50))?>]
		  }
		},
		{
		  'type': 'Feature',
		  'geometry': {
			'type': 'Point',
			'coordinates': [<?= (-1)*($coorX+$offsetX-($ancho*50))?>,  <?= ($coorY+$offsetY-($alto*50))?>]
		  }
		},
		{
		  'type': 'Feature',
		  'geometry': {
			'type': 'Point',
			'coordinates': [<?= (-1)*($coorX+$offsetX-($ancho*50))?>,  <?=($coorY+$offsetY)?>]
		  }
		}
		
	
	]
	};
	var vectorSource = new ol.source.Vector({
	  features: (new ol.format.GeoJSON()).readFeatures(geojsonObject)
	});
	
	var vectorLayer = new ol.layer.Vector({
	  source: vectorSource,
	  style: styleFunction
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
			vectorLayer
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