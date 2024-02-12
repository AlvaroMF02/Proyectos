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

// comprobar si esta logueado para la seguridad
$app->post("/logueado",function($request){
    $token = $request->getParam("api_session");
    session_id($token);
    session_start();
    // no miro si es admin pq tmb se hace en el normal
    if(($_SESSION["usuario"])){
        echo json_encode(logueado($_SESSION["usuario"], $_SESSION["clave"]));
    }else{
        session_destroy();
        echo json_encode(array("no_auth"=>"No tienes permisos"));
    }
});

$app->post('/salir', function ($request) {

    $token = $request->getParam("api_session");
    session_id($token);
    session_start();
    session_destroy();
    echo json_encode(array("log_out" => "Se ha cerrado sesión"));
});


$app->run();
