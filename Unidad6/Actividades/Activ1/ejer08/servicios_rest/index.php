<?php


require __DIR__ . '/Slim/autoload.php';
$app = new \Slim\App;


require "src/func_const.php";

// Devuelve verdadero si ya existe el valor en una columna de una tabla al editar
$app->get("/repetido/{tabla}/{columna}/{valor}/{columna_id}/{valor_id}", function($request){
    echo json_encode(repetido_editar($request->getAttribute("tabla"), $request->getAttribute("columna"), $request->getAttribute("valor"), $request->getAttribute("columna_id"), $request->getAttribute("valor_id")));
});


$app->run();
