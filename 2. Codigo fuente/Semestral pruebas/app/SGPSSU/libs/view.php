<!-- La clase View sirve de coneccion con los controles para poder 
mostrar las vistas asignadas -->

<?php

class View{

    function __construct(){
        //No contiene nada ya que solo se encarga de renderizar
        //y no necesita valores
    }
    
    function render($nombre){
        require __DIR__.'/../views/'.$nombre.'.php';
    }

}

?>