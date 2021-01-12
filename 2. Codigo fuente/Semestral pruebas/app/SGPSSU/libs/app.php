<!-- La clase App es el cuerpo principal de la aplicacion, se encarga de controlar todo el flujo de los controles -->


<?php
require_once __DIR__.'/../controllers/CTErrores.php';
class App{

    function __construct(){
        // Adjuntar el control dependiendo del url
        $url = isset($_GET['url'])? $_GET['url']:null;
        $url = rtrim($url,'/');
        $url = explode('/',$url);

        //Si no hay algun controller
        if(empty($url[0])){
            $archiveController = __DIR__.'/../controllers/CTPrincipal.php';
            require_once $archiveController;
            $controller = new CTPrincipal;
            $controller->loadModel('PTPrincipal');
            $controller->render();
            return false;
        } 
        $archiveController = __DIR__.'/../controllers/'.$url[0].'.php';
        // Si existe, asigna un model dependiendo del conrol
        if(file_exists($archiveController)){
            require_once $archiveController;
            //Inicializa el controller
            
            $controller = new $url[0];
            if( $url[0]=='CTFormularioDePropuesta' ){
                $model = 'FormularioDePropuesta';
            }else if($url[0]=='CTAdministrarPropuestas' || $url[0]=='CTProyectosDisponibles' || $url[0]=='CTInformacionDeProyecto'){
                $model = 'PropuestaDeProyecto';
            } else if($url[0]=='CTFormularioDePropuestaAprobacion'){
                $model = 'FormularioDePropuestaAprobacion';
            }   else if($url[0]=='CTPrincipal'){
                $model = 'Principal';
            } else if($url[0]=='CTErrores'){
                $model = 'Errores';
            } 

            $controller->loadModel($model);
            // Si hay un metdo que cargar
            if(isset($url[1])){
                $controller->{$url[1]}();
            } else {
                $controller->render();
            }

        } else {
            $controller = new CTErrores();
            $controller->render();
        }

    
    }

}
?>