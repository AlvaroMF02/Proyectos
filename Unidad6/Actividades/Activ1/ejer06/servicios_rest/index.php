<?php


require __DIR__ . '/Slim/autoload.php';
$app = new \Slim\App;


require "src/func_const.php";

// actualiza un producto por el cod
$app->get('/familias', function ($request) {
    echo json_encode(obtener_familias());
});



$app->run();
