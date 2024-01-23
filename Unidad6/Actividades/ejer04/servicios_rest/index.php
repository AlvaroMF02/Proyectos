<?php


require __DIR__ . '/Slim/autoload.php';
$app = new \Slim\App;


require "src/func_const.php";

// actualiza un producto por el cod
$app->put('/producto/actualizar/{cod}', function ($request) {

    // Recojo los datos en el orden de insercion
     $datos[] = $request->getParam('nombre');
     $datos[] = $request->getParam('nombre_corto');
     $datos[] = $request->getParam('descripcion');
     $datos[] = $request->getParam('PVP');
     $datos[] = $request->getParam('familia');
     $datos[] = $request->getAttribute('cod');

    echo json_encode(actualizar_productos($datos));
});



$app->run();
