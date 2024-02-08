<?php
// define("SERVIDOR_BD", "localhost:3307");
define("SERVIDOR_BD","localhost");
define("USUARIO_BD", "jose");
define("CLAVE_BD", "josefa");
define("NOMBRE_BD", "bd_libreria_exam");


function login($datos)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
    }

    try {
        $consulta = "select * from usuarios where lector = ? && clave = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($datos);
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la consulta:" . $e->getMessage();
    }

    if ($sentencia->rowCount() > 0) {
        $respuesta["usuario"] = $sentencia->fetch(PDO::FETCH_ASSOC);
        // Despues de pasar al usuario creo la sesion con la que se mantiene la seguridad aqui
        session_name("examenLibreria");
        session_start();
        $respuesta["api_session"] = session_id();
        // Guardo los datos del usuario para no se
        $_SESSION["usuario"] = $respuesta["usuario"]["lector"];
        $_SESSION["clave"] = $respuesta["usuario"]["clave"];
        $_SESSION["tipo"] = $respuesta["usuario"]["tipo"];
    } else {
        $respuesta["mensaje"] = "Usuario no se encuentra registrado en la base de datos";
    }

    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

// es como un login normal pero sin lo de las sesiones
function logueado($usuario,$clave){


    try{
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }catch(PDOException $e){
        $respuesta["error"] = "Error en la conexion con la bd: " .$e;
    }
    try{
        $consulta = "select * from usuarios where lector = ? && clave = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$usuario, $clave]);
    }catch(PDOException $e){
        $respuesta["error"] = "Error en la consulta: " .$e;
        $conexion = null;
        $sentencia = null;
    }

    if($sentencia->rowCount()>0){
        $respuesta["usuario"] = $sentencia->fetch(PDO::FETCH_ASSOC);
    }else{
        $resultado["mensaje"] = "El usuario no se encuentra registrado en la base de datos";
    }

    $conexion = null;
    $sentencia = null;
    return $resultado;
}


// Muestra todos los libros
function libros()
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
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


function insertar($datos){
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
    }

    try {
        $consulta = "insert into libros (referencia,titulo, autor, descripcion, precio) values (?,?,?,?,?)";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($datos);
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la consulta: " . $e->getMessage();
        $conexion = null;
        $sentencia = null;
    }

    $respuesta["mensaje"] = "Libro insertado correctamente";
    $conexion = null;
    $sentencia = null;
    return $respuesta;
}

// Devuelve tr o fl si esta repe
function comprobRepetido($tabla,$columna,$valor){
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Error en la conexión: " . $e->getMessage();
    }

    try {
        $consulta = "select * from $tabla where $columna = ?";              // no termino de entender esto ????????????????????????
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($valor);
    } catch (PDOException $e) {
        $consulta = null;
        $conexion = null;
        $respuesta["error"] = "Error en la consulta: " . $e->getMessage();
    }

    $respuesta["repetido"] = $sentencia->rowCount()>0;
    $consulta = null;
    $conexion = null;
    return $respuesta;
}