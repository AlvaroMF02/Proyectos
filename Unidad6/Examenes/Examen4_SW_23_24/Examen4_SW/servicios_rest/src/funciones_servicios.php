<?php
require "config_bd.php";

function login($usuario, $clave)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la conexión:" . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "select * from usuarios where usuario = ? && clave = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$usuario, $clave]);
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la consulta:" . $e->getMessage();
        $conexion = null;
        return $respuesta;
    }

    if ($sentencia->rowCount() > 0) {
        $respuesta["usuario"] = $sentencia->fetch(PDO::FETCH_ASSOC);
        session_name("examen");
        session_start();
        $_SESSION["usuario"] = $respuesta["usuario"]["usuario"];
        $_SESSION["clave"] = $respuesta["usuario"]["clave"];
        $_SESSION["tipo"] = $respuesta["usuario"]["tipo"];
        $respuesta["api_session"] = session_id();
    } else {
        $respuesta["mensaje"] = "El usuario no se encuentra registrado en la BD";
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
        $respuesta["error"] = "Error en la conexión:" . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "select * from usuarios where usuario = ? && clave = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$usuario, $clave]);
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la consulta:" . $e->getMessage();
        $conexion = null;
        return $respuesta;
    }

    if ($sentencia->rowCount() > 0) {
        $respuesta["usuario"] = $sentencia->fetch(PDO::FETCH_ASSOC);
    } else {
        $respuesta["mensaje"] = "El usuario no se encuentra registrado en la BD";
    }

    $conexion = null;
    $sentencia = null;
    return $respuesta;
}

function obtener_alumnos()
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la conexión:" . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "select * from usuarios where tipo = 'alumno'";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la consulta:" . $e->getMessage();
        $conexion = null;
        return $respuesta;
    }

    $respuesta["alumnos"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    $conexion = null;
    $sentencia = null;
    return $respuesta;
}


function obtener_notas($idAlum)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la conexión:" . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "select notas.cod_asig,asignaturas.denominacion,notas.nota from notas,asignaturas where asignaturas.cod_asig= notas.cod_asig && notas.cod_usu = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$idAlum]);
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la consulta:" . $e->getMessage();
        $conexion = null;
        return $respuesta;
    }

    $respuesta["notas"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    $conexion = null;
    $sentencia = null;
    return $respuesta;
}

function obtener_no_evalu()
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la conexión:" . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "select * from asignaturas";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la consulta:" . $e->getMessage();
        $conexion = null;
        return $respuesta;
    }

    $respuesta["asignaturas"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    $conexion = null;
    $sentencia = null;
    return $respuesta;
}


function quitarNota($idAlum, $idAsig)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la conexión:" . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "delete from notas where cod_asig = ? && cod_usu = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$idAsig, $idAlum]);
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la consulta:" . $e->getMessage();
        $conexion = null;
        return $respuesta;
    }

    $respuesta["mensaje"] = "Asignatura descalificada con exito";

    $conexion = null;
    $sentencia = null;
    return $respuesta;
}


function ponerNota($cod_asig, $idAlum)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la conexión:" . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "insert into notas (cod_asig,cod_usu,nota) values (?,?,?)";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$cod_asig, $idAlum, 0]);
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la consulta:" . $e->getMessage();
        $conexion = null;
        return $respuesta;
    }

    $respuesta["mensaje"] = "Asignatura clasificada con exito";

    $conexion = null;
    $sentencia = null;
    return $respuesta;
}

function cambiarNota($cod_asig, $idAlum, $nota)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la conexión:" . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "UPDATE  notas SET nota='?' WHERE cod_usu = ? && cod_asig=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$nota,$idAlum,$cod_asig]);
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la consulta:" . $e->getMessage();
        $conexion = null;
        return $respuesta;
    }

    $respuesta["mensaje"] = "Asignatura cambiada con exito";

    $conexion = null;
    $sentencia = null;
    return $respuesta;
}
