

        
        <!-- /#CONTENDIO-->
		 <div id="page-content-wrapper" style="height: 100%;">
            <div class="container-fluid">
				<!--TITULO Y MIGA DE PAN-->
				<div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            BANDO
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Admin</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bar-chart-o"></i> Bando
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
					
					  
						<div class="col-md-6"><input type='text' class="form-control floating-label" placeholder='nuevo' id='nuevo'> </div>
						<div class="col-md-1"><input id="hiddenColor" type="hidden" value="#e1aae4"><button id="color" class="btn colorpicker-element" type="button">&nbsp;&nbsp;&nbsp;&nbsp;</button> </div>
						<div class="col-md-5"><button type='button' class='btn btn-info' id='btn-new'><span class='glyphicon glyphicon-plus'></span> Nuevo</button></div>
					 
					
					
                    <table class="table table-hover">
							<thead>
								<tr>
								  <th><b>Id</b></th>
								  <th><b>Descripcion</b></th>
								  <th class='colorDiv'><b>Color</b></th>
								  <th><b>    </b></th>
								  
								</tr>
							  </thead>
							<tbody id='table-content'> 
								<?php 
								foreach ($bandos as $item){
									
									echo("<tr id='fila_".$item->ban_id."'>");
									echo("<td>".$item->ban_id."</td>");
									echo("<td><div id='noEdit".$item->ban_id."' >".$item->ban_des."</div>");
									echo("<div id='edit".$item->ban_id."' style='display: none'><input type='text' class='form-control' placeholder='".$item->ban_des."'  id='textEdit_".$item->ban_id."'></div></td>");
									echo("<td class='colorDiv'><button type='button' class='btn' id='noEdit2".$item->ban_id."'  style='background:".$item->ban_color."' >&nbsp;&nbsp;&nbsp;&nbsp;</button><div id='edit2".$item->ban_id."' style='display: none'><input type='hidden'  id='hiddenColor".$item->ban_id."'  value='".$item->ban_color."'/><button type='button' class='btn' style='background:".$item->ban_color."' id='color".$item->ban_id."'>&nbsp;&nbsp;&nbsp;&nbsp;</button></div></td>");
									echo("<td ><div id='botonesNoEdit".$item->ban_id."'><button type='button' class='btn btn-info' id='boton".$item->ban_id."' onClick='cambiar(".$item->ban_id.")' > <span class='glyphicon glyphicon-wrench'></span> Normal</button> </div>");
									echo("<div id='botonesEdit".$item->ban_id."' style='display: none'>");
									echo("<button type='button' class='btn btn-warning' onClick='edit(".$item->ban_id.")'><span class='glyphicon glyphicon-edit'></span> Editar</button>&nbsp;");
									echo("<button type='button' class='btn btn-danger'  onClick='borrar(".$item->ban_id.")'><span class='glyphicon glyphicon-trash'></span> Borrar</button>&nbsp;");
									echo("<button type='button' class='btn btn-primary'  onClick='cambiar(".$item->ban_id.")'><span class='glyphicon glyphicon-remove'></span> Cancelar</button></div></td>");
									echo("</tr>");
								}?>
								
							  </tbody>
						</table>
	
							
					
					
                </div>
            </div>
        </div>
    </div>
	
	<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="titleConfirm">Borrar POI</h4>
				</div>
				<div class="modal-body" id='bodyConfirm'>
					¿Esta seguro de Borrar este POI?
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-danger" id="delete">Si</button>
					<button type="button" data-dismiss="modal" class="btn btn-primary">No</button>
					<input type='hidden' id='data_id' value='-1'/>
					<input type='hidden' id='borrar_editar' value='-1'/>
				</div>
			</div>
		</div>
	</div>
	
 <script type="text/javascript">
	//COLOR PICKER
	$(document).ready(function(){
		$('#color').colorpicker({
			color: $('#color').css('background')
		}).on('changeColor', function(ev) {
			$('#color').css('background', ev.color.toHex());
			$('#hiddenColor').val(ev.color.toHex());
		});
		<?php 
		foreach ($bandos as $item){
			echo "$('#color".$item->ban_id."').colorpicker({";
			  echo "color: $('#color".$item->ban_id."').css('background')";
			echo "}).on('changeColor', function(ev) {";
			  echo "$('#color".$item->ban_id."').css('background', ev.color.toHex());";
			  echo "$('#hiddenColor".$item->ban_id."').val(ev.color.toHex());";
			echo "});";
			}
		?>
	});
	//FUNCION CAMBIAR BOTONES
	function cambiar(id){
		$("#edit"+id).toggle();
		$("#edit2"+id).toggle();
		$("#noEdit"+id).toggle();
		$("#noEdit2"+id).toggle();
		$("#botonesNoEdit"+id).toggle();
		$("#botonesEdit"+id).toggle();
	}
	//EDITAR CONFIGURACION
	function edit(id){
		$('#data_id').val(id);//Guardamos el id
		$('#borrar_editar').val(1);//Asignamos el 1 para editar
		$('#titleConfirm').html('Editar Bando');
		$('#bodyConfirm').html('¿Esta seguro de editar este Bando?');
		var URL = "<?= site_url(array('adminBandos', 'get_bando_json')) ?>/"+id;
		var color=0;
		var data;
		$.ajax({
			  type: "GET",
			  url: URL,
			  data: data,
			  async: false,
			  dataType: "json",
			  success: function(data) {
				 color=data.color;
			  }
		  });
		var textoHtml="¿Esta seguro de editar este Bando?<br>";
		$('#delete').prop('disabled', false);
		if (color!=$('#hiddenColor'+id).val()){	
			textoHtml+="<div class='alert alert-dismissable alert-warning'><h4>Atencion!</h4>";
			textoHtml+="<p>Se va cambiar el color esto puede llevar un rato.</p></div>";
			textoHtml+="<div class='alert alert-dismissable alert-info'>";
			textoHtml+="<p>Al cambiar el color del bando se cambiara el color de todos los mapas asociados a ese bando.</p></div>";
			$('#bodyConfirm').html(textoHtml);
		}
		
		if ($("#textEdit_"+id).val().length==''){
			textoHtml+="<div class='alert alert-dismissable alert-danger'><h4>Error!</h4>";
			textoHtml+="<p>El cambo descripcion no puede estar vacio.</p></div>";
			$('#bodyConfirm').html(textoHtml);
			$('#delete').prop('disabled', true);
			
		}	
		$('#confirm').modal('toggle');
	}
	$('#delete').click(function(){
		var id=$('#data_id').val();
		var borrarEditar=$('#borrar_editar').val();
		if (borrarEditar==1)
			editConfirm(id);
		else
			borrarConfirm(id);
	});
	function editConfirm(id) {
			$('#confirm').modal('toggle');
			edit=$("#textEdit_"+id).val();
			color=$('#hiddenColor'+id).val();
			url__ = '<?= site_url(array('adminBandos', 'edit')) ?>';
			$('#boton'+id).prop('disabled', true);
			$.post(url__, {id: id, des: edit, color: color}, function(respuesta) {
				console.log("La respuesta es:", respuesta);
				$('#boton'+id).prop('disabled', false);
			});
            //Restauramos la fila
			$("#noEdit"+id).html(edit);
			$('#noEdit2'+id).css('background',color);
			cambiar(id);
    }
	function borrar (id){
		$('#data_id').val(id);//Guardamos el id
		$('#borrar_editar').val(2);//Asignamos el 1 para editar
		var URL = "<?= site_url(array('adminPOI', 'get_poiByBando_json')) ?>/"+id;
		var tam=0;
		$.ajax({
			  type: "GET",
			  url: URL,
			  async: false,
			  dataType: "json",
			  success: function(data) {
				 tam=data.tam;
			  }
		  });
		var textoHtml="¿Esta seguro de editar este Bando?<br>";
		$('#delete').prop('disabled', false);
		if (tam>0){
			textoHtml="<div class='alert alert-dismissable alert-danger'><h4>Error!</h4>";
			textoHtml+="<p>No se puede borrar, tiene POI's asociados.</p></div>";
			
			$('#delete').prop('disabled', true);
			
		}	
		$('#bodyConfirm').html(textoHtml);
		$('#confirm').modal('toggle');
	}
	
	//BORRAR CONFIGURACION
	//MEDIANTE AJAX BORRAMOS UN REGISTRO DE LA CONFIGURACION
	function borrarConfirm(id){
		$('#fila_'+id).slideUp('slow', function() {
            url__ = '<?= site_url(array('adminBandos', 'delete')) ?>/'+id;
			$.ajax({
                url: url__,
            }).done(function() {
			  $( this ).addClass( "done" );
			});
		});
		cambiar(id);
	}
	
	
	$("#btn-new").click(function(e) {
		//obtenemos el nombre del nuevo registro
		descrip=$("#nuevo").val();
		color=$('#hiddenColor').val();
		//insertamos mediante ajax el nuevo registro
		url__ = '<?= site_url(array('adminBandos', 'new_bando')) ?>/'+descrip;
		$.post(url__, {des: descrip, color: color}, function(respuesta) {
			nuevos();
		});
		//consultamos mediante ajax el nuevo registro
		//creamos una fila nueva con el nuevo registro.
		
	});
	function crearEvento(elemento, evento, funcion) {
      if (elemento.addEventListener) {
            elemento.addEventListener(evento, funcion, false);
      } else {
            elemento.attachEvent("on" + evento, funcion);
      }
}
	function nuevos(){
		// Obtenemos el total de columnas (tr) del id "tabla"
        var trs=$("#table-content tr").length;
        while(trs>0)
        {
			// Eliminamos la ultima columna
            $("#table-content tr:last").remove();
			trs=$("#table-content tr").length;
        }
		//OBTENEMOS LAS NUEVAS COLUMNAS POR MEDIO DE AJAX Y JSON
		var URL = "<?= site_url(array('adminBandos', 'get_bandos_json')) ?>";
		$.getJSON( URL)
		.done(function( data ) {
			$.each( data, function( i, item ) {
				/*var nuevaFila="<tr id='fila_"+item.ban_id+"'>";
				nuevaFila+="<td>"+item.ban_id+"</td>";
				nuevaFila+="<td><div id='noEdit"+item.ban_id+"' >"+item.ban_des+"</div>";
				nuevaFila+="<div id='edit"+item.ban_id+"' style='display: none'><input type='text' class='form-control' placeholder='"+item.ban_des+"'  id='textEdit_"+item.ban_id+"'></div></td>";
				nuevaFila+="<td class='colorDiv'><button   type='button' class='btn' id='noEdit2"+item.ban_id+"'  style='background:"+item.ban_color+"' >&nbsp;&nbsp;&nbsp;&nbsp;</button><div id='edit2"+item.ban_id+"' style='display: none'><input type='hidden'  id='hiddenColor"+item.ban_id+"'  value='"+item.ban_color+"'/><button type='button' class='btn' style='background:"+item.ban_color+"' id='color"+item.ban_id+"'>&nbsp;&nbsp;&nbsp;&nbsp;</button></div></td>";
				nuevaFila+="<td ><div id='botonesNoEdit"+item.ban_id+"'><button type='button' class='btn btn-info' id='boton"+item.ban_id+"' onClick='cambiar("+item.ban_id+")' > <span class='glyphicon glyphicon-wrench'></span> Normal</button></div>";
				nuevaFila+="<div id='botonesEdit"+item.ban_id+"' style='display: none'>";
				nuevaFila+="<button type='button' class='btn btn-warning' onClick='edit("+item.ban_id+")'><span class='glyphicon glyphicon-edit'></span> Editar</button>&nbsp;";
				nuevaFila+="<button type='button' class='btn btn-danger' onClick='borrar("+item.ban_id+")'><span class='glyphicon glyphicon-trash'></span> Borrar</button>&nbsp;";
				nuevaFila+="<button type='button' class='btn btn-primary'  onClick='cambiar("+item.ban_id+")'><span class='glyphicon glyphicon-cancel'></span> Cancelar</button></div></td>";
				nuevaFila+="</tr>";
				$(nuevaFila).appendTo('#table-content');*/
				location.reload();
				
			});
		});
		$("#nuevo").val("");
	}
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>


