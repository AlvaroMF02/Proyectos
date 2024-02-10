<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app= new \Slim\App;



$app->get('/login',function($request){

    echo json_encode(login());
});





// Una vez creado servicios los pongo a disposición
$app->run();
?>
