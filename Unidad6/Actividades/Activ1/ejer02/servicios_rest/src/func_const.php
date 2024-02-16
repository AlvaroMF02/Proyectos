<?php

define("SERVIDOR_BD", 'localhost');
define("USUARIO_BD", "jose");
define("CLAVE_BD", "josefa");
define("NOMBRE_BD", "bd_tienda");

// funciones que usamos en los metodos
function obtener_productos($cod){
    // conexion y consulta
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["mensaje_error"] = "No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>";
        return $respuesta;
    }
    try {
        $consulta = "select * from producto where cod = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$cod]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["mensaje_error"] = "Error en la consulta: " . $e->getMessage() . "</p>";
        return $respuesta;
    }
    
    if ($sentencia->rowCount()>0) {
        $respuesta["productos"] = $sentencia->fetch(PDO::FETCH_ASSOC);
        
    }else{
        $respuesta["mensaje"] = "El producto con código ".$cod. " no se ha encontrado"; 
    }

    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

?>