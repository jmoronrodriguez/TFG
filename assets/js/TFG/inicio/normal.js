/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**variables Globales**/
var configSelect = -1;
var arrayBandos = [];
var arrayTipos = [];
var arrayEdad = [];
/**CONTROL DE LA LEYENDA***/

/**
 * Define a namespace for the application.
 */
window.app = {};
var app = window.app;

/**
 * @constructor Controles de la leyenda.
 * @extends {ol.control.Control}
 * @param {Object=} opt_options Control options.
 */
app.LeyendaControl = function (opt_options) {

    var options = opt_options || {};


    /*Eventos onclick y touchend de los botones*/
    var onClickTipos = function (e) {
        consultarTipos();
        $('#leyenda').modal('toggle');
    };
    var onClickBandos = function (e) {
        consultarBandos();
        $('#leyenda').modal('toggle');
    };
    var onClickConfiguracion = function (e) {
        consultarConfiguracion();
        $('#leyenda').modal('toggle');
    };
    var onClickRango = function (e) {
        consultarRango();
        //$('#leyendaRango').modal('toggle');
    };
    var onClickInformacion = function (e) {
        consultarInformacion();
        $('#leyenda').modal('toggle');
    };
    /*Creacion de los botones*/
    var buttonTipos = document.createElement('button');
    buttonTipos.innerHTML = '';
    buttonTipos.title = 'Tipos';
    buttonTipos.className = 'TipoButton mdi-maps-pin-drop';
    buttonTipos.addEventListener('click', onClickTipos, false);
    buttonTipos.addEventListener('touchend ', onClickTipos, false);

    var buttonBandos = document.createElement('button');
    buttonBandos.innerHTML = '';
    buttonBandos.title = 'Culturas';
    buttonBandos.className = 'BandoButton mdi-image-assistant-photo';
    buttonBandos.addEventListener('click', onClickBandos, false);
    buttonBandos.addEventListener('touchend ', onClickBandos, false);

    var buttonConfiguracion = document.createElement('button');
    buttonConfiguracion.innerHTML = '';
    buttonConfiguracion.title = 'Configuracion ';
    buttonConfiguracion.className = 'ConfiButton mdi-action-settings';
    buttonConfiguracion.addEventListener('click', onClickConfiguracion, false);
    buttonConfiguracion.addEventListener('touchend ', onClickConfiguracion, false);

    var buttonRango = document.createElement('button');
    buttonRango.innerHTML = '';
    buttonRango.title = 'Rango';
    buttonRango.className = 'RangoButton mdi-image-tune';
    buttonRango.addEventListener('click', onClickRango, false);
    buttonRango.addEventListener('touchend ', onClickRango, false);

    var buttonInfo = document.createElement('button');
    buttonInfo.innerHTML = '';
    buttonInfo.title = 'Informacion ';
    buttonInfo.className = 'InfoButton mdi-action-info-outline';
    buttonInfo.addEventListener('click', onClickInformacion, false);
    buttonInfo.addEventListener('touchend ', onClickInformacion, false);
    /*Creamos el div que contedra los botones*/
    var element = document.createElement('div');
    element.className = 'leyendaControl ol-unselectable ol-control';
    element.title = 'Tipos';
    element.appendChild(buttonConfiguracion);
    element.appendChild(buttonTipos);
    element.appendChild(buttonBandos);
    element.appendChild(buttonRango);
    element.appendChild(buttonInfo);
    /*Asignamos los controles al mapa*/
    ol.control.Control.call(this, {
        element: element,
        target: options.target
    });

};
ol.inherits(app.LeyendaControl, ol.control.Control);



/***DEFINIMOS LA PROYECCION ED50 USO 30N*****/
proj4.defs("EPSG:23030", "+proj=utm +zone=30 +ellps=intl" +
        " +towgs84=-131,-100.3,-163.4,-1.244,-0.020,-1.144,9.39 " +
        " +units=m +no_defs");

/*********CAPA BASE***********/
var capaBase = new ol.layer.Tile({
    source: new ol.source.OSM()
});

/**PROYECCION PRINCIPAL****************/
/**EPSG:3857--WGS84 Web Mercator*******/
var projPrin = ol.proj.get('EPSG:3857');


var arrayCapasMapas = new ol.Collection();//ARRAY PARA LAS CAPAS
var vectorSource = new ol.source.Vector({//VECTOR PARA LOS MARKET
    //create empty vector
});


//**CREAMOS LA CAPA CON EL CONJUNTO DE CAPAS***/
var mapasVisibildad = new ol.layer.Group({
    layers: arrayCapasMapas
});

//CREAMOS LA CAPA DE MARKETS
var marketsLayer = new ol.layer.Vector({
    source: vectorSource
});
/**Mapa de la aplicacion.**/
var map = new ol.Map({
    controls: ol.control.defaults({//Controles del mapa.
        attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
            collapsible: false
        })
    }).extend([
        new app.LeyendaControl()
    ]),
    layers: [ //Capas del mapa.
        capaBase,
        mapasVisibildad,
        marketsLayer
    ],
    target: 'basicMap', //Div donde se renderizara el mapa.
    view: new ol.View({
        projection: projPrin, //Utilizamos la proyeccion por defecto WGS84 Web Mercator UTM
        center: [-423014.1592, 4546636.6720],//Centro del mapa
        zoom: 7 //Nivel de ZOOM
    })
});

//Añadimos el POPUP Al mapa
var popup = new ol.Overlay({
    element: document.getElementById('popup')
});
map.addOverlay(popup);
//Evento Clck Mapa
map.on('click', function (evt) {
    var element = popup.getElement();
    $(element).popover('destroy');//Eliminamos el popover si existe

    var feature = map.forEachFeatureAtPixel(evt.pixel,
            function (feature, layer) {
                return feature;
            });
    if (feature) {//Si es un marker creamos el popover.
        crearPopOver(feature);

    }
});

// Si el cursor se posiciona en un marker cambio del icono.
map.on('pointermove', function (e) {
    var pixel = map.getEventPixel(e.originalEvent);
    var hit = map.hasFeatureAtPixel(pixel);
    map.getTargetElement().style.cursor = hit ? 'pointer' : '';
});
// abrir y cerrar el menu del navbar contraida.
$("#menu-toggle").click(function (e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
//Tooltip de los botones de la leyenda, a la derecha
$('.TipoButton, .ConfiButton, .BandoButton, .RangoButton, .InfoButton').tooltip({
    placement: 'right'
});
/********FUNCIONES DE APOYO********/

/**
 Recorremos el Array de bandos para crear el modal de la leyenda
 */
function consultarBandos() {
    var textoHtml = "";
    for (i = 0; i < arrayBandos.length; i++) {
        if (arrayBandos[i].seleccionado)//Si esta seleccionado le ponemos color
            textoHtml += "<div><button type='button' class='btn' id='buttonBandos_" + arrayBandos[i].id + "'  style='background:" + arrayBandos[i].color_bando + "; padding: 10px;' onClick='cambioBandos(" + arrayBandos[i].id + ");'></button> " + arrayBandos[i].des_bando + "</div>";
        else
            textoHtml += "<div><button type='button' class='btn buttonDeselec' id='buttonBandos_" + arrayBandos[i].id + "'  style='background:" + arrayBandos[i].color_bando + "; padding: 10px;' onClick='cambioBandos(" + arrayBandos[i].id + ");'></button> " + arrayBandos[i].des_bando + "</div>";
    }
    if (arrayBandos.length == 0) {
        textoHtml = 'Selecciona una configuraci&oacute;n primero';//Si no hay ninguna configuración avisamos
    }
    $('#bodyConfirm').html(textoHtml);//HTML del modal
    $('#titleConfirm').html("Leyenda Culturas");//Titulo del modal
    $('#leyenda').removeClass();//Eliminamos las clases CSS que hubieran
    $('#contentLeyenda').removeClass();
    $('#leyenda').addClass('modal fade bs-example-modal-sm');//Le asignamos la clase al modal pequeña.
    $('#contentLeyenda').addClass('modal-dialog modal-sm');


}
/**
 * Recorremos el array de tipos para crear el modal de la leyenda.
 * @returns void 
 */
function consultarTipos() {

    var textoHtml = "";
    for (i = 0; i < arrayTipos.length; i++) {
        if (arrayTipos[i].seleccionado)//Si esta seleccionado le ponemos el icono
            textoHtml += "<div><button type='button' class='btn' id='buttonTipos_" + arrayTipos[i].id + "'  style='background: url(./assets/img/IconsPOIs/tipoPOI_" + arrayTipos[i].id_tipo + ".png);background-size: 30px 30px; background-repeat: no-repeat; padding: 15px;' onClick='cambioTipos(" + arrayTipos[i].id + ");'></button> " + arrayTipos[i].des_tipo + "</div>";
        else
            textoHtml += "<div><button type='button' class='btn buttonDeselec' id='buttonTipos_" + arrayTipos[i].id + "'  style='background: url(./assets/img/IconsPOIs/tipoPOI_" + arrayTipos[i].id_tipo + ".png);background-size: 30px 30px; background-repeat: no-repeat; padding: 15px;' onClick='cambioTipos(" + arrayTipos[i].id + ");'></button> " + arrayTipos[i].des_tipo + "</div>";
    }
    if (arrayTipos.length == 0) {//Si no hay ninguna configuración avisamos
        textoHtml = 'Selecciona una configuraci&oacute;n primero';
    }
    $('#leyenda').removeClass();//Eliminamos las clases CSS que hubieran
    $('#contentLeyenda').removeClass();
    $('#leyenda').addClass('modal fade bs-example-modal-sm');
    $('#contentLeyenda').addClass('modal-dialog modal-sm');//Le asignamos la clase al modal pequeña
    $('#bodyConfirm').html(textoHtml);//HTML del modal
    $('#titleConfirm').html("Leyenda Tipos POI's");//Titulo del modal
}
function consultarInformacion() {
    var textoHtml = '<ul>' +
            '<li><i class="mdi-action-settings"></i> Muestra las configuraciones posibles para poder elegirlas.</li>' +
            '<li><i class="mdi-image-assistant-photo"></i> Muestra las culturas posibles para poder elegirlas.</li>' +
            '<li><i class="mdi-maps-pin-drop"></i> Muestra los Tipos POI posibles para poder elegirlos.</li>' +
            '<li><i class="mdi-image-tune"></i> Muestra el rango de edades seleccionado.</li>' +
            '</ul>';
    $('#leyenda').removeClass();
    $('#contentLeyenda').removeClass();
    $('#leyenda').addClass('modal fade');
    $('#contentLeyenda').addClass('modal-dialog');//Le asignamos la clase al modal normal
    $('#bodyConfirm').html(textoHtml);//HTML del modal
    $('#titleConfirm').html("Informaci&oacute;n");//Titulo del modal

}
/**
 * Consultamos las configuraciones mediante AJAX y creamos el modal.
 * @returns {void}
 */
function consultarConfiguracion() {
    var URL = "./index.php/adminConfiguracion/get_configurations_json";//URL del JSON de las configuracions
    $.getJSON(URL)
            .done(function (data) {
                var textoHtml = '<div class="btn-group" data-toggle="buttons">';
                $.each(data, function (i, item) {//For each para crear las distintas configuraciones.
                    if (item.conf_id == configSelect) {//Si esta seleccionado 
                        textoHtml += '<div><label class="btn active ">';
                        textoHtml += '<input type="radio" name="confOptions" id="option_' + item.conf_id + '" autocomplete="off" value="' + item.conf_id + '" checked> ' + item.conf_des + ' ';
                        textoHtml += '</label></div>';
                    } else {
                        textoHtml += '<div><label class="btn  ">';
                        textoHtml += '<input type="radio" name="confOptions" id="option_' + item.conf_id + '" autocomplete="off" value="' + item.conf_id + '"> ' + item.conf_des + ' ';
                        textoHtml += '</label></div>';
                    }



                });
                textoHtml += '</div>';
                $('#leyenda').removeClass();
                $('#contentLeyenda').removeClass();
                $('#leyenda').addClass('modal fade bs-example-modal-sm');
                $('#contentLeyenda').addClass('modal-dialog modal-sm');
                $('#bodyConfirm').html(textoHtml);
                $('#titleConfirm').html("Leyenda Configuraciones");
                $("input[name=confOptions]:radio").bind("change", function () {//Asignamos el evento onChange a los input del modal creado.
                    cambioConfiguracion($(this).val());
                });
            });

}
/**
 * Funcion para reiniciar las variables locales por el cambio de la configuración.
 * @param {type} id Ide de la configuracion.
 * @returns {undefined}
 */
function cambioConfiguracion(id) {
    configSelect = id;
    arrayBandos.splice(0, arrayBandos.length);//Eliminamos todos los elementos
    arrayTipos.splice(0, arrayTipos.length);//Eliminamos todos los elementos
    arrayEdad.splice(0, arrayEdad.length);//Eliminamos todos los elementos
    var URL = "./index.php/adminPOI/cambioConfiguracion";
    $.getJSON(URL, {conf: id}, function (json) {
        crearSlider(json.confi);
        arrayEdad = [Number(json.confi.min_edad), Number(json.confi.max_edad)];//Array del rango de edad.
        var slider = document.getElementById('sliderLeyenda');
        var min = Number(json.confi.min_edad);
        var max = Number(json.confi.max_edad);
        slider.noUiSlider.set([min, max]);//seteamos el valor del silder a maximo y al minimo
        for (i = 0; i < json.bandos.length; i++) {//Creamos el array de Culturas
            var bando = {id: i, id_bando: Number(json.bandos[i].ban_id), des_bando: json.bandos[i].ban_des, color_bando: json.bandos[i].ban_color, seleccionado: true};
            arrayBandos.push(bando);
        }
        for (i = 0; i < json.tipoPOIs.length; i++) {//Creamos el array de tipos de POI's
            var tipo = {id: i, id_tipo: Number(json.tipoPOIs[i].tipo_id), des_tipo: json.tipoPOIs[i].tipo_des, seleccionado: true};
            arrayTipos.push(tipo);
        }
        actualizarCapas();//Actualizamos las capas del mapa.
    });

}
/**
 * Funcion para actualizar el array y las capas de las culturas
 * @param {type} id
 * @returns {undefined}
 */
function cambioBandos(id) {
    $('#buttonBandos_' + id).toggleClass("buttonDeselec");//Cambiamos la clase
    arrayBandos[id].seleccionado = !(arrayBandos[id].seleccionado);//Invertimos el valor
    actualizarCapas();//Actualizamos las capas

}/**
 * Funcion para actualizar el array y las capas de los tipos
 * @param {type} id
 * @returns {undefined}
 */
function cambioTipos(id) {
    $('#buttonTipos_' + id).toggleClass("buttonDeselec");
    arrayTipos[id].seleccionado = !(arrayTipos[id].seleccionado);
    actualizarCapas();

}
/**
 * Crea el slider y el modal del rango.
 * @returns {undefined}
 */
function consultarRango() {

    if (configSelect === -1) {//Si no hay configuracion seleccionada avisamos.
        $('#bodyConfirm').html("Selecciona una configuraci&oacute;n primero");
        $('#titleConfirm').html("Leyenda Rango");
        $('#leyenda').removeClass();
        $('#contentLeyenda').removeClass();
        $('#leyenda').addClass('modal fade bs-example-modal-sm');
        $('#contentLeyenda').addClass('modal-dialog modal-sm');
        $('#leyenda').modal('toggle');
    } else {
        //Abrimos el modal
        $('#leyendaRango').modal('toggle');
        var URL = "./index.php/adminConfiguracion/get_configuration_json";//CONSULTAMOS LA CONFIGURACION MEDIANTE AJAX Y JSON
        $.ajax({
            type: "GET",
            url: URL,
            data: {conf: configSelect},
            async: false, //lo ponemos sincrono para que slider se cree y luego cambiemos su valor
            dataType: "json",
            success: function (data) {
                crearSlider(data);//Creamos el slider.
            }
        });


    }
}
/**
 * Funcion para actualizar las capas del mapa.
 * @returns {undefined}
 */
function actualizarCapas() {
    var URL = "./index.php/adminPOI/get_mapasBydata_json";
    //Limpiamos las capas
    arrayCapasMapas.clear();
    vectorSource.clear();
    //consultamos mediante AJAX las capas visibles.
    $.post(URL, {conf: configSelect, bandos: arrayBandos, tipos: arrayTipos, rango: arrayEdad}, function (json) {
        var rJson = JSON.parse(json);
        $.each(rJson, function (i, item) {//For each de cada POI.
            var coordinates = [item.poi_X, item.poi_Y];//Guardamos las coordenadas
            var iconFeature = new ol.Feature({//Creamos el marker
                geometry: new ol.geom.Point(coordinates),
                name: item.poi_des,
                population: 4000,
                rainfall: 500
            });
            var iconStyle2 = new ol.style.Style({//Creamos el estilo (icono) del marker
                image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                    anchor: [1, 1],
                    anchorXUnits: 'pixels',
                    anchorYUnits: 'pixels',
                    opacity: 1,
                    src: './assets/img/IconsPOIs/tipoPOI_' + item.tipo_id + '.png'
                }))
            });
            iconFeature.set('id', item.poi_id);//AÑADIMOS EL ID PARA PODER IDENTIFICARLO Y MAS INFORMACION NECESARIA
            iconFeature.set('descrip', item.poi_des);
            iconFeature.set('tipoId', item.tipo_id);
            iconFeature.set('bandoId', item.bando_id);
            iconFeature.set('edadMax', item.poi_max);
            iconFeature.set('edadMin', item.poi_min);
            iconFeature.setStyle(iconStyle2);//Le añadimos el estilo segun el tipo de POI

            //AÑADIMOS EL MARKER AL ARRAY DE iconFeatures			
            vectorSource.addFeature(iconFeature);
            //CREMOS LA BOUNDIND BOX DE LA IMAGEN [minX, minY, MaxX, MaxY] 
            var extent = [item.minX, item.minY, item.maxX, item.maxY];
            //CREAMOS LA CAPA
            var newLayer = new ol.layer.Image({
                source: new ol.source.ImageStatic({
                    url: './assets/visibilityMaps/map_' + item.poi_id + '.png',
                    imageExtent: ol.proj.transformExtent(extent, 'EPSG:23030', 'EPSG:3857'), //Transformamos la BB de ED50 a WGS84 Web Mercator
                    projection: projPrin
                })
            });
            newLayer.set('id', item.poi_id);//AÑADIMOS EL ID PARA PODER IDENTIFICARLO
            newLayer.setOpacity(0.85);
            newLayer.setHue(3.14);
            arrayCapasMapas.push(newLayer);//INTRODUCIMOS LA CAPA AL ARRAY
        });
    });

}

/**DESTRUYE EL SLIDER Y CREA UNO NUEVO CON LA CONFIGURACION PASADA POR PARAMETRO***/
/**
 * 
 * @param {type} json
 * @returns {void} 
 */
function crearSlider(json) {
    // Dependiendo de la orentacion de la pantalla asi sera del slder

    var orientacion = 'horizontal';//Por defecto horizontal
    var direccion = 'ltr';
    $('#leyendaRango').removeClass();
    $('#contentLeyendaRango').removeClass();
    $('#leyendaRango').addClass('modal fade bs-example-modal-lg');
    $('#contentLeyendaRango').addClass('modal-dialog modal-lg');
    $('#sliderLeyenda').css('height', '');
    if (window.innerHeight > window.innerWidth) {//Si la pantalla esta en vertical el slder tambien
        orientacion = 'vertical';
        direccion = 'rtl';
        $('#leyendaRango').removeClass();
        $('#contentLeyendaRango').removeClass();
        $('#leyendaRango').addClass('modal fade bs-example-modal-sm');
        $('#contentLeyendaRango').addClass('modal-dialog modal-sm');
        $('#sliderLeyenda').css('height', '74%');
    }
    var slider = document.getElementById('sliderLeyenda');
    try {
        slider.noUiSlider.destroy();
    } catch (error) {
    }
    noUiSlider.create(slider, {
        start: [json.min_edad, json.max_edad], // Handle start position
        step: 10,
        connect: true, // Display a colored bar between the handles
        direction: direccion,
        orientation: orientacion,
        behaviour: 'tap-drag', // Move handle on tap, bar is draggable
        range: {// Rango del slider
            'min': Number(json.min_edad),
            'max': Number(json.max_edad)
        }

    });
    //**LINSTENER DEL SLIDER****/ 
    var MinInput = document.getElementById('minEdad'),
            MaxInput = document.getElementById('maxEdad');
    slider.noUiSlider.set(arrayEdad);
    // When the slider value changes, update the input and span
    slider.noUiSlider.on('update', function (values, handle) {
        //Formateamos las edades con el sufijo (A.C) para las negativoas y (D.C) para las positivas.
        var strValues = values[handle] + '(D.C)';
        if (values[handle] < 0) {
            strValues = ((-1) * values[handle]) + '(A.C)';
        }

        if (handle) {
            MaxInput.innerHTML = strValues;
        } else {
            MinInput.innerHTML = strValues;
        }

    });

    slider.noUiSlider.on('change', function (values, handle) {
        $('#MinEdad').val(values[0]);
        $('#MaxEdad').val(values[1]);
        arrayEdad = values;
        actualizarCapas();

    });



}
/**
 * Creamos el popover del marker
 * @param {type} featu Objeto feature (marker) creado antes.
 * @returns {undefined}
 */
function crearPopOver(featu) {
    var URL = "./index.php/adminBandos/get_bando_json/" + featu.get('bandoId');
    var bando;
    var data;
    $.ajax({
        type: "GET",
        url: URL,
        data: data,
        async: false,//Lo ponemos asincrono para poder optener la cultura.
        dataType: "json",
        success: function (data) {
            bando = data;
        }
    });
    var URL = "./index.php/adminTipoPOI/get_tipoPOI_json/" + featu.get('tipoId');
    var tipo;
    $.ajax({
        type: "GET",
        url: URL,
        data: data,
        async: false,//Lo ponemos asincrono para poder optener el tipo
        dataType: "json",
        success: function (data) {
            tipo = data;
        }
    });
    var element = popup.getElement();
    //Creamos las cadenas de las edades
    var rangoStr = [];
    var rangoPOI = [Number(featu.get('edadMin')), Number(featu.get('edadMax'))];
    for (i = 0; i < 2; i++) {
        if (rangoPOI[i] < 0) {
            rangoStr[i] = (-1 * rangoPOI[i]) + ' (A.C)';
        } else {
            rangoStr[i] = (rangoPOI[i]) + ' (D.C)';
        }
    }
    //Creamos el HTML del popover
    var html = "<div id='PopupCultura'><strong>Cultura:</strong> " + bando.description + " </div>" +
            "<div id='PopupRango'><strong>Rango:</strong>  " + rangoStr[0] + " - " + rangoStr[1] + "</div>" +
            "<div id='PopupTipo'><strong>Tipo:</strong> " + tipo.description + "</div>" +
            "<div><strong>Opacidad <label id='opacidad'></label>" +
            "<div id='PopupSlider' style='margin:10px'></div>" +
            "<div id='PopupCheckBox'><button type='button' class='btn btn-info' id='btnCapa'>Activar</button> </div>";

    var geometry = featu.getGeometry();
    var coord = geometry.getCoordinates();
    $(element).popover({
        'placement': 'top',
        'animation': true,
        'html': true,
        'content': html
    });
    popup.setPosition(coord);//Coordenadas del marker
    $(element).popover('show');//Mostramos el popover
    $('.popover-title').html(featu.get('descrip'));
    var softSlider = document.getElementById('PopupSlider');

    //Agregamo el evento clcik al boton de ocultar capa
    $("#btnCapa").bind("click", function () {
        ocultarCapa(featu.get('id'));
    });
    //Creamos el slider de la transparencia.
    noUiSlider.create(softSlider, {
        start: 50,
        range: {
            min: 0,
            max: 100
        }
    });
    var capaSel;
    for (i = 0; i < arrayCapasMapas.getLength(); i++) {
        var capa = arrayCapasMapas.item(i);
        var id = capa.get('id');
        if (featu.get('id') === id) {
            softSlider.noUiSlider.set(capa.getOpacity() * 100);
            capaSel = capa;
            if (capa.getVisible()) {
                $('#btnCapa').html('Ocultar');
            } else {
                $('#btnCapa').html('Mostrar');
            }
            $('#opacidad').html(capa.getOpacity() * 100+"%");
        }
    }
    //Evento del slider de la opacidad
    softSlider.noUiSlider.on('change', function (value) {
        capaSel.setOpacity(value / 100);
        $('#opacidad').html(value+"%");

    });

}
/**
 * Oculta la capa con el id seleccionado.
 * @param {type} idFeat
 * @returns {undefined}
 */
function ocultarCapa(idFeat) {
    for (i = 0; i < arrayCapasMapas.getLength(); i++) {//Buscamos la capa en el array
        var capa = arrayCapasMapas.item(i);
        var id = capa.get('id');
        if (idFeat === id) {
            capa.setVisible(!capa.getVisible());//Ocultamos la capa
            if (capa.getVisible()) {//Cambiamos el texto del boton.
                $('#btnCapa').html('Ocultar');
            } else {
                $('#btnCapa').html('Mostrar');
            }
        }
    }
}
