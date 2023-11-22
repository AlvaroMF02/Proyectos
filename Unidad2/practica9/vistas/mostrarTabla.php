<?php
// Llamada a la bd y mostrar tabla con los datos
if(!isset($conexion))
{
    try{
        $conexion=mysqli_connect("localhost","jose","josefa","bd_videoclub");
        mysqli_set_charset($conexion,"utf8");
    }
    catch(Exception $e)
    {
        die("<p>No ha podido conectarse a la base de batos: ".$e->getMessage()."</p></body></html>");
    }
}
try{
    $consulta="select * from peliculas";
    $resultado=mysqli_query($conexion, $consulta);
}
catch(Exception $e)
{
    mysqli_close($conexion);
    die("<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p></body></html>");
}

echo "<h2>Listado películas</h2>";
echo "<table>";
echo "<tr><th>id</th><th>Título</th><th>Carátula</th><th><form action='index.php' method='post'><button class='enlace' type='submit' name='btnNuevoUsuario'>Peliculas+</button></form></th></tr>";
while($tupla=mysqli_fetch_assoc($resultado))
{
    echo "<tr>";
    echo "<td>".$tupla["idPelicula"]."</td>";
    echo "<td><form action='index.php' method='post'><button class='enlace' type='submit' value='".$tupla["idPelicula"]."' name='btnmostrarDetalles'>".$tupla["titulo"]."</button></form></td>";
    echo "<td><img src='Img/".$tupla["caratula"]."' alt='Carátula de la película' title='Carátula'></td>";
    echo "<td><form action='index.php' method='post'><button class='enlace' type='submit' value='".$tupla["idPelicula"]."' name='btnBorrar'>Borrar</button> - <button class='enlace' type='submit' value='".$tupla["idPelicula"]."' name='btnEditar'>Editar</button></form></td>";
    echo "</tr>";
}
echo "</table>";
mysqli_free_result($resultado);
mysqli_close($conexion);
?>