<div id="page-wrapper" style="overflow: auto;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">
                    <i class="mdi-action-settings"></i> Configuraciones
                </h3>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?= site_url(array('admin')) ?>">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-bar-chart-o"></i> Configuraciones
                    </li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-3"><input type='text' class='form-control' placeholder='nuevo' id='nuevo'> </div>
            <div class="col-md-3"><input type='text' class='form-control' placeholder='Edad M&iacute;nima' id='minEdad'> </div>
            <div class="col-md-3"><input type='text' class='form-control' placeholder='Edad M&aacute;xima' id='maxEdad'> </div>
            <div class="col-md-3"><button type='button' class='btn btn-info btn-fab btn-raised mdi-content-create' id='btn-new'></button></div>
        </div>
        <div class="row">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><b>Id</b></th>
                        <th><b>Descripci&oacute;n</b></th>
                        <th><b>Edad M&iacute;nima</b></th>
                        <th><b>Edad M&aacute;xima</b></th>
                        <th><b>    </b></th>

                    </tr>
                </thead>
                <tbody id='table-content'> 
                    <?php
                    foreach ($configuration as $item) {
                        echo("<tr id='fila_" . $item->conf_id . "'>");
                        echo("<td>" . $item->conf_id . "</td>");
                        echo("<td><div id='noEdit" . $item->conf_id . "' >" . $item->conf_des . "</div>");
                        echo("<div id='edit" . $item->conf_id . "' style='display: none'><input type='text' class='form-control' placeholder='" . $item->conf_des . "'  id='textEdit_" . $item->conf_id . "'></div></td>");
                        echo("<td><div id='noEditMin" . $item->conf_id . "'>" . $item->min_edad . "</div><div id='editMin" . $item->conf_id . "' style='display: none'><input type='text' class='form-control' placeholder='" . $item->min_edad . "'  id='minEdit_" . $item->conf_id . "'></div></td>");
                        echo("<td><div id='noEditMax" . $item->conf_id . "'>" . $item->max_edad . "</div><div id='editMax" . $item->conf_id . "' style='display: none'><input type='text' class='form-control' placeholder='" . $item->max_edad . "'  id='maxEdit_" . $item->conf_id . "'></div></td>");

                        echo("<td ><div id='botonesNoEdit" . $item->conf_id . "'><button type='button' class='btn btn-info btn-fab btn-raised mdi-content-create' id='boton" . $item->conf_id . "' onClick='cambiar(" . $item->conf_id . ")' > </button></div>");
                        echo("<div id='botonesEdit" . $item->conf_id . "' style='display: none'>");
                        echo("<button type='button' class='btn btn-warning btn-fab btn-raised  mdi-editor-border-color ' onClick='edit(" . $item->conf_id . ")'></button>&nbsp;");
                        echo("<button type='button' class='btn btn-danger btn-fab btn-raised  mdi-navigation-cancel'  onClick='borrar(" . $item->conf_id . ")'></button>&nbsp;");
                        echo("<button type='button' class='btn btn-primary btn-fab btn-raised  mdi-navigation-arrow-back'  onClick='cambiar(" . $item->conf_id . ")'></button></div></td>");
                        echo("</tr>");
                    }
                    ?>

                </tbody>
            </table>
        </div>

    </div>
    <!-- /.container-fluid -->
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
<div class="modal fade" id="modalAlert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="titleAlert">ATENCIÓN</h4>
            </div>
            <div class="modal-body" id='bodyAlert'>
                ¿Esta seguro de Borrar este POI?
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
//FUNCION CAMBIAR BOTONES
    function cambiar(id) {
        $("#edit" + id).toggle();
        $("#noEdit" + id).toggle();
        $("#editMin" + id).toggle();
        $("#noEditMin" + id).toggle();
        $("#editMax" + id).toggle();
        $("#noEditMax" + id).toggle();
        $("#botonesNoEdit" + id).toggle();
        $("#botonesEdit" + id).toggle();
    }
    $('#delete').click(function () {
        var id = $('#data_id').val();
        var borrarEditar = $('#borrar_editar').val();
        if (borrarEditar == 1)
            editConfirm(id);
        else
            borrarConfirm(id);
    });

    function edit(id) {
        $('#data_id').val(id);//Guardamos el id
        $('#borrar_editar').val(1);//Asignamos el 1 para editar
        $('#titleConfirm').html('Editar Configuraci&oacute;n');
        minEdad = $("#minEdit_" + id).val();
        maxEdad = $("#maxEdit_" + id).val();
        var textoHtml = "¿Esta seguro de editar esta configuraci&oacute;n?<br>";
        $('#delete').prop('disabled', false);
        if ($("#textEdit_" + id).val() == '') {
            textoHtml += "<div class='alert alert-dismissable alert-danger'><h4>Error!</h4>";
            textoHtml += "<p>El cambo descripci&oacute;n no puede estar vacio.</p></div>";
            $('#delete').prop('disabled', true);

        }
        error=false;
        if (minEdad.length < 1) {
            error = true;
            textoHtml += "<div class='alert alert-dismissable alert-danger'><h4>Error!</h4>";
            textoHtml += "<p>Campo edad m&iacute;nima obligarorio.</p></div>";
            $('#delete').prop('disabled', true);
        } else {
            var valor = parseInt(minEdad);
            if (isNaN(valor)) {
                error = true;
                textoHtml += "<div class='alert alert-dismissable alert-danger'><h4>Error!</h4>";
                textoHtml += "<p>Campo Edad m&iacute;ninima debe ser un n&uacute;mero.</p></div>";
                $('#delete').prop('disabled', true);
            }
        }
        if (maxEdad.length < 1) {
            error = true;
            textoHtml += "<div class='alert alert-dismissable alert-danger'><h4>Error!</h4>";
            textoHtml += "<p>Campo edad m&aacute;xima obligarorio.</p></div>";
            $('#delete').prop('disabled', true);
        } else {
            var valor = parseInt(maxEdad);
            if (isNaN(valor)) {
                error = true;
                textoHtml += "<div class='alert alert-dismissable alert-danger'><h4>Error!</h4>";
                textoHtml += "<p>Campo Edad m&aacute;xima debe ser un n&uacute;mero.</p></div>";
                $('#delete').prop('disabled', true);
            }
        }
        if (error === false) {
            var max = parseInt(maxEdad);
            var min = parseInt(minEdad);
            if (min >= max) {
                error = true;
                textoHtml += "<div class='alert alert-dismissable alert-danger'><h4>Error!</h4>";
                textoHtml += "<p>Campo edad M&iacute;nima mas grande o igual que el Campo Edad M&aacute;xima.</p></div>";
                $('#delete').prop('disabled', true);
            }
        }
        $('#bodyConfirm').html(textoHtml);
        $('#confirm').modal('toggle');
    }
//EDITAR CONFIGURACION
    function editConfirm(id) {
        descrip = $("#textEdit_" + id).val();
        minEdad = $("#minEdit_" + id).val();
        maxEdad = $("#maxEdit_" + id).val();
        //insertamos mediante ajax el nuevo registro
        url__ = '<?= site_url(array('adminConfiguracion', 'edit')) ?>/' + descrip;
        $.post(url__, {des: descrip, minEdad: minEdad, maxEdad: maxEdad, id: id}, function (respuesta) {
            nuevos();
        });
//});
    }
//BORRAR CONFIGURACION
//MEDIANTE AJAX BORRAMOS UN REGISTRO DE LA CONFIGURACION
    function borrar(id) {
        $('#data_id').val(id);//Guardamos el id
        $('#borrar_editar').val(2);//Asignamos el 1 para editar
        var URL = "<?= site_url(array('adminPOI', 'get_poiByConfiguracion_json')) ?>/" + id;
        var tam = 0;
        $.ajax({
            type: "GET",
            url: URL,
            async: false, //Ponemos que sea sincrono, es decir que espere a que termine la consulta AJAX
            dataType: "json",
            success: function (data) {
                tam = data.tam;
            }
        });
        var textoHtml = "¿Esta seguro de borrar esta Configuraci&oacute;n?<br>";
        $('#delete').prop('disabled', false);
        if (tam > 0) {
            textoHtml = "<div class='alert alert-dismissable alert-danger'><h4>Error!</h4>";
            textoHtml += "<p>No se puede borrar, tiene POI's asociados.</p></div>";

            $('#delete').prop('disabled', true);

        }
        $('#titleConfirm').html('Borrar Configuraci&oacute;n');
        $('#bodyConfirm').html(textoHtml);
        $('#confirm').modal('toggle');
    }
    function borrarConfirm(id) {
        $('#fila_' + id).slideUp('slow', function () {
            url__ = '<?= site_url(array('adminConfiguracion', 'delete')) ?>/' + id;
            $.ajax({
                url: url__,
            }).done(function () {
                $(this).addClass("done");
            });
        });
        cambiar(id);
    }


    $("#btn-new").click(function (e) {
        //obtenemos el nombre del nuevo registro
        descrip = $("#nuevo").val();
        minEdad = $("#minEdad").val();
        maxEdad = $("#maxEdad").val();
        textoHtml = "";
        var error = false;
        var textoHtml = "";
        if (descrip.length < 1) {
            error = true;
            textoHtml += "<div class='alert alert-dismissable alert-danger'><h4>Error!</h4>";
            textoHtml += "<p>Campo nuevo obligarorio.</p></div>";
        }
        if (minEdad.length < 1) {
            error = true;
            textoHtml += "<div class='alert alert-dismissable alert-danger'><h4>Error!</h4>";
            textoHtml += "<p>Campo edad m&iacute;nima obligarorio.</p></div>";
        } else {
            var valor = parseInt(minEdad);
            if (isNaN(valor)) {
                error = true;
                textoHtml += "<div class='alert alert-dismissable alert-danger'><h4>Error!</h4>";
                textoHtml += "<p>Campo Edad m&iacute;ninima debe ser un n&uacute;mero.</p></div>";
            }
        }
        if (maxEdad.length < 1) {
            error = true;
            textoHtml += "<div class='alert alert-dismissable alert-danger'><h4>Error!</h4>";
            textoHtml += "<p>Campo edad m&aacute;xima obligarorio.</p></div>";
        } else {
            var valor = parseInt(maxEdad);
            if (isNaN(valor)) {
                error = true;
                textoHtml += "<div class='alert alert-dismissable alert-danger'><h4>Error!</h4>";
                textoHtml += "<p>Campo Edad m&aacute;xima debe ser un n&uacute;mero.</p></div>";
            }
        }
        if (error === false) {
            var max = parseInt(maxEdad);
            var min = parseInt(minEdad);
            if (min >= max) {
                error = true;
                textoHtml += "<div class='alert alert-dismissable alert-danger'><h4>Error!</h4>";
                textoHtml += "<p>Campo edad M&iacute;nima mas grande o igual que el Campo Edad M&aacute;xima.</p></div>";
            }
        }
        if (error === true) {
            $('#bodyAlert').html(textoHtml);
            $('#modalAlert').modal('toggle');

        } else {
            //insertamos mediante ajax el nuevo registro
            url__ = '<?= site_url(array('adminConfiguracion', 'new_configuration')) ?>/' + descrip;
            $.post(url__, {des: descrip, minEdad: minEdad, maxEdad: maxEdad}, function (respuesta) {
                nuevos();
            });
        }
        //consultamos mediante ajax el nuevo registro
        //creamos una fila nueva con el nuevo registro.

    });
    function nuevos() {
        // Obtenemos el total de columnas (tr) del id "tabla"
        var trs = $("#table-content tr").length;
        while (trs > 0)
        {
            // Eliminamos la ultima columna
            $("#table-content tr:last").remove();
            trs = $("#table-content tr").length;
        }
        //OBTENEMOS LAS NUEVAS COLUMNAS POR MEDIO DE AJAX Y JSON
        var URL = "<?= site_url(array('adminConfiguracion', 'get_configurations_json')) ?>";
        $.getJSON(URL)
                .done(function (data) {
                    $.each(data, function (i, item) {
                        var nuevaFila = "<tr id='fila_" + item.conf_id + "'>";
                        nuevaFila += "<td>" + item.conf_id + "</td>";
                        nuevaFila += "<td><div id='noEdit" + item.conf_id + "' >" + item.conf_des + "</div>";
                        nuevaFila += "<div id='edit" + item.conf_id + "' style='display: none'><input type='text' class='form-control' placeholder='" + item.conf_des + "'  id='textEdit_" + item.conf_id + "'></div></td>";
                        nuevaFila += "<td><div id='noEditMin" + item.conf_id + "'>" + item.min_edad + "</div><div id='editMin" + item.conf_id + "' style='display: none'><input type='text' class='form-control' placeholder='" + item.min_edad + "'  id='minEdit_" + item.conf_id + "'></div></td>";
                        nuevaFila += "<td><div id='noEditMax" + item.conf_id + "'>" + item.max_edad + "</div><div id='editMax" + item.conf_id + "' style='display: none'><input type='text' class='form-control' placeholder='" + item.max_edad + "'  id='maxEdit_" + item.conf_id + "'></div></td>";
                        nuevaFila += "<td ><div id='botonesNoEdit" + item.conf_id + "'><button type='button' class='btn btn-info btn-fab btn-raised mdi-content-create' id='boton" + item.conf_id + "' onClick='cambiar(" + item.conf_id + ")' ></button></div>";
                        nuevaFila += "<div id='botonesEdit" + item.conf_id + "' style='display: none'>";
                        nuevaFila += "<button type='button' class='btn btn-warning btn-fab btn-raised  mdi-editor-border-color ' onClick='edit(" + item.conf_id + ")'></button>&nbsp;";
                        nuevaFila += "<button type='button' class='btn btn-danger btn-fab btn-raised  mdi-navigation-cancel' onClick='borrar(" + item.conf_id + ")'></button>&nbsp;";
                        nuevaFila += "<button type='button' class='btn btn-primary btn-fab btn-raised  mdi-navigation-arrow-back'  onClick='cambiar(" + item.conf_id + ")'></button></div></td>";
                        nuevaFila += "</tr>";
                        $(nuevaFila).appendTo('#table-content');

                    });
                });
        $("#nuevo").val("");
        $("#minEdad").val("");
        $("#maxEdad").val("");
    }
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>




