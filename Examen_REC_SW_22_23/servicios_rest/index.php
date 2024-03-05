<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app= new \Slim\App;



$app->post('/login',function($request){
    $usuario = $request->getParam("usuario");
    $clave = $request->getParam("clave");

    echo json_encode(login($usuario,$clave));
});

$app->get('/logueado',function($request){
    $token = $request->getParam("api_session");
    session_id($token);
    session_start();
    if(isset($_SESSION["usuario"])){
        echo json_encode(logueado($_SESSION["usuario"],$_SESSION["clave"]));
    }else{
        session_destroy();
        echo json_encode(array("no_auth"=>"No tines permisos"));
    }
});

$app->post('/salir',function($request){
    $token = $request->getParam("api_session");
    session_id($token);
    session_start();
    session_destroy();

    echo json_encode(array("log_out"=>"Cerrada sesión en la API"));
});

$app->get('/usuario/{id_usuario}',function($request){
    $token = $request->getParam("api_session");
    session_id($token);
    session_start();
    if(isset($_SESSION["usuario"])){
        $usuario = $request->getAttribute("id_usuario");
        echo json_encode(comprobar_usuario($usuario));
    }else{
        session_destroy();
        echo json_encode(array("no_auth"=>"No tines permisos"));
    }
});


// Una vez creado servicios los pongo a disposición
$app->run();
?>
