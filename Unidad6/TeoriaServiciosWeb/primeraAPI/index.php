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


// La envia ns
$app->run();
