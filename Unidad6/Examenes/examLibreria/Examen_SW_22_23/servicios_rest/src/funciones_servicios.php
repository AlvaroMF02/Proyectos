<?php
// define("SERVIDOR_BD","localhost:3307");
define("SERVIDOR_BD","localhost");
define("USUARIO_BD","jose");
define("CLAVE_BD","josefa");
define("NOMBRE_BD","bd_libreria_exam");

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

function login($datos){
    try{
        $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    }
    catch(PDOException $e){
        $respuesta["error"]="Imposible conectar:".$e->getMessage();
    }

    try{
        $consulta = "select * from usuarios where lector = ? && clave = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($datos);
    }
    catch(PDOException $e){
        $respuesta["error"]="Error en la consulta:".$e->getMessage();
    }

    if($sentencia->rowCount()>0){
        $respuesta["usuario"] = $sentencia->fetch(PDO::FETCH_ASSOC);
        // $respuesta["api_session"] = 
    }else{
        $respuesta["mensaje"] = "Usuario no se encuentra registrado en la base de datos";
    }

    $sentencia = null;
    $conexion = null;
    return $respuesta;
}


?>
