<?php

define("SERVIDOR_BD", 'localhost');
define("USUARIO_BD", "jose");
define("CLAVE_BD", "josefa");
define("NOMBRE_BD", "bd_tienda");

function repetido_editar($tabla, $columna, $valor, $columna_id, $valor_id){
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["mensaje_error"] = "No se ha podido conectar a la base de datos: " . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "select * from $tabla where $columna = ? AND $columna_id <> ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$valor, $valor_id]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["mensaje_error"] = "No se ha podido conectar a la base de datos: " . $e->getMessage();
        return $respuesta;
    }

    $respuesta["repetido"] = ($sentencia->rowCount()) > 0;
    $sentencia = null;
    $conexion = null;
    return $respuesta;
}
