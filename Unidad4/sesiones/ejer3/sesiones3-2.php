<?php
session_name("ejer_3_23_24");
session_start();

if (isset($_POST["boton"])) {

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
