const DIR_SERV = "http://localhost/Proyectos/Unidad7/Ejercicio/servicios_rest";

$(function(){
    obtener_prod()
})

function obtener_prod () {
    $.ajax({
        url: DIR_SERV + "/productos",
        dataType: "json",
        type: "GET"
    })
        .done(function (data) {
            if (data.mensaje_error) {
                $("#tabla").html(data.mensaje_error)
            } else {

                let tablaProd = "<table>"
                tablaProd += "<tr><th>COD</th><th>Nombre corto</th><th>PVP</th><th>Producto+</th></tr>"

                $.each(data.productos, function (key, tupla) {
                    tablaProd += "<tr>"
                    tablaProd += "<td><button class='enlace' onClick='verDetalle(\""+tupla['cod']+"\")'>" + tupla["cod"] + "</button></td>"
                    tablaProd += "<td>" + tupla["nombre_corto"] + "</td>"
                    tablaProd += "<td>" + tupla["PVP"] + "</td>"
                    tablaProd += "<td><button class='enlace' >Borrar</button> - "
                    tablaProd += "<button class='enlace' >Editar</button></td>"
                    tablaProd += "</tr>"
                })

                tablaProd += "</table>"
                $("#tabla").html(tablaProd)
            }

        })

        .fail(function (a, b) {
            $("#tabla").html(error_ajax_jquery(a, b))
        })

}
function verDetalle (codProd) {
    let detalle = ''
    $.ajax({
        url: DIR_SERV + "/producto/" + codProd,
        dataType: "json",
        type: "GET"
    })
        .done(function (data) {
            if (data.mensaje_error) {
                $("#detalles").html(data.mensaje_error)
            } else if(data.mensaje){
                $("#detalles").html(data.mensaje_error)
            }else{
                detalle = "<p><strong>Codigo:</strong>" + codProd + "<br>"
                detalle += "<strong>Nombre corto:</strong>" + data["producto"]["nombre_corto"] + "<br>"
                detalle += "<strong>Descripción:</strong>" + data["producto"]["descripcion"] + "<br>"
                detalle += "<strong>PVP:</strong>" + data["producto"]["PVP"] + "<br>"
                detalle += "<strong>Familia:</strong>" + data["producto"]["familia"] + "</p>"
            }

            $("#detalles").html(detalle)

        })

        .fail(function (a, b) {
            $("#detalles").html(error_ajax_jquery(a, b))
        })

}

function error_ajax_jquery (jqXHR, textStatus) {
    var respuesta;
    if (jqXHR.status === 0) {

        respuesta = 'Not connect: Verify Network.';

    } else if (jqXHR.status == 404) {

        respuesta = 'Requested page not found [404]';

    } else if (jqXHR.status == 500) {

        respuesta = 'Internal Server Error [500].';

    } else if (textStatus === 'parsererror') {

        respuesta = 'Requested JSON parse failed.';

    } else if (textStatus === 'timeout') {

        respuesta = 'Time out error.';

    } else if (textStatus === 'abort') {

        respuesta = 'Ajax request aborted.';

    } else {

        respuesta = 'Uncaught Error: ' + jqXHR.responseText;

    }
    return respuesta;
}