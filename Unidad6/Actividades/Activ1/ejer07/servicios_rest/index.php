<?php


require __DIR__ . '/Slim/autoload.php';
$app = new \Slim\App;


require "src/func_const.php";

// Devuelve vd si ya exsiste el valor en una columna de una tabla al insertar
$app->get("/repetido/{tabla}/{columna}/{valor}", function($request){
    echo json_encode(repetido($request->getAttribute("tabla"), $request->getAttribute("columna"), $request->getAttribute("valor")));
});



$app->run();
