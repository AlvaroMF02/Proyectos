<?php

// Constantes de base de datos
define("SERVIDOR_BD","localhost")
define("USUARIO_BD","jose")
define("CLAVE_BD","josefa")
define("SERVIDOR_BD","localhost")


// Muestra una página nueva si hay un error en la conexion
function error_page($title, $body)
{
    $page = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>' . $title . '</title>
            </head>
            <body>' . $body . '</body>
            </html>';
    return $page;
}

// Algo está mal pq no me dice los repetidos
function repetido($conexion, $tabla, $columna, $valor)
{
    // comprobar que la consulta está bien
    try {
        $consulta = "select * from " . $tabla . " where " . $columna . "='" . $valor . "'";
        $resultado = mysqli_query($conexion, $consulta);
        $respuesta = mysqli_num_rows($resultado) > 0;
        mysqli_free_result($resultado);
    } catch (Exception $e) {
        mysqli_close($conexion);
        $respuesta(error_page("Practica 1 CRUD", "<h1>Primer CRUD</h1><p>No se ha podido hacer la consulta:" . $e->getMessage() . "</p>"));
    }

    return $respuesta;
}

function repetido_editado($conexion, $tabla, $columna, $valor, $valor_clave)
{
    // comprobar que la consulta está bien
    try {
        $consulta = "select * from " . $tabla . " where " . $columna . "='" . $valor . "' and ".$valor_clave."'";;
        $resultado = mysqli_query($conexion, $consulta);
        $respuesta = mysqli_num_rows($resultado) > 0;
        mysqli_free_result($resultado);
    } catch (Exception $e) {
        mysqli_close($conexion);
        $respuesta(error_page("Practica 1 CRUD", "<h1>Primer CRUD</h1><p>No se ha podido hacer la consulta:" . $e->getMessage() . "</p>"));
    }

    return $respuesta;
}
?>