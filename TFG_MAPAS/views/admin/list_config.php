<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<?=css('bootstrap.min.css')?>
	<?=css('simple-sidebar.css')?>
	<?=css('jquery-ui.css')?>
	<!--material desing-->
	<?=css('roboto.min.css')?>
	<?=css('material.min.css')?>
	<?=css('ripples.min.css')?>
	<?=css('jquery.nouislider.min.css')?>
	
	
	
	<?=js('jquery-2.1.3.min.js')?>
	
	<?=js('bootstrap.js')?>
	<?=js('jquery-ui.js')?>	
	<?=js('jquery.ui.touch-punch.min.js')?>	
	<!--material desing-->
	<?=js('ripples.min.js')?>
	<?=js('material.min.js')?>
	<?=js('jquery.nouislider.all.min.js')?>
	
	<style>
		#page-content-wrapper {
			height: 100%;
			overflow-y: auto;
			position: fixed;
			transition: all 0.5s ease 0s;
			z-index: 1000;
		}
		.container-fluid{
			height: 100%;
		}
		.row{
			height: 100%;
		}
		#div-map{
			height: 100%;
		}
		html { overflow:hidden; }
	</style>
	<script>$('#widget').draggable();</script>
	<script> 
	function cambiar(id){
		$("#edit"+id).toggle();
		$("#noEdit"+id).toggle();
		$("#botonesNoEdit"+id).toggle();
		$("#botonesEdit"+id).toggle();
	}
	function edit(id) {
			//$('#'+idDiv).slideUp('slow', function() {
				edit=$("#textEdit_"+id).val();
				url__ = '<?= site_url(array('cofiguration', 'edit')) ?>/'+id+'/'+edit;
            
				$.ajax({
					url: url__,
				});
			//});
			//Restauramos la fila
			$("#noEdit"+id).html(edit);
			cambiar(id);
       //});
    }
	function borrar(id){
		$('#fila_'+id).slideUp('slow', function() {
			edit=$("#textEdit_"+id).val();
            url__ = '<?= site_url(array('cofiguration', 'delete')) ?>/'+id;
			$.ajax({
                url: url__,
            });
		});
		cambiar(id);
	}
	
	</script>
	</head>
<body>	
	<!--NAV BAR Principal-->
	<div class="navbar navbar-inverse" style="background-color: #000; border-radius: 0px; margin-bottom: 0px;">
        <div class="container" style="margin-left: 0px;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" id='menu-toggle' data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">TFG</a>
            </div>
			<div class="navbar-collapse collapse">
                          
			</div>
                        <!--/.nav-collapse -->
        </div>
    </div>
	<!--NAV BAR MENU-->
	<div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
			
        </div>
        <!-- /#sidebar-wrapper -->

        
        <!-- /#page-content-wrapper -->
		 <div id="page-content-wrapper" style="height: 100%;">
            <div class="container-fluid">
                <div class="row">
                    <table class="table table-hover">
							<thead>
								<tr>
								  <th><b>Id</b></th>
								  <th><b>Descripcion</b></th>
								  
								  <th><b>Descripcion</b></th>
								  
								</tr>
							  </thead>
							<tbody>
								<?php 
								foreach ($configuration as $item){
									echo("<tr id='fila_".$item->conf_id."'>");
									echo("<td>".$item->conf_id."</td>");
									echo("<td><div id='noEdit".$item->conf_id."' >".$item->conf_des."</div>");
									echo("<div id='edit".$item->conf_id."' style='display: none'><input type='text' class='form-control' placeholder='".$item->conf_des."'  id='textEdit_".$item->conf_id."'></div></td>");
									echo("<td ><div id='botonesNoEdit".$item->conf_id."'><button type='button' class='btn btn-info' id='boton".$item->conf_id."' onClick='edit(".$item->conf_id.")' > <span class='glyphicon glyphicon-wrench'></span> Normal</button></div>");
									echo("<div id='botonesEdit".$item->conf_id."' style='display: none'>");
									echo("<button type='button' class='btn btn-warning' onClick='edit(".$item->conf_id.")'><span class='glyphicon glyphicon-edit'></span> Editar</button>&nbsp;");
									echo("<button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span> Borrar</button></div></td>");
									echo("</tr>");
								}?>
								
							  </tbody>
						</table>
	
							<div><input type='text' class='form-control' placeholder='nuevo'> <button type='button' class='btn btn-info'><span class='glyphicon glyphicon-plus'></span> Nuevo</button></div>
					
					
                </div>
            </div>
        </div>
    </div>
	

<script>
	  $(function() {
		$( "#slider-range" ).slider({
		  orientation: "vertical",
		  range: true,
		  values: [ 17, 67 ],
		  slide: function( event, ui ) {
			$( "#amount" ).val( "" + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
		  }
		});
		$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
		  " - $" + $( "#slider-range" ).slider( "values", 1 ) );
	  });
	  </script>
	<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>


</body>
</html>