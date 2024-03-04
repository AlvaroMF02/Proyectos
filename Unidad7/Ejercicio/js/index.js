const DIR_SERV = "http://localhost/Proyectos/Unidad7/Ejercicio/servicios_rest";

$(function () {
    mostrar_tabla()
})

// MUSTRA LA TABLA CON TODOS LOS PRODUCTOS DE LA BD
function mostrar_tabla () {
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
                tablaProd += "<tr><th>COD</th><th>Nombre corto</th><th>PVP</th><th><button class='enlace' onClick='formInsertar()'>Producto+</button></th></tr>"

                $.each(data.productos, function (key, tupla) {
                    tablaProd += "<tr>"
                    tablaProd += "<td><button class='enlace' onClick='verDetalle(\"" + tupla['cod'] + "\")'>" + tupla["cod"] + "</button></td>"
                    tablaProd += "<td>" + tupla["nombre_corto"] + "</td>"
                    tablaProd += "<td>" + tupla["PVP"] + "</td>"
                    tablaProd += "<td><button class='enlace' onClick='dudaBorr(\"" + tupla['cod'] + "\")'>Borrar</button> - "
                    tablaProd += "<button class='enlace' onClick=''>Editar</button></td>"
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

function formInsertar () {

    $.ajax({
        url: DIR_SERV + "/familias",
        dataType: "json",
        type: "GET"
    })
        .done(function (data) {
            if (data.mensaje_error) {
                $("#errores").html(data.mensaje_error)
                $("#detalles").html("")

            } else {
                let form = "<h2>Inserción</h2>"
                form += "<form onsubmit='event.preventDefault()'>"
                form += "<p><label>Código</label><input type='text' id='cod' required/></p>"
                form += "</form>"
                $("#detalles").html(form)

            }

        })

        .fail(function (a, b) {
            $("#detalles").html(error_ajax_jquery(a, b))
            mostrar_tabla()
        })



}

// VER DETALLES DE X PRODUCTO
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
            } else if (data.mensaje) {
                $("#detalles").html(data.mensaje_error)
            } else {
                detalle = "<p><strong>Codigo:</strong>" + codProd + "<br>"
                detalle += "<strong>Nombre corto:</strong>" + data["producto"]["nombre_corto"] + "<br>"
                detalle += "<strong>Descripción:</strong>" + data["producto"]["descripcion"] + "<br>"
                detalle += "<strong>PVP:</strong>" + data["producto"]["PVP"] + "<br>"
                detalle += "<strong>Familia:</strong>" + data["producto"]["familia"] + "</p>"
                detalle += "<button onClick='vaciar()'>Volver</button>"
            }

            $("#detalles").html(detalle)

        })

        .fail(function (a, b) {
            $("#detalles").html(error_ajax_jquery(a, b))
            mostrar_tabla()
        })

}

// PREGUNTA SI QUIERE BORRAR EL PRODUCTO
function dudaBorr (cod) {

    let texto = "¿Está seguro de que desea borrar el producto " + cod + "? <br>"
    texto += "<button onClick='vaciar()'>Volver</button> "
    texto += "<button onClick='borrar(\"" + cod + "\")'>Borrar</button>"

    $("#detalles").html(texto)
}

// BORRA EL PRODUCTO POR SI CÓDIGO
function borrar (cod) {
    $.ajax({
        url: DIR_SERV + "/producto/borrar/" + cod,
        dataType: "json",
        type: "DELETE"
    })
        .done(function (data) {
            $("#detalles").html("Producto borrado")
            location.reload()
        })

        .fail(function (a, b) {
            $("#errores").html(error_ajax_jquery(a, b))
        })
}

// PONE DETALLES VACIO
function vaciar () {
    $("#detalles").html("")
}

// ERROR DE AJAX
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