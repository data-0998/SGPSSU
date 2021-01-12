<!-- La clase CTProyectosDisponibles se encarga de manejar la comunicación
entre la base de datos permitiendo desplegar los proyectos disponibles  para inscripcion -->

<?php

class CTProyectosDisponibles extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->proyectos = [];
        $this->view->titulo = 'Proyectos Disponibles';
        $this->view->error="";
    }

    function render(){
        $buscar = isset($_GET['buscar'])? $_GET['buscar']:null;
        $proyectos = $this->model->obtenerProyectos($buscar);
        $this->view->proyectos = $proyectos;
        $this->setError($proyectos,$buscar);
        $this->view->render('PTProyectosDisponibles');
    }

    // Asigna el mensaje de error
    private function setError($proyectos,$filtro){
        if(empty($proyectos) && isset($filtro) ){
            $this->view->error="No se hallaron coincidencias";
        }
        return ;
    }

}

?>

