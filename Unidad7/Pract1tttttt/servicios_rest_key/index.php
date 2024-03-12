<?php
require "src/funciones_ctes.php";

require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;

$app->post('/salir', function ($request) {
    session_id($request->getParam('api_session'));
    session_start();
    session_destroy();
    echo json_encode(array("logout" => "Close sesion"));
});


$app->get('/productos', function ($request) {
    echo json_encode(obtener_productos());
});

$app->get('/producto/{cod}', function ($request) {
    echo json_encode(obtener_producto($request->getAttribute('cod')));
});


$app->post('/producto/insertar', function ($request) {
    $datos[] = $request->getParam("cod");
    $datos[] = $request->getParam("nombre");
    $datos[] = $request->getParam("nombre_corto");
    $datos[] = $request->getParam("descripcion");
    $datos[] = $request->getParam("PVP");
    $datos[] = $request->getParam("familia");

    echo json_encode(insertar_producto($datos));
});

$app->put('/producto/actualizar/{cod}', function ($request) {
    $datos[] = $request->getParam("nombre");
    $datos[] = $request->getParam("nombre_corto");
    $datos[] = $request->getParam("descripcion");
    $datos[] = $request->getParam("PVP");
    $datos[] = $request->getParam("familia");
    $datos[] = $request->getAttribute("cod");

    echo json_encode(actualizar_producto($datos));
});

$app->delete('/producto/borrar/{cod}', function ($request) {
    echo json_encode(borrar_producto($request->getAttribute("cod")));
});

$app->get('/familias', function ($request) {
    echo json_encode(obtener_familias());
});

$app->get('/familia/{cod}', function ($request) {
    echo json_encode(obtener_familia($request->getAttribute('cod')));
});

$app->get('/repetido/{tabla}/{columna}/{valor}', function ($request) {
    echo json_encode(repetido($request->getAttribute('tabla'), $request->getAttribute('columna'), $request->getAttribute('valor')));
});

$app->get('/repetido/{tabla}/{columna}/{valor}/{columna_id}/{valor_id}', function ($request) {
    echo json_encode(repetido($request->getAttribute('tabla'), $request->getAttribute('columna'), $request->getAttribute('valor'), $request->getAttribute('columna_id'), $request->getAttribute('valor_id')));
});

$app->run();
