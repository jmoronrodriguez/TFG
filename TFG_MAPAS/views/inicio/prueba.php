
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
	<div class="modal fade bs-example-modal-sm" id="confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="titleConfirm">Leyenda</h4>
				</div>
				<div class="modal-body" id='bodyConfirm'>
					<div class="btn-group" data-toggle="buttons">
						<div><label class="btn  active">
						<input type="radio" name="options" id="option1" autocomplete="off" checked> Radio 1 
						</label></div>
					  
					  <div>
					  <label class="btn">
						<input type="radio" name="options" id="option2" autocomplete="off"> Radio 2
					  </label>
					  </div><div>
					  <label class="btn ">
						<input type="radio" name="options" id="option3" autocomplete="off"> Radio 3
					  </label>
					  </div>
					</div>
						
				</div>
				<div class="modal-footer">
					
					<button type="button" data-dismiss="modal" class="btn btn-primary">Salir</button>
				</div>
			</div>
		</div>
	</div>
	
	
	 <script type="text/javascript">
	/**variables Globales**/
	var configSelect=-1;
	/**CONTROL DE LA LEYENDA***/
	
	/**
	 * Define a namespace for the application.
	 */
	window.app = {};
	var app = window.app;

	/**
	 * @constructor
	 * @extends {ol.control.Control}
	 * @param {Object=} opt_options Control options.
	 */
	app.LeyendaControl = function(opt_options) {

	  var options = opt_options || {};

	  

	  var onClickTipos = function(e) {
		consultarTipos();
		$('#confirm').modal('toggle');
	  };
	  var onClickBandos = function(e) {
		consultarBandos();
		$('#confirm').modal('toggle');
	  };
	  var onClickConfiguracion = function(e) {
		consultarConfiguracion();
		$('#confirm').modal('toggle');
	  };
	  var buttonTipos = document.createElement('button');
	  buttonTipos.innerHTML = 'T';	
	  buttonTipos.title ='Tipos';
	  buttonTipos.className='TipoButton';
	  buttonTipos.addEventListener('click', onClickTipos, false);
	  buttonTipos.addEventListener('touchstart', onClickTipos, false);
	  
	  var buttonBandos = document.createElement('button');
	  buttonBandos.innerHTML = 'B';	
	  buttonBandos.title ='Bando';
	  buttonBandos.className='BandoButton';
	  buttonBandos.addEventListener('click', onClickBandos, false);
	  buttonBandos.addEventListener('touchstart', onClickBandos, false);
	  
	  var buttonConfiguracion = document.createElement('button');
	  buttonConfiguracion.innerHTML = 'C';	
	  buttonConfiguracion.title ='Configuracion';
	  buttonConfiguracion.className='ConfiButton';
	  buttonConfiguracion.addEventListener('click', onClickConfiguracion, false);
	  buttonConfiguracion.addEventListener('touchstart', onClickConfiguracion, false);

	  var element = document.createElement('div');
	  element.className = 'leyendaControl ol-unselectable ol-control';
	  element.title ='Tipos';
	  element.appendChild(buttonConfiguracion);
	  element.appendChild(buttonTipos);
	  element.appendChild(buttonBandos);

	  ol.control.Control.call(this, {
		element: element,
		target: options.target
	  });

	};
	ol.inherits(app.LeyendaControl, ol.control.Control);
	
	
	
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
	
	
	//**CREAMOS LA CAPA CON EL CONJUNTO DE CAPAS***/
	 var mapasVisibildad=new ol.layer.Group({
		layers:arrayCapasMapas
	 });
	 
	 //CREAMOS LA CAPA DE MARKETS
	var marketsLayer = new ol.layer.Vector({
	  source: vectorSource
	});
	 var map = new ol.Map({
		  controls: ol.control.defaults({
			attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
			  collapsible: false
			})
		  }).extend([
			new app.LeyendaControl()
		  ]),
 		  layers: [
			capaBase,
			mapasVisibildad,
			marketsLayer
		  ],
		  target: 'basicMap',
		  
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
		start: [ 0, 90 ], // Handle start position
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
	
	$('.TipoButton, .BandoButton').tooltip({
	  placement: 'right'
	});
	/********FUNCIONES DE APOYO********/
	
	/**
		Contulta los bando mediante AJAX y lo coloca en la leyenda
	*/
	function consultarBandos(){
		var URL = "<?= site_url(array('adminBandos', 'get_bandos_json')) ?>";
		$.getJSON( URL)
		.done(function( data ) {
			var textoHtml='';
			$.each( data, function( i, item ) {
				
				textoHtml+="<div><button type='button' class='btn' id='noEdit2'  style='background:"+item.ban_color+"; padding: 10px;' ></button> "+item.ban_des+"</div>";
				
				
			});
			$('#bodyConfirm').html(textoHtml);
		});
		
	}
	
	function consultarTipos(){
		var URL = "<?= site_url(array('adminTipoPOI', 'get_tipoPOIs_json')) ?>";
		$.getJSON( URL)
		.done(function( data ) {
			var textoHtml='';
			$.each( data, function( i, item ) {
				
				textoHtml+="<div><button type='button' class='btn' id='noEdit2'  style='background: url(<?=asset_url();?>img/IconsPOIs/tipoPOI_"+item.tipo_id+".png);background-size: 30px 30px; background-repeat: no-repeat; padding: 20px;' ></button> "+item.tipo_des+"</div>";
				
				
			});
			$('#bodyConfirm').html(textoHtml);
		});		
	}
	function consultarConfiguracion(){
		var URL = "<?= site_url(array('adminConfiguracion', 'get_configurations_json')) ?>";
		$.getJSON( URL)
		.done(function( data ) {
			var textoHtml='<div class="btn-group" data-toggle="buttons">';
			$.each( data, function( i, item ) {
				if (item.conf_id==configSelect){
					textoHtml+='<div><label class="btn active ">';
					textoHtml+='<input type="radio" name="confOptions" id="option_'+item.conf_id+'" autocomplete="off" value="'+item.conf_id+'" checked> '+item.conf_des+' ';
					textoHtml+='</label></div>';
				}else{
					textoHtml+='<div><label class="btn  ">';
					textoHtml+='<input type="radio" name="confOptions" id="option_'+item.conf_id+'" autocomplete="off" value="'+item.conf_id+'"> '+item.conf_des+' ';
					textoHtml+='</label></div>';
				}
				
				
				
			});
			textoHtml+='</div>';
			$('#bodyConfirm').html(textoHtml);
			$("input[name=confOptions]:radio").bind("change", function(){cambioConfiguracion($(this).val());});
		});		
		
	}
	function cambioConfiguracion(id){
		configSelect=id;
		var URL = "<?= site_url(array('adminPOI', 'get_mapasBydata_json')) ?>";
		arrayCapasMapas.clear();
		vectorSource.clear();
		$.getJSON(URL, { conf: id}, function(json) {
			$.each( json, function( i, item ) {
				var coordinates=[item.poi_X,item.poi_Y];
				var iconFeature = new ol.Feature({
				  geometry: new ol.geom.Point(coordinates),
				  name: item.poi_des,
				  population: 4000,
				  rainfall: 500
				});	
				var iconStyle2 = new ol.style.Style({
				  image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
					anchor: [1, 1],
					anchorXUnits: 'pixels',
					anchorYUnits: 'pixels',
					opacity: 1,
					
					src: '<?=asset_url();?>img/IconsPOIs/tipoPOI_'+item.tipo_id+'.png'
				  }))
				});
				iconFeature.set('id',item.poi_id)//AÑADIMOS EL ID PARA PODER IDENTIFICARLO
				iconFeature.setStyle(iconStyle2);//Le añadimos el estilo segun el tipo de POI
				
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

	}
    </script>