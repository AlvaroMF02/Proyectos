<?php

define("SERVIDOR_BD", "localhost:3307");
define("USUARIO_BD", "jose");
define("CLAVE_BD", "josefa");
define("NOMBRE_BD", "bd_gatos");

// hace el login e inicia la session para hacer la seguridad en la api con los datos del login
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
        $sentencia->execute([$usuario, $clave]);
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la consulta:" . $e->getMessage();
        return $respuesta;
    }


    if ($sentencia->rowCount() > 0) {
        $respuesta["usuario"] = $sentencia->fetch(PDO::FETCH_ASSOC);

        session_name("cafeteriaGatos");                                 // crear la session a partir del usuario
        session_start();
        $_SESSION["usuario"] = $respuesta["usuario"]["usuario"];
        $_SESSION["clave"] = $respuesta["usuario"]["clave"];
        $_SESSION["tipo"] = $respuesta["usuario"]["tipo"];
        $respuesta["api_session"] = session_id();
    } else {
        $respuesta["mensaje"] = "El usuario no está en la base de datos";
    }

    $conexion = null;
    $sentencia = null;

    return $respuesta;
}

// comprueba que el usuario esta logueado
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
        $sentencia->execute([$usuario, $clave]);
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la consulta:" . $e->getMessage();
        return $respuesta;
    }


    if ($sentencia->rowCount() > 0) {
        $respuesta["usuario"] = $sentencia->fetch(PDO::FETCH_ASSOC);
    } else {
        $respuesta["mensaje"] = "El usuario no está en la base de datos";
    }

    $conexion = null;
    $sentencia = null;

    return $respuesta;
}


// Mostrar la tabla de gatos
function mostrar()
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No se ha conectado: " . $e;
        return $respuesta;
    }

    try {
        $consulta = "select * from gatos";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la consulta: " . $e;
        return $respuesta;
    }

    $respuesta["gatos"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    $conexion = null;
    $sentencia = null;
    return $respuesta;
}

// Mostrar los detalles de un gato
function detalles($id)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No se ha conectado: " . $e;
        return $respuesta;
    }

    try {
        $consulta = "select * from gatos where id = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$id]);
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la consulta: " . $e;
        return $respuesta;
    }

    $respuesta["gatos"] = $sentencia->fetch(PDO::FETCH_ASSOC);

    $conexion = null;
    $sentencia = null;
    return $respuesta;
}

// Insertar un gato
function insertar($datos)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No se ha conectado: " . $e;
        return $respuesta;
    }

    try {
        $consulta = "insert into gatos (nombre, color,edad,salud,adopcion) values (?,?,?,?,?)";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($datos);
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la consulta: " . $e;
        return $respuesta;
    }

    $respuesta["mensaje"] = "El gato se ha insertado correctamente con id: " . $conexion->lastInsertId();

    $conexion = null;
    $sentencia = null;
    return $respuesta;
}
// Insertar un gato
function repe($tabla, $columna, $valor)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No se ha conectado: " . $e;
        return $respuesta;
    }

    try {
        $consulta = "select " . $columna . " from " . $tabla . " where " . $columna . " = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$valor]);
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la consulta: " . $e;
        return $respuesta;
    }

    $respuesta["repetido"] = $sentencia->rowCount()>0;

    $conexion = null;
    $sentencia = null;
    return $respuesta;
}

// Elimina un gato
function eliminar($id)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No se ha conectado: " . $e;
        return $respuesta;
    }

    try {
        $consulta = "delete from gatos where id = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$id]);
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la consulta: " . $e;
        return $respuesta;
    }

    $respuesta["mensaje"] = "El gato con id: ".$id." se ha borrado correctamente :(";

    $conexion = null;
    $sentencia = null;
    return $respuesta;
}