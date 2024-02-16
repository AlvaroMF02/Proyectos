<?php

define("SERVIDOR_BD", 'localhost');
define("USUARIO_BD", "jose");
define("CLAVE_BD", "josefa");
define("NOMBRE_BD", "bd_tienda");

function repetido($tabla, $columna, $valor){
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["mensaje_error"] = "No se ha podido conectar a la base de datos: " . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "select * from $tabla where $columna = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$valor]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["mensaje_error"] = "No se ha podido conectar a la base de datos: " . $e->getMessage();
        return $respuesta;
    }

    $respuesta["repetido"] = ($sentencia->rowCount()) > 0; // Nos devuelve true si está repetido y false si no
    $sentencia = null;
    $conexion = null;
    return $respuesta;
}
