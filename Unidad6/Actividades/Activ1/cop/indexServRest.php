<?php

require "./funciones_ctes.php";

require _DIR_ . '/Slim/autoload.php';

$app = new \Slim\App;




// 7) Nos devuelve verdadero si ya existe el valor en una columna de una tabla (para los insertar)
$app->get("/repetido/{tabla}/{columna}/{valor}", function($request){
    echo json_encode(repetido($request->getAttribute("tabla"), $request->getAttribute("columna"), $request->getAttribute("valor")));
});

// 8) Nos devuelve verdadero si ya existe el valor en una columna de una tabla (para los editar)
$app->get("/repetido/{tabla}/{columna}/{valor}/{columna_id}/{valor_id}", function($request){
    echo json_encode(repetido_editar($request->getAttribute("tabla"), $request->getAttribute("columna"), $request->getAttribute("valor"), $request->getAttribute("columna_id"), $request->getAttribute("valor_id")));
});

$app->run();