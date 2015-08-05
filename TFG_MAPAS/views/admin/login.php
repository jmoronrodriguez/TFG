<?php
	


?>

<html>
<head>
<meta charset="utf-8">
	<title>Admin</title>
	<?=css('bootstrap.min.css')?>
	<?=css('jquery-ui.css')?>
	<?=css('bootstrap-colorpicker.css')?>
	
	<?=js('jquery-2.1.3.min.js')?>
	
	<?=js('bootstrap.js')?>
	<?=js('jquery-ui.js')?>	
	<?=js('jquery.ui.touch-punch.min.js')?>	
	<?=js('bootstrap-colorpicker.js')?>
	
	<!--AÑADIMOS LA ETIQUETA META PARA QUE SE VEA BIEN EN LOS NAVEGADORES MOVILIES-->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
	<style>
	body {
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #eee;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
	</style>
	</head>
<body>	
	 <div class="container">
		<div class="form-signin">
      <?=form_open('admin/atentificacion'); ?>
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="username" class="sr-only">Email address</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Usuario" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
</div>
    </div> <!-- /container -->
</body>
</html>