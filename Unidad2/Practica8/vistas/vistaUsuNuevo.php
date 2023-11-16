<h1>Agregar Nuevo Usuario</h1>
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