<?php
// Estas seguro de que quieres borrar a x?
echo "<p>Se dispone usted a borrar al usuario <strong>" . $_POST["btnBorrar"] . "</strong></p>";
// Form para continuar o cancelar
echo "<form action='index.php' method='post'>";
// Continuar coge el valor del boton para conseguir el id
echo "<p><button type='submit' name='btnContBorrar' value='" . $_POST["btnBorrar"] . "'>Continuar</button>";
echo "<button type='submit'>Atrás</button></p>";
echo "</form>";
?>