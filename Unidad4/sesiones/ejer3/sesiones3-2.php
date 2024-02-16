<?php
session_name("ejer_3_23_24");
session_start();

// cuando le des a cualquier boton
if (isset($_POST["boton"])) {

    // dependiendo del valor hace una cosa diferente a la sesion
    if ($_POST["boton"] == "mas") {
        $_SESSION["numero"]++;
    } elseif ($_POST["boton"] == "menos") {
        $_SESSION["numero"]--;
    } elseif ($_POST["boton"] == "aCero") {
        $_SESSION["numero"] = 0;
    }
} else {
    header("Location:sesiones3-1.php");
    exit;
}
header("Location:sesiones3-1.php");
exit;
