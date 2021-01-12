<!-- La clase CTPrincipal permite desplegar la pantalla principal de la pagina web -->


<?php

class CTPrincipal extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->titulo="SGPSSU";
    }

    function render(){
        $this->view->render('PTPrincipal');
    }

}

?>