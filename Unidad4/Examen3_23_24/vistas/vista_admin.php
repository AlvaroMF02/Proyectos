<?php
    // Poner los mensajes como sesiones 


    if (isset($_POST["btnAgregarContinuar"])) {
        // errores
        $errorRefe = $_POST["referencia"] == "";
        $errortitu = $_POST["titulo"] == "";
        $errorAut = $_POST["autor"] == "";
        $errorPreci = $_POST["precio"] == "";
    
        $errorform = $errorRefe || $errortitu || $errorAut || $errorPreci;
    
        if (!$errorform) {
            // si no hay errores argega el libro a la bd (mal ni lo he probado)
    
            // Conexion
            try {
                $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_libreria_exam");
                mysqli_set_charset($conexion, "utf8");
            } catch (Exception $e) {
                error_page("Error Conexion", "Ha habido un error en la conexion");
            }
    
            // agrega run libro
            try {
                $consulta = "insert into libros (referencia, titulo, autor, descripcion, precio) values (" . $_POST["referencia"] . "," . $_POST["titulo"] . "," . $_POST["autor"] . "," . $_POST["descripcion"] . "," . $_POST["precio"] . ")";
                $resultado = mysqli_query($conexion, $consulta);
            } catch (Exception $e) {
                error_page("Error Consulta", "Ha habido un error en la consulta");
            }
        }
    }
    


?>

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
            table{border-collapse: collapse;text-align: center;width: 80%}
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
        echo "<p>El libro con Referencia " . $_POST['referencia'] . " ha sido eliminado con exito</p>";
        } elseif (isset($_POST['btnEditar'])) {
            echo "<p>El libro con Referencia " . $_POST['referencia'] . " ha sido editado con exito</p>";
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


        // parte para agregar un libro

        // 2º si el boton se ha presionado te muestra el formulario para agregar
        if(isset($_POST["btnAgregar"])){
            // formulario para agregar
            ?>
                <h3>Agregar un nuevo libro</h3>
                <form action="gest_libros.php" method="post" enctype="multipart/form-data">
                    <p>
                        <label for="referencia">Referencia:</label>
                        <input type="text" name="referencia" id="referencia" value="<?php if (isset($_POST["referencia"])) echo $_POST["referencia"] ?>">
                        <?php
                        if (isset($_POST["btnAgregarContinuar"]) && $errorRefe) {
                            echo "Campo vacio";
                        }
                        ?>
                    </p>
                    <p>
                        <label for="titulo">Titulo:</label>
                        <input type="text" name="titulo" id="titulo" maxlength="30">
                        <?php
                        if (isset($_POST["btnAgregarContinuar"]) && $errorTitu) {
                            echo "Campo vacio";
                        }
                        ?>
                    </p>
                    <p>
                        <label for="autor">Autor:</label>
                        <input type="text" name="autor" id="autor" maxlength="30">
                        <?php
                        if (isset($_POST["btnAgregarContinuar"]) && $errorAut) {
                            echo "Campo vacio";
                        }
                        ?>
                    </p>
                    <p>
                        <label for="titulo">Descripcion:</label>
                        <textarea name="titulo" id="descripcion"></textarea>
                    </p>
                    <p>
                        <label for="titulo">Precio:</label>
                        <input type="text" name="precio" id="titulo">
                        <?php
                        if (isset($_POST["btnAgregarContinuar"]) && $errorPreci) {
                            echo "Campo vacio";
                        }
                        ?>
                    </p>
                    <p>
                        <label for="portada">Portada:</label>
                        <input type="file" name="portada" id="portada" accept="image/">
                    </p>
                    <button type="submit" name="btnAgregarContinuar">Agregar</button>
                </form>
            <?php
        }else{
             // 1º pone el boton con el que agregaremos un libro nuevo
            echo "<form class='enlinea' action='gest_libros.php' method='post'>
                <p><button type='submit' name='btnAgregar'>Agregar</button></p>
            </form>";
        }
        ?>
    </body>
</html>