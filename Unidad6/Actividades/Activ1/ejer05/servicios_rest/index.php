<?php


require __DIR__ . '/Slim/autoload.php';
$app = new \Slim\App;


require "src/func_const.php";

// actualiza un producto por el cod
$app->delete('/producto/borrar/{cod}', function ($request) {

    echo json_encode(borrar_productos($request->getAttribute('cod')));
});



$app->run();
