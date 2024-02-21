const DIR_SERV = "http://localhost/Proyectos/Unidad6/Actividades/Activ2/servicios_rest"

$(document).ready(function(){
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
                    tablaProd += "<td>" + tupla["cod"] + "</td>"
                    tablaProd += "<td>" + tupla["nombre_corto"] + "</td>"
                    tablaProd += "<td>" + tupla["PVP"] + "</td>"
                    tablaProd += "<td> Borrar - Editar </td>"
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