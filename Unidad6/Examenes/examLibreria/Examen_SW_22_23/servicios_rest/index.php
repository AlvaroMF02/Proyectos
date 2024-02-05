<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app= new \Slim\App;


// recoger libros
$app->get("/obtenerLibros",function(){

    return json_encode(libros());
});





$app->run();
?>
