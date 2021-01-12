<!-- La clase Controller sirve de plantilla para extender 
a todos lso controlers y puedan acceder a una vista y a un modelo de datos -->


<?php

class Controller{

    function __construct(){
        $this->view = new View();
        
    }

    function loadModel($model){
        $url = __DIR__.'/../models/'.$model.'Model.php';
        if(file_exists($url)){
            require $url;           
            $modelName = $model.'Model';
            $this->model = new $modelName();
        }
        
    }

}

?>