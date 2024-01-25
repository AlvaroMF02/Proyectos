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


// Errores en el formulario para insertar
if (isset($_POST["btnContiNuevo"])) {
    $errorCod = $_POST["codigo"] == "";
    // comprobar que no esta repe
    if (!$errorCod) {
        // comprobar que el codigo no esta repe
        $urlInsertCop = DIR_SERV . "/repetido/producto/cod/" . $_POST["codigo"];
        $respueInsertCop = consumir_servicios_REST($urlInsertCop, "GET");
        $objInsertcop = json_decode($respueInsertCop);

        if (!$objInsertcop) echo "Error API: " . $respueInsertCop;
        if (isset($objInsertcop->mensaje_error)) echo "Error consulta: " . $objInsertcop->mensaje_error;

        if ($objInsertcop->repetido) {
            $errorCod = true;
        }
    }

    $errorNombre = $_POST["nombre"] == "";
    $errorDescrip = $_POST["descripcion"] == "";
    $errorPvp = $_POST["pvp"] == "" || !is_numeric($_POST["pvp"]);

    $errorForm = $errorCod || $errorNombre || $errorDescrip || $errorPvp;

    // Si no hay errores hago la insercion de los datos
    if (!$errorForm) {
        // ------------------------ AÑADIR PRODUCTO ------------------------
        // crear el producto con los datos del formulario
        $datos["cod"] = $_POST["codigo"];
        $datos["nombre"] = $_POST["nombre"];
        $datos["nombre_corto"] = $_POST["nombre_corto"];
        $datos["descripcion"] = $_POST["descripcion"];
        $datos["PVP"] = $_POST["pvp"];
        $datos["familia"] = $_POST["familia"];

        $urlInsert = DIR_SERV . "/producto/insertar";
        $respueInsert = consumir_servicios_REST($urlInsert, "POST", $datos);
        $objInsert = json_decode($respueInsert);

        if (!$objInsert) echo "Error API: " . $respueInsert;
        if (isset($objInsert->mensaje_error)) echo "Error consulta: " . $objInsert->mensaje_error;

        $_SESSION["mensaje"] = $objInsert->mensaje;
        header("Location:index.php");
        exit;
    }
}



// ------------------------ BORRAR PRODUCTO ------------------------
if (isset($_POST["btnBorrar"])) {
    // hacer la url para borrar
    $urlBorrar = DIR_SERV . "/producto/borrar/" . urlencode($_POST["btnBorrar"]);
    $respuestBorrar = consumir_servicios_REST($urlBorrar, "DELETE");
    $objBorrar = json_decode($respuestBorrar);

    if (!$objBorrar) echo "Error API: " + $respuestBorrar;
    if (isset($objBorrar->mensaje_error)) echo "Error consulta: " + $$objBorrar->mensaje_error;

    $_SESSION["mensaje"] = $objBorrar->mensaje;
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
        // Mostrar los datos que se han pasado por le value del boton
        $urlDetall = DIR_SERV . "/producto/" . urlencode($_POST["btnMostrar"]);
        $respuDetall = consumir_servicios_REST($urlDetall, "GET");
        $objDetall = json_decode($respuDetall);

        // ver si hay errores
        if (!$objDetall) {
            echo "Error consumiendo el servicio: " . $respuDetall;
        }
        if (isset($objDetall->mensaje_error)) {
            echo "Error en la consulta: " . $objDetall->mensaje_error;
        }

        echo "<h3>Detalles del producto: <strong>" . $_POST['btnMostrar'] . "</strong></h3>";
        echo "<strong>Código:</strong>" . $objDetall->producto->cod . "<br>";
        echo "<strong>Nombre:</strong>" . $objDetall->producto->nombre . "<br>";
        echo "<strong>Nombre corto:</strong>" . $objDetall->producto->nombre_corto . "<br>";
        echo "<strong>Descripción:</strong>" . $objDetall->producto->descripcion . "<br>";
        echo "<strong>PVP:</strong>" . $objDetall->producto->PVP . "<br>";
        echo "<strong>Familia:</strong>" . $objDetall->producto->familia . "<br>";
    }
    // ------------------------ AÑADIR UN PRODUCTO ------------------------
    if (isset($_POST["btnNuevo"]) || isset($_POST["btnContiNuevo"])) {
    ?>
        <h2>Añadir un producto</h2>
        <form action="index.php" method="post">
            <p>
                <label for="codigo">Código</label>
                <input type="text" name="codigo" id="codigo" maxlength="12">
                <?php
                if (isset($_POST["btnContiNuevo"]) && $errorCod) {
                    if($_POST["codigo"] == ""){
                        echo "<span class='error'>Campo vacio</span>";
                    }else{
                        echo "<span class='error'>Código repetido</span>";
                    }
                    
                }
                ?>
            </p>
            <p>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" maxlength="200">
                <?php
                if (isset($_POST["btnContiNuevo"])  && $errorNombre) {
                    echo "<span class='error'>Campo vacio</span>";
                }
                ?>
            </p>
            <p>
                <label for="nombre_corto">Nombre corto</label>
                <input type="text" name="nombre_corto" id="nombre_corto" maxlength="50">
            </p>
            <p>
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" cols="30" rows="5"></textarea>
                <?php
                if (isset($_POST["btnContiNuevo"])  && $errorDescrip) {
                    echo "<span class='error'>Campo vacio</span>";
                }
                ?>
            </p>
            <p>
                <label for="pvp">PVP</label>
                <input type="text" name="pvp" id="pvp">
                <?php
                if (isset($_POST["btnContiNuevo"]) && $errorPvp) {
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

                    echo var_dump($objFamilia->productos);

                    for ($i = 0; $i < count($objFamilia->productos); $i++) {
                        echo "<option value='" . $objFamilia->productos[$i]->cod . "'>" . $objFamilia->productos[$i]->cod . "</option>";
                    }
                    ?>
                </select>
            </p>

            <p>
                <button type="submit" name="btnContiNuevo">Añadir</button>
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