<?php

class Menu{
    // un array que guarda otro array
    private $menu = array();


    // mete un array en el array principal del menu
    public function cargar($nombre,$url){
        $this->menu[$nombre] = $url;
    }

    // mostrar de forma vertical
    public function vertical(){
        echo "<p>";
        foreach($this->menu as $nombre=>$url){
            echo "<a href='".$url."'>".$nombre."</a><br>";
        }
        echo "</p>";
    }

    // mostrar de forma horizontal
    public function horizontal(){
        $resultado = "";
        foreach($this->menu as $nombre=>$url){
            $resultado .= "<a href='".$url."'>".$nombre."</a> - ";
        }
        // quitar la ultima ralla
        echo "<p>".substr($resultado, 0, -2)."</p>";
    }

}

?>