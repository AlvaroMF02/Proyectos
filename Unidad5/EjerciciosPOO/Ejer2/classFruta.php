<?php
// creacion de una clase

class Fruta{
    // propiedades
    private $color, $tamanyo;

    // Constructor
    public function __construct($colorNuevo,$tamanyoNuevo){
        $this->color = $colorNuevo;
        $this->tamanyo = $tamanyoNuevo;
        // llama al metodo
        $this->imprimir();
    }

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

    // metodo para imprimir
    private function imprimir(){
        echo "<p><strong>Color: </strong>".$this->color."<br><strong>Tamaño: </strong>".$this->tamanyo."</p>";
    }


}


?>