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
        echo json_encode(array("no_auth" => "No tienes permisos"));
    }
    
});

$app->post('/salir',function($request){
    $token = $request->getParam("api_session");
    session_id($token);
    session_start();
    session_destroy();
    echo json_encode(array("log_out"=>"Cerrada sesión en la API"));
});

$app->get('/alumnos',function($request){
    $token = $request->getParam("api_session");
    session_id($token);
    session_start();
    if(isset($_SESSION["usuario"])){
        echo json_encode(obtener_alumnos());
    }else{
        session_destroy();
        echo json_encode(array("no_auth" => "No tienes permisos"));
    }
});

$app->get('/notasAlumno/{cod_alu}',function($request){
    $token = $request->getParam("api_session");
    session_id($token);
    session_start();
    if(isset($_SESSION["usuario"])){
        $idAlum = $request->getAttribute("cod_alu");
        echo json_encode(obtener_notas($idAlum));
    }else{
        session_destroy();
        echo json_encode(array("no_auth" => "No tienes permisos"));
    }
});

// CONSULTA MAL HECHA
$app->get('/NotasNoEvalAlumno/{cod_alu}',function($request){           // Comprobar si es admin
    $token = $request->getParam("api_session");
    session_id($token);
    session_start();

    if(isset($_SESSION["usuario"])){
        $idAlum = $request->getAttribute("cod_alu");
        echo json_encode(obtener_no_evalu($idAlum));
    }else{
        session_destroy();
        echo json_encode(array("no_auth" => "No tienes permisos"));
    }
});

$app->delete('/quitarNota/{cod_alu}',function($request){
    $token = $request->getParam("api_session");
    session_id($token);
    session_start();

    if(isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "tutor"){
        $idAlum = $request->getAttribute("cod_alu");
        $idAsig = $request->getParam("cod_asig");
        echo json_encode(quitarNota($idAlum,$idAsig));
    }else{
        session_destroy();
        echo json_encode(array("no_auth" => "No tienes permisos"));
    }
});


$app->post('/ponerNota/{cod_alu}',function($request){
    $token = $request->getParam("api_session");
    session_id($token);
    session_start();

    if(isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "tutor"){
        $cod_asig= $request->getParam("cod_asig");
        $idAlum = $request->getAttribute("cod_alu");
        echo json_encode(ponerNota($cod_asig,$idAlum));
    }else{
        session_destroy();
        echo json_encode(array("no_auth" => "No tienes permisos"));
    }
});


$app->put('/cambiarNota/{cod_alu}',function($request){
    $token = $request->getParam("api_session");
    session_id($token);
    session_start();

    if(isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "tutor"){
        $cod_asig= $request->getParam("cod_asig");
        $nota= $request->getParam("nota");
        $idAlum = $request->getAttribute("cod_alu");
        echo json_encode(cambiarNota($cod_asig,$idAlum,$nota));
    }else{
        session_destroy();
        echo json_encode(array("no_auth" => "No tienes permisos"));
    }
});


// Una vez creado servicios los pongo a disposición
$app->run();
?>
