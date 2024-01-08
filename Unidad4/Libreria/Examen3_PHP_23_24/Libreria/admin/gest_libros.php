<?php
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>

<body>
    <h1>Librería</h1>
    <p>Bienvenido <s><?php $_SESSION["usuario"] ?></s></p>
    <form action="gest_libros.php" method="post">
        - <button type="submit" name="btnSalir">Salir</button>
    </form>
    <?php
    echo "<h3>Listado de los libros</h3>";
    if (isset($_POST['btnBorrar'])) {
        echo "El libro con Referencia " . $_POST['referencia'] . " ha sido eliminado con exito";
    } elseif (isset($_POST['btnEditar'])) {
        echo "El libro con Referencia " . $_POST['referencia'] . " ha sido editado con exito";
    }


    // Conexion
    try {
        $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_libreria_exam");
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        session_destroy();
        die("<p>No se ha podido hacer la conexion</p></body></html>");
    }

    // consulta para ver los libros
    try {
        $consulta = "select * from libros";
        $resultado = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        session_destroy();
        die("<p>No se ha podido hacer la consulta</p></body></html>");
    }

    echo "<table>";

    echo "<tr><th>REF</th><th>Titulo</th><th>Acción</th></tr>";
    while ($tupla = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td>" . $tupla["referencia"] . "</td>";
        echo "<td>" . $tupla["titulo"] . "</td>";
        echo "<td><form action='gest_libros.php' method='post'> <input type='hidden' name='referencia' value='" . $tupla["referencia"] . "'><button type='submit' name='btnBorrar'>Borrar</button> - <button type='submit' name='btnEditar'>Editar</button></form></td>";
        echo "</tr>";
    }
    echo "</table>";

    // si no se ha pulsado el boton muestra el boton para pulsarlo
    if (!isset($_POST["btnAgregar"])) {
        echo "<form action='gest_libros.php' method='post'> <button type='submit' name='btnAgregar'>Agregar</button></form>";
    } else {
    ?>
        <h3>Agregar un nuevo libro</h3>
        <form action="gest_libros.php" method="post">
            <label for="referencia">Referencia:</label>
            <input type="text" name="referencia" id="referencia" value="<?php if (isset($_POST["referencia"])) echo $_POST["referencia"] ?>">
            <?php
            if (isset($_POST["btnAgregarContinuar"]) && $errorRefe) {
                echo "Campo vacio";
            }
            ?>
            <br>
            <label for="titulo">Titulo:</label>
            <input type="text" name="titulo" id="titulo" maxlength="30">
            <?php
            if (isset($_POST["btnAgregarContinuar"]) && $errorTitu) {
                echo "Campo vacio";
            }
            ?>
            <br>
            <label for="autor">Autor:</label>
            <input type="text" name="autor" id="autor" maxlength="30">
            <?php
            if (isset($_POST["btnAgregarContinuar"]) && $errorAut) {
                echo "Campo vacio";
            }
            ?>
            <br>
            <label for="titulo">Descripcion:</label>
            <textarea name="titulo" id="descripcion"></textarea>
            <br>
            <label for="titulo">Precio:</label>
            <input type="text" name="precio" id="titulo">
            <?php
            if (isset($_POST["btnAgregarContinuar"]) && $errorPreci) {
                echo "Campo vacio";
            }
            ?>
            <br>
            <button type="submit" name="btnAgregarContinuar">Agregar</button>
        </form>
    <?php
    }

    ?>
</body>

</html>