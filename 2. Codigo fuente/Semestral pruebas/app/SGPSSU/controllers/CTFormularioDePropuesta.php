<!-- La clase CTFormularioDePropuesta se encarga de recibir la información de la vista PTFormulario de propuesta,
realizar sus respectivas validaciones y en función de ello, mostrar mensajes de error en la vista o comunicarse 
con el modelo FormularioDePropuestaModel -->

<?php

class CTFormularioDePropuesta extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->mensajeProponente = "" ;
        $this->view->mensajeNombreProyecto = "" ;
        $this->view->mensajeObjetivo = "" ;
        $this->view->mensajeDescripcion = "" ;
        
        $this->view->mensajeLugar = "" ;
        $this->view->mensajeDescripcionLugar = "" ;
        $this->view->mensajeDatosActividades = array();
        $this->view->s = 1;
        
        $this->view->mensajeTiempoElaboracion = "" ;
        $this->view->mensajeDescripcionProducto = "" ;
        $this->view->mensajeMaterialesRequeridos = "" ;
        $this->view->mensajeFacilidades = "" ;
    
        $this->view->mensajecantidadDeEstudiantes = "";
        $this->view->mensajeFacultadesInvolucradas = "";
        $this->view->mensajeDatosParticipantes = array();
        $this->view->n = 1;
        $this->view->mensajeNombreResponsable = "";
        $this->view->mensajeApellidoResponsable = "";
        $this->view->mensajeCedulaResponsable = "";
        $this->view->mensajeCorreoResponsable = "" ;
        $this->view->mensajeTelefonoOficinaResponsable = "" ;
        $this->view->mensajeTelefonoMovilResponsable = "" ;

        $this->view->mensajeNombreSupervisor = "";
        $this->view->mensajeApellidoSupervisor = "";
        $this->view->mensajeCedulaSupervisor = "";
        $this->view->mensajeCorreoSupervisor = "" ;
        $this->view->mensajeTelefonoOficinaSupervisor = "" ;
        $this->view->mensajeTelefonoMovilSupervisor = "" ;
        $this->view->mensajeGlobal = "";
    }

    function render(){
        $this->view->render('PTFormularioDePropuesta');
    }

    function Agregar(){
        $mensajeProponente                  = $this->validarNombres($_POST["proponente"]);
    
        //Datos generales del proyecto
        $mensajeNombreProyecto              = $this->validarDescripciones ($_POST["nombreProyecto"], 5, 50);
        $mensajeObjetivo                    = $this->validarDescripciones ($_POST["objetivo"], 5, 200);
        $mensajeDescripcion                 = $this->validarDescripciones ($_POST["descripcion"], 5, 200);

        //Datos de actividades
        $mensajeLugar                       = $this->validarDescripciones ($_POST["lugar"], 2, 50);
        $mensajeDescripcionLugar            = $this->validarDescripciones ($_POST["descripcionLugar"], 5, 200);
        $mensajeDatosActividades            = $this->validarActividades ($_POST["tipoProyecto"], $_POST["actividades"], $_POST["horas"]);
        
        //Datos de productos
        $mensajeTiempoElaboracion           = $this->validarTiempo($_POST["tiempoElaboracion"]);
        $mensajeDescripcionProducto         = $this->validarDescripciones ($_POST["descripcionProducto"], 5, 200);
        $mensajeMaterialesRequeridos        = $this->validarDescripciones ($_POST["materialesRequeridos"], 5, 200);
        $mensajeFacilidades                 = $this->validarDescripciones ($_POST["facilidades"], 5, 200);

        //Datos de participantes 
        $mensajecantidadDeEstudiantes       = $this->validarCantidad($_POST["cantidadDeEstudiantes"], $_POST["modalidad"]);
        $perfilEstudiantes                  = $_POST["perfilEstudiantes"];
        $mensajeDatosParticipantes          = $this->validarDatosParticipantes ($_POST["nombreParticipante"], 
                                                                        $_POST["apellidoParticipante"], 
                                                                        $_POST["cedulaParticipante"], 
                                                                        $_POST["telefonoMovilParticipante"], 
                                                                        $_POST["telefonoResidencialParticipante"]);
        //Datos del responsable
        $mensajeNombreResponsable           = $this->validarNombres($_POST["nombreResponsable"]);
        $mensajeApellidoResponsable         = $this->validarNombres($_POST["apellidoResponsable"]);
        $mensajeCedulaResponsable           = $this->validarCedula ($_POST["cedulaResponsable"]);
        $mensajeCorreoResponsable           = $this->validarCorreos($_POST["correoResponsable"]);
        $mensajeTelefonoOficinaResponsable  = $this->validarTelefonos ($_POST["telefonoOficinaResponsable"], 7);
        $mensajeTelefonoMovilResponsable    = $this->validarTelefonos ($_POST["telefonoMovilResponsable"], 8);

        //Datos del supervisor
        $mensajeNombreSupervisor            = $this->validarNombres($_POST["nombreSupervisor"]);
        $mensajeApellidoSupervisor          = $this->validarNombres($_POST["apellidoSupervisor"]);
        $mensajeCedulaSupervisor            = $this->validarCedula ($_POST["cedulaSupervisor"]);
        $mensajeCorreoSupervisor            = $this->validarCorreos($_POST["correoSupervisor"]);
        $mensajeTelefonoOficinaSupervisor   = $this->validarTelefonos ($_POST["telefonoOficinaSupervisor"], 7);
        $mensajeTelefonoMovilSupervisor     = $this->validarTelefonos ($_POST["telefonoMovilSupervisor"], 8);
        
        $n = count($_POST["nombreParticipante"]);
        $s = count($_POST["actividades"]);

        //Verificar facultades
        $mensajeFacultadesInvolucradas = "";
        if (empty($_POST["facultadesInvolucradas"])){
            $mensajeFacultadesInvolucradas = "Debe seleccionar al menos una casilla";
        }

        //Aplicar validaciones
        if ($_POST["tipoProyecto"] == "1"){
            if (empty($mensajeProponente) && empty($mensajeNombreProyecto) && empty($mensajeObjetivo) &&
            empty($mensajeDescripcion) && empty($mensajeTiempoElaboracion) && empty($mensajeDescripcionProducto) &&
            empty($mensajeMaterialesRequeridos) && empty($mensajeFacilidades) && empty($mensajecantidadDeEstudiantes) &&
            empty($mensajeFacultadesInvolucradas) && empty($mensajeDatosParticipantes) && empty($mensajeNombreResponsable) &&
            empty($mensajeApellidoResponsable) && empty($mensajeCedulaResponsable) && empty($mensajeCorreoResponsable) &&
            empty($mensajeTelefonoOficinaResponsable) && empty($mensajeTelefonoMovilResponsable) && empty($mensajeNombreSupervisor) &&
            empty($mensajeApellidoSupervisor) && empty($mensajeCedulaSupervisor) && empty($mensajeCorreoSupervisor) &&
            empty($mensajeTelefonoOficinaSupervisor) && empty($mensajeTelefonoMovilSupervisor)){
                $arregloResponsable = ['columna1' => $_POST["telefonoMovilResponsable"], 
                                        'columna2' => $_POST["telefonoOficinaResponsable"], 
                                        'columna3' => $_POST["nombreResponsable"], 
                                        'columna4' => $_POST["apellidoResponsable"],
                                        'columna5' => $_POST["cedulaResponsable"], 
                                        'columna6' => $_POST["correoResponsable"]];
                $CodResponsable = (int)$this->model->insertarResponsableDeProyecto($arregloResponsable);
                
                $arregloSupervisor = ['columna1' => $_POST["telefonoMovilSupervisor"], 
                                        'columna2' => $_POST["telefonoOficinaSupervisor"], 
                                        'columna3' => $_POST["nombreSupervisor"], 
                                        'columna4' => $_POST["apellidoSupervisor"],
                                        'columna5' => $_POST["cedulaSupervisor"], 
                                        'columna6' => $_POST["correoSupervisor"]];
                $CodSupervisor = (int)$this->model->insertarSupervisorDeProyecto($arregloSupervisor);

                $tipoProyecto = (int)$_POST["tipoProyecto"];
                $nivelProyecto = (int)$_POST["nivelProyecto"];
                $modalidad = (int)$_POST["modalidad"];
                $cantidadDeEstudiantes= (int)$_POST["cantidadDeEstudiantes"];
                $cantidadEstudianteActual = count($_POST ["cedulaParticipante"]);
                $estado = 3;
                $arregloPropuestaDeProyecto = ['columna1' => $CodSupervisor, 
                                                'columna2' => $CodResponsable, 
                                                'columna4' => $_POST["proponente"],
                                                'columna5' => $tipoProyecto, 
                                                'columna6' => $_POST["nombreProyecto"],
                                                'columna7' => $_POST["objetivo"],
                                                'columna8' => $_POST["descripcion"],
                                                'columna9' => $nivelProyecto,
                                                'columna10' => $modalidad,
                                                'columna11' => $cantidadDeEstudiantes,
                                                'columna12' => $cantidadEstudianteActual,
                                                'columna13' => $_POST["perfilEstudiantes"],
                                                'columna14' => $estado];
                $CodProyecto = (int)$this->model->insertarPropuestaDeProyecto($arregloPropuestaDeProyecto);

                $arregloProducto = ['columna1' => $CodProyecto, 
                                    'columna2' => $_POST["asesor"], 
                                    'columna3' => $_POST["tiempoElaboracion"], 
                                    'columna4' => $_POST["materialesRequeridos"],
                                    'columna5' => $_POST["facilidades"], 
                                    'columna6' => $_POST["descripcionProducto"]];
                $CodProducto = (int)$this->model->insertarProducto($arregloProducto);

                $this->enviarDatosFacultad ($_POST["facultadesInvolucradas"], $CodProyecto);

                $this->enviarDatosParticipantes ($_POST ["nombreParticipante"], $_POST ["apellidoParticipante"], $_POST ["cedulaParticipante"], 
                    $_POST["telefonoMovilParticipante"], $_POST["telefonoResidencialParticipante"], $CodProyecto);
                
                $this->view->mensajeGlobal = "Solicitud enviada";
                $this->render();
            } else {
                $this->view->mensajeProponente = $mensajeProponente;
                $this->view->mensajeNombreProyecto = $mensajeNombreProyecto;
                $this->view->mensajeObjetivo = $mensajeObjetivo;
                $this->view->mensajeDescripcion = $mensajeDescripcion;

                $this->view->mensajeTiempoElaboracion = $mensajeTiempoElaboracion;
                $this->view->mensajeDescripcionProducto = $mensajeDescripcionProducto;
                $this->view->mensajeMaterialesRequeridos = $mensajeMaterialesRequeridos;
                $this->view->mensajeFacilidades = $mensajeFacilidades;
                
                $this->view->mensajecantidadDeEstudiantes = $mensajecantidadDeEstudiantes;
                $this->view->mensajeFacultadesInvolucradas = $mensajeFacultadesInvolucradas;
                $this->view->mensajeDatosParticipantes = $mensajeDatosParticipantes;
                $this->view->n = $n;

                $this->view->mensajeNombreResponsable = $mensajeNombreResponsable;
                $this->view->mensajeApellidoResponsable = $mensajeApellidoResponsable;
                $this->view->mensajeCedulaResponsable = $mensajeCedulaResponsable;
                $this->view->mensajeCorreoResponsable = $mensajeCorreoResponsable;
                $this->view->mensajeTelefonoOficinaResponsable = $mensajeTelefonoOficinaResponsable;
                $this->view->mensajeTelefonoMovilResponsable = $mensajeTelefonoMovilResponsable;

                $this->view->mensajeNombreSupervisor = $mensajeNombreSupervisor;
                $this->view->mensajeApellidoSupervisor = $mensajeApellidoSupervisor;
                $this->view->mensajeCedulaSupervisor = $mensajeCedulaSupervisor;
                $this->view->mensajeCorreoSupervisor = $mensajeCorreoSupervisor;
                $this->view->mensajeTelefonoOficinaSupervisor = $mensajeTelefonoOficinaSupervisor;
                $this->view->mensajeTelefonoMovilSupervisor = $mensajeTelefonoMovilSupervisor;

                $this->view->mensajeGlobal = "Revise los campos marcados";
                $this->render();
            }
        } else if ($_POST["tipoProyecto"] == "2") {
            if (empty($mensajeProponente) && empty($mensajeNombreProyecto) && empty($mensajeObjetivo) && empty($mensajeFacultadesInvolucradas) &&
            empty($mensajeDescripcion) && empty($mensajeLugar) && empty($mensajeDescripcionLugar) && empty($mensajeDatosParticipantes) &&
            empty($mensajeDatosActividades) && empty($mensajecantidadDeEstudiantes) && empty($mensajeDatosActividades) &&
            empty($mensajeNombreResponsable) && empty($mensajeApellidoResponsable) && empty($mensajeCedulaResponsable) &&
            empty($mensajeCorreoResponsable) && empty($mensajeTelefonoOficinaResponsable) && empty($mensajeTelefonoMovilResponsable) && 
            empty($mensajeNombreSupervisor) && empty ($mensajeApellidoSupervisor) && empty($mensajeCedulaSupervisor) && 
            empty ($mensajeCorreoSupervisor) && empty($mensajeTelefonoOficinaSupervisor) && empty($mensajeTelefonoMovilSupervisor)) 
            {
                $arregloResponsable = ['columna1' => $_POST["telefonoMovilResponsable"], 
                                        'columna2' => $_POST["telefonoOficinaResponsable"], 
                                        'columna3' => $_POST["nombreResponsable"], 
                                        'columna4' => $_POST["apellidoResponsable"],
                                        'columna5' => $_POST["cedulaResponsable"], 
                                        'columna6' => $_POST["correoResponsable"]];
                $CodResponsable = (int)$this->model->insertarResponsableDeProyecto($arregloResponsable);

                $arregloSupervisor = ['columna1' => $_POST["telefonoMovilSupervisor"], 
                                        'columna2' => $_POST["telefonoOficinaSupervisor"], 
                                        'columna3' => $_POST["nombreSupervisor"], 
                                        'columna4' => $_POST["apellidoSupervisor"],
                                        'columna5' => $_POST["cedulaSupervisor"], 
                                        'columna6' => $_POST["correoSupervisor"]];
                $CodSupervisor = (int)$this->model->insertarSupervisorDeProyecto($arregloSupervisor);

                $tipoProyecto = (int)$_POST["tipoProyecto"];
                $nivelProyecto = (int)$_POST["nivelProyecto"];
                $modalidad = (int)$_POST["modalidad"];
                $cantidadDeEstudiantes= (int)$_POST["cantidadDeEstudiantes"];
                $cantidadEstudianteActual = count($_POST ["cedulaParticipante"]);
                $estado = 3;
                $arregloPropuestaDeProyecto = ['columna1' => $CodSupervisor, 
                                                'columna2' => $CodResponsable, 
                                                'columna4' => $_POST["proponente"],
                                                'columna5' => $tipoProyecto, 
                                                'columna6' => $_POST["nombreProyecto"],
                                                'columna7' => $_POST["objetivo"],
                                                'columna8' => $_POST["descripcion"],
                                                'columna9' => $nivelProyecto,
                                                'columna10' => $modalidad,
                                                'columna11' => $cantidadDeEstudiantes,
                                                'columna12' => $cantidadEstudianteActual,
                                                'columna13' => $_POST["perfilEstudiantes"],
                                                'columna14' => $estado];
                $CodProyecto = (int)$this->model->insertarPropuestaDeProyecto($arregloPropuestaDeProyecto);

                $arregloActividad = ['columna1' => $CodProyecto, 
                                    'columna2' => $_POST["descripcionLugar"], 
                                    'columna3' => $_POST["lugar"]];
                $CodActividad= (int)$this->model->insertarActividad($arregloActividad);

                $this->enviarDatosDescripcionActividades ($CodActividad, $_POST["actividades"], $_POST["horas"]);

                $this->enviarDatosFacultad ($_POST["facultadesInvolucradas"], $CodProyecto);

                $this->enviarDatosParticipantes ($_POST ["nombreParticipante"], $_POST ["apellidoParticipante"], $_POST ["cedulaParticipante"], 
                    $_POST["telefonoMovilParticipante"], $_POST["telefonoResidencialParticipante"], $CodProyecto);

                    $this->view->mensajeGlobal = "Solicitud enviada";
                    $this->render();
            } else {
                $this->view->mensajeProponente = $mensajeProponente;
                $this->view->mensajeNombreProyecto = $mensajeNombreProyecto;
                $this->view->mensajeObjetivo = $mensajeObjetivo;
                $this->view->mensajeDescripcion = $mensajeDescripcion;

                $this->view->mensajeLugar = $mensajeLugar;
                $this->view->mensajeDescripcionLugar = $mensajeDescripcionLugar;
                $this->view->mensajeDatosActividades = $mensajeDatosActividades;
                $this->view->s = $s;

                $this->view->mensajecantidadDeEstudiantes = $mensajecantidadDeEstudiantes;
                $this->view->mensajeFacultadesInvolucradas = $mensajeFacultadesInvolucradas;
                $this->view->mensajeDatosParticipantes = $mensajeDatosParticipantes;
                $this->view->n = $n;
                
                $this->view->mensajeNombreResponsable = $mensajeNombreResponsable;
                $this->view->mensajeApellidoResponsable = $mensajeApellidoResponsable;
                $this->view->mensajeCedulaResponsable = $mensajeCedulaResponsable;
                $this->view->mensajeCorreoResponsable = $mensajeCorreoResponsable;
                $this->view->mensajeTelefonoOficinaResponsable = $mensajeTelefonoOficinaResponsable;
                $this->view->mensajeTelefonoMovilResponsable = $mensajeTelefonoMovilResponsable;

                $this->view->mensajeNombreSupervisor = $mensajeNombreSupervisor;
                $this->view->mensajeApellidoSupervisor = $mensajeApellidoSupervisor;
                $this->view->mensajeCedulaSupervisor = $mensajeCedulaSupervisor;
                $this->view->mensajeCorreoSupervisor = $mensajeCorreoSupervisor;
                $this->view->mensajeTelefonoOficinaSupervisor = $mensajeTelefonoOficinaSupervisor;
                $this->view->mensajeTelefonoMovilSupervisor = $mensajeTelefonoMovilSupervisor;

                $this->view->mensajeGlobal = "Revise los campos marcados";
                $this->render();
            }
        } 
    }

    //Funciones para verificar si un texto contiene algún patrón
    //Devuelve 1 si encuentra el patrón, de lo contrario devuelve 0
    function validarNumerosEnCantidades($string){
        return (preg_match( '/^\-?[0-9]*\.?[0-9]+\z/', $string));
    }

    function validarNumerosEnString($string){
        return (preg_match( '/[0-9]/', $string));
    }

    function validarEspecialesEnString($string){
        return (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $string));
    }

    function validarEspecialesEnCedula($string){
        return (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬]/', $string));
    }

    function validarPatronCorreo($string){
        return (preg_match('/[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,20}/', $string));
    }

    function mensajeCadenaVacia() {
        return "No puede dejar este campo vacío";
    }
    
    function mensajeCadenaAlfabetico() {
        return "La cadena contiene caracteres alfabéticos";
    }

    function mensajeCadenaEspeciales() {
        return "La cadena contiene caracteres especiales";
    }
    
    function mensajeCadenaNumerica() {
        return "La cadena contiene caracteres numéricos";
    }

    function mensajeCadenaNoNumerica() {
        return "La cadena tiene caracteres no numéricos";
    }

    function mensajeCadenaNoEntera() {
        return "La cadena no es un número entero";
    }

    function mensajeCadenaNumericaNegativa() {
        return "La cadena contiene valores negativos";
    }

    function mensajeCadenaIgualCero() {
        return "La cadena debe ser mayor a 0";
    }

    function mensajeCadenaMinima() {
        return "La longitud de la cadena es menor al límite mínimo válido";
    }
    
    function mensajeCadenaMaxima() {
        return "La longitud de la cadena sobrepasa el límite máximo válido";
    }

    //Proponente, Nombres y Apellidos
    function validarNombres ($dato){
        $mensaje = "";

        if (empty($dato)){
            $mensaje = $this->mensajeCadenaVacia ();
        } else if ($this->validarNumerosEnString($dato) == 1){
            $mensaje = $this->mensajeCadenaNumerica ();
        } else if ($this->validarEspecialesEnString($dato) == 1){
            $mensaje = $this->mensajeCadenaEspeciales();
        } else if (strlen($dato) < 2){
            $mensaje = $this->mensajeCadenaMinima();
        } else if (strlen($dato) > 25){ 
            $mensaje = $this->mensajeCadenaMaxima();
        } 
        
        return $mensaje;
    }

    //Objetivo, descripcion, descripcion lugar, descripcion del producto,
    //Materiales requeridos, facilidades que ofrece, titulo de proyecto, lugar
    function validarDescripciones ($descripcion, $longitudMin, $longitudMax){
        $mensaje = "";

        if (empty($descripcion)){
            $mensaje = $this->mensajeCadenaVacia();
        } else if (strlen($descripcion) < $longitudMin){ //5, 2(lugar)
            $mensaje = $this->mensajeCadenaMinima();
        } else if (strlen($descripcion) > $longitudMax){ //200, 50 (titulo de proyecto, lugar)
            $mensaje = $this->mensajeCadenaMaxima();
        }

        return $mensaje;
    }

    //Cedula de estudiantes,etc
    function validarCedula ($cedula) {
        $mensaje = "";

        if (empty($cedula)) {
            $mensaje = $this->mensajeCadenaVacia ();
        } else if (strlen($cedula) < 8) {
            $mensaje = $this->mensajeCadenaMinima();
        } else if (strlen($cedula) > 20) {
            $mensaje = $this->mensajeCadenaMaxima();
        } else if ($this->validarEspecialesEnCedula($cedula) == 1){
            $mensaje = "La cadena contiene otros caracteres especiales no permitidos";
        } 
        return $mensaje;
    }

    //Telefonos de oficina, movil
    function validarTelefonos ($telefono, $longitud ) {
        $mensaje = "";
        if (empty($telefono)) {
            $mensaje = $this->mensajeCadenaVacia();
        } else if ($this->validarEspecialesEnString($telefono) == 1 ){
            $mensaje = $this->mensajeCadenaEspeciales();
        } else if ($this->validarNumerosEnCantidades($telefono) == 0){
            $mensaje = $this->mensajeCadenaAlfabetico();
        } else if (strlen($telefono) < $longitud) {
            $mensaje = $this->mensajeCadenaMinima();
        } else if (strlen($telefono) > $longitud) {
            $mensaje = $this->mensajeCadenaMaxima();
        } 
        
        return $mensaje;
    }

    //Telefono residencial
    function validarTelefonoOpcional ($telefono, $longitud ) {
        $mensaje = "";
        if (!empty($telefono)) {
            if ($this->validarEspecialesEnString($telefono) == 1 ){
                $mensaje = $this->mensajeCadenaEspeciales();
            } else if ($this->validarNumerosEnCantidades($telefono) == 0){
                $mensaje = $this->mensajeCadenaAlfabetico();
            } else if (strlen($telefono) < $longitud) {
                $mensaje = $this->mensajeCadenaMinima();
            } else if (strlen($telefono) > $longitud) {
                $mensaje = $this->mensajeCadenaMaxima();
            } 
        }

        return $mensaje;
    }

    function validarDatosParticipantes ($nombre, $apellido, $cedula, $telefonoMovil, $telefonoResidencial) {
        $mensajeCedula = array();
        $mensajeNombre = array();
        $mensajeApellido = array();
        $mensajeTelefonoMovil = array();
        $mensajeTelefonoResidencial = array();

        $mensajeFinal = array();

        if (!empty($nombre) && !empty($apellido) && !empty($cedula) && !empty($telefonoMovil)) {
            $N = count($nombre);
            
            if (($N == count($apellido)) && ($N == count($cedula)) && ($N == count($telefonoMovil))) {
                for ($i=0; $i < $N; $i++) {
                    $mensajeCedula [$i] = $this->validarCedula ($cedula[$i]);
                    $mensajeNombre [$i]= $this->validarNombres($nombre[$i]);
                    $mensajeApellido [$i]= $this->validarNombres ($apellido[$i]);
                    $mensajeTelefonoMovil [$i]= $this->validarTelefonos ($telefonoMovil[$i], 8);
                    $mensajeTelefonoResidencial [$i]= $this->validarTelefonoOpcional ($telefonoResidencial[$i], 7);       
                }
                
                for ($j=0; $j<$N; $j++) {
                    if (!empty($mensajeCedula[$j]) || !empty($mensajeNombre[$j]) || !empty($mensajeApellido[$j]) || !empty($mensajeTelefonoMovil[$j]) || !empty($mensajeTelefonoResidencial[$j])) {
                        array_push ($mensajeFinal, $mensajeCedula, $mensajeNombre, $mensajeApellido, $mensajeTelefonoResidencial, $mensajeTelefonoMovil); 
                    }
                }
            } else {
                array_push ($mensajeFinal, "No llenaste todos los campos de la fila");
            }
            return $mensajeFinal;
        } else {
            array_push ($mensajeFinal, "No llenaste todos los campos de la fila");
            return $mensajeFinal;
        }
    }

    function validarActividades ($tipoProyecto, $actividad, $tiempo){
        $mensajeActividad = array();
        $mensajeHoras = array();

        $mensajeFinalActividad = array();
        if (!empty($actividad) && !empty($tiempo)){
            $N = count($actividad);
            if ($N == count($tiempo)){
                for ($i=0; $i < $N; $i++) {
                    $mensajeActividad[$i] = $this->validarDescripciones ($actividad[$i], 5, 200);
                    $mensajeHoras[$i] = $this->validarTiempo ($tiempo[$i]);       
                }
                
                for ($j=0; $j<$N; $j++){
                    if(!empty($mensajeActividad[$j]) || !empty($mensajeHoras[$j])) {
                        array_push($mensajeFinalActividad, $mensajeActividad, $mensajeHoras);
                    }
                } 
            } else {
                array_push ($mensajeFinalActividad, "No llenaste todos los campos de la fila");
            }
                return $mensajeFinalActividad;
        } else {
            array_push ($mensajeFinalActividad, "No llenaste todos los campos de la fila");
            return $mensajeFinalActividad;
        }
    }

    function validarTiempo ($tiempo){
        $mensaje = "";

        if ($tiempo == null) {
            $mensaje = $this->mensajeCadenaVacia();
        } else if ($this->validarNumerosEnCantidades($tiempo) == 0){
            $mensaje = $this->mensajeCadenaNoNumerica();
        } else {
            $intVal = intval($tiempo);
            if ($intVal != floatval($tiempo)){
                $mensaje = $this->mensajeCadenaNoEntera();
            } else if ($intVal === 0) {
                $mensaje = $this->mensajeCadenaIgualCero();
            } else if ($intVal < 0){
                $mensaje = $this->mensajeCadenaNumericaNegativa();
            }
        }

        return $mensaje;
    }

    function validarCantidad ($CantidadEstudiantes, $modalidad) {
        $mensaje = ""; 
        
        if($CantidadEstudiantes == null){
            $mensaje= $this->mensajeCadenaVacia();
        } else if($this->validarNumerosEnCantidades($CantidadEstudiantes) == 0){
            $mensaje= $this->mensajeCadenaNoNumerica();
        } else {
            $floatVal = floatVal($CantidadEstudiantes);
            if(intval($floatVal) != $floatVal){
                $mensaje= $this->mensajeCadenaNoEntera();
            } else {
                $numCantidadEstudiantes = (int)$CantidadEstudiantes;
                if ($numCantidadEstudiantes < 0){
                    $mensaje = $this->mensajeCadenaNumericaNegativa();
                } else if ($numCantidadEstudiantes === 0) {
                    $mensaje = $this->mensajeCadenaIgualCero();
                } else if ($numCantidadEstudiantes != 1 && $modalidad == "1"){
                    $mensaje = "Ya que seleccionó la opción “Individual” en el campo “Modalidad”, la cadena debe ser “1” por obligación";
                } else if ($numCantidadEstudiantes == 1 && $modalidad == "2"){
                    $mensaje = "Ya que seleccionó la opción “Grupal” en el campo “Modalidad”, la cadena debe ser mayor al valor numérico 1";
                }       
            }
        }
        return $mensaje;
    }

    //Correos
    function validarCorreos($correo){
        $mensaje = "";

        if (empty($correo)){
            $mensaje = $this->mensajeCadenaVacia();
        } else if ($this->validarPatronCorreo($correo) == 0){
            $mensaje = "Correo inválido";
        }

        return $mensaje;
    }
    

    //Funciones para enviar datos al modelo
    function enviarDatosParticipantes ($nombre, $apellido, $cedula, $telefonoMovil, $telefonoResidencial, $CodProyecto) {
        $arregloParticipanteProyecto = array();
        $arregloParticipantePropuesta = array();
        $N = count($cedula);    

        for ($i=0; $i < $N; $i++) {
            $arregloParticipanteProyecto = [
            'columna1' => $nombre[$i], 
            'columna2' => $apellido[$i], 
            'columna3' => $cedula[$i], 
            'columna4' => $telefonoMovil[$i],
            'columna5' => $telefonoResidencial[$i]
            ];

            $CodParticipante = (int)$this->model->insertarParticipanteDeProyecto ($arregloParticipanteProyecto); 
            
            $arregloParticipantePropuesta = [
                'columna6' => $CodProyecto, 
                'columna7' => $CodParticipante
            ];

            $mensaje = $this->model->insertarParticipanteDePropuesta ($arregloParticipantePropuesta); 
        }
    }

    function enviarDatosFacultad ($facultades, $CodProyecto) {
        $arregloPropuestaFacultad = array();
        $N = count($facultades);    

        for ($i=0; $i < $N; $i++) {
            $arregloPropuestaFacultad = [
                'columna1' => $CodProyecto, 
                'columna2' => (int)$facultades[$i], 
            ];
            $mensaje = $this->model->insertarPropuestaFacultad($arregloPropuestaFacultad); 
        }
    }

    function enviarDatosDescripcionActividades ($codActividad, $descripcionActividad, $tiempo) {
        $arregloDescripcionActividad = array();
        $N = count($descripcionActividad);    

        for ($i=0; $i < $N; $i++) {
            $arregloDescripcionActividad = [
            'columna1' => $codActividad, 
            'columna2' => $descripcionActividad[$i], 
            'columna3' => $tiempo[$i]
            ];

            $CodDescripcionAcividad = (int)$this->model->insertarDescripcionActividad ($arregloDescripcionActividad);
        }
    }

}

?>