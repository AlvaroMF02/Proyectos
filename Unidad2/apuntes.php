<?php

// Hacer la conexion a la bd
$conexion = mysqli_connect("localhost", "jose", "josefa", "bd_videoclub");
// Pone el utf-8 no se
mysqli_set_charset($conexion, "utf8");



//Hacer una consulta
// ver
$consulta = "select * from peliculas where idPelicula='" . $_POST["btnDetalle"] . "'";
// insertar
$consulta = "insert into peliculas (titulo, director, tematica, sinopsis) values ('" . $_POST["titulo"] . "', '" . $_POST["director"] . "', '" . $_POST["tematica"] . "', '" . $_POST["sinopsis"] . "')";
//editar

//borrar
$consulta = "delete from peliculas where idPelicula='" . $_POST["btnContBorrar"] . "'";

// Pasar la consulta a la conexión
$resultado = mysqli_query($conexion, $consulta);

$datos = mysqli_fetch_assoc($resultado);


// Numero de tuplas que se han podido recoger con la consulta
mysqli_num_rows($resultado);    // Dentro de un if >0 para estar seguros de que hay datos

// Guardar los datos en una variable
$datos_peli = mysqli_fetch_assoc($resultado);
// Liberar el resultado
mysqli_free_result($resultado);

// npi que hace esto
header("Location: index.php");

// cerrar la conexion
mysqli_close($conexion);

// guardar el id de la conexion
$last_id = mysqli_insert_id($conexion);




try{
    $conexion=mysqli_connect("localhost","jose","josefa","bd_exam_colegio");
    mysqli_set_charset($conexion,"utf8");
}
catch(Exception $e)
{
    session_destroy();
    die(error_page("Examen2 DWESE 22-23","<h1>Notas de los Alumnos</h1><p>No se ha podido conectar a la BD: ".$e->getMessage()."</p>"));
}

function error_page($title,$body)
{
    $page='<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>'.$title.'</title>
    </head>
    <body>'.$body.'</body>
    </html>';
    return $page;
}

while($tupla=mysqli_fetch_assoc($resultado)){}