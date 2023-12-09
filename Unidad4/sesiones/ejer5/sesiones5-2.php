<?php

// de 20 en 20
if (isset($_POST["boton"])) {

    if ($_POST["boton"] == "izq") {
        $_SESSION["bola"] -= 20;
    } elseif ($_POST["boton"] == "der") {
        $_SESSION["bola"] += 20;
    } elseif ($_POST["boton"] == "volver") {
        $_SESSION["bola"] = 0;
    }
} else {
    header("Location:sesiones5-1.php");
    exit;
}
