
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
  .popover-title {
	color: #000;
  }
</style>
        
        <!-- /#CONTENDIO-->
		 <div id="page-content-wrapper" style="height: 100%;">
            <div class="container-fluid">
				<div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">
                            POI's
                        </h3>
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
	<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-lg"role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">POI Nuevo</h4>
		  </div>
		  <div class="modal-body">
						<?=form_open_multipart('adminPOI/do_upload'); ?>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label" for="inputError inputSuccess">Nombre: </label>
									<input type='text' class='form-control floating-label' placeholder='Nombre' id='Nombre' name='Nombre'> 
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label" for="inputError">Imagen: </label>
									<input type="file" name="Imagen" id='Imagen' accept=".png" >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label" for="inputError">Word File: </label>
									<input type="file" name="geolocalizacion" id='geolocalizacion' accept=".pgw">
								</div>
							</div>
						
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="inputError">Tipo: </label>
									<select class="form-control" id="slt_tipo" name="slt_tipo"><option value='-1'>Seleciona..-</option></select> 
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="inputError">Configuracion: </label>
									<select class="form-control" id="slt_configur" name="slt_configur"><option value='-1'>Seleciona..-</option></select> 
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="inputError">Bando: </label>
									<select class="form-control" id="slt_bando" name="slt_bando"><option value='-1'>Seleciona..-</option></select> 
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="inputError">X: </label>
									<input type='text' class='form-control floating-label' placeholder='X' id='CoorX' name='CoorX' readonly> 
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="inputError">Y: </label>
									<input type='text' class='form-control' placeholder='Y' id='CoorY' name='CoorY' readonly> 
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="inputError">Min. Edad: </label>
									<input type='text' class='form-control' placeholder='Año Minimo' id='MinEdad' name='MinEdad' readonly>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="inputError">Max. Edad: </label>
									<input type='text' class='form-control' placeholder='Año Maximo' id='MaxEdad' name='MaxEdad' readonly> 
									<input type='hidden' name='id_poi'  id='id_poi' value='-1'> 
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div id='slider-range' style="margin-top: 10px;"></div>
							</div>
						</div>
					</div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Submit</button>
		  </div>
		  <?php form_close() ?>
		</div>
	  </div>
	</div>
	
	
	
	<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Borrar POI</h4>
				</div>
				<div class="modal-body">
					¿Esta seguro de Borrar este POI?
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-danger" id="delete">Si</button>
					<button type="button" data-dismiss="modal" class="btn btn-primary">No</button>
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
	
	var iconStyle2 = new ol.style.Style({
	  image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
		anchor: [1, 1],
		anchorXUnits: 'pixels',
		anchorYUnits: 'pixels',
		opacity: 1,
		
		src: '<?=asset_url();?>img/IconsPOIs/tipoPOI_6.png'//'http://ol3js.org/en/master/examples/data/icon.png'
	  }))
	});
	//CREACION DE LOS MARKERT 
	//CONSULTAMOS MEDIANTE AJAX LA LISTA DE POIS
	var URL = "<?= site_url(array('adminPOI', 'get_poi_json')) ?>";
	var styleSource=[];
	var vectorSource = new ol.source.Vector({
      //create empty vector
    });
	styleSource.push(iconStyle2);
	
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
			var iconStyle2 = new ol.style.Style({
			  image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
				anchor: [1, 1],
				anchorXUnits: 'pixels',
				anchorYUnits: 'pixels',
				opacity: 1,
				
				src: '<?=asset_url();?>img/IconsPOIs/tipoPOI_'+item.tipo_id+'.png'//'http://ol3js.org/en/master/examples/data/icon.png'
			  }))
			});
			iconFeature.set('id',item.poi_id);
			iconFeature.setId(item.poi_id);
			iconFeature.setStyle(iconStyle2);
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
	
	//CAPA DE OPEN STREEP MAP	
	var layer2=new ol.layer.Tile({
      source: new ol.source.OSM()
    });
	//CREACION DEL MAPA
      var map = new ol.Map({
 		  layers: [
			layer2, 
			marketsLayer
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
		  
		  var feature = map.forEachFeatureAtPixel(evt.pixel,
			  function(feature, layer) {
				return feature;
			  });
		  if (feature) {
			$(element).popover('destroy');
			var geometry = feature.getGeometry();
			var coord = geometry.getCoordinates();
			var id=feature.get('id');
			popup.setPosition(coord);
			$(element).popover({
			  'title':feature.name,	
			  'placement': 'top',
			  'html': true,
			  'content': '<button type="button" class="btn btn-warning"  onClick="editar('+id+')"><span class="glyphicon glyphicon-edit"></span> Editar</button> <button type="button" class="btn btn-danger"  onClick="borrar('+id+')"><span class="glyphicon glyphicon-trash"></span> Borrar</button>'
			});
			$('#id_poi').val(id);
			$( "#popup" ).attr( "title", feature.name );
			
			$(element).popover('show');
			$('.popover-title').html(feature.q.name);
		  } else {
			  var coordinate = evt.coordinate;
			  $('#CoorX').val(coordinate[0]);
			  $('#CoorY').val(coordinate[1]);
			  var hdms = ol.proj.transform(coordinate, 'EPSG:3857', 'EPSG:23030');

			  $(element).popover('destroy');
			  popup.setPosition(coordinate);
			  // the keys are quoted to prevent renaming in ADVANCED mode.
			  $(element).popover({
				'placement': 'top',
				'animation': false,
				'html': true,
				'content': '<p>Coordenadas en ED50, UTM USO 30:</p><code>X:' + hdms[0] + '</code></BR><code>Y:' + hdms[1] + '</code></BR><button type="button" class="btn btn-primary"  onClick="nuevo()">Nuevo</button> '
			  });
			  $( "#popup" ).attr( "title", "coordenadas" );
			  
			  $('#id_poi').val(-1);
			  $(element).popover('show');
			  $('.popover-title').html("coordenadas");
		  }
		});
		
		// change mouse cursor when over marker
		map.on('pointermove', function(e) {
			var element = popup.getElement();
		  if (e.dragging) {
			$(element).popover('destroy');
			return;
		  }
		  var pixel = map.getEventPixel(e.originalEvent);
		  var hit = map.hasFeatureAtPixel(pixel);
		  map.getTargetElement().style.cursor = hit ? 'pointer' : '';
		});
		//FUNCION PARA VALIDAR EL FORMULARIO *******************************/
		$( "form" ).submit(function( event ) {
			//VALIDADMOS LOS SELECT
			var enviar=true;
			var mensaje="";
			//SELECT BANDO
			if ($('#slt_bando').val()==-1){
				$('#slt_bando').parent().addClass('has-error');
				enviar=false;
			}else{
				$('#slt_bando').parent().removeClass('has-error');
				$('#slt_bando').parent().addClass('has-success');
			}
			//SELECT CONFIGURACION
			if ($('#slt_configur').val()==-1){
				$('#slt_configur').parent().addClass('has-error');
				enviar=false;
			}else{
				$('#slt_configur').parent().removeClass('has-error');
				$('#slt_configur').parent().addClass('has-success');
			}
			//SELECT TIPO POI
			if ($('#slt_tipo').val()==-1){
				$('#slt_tipo').parent().addClass('has-error');
				enviar=false;
			}else{
				$('#slt_tipo').parent().removeClass('has-error');
				$('#slt_tipo').parent().addClass('has-success');
			}
			//INPUT NOMBRE POI
			if ($('#Nombre').val()==""){
				$('#Nombre').parent().removeClass('has-success');
				$('#Nombre').parent().addClass('has-error');
				enviar=false;
			}else{
				$('#Nombre').parent().removeClass('has-error');
				$('#Nombre').parent().addClass('has-success');
			}
			//MINIMAD EDAD
			if ($('#MinEdad').val()==""){
				$('#MinEdad').parent().addClass('has-error');
				enviar=false;
			}else{
				$('#MinEdad').parent().removeClass('has-error');
				$('#MinEdad').parent().addClass('has-success');
			}
			//MAXIMA EDAD
			if ($('#MaxEdad').val()==""){
				$('#MaxEdad').parent().addClass('has-error');
				enviar=false;
			}else{
				$('#MaxEdad').parent().removeClass('has-error');
				$('#MaxEdad').parent().addClass('has-success');
			}
			//IMAGEN
			if ($('#id_poi').val()==-1){
				if ($('#Imagen').val()==""){
					$('#Imagen').parent().addClass('has-error');
					enviar=false;
				}else{
					$('#Imagen').parent().removeClass('has-error');
					$('#Imagen').parent().addClass('has-success');
				}
				//ARCHIVO WORD
				if ($('#geolocalizacion').val()==""){
					$('#geolocalizacion').parent().addClass('has-error');
					enviar=false;
				}else{
					$('#geolocalizacion').parent().removeClass('has-error');
					$('#geolocalizacion').parent().addClass('has-success');
				}
			}
			//CAMBIAMOS LA URL SEGUN SEA PARA EDITAR O PARA CREAR
			if ($('#id_poi').val()!=-1){
				 $('form').attr('action', "<?= site_url(array('adminPOI', 'edit')) ?>");
			}else{
				$('form').attr('action', "<?= site_url(array('adminPOI', 'do_upload')) ?>");
			}
			if (enviar){
					return;
			}
			event.preventDefault();
		});
		//FUNICON NUEVO**********
		function nuevo(){
			//RESETEAMOS EL FORMULARIO
			$('#Nombre').val("");
			$('#Nombre').parent().removeClass('has-error');
			$('#Nombre').parent().removeClass('has-success');
			$('#slt_bando').val(-1);
			$('#slt_bando').parent().removeClass('has-error');
			$('#slt_bando').parent().removeClass('has-success');
			$('#slt_configur').val(-1);
			$('#slt_configur').parent().removeClass('has-error');
			$('#slt_configur').parent().removeClass('has-success');
			$('#slt_tipo').val(-1);
			$('#slt_tipo').parent().removeClass('has-error');
			$('#slt_tipo').parent().removeClass('has-success');
			$('#MinEdad').val("");
			$('#MinEdad').parent().removeClass('has-error');
			$('#MinEdad').parent().removeClass('has-success');
			$('#MaxEdad').val("");
			$('#MaxEdad').parent().removeClass('has-error');
			$('#MaxEdad').parent().removeClass('has-success');
			$('#Imagen').val("");
			$('#Imagen').parent().removeClass('has-error');
			$('#Imagen').parent().removeClass('has-success');
			$('#geolocalizacion').val("");
			$('#geolocalizacion').parent().removeClass('has-error');
			$('#geolocalizacion').parent().removeClass('has-success');
			$('#id_poi').val(-1);
			$('#myModal').modal('toggle');
			$('.modal-title').html('POI Nuevo');
		}
		//FUNCION EDITAR+++++++
		function editar(id ){
			var URL = "<?= site_url(array('adminPOI', 'get_poiById_json')) ?>/"+id;
			$.getJSON( URL)
			.done(function( data ) {
				var slider = document.getElementById('slider-range');
				slider.noUiSlider.set([data.MinEdad, data.MaxEdad]);
				$('#Nombre').val(data.poi_des);
				$('#slt_bando').val(data.id_bando);
				$('#slt_configur').val(data.id_conf);
				$('#slt_tipo').val(data.id_tipo);
				$('#MaxEdad').val(data.MaxEdad);
				$('#MinEdad').val(data.MinEdad);
				$('#myModal').modal('toggle');
				$('.modal-title').html('Editar POI');
				 $('#CoorX').val(data.posX);
				 $('#id_poi').val(id);
			  $('#CoorY').val(data.posY);
			});
		}
		
		//FUNCION borrar+++++++
		
		function borrar(id){
			var element = popup.getElement();
			$(element).popover('destroy');
			$('#confirm').modal('toggle');
			/**/
		}
		$('#delete').click(function(){
			var id=$('#id_poi').val();
			var URL = "<?= site_url(array('adminPOI', 'delete')) ?>/"+id;
			//$.getJSON( URL)
			//.done(function( data ) {
				/*var feature=vectorSource.getFeatureById(id);
				vectorSource.removeFeature(feature);*/
			//});*/
			var feature=vectorSource.getFeatureById(id);
			vectorSource.removeFeature(feature);
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


