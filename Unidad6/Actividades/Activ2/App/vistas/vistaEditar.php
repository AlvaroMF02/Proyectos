<?php

if (isset($_POST["btnEditar"])) {
    $cod = $_POST["btnEditar"];
} elseif (isset($_POST["btnContiEdit"])) {
    $cod = $_POST["btnContiEdit"];
}

// coger los productos con el id para ponerlos en el value
$urlDetall = DIR_SERV . "/producto/" . urlencode($cod);
$respuDetall = consumir_servicios_REST($urlDetall, "GET");
$objDetall = json_decode($respuDetall);

// ver si hay errores
if (!$objDetall) {
    echo "Error consumiendo el servicio: " . $respuDetall;
}
if (isset($objDetall->mensaje_error)) {
    echo "Error en la consulta: " . $objDetall->mensaje_error;
}


echo "<h2>Editar producto ".$cod."</h2>";
?>
<form action="index.php" method="post">
    
    <p>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" maxlength="200" value="<?php echo $objDetall->producto->nombre ?>">
    </p>
    <p>
        <label for="nombre_corto">Nombre corto</label>
        <input type="text" name="nombre_corto" id="nombre_corto" maxlength="50" value="<?php echo $objDetall->producto->nombre_corto ?>">
    </p>
    <p>
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" id="descripcion" cols="30" rows="5"><?php echo $objDetall->producto->descripcion ?></textarea>
    </p>
    <p>
        <label for="pvp">PVP</label>
        <input type="text" name="pvp" id="pvp" value="<?php echo $objDetall->producto->PVP ?>">
        <?php
        if (isset($_POST["btnContiEdit"]) && $errorPvp) {
            if ($_POST["pvp"] == "") {
                echo "<span class='error'>Campo vacio</span>";
            } else {
                echo "<span class='error'>Introduza números</span>";
            }
        }
        ?>
    </p>
    <p>
        <label for="familia">Familia</label>
        <select name="familia" id="familia">
            <?php
            $urlFamil = DIR_SERV . "/familias";
            $respuesFamil = consumir_servicios_REST($urlFamil, "GET");
            $objFamilia = json_decode($respuesFamil);

            if (!$objFamilia) die("Error API: " . $respuesFamil);
            if (isset($objFamilia->mensaje_error)) echo "Error consulta: " . $objFamilia->mensaje_error;

            for ($i = 0; $i < count($objFamilia->productos); $i++) {
                if ($_POST["familia"] == $objFamilia->productos[$i]->cod) {
                    echo "<option selected value='" . $objFamilia->productos[$i]->cod . "'>" . $objFamilia->productos[$i]->cod . "</option>";

                } elseif ( $objFamilia->productos[$i]->cod == $objDetall->producto->familia) {

                    echo "<option selected value='" . $objFamilia->productos[$i]->cod . "'>" . $objFamilia->productos[$i]->cod . "</option>";
                } else {

                    echo "<option value='" . $objFamilia->productos[$i]->cod . "'>" . $objFamilia->productos[$i]->cod . "</option>";
                }
            }
            ?>
        </select>
    </p>

    <p>
        <button type="submit" name="btnContiEdit" value="<?php echo $cod ?>">Editar</button>
        <button type="submit">Cancelar</button>
    </p>

</form>