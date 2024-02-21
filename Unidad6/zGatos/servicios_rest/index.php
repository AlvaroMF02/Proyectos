<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;


// LOGIN - ( logea e inicia las sesiones para la seguridad en la api )
$app->post('/login', function ($request) {

    $usuario = $request->getParam("usuario");
    $clave = $request->getParam("clave");

    echo json_encode(login($usuario, $clave));
});

// LOGUEADO - ( comprueba el si esta logueado )
$app->get('/logueado', function ($request) {

    $token = $request->getParam("api_session");     // aunque sea un get siempre le paso el token para verificar q el usuario sea admin
    session_id($token);                             // al pasarle el token cambia la sesion a la del id
    session_start();

    if (isset($_SESSION["usuario"])) {
        echo json_encode(logueado($_SESSION["usuario"], $_SESSION["clave"]));
    } else {
        session_destroy();
        echo json_encode(array("no_auth" => "No tienes permisos"));
    }
});

// SALIR - ( destruye las sesiones para salir del login )
$app->post('/salir', function ($request) {

    $token = $request->getParam("api_session");
    session_id($token);
    session_start();
    session_destroy();
    echo json_encode(array("log_out" => "Se ha cerrado sesión"));
});

// MOSTRAR - ( muestra todos los datos )
$app->get('/mostrar', function () {

    echo json_encode(mostrar());
});

// DETALLE - ( muestra un gato por id )
$app->post('/detalle', function ($request) {

    $token = $request->getParam("api_session");
    session_id($token);
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") {
        $id = $request->getParam("id");
        echo json_encode(detalles($id));
    } else {
        session_destroy();
        echo json_encode(array("no_auth" => "No tienes permisos"));
    }
});

// INSERTAR - ( INSERTA UN GATO )
$app->post('/insertar', function ($request) {
    $token = $request->getParam("api_session");
    session_id($token);
    session_start();

    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") {

        $datos[] = $request->getParam("nombre");
        $datos[] = $request->getParam("color");
        $datos[] = $request->getParam("edad");
        $datos[] = $request->getParam("salud");
        $datos[] = $request->getParam("adopcion");

        echo json_encode(insertar($datos));
    } else {
        session_destroy();
        echo json_encode(array("no_auth" => "No tienes permisos"));
    }
});


// REPETIDO - ( COMPRUEBA QUE EL NOMBRE NO ESTA REPE )
$app->post('/repe', function ($request) {

    $token = $request->getParam("api_session");
    session_id($token);
    session_start();

    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") {

        $tabla = $request->getParam("tabla");
        $columna = $request->getParam("columna");
        $valor = $request->getParam("valor");

        echo json_encode(repe($tabla,$columna,$valor));
    } else {
        session_destroy();
        echo json_encode(array("no_auth" => "No tienes permisos"));
    }
});

// ELIMINAR - ( ELIMINA UN GATO POR LE ID )
$app->delete('/eliminar', function ($request) {

    $token = $request->getParam("api_session");
    session_id($token);
    session_start();

    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") {

        $id = $request->getParam("id");

        echo json_encode(eliminar($id));
    } else {
        session_destroy();
        echo json_encode(array("no_auth" => "No tienes permisos"));
    }
});


$app->run();
