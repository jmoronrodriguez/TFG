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
 * @constructor
 * @extends {ol.control.Control}
 * @param {Object=} opt_options Control options.
 */
app.LeyendaControl = function (opt_options) {

    var options = opt_options || {};



    var onClickTipos = function (e) {
        consultarTipos();
        $('#confirm').modal('toggle');
    };
    var onClickBandos = function (e) {
        consultarBandos();
        $('#confirm').modal('toggle');
    };
    var onClickConfiguracion = function (e) {
        consultarConfiguracion();
        $('#confirm').modal('toggle');
    };
    var onClickRango = function (e) {
        consultarRango();
        //$('#leyendaRango').modal('toggle');
    };
    var buttonTipos = document.createElement('button');
    buttonTipos.innerHTML = 'T';
    buttonTipos.title = 'Tipos';
    buttonTipos.className = 'TipoButton';
    buttonTipos.addEventListener('click', onClickTipos, false);
    buttonTipos.addEventListener('touchend ', onClickTipos, false);

    var buttonBandos = document.createElement('button');
    buttonBandos.innerHTML = 'B';
    buttonBandos.title = 'Bando';
    buttonBandos.className = 'BandoButton';
    buttonBandos.addEventListener('click', onClickBandos, false);
    buttonBandos.addEventListener('touchend ', onClickBandos, false);

    var buttonConfiguracion = document.createElement('button');
    buttonConfiguracion.innerHTML = 'C';
    buttonConfiguracion.title = 'Configuracion';
    buttonConfiguracion.className = 'ConfiButton';
    buttonConfiguracion.addEventListener('click', onClickConfiguracion, false);
    buttonConfiguracion.addEventListener('touchend ', onClickConfiguracion, false);

    var buttonRango = document.createElement('button');
    buttonRango.innerHTML = 'R';
    buttonRango.title = 'Rango';
    buttonRango.className = 'RangoButton';
    buttonRango.addEventListener('click', onClickRango, false);
    buttonRango.addEventListener('touchend ', onClickRango, false);

    var element = document.createElement('div');
    element.className = 'leyendaControl ol-unselectable ol-control';
    element.title = 'Tipos';
    element.appendChild(buttonConfiguracion);
    element.appendChild(buttonTipos);
    element.appendChild(buttonBandos);
    element.appendChild(buttonRango);

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
/********FIN CAPA BASE********/

/**PROYECCION PRINCIPAL****************/
/**EPSG:3857--WGS84 Web Mercator*******/
var projPrin = ol.proj.get('EPSG:3857');

/******OBTENEMOS LAS CAPAS Y **********/
/****MARKERT MEDIANTE AJAX Y JSON******/
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
var map = new ol.Map({
    controls: ol.control.defaults({
        attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
            collapsible: false
        })
    }).extend([
        new app.LeyendaControl()
    ]),
    layers: [
        capaBase,
        mapasVisibildad,
        marketsLayer
    ],
    target: 'basicMap',
    view: new ol.View({
        projection: projPrin, //Utilizamos la proyeccion por defecto WGS84 Web Mercator UTM
        center: [-423014.1592, 4546636.6720],
        zoom: 7
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
    $(element).popover('destroy');
   
    var feature = map.forEachFeatureAtPixel(evt.pixel,
            function (feature, layer) {
                return feature;
            });
    if (feature) {
        
        
         crearPopOver(feature);
        
    }
});

// change mouse cursor when over marker
map.on('pointermove', function (e) {
    var pixel = map.getEventPixel(e.originalEvent);
    var hit = map.hasFeatureAtPixel(pixel);
    map.getTargetElement().style.cursor = hit ? 'pointer' : '';
});

$("#menu-toggle").click(function (e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});

$('.TipoButton, .BandoButton').tooltip({
    placement: 'right'
});
/********FUNCIONES DE APOYO********/

/**
 Contulta los bando mediante AJAX y lo coloca en la leyenda
 */
function consultarBandos() {
    var textoHtml = "";
    for (i = 0; i < arrayBandos.length; i++) {
        if (arrayBandos[i].seleccionado)
            textoHtml += "<div><button type='button' class='btn' id='buttonBandos_" + arrayBandos[i].id + "'  style='background:" + arrayBandos[i].color_bando + "; padding: 10px;' onClick='cambioBandos(" + arrayBandos[i].id + ");'></button> " + arrayBandos[i].des_bando + "</div>";
        else
            textoHtml += "<div><button type='button' class='btn buttonDeselec' id='buttonBandos_" + arrayBandos[i].id + "'  style='background:" + arrayBandos[i].color_bando + "; padding: 10px;' onClick='cambioBandos(" + arrayBandos[i].id + ");'></button> " + arrayBandos[i].des_bando + "</div>";
    }
    if (arrayBandos.length == 0) {
        textoHtml = 'Selecciona una configuracion primero';
    }
    $('#bodyConfirm').html(textoHtml);
    $('#titleConfirm').html("Leyenda Bandos");


}

function consultarTipos() {

    var textoHtml = "";
    for (i = 0; i < arrayTipos.length; i++) {
        if (arrayTipos[i].seleccionado)
            textoHtml += "<div><button type='button' class='btn' id='buttonTipos_" + arrayTipos[i].id + "'  style='background: url(./assets/img/IconsPOIs/tipoPOI_" + arrayTipos[i].id_tipo + ".png);background-size: 30px 30px; background-repeat: no-repeat; padding: 15px;' onClick='cambioTipos(" + arrayTipos[i].id + ");'></button> " + arrayTipos[i].des_tipo + "</div>";
        else
            textoHtml += "<div><button type='button' class='btn buttonDeselec' id='buttonTipos_" + arrayTipos[i].id + "'  style='background: url(./assets/img/IconsPOIs/tipoPOI_" + arrayTipos[i].id_tipo + ".png);background-size: 30px 30px; background-repeat: no-repeat; padding: 15px;' onClick='cambioTipos(" + arrayTipos[i].id + ");'></button> " + arrayTipos[i].des_tipo + "</div>";
    }
    if (arrayTipos.length == 0) {
        textoHtml = 'Selecciona una configuracion primero';
    }
    $('#bodyConfirm').html(textoHtml);
    $('#titleConfirm').html("Leyenda Tipos POI's");
}
function consultarConfiguracion() {
    var URL = "./index.php/adminConfiguracion/get_configurations_json";
    $.getJSON(URL)
            .done(function (data) {
                var textoHtml = '<div class="btn-group" data-toggle="buttons">';
                $.each(data, function (i, item) {
                    if (item.conf_id == configSelect) {
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
                $('#bodyConfirm').html(textoHtml);
                $('#titleConfirm').html("Leyenda Configuraciones");
                $("input[name=confOptions]:radio").bind("change", function () {
                    cambioConfiguracion($(this).val());
                });
            });

}
function cambioConfiguracion(id) {
    configSelect = id;
    arrayBandos.splice(0, arrayBandos.length);//Eliminamos todos los elementos
    arrayTipos.splice(0, arrayTipos.length);//Eliminamos todos los elementos
    arrayEdad.splice(0, arrayEdad.length);//Eliminamos todos los elementos
    var URL = "./index.php/adminPOI/cambioConfiguracion";
    $.getJSON(URL, {conf: id}, function (json) {
        crearSlider(json.confi);
        arrayEdad = [Number(json.confi.min_edad), Number(json.confi.max_edad)];
        var slider = document.getElementById('sliderLeyenda');
        var min = Number(json.confi.min_edad);
        var max = Number(json.confi.max_edad);
        slider.noUiSlider.set([min, max]);//reteamos el valor del silder a maximo y al minimo
        for (i = 0; i < json.bandos.length; i++) {
            var bando = {id: i, id_bando: Number(json.bandos[i].ban_id), des_bando: json.bandos[i].ban_des, color_bando: json.bandos[i].ban_color, seleccionado: true};
            arrayBandos.push(bando);
        }
        for (i = 0; i < json.tipoPOIs.length; i++) {
            var tipo = {id: i, id_tipo: Number(json.tipoPOIs[i].tipo_id), des_tipo: json.tipoPOIs[i].tipo_des, seleccionado: true};
            arrayTipos.push(tipo);
        }
        actualizarCapas();
    });

}
function cambioBandos(id) {
    $('#buttonBandos_' + id).toggleClass("buttonDeselec");
    arrayBandos[id].seleccionado = !(arrayBandos[id].seleccionado);
    actualizarCapas();

}
function cambioTipos(id) {
    $('#buttonTipos_' + id).toggleClass("buttonDeselec");
    arrayTipos[id].seleccionado = !(arrayTipos[id].seleccionado);
    actualizarCapas();

}
function consultarRango() {
    $('#leyendaRango').modal('toggle');
    if (configSelect != -1) {
        var URL = "./index.php/adminConfiguracion/get_configuration_json";//CONSULTAMOS LA CONFIGURACION MEDIANTE AJAX Y JSON
        $.ajax({
            type: "GET",
            url: URL,
            data: {conf: configSelect},
            async: false, //lo ponemos sincrono para que slider se cree y luego cambiemos su valor
            dataType: "json",
            success: function (data) {
                crearSlider(data);
            }
        });


    }
}

function actualizarCapas() {
    var URL = "./index.php/adminPOI/get_mapasBydata_json";
    //Limpiamos las capas
    arrayCapasMapas.clear();
    vectorSource.clear();

    $.post(URL, {conf: configSelect, bandos: arrayBandos, tipos: arrayTipos, rango: arrayEdad}, function (json) {
        var rJson = JSON.parse(json);
        $.each(rJson, function (i, item) {
            var coordinates = [item.poi_X, item.poi_Y];
            var iconFeature = new ol.Feature({
                geometry: new ol.geom.Point(coordinates),
                name: item.poi_des,
                population: 4000,
                rainfall: 500
            });
            var iconStyle2 = new ol.style.Style({
                image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                    anchor: [1, 1],
                    anchorXUnits: 'pixels',
                    anchorYUnits: 'pixels',
                    opacity: 1,
                    src: './assets/img/IconsPOIs/tipoPOI_' + item.tipo_id + '.png'
                }))
            });
            iconFeature.set('id', item.poi_id);//AÑADIMOS EL ID PARA PODER IDENTIFICARLO
            iconFeature.set('descrip', item.poi_des);
            iconFeature.set('tipoId', item.tipo_id);
            iconFeature.set('bandoId', item.bando_id);
            iconFeature.set('edadMax', item.poi_max);
            iconFeature.set('edadMin', item.poi_min);
            iconFeature.setStyle(iconStyle2);//Le añadimos el estilo segun el tipo de POI

            //CREAMOS EL ARRAY DE iconFeatures			
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
            arrayCapasMapas.push(newLayer);
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
    $('#leyendaRango').css('modal fade bs-example-modal-lg');
    $('#leyendaRango').css('modal-dialog modal-lg');
    $('#sliderLeyenda').css('height', '');
    if (window.innerHeight > window.innerWidth) {//Si la pantalla esta en vertical el slder tambien
        orientacion = 'vertical';
        direccion = 'rtl';
        $('#contentLeyendaRango').css('modal fade bs-example-modal-sm');
        $('#contentLeyendaRango').css('modal-dialog modal-sm');
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
        range: {// Slider can select '0' to '100'
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

function crearPopOver(featu){
    var URL = "./index.php/adminBandos/get_bando_json/"+featu.get('bandoId');
    var bando;
    var data;
    $.ajax({
        type: "GET",
        url: URL,
        data: data,
        async: false,
        dataType: "json",
        success: function(data) {
               bando=data;
        }
    });
    var URL = "./index.php/adminTipoPOI/get_tipoPOI_json/"+featu.get('tipoId');
    var tipo;
    $.ajax({
        type: "GET",
        url: URL,
        data: data,
        async: false,
        dataType: "json",
        success: function(data) {
               tipo=data;
        }
    });
    var element = popup.getElement();
    var rangoStr=[];
    var rangoPOI=[Number(featu.get('edadMin')), Number(featu.get('edadMax'))];
    for (i=0; i<2; i++){
        if (rangoPOI[i]<0){
            rangoStr[i]=(-1*rangoPOI[i])+' (A.C)';
        }else{
            rangoStr[i]=(rangoPOI[i])+' (D.C)';
        }        
    }
    var html="<div id='PopupCultura'><strong>Cultura:</strong> "+bando.description+" </div>"+
             "<div id='PopupRango'><strong>Rango:</strong>  "+rangoStr[0]+" - "+rangoStr[1]+"</div>"+
             "<div id='PopupTipo'><strong>Tipo:</strong> "+tipo.description+"</div>"+
             "<div><strong>Opacidad:"+
             "<div id='PopupSlider' style='margin:10px'></div>"+
             "<div id='PopupCheckBox'><button type='button' class='btn btn-info' id='btnCapa'>Activar</button> </div>";
            
    var geometry = featu.getGeometry();
    var coord = geometry.getCoordinates();
    $(element).popover({
            'placement': 'top',
            'animation': true,
            'html': true,
            'content': html
        });
    popup.setPosition(coord);
    $(element).popover('show');
    $('.popover-title').html(featu.get('descrip'));
    var softSlider = document.getElementById('PopupSlider');
    
    //Agregamo el evento clcik al boton de ocultar capa
    $("#btnCapa").bind("click", function(){
         ocultarCapa(featu.get('id'));
     });
    //onchange getOpacity
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
            softSlider.noUiSlider.set(capa.getOpacity()*100);
            capaSel=capa;
            if (capa.getVisible()){
                $('#btnCapa').html('Ocultar');
            }else{
                $('#btnCapa').html('Mostrar');
            }
        }
    }
    softSlider.noUiSlider.on('change', function (value) {
        capaSel.setOpacity(value/100);

    });
    
}

function ocultarCapa(idFeat){
    for (i = 0; i < arrayCapasMapas.getLength(); i++) {
        var capa = arrayCapasMapas.item(i);
        var id = capa.get('id');
        if (idFeat === id) {
            capa.setVisible(!capa.getVisible());
            if (capa.getVisible()){
                $('#btnCapa').html('Ocultar');
            }else{
                $('#btnCapa').html('Mostrar');
            }
        }
    }
}