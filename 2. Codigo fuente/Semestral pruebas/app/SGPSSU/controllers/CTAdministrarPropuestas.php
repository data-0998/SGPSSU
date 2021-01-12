<!-- La clase CTAdministrarPropuestas se encarga de manejar la comunicación
entre la base de datos permitiendo desplegar las propuestas que han sido ingresadas -->

<?php

class CTAdministrarPropuestas extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->proyectos = [];
        $this->view->error="";
        $this->view->titulo = 'Administrar Propuestas';
    }

    function render(){
        $buscar = isset($_GET['buscar'])? $_GET['buscar']:null;
        $estado = isset($_GET['estado'])? $_GET['estado']:null;
        $filtro = $this->setFilter($buscar,$estado);
        $proyectos = $this->model->obtenerPropuestas($filtro);
        $this->view->proyectos = $proyectos;
        $this->setError($proyectos,$filtro);
        $this->view->render('PTAdministrarPropuestas');
    }
    // Asigna el mensaje de error
    private function setError($proyectos,$filtro){
        if(empty($proyectos) && isset($filtro) ){
            $this->view->error="No se hallaron coincidencias";
        }
        return ;
    }
    // Asigna un filtro dependiendo de si es por estado o por titulo/nombre
    // Estados = 'Aprobado','Rechazado','Pendiente de Aprobación','Envíado a la Comisión'
    private function setFilter($buscar,$estado){
        if(isset($buscar)){
            $filtro = $_GET['buscar'];

        } else if(isset($estado)){
            $filtro = $_GET['estado'];
        } else {
            $filtro = null;
        }
        return $filtro;
    }
}

?>

