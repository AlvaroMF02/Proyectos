<?php


require __DIR__ . '/Slim/autoload.php';
$app = new \Slim\App;


require "src/func_const.php";

$app->post('/producto/insertar', function ($request) {

    // Recojo los datos en el orden de insercion
     $datos[] = $request->getParam('cod');
     $datos[] = $request->getParam('nombre');
     $datos[] = $request->getParam('nombre_corto');
     $datos[] = $request->getParam('descripcion');
     $datos[] = $request->getParam('PVP');
     $datos[] = $request->getParam('familia');

    echo json_encode(insertar_productos($datos));
});



$app->run();
