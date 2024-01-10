<?php
// creacion de una clase

class Fruta{
    // propiedades
    private $color, $tamanyo;

    // setters
    public function setColor($colorNuevo){
        $this->color = $colorNuevo;
    }

    public function setTamanyo($tamanyoNuevo){
        $this->tamanyo = $tamanyoNuevo;
    }

    // getters
    public function getColor(){
        return $this->color;
    }
    public function getTamanyo(){
        return $this->tamanyo;
    }

}


?>