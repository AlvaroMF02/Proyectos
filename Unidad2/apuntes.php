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

// Pasar la consulta a la conexión
$resultado = mysqli_query($conexion, $consulta);



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
