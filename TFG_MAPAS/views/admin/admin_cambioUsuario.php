		<div id="page-wrapper" style="overflow: auto;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">
                            Usuario
                        </h3>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?= site_url(array('admin')) ?>">Admin</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bar-chart-o"></i> Usuario
                            </li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
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
            <!-- /.container-fluid -->
        </div>
	</div>
	


	
	<?=js('validator.js')?>



	