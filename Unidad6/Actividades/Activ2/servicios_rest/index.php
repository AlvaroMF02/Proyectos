<?php

require "src/func_const.php";

require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;

// Información de todos los productos
$app->get("/productos", function () {
    echo json_encode(obtener_productos());
});

// Todos los datos del producto cuyo código pongamos
$app->get("/producto/{cod}", function ($request) { // A la function le tenemos que pasar una request si tenemos un parámetro en la url
    $producto = $request->getAttribute("cod");
    echo json_encode(obtener_producto($producto));
});

// Insertaremos los productos que le pasaremos por un formulario
$app->post("/producto/insertar", function ($request) {
    $datos[] = $request->getParam("cod");
    $datos[] = $request->getParam("nombre");
    $datos[] = $request->getParam("nombre_corto");
    $datos[] = $request->getParam("descripcion");
    $datos[] = $request->getParam("PVP");
    $datos[] = $request->getParam("familia");

    echo json_encode(insertar_producto($datos)); // Los datos los tenemos en el orden que aparecen en el insert
});

// Actualizaremos todos los datos del producto especificado
$app->put("/producto/actualizar/{cod}", function ($request) {
    $datos[] = $request->getParam("nombre");
    $datos[] = $request->getParam("nombre_corto");
    $datos[] = $request->getParam("descripcion");
    $datos[] = $request->getParam("PVP");
    $datos[] = $request->getParam("familia");
    $datos[] = $request->getAttribute("cod");

    echo json_encode(actualizar_producto($datos));
});

// Borrar un producto con un código
$app->delete("/producto/borrar/{cod}", function ($request) {
    echo json_encode(borrar_producto($request->getAttribute("cod")));
});

// Información de todas las familias
$app->get("/familias", function () {
    echo json_encode(obtener_familias());
});

// Nos devuelve verdadero si ya existe el valor en una columna de una tabla (para los insertar)
$app->get("/repetido/{tabla}/{columna}/{valor}", function ($request) {
    echo json_encode(repetido($request->getAttribute("tabla"), $request->getAttribute("columna"), $request->getAttribute("valor")));
});

// Nos devuelve verdadero si ya existe el valor en una columna de una tabla (para los editar)
$app->get("/repetido/{tabla}/{columna}/{valor}/{columna_id}/{valor_id}", function ($request) {
    echo json_encode(repetido_editar($request->getAttribute("tabla"), $request->getAttribute("columna"), $request->getAttribute("valor"), $request->getAttribute("columna_id"), $request->getAttribute("valor_id")));
});

$app->run();
