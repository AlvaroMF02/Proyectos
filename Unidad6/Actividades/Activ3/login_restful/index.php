<?php

require "src/func_const.php";

require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;

// a) Nos muestra todos los usuarios
$app->get("/usuarios",function(){

    echo json_encode(usuarios());
});

// b) Crea un usuario nuevo
$app->post("/crearUsuario",function($request){

    $datos["nombre"] = $request->getParam("nombre");
    $datos["usuario"] = $request->getParam("usuario");
    $datos["clave"] = $request->getParam("clave");
    $datos["email"] = $request->getParam("email");

    echo json_encode((crearUsuario($datos)));
});

// c) Pasa el usuario y clave para hacer el login
$app->post("/login",function($request){

    $datos["usuario"] = $request->getParam("usuario");
    $datos["clave"] = $request->getParam("clave"); // Viene encriptada del index

    echo json_encode(login($datos));
});

// d) Actualizar a un usuario
$app->put("/actualizarUsuario/{idUsuario}",function($request){

    
    $datos["nombre"] = $request->getParam("nombre");
    $datos["usuario"] = $request->getParam("usuario");
    $datos["clave"] = $request->getParam("clave");
    $datos["email"] = $request->getParam("email");
    $datos["id_usuario"] = $request->getAttribute("idUsuario");

    echo json_encode(actualizarUsu($datos));
});

// e) Eliminar a un usuario
$app->delete("/borrarUsuario/{idUsuario}",function($request){

    echo json_encode(borrarUsu($request->getAttibute("idUsuario")));

});

$app->run();
