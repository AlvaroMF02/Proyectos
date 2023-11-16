<h1>Agregar Nuevo Usuario</h1>
<?php
if (isset($_POST["btnContInsertar"])) {
    $errorNombre = $_POST["nombre"] == "" || strlen($_POST["nombre"]) > 50;
    $errorUsuari = $_POST["usuario"] == "" || strlen($_POST["usuario"]) > 30;
    $errorClave=$_POST["clave"]=="" || strlen($_POST["clave"])>50;
    $errorDni=$_POST["dni"]=="" || strlen($_POST["dni"])>10;            // falta todo

    // repetido usuario
    if (!$errorUsuari) {
        try {
            $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_cv");
            mysqli_set_charset($conexion, "utf8");
        } catch (Exception $e) {
            die(error_page("Práctica 1º CRUD", "<h1>Práctica 1º CRUD</h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
        }

        $error_usuario = repetido($conexion, "usuarios", "usuario", $_POST["usuario"]);

        if (is_string($errorUsuari))
            die($errorUsuari);
    }
    // repetido dni
    if (!$errorDni) {
        try {
            $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_cv");
            mysqli_set_charset($conexion, "utf8");
        } catch (Exception $e) {
            die(error_page("Práctica 1º CRUD", "<h1>Práctica 1º CRUD</h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
        }

        $error_usuario = repetido($conexion, "usuarios", "usuario", $_POST["dni"]);

        if (is_string($errorUsuari))
            die($errorUsuari);
    }

    // cambiar todo
    $errorForm=$errorNombre||$errorUsuari||$errorClave||$errorDni;

        if(!$errorForm){
            try{
                $consulta="insert into usuarios (usuario, clave, nombre, dni, sexo, foto) values ('".$_POST["usuario"]."','".md5($_POST["clave"])."','".$_POST["nombre"]."','".$_POST["dni"]."','".$_POST["sexo"]."','".$_POST["foto"]."')";
                mysqli_query($conexion,$consulta);
            }
            catch(Exception $e)
            {
                mysqli_close($conexion);
                die(error_page("Práctica 1º CRUD","<h1>Práctica 1º CRUD</h1><p>No se ha podido hacer la consulta: ".$e->getMessage()."</p>"));
            }
            
            mysqli_close($conexion);

            header("Location:index.php");
            exit;
            
        }

        //Por aquí continuo sólo si hay errores en el formulario

        if(isset($conexion))
            mysqli_close($conexion);
    
        
}
?>


<form action="index.php" method="post">
    <label for="nombre">Nombre:</label><br>
    <input type="text" name="nombre" id="nombre" maxlength="50" placeholder="Nombre..." value="<?php if (isset($_POST["nombre"])) echo $_POST["nombre"] ?>">
    <?php
    // if (isset($_POST["continuar"]) && $errorNombre) {
    //     if ($_POST["nombre"] == "") {
    //         echo "<span class='error'>* Campo vacío * </span>";
    //     } else {
    //         echo "<span class='error'>* El tamaño debe ser menor a 30 caracteres *</span>";
    //     }
    // }
    ?>

    <br>
    <label for="usuario">Usuario:</label><br>
    <input type="text" name="usuario" id="usuario" maxlength="30" placeholder="Usuario..." value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"] ?>">
    <?php
    if (isset($_POST["btnContinUsuaNuevo"]) && $errorUsuar) {
        echo "<span class='error'>* Campo vacío *</span>";
    }
    ?>

    <br>
    <label for="clave">Contraseña:</label><br>
    <input type="password" name="clave" id="clave" placeholder="Contraseña..." maxlength="50">
    <?php
    // if (isset($_POST["continuar"]) && $errorContr) {
    //     if ($_POST["ctrs"] == "") {
    //         echo "<span class='error'>* Campo vacío *</span>";
    //     } else {
    //         echo "<span class='error'>* El tamaño debe ser menor a 20 caracteres *</span>";
    //     }
    // }
    ?>

    <br>
    <label for="dni">Dni:</label><br>
    <input type="text" name="dni" id="dni" maxlength="10" placeholder="DNI: 11223344Z" value="<?php if (isset($_POST["dni"])) echo $_POST["dni"] ?>">
    <?php
    // if (isset($_POST["continuar"]) && $errorNombre) {
    //     if ($_POST["nombre"] == "") {
    //         echo "<span class='error'>* Campo vacío * </span>";
    //     } else {
    //         echo "<span class='error'>* El tamaño debe ser menor a 30 caracteres *</span>";
    //     }
    // }
    ?>

    <br>
    <label for="sexo">Sexo:</label><br>
    <input type="radio" name="sexo" id="hombre" value="hombre"><label for="hombre">Hombre</label><br>
    <input type="radio" name="sexo" id="mujer" value="mujer"><label for="mujer">Mujer</label>
    <?php
    // if (isset($_POST["continuar"]) && $errorNombre) {
    //     if ($_POST["nombre"] == "") {
    //         echo "<span class='error'>* Campo vacío * </span>";
    //     } else {
    //         echo "<span class='error'>* El tamaño debe ser menor a 30 caracteres *</span>";
    //     }
    // }
    ?>

    <p><label for="foto">Incluir mi foto (Max. 500KB)</label>
        <input type="file" name="foto" id="foto">
    </p>
    <?php
    // if (isset($_POST["continuar"]) && $errorNombre) {
    //     if ($_POST["nombre"] == "") {
    //         echo "<span class='error'>* Campo vacío * </span>";
    //     } else {
    //         echo "<span class='error'>* El tamaño debe ser menor a 30 caracteres *</span>";
    //     }
    // }
    ?>

    <button type="submit" name="btnContinUsuaNuevo">Continuar</button>
    <button type="submit">Volver</button>
    </p>
</form>