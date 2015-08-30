<html>
    <head>
        <meta charset="utf-8">
        <title>Admin</title>
        <?= css('bootstrap.min.css') ?>
        <?= css('jquery-ui.css') ?>
        <?= css('bootstrap-colorpicker.css') ?>

        <?= js('jquery-2.1.3.min.js') ?>

        <?= js('bootstrap.js') ?>
        <?= js('jquery-ui.js') ?>	
        <?= js('jquery.ui.touch-punch.min.js') ?>	
        <?= js('bootstrap-colorpicker.js') ?>

        <!--AÃ‘ADIMOS LA ETIQUETA META PARA QUE SE VEA BIEN EN LOS NAVEGADORES MOVILIES-->
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
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Por favor inicie sesi&oacute;n</h3>
                        </div>
                        <div class="panel-body">
                            <?php
                            if (isset($error)) {
                                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                            }
                            ?>
                            <?= form_open('admin/atentificacion'); ?>
                            <label for="username" class="sr-only">Usuario</label>
                            <input type="text" id="username" name="username" class="form-control" placeholder="Usuario" required autofocus>
                            <label for="inputPassword" class="sr-only">Contraseña</label>
                            <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>

                            <button class="btn btn-lg btn-success btn-block" type="submit">Iniciar Sesi&oacute;n</button>
                            
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>