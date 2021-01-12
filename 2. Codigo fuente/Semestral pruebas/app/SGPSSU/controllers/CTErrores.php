<!-- La clase CTPrincipal permite desplegar la pantalla de error en caso de que ocurra uno -->

<?php

class CTErrores extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->mensaje = "Opps ha ocurrido un error";
        $this->view->titulo = "Error";
    }

    function render(){
        $this->view->render('PTErrores');
    }

}
?>