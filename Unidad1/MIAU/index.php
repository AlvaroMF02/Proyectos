<?php

function mi_strlen($texto){
    $cont=0;
    while (isset($texto[$cont])){
        $cont++;
    }
    return $cont;
}

function mi_explode($sep,$texto){
    $aux = [];
    $l_texto = mi_strlen($texto);
    $i = 0;

    // QUITAR SEPARADORES DEL PRINCIPIO ,,,,
    while ($i<$l_texto && $texto[$i]==$sep) {
        $i++;
    }
    // YA QUITADOS LOS DE ALANTE:
    if($i<$l_texto){
        $j = 0;
        // METE LA PRIMERA LETRA
        $aux[$j] = $texto[$i];
        // HASTA EL FINAL
        for ($i=$i+1; $i<$l_texto ; $i++) { 
            // SI NO ES SEPARADOR LO METE EN AUX
            if($texto[$i]!=$sep){
                $aux[$j] .=$texto[$i];
            }else{
                // HE ENCONTRADO UN SEPARADPOR
                // LOS QUITO OTRA VEZ
                while ($i<$l_texto && $texto[$i]==$sep) {
                    $i++;
                }
                // PARA LOS QUE SE REPITEN AL FINAL
                if($i<$l_texto){
                    $j++;
                    $aux[$j]=$texto[$i];
                }
            }
        }
    }
    return $aux;
}

function LetraNIF($dni){
    return substr("TRWAGMYFPDXBNJZSQVHLCKEO", $dni % 23, 1);
}

function dniBienEscrito($texto){
    return strlen($texto) == 9 && is_numeric(substr($texto, 0, 8))
        && substr($texto, -1) >= "A" && substr($texto, -1) <= "Z";
}
function dniValido($texto){
    $numero = substr($texto, 0, 8);
    $letra = substr($texto, -1);
    $valido = LetraNIF($numero) == $letra;
    return $valido;
}

if (isset($_POST["botonBor"])) {    // SE PUEDE BORRAR DE DOS MANERAS
    unset($_POST);
}

if (isset($_POST["botonSub"])) {    // SE COMPRUEBA ERRORES COMO DEJAR EL NOMBRE VACIO

    $error_nombre = $_POST["nombre"] == "";
    $error_sexo = !isset($_POST["sexo"]);           // SI NO EXISTE
    $error_dni = $_POST["dni"] == "" || !dniBienEscrito(strtoupper($_POST["dni"])) || !dniValido(strtoupper($_POST["dni"]));
    // NO SE HA SELECCIONADO ARCHIVO
    $errorVacio = $_FILES["archivo"]["name"] == "";
    // SI NO ES TXT
    $errorFormato = $_FILES["archivo"]["type"] != "text/plain";
    // SI TIENE UN ERROR DE ARCHIVO
    $errorArchivo = $_FILES["archivo"]["error"];
    // SI SUPERA EL TAMAÑO
    $errorTaman = $_FILES["archivo"]["size"] > 500 * 1024;
    $error_archivo = $_FILES["archivo"]["name"] != "" && ($_FILES["archivo"]["error"] || !getimagesize($_FILES["archivo"]["tmp_name"]) || $_FILES["archivo"]["size"] > 500 * 1024);
    // ERROR SI HAY UNO ERROR DE LOS ANTERIORES

    $error_form = $error_nombre || $$errorVacio || $errorArchivo ||  $errorFormato || $errorTaman || $error_apellido || $error_clave || $error_sexo || $error_dni;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pruebas</title>
</head>

<body>
    <form action="index.php" method="post" enctype="multipart/form-data">

        <p>
            <!-- CASILLAS CON TEXTO -->
            <label for="nombre">Nombre</label></br>
            <input type="text" name="nombre" id="nombre" value="<?php if (isset($_POST["nombre"])) echo $_POST["nombre"] ?>">
            <?php
            if (isset($_POST["botonSub"]) && $error_nombre) {
                echo "<span class='error'>Campo vacío </span>";
            }
            ?>
        </p>

        <p>
            <!-- DNI -->
            <label for="dni">DNI</label></br>
            <input type="text" name="dni" id="dni" placeholder="DNI: 11223344Z" value="<?php if (isset($_POST["dni"])) echo $_POST["dni"] ?>">
            <?php
            if (isset($_POST["botonSub"]) && $error_dni) {

                if ($_POST["dni"] == "") {
                    echo "<span class='error'>Campo vacío </span>";
                } else if (!dniBienEscrito(strtoupper($_POST["dni"]))) {
                    echo "<span class='error'>* Debes rellenar el DNI con 8 dígitos seguidos de una letra *</span>";
                } else {
                    echo "<span class='error'>* DNI no valido *</span>";
                }
            }
            ?>
        </p>

        <!-- SELECT -->
        <p>Nacido en:
            <select name="nacimiento" id="nacimiento">
                <option value="Malaga" <?php if(!isset($_POST["nacimiento"]) || isset($_POST["nacimiento"]) && $_POST["nacimiento"] == "Malaga") echo"selected" ?>>Málaga</option>
                <option value="Almeria" <?php if(!isset($_POST["nacimiento"]) || isset($_POST["nacimiento"]) && $_POST["nacimiento"] == "Almeria") echo"selected" ?>>Almería</option>
                <option value="Jaen" <?php if(!isset($_POST["nacimiento"]) || isset($_POST["nacimiento"]) && $_POST["nacimiento"] == "Jaen") echo"selected" ?>>Jaén</option>
            </select></p>
            
        <!-- SEXO -->
        <p>
            Sexo
            <?php
            if (isset($_POST["botonSub"]) && $error_sexo) {
                echo "<span class='error'>Debes seleccionar un sexo </span>";
            }
            ?>
            </br>

            <input <?php if (isset($_POST["sexo"]) && $_POST["sexo"] == "hombre") echo "checked" ?> type="radio" name="sexo" id="hombre" value="hombre">
            <label for="hombre">Hombre</label>
            </br>
            <input <?php if (isset($_POST["sexo"]) && $_POST["sexo"] == "mujer") echo "checked" ?> type="radio" name="sexo" id="mujer" value="mujer">
            <label for="mujer">Mujer</label>
        </p>


        <!-- SUBIR ARCHIVOS FILTRANDO LOS ARCHIVOS QUE SE PUEDEN SUBIR-->
        <p>
            <label for="archivo">Incluir mi foto (Archivo de tipo imagen Máx 500 KB):</label>
            <input accept="image/*" type="file" name="archivo" id="foto">
            <?php
            if (isset($_POST["botonSub"]) && $error_archivo) {

                if ($_FILES["archivo"]["name"] != "") {

                    if ($_FILES["archivo"]["error"]) {
                        echo "<span class='error'>No se ha podido subir el archivo</span>";
                    } elseif (!getimagesize($_FILES["archivo"]["tmp_name"])) {
                        echo "<span class='error'>No has seleccionado una imagen</span>";
                    } else {
                        echo "<span class='error'>El archivo supera los 500 KB</span>";
                    }
                }
            }
            ?>
        </p>


        <!-- BOTONES -->
        <button type="submit" name="botonSub">Guardar cambios</button>
        <button type="submit" name="botonBor">Borrar los datos introducidos</button>
</body>

</html>