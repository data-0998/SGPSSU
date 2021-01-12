<!-- La clase FormularioDePropuestaModel se encarga de realizar consultas a la base de datos correspondiente a
a creación de una nueva propuesta de proyecto -->

<?php 
require_once(__DIR__ . '/../libs/model.php');

class FormularioDePropuestaModel extends Model {

    public function __construct () {
        parent::__construct();

    }

    public function insertarResponsableDeProyecto ($arreglo) {
        try{
            $query2 = $this->db->Select("SELECT * FROM responsabledeproyecto WHERE CedulaResponsable = :Cedula", ["Cedula"=>$arreglo["columna5"]]);
            if (!empty($query2)){
                $query = $query2[0]["CodResponsable"];
            } else {
                $query = $this->db->Insert("INSERT INTO responsabledeproyecto (`TelMovilResponsable`, 
                                            `TelOficinaResponsable`, `NombreResponsable`, 
                                            `ApellidoResponsable`, `CedulaResponsable`, `CorreoResponsable`) 
                                            values (:columna1, :columna2, :columna3, :columna4, 
                                            :columna5, :columna6)", $arreglo);
            }
            return $query;
        } catch (PDOException $e) {
            return "";
        }
    }

    public function insertarSupervisorDeProyecto ($arreglo) {
        try{
            $query2 = $this->db->Select("SELECT * FROM supervisordeproyecto WHERE CedulaSupervisor = :Cedula", ["Cedula"=>$arreglo["columna5"]]);
            if (!empty($query2)){
                $query = $query2[0]["CodSupervisor"];
            } else {
                $query = $this->db->Insert("INSERT INTO supervisordeproyecto (`TelMovilSupervisor`, 
                `TelOficinaSupervisor`, `NombreSupervisor`, `ApellidoSupervisor`, `CedulaSupervisor`, 
                `CorreoSupervisor`) values (:columna1, :columna2, :columna3, :columna4, 
                :columna5, :columna6)", $arreglo);
            }
            return $query;
        } catch (PDOException $e) {
            return "";
        }
    }

    public function insertarParticipanteDePropuesta ($arreglo) {
        try{
            $query = $this->db->Insert("INSERT INTO participantepropuesta (`CodProyecto`, `CodParticipante`) 
                                        values (:columna6, :columna7)", $arreglo);        

            return $query;
        } catch (PDOException $e) {

            return "";
        }
    }

    public function insertarParticipanteDeProyecto ($arreglo) {
        try{
            $query2 = $this->db->Select("SELECT * FROM participanteproyecto WHERE Cedula = :Cedula", ["Cedula"=>$arreglo["columna3"]]);
            if (!empty($query2)){
                $query = $query2[0]["CodParticipante"];
            } else {
                $query = $this->db->Insert("INSERT INTO participanteproyecto (`NombreParticipante`, `ApellidoParticipante`, `Cedula`, 
                `TelMovilParticipante`, `TelResidencialParticipante`) values (:columna1, :columna2, :columna3, :columna4, 
                :columna5)", $arreglo);
            }
            return $query;
        } catch (PDOException $e) {
            return "";
        }
    }

    public function insertarPropuestaFacultad ($arreglo) {
        try{
            $query = $this->db->Insert("INSERT INTO propuestafacultad (`CodProyecto`, `CodFacultad`) values (:columna1, :columna2)", 
            $arreglo);
 
            return $query;
        } catch (PDOException $e) {
            return "";
        }
    }
    
    public function insertarProducto ($arreglo) {
        try{
            $query = $this->db->Insert("INSERT INTO producto (`CodProyecto`, `DocenteAsesor`, `TiempoElaboracionProducto`, 
            `Materiales`, `Facilidades`, `DescripcionProducto`) values (:columna1, :columna2, :columna3, :columna4, 
            :columna5, :columna6)", $arreglo);        
            return $query;
            
        } catch (PDOException $e) {
            return "";
        }
    }

    public function insertarActividad ($arreglo) {
        try{
            $query = $this->db->Insert("INSERT INTO actividad (`CodProyecto`, `DescripcionLugar`, `Lugar`) 
            values (:columna1, :columna2, :columna3)", $arreglo);      
            return $query;
            
        } catch (PDOException $e) {
            return "";
        }
    }

    public function insertarDescripcionActividad ($arreglo) {
        try{
            $query = $this->db->Insert("INSERT INTO descripcionactividad (`CodActividad`, `DescripcionActividad`, `Tiempo`) 
            values (:columna1, :columna2, :columna3)", $arreglo);      
            return $query;

        } catch (PDOException $e) {
            return "";
        }
    }

    public function insertarPropuestaDeProyecto ($arreglo) {
        try{
            $query = $this->db->Insert("INSERT INTO propuestadeproyecto (`CodSupervisor`, `CodResponsable`,
            `Proponente`, `CodTipoDeProyecto`, `TituloProyecto`, `Objetivo`, `Descripcion`, `CodNivelDeProyecto`, 
            `CodModalidad`, `CantidadEstudiantesMax`, `CantidadEstudiantesActual`, `PerfilEstudiantes`, 
            `CodEstado`) values (:columna1, :columna2, :columna4, :columna5, :columna6, :columna7, :columna8, 
            :columna9, :columna10, :columna11, :columna12, :columna13, :columna14)", $arreglo);    
            return $query;
            
        } catch (PDOException $e) {
            return "";
        }
    }
}

?>