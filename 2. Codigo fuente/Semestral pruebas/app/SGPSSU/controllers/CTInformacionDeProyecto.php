<!-- La clase CTInformacionDeProyecto se encarga de manejar la comunicación
entre la base de datos permitiendo desplegar la informacion general de un proyecto mediante un id -->

<?php

class CTInformacionDeProyecto extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->titulo = 'Información de proyecto';
        $this->view->proyecto=[];
    }

    function render(){
        $id = $_GET['id'];
        $proyecto = $this->model->obtenerProyecto($id);
        $this->view->proyecto = $proyecto;
        $this->view->render('PTInformacionDeProyecto');
    }
}

?>

