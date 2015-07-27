

        
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
					
					  
						<div class="col-md-8"><input type='text' class="form-control floating-label" placeholder='nuevo' id='nuevo'> </div>
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
								foreach ($bandos as $item){
									echo("<tr id='fila_".$item->ban_id."'>");
									echo("<td>".$item->ban_id."</td>");
									echo("<td><div id='noEdit".$item->ban_id."' >".$item->ban_des."</div>");
									echo("<div id='edit".$item->ban_id."' style='display: none'><input type='text' class='form-control' placeholder='".$item->ban_des."'  id='textEdit_".$item->ban_id."'></div></td>");
									echo("<td ><div id='botonesNoEdit".$item->ban_id."'><button type='button' class='btn btn-info' id='boton".$item->ban_id."' onClick='cambiar(".$item->ban_id.")' > <span class='glyphicon glyphicon-wrench'></span> Normal</button></div>");
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
			url__ = '<?= site_url(array('adminBandos', 'edit')) ?>/'+id+'/'+edit;
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
		//insertamos mediante ajax el nuevo registro
		url__ = '<?= site_url(array('adminBandos', 'new_bando')) ?>/'+descrip;
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
		var URL = "<?= site_url(array('adminBandos', 'get_bandos_json')) ?>";
		$.getJSON( URL)
		.done(function( data ) {
			$.each( data, function( i, item ) {
				var nuevaFila="<tr id='fila_"+item.ban_id+"'>";
				nuevaFila+="<td>"+item.ban_id+"</td>";
				nuevaFila+="<td><div id='noEdit"+item.ban_id+"' >"+item.ban_des+"</div>";
				nuevaFila+="<div id='edit"+item.ban_id+"' style='display: none'><input type='text' class='form-control' placeholder='"+item.ban_des+"'  id='textEdit_"+item.ban_id+"'></div></td>";
				nuevaFila+="<td ><div id='botonesNoEdit"+item.ban_id+"'><button type='button' class='btn btn-info' id='boton"+item.ban_id+"' onClick='cambiar("+item.ban_id+")' > <span class='glyphicon glyphicon-wrench'></span> Normal</button></div>";
				nuevaFila+="<div id='botonesEdit"+item.ban_id+"' style='display: none'>";
				nuevaFila+="<button type='button' class='btn btn-warning' onClick='edit("+item.ban_id+")'><span class='glyphicon glyphicon-edit'></span> Editar</button>&nbsp;";
				nuevaFila+="<button type='button' class='btn btn-danger' onClick='borrar("+item.ban_id+")'><span class='glyphicon glyphicon-trash'></span> Borrar</button>&nbsp;";
				nuevaFila+="<button type='button' class='btn btn-primary'  onClick='cambiar("+item.ban_id+")'><span class='glyphicon glyphicon-cancel'></span> Cancelar</button></div></td>";
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


