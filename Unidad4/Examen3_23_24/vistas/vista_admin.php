<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Examen3 Curso 23-24</title>
        <style>
            .enlinea{display:inline}
            .enlace{border:none;background:none;text-decoration:underline;color:blue;cursor:pointer}
            td,th {border: 1px solid black}
            table{border-collapse: collapse;text-align: center;width: 80%;margin: 0 auto;}
            th{background-color: #CCC}

        </style>
    </head>
    <body>
        <h1>Librería (admin)</h1>
        <div>Bienvenido <strong><?php echo $datos_usuario_logueado["lector"];?></strong> - 
            <form class='enlinea' action="gest_libros.php" method="post">
                <button class='enlace' type="submit" name="btnSalir">Salir</button>
            </form>
        </div>
        <h3>Listado de libros</h3>

        <?php
        // dependiendo del boton al que le haya dado te muestra un msj u otro
        if (isset($_POST['btnBorrar'])) {
        echo "El libro con Referencia " . $_POST['referencia'] . " ha sido eliminado con exito";
        } elseif (isset($_POST['btnEditar'])) {
            echo "El libro con Referencia " . $_POST['referencia'] . " ha sido editado con exito";
        }


        // hago una consulta con todos los libros
        try {
            $consulta = "select * from libros";
            $resultado = mysqli_query($conexion,$consulta);
        } catch (Exception $e) {
            // aqui se cierra una sesion ????????????????
            mysqli_close($conexion);
            die("<p>No se ha podido realizar la consulta</p></body></html>");
        }

        // mostrar los libros en una tabla
        echo "<table>";
        echo "<tr><th>REF</th><th>Titulo</th><th>Acción</th></tr>";
        while ($tupla = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>" . $tupla["referencia"] . "</td>";
            echo "<td>" . $tupla["titulo"] . "</td>";
            echo "<td><form action='gest_libros.php' method='post'> <input type='hidden' name='referencia' value='" . $tupla["referencia"] . "'>
                    <button class='enlace' type='submit' name='btnBorrar'>Borrar</button>-<button class='enlace' type='submit' name='btnEditar'>Editar</button></form></td>";
            echo "</tr>";
        }
        echo "</table>";
        
        ?>
    </body>
    </html>