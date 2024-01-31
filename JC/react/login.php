<?php
header('Access-Control-Allow-Origin: *'); 

$_POST = json_decode(file_get_contents("php://input"),true);
 if ($_POST["telefono"]=="alvaro" && $_POST["password"]=="08d6c05a21512a79a1dfeb9d2a8f262f"){
    $respuesta["usuario"]="fulanico";
    $respuesta["mensaje"]="Acceso correcto";
 }else{
    $respuesta["mensaje"]="Acceso incorrecto";
 }
 echo json_encode($respuesta);
?>