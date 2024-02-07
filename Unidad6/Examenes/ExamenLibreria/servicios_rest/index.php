<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;


// Login
$app->get("/login", function ($request) {

    $datos[] = $request->getParam("usuario");
    $datos[] = $request->getParam("clave");

    return json_encode(login($datos));
});

// Comprobar logueado
$app->get("/logueado", function ($request) {

    $token = $request->getParam("api_session");     //  ????????????????????????? no entiendo nada de esto
    session_id($token);
    session_start();

    // la sesion usuario solo existe si hemos hecho un login ( se guarda el usuario que se ha logueado )
    if ($_SESSION["usuario"]) {
        echo json_encode(logueado($_SESSION["usuario"], $_SESSION["clave"]));
    } else {
        session_destroy();
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio"));
    }
});
// salir no se que coño
$app->post("/salir", function ($request) {

    $token = $request->getParam("api_session");     //  ????????????????????????? no entiendo nada de esto
    session_id($token);
    session_start();
    session_destroy();
    echo json_encode(array("log_out" => "Sesion cerrada en la API"));
});


// recoger libros
$app->get("/obtenerLibros", function () {

    return json_encode(libros());
});

// Insertar libro
$app->post("/crearLibro", function ($request) {

    $token = $request->getParam("api_session");     //  ????????????????????????? no entiendo nada de esto
    session_id($token);                             // no hace session_start pq ya esta iniicado ????????????????????????????

    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") {
        $datos[] = $request->getParam("referencia");
        $datos[] = $request->getParam("titulo");
        $datos[] = $request->getParam("autor");
        $datos[] = $request->getParam("descripcion");
        $datos[] = $request->getParam("precio");

        return json_encode(insertar($datos));
    }else{
        session_destroy();
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio"));
    }
});

$app->get("repetido/{tabla}/{columna}/{valor}", function($request){
    $token = $request->getParam("api_session");
    session_id($token);

    if(isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin"){
        $datos[] = $request->getAttribute("tabla");
        $datos[] = $request->getAttribute("columna");
        $datos[] = $request->getAttribute("valor");

        echo json_encode(repetido($datos));
    }else{
        session_destroy();
        echo json_encode(array("no_auth" => "No tienes permisos"));
    }
});


$app->run();
