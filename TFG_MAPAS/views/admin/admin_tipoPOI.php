

        
        <!-- /#CONTENDIO-->
		 <div id="page-content-wrapper" style="height: 100%;">
            <div class="container-fluid">
                <div class="row">
						<div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Tipo POI
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Admin</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bar-chart-o"></i> Tipo POI
                            </li>
                        </ol>
                    </div>
                </div>
					  
						<div class="col-md-8"><input type='text' class='form-control' placeholder='nuevo' id='nuevo'> </div>
						<div class="col-md-4"><button type='button' class='btn btn-info' id='btn-new'><span class='glyphicon glyphicon-plus'></span> Nuevo</button></div>
					 
					
					
                    <table class="table table-hover">
							<thead>
								<tr>
								  <th><b>Id</b></th>
								  <th><b>Descripcion</b></th>
								  
								  <th><b>    </b></th>
								  
								</tr>
							  </thead>
							<tbody id='table-content'> 
								<?php 
								foreach ($tipoPOIs as $item){
									echo("<tr id='fila_".$item->tipo_id."'>");
									echo("<td>".$item->tipo_id."</td>");
									echo("<td><div id='noEdit".$item->tipo_id."' >".$item->tipo_des."</div>");
									echo("<div id='edit".$item->tipo_id."' style='display: none'><input type='text' class='form-control' placeholder='".$item->tipo_des."'  id='textEdit_".$item->tipo_id."'></div></td>");
									echo("<td ><div id='botonesNoEdit".$item->tipo_id."'><button type='button' class='btn btn-info' id='boton".$item->tipo_id."' onClick='cambiar(".$item->tipo_id.")' > <span class='glyphicon glyphicon-wrench'></span> Normal</button></div>");
									echo("<div id='botonesEdit".$item->tipo_id."' style='display: none'>");
									echo("<button type='button' class='btn btn-warning' onClick='edit(".$item->tipo_id.")'><span class='glyphicon glyphicon-edit'></span> Editar</button>&nbsp;");
									echo("<button type='button' class='btn btn-danger'  onClick='borrar(".$item->tipo_id.")'><span class='glyphicon glyphicon-trash'></span> Borrar</button>&nbsp;");
									echo("<button type='button' class='btn btn-primary'  onClick='cambiar(".$item->tipo_id.")'><span class='glyphicon glyphicon-remove'></span> Cancelar</button></div></td>");
									echo("</tr>");
								}?>
								
							  </tbody>
						</table>
	
							
					
					
                </div>
            </div>
        </div>
    </div>
	
	
	
	<script> 
	//FUNCION CAMBIAR BOTONES
	function cambiar(id){
		$("#edit"+id).toggle();
		$("#noEdit"+id).toggle();
		$("#botonesNoEdit"+id).toggle();
		$("#botonesEdit"+id).toggle();
	}
	//EDITAR CONFIGURACION
	function edit(id) {
			edit=$("#textEdit_"+id).val();
			url__ = '<?= site_url(array('adminTipoPOI', 'edit')) ?>/'+id+'/'+edit;
            $.ajax({
				url: url__,
			});
			//Restauramos la fila
			$("#noEdit"+id).html(edit);
			cambiar(id);
       //});
    }
	//BORRAR CONFIGURACION
	//MEDIANTE AJAX BORRAMOS UN REGISTRO DE LA CONFIGURACION
	function borrar(id){
		$('#fila_'+id).slideUp('slow', function() {
            url__ = '<?= site_url(array('adminTipoPOI', 'delete')) ?>/'+id;
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
		//insertamos mediante ajax el nuevo registro
		url__ = '<?= site_url(array('adminTipoPOI', 'new_tipoPOI')) ?>/'+descrip;
		$.ajax({
            url: url__,
        }).done(function() {
			nuevos();
		});
		//consultamos mediante ajax el nuevo registro
		//creamos una fila nueva con el nuevo registro.
		
	});
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
		var URL = "<?= site_url(array('adminTipoPOI', 'get_tipoPOIs_json')) ?>";
		$.getJSON( URL)
		.done(function( data ) {
			$.each( data, function( i, item ) {
				var nuevaFila="<tr id='fila_"+item.tipo_id+"'>";
				nuevaFila+="<td>"+item.tipo_id+"</td>";
				nuevaFila+="<td><div id='noEdit"+item.tipo_id+"' >"+item.tipo_des+"</div>";
				nuevaFila+="<div id='edit"+item.tipo_id+"' style='display: none'><input type='text' class='form-control' placeholder='"+item.tipo_des+"'  id='textEdit_"+item.tipo_id+"'></div></td>";
				nuevaFila+="<td ><div id='botonesNoEdit"+item.tipo_id+"'><button type='button' class='btn btn-info' id='boton"+item.tipo_id+"' onClick='cambiar("+item.tipo_id+")' > <span class='glyphicon glyphicon-wrench'></span> Normal</button></div>";
				nuevaFila+="<div id='botonesEdit"+item.tipo_id+"' style='display: none'>";
				nuevaFila+="<button type='button' class='btn btn-warning' onClick='edit("+item.tipo_id+")'><span class='glyphicon glyphicon-edit'></span> Editar</button>&nbsp;";
				nuevaFila+="<button type='button' class='btn btn-danger' onClick='borrar("+item.tipo_id+")'><span class='glyphicon glyphicon-trash'></span> Borrar</button>&nbsp;";
				nuevaFila+="<button type='button' class='btn btn-primary'  onClick='cambiar("+item.tipo_id+")'><span class='glyphicon glyphicon-cancel'></span> Cancelar</button></div></td>";
				nuevaFila+="</tr>";
				$(nuevaFila).appendTo('#table-content');
				
			});
		});
		$("#nuevo").val("");
	}
	</script>
	<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>


