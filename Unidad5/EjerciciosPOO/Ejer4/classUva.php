<?php
// creacion de una clase que hereda
require "classFruta.php";

class Uva extends Fruta{

    private $tieneSemilla;

    public function __construct($colorNuevo,$tamanyoNuevo,$tiene){
        $this->tieneSemilla = $tiene;
        // atributos para el constructor del padre
        parent::__construct($colorNuevo,$tamanyoNuevo);
    }

    // devuelve si tiene semilla
    public function tieneSemilla(){
        return $this->tieneSemilla;
    }
}

?>