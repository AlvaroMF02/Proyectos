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

// -------------------------------------------------------------------------------------

async function formInsertar () {
    vaciar()
    let formulario = `<form onsubmit='crearProducto(event)' method='post' action='.'>
                      <h2>Añadir un producto</h2>
                      <p>
                        <label for='cod'><strong>Código: </strong></label><input type='text' name='cod' id='cod' required />
                        <span class='error'></span>
                      </p>
                      <p>
                        <label for='nombre'><strong>Nombre: </strong></label><input type='text' name='nombre' id='nombre' />
                        <span class='error'></span>
                      </p>
                      <p>
                        <label for='nombre_cor'><strong>Nombre corto: </strong></label><input type='text' name='nombre_cor' id='nombre_cor' required/>
                        <span class='error'></span>
                      </p>
                      <p>
                        <label for='desc'><strong>Descripción: </strong></label><textarea name='desc' id='desc' required ></textarea>
                        <span class='error'></span>
                      </p>
                      <p>
                        <label for='pvp'><strong>PVP: </strong></label><input type='number' name='pvp' id='pvp' required />
                        <span class='error'></span>
                      </p>
    `
    // añado las familias del select
    const respuesta = await $.ajax({
      url: DIR_SERV + "/familias",
      dataType: "json",
      type: "GET",
    })
  
    // Si devuelve error lo pongo
    if (respuesta.error) {
      $("#detalles").html(respuesta.error)
    } else if (respuesta.mensaje_error) {
      $("#detalles").html(respuesta.mensaje_error)
    } else {
      // Si no hay error se ponen las familias
      formulario += `<p>
                    <label for='familia'><strong>Familia: </strong></label>
                    <select name='familia' id='familia'>`
      $.each(respuesta.familias, function (key, tupla) {
        formulario += `<option value='${tupla.cod}' >${tupla.nombre}</option>`
      })
      formulario += `</select></p>
                    <p><button type='submit'>Añadir</button> <button onClick='vaciar()'>Volver</button></p>
                    </form>`
      $("#detalles").html(formulario)
    }
  }
  
  async function comprobarRepetido (tabla, columna, valor) {
    const respuesta = $.ajax({
      url: encodeURI(`${DIR_SERV}/repetido/${tabla}/${columna}/${valor}`),
      dataType: 'json',
      type: 'get'
    })
  
    if (respuesta.error) return true
  
    if (respuesta.mensaje_error) return true
  
    return respuesta.repetido
  }
  
  async function crearProducto (event) {
    event.preventDefault()
    const form = event.target
  
    let codRepetido = await comprobarRepetido('producto', 'cod', form.cod.value)
    let nombreCorRepetido = await comprobarRepetido('producto', 'nombre_corto', form.nombre_cor.value)
    if (codRepetido) {
      $(form.cod).siblings("span.error").html('* Código repetido *')
    }
    if (nombreCorRepetido) {
      $(form.nombre_cor).siblings("span.error").html('* Código repetido *')
    }
  }
  
  // Vamos a hacer la tabla con los productos
  async function obtener_detalles (cod) {
    $.ajax({
      url: DIR_SERV + "/productos/" + cod,
      dataType: "json",
      type: "GET",
    }).done(async function (data) {
      if (data.mensaje_error) {
        $("#detalles").html(data.mensaje_error)
      } else {
        // Vamos a crear una tabla con los productos
        let detalles = `<h2>Detalles del producto: ${data.producto.cod}</h2>`
        detalles += `<p><strong>COD:</strong> ${data.producto.cod}</p>`
        detalles += `<p><strong>Nombre:</strong> ${data.producto.nombre ?? ''}</p>`
        detalles += `<p><strong>Nombre corto:</strong> ${data.producto.nombre_corto}</p>`
        detalles += `<p><strong>Descripción:</strong> ${data.producto.descripcion}</p>`
        detalles += `<p><strong>PVP:</strong> ${data.producto.PVP}</p>`
  
        // Pido el nombre de la familia a la API
        const respuesta = await $.ajax({
          url: DIR_SERV + "/familia/" + data.producto.familia,
          dataType: "json",
          type: "GET",
        })
  
        if (respuesta.error) return $("#detalles").html(respuesta.error)
  
        if (respuesta.mensaje_error) return $("#detalles").html(respuesta.mensaje_error)
  
        detalles += `<p><strong>Familia: </strong> ${respuesta.familia.nombre}</p>`
  
        detalles += `<p><button onclick='vaciar()' >volver</button></p>`
  
  
        $("#acciones").html(detalles)
      }
    })
  }
  
// -------------------------------------------------------------------------------------

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