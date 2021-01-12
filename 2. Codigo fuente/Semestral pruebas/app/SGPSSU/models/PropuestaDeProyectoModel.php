<!-- La clase PropuestaDeProyectoModel realiza las solicitudes a la base de datos 
dependiendo de las necesidades. Ademas de servir como plantilla para organizar los datos.
Es utilizado por el control de Propuestas, Proyectos, y Proyecto -->


<?php
require_once 'Responsable.php';
require_once 'Actividad.php';
require_once(__DIR__ . '/../libs/model.php');

class PropuestaDeProyectoModel extends Model{

    public $codProyecto;
    public $tituloProyecto;
    public $responsable;
    public $estado;
    public $actividad;
    public $descripcion;

    public function __construct(){
        parent::__construct();
        $this->responsable = new Responsable();
        $this->actividad = new Actividad();
    }
    // Obtiene las propeustas dependiendo de si el filtro es un estado, 
    // es un nombre o titulo de proyecto, o una solicitud general
    public function obtenerPropuestas($filtro){
        $items = [];
        $estados = array('Aprobado','Rechazado','Pendiente de Aprobación','Envíado a la Comisión');
        try{
            if(isset($filtro)){
                if(in_array($filtro,$estados)){                    
                    $query = "SELECT A.CodProyecto as ID, A.TituloProyecto, B.NombreResponsable, C.Descripcion as Estado FROM propuestadeproyecto AS A JOIN responsabledeproyecto AS B ON A.CodResponsable = B.CodResponsable JOIN estado AS C ON A.CodEstado = C.CodEstado WHERE C.Descripcion = '".$filtro."';";
                } else if($filtro == 'Todos'){
                    $query = "SELECT A.CodProyecto as ID, A.TituloProyecto, B.NombreResponsable, C.Descripcion as Estado FROM propuestadeproyecto AS A JOIN responsabledeproyecto AS B ON A.CodResponsable = B.CodResponsable JOIN estado AS C ON A.CodEstado = C.CodEstado;";
                } else {
                    $query = "SELECT A.CodProyecto as ID, A.TituloProyecto, B.NombreResponsable, C.Descripcion as Estado FROM propuestadeproyecto AS A JOIN responsabledeproyecto AS B ON A.CodResponsable = B.CodResponsable JOIN estado AS C ON A.CodEstado = C.CodEstado WHERE B.NombreResponsable = '". $filtro."'OR A.TituloProyecto = '".$filtro."';";
                }
            } else {
                $query = "SELECT A.CodProyecto as ID, A.TituloProyecto, B.NombreResponsable, C.Descripcion as Estado FROM propuestadeproyecto AS A JOIN responsabledeproyecto AS B ON A.CodResponsable = B.CodResponsable JOIN estado AS C ON A.CodEstado = C.CodEstado;";
            }
            $values = $this->db->Select($query);

            for ($i=0; $i <sizeof($values) ; $i++) {
                $item = new PropuestaDeProyectoModel(); 
                $item->tituloProyecto           = $values[$i]['TituloProyecto'];
                $item->responsable->nombre      = $values[$i]['NombreResponsable'];
                $item->codProyecto              = $values[$i]['ID'];
                $item->estado                   = $values[$i]['Estado'];
                
                array_push($items,$item);
            }
            
            return $items;
        } catch(PDOException $e){
            return [];
        }
    }
    // Obtiene los proyectos dependiendo de si existe un filtro por nombre o titulo
    public function obtenerProyectos($filtro){
        $items = [];
        try{
            if(isset($filtro)){
                $query = "SELECT A.CodProyecto as ID, A.TituloProyecto, B.NombreResponsable, C.Descripcion as Estado FROM propuestadeproyecto AS A JOIN responsabledeproyecto AS B ON A.CodResponsable = B.CodResponsable JOIN estado AS C ON A.CodEstado = C.CodEstado WHERE C.Descripcion = 'Aprobado' AND A.CantidadEstudiantesMax > A.CantidadEstudiantesActual AND B.NombreResponsable = '". $filtro."'OR A.TituloProyecto = '".$filtro."';";
            } else {
                $query = "SELECT A.CodProyecto as ID, A.TituloProyecto, B.NombreResponsable, C.Descripcion as Estado FROM propuestadeproyecto AS A JOIN responsabledeproyecto AS B ON A.CodResponsable = B.CodResponsable JOIN estado AS C ON A.CodEstado = C.CodEstado WHERE C.Descripcion = 'Aprobado' AND A.CantidadEstudiantesMax > A.CantidadEstudiantesActual;";
            }
            $values = $this->db->Select($query);

            for ($i=0; $i <sizeof($values) ; $i++) {
                $item = new PropuestaDeProyectoModel(); 
                $item->tituloProyecto           = $values[$i]['TituloProyecto'];
                $item->responsable->nombre      = $values[$i]['NombreResponsable'];
                $item->codProyecto              = $values[$i]['ID'];
                $item->estado                   = $values[$i]['Estado'];
                
                array_push($items,$item);
            }
            
            return $items;
        } catch(PDOException $e){
            return [];
        }
    }

    // Obtiene la informacion de un proyecto mediante su id
    public function obtenerProyecto($id){
        $items = [];
        try{
            $query = "SELECT A.CodProyecto as ID , A.TituloProyecto as Titulo, B.NombreResponsable as Responsable, B.CorreoResponsable as Correo, B.TelMovilResponsable as Movil, B.TelOficinaResponsable as Oficina , A.Descripcion FROM propuestadeproyecto AS A JOIN responsabledeproyecto AS B ON A.CodResponsable = B.CodResponsable WHERE A.codProyecto = ".$id." LIMIT 1;";
            $value = $this->db->Select($query);
            $item = new PropuestaDeProyectoModel(); 
            $item->tituloProyecto               = $value[0]['Titulo'];
            $item->estado                       = $value[0]['Responsable'];
            $item->descripcion                  = $value[0]['Descripcion'];
            $item->responsable->nombre          = $value[0]['Responsable'];
            $item->responsable->correo          = $value[0]['Correo'];
            $item->responsable->telefonoMovil   = $value[0]['Movil'];
            $item->responsable->telefonoOficina = $value[0]['Oficina'];

            $id = $value[0]['ID'];
            $lugar = $this->getLugar($id);
            $item->actividad->lugar             = $lugar;
            array_push($items,$item);
            return $item;

        } catch(PDOException $e){
            return [];
        }
    }
    // Obtiene el lugar del proyecto, si es un producto no lo asigna
    private function getLugar($id){
        $query = "SELECT lugar FROM actividad WHERE CodProyecto = ".$id." LIMIT 1;";
        $value = $this->db->Select($query);
        $lugar = isset($value[0]['lugar'])?$value[0]['lugar']:'No hay un lugar especificado';

        return $lugar;
        
    }

}

?>