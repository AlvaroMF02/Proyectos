<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;


// Login
$app->post("/login", function ($request) {

    $datos[] = $request->getParam("usuario");
    $datos[] = $request->getParam("clave");

    return json_encode(login($datos));
});

// comprobar si esta logueado para la seguridad
$app->get("/logueado", function ($request) {
    $token = $request->getParam("api_session");
    session_id($token);
    session_start();
    // no miro si es admin pq tmb se hace en el normal
    if (($_SESSION["usuario"])) {
        echo json_encode(logueado($_SESSION["usuario"], $_SESSION["clave"]));
    } else {
        session_destroy();
        echo json_encode(array("no_auth" => "No tienes permisos"));
    }
});

$app->post('/salir', function ($request) {
    $token = $request->getParam("api_session");
    session_id($token);
    session_start();
    session_destroy();
    echo json_encode(array("log_out" => "Se ha cerrado sesión"));
});

// Funcion con la que se rellenará toda la tabla
// se le pasa el usuario la hora y el dia
$app->post('/obtener_horario', function ($request) {
    $token = $request->getParam("api_session");
    session_id($token);
    session_start();

    if(isset($_SESSION["usuario"])){
        $usuario  = $request->getParam("usuario");
        $hora  = $request->getParam("hora");
        $dia  = $request->getParam("dia");
        echo json_encode(ver_horario($usuario,$hora,$dia));
    }else{
        session_destroy();
        echo json_encode(array("no_auth"=>"No tienes permisos"));
    }


});


// Ver todos los profesores 
$app->post('/obtener_profesores', function ($request) {
    $token = $request->getParam("api_session");
    session_id($token);
    session_start();
    if(isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin"){
        echo json_encode(obtener_profesores());
    }else{
        session_destroy();
        echo json_encode(array("no_auth"=>"No tienes permisos"));
    }
});

// Ver grupos de un (profesor) de una (hora) y un (dia) exactos
$app->post("obtener_grupo",function($request){
    $token = $request->getParam("api_session");
    session_id($token);
    session_start();
    if(isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin"){
        $datos[] = $request->getParam("profesor");
        $datos[] = $request->getParam("dia");
        $datos[] = $request->getParam("hora");
        echo json_encode(obtener_grupo($datos));
    }else{
        session_destroy();
        echo json_encode(array("no_auth"=>"No tienes permisos"));
    }
});
// Quitar un grupo de un (profesor) a una (hora) y (dia) exactos

// Listado de grupos de que no estan en la (hora) y (dia) de un (profesor)
$app->post("obtener_grupo_faltan",function($request){
    $token = $request->getParam("api_session");
    session_id($token);
    session_start();
    if(isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin"){
        $datos[] = $request->getParam("profesor");
        $datos[] = $request->getParam("dia");
        $datos[] = $request->getParam("hora");
        echo json_encode(obtener_grupo_faltan($datos));
    }else{
        session_destroy();
        echo json_encode(array("no_auth"=>"No tienes permisos"));
    }
});

// Añadir un grupo a una (hora) y (dia) especificos de un (profesor)

$app->run();
