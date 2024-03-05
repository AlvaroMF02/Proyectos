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

// Obtener a un usuario por su id
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

// obtener todos los datos de todos los usuarios q estén de guardia un dia a una hora
$app->get('/usuarioGuardia/{dia}/{hora}',function($request){
    $token = $request->getParam("api_session");
    session_id($token);
    session_start();
    if(isset($_SESSION["usuario"])){
        $dia = $request->getAttribute("dia");
        $hora = $request->getAttribute("hora");
        echo json_encode(obtenerUsuGuardi($dia,$hora));
    }else{
        session_destroy();
        echo json_encode(array("no_auth"=>"No tines permisos"));
    }

});

// obtener todos los datos de todos los usuarios q estén de guardia un dia a una hora
// pero con un id de usuario
$app->get('/deGuardia/{dia}/{hora}/{id_usuario}',function($request){
    $token = $request->getParam("api_session");
    session_id($token);
    session_start();
    if(isset($_SESSION["usuario"])){
        $dia = $request->getAttribute("dia");
        $hora = $request->getAttribute("hora");
        $id_usuario = $request->getAttribute("id_usuario");
        echo json_encode(deGuardia($dia,$hora,$id_usuario));
    }else{
        session_destroy();
        echo json_encode(array("no_auth"=>"No tines permisos"));
    }

});


// Una vez creado servicios los pongo a disposición
$app->run();
?>
