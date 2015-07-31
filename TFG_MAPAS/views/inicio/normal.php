
	<!--NAV BAR Principal-->
	<div class="navbar navbar-material-light-green" style="border-radius: 0px; margin-bottom: 0px;">
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
	<div id="wrapper">

        <!-- Sidebar -->
		<div id="sidebar-wrapper">
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
		 <div id="page-content-wrapper" style="height: 100%; padding: 2px;">
            <div class="container-fluid">
                <div class="row">
                    <div id='basicMap' class="col-lg-12"></div>
                </div>
            </div>
        </div>
    </div>
	
	
	<script>
	
	/***DEFINIMOS LA PROYECCION ED50 USO 30N*****/
	proj4.defs("EPSG:23030", "+proj=utm +zone=30 +ellps=intl"+
    " +towgs84=-131,-100.3,-163.4,-1.244,-0.020,-1.144,9.39 "+
    " +units=m +no_defs");
	
	/*********CAPA BASE***********/
	var capaBase=new ol.layer.Tile({
      source: new ol.source.OSM()
    });
	/********FIN CAPA BASE********/
	
	/**PROYECCION PRINCIPAL****************/
	/**EPSG:3857--WGS84 Web Mercator*******/
	var projPrin = ol.proj.get('EPSG:3857');
	
	/******OBTENEMOS LAS CAPAS Y **********/
	/****MARKERT MEDIANTE AJAX Y JSON******/
	var arrayCapasMapas=new ol.Collection();//ARRAY PARA LAS CAPAS
	var vectorSource = new ol.source.Vector({//VECTOR PARA LOS MARKET
      //create empty vector
    })
	var URL = "<?= site_url(array('adminPOI', 'get_mapas_json')) ?>";
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
			iconFeature.set('id',item.poi_id)//AÑADIMOS EL ID PARA PODER IDENTIFICARLO
			//CREAMOS EL ARRAY DE iconFeatures			
			vectorSource.addFeature(iconFeature);
			//CREMOS LA BOUNDIND BOX DE LA IMAGEN [minX, minY, MaxX, MaxY] 
			var extent = [ item.minX,item.minY, item.maxX,item.maxY ];
			//CREAMOS LA CAPA
			var newLayer = new ol.layer.Image({
				source: new ol.source.ImageStatic({
					url: '<?=asset_url();?>visibilityMaps/map_'+item.poi_id+'.png',
					imageExtent: ol.proj.transformExtent(extent, 'EPSG:23030', 'EPSG:3857'),//Transformamos la BB de ED50 a WGS84 Web Mercator
					projection: projPrin
				  })
				});
			newLayer.set('id',item.poi_id)//AÑADIMOS EL ID PARA PODER IDENTIFICARLO
			newLayer.setOpacity(0.85);
			newLayer.setHue(3.14);
			arrayCapasMapas.push(newLayer);
		});
	});
	
	//**CREAMOS LA CAPA CON EL CONJUNTO DE CAPAS***/
	 var mapasVisibildad=new ol.layer.Group({
		layers:arrayCapasMapas
	 });
	 //ESTILO DE LOS ICONOS
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
	 var map = new ol.Map({
 		  layers: [
			capaBase,
			mapasVisibildad,
			marketsLayer
		  ],
		  target: 'basicMap',
		  controls: ol.control.defaults({
			attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
			  collapsible: false
			})
		  }),
		  view: new ol.View({
			projection: projPrin,//Utilizamos la proyeccion por defecto WGS84 Web Mercator UTM
			center: [-423014.1592, 4546636.6720],
			zoom: 7
		  })
	});
	
	//EVENTOS DE RATON EN EL MAPA
	
	map.on('click', function(evt) {
		var feature = map.forEachFeatureAtPixel(evt.pixel,
					function(feature, layer) {
						return feature;
					});
		if (feature){
			var idFeat=feature.get('id');
			for (i=0; i<arrayCapasMapas.getLength(); i++){
				var capa=arrayCapasMapas.item(i);
				var id=capa.get('id');
				if (idFeat==id){
					capa.setVisible(!capa.getVisible());
				}
			}
		}
	});
	
	
	//**SLIDER**////
	var slider = document.getElementById('slider-range');
	noUiSlider.create(slider, {
		start: [ 0, 100 ], // Handle start position
		step: 5,
		margin: 20, // Handles must be more than '20' apart
		connect: true, // Display a colored bar between the handles
		direction: 'rtl', // Put '0' at the bottom of the slider
		orientation: 'vertical', // Orient the slider vertically
		behaviour: 'tap-drag', // Move handle on tap, bar is draggable
		range: { // Slider can select '0' to '100'
			'min': 0,
			'max': 100
		},
		pips: { // Show a scale with the slider
			mode: 'steps',
			density: 2
		}
	});
	
	//**LINSTENER DEL SLIDER****/
	var MinInput = document.getElementById('minEdad'),
	MaxInput = document.getElementById('maxEdad');
	
	// When the slider value changes, update the input and span
	slider.noUiSlider.on('update', function( values, handle ) {
		if ( handle ) {
			MaxInput.innerHTML  = values[handle];
		} else {
			MinInput.innerHTML  = values[handle];
		}
		
		var URL = "<?= site_url(array('adminPOI', 'get_mapas_json')) ?>/2/3";
	});
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>