<?php

require "src/func_const.php";

require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;

// a) Nos muestra todos los usuarios
$app->get("/usuarios",function(){

    echo json_encode(usuarios());
});
// a2) Nos muestra el usuario con el id
$app->get("/usuarios/{id}",function($request){

    $id = $request->getAttribute("id");
    echo json_encode(buscarUsuario($id));
});

// b) Crea un usuario nuevo
$app->post("/crearUsuario",function($request){

    $datos[] = $request->getParam("nombre");
    $datos[] = $request->getParam("usuario");
    $datos[] = $request->getParam("clave");
    $datos[] = $request->getParam("email");

    echo json_encode((crearUsuario($datos)));
});

// c) Pasa el usuario y clave para hacer el login
$app->post("/login",function($request){

    $datos[] = $request->getParam("usuario");
    $datos[] = $request->getParam("clave"); // Viene encriptada del index

    echo json_encode(login($datos));
});

$app->get('/logueado',function($request){

    $token=$request->getParam("api_session");
    session_id($token);
    session_start();
    if(isset($_SESSION["usuario"]))
    {
        echo json_encode(logueado($_SESSION["usuario"],$_SESSION["clave"]));
    }
    else
    {
        session_destroy();
        echo json_encode(array("no_auth"=>"No tienes permisos para usar este servicio"));
    }
});

$app->post('/salir',function($request){

    $token=$request->getParam("api_session");
    session_id($token);
    session_start();
    session_destroy();
    echo json_encode(array("log_out"=>"Cerrada sesión en la API"));
});

// d) Actualizar a un usuario
$app->put("/actualizarUsuario/{idUsuario}",function($request){

    $datos[] = $request->getParam("nombre");
    $datos[] = $request->getParam("usuario");
    $datos[] = $request->getParam("clave");
    $datos[] = $request->getParam("email");
    $datos[] = $request->getAttribute("idUsuario");

    echo json_encode(actualizarUsu($datos));
});

// e) Eliminar a un usuario
$app->delete("/borrarUsuario/{idUsuario}",function($request){

    echo json_encode(borrarUsu($request->getAttribute("idUsuario")));

});

// comprobar valores repetido al insertar
$app->get("/comprobarRepetido/{tabla}/{columna}/{valor}",function($request){

    echo json_encode(comprobarRepe($request->getAttribute("tabla"),$request->getAttribute("columna"),$request->getAttribute("valor")));

});
// comprobar valores repetido al editar
$app->get("/comprobarRepetidoEdit/{tabla}/{columna}/{valor}/{columnaId}/{valorId}",function($request){

    echo json_encode(comprobarRepeEdit($request->getAttribute("tabla"),$request->getAttribute("columna"),$request->getAttribute("valor"),$request->getAttribute("columnaId"),$request->getAttribute("valorId")));

});


$app->run();
