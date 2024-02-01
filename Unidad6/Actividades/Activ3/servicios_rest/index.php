<?php

require "src/func_const.php";

require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;

$app->get("/usuarios",function(){

    json_encode(usuarios());
});


$app->run();
