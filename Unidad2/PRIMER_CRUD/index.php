<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 1º CRUD</title>
    <style>
        table,
        th,
        td {
            border: solid 1px black;
        }

        table {
            border-collapse: collapse;
            text-align: center;
        }

        th {
            background-color: #CCC;
        }

        table img{
            height:60px;
            width:65px
        }
    </style>
</head>
<body>
    <h1>Listado de los usuarios</h1>
    
    <?php
    try {
        $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_foro");
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        die("<p>No se ha podido conectar a la base de datos:" . $e->getMessage() . "</p></body></html>");
    }

    $consulta = "select * from usuarios";
    try {
        $resultado = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die("<p>Imposible realizar la consulta:" . $e->getMessage() . "</p></body></html>");
    }

    mysqli_data_seek($resultado, 0);
    echo "<table>";
    echo "<tr><th>Nombre de Usuario</th><th>Borrar</th><th>Editar</th></tr>";

    // MIENTRAS HAYA TUPLAS     tmb se puede hacer escalar con un for
    while($tupla = mysqli_fetch_assoc($resultado)){
        echo "<tr>";
        echo "<td>".$tupla["nombre"]."</td>";
        echo "<td><img src='images/borrar.png' title='Borrar usuario' alt='Borrar'></td>";
        echo "<td><img src='images/editar.png' title='Editar usuario' alt='Editar'></td>";
        echo "</tr>";
    }
    echo "</table>";

    echo "<br>";
    echo "<form action='usuario_nuevo.php' method='post'>";
    echo "<button type='submit' name='botonUsuNuev'>Nuevo usuario</button>";
    echo"</form>";
    mysqli_free_result($resultado);
    mysqli_close($conexion);
    ?>
</body>
</html>