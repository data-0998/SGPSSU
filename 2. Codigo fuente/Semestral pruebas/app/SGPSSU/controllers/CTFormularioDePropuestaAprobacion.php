<!-- La clase CTFormularioDePropuestaAprobación recibe el codigo de la propuesta de proyecto para desplegar la informacion
del mismo en la vista PTFormularioDePropuestaAprobacion e igualmente se comunica con el modelo FormularioDePropuestaAprobacionModel
para realizar el cambio de estado de la propuesta -->

<?php

class CTFormularioDePropuestaAprobacion extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->datoCodProyecto = "";
        //Propuesta
        $this->view->datoFecha = "";
        $this->view->datoProponente = "";
        $this->view->datoTipoProyecto = "";
        $this->view->datoTituloProyecto = "";
        $this->view->datoObjetivo = "";
        $this->view->datoDescripcion = "";
        $this->view->datoNivelProyecto= "";
        $this->view->datoModalidad = "";
        $this->view->datoCantidadEstudiantesMax = "";
        $this->view->PerfilEstudiantes= "";
        $this->view->datoEstadoProyecto = "";
        $this->view->datoMotivo = "";

        //Responsable
        $this->view->datoNombreResponsable = "";
        $this->view->datoApellidoResponsable = "";
        $this->view->datoCedulaResponsable = "";
        $this->view->datoCorreoResponsable = "" ;
        $this->view->datoTelefonoOficinaResponsable = "" ;
        $this->view->datoTelefonoMovilResponsable = "" ;

        //Supervisor
        $this->view->datoNombreSupervisor = "";
        $this->view->datoApellidoSupervisor = "";
        $this->view->datoCedulaSupervisor = "";
        $this->view->datoCorreoSupervisor = "" ;
        $this->view->datoTelefonoOficinaSupervisor = "" ;
        $this->view->datoTelefonoMovilSupervisor = "" ;

        //Facultades
        $this->view->datoFacultadesInvolucradas = array();

        //DatosParticipante
        $this->view->datosParticipantes = array();
        //Producto
        $this->view->datoTiempoElaboracion = "" ;
        $this->view->datoDescripcionProducto = "" ;
        $this->view->datoMaterialesRequeridos = "" ;
        $this->view->datoFacilidades = "" ;
        $this->view->datoAsesor = "" ;
        
        //Actividad
        $this->view->datoLugar = "" ;
        $this->view->datoDescripcionLugar = "" ;
        $this->view->datosDescripcionActividades=array();

        //DescripcionActividad
        $this->view->datoDescripcionActividad = "";
        $this->view->datoTiempo = "";

        //Validacion del campo observaciones
        $this->view->mensajeObservaciones = "" ;

        //Mensaje de retroalimentacion
        $this->view->mensaje = "" ;
    }

    function render(){
        $this->view->render('PTFormularioDePropuestaAprobacion');
    }

    function obtenerCodProyecto(){
        if (isset($_POST["verDetalles"])) {
            $this->view->datoCodProyecto = (int)$_POST["verDetalles"];
            $CodProyecto = ['columna1' => (int)$_POST["verDetalles"]];
            $this->mostrarPantalla ($CodProyecto);

        } else if (isset($_POST["codProyecto"])) {
            $this->view->datoCodProyecto = (int)$_POST["codProyecto"]; 
            $codigo = (int)$_POST["codProyecto"];
            $CodProyecto = ['columna1' => (int)$_POST["codProyecto"]];

            $this->SolicitarCambioEstado($codigo);
            $this->mostrarPantalla ($CodProyecto);

        } else {
            echo "";
        }
    }

    function mostrarPantalla ($CodProyecto) {
        $propuestaProyecto = $this->model->obtenerPropuestaDeProyecto($CodProyecto);
        $this->view->datoEstadoProyecto = (int)$propuestaProyecto[0]["CodEstado"];
        $this->view->datoFecha = $propuestaProyecto[0]["Fecha"];
        $this->view->datoProponente = $propuestaProyecto[0]["Proponente"];
        $this->view->datoTituloProyecto = $propuestaProyecto[0]["TituloProyecto"];
        $this->view->datoObjetivo = $propuestaProyecto[0]["Objetivo"];
        $this->view->datoDescripcion = $propuestaProyecto[0]["Descripcion"];
        $this->view->datoCantidadEstudiantesMax = $propuestaProyecto[0]["CantidadEstudiantesMax"];
        $this->view->PerfilEstudiantes= $propuestaProyecto[0]["PerfilEstudiantes"];
        $this->view->datoTipoProyecto = (int)$propuestaProyecto[0]["CodTipoDeProyecto"];
        $this->view->datoNivelProyecto = (int)$propuestaProyecto[0]["CodNivelDeProyecto"];
        $this->view->datoModalidad = (int)$propuestaProyecto[0]["CodModalidad"];

        //Se asigna el campo Motivo si el estado es 2
        if ($this->view->datoEstadoProyecto == 2) {
            $this->view->datoMotivo = $propuestaProyecto[0]["Motivo"];
        }

        //Se asignan los datos de responsable
        $responsableDeProyecto = $this->model->obtenerResponsableDeProyecto((int)$propuestaProyecto[0]["CodResponsable"]);
            $this->view->datoNombreResponsable = $responsableDeProyecto[0]["NombreResponsable"];
            $this->view->datoApellidoResponsable = $responsableDeProyecto[0]["ApellidoResponsable"];
            $this->view->datoCedulaResponsable = $responsableDeProyecto[0]["CedulaResponsable"];
            $this->view->datoCorreoResponsable = $responsableDeProyecto[0]["CorreoResponsable"];
            $this->view->datoTelefonoOficinaResponsable = $responsableDeProyecto[0]["TelOficinaResponsable"];
            $this->view->datoTelefonoMovilResponsable = $responsableDeProyecto[0]["TelMovilResponsable"];

        //Se asignan los datos de supervisor
        $supervisorDeProyecto = $this->model->obtenerSupervisorDeProyecto((int)$propuestaProyecto[0]["CodSupervisor"]);
            $this->view->datoNombreSupervisor =  $supervisorDeProyecto[0]["NombreSupervisor"];
            $this->view->datoApellidoSupervisor = $supervisorDeProyecto[0]["ApellidoSupervisor"];
            $this->view->datoCedulaSupervisor = $supervisorDeProyecto[0]["CedulaSupervisor"];
            $this->view->datoCorreoSupervisor = $supervisorDeProyecto[0]["CorreoSupervisor"];
            $this->view->datoTelefonoOficinaSupervisor = $supervisorDeProyecto[0]["TelOficinaSupervisor"];
            $this->view->datoTelefonoMovilSupervisor = $supervisorDeProyecto[0]["TelMovilSupervisor"];
        
        //Se asignan los datos de facultades
        $this->view->datoFacultadesInvolucradas = $this->model->obtenerPropuestaFacultad($CodProyecto);

        //Se asignan los datos de participantes
        $this->view->datosParticipantes = $this->model->obtenerParticipanteDeProyecto($CodProyecto);

        if ($this->view->datoTipoProyecto == 1) {
            //Se asignan los datos de productos
            $propuestaProducto = $this->model->obtenerProducto($CodProyecto);
            $this->view->datoTiempoElaboracion = $propuestaProducto[0]["TiempoElaboracionProducto"];
            $this->view->datoDescripcionProducto = $propuestaProducto[0]["Materiales"];
            $this->view->datoMaterialesRequeridos = $propuestaProducto[0]["Facilidades"];
            $this->view->datoFacilidades = $propuestaProducto[0]["DescripcionProducto"];
            $this->view->datoAsesor = $propuestaProducto[0]["DocenteAsesor"];
        } else if ($this->view->datoTipoProyecto == 2) {
            //Se asignan los datos de actividad
            $actividad = $this->model->obtenerActividad ($CodProyecto);
                $this->view->datoLugar = $actividad[0]["Lugar"];
                $this->view->datoDescripcionLugar = $actividad[0]["DescripcionLugar"];
            
            $this->view->datosDescripcionActividades = $this->model->obtenerDescripcionActividad ((int)$actividad[0]["CodActividad"]);
        }

        $this->render();
    }

    function SolicitarCambioEstado ($codProyecto) {
            if (isset($_POST["aprobacion"]) ) {
                $aprobacion = (int)$_POST["aprobacion"];
            } else {
                $aprobacion =0;
            }

            if (isset($_POST["observaciones"])) {
                $observaciones = $_POST["observaciones"];
            } else {
                $observaciones = "";
            }

            //$accion = 0 (ninguna accion); $accion = 1 (imprimir); $accion = 2 (guardar)
            $accion = (int)$_POST["accion"]; 

            if ($accion == 1 ) {
                $this->view->mensaje = $this->model->CambiarEstado ($accion, $aprobacion, $codProyecto,  $observaciones);

            } else if (($accion == 2 && $aprobacion == 2 && strlen($observaciones) > 0)  || 
                        ($accion == 2 && $aprobacion == 1)) {
                $this->view->mensaje = $this->model->CambiarEstado ($accion, $aprobacion, $codProyecto, $observaciones);

            } else if ($accion == 2 && $aprobacion == 2 && strlen($observaciones) < 1) {
                $this->view->mensajeObservaciones = "No puede dejar este campo vacío";

            } 
    }
}

?>