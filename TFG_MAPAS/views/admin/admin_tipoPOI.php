<div id="page-wrapper" style="overflow: auto;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">
                    <i class="mdi-maps-pin-drop"></i> Tipos POI's
                </h3>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?= site_url(array('admin')) ?>">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-bar-chart-o"></i> Tipos POI's
                    </li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <form enctype="multipart/form-data" id="formuploadajax" method="post">
                <div class="col-md-4"><input type='text' class='form-control' placeholder='nuevo' id='nuevo' name='des_nuevo'> </div>
                <div class="col-md-4"><input type="file" name="icono" id='icono' accept=".png"> </div>
                <div class="col-md-4"><button type='submit' class='btn btn-info btn-fab btn-raised mdi-content-add' id='btn-new'></button></div>
            </form>
        </div>
        <div class="row">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><b>Id</b></th>
                        <th><b>Descripci&oacute;n</b></th>
                        <th><b>Imagen</b></th>
                        <th><b>    </b></th>

                    </tr>
                </thead>
                <tbody id='table-content'> 

                    <?php
                    foreach ($tipoPOIs as $item) {

                        echo("<tr id='fila_" . $item->tipo_id . "'>");

                        echo("<td>" . $item->tipo_id . "</td>");
                        echo("<td><div id='noEdit" . $item->tipo_id . "' >" . $item->tipo_des . "</div>");
                        echo("<div id='edit" . $item->tipo_id . "' style='display: none'>");

                        echo ("<input type='text' class='form-control' placeholder='" . $item->tipo_des . "'  id='textEdit_" . $item->tipo_id . "'></div></td>");
                        echo("<td><div id='ImgNoEdit" . $item->tipo_id . "' ><img src='" . asset_url() . "img/IconsPOIs/tipoPOI_" . $item->tipo_id . ".png' height='50px'></div><div id='ImgEdit" . $item->tipo_id . "' style='display: none'><img src='" . asset_url() . "img/IconsPOIs/tipoPOI_" . $item->tipo_id . ".png' height='50px'>");
                        echo ("<form enctype='multipart/form-data' id='formEditar" . $item->tipo_id . "' method='post'>");
                        echo("<input type='file' name='icono" . $item->tipo_id . "' id='icono" . $item->tipo_id . "' accept='.png'></form></div></td>");
                        echo("<td ><div id='botonesNoEdit" . $item->tipo_id . "'><button type='button' class='btn btn-info btn-fab btn-raised mdi-content-create' id='boton" . $item->tipo_id . "' onClick='cambiar(" . $item->tipo_id . ")' > </button></div>");
                        echo("<div id='botonesEdit" . $item->tipo_id . "' style='display: none'>");
                        echo("<button type='button' class='btn btn-warning btn-fab btn-raised mdi-editor-border-color' onClick='edit(" . $item->tipo_id . ")'></button>&nbsp;");
                        echo("<button type='button' class='btn btn-danger btn-fab btn-raised  mdi-navigation-cancel'  onClick='borrar(" . $item->tipo_id . ")'></button>&nbsp;");
                        echo("<button type='button' class='btn btn-primary btn-fab btn-raised mdi-navigation-arrow-back'  onClick='cambiar(" . $item->tipo_id . ")'></div></td>");

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

<script>
    var verision = 1;
//FUNCION CAMBIAR BOTONES
    function cambiar(id) {
        $("#edit" + id).toggle();
        $("#noEdit" + id).toggle();
        $("#ImgEdit" + id).toggle();
        $("#ImgNoEdit" + id).toggle();
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
//EDITAR CONFIGURACION
    function edit(id) {
        $('#data_id').val(id);//Guardamos el id
        $('#borrar_editar').val(1);//Asignamos el 1 para editar
        $('#titleConfirm').html('Editar Tipo POI');
        var textoHtml = "¿Esta seguro de editar este Tipo POI?<br>";
        $('#delete').prop('disabled', false);
        if ($("#textEdit_" + id).val() == '') {
            textoHtml += "<div class='alert alert-dismissable alert-danger'><h4>Error!</h4>";
            textoHtml += "<p>El cambo descripci&oacute;n no puede estar vacio.</p></div>";

            $('#delete').prop('disabled', true);

        }
        $('#bodyConfirm').html(textoHtml);
        $('#confirm').modal('toggle');
    }

    function editConfirm(id) {
        verision++;
        var formData = new FormData($("#formEditar" + id)[0]);
        formData.append("tipo_id", id);
        formData.append("tipo_des", $("#textEdit_" + id).val());
        $.ajax({
            url: "<?= site_url(array('adminTipoPOI', 'edit')) ?>",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
                .done(function (res) {
                    nuevos();
                });

    }
    function borrar(id) {
        $('#data_id').val(id);//Guardamos el id
        $('#borrar_editar').val(2);//Asignamos el 1 para editar
        var URL = "<?= site_url(array('adminPOI', 'get_poiByTipo_json')) ?>/" + id;
        var tam = 0;
        $.ajax({
            type: "GET",
            url: URL,
            async: false,
            dataType: "json",
            success: function (data) {
                tam = data.tam;
            }
        });
        var textoHtml = "¿Esta seguro de borrar este Tipo?<br>";
        $('#delete').prop('disabled', false);
        if (tam > 0) {
            textoHtml = "<div class='alert alert-dismissable alert-danger'><h4>Error!</h4>";
            textoHtml += "<p>No se puede borrar, tiene POI's asociados.</p></div>";

            $('#delete').prop('disabled', true);

        }
        $('#bodyConfirm').html(textoHtml);
        $('#titleConfirm').html('Borrar Tipo POI');
        $('#confirm').modal('toggle');
    }

//BORRAR CONFIGURACION
//MEDIANTE AJAX BORRAMOS UN REGISTRO DE LA CONFIGURACION
    function borrarConfirm(id) {
        $('#fila_' + id).slideUp('slow', function () {
            url__ = '<?= site_url(array('adminTipoPOI', 'delete')) ?>/' + id;
            $.ajax({
                url: url__,
            }).done(function () {
                $(this).addClass("done");
            });
        });
        cambiar(id);
    }

//Nuevo tipo POI
    $("#formuploadajax").on("submit", function (e) {
        e.preventDefault();
        var error = false;
        var textoHtml = "";
        if ($('#nuevo').val().length < 1) {
            error = true;
            textoHtml += "<div class='alert alert-dismissable alert-danger'><h4>Error!</h4>";
            textoHtml += "<p>Campo nuevo obligarorio.</p></div>";
        }
        if ($('#icono').val().length < 1) {
            error = true;
            textoHtml += "<div class='alert alert-dismissable alert-danger'><h4>Error!</h4>";
            textoHtml += "<p>Campo Imagen obligarorio.</p></div>";
        }
        if (error === true) {
            $('#bodyAlert').html(textoHtml);
            $('#modalAlert').modal('toggle');

        } else {
            var f = $(this);
            var formData = new FormData(document.getElementById("formuploadajax"));
            $.ajax({
                url: "<?= site_url(array('adminTipoPOI', 'new_tipoPOI')) ?>",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done(function (res) {
                console.log(res);
                nuevos();
            });
        }


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
        var URL = "<?= site_url(array('adminTipoPOI', 'get_tipoPOIs_json')) ?>";
        $.getJSON(URL)
                .done(function (data) {
                    $.each(data, function (i, item) {
                        var nuevaFila = "<tr id='fila_" + item.tipo_id + "'>";
                        nuevaFila += "<td>" + item.tipo_id + "</td>";
                        nuevaFila += "<td><div id='noEdit" + item.tipo_id + "' >" + item.tipo_des + "</div>";
                        nuevaFila += "<div id='edit" + item.tipo_id + "' style='display: none'><input type='text' class='form-control' placeholder='" + item.tipo_des + "'  id='textEdit_" + item.tipo_id + "'></div></td>";
                        nuevaFila += "<td><div id='ImgNoEdit" + item.tipo_id + "' ><img src='<?= asset_url() ?>img/IconsPOIs/tipoPOI_" + item.tipo_id + ".png?" + verision + ".0' height='50px'></div><div id='ImgEdit" + item.tipo_id + "' style='display: none'><img src='<?= asset_url() ?>img/IconsPOIs/tipoPOI_" + item.tipo_id + ".png?" + verision + ".0' height='50px'>";
                        nuevaFila += "<form enctype='multipart/form-data' id='formEditar" + item.tipo_id + "' method='post'>";
                        nuevaFila += "<input type='file' name='icono" + item.tipo_id + "' id='icono" + item.tipo_id + "' accept='.png'></form></div></td>";
                        nuevaFila += "<td ><div id='botonesNoEdit" + item.tipo_id + "'><button type='button' class='btn btn-info btn-fab btn-raised mdi-content-create' id='boton" + item.tipo_id + "' onClick='cambiar(" + item.tipo_id + ")' > </button></div>";
                        nuevaFila += "<div id='botonesEdit" + item.tipo_id + "' style='display: none'>";
                        nuevaFila += "<button type='button' class='btn btn-warning btn-fab btn-raised  mdi-editor-border-color ' onClick='edit(" + item.tipo_id + ")'></button>&nbsp;";
                        nuevaFila += "<button type='button' class='btn btn-danger btn-fab btn-raised  mdi-navigation-cancel' onClick='borrar(" + item.tipo_id + ")'></button>&nbsp;";
                        nuevaFila += "<button type='button' class='btn btn-primary btn-fab btn-raised  mdi-navigation-arrow-back'  onClick='cambiar(" + item.tipo_id + ")'></div></td>";
                        nuevaFila += "</tr>";
                        $(nuevaFila).appendTo('#table-content');

                    });
                });
        $("#nuevo").val("");
        $("#icono").val("");
    }
</script>
<script>
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>



