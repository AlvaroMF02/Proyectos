<?php


require __DIR__ . '/Slim/autoload.php';
$app = new \Slim\App;


require "src/func_const.php";

$app->get('/productos/{cod}', function ($request) {


    echo json_encode(obtener_productos($request->getAttribute('cod')));
});



$app->run();
