<?php
require "config_bd.php";

function login($usuario, $clave)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "select * from usuarios where usuario = ? && clave = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$usuario,$clave]);
    } catch (PDOException $e) {
        $conexion = null;
        $respuesta["error"] = "Error en la consulta: ". $e->getMessage();
        return $respuesta;
    }

    if ($sentencia->rowCount() > 0) {
        $respuesta["usuario"] = $sentencia->fetch(PDO::FETCH_ASSOC);
        session_name("recu22_23");
        session_start();
        $_SESSION["usuario"] = $respuesta["usuario"]["usuario"]; 
        $_SESSION["clave"] = $respuesta["usuario"]["clave"]; 
        $respuesta["api_session"] = session_id(); 
    }else{
        $respuesta["mensaje"] = "Usuario no se encuentra regis. en la BD";
    }

    $conexion = null;
    $sentencia = null;
    return $respuesta;
}

function logueado($usuario, $clave)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "select * from usuarios where usuario = ? && clave = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$usuario,$clave]);
    } catch (PDOException $e) {
        $conexion = null;
        $respuesta["error"] = "Error en la consulta: ". $e->getMessage();
        return $respuesta;
    }

    if ($sentencia->rowCount() > 0) {
        $respuesta["usuario"] = $sentencia->fetch(PDO::FETCH_ASSOC);
    }else{
        $respuesta["mensaje"] = "Usuario no se encuentra regis. en la BD";
    }

    $conexion = null;
    $sentencia = null;
    return $respuesta;
}

function comprobar_usuario($id_usuario)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "select * from usuarios where usuario = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$id_usuario]);
    } catch (PDOException $e) {
        $conexion = null;
        $respuesta["error"] = "Error en la consulta: ". $e->getMessage();
        return $respuesta;
    }

    if ($sentencia->rowCount() > 0) {
        $respuesta["usuario"] = $sentencia->fetch(PDO::FETCH_ASSOC);
    }else{
        $respuesta["mensaje"] = "Usuario con id" .$id_usuario." no se encuentra regis. en la BD";
    }

    $conexion = null;
    $sentencia = null;
    return $respuesta;
}