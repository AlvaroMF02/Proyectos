const DIR_SERV = "http://localhost/Proyectos/Unidad6/TeoriaServiciosWeb/primeraAPI/"

function llamada_get1() {
    $.ajax({
        url: DIR_SERV + "/saludo",
        dataType: "json",
        type: "GET"
    })

        .done(function (data) {
           $("#respuesta").html(data.mensaje)
        })

        .fail(function (a, b) {
            $("#respuesta").html(error_ajax_jquery(a, b))
        })

}

function llamada_get2() {

    let nombre = "pepe"

    $.ajax({
        url: DIR_SERV + "/saludo/" + nombre,
        dataType: "json",
        type: "GET"
    })

        .done(function (data) {
           $("#respuesta").html(data.mensaje)
        })

        .fail(function (a, b) {
            $("#respuesta").html(error_ajax_jquery(a, b))
        })

}

function llamada_post() {

    let nombre = "Porfirio"

    $.ajax({
        url: DIR_SERV + "/saludo",
        dataType: "json",
        type: "POST",
        data:{"nombre": nombre}
    })

        .done(function (data) {
           $("#respuesta").html(data.mensaje)
        })

        .fail(function (a, b) {
            $("#respuesta").html(error_ajax_jquery(a, b))
        })

}

function llamada_delete() {

    let id = 6
    $.ajax({
        url: DIR_SERV + "/borrarSaludo/" + id,
        dataType: "json",
        type: "DELETE"
    })

        .done(function (data) {
           $("#respuesta").html(data.mensaje)
        })

        .fail(function (a, b) {
            $("#respuesta").html(error_ajax_jquery(a, b))
        })

}

function llamada_put() {

    let id = 6
    let nombre = "Eusebio"

    $.ajax({
        url: DIR_SERV + "/actualizarSaludo/" + id,
        dataType: "json",
        type: "PUT",
        data:{"nombre": nombre}
    })

        .done(function (data) {
           $("#respuesta").html(data.mensaje)
        })

        .fail(function (a, b) {
            $("#respuesta").html(error_ajax_jquery(a, b))
        })

}

function obtener_prod() {
    $.ajax({
        url:"http://localhost/Proyectos/Unidad6/Actividades/Activ2/servicios_rest/productos",
        dataType: "json",
        type: "GET"
    })

        .done(function (data) {
            if(data.mensaje_error){
                $("#respuesta").html(data.mensaje_error)
            }else{

                let tablaProd = "<table>"
                tablaProd += "<tr><th>COD</th><th>Nombre corto</th><th>PVP</th></tr>"
                
                $.each(data.productos, function(key,tupla){
                    tablaProd += "<tr>"
                    tablaProd += "<td>"+tupla["cod"]+"</td>"
                    tablaProd += "<td>"+tupla["nombre_corto"]+"</td>"
                    tablaProd += "<td>"+tupla["PVP"]+"</td>"
                    tablaProd += "</tr>"
                })

                tablaProd += "</table>"
                $("#respuesta").html(tablaProd)
            }
           
        })

        .fail(function (a, b) {
            $("#respuesta").html(error_ajax_jquery(a, b))
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