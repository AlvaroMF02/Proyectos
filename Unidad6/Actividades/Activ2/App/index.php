<?php
session_name("ApiCrud");
session_start();

// Conexion con la API
define("DIR_SERV", "http://localhost/Proyectos/Unidad6/Actividades/Activ2/servicios_rest/");

function consumir_servicios_REST($url, $metodo, $datos = null)
{
    $llamada = curl_init();
    curl_setopt($llamada, CURLOPT_URL, $url);
    curl_setopt($llamada, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($llamada, CURLOPT_CUSTOMREQUEST, $metodo);
    if (isset($datos))
        curl_setopt($llamada, CURLOPT_POSTFIELDS, http_build_query($datos));
    $respuesta = curl_exec($llamada);
    curl_close($llamada);
    return $respuesta;
}


// ------------------------ BORRAR PRODUCTO ------------------------
if (isset($_POST["btnContiEdit"])) {
    echo "miau";
}
// ------------------------ BORRAR PRODUCTO ------------------------
if (isset($_POST["btnBorrar"])) {
    require "vistas/vistaBorrar.php";
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación web de prueba de servicios</title>
    <style>
        table,
        td,
        th {
            border: 1px solid black
        }

        table {
            border-collapse: collapse;
            text-align: center
        }

        th {
            background-color: #CCC
        }

        table img {
            width: 50px;
        }

        .enlace {
            border: none;
            background: none;
            cursor: pointer;
            color: blue;
            text-decoration: underline
        }

        .error {
            color: red
        }
    </style>
</head>

<body>

    <?php
    // Recoger todos los productos de la bd con la API
    $url = DIR_SERV . "/productos";
    $respuesta = consumir_servicios_REST($url, "GET");
    $obj = json_decode($respuesta);

    // Si hay errores ...
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta . "</body></html>");
    }
    if (isset($obj->mensaje_error)) {
        die("<p>" . $obj->mensaje_error . "</p></body></html>");
    }

    // ------------------------ MOSTRAR DETALLES DEL PRODUCTO ------------------------
    if (isset($_POST["btnMostrar"])) {
        require "vistas/vistaDetalles.php";
    }
    // ------------------------ AÑADIR UN PRODUCTO ------------------------
    if (isset($_POST["btnNuevo"]) || isset($_POST["btnContiNuevo"])) {
        require "vistas/vistaInsertar.php";
    }

    // ------------------------ EDITAR UN PRODUCTO ------------------------
    if (isset($_POST["btnEditar"]) || isset($_POST["btnContiEdit"])) {
        // recojer los datos del producto y ponerlo como value
        // Mostrar los datos que se han pasado por le value del boton
        $urlDetall = DIR_SERV . "/producto/" . urlencode($_POST["btnEditar"]);
        $respuDetall = consumir_servicios_REST($urlDetall, "GET");
        $objDetall = json_decode($respuDetall);

        // ver si hay errores
        if (!$objDetall) {
            echo "Error consumiendo el servicio: " . $respuDetall;
        }
        if (isset($objDetall->mensaje_error)) {
            echo "Error en la consulta: " . $objDetall->mensaje_error;
        }


        echo "<h2>Editar producto: <strong>" . $_POST['btnEditar'] . "</strong></h2>";
    ?>
        <form action="index.php" method="post">
            <p>
                <label for="codigo">Código</label>
                <input type="text" name="codigo" id="codigo" maxlength="12" value="<?php echo $objDetall->producto->cod ?>">
                <?php
                if (isset($_POST["btnContiEdit"]) && $errorCod) {
                    if ($_POST["codigo"] == "") {
                        echo "<span class='error'>Campo vacio</span>";
                    } else {
                        echo "<span class='error'>Código repetido</span>";
                    }
                }
                ?>
            </p>
            <p>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" maxlength="200" value="<?php echo $objDetall->producto->nombre ?>">
                <?php
                if (isset($_POST["btnContiEdit"])  && $errorNombre) {
                    echo "<span class='error'>Campo vacio</span>";
                }
                ?>
            </p>
            <p>
                <label for="nombre_corto">Nombre corto</label>
                <input type="text" name="nombre_corto" id="nombre_corto" maxlength="50" value="<?php echo $objDetall->producto->nombre_corto ?>">
            </p>
            <p>
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" cols="30" rows="5"><?php echo $objDetall->producto->descripcion ?></textarea>
            </p>
            <p>
                <label for="pvp">PVP</label>
                <input type="text" name="pvp" id="pvp" value="<?php echo $objDetall->producto->PVP ?>">
                <?php
                if (isset($_POST["btnContiEdit"]) && $errorPvp) {
                    if ($_POST["pvp"] == "") {
                        echo "<span class='error'>Campo vacio</span>";
                    } else {
                        echo "<span class='error'>Introduza números</span>";
                    }
                }
                ?>
            </p>
            <p>
                <label for="familia">Familia</label>
                <select name="familia" id="familia">
                    <?php
                    $urlFamil = DIR_SERV . "/familias";
                    $respuesFamil = consumir_servicios_REST($urlFamil, "GET");
                    $objFamilia = json_decode($respuesFamil);

                    if (!$objFamilia) die("Error API: " . $respuesFamil);
                    if (isset($objFamilia->mensaje_error)) echo "Error consulta: " . $objFamilia->mensaje_error;

                    // FALTA PONER LA FAMILIA NO LO COGE
                    for ($i = 0; $i < count($objFamilia->productos); $i++) {
                        if ($_POST["familia"] == $objFamilia->productos[$i]->cod) {
                            echo "<option selected value='" . $objFamilia->productos[$i]->cod . "'>" . $objFamilia->productos[$i]->cod . "</option>";
                        } elseif ($_POST["familia"] == $objDetall->producto->familia) {
                            echo "<option selected value='" . $objFamilia->productos[$i]->cod . "'>" . $objFamilia->productos[$i]->cod . "</option>";
                        } else {
                            echo "<option value='" . $objFamilia->productos[$i]->cod . "'>" . $objFamilia->productos[$i]->cod . "</option>";
                        }
                    }
                    ?>
                </select>
            </p>

            <p>
                <button type="submit" name="btnContiEdit">Editar</button>
                <button type="submit">Cancelar</button>
            </p>

        </form>
    <?php
    }


    // Mensaje 
    if (isset($_SESSION["mensaje"])) {
        echo $_SESSION["mensaje"];
        unset($_SESSION["mensaje"]);
    }



    // Mostrar los datos que hemos recogido
    echo "<h1>Listado de los productos </h1>";

    echo "<table>";
    echo "<tr><th>COD</th><th>Nombre</th><th>PVP</th><th><form action='index.php' method='post'><button name='btnNuevo' class='enlace'>Producto+</button></form></th></tr>";
    for ($i = 0; $i < count($obj->productos); $i++) {
        echo "<tr>";
        echo "<td><form action='index.php' method='post'><button class='enlace' name='btnMostrar' value='" . $obj->productos[$i]->cod . "'>" . $obj->productos[$i]->cod . "</button></form></td>";
        echo "<td>" . $obj->productos[$i]->nombre_corto . "</td>";
        echo "<td>" . $obj->productos[$i]->PVP . "</td>";
        echo "<td><form action='index.php' method='post'><button class='enlace' name='btnBorrar' value='" . $obj->productos[$i]->cod . "'>Borrar</button>-<button class='enlace' value='" . $obj->productos[$i]->cod . "' name='btnEditar'>Editar</button></form></td>";
        echo "</tr>";
    }

    echo "</table>";

    ?>
</body>

</html>