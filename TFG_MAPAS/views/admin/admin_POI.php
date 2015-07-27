
<style>
  #slider .sample1, #slider .sample2 {
    padding: 20px 0;
    background-color: #f0f0f0;
    margin-bottom: 20px;
  }
  #slider .sample2 {
    height: 150px;
  }
  #slider .sample2 .slider {
    margin: 0 40px;
  }
  #slider h2 {
    padding: 14px;
    margin: 0;
    font-size: 16px;
    font-weight: 400;
  }
  #slider .slider {
    margin: 15px;
  }
</style>
        
        <!-- /#CONTENDIO-->
		 <div id="page-content-wrapper" style="height: 100%;">
            <div class="container-fluid">
				<div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            CONFIGURACION
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Admin</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bar-chart-o"></i> POI
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
					<div class="col-md-5"><input type='text' class='form-control floating-label' placeholder='Nombre' id='Nombre'> </div>
					<div class="col-md-5">
						<input type="file" id="inputFile" multiple="" >
					</div>
				
                </div>
				<div class="row">
					<div class="col-md-3"><select class="form-control" id="slt_tipo"><option>--tipo--</option></select> </div>
					<div class="col-md-3"><select class="form-control" id="slt_configur"><option>--configuracion--</option></select> </div>
					<div class="col-md-3"><select class="form-control" id="slt_bando"><option>--Bando--</option></select> </div>
                </div>
				<div class="row">
					
					<div class="col-md-2"><label>X: </label><input type='text' class='form-control floating-label' placeholder='X' id='CoorX'> </div>
					<div class="col-md-2"><label>Y: </label><input type='text' class='form-control' placeholder='Y' id='CoorY'> </div>
					<div class="col-md-3"><label>Min. Edad: </label><input type='text' class='form-control floating-label' placeholder='Año Minimo' id='MinEdad'> </div>
					<div class="col-md-2"><label>Max. Edad: </label><input type='text' class='form-control' placeholder='Año Maximo' id='MaxEdad'> </div>
                </div>
				<div class="row">
					<div class="col-md-10">
						<div id='slider-range' style="margin-top: 10px;"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10">
					 
						<div id="basicMap" class='map'></div>
					  
					</div>
					<div style="display: none;">
					  <div id="popup" title="Coordenadas"></div>
					</div>
										
                </div>
            </div>
        </div>
    </div>
	
	
	
	 <script type="text/javascript">
	//SLIDER 
	var slider = document.getElementById('slider-range');

	noUiSlider.create(slider, {
		start: [ 20, 80 ], // Handle start position
		step: 10, // Slider moves in increments of '10'
		margin: 20, // Handles must be more than '20' apart
		connect: true, // Display a colored bar between the handles
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
	var MinInput = document.getElementById('MinEdad'),
	MaxInput = document.getElementById('MaxEdad');

	// When the slider value changes, update the input and span
	slider.noUiSlider.on('update', function( values, handle ) {
		if ( handle ) {
			MaxInput.value = values[handle];
		} else {
			MinInput.value = values[handle];
		}
	});

	// When the input changes, set the slider value
	MaxInput.addEventListener('change', function(){
		slider.noUiSlider.set([null, this.value]);
	});
	MinInput.addEventListener('change', function(){
		slider.noUiSlider.set([null, this.value]);
	});
	
	//Ocultar/Mostrar Menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
	//Proyeccion Mapa EPSG:23030
	proj4.defs("EPSG:23030", "+proj=utm +zone=30 +ellps=intl"+
    " +towgs84=-131,-100.3,-163.4,-1.244,-0.020,-1.144,9.39 "+
    " +units=m +no_defs");
	var wgs84Projection = ol.proj.get("EPSG:4326");
	var utmProjection = ol.proj.get("EPSG:23030");
	var proje = ol.proj.get('EPSG:3857');
	//CAPA DE OPEN STREEP MAP	
	var layer2=new ol.layer.Tile({
      source: new ol.source.OSM()
    });
	//CREACION DEL MAPA
      var map = new ol.Map({
 		  layers: [
			layer2
		  ],
		  target: 'basicMap',
		  controls: ol.control.defaults({
			attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
			  collapsible: false
			})
		  }),
		  view: new ol.View({
			projection: proje,
			center: [-423014.1592, 4546636.6720],
			zoom: 7
		  })
		});
		var popup = new ol.Overlay({
		  element: document.getElementById('popup')
		});
		map.addOverlay(popup);
		map.on('click', function(evt) {
		  var element = popup.getElement();
		  var coordinate = evt.coordinate;
		  $('#CoorX').val(coordinate[0]);
		  $('#CoorY').val(coordinate[1]);
		  var hdms = ol.proj.transform(
			  coordinate, 'EPSG:3857', 'EPSG:23030');

		  $(element).popover('destroy');
		  popup.setPosition(coordinate);
		  // the keys are quoted to prevent renaming in ADVANCED mode.
		  $(element).popover({
			'placement': 'top',
			'animation': false,
			'html': true,
			'content': '<p>Coordenadas en ED50, UTM USO 30:</p><code>' + hdms + '</code>'
		  });
		  $(element).popover('show');
		});
		//Funcion de carga de los Select
		$( document ).ready(function() {
			var URL = "<?= site_url(array('adminBandos', 'get_bandos_json')) ?>";
			$.getJSON( URL)
			.done(function( data ) {
				$.each( data, function( i, item ) {
					var nuevaFila="<option value='"+item.ban_id+"'>"+item.ban_des+"</option>";
					$(nuevaFila).appendTo('#slt_bando');
					
				});
			});
			URL = "<?= site_url(array('adminConfiguracion', 'get_configurations_json')) ?>";
			$.getJSON( URL)
			.done(function( data ) {
				$.each( data, function( i, item ) {
					var nuevaFila="<option value='"+item.conf_id+"'>"+item.conf_des+"</option>";
					$(nuevaFila).appendTo('#slt_configur');
					
				});
			});
			URL = "<?= site_url(array('adminTipoPOI', 'get_tipoPOIs_json')) ?>";
			$.getJSON( URL)
			.done(function( data ) {
				$.each( data, function( i, item ) {
					var nuevaFila="<option value='"+item.tipo_id+"'>"+item.tipo_des+"</option>";
					$(nuevaFila).appendTo('#slt_tipo');
					
				});
			});
		});
    </script>


