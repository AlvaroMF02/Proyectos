<?php

if (isset($_POST["botonUsuNuev"]) || isset($_POST["continuar"])) {

    if (isset($_POST["continuar"])) {
        $errorNombre = $_POST["nombre"] == "";
        $errorUsuar = $_POST["usuario"] == "";
        $errorContr = $_POST["ctrs"] == "";
        $errorEmail = $_POST["email"] == "" || !filter_var($_POST["email"],FILTER_VALIDATE_EMAIL);

        $errorForm = $errorEmail || $errorUsuar || $errorNombre;
    }
?>


    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Practica 1º CRUD</title>
    </head>

    <body>
        <h1>Nuevo Usuario</h1>
        <form action="usuario_nuevo.php" method="post">
            <p>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" maxlength="30" value="<?php if (isset($_POST["continuar"]) && isset($_POST["nombre"])) echo $_POST["nombre"] ?>">
                <?php
                 if (isset($_POST["continuar"]) && $errorNombre) {
                    echo "* Campo vacío *";
                }
                ?>
            </p>
            <p>
                <label for="usuario">Usuario:</label>
                <input type="text" name="usuario" id="usuario" maxlength="20" value="<?php if (isset($_POST["continuar"]) && isset($_POST["usuario"])) echo $_POST["usuario"] ?>">
                <?php
                 if (isset($_POST["continuar"]) && $errorUsuar) {
                    echo "* Campo vacío *";
                }
                ?>
            </p>
            <p>
                <label for="ctrs">Contraseña:</label>
                <input type="password" name="ctrs" id="ctrs" maxlength="15">
                <?php
                 if (isset($_POST["continuar"]) && $errorContr) {
                    echo "* Campo vacío *";
                }
                ?>
            </p>
            <p>
                <label for="email">Email:</label>
                <input type="text" name="email" maxlength="50" id="email" value="<?php if (isset($_POST["continuar"]) && isset($_POST["email"])) echo $_POST["email"] ?>">
                <?php
                 if (isset($_POST["continuar"]) && $errorEmail) {
                    echo "* Campo mal escrito *";
                }
                ?>
            </p>
            <p>
                <button type="submit" name="continuar">Continuar</button>
                <button type="submit" name="volver">Volver</button>
            </p>
        </form>

        <?php
            if(isset($_POST["continuar"]) && !$errorForm){
                echo "miau";
            }
        ?>
    </body>

    </html>

<?php
} else {
    header("Location:index.php");
    exit;
}
?>