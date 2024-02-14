<?php
// define("SERVIDOR_BD", "localhost:3307");
define("SERVIDOR_BD", "localhost");
define("USUARIO_BD", "jose");
define("CLAVE_BD", "josefa");
define("NOMBRE_BD", "bd_horarios_exam2");


function login($datos)
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
        $sentencia->execute($datos);
    } catch (PDOException $e) {
        $conexion = null;
        $respuesta["error"] = "Error en la consulta: " . $e;
        return $respuesta;
    }

    if ($sentencia->rowCount() > 0) {
        $respuesta["usuario"] = $sentencia->fetch(PDO::FETCH_ASSOC);

        session_name("examenHorarios");
        session_start();
        $_SESSION["usuario"] = $respuesta["usuario"]["usuario"];
        $_SESSION["clave"] = $respuesta["usuario"]["clave"];
        $_SESSION["tipo"] = $respuesta["usuario"]["tipo"];
        $respuesta["api_session"] = session_id();
    } else {
        $respuesta["mensaje"] = "El usuario no está en la base de datos";
    }

    $sentencia = null;
    $conexion = null;
    return $respuesta;

}


// comprueba que el usuario esta logueado   ( SIRVE PARA LA SEGURIDAD )
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
        $conexion = null;
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


function ver_horario($usuario,$hora,$dia)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
        return $respuesta;
    }

    try {// con el Join para que nos de tmb el nombre del grupo
        $consulta = "select grupos.nombre from horario_lectivo,grupos where horario_lectivo.grupo = grupos.id_grupo && horario_lectivo.usuario = ? && horario_lectivo.hora = ? && horario_lectivo.dia = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$usuario,$hora,$dia]);
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la consulta:" . $e->getMessage();
        $conexion = null;
        return $respuesta;
    }
    if($sentencia->rowCount()>0){
        $respuesta["horario"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }else{
        $respuesta["mensaje"]="";
    }
    

    $conexion = null;
    $sentencia = null;

    return $respuesta;
}


function obtener_profesores(){
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "select * from usuarios";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
        $conexion = null;
        return $respuesta;
    }

    $respuesta["profesores"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    $conexion = null;
    $sentencia = null;

    return $respuesta;
}

// Ver grupos de un profesor dia hora
function obtener_grupo($datos){
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "select grupos.nombre grupos.id_grupo from horario_lectivo,grupos where horario_lectivo.grupo = grupos.id_grupo && horario_lectivo.usuario = ? && horario_lectivo.dia = ? && horario_lectivo.hora = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($datos);
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
        $conexion = null;
        return $respuesta;
    }

    $respuesta["grupos"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    $conexion = null;
    $sentencia = null;

    return $respuesta;
}

// Ver grupos de un profesor dia hora que no estan
function obtener_grupo_faltan($datos){
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "select grupos.nombre, grupos.id_grupo  from horario_lectivo,grupos where horario_lectivo.grupo = grupos.id_grupo && horario_lectivo.usuario != ? && horario_lectivo.dia != ? && horario_lectivo.hora != ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($datos);
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
        $conexion = null;
        return $respuesta;
    }

    $respuesta["grupos"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    $conexion = null;
    $sentencia = null;

    return $respuesta;
}