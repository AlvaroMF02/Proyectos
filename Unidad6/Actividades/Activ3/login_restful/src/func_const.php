<?php
// define("SERVIDOR_BD", "localhost:3307");
define("SERVIDOR_BD", "localhost");
define("USUARIO_BD", "jose");
define("CLAVE_BD", "josefa");
define("NOMBRE_BD", "bd_foro2");

// muestra los usuarios
function usuarios()
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la conexión: " . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "select * from usuarios";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "Error en la consulta: " . $e->getMessage();
        return $respuesta;
    }

    $respuesta["usuarios"] = ($sentencia->fetchAll(PDO::FETCH_ASSOC));
    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

// muestra un usuario con el mismo id
function buscarUsuario($id)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la conexión: " . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "select * from usuarios  where id_usuario = ? ";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$id]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "Error en la consulta: " . $e->getMessage();
        return $respuesta;
    }

    $respuesta["usuario"] = ($sentencia->fetch(PDO::FETCH_ASSOC));
    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

// Crea un usuario y te muestra el id del usuario
function crearUsuario($datos)
{

    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la conexion: " . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "insert into usuarios (nombre, usuario, clave, email) values (?,?,?,?)";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($datos);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "Error en la consulta: " . $e->getMessage();
        return $respuesta;
    }

    $respuesta["ult_id"] = $conexion->lastInsertId();
    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

// Hace el login
function login($datos)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la conexión: " . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "select * from usuarios where usuario = ? && clave = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($datos);
    } catch (PDOException $e) {
        $respuesta["mensaje"] = "Usuario no se encuentra registrado en la base de datos: " . $e;
        $conexion = null;
        $sentencia = null;
        return $respuesta;
    }

    $respuesta["usuario"] = $sentencia->fetch(PDO::FETCH_ASSOC);
    $conexion = null;
    $sentencia = null;
    return $respuesta;
}

// Actualiza a un usuario
function actualizarUsu($datos)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la conexión: " . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "update usuarios set nombre = ?, usuario=?, clave = ?, email = ? where id_usuario = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($datos);
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la consulta: " . $e;
    }

    $respuesta["mensaje"] = "El usuario " . $datos[4] . " ha sido actualizado con exito";
    $conexion = null;
    $sentencia = null;
    return $respuesta;
}

// Borrar a un usuario por el id
function borrarUsu($id){
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la conexión: " . $e;
    }

    try {
        $consulta = "delete from usuarios where id_usuario = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$id]);
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la consulta: " . $e;
        $conexion = null;
        $sentencia = null;
        return $respuesta;
    }

    $respuesta["mensaje"] = "El usuario con id: " . $id . " ha sido borrado correctamente";
    $conexion = null;
    $sentencia = null;
    return $respuesta;
}
