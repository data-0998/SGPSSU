<!-- La clase FormularioDePropuestaAprobacionModel se encarga de extraer la información de una propuesta de proyecto según su 
código y de realizar la actualizacion de los estados de la misma -->

<?php 
require_once(__DIR__ . '/../libs/model.php');

class FormularioDePropuestaAprobacionModel extends Model {
    public function __construct () {
        parent::__construct();
    }

    public function obtenerPropuestaDeProyecto ($arreglo) {
        try{
        $query = $this->db->Select("SELECT * FROM propuestadeproyecto WHERE CodProyecto = :columna1", $arreglo);

        return $query;
    } catch (PDOException $e) {
            return ""; 
        } 
    }

    public function obtenerResponsableDeProyecto ($codResponsable) {
        try{
        $query = $this->db->Select("SELECT * FROM responsabledeproyecto WHERE CodResponsable = :codResponsable", ["codResponsable" => $codResponsable]);
        return $query;

        } catch (PDOException $e) {
            return ""; 
        } 
    }

    public function obtenerSupervisorDeProyecto ($codSupervisor) {
        try{
        $query = $this->db->Select("SELECT * FROM supervisordeproyecto WHERE CodSupervisor = :codSupervisor", ["codSupervisor" => $codSupervisor]);
        return $query;
        } catch (PDOException $e) {
            return ""; 
        } 
    }

    public function obtenerProducto ($arreglo) {
        try{
        $query = $this->db->Select("SELECT * FROM producto WHERE CodProyecto = :columna1", $arreglo);
        return $query;
        } catch (PDOException $e) {
            return ""; 
        } 
    }

    public function obtenerPropuestaFacultad ($arreglo) {
        try{
            $query = $this->db->Select("SELECT * FROM propuestafacultad WHERE CodProyecto = :columna1", $arreglo);
    
            return $query;
        } catch (PDOException $e) {
                return ""; 
            } 
        }

    public function obtenerActividad ($arreglo) {
        try{
        $query = $this->db->Select("SELECT * FROM actividad WHERE CodProyecto = :columna1", $arreglo);
        return $query;
        } catch (PDOException $e) {
            return ""; 
        } 
    }

    public function obtenerDescripcionActividad ($codActividad) {
        try{
            $query = $this->db->Select("SELECT * FROM descripcionactividad WHERE CodActividad = :codActividad", 
                                        ["codActividad" => $codActividad]);
            return $query;
        } catch (PDOException $e) {
            return ""; 
        } 
    }

    public function obtenerParticipanteDeProyecto ($arreglo) {
        try{
        $arregloEstudiantes = array();
        $query = $this->db->Select("SELECT * FROM participantepropuesta WHERE CodProyecto = :columna1", $arreglo);

        for ($i = 0; $i < count($query); $i++) {
            $query2 = $this->db->Select("SELECT * FROM participanteproyecto WHERE CodParticipante = :codParticipante", 
                                        ["codParticipante" => (int)$query[$i]["CodParticipante"]]);
            array_push($arregloEstudiantes, $query2);
        }
        return $arregloEstudiantes;
        } catch (PDOException $e) {
            return ""; 
        } 
    }

    public function actualizarEstado ($arreglo) {
        try {
            $this->db->Update("UPDATE propuestadeproyecto SET `CodEstado` = :estadoNuevoPropuesta 
                                WHERE CodProyecto = :codProyecto", $arreglo);
        } catch (PDOException $e) {
            return ""; 
        }
    }

    public function actualizarMotivo ($arreglo) {
        try {
            $this->db->Update("UPDATE propuestadeproyecto SET `Motivo` = :observaciones 
                                WHERE CodProyecto = :codProyecto", $arreglo);
        } catch (PDOException $e) {
            return ""; 
        }
    }

    public function CambiarEstado ($accion, $aprobacion, $codProyecto, $observaciones) {
        try {
            $query = $this->db->Select("SELECT * FROM propuestadeproyecto WHERE CodProyecto = :codProyecto", 
                                        ["codProyecto" => $codProyecto]);

            $estadoActualPropuesta = (int)$query[0]["CodEstado"];
            $estadoNuevoPropuesta = 0;

            //Si el estado actual es "pendiente de aprobacion" y la accion es "imprimir", cambia a "enviado a comision"
            if ($estadoActualPropuesta == 3 && $accion == 1) {
                $estadoNuevoPropuesta  = 4;
                $this->actualizarEstado (["codProyecto" => $codProyecto, "estadoNuevoPropuesta" => $estadoNuevoPropuesta]);

                return "";

            } else if ($estadoActualPropuesta == 4 && $aprobacion == 1 && $accion == 2) {
                //Si el estado actual es "enviado a comision" con opcion aprobado y la accion es "guardar", cambia a "aprobado"
                $estadoNuevoPropuesta  = 1;
                $this->actualizarEstado (["codProyecto" => $codProyecto, "estadoNuevoPropuesta" => $estadoNuevoPropuesta]);
            
                return "La propuesta de proyecto ha sido aprobada";

            } else if ($estadoActualPropuesta == 4 && $aprobacion == 2 && $accion == 2) {
                //Si el estado actual es "enviado a comision" con opcion rechazado y la accion es "guardar", cambia a "rechazado"
                $estadoNuevoPropuesta  = 2;
                $this->actualizarEstado (["codProyecto" => $codProyecto, "estadoNuevoPropuesta" => $estadoNuevoPropuesta]);
                $this->actualizarMotivo (["codProyecto" => $codProyecto, "observaciones" => $observaciones]);
                return "La propuesta de proyecto ha sido rechazada";
            } else {
                return "";
            }

            return "";
        } catch (PDOException $e) {
            return ""; 
        }
    }
}

?>