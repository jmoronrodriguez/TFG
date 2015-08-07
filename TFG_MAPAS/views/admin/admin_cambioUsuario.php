

        
        <!-- /#CONTENDIO-->
		 <div id="page-content-wrapper" style="height: 100%;">
            <div class="container-fluid">
				<!--TITULO Y MIGA DE PAN-->
				<div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Usuario
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Admin</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bar-chart-o"></i> Usuario
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row" style="width:50%">
					<form class="form-horizontal" action="<?= site_url(array('admin', 'cambiarUsuario')) ?>" method="POST" data-toggle="validator">
					  <div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">Usuario</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" id="inputEmail3"  name="username" placeholder="<?=$username?>" required>
						  <div class="help-block with-errors"></div>
						</div>
					  </div>
					  <div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Contraseña</label>
						<div class="col-sm-10">
						  <input type="password" data-minlength="6" class="form-control" id="inputPassword3" name="password" placeholder="Password" value=''>
						  <div class="help-block with-errors"></div>
						</div>
					  </div>
					  <div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Repita Contraseña</label>
						<div class="col-sm-10">
						  <input type="password" class="form-control" id="inputPassword2" data-match="#inputPassword3" data-match-error="Whoops, no coinciden" placeholder="Confirm" value=''>
							<div class="help-block with-errors"></div>
						</div>
					  </div>
					  
					  <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						  <button type="submit" class="btn btn-info">Enviar</button>
						</div>
					  </div>
					</form>
                </div>
            </div>
        </div>
    </div>
	
	
	<?=js('validator.js')?>
 <script type="text/javascript">
	
 </script>


