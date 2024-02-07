<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app= new \Slim\App;


// recoger libros
$app->get("/obtenerLibros",function(){

    return json_encode(libros());
});

// Login
$app->get("/login",function($request){

    $datos[] = $request->getParam("usuario");
    $datos[] = $request->getParam("clave");

    return json_encode(login($datos));
});





$app->run();
?>
