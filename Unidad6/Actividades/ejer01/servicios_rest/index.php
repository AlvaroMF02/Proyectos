<?php


require __DIR__ . '/Slim/autoload.php';
$app = new \Slim\App;


require "src/func_const.php";

$app->get('/productos', function () {

    echo json_encode(obtener_productos());
});



$app->run();
