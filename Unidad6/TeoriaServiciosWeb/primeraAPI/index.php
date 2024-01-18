<?php

require __DIR__ . '/Slim/autoload.php';

// Creacion de la app
$app = new \Slim\App;

// Aqui dentro va el codigo de la api

// diferentes metodos (pide una cadena y una funcion)
// $app->post();
// $app->delete();
// $app->put();

// se pone el nombre de la funcion como el final de la URL
$app->get('/saludo', function () {

    $respuesta["mensaje"] = "holaaa";

    // Siempre tiene que devolver un echo de un JSON
    // pasandole el array asociativo con los datos
    echo json_encode($respuesta);
});

// pidiendole parametros a la funcion   (request para recoger el param)
$app->get('/saludo/{nombre}', function ($request) {

    $valorRecibido = $request->getAttribute("nombre");
    $respuesta["mensaje"] = "holaaa " . $valorRecibido;

    echo json_encode($respuesta);
});

// hacer una funcion POST
$app->post('/saludo', function ($request) {

    // el nombre con el que se tendra que identificar el indice asociativo
    $valorRecibido = $request->getParam('nombre');
    $respuesta["mensaje"] = "holaaa" . $valorRecibido;
    echo json_encode($respuesta);
});


$app->delete('/borrarSaludo/{id}', function ($request) {

    $valorRecibido = $request->getAttribute('id');
    $respuesta["mensaje"] = "Se ha borrado el saludo con id:" . $valorRecibido;
    echo json_encode($respuesta);
});


$app->put('/actualizarSaludo/{id}', function ($request) {

    $idRecibido = $request->getAttribute('id');
    $nombreRecibido = $request->getParam('nombre');

    $respuesta["mensaje"] = "Se ha actualizado el saludo con id:" . $idRecibido . " al nombre " . $nombreRecibido;

    echo json_encode($respuesta);
});

// La envia ns
$app->run();
