<?php


require __DIR__ . '/Slim/autoload.php';
$app = new \Slim\App;


require "src/func_const.php";

// actualiza un producto por el cod
$app->post('/repetido/{tabla}/{columna}/{valor}', function ($request) {

    echo json_encode(repetido(
        $request->getAttribute('tabla'),
        $request->getAttribute('columna'),
        $request->getAttribute('valor')
    ));

});



$app->run();
