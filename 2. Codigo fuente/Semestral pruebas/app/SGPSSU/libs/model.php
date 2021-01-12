<!-- La Model sirve como plantilla a los diferentes modelos 
para permitirles acceso a la base de datos -->

<?php
require_once(__DIR__ . '/../libs/database.php');
class Model{

    function __construct(){
        $this->db = new Database();
    }

}

?>