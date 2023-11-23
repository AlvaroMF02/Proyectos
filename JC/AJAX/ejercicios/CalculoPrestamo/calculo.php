<?php
$capital = $_REQUEST["capital"];
$interes = $_REQUEST["interes"];
$plazo = $_REQUEST["plazo"];

// echo $capital, $interes,$plazo;

// sumar el capital y los intereses y dividirlo entre el plazo
$cuota = ($capital + $interes)/$plazo;
echo round($cuota,2);

?>