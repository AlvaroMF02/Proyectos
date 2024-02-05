<?php
require "config_bd.php";

function libros()
{
    try{
        $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    }
    catch(PDOException $e){
        $respuesta["error"]="Imposible conectar:".$e->getMessage();
    }
    
    try {
        $consulta = "select * from libros";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();

    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la consulta: " . $e->getMessage();
        $conexion = null;
        $sentencia = null;
    }
    
    $respuesta["libros"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return $respuesta;

}



?>
