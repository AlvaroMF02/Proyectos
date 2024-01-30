<?php

// ------------------------ EDITAR PRODUCTO ------------------------
if (isset($_POST["btnContiEdit"])) {
    echo "miau";

    $errorCod = $_POST["codigo"] == "";
    // comprobar que no esta repe
    if (!$errorCod) {
        // ************* HACERLO CON EL REPETIR DE EDITAR *************
        $urlInsertCop = DIR_SERV . "/repetido/producto/cod/" . $_POST["codigo"];
        $respueInsertCop = consumir_servicios_REST($urlInsertCop, "GET");
        $objInsertcop = json_decode($respueInsertCop);

        if (!$objInsertcop) echo "Error API: " . $respueInsertCop;
        if (isset($objInsertcop->mensaje_error)) echo "Error consulta: " . $objInsertcop->mensaje_error;

        if ($objInsertcop->repetido) {
            $errorCod = true;
        }
    }

    $errorNombre = $_POST["nombre"] == "";
    $errorPvp = $_POST["pvp"] == "" || !is_numeric($_POST["pvp"]);

    $errorForm = $errorCod || $errorNombre || $errorPvp;

    // Si no hay errores hago la insercion de los datos
    if (!$errorForm) {
        // ------------------------ AÑADIR PRODUCTO ------------------------
        // crear el producto con los datos del formulario
        $datos["cod"] = $_POST["codigo"];
        $datos["nombre"] = $_POST["nombre"];
        $datos["nombre_corto"] = $_POST["nombre_corto"];
        $datos["descripcion"] = $_POST["descripcion"];
        $datos["PVP"] = $_POST["pvp"];
        $datos["familia"] = $_POST["familia"];

        $urlInsert = DIR_SERV . "/producto/insertar";
        $respueInsert = consumir_servicios_REST($urlInsert, "POST", $datos);
        $objInsert = json_decode($respueInsert);

        if (!$objInsert) echo "Error API: " . $respueInsert;
        if (isset($objInsert->mensaje_error)) echo "Error consulta: " . $objInsert->mensaje_error;

        $_SESSION["mensaje"] = $objInsert->mensaje;
        header("Location:index.php");
        exit;
    }
    
}

// coger los productos con el id para ponerlos en el value
$urlDetall = DIR_SERV . "/producto/" . urlencode($_POST["btnEditar"]);
$respuDetall = consumir_servicios_REST($urlDetall, "GET");
$objDetall = json_decode($respuDetall);

// ver si hay errores
if (!$objDetall) {
    echo "Error consumiendo el servicio: " . $respuDetall;
}
if (isset($objDetall->mensaje_error)) {
    echo "Error en la consulta: " . $objDetall->mensaje_error;
}


echo "<h2>Editar producto</h2>";
?>
<form action="index.php" method="post">
    <p>
        <label for="codigo">Código</label>
        <input type="text" name="codigo" id="codigo" maxlength="12" value="<?php echo $objDetall->producto->cod ?>">
        <?php
        if (isset($_POST["btnContiEdit"]) && $errorCod) {
            if ($_POST["codigo"] == "") {
                echo "<span class='error'>Campo vacio</span>";
            } else {
                echo "<span class='error'>Código repetido</span>";
            }
        }
        ?>
    </p>
    <p>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" maxlength="200" value="<?php echo $objDetall->producto->nombre ?>">
        <?php
        if (isset($_POST["btnContiEdit"])  && $errorNombre) {
            echo "<span class='error'>Campo vacio</span>";
        }
        ?>
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

            // ************************************************************** FALTA PONER LA FAMILIA NO LO COGE **************************************************************
            for ($i = 0; $i < count($objFamilia->productos); $i++) {
                if ($_POST["familia"] == $objFamilia->productos[$i]->cod) {
                    echo "<option selected value='" . $objFamilia->productos[$i]->cod . "'>" . $objFamilia->productos[$i]->cod . "</option>";

                } elseif ($_POST["familia"] == $objDetall->producto->familia) {

                    echo "<option selected value='" . $objFamilia->productos[$i]->cod . "'>" . $objFamilia->productos[$i]->cod . "</option>";
                } else {

                    echo "<option value='" . $objFamilia->productos[$i]->cod . "'>" . $objFamilia->productos[$i]->cod . "</option>";
                }
            }
            ?>
        </select>
    </p>

    <p>
        <button type="submit" name="btnContiEdit">Editar</button>
        <button type="submit">Cancelar</button>
    </p>

</form>