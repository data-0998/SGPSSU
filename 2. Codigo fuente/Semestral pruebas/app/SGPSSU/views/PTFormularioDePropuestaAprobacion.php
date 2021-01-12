<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/formulario.css">
    
    <title>Aprobación de propuestas de proyecto</title>
</head>

<body>
    <?php require __DIR__.'/../views/includes/header.php'; ?>

    <div>
        <ul class="breadcrumb">
            <li><a href="<?php echo constant('URI');?>CTPrincipal">Página Principal</a></li>
            <li>Adminsitrar Proyectos</li>
            <li><a href="<?php echo constant('URI');?>CTAdministrarPropuestas">Propuestas de Proyecto</a></li>
            <li><a href="<?php echo constant('URI');?>CTFormularioDePropuestaAprobacion">Aprobación de Propuesta</a></li>
        </ul>
    </div>

    <div class="ContenedorTitulos">
        <h1 class= "tituloinicial">Propuesta de Proyecto</h1>
    </div>
    <div class="mensajePrincipal"><?php echo $this->mensaje;?></div>
    
    <div class = "contenedorForm">   
        <div class="encabezadoForm">    
            <label for="date" class="formGroupLabel">Fecha</label>
            <input type="text" name="date" required value="<?php echo $this->datoFecha?>" disabled>
        </div>

        <div class="encabezadoForm">
            <label for="proponente" class="formGroupLabel">Proponente</label>
            <input type="text" name="proponente" class="formGroupInput" value="<?php echo $this->datoProponente?>" disabled>
        </div>

        <h2 class="subtitulos">Información del Proyecto</h2><hr class = "hrClass">
        
        <div class="formGroup">
            <div class="descripcionesContenedores">
                <label for="nombreProyecto" class="formGroupLabel">Nombre del Proyecto</label>
                <div class="formGroupInput">
                    <input type="text" name="nombreProyecto" value="<?php echo $this->datoTituloProyecto?>" disabled>
                </div>
            </div>
        </div>

        <div class="formGroup">
            <div class="descripcionesContenedores">
            <label for="objetivo" class="formGroupLabel">Objetivo</label>
                <div class="formGroupInput">
                    <textarea class="textClass" name="objetivo" class="textClass" rows="4" disabled><?php echo $this->datoObjetivo?></textarea>
                </div>
            </div>
        </div>

        <div class="formGroup">
            <div class="descripcionesContenedores">
            <label for="descripcion" class="formGroupLabel">Descripción</label>
                <div class="formGroupInput">
                    <textarea style="resize:none;" name="descripcion" class="textClass" rows="5" disabled><?php echo $this->datoDescripcion?></textarea>
                </div>
            </div>
        </div>
        
        <label class="formP" for="">Nivel del Proyecto</label>
        <div class="contenedorRadioCheck">
            <input type="radio" name="nivelProyecto" id="voluntariado" value="1" disabled <?php $var = $this->datoNivelProyecto == 1; echo $var ? 'checked' : ''?>>
            <label for="voluntariado" class="radioCheck">Voluntariado</label>
            <input type="radio" name="nivelProyecto" id="servicioSocial" value="2" disabled <?php $var = $this->datoNivelProyecto == 2; echo $var ? 'checked' : ''?>>
            <label for="servicioSocial">Servicio Social</label>
        </div>

    
        <label class="formP" for="">Modalidad</label>
        <div class="contenedorRadioCheck">
            <input type="radio" name="modalidad" id="individual" value="1" disabled <?php $var = $this->datoModalidad == 1; echo $var ? 'checked' : ''?>>
            <label for="individual" class="radioCheck">Individual</label>
            <input type="radio" name="modalidad" id="grupal" value="2" disabled <?php $var = $this->datoModalidad == 2; echo $var ? 'checked' : ''?>>
            <label for="grupal">Grupal</label>
        </div>

        <h2 class="subtitulos">Tipo de Proyecto</h2><hr class = "hrClass">
        <div class="contenedorTipoProyecto">
            <div class="TipoProyecto">
                <input type="radio" name="tipoProyecto" id="producto" value="1" disabled <?php $var = $this->datoTipoProyecto == 1; echo $var ? 'checked' : ''?>>
                <label for="producto" >Producto</label>
            </div>
            <div class="TipoProyecto">             
                <input type="radio" name="tipoProyecto" id="actividad" value="2" disabled <?php $var = $this->datoTipoProyecto == 2; echo $var ? 'checked' : ''?>>
                <label for="actividad">Actividad</label>
            </div>
        </div>

        <?php if ($this->datoTipoProyecto  == 2) {?>

        <h2 class="subtitulos">Actividad</h2><hr class = "hrClass">
        <div class="formGroup">
            <div class="descripcionesContenedores">
                <label for="lugar" class="formGroupLabel">Lugar</label>
                <div class="formGroupInput">
                    <input type="text" name="lugar" class="textClass" value="<?php echo $this->datoLugar?>" disabled>
                </div>
            </div>
        </div>
        
        <div class="formGroup">
            <div class="descripcionesContenedores">
                <label for="descripcionLugar" class="formGroupLabel">Descripción del Lugar</label>
                <div class="formGroupInput">
                    <textarea name="descripcionLugar" id="" class="textClass" rows="5" disabled><?php echo $this->datoDescripcionLugar?></textarea>
                </div>
            </div>
        </div>
        
        <label for="programaActividades" class="formGroupLabel">Programa de Actividades</label>

    <div class="tabla-actividades" >
        <table class="table table-hover small-text" id="actividades">
            <thead>
                <tr class="tr-header">
                    <th scope="col">Actividad</th>
                    <th scope="col">Tiempo (Horas)</th>
                </tr>
            </thead>

            <tbody id="actividadesBody">
                <?php 
                $resultado = array();
                for ($j = 0; $j < count($this->datosDescripcionActividades); $j++) {
                    array_push($resultado, $this->datosDescripcionActividades[$j]["Tiempo"]);?>
                <tr>
                    <td>
                        <textarea style = "resize: none;" name="actividades[]" rows="5" class="form-control" disabled><?php echo $this->datosDescripcionActividades[$j]["DescripcionActividad"]?></textarea>
                    </td>
                    <td>
                        <input type="text"  name="horas[]" id="horas" class="form-control" disabled value="<?php echo $this->datosDescripcionActividades[$j]["Tiempo"]?>">
                    </td>
                </tr>
                <?php }?> 
            </tbody>
            <tfoot>
                <tr class="tr-footer"> 
                    <td class="totalClass">Total</td>
                    <td><input type="text" name="total" id="total" class="form-control" value="<?php echo array_sum($resultado)?>" disabled></td>
                </tr>
            </tfoot>
        </table>
    </div>
        <?php }?>
        
        <?php if ($this->datoTipoProyecto  == 1) {?>
        <div class = "ProductoClass">
            <h2 class="subtitulos">Producto</h2><hr class = "hrClass">

            <div class="formGroup">
                <div class="descripcionesContenedores">
                <label for="tiempoElaboracion" class="formGroupLabel">Tiempo de Elaboración</label>
                    <div class="formGroupInput">
                        <input type="text" name="tiempoElaboracion" value="<?php echo $this->datoTiempoElaboracion?>" disabled>
                    </div>               
                </div>
            </div>
    
            <div class="formGroup">
                <div class="descripcionesContenedores">
                    <label for="descripcionProducto" class="formGroupLabel">Descripción del Producto</label>
                    <div class="formGroupInput">
                        <textarea name="descripcionProducto"class="textClass" rows="5" disabled><?php echo $this->datoDescripcionProducto?></textarea>
                    </div>               
                </div>
            </div>
        
            <div class="formGroup">
                <div class="descripcionesContenedores">
                <label for="materialesRequeridos" class="formGroupLabel">Materiales Requeridos</label>
                    <div class="formGroupInput">
                        <textarea name="materialesRequeridos" class="textClass" rows="5" disabled><?php echo $this->datoMaterialesRequeridos?></textarea>
                    </div>               
                </div>
            </div>

            <div class="formGroup">
                <div class="descripcionesContenedores">
                    <label for="facilidades" class="formGroupLabel">Facilidades Otorgadas</label>
                    <div class="formGroupInput">
                        <textarea name="facilidades" class="textClass" rows="5" disabled><?php echo $this->datoFacilidades?></textarea>
                    </div>               
                </div>
            </div>
            
            <label class="formP" for="">¿Requiere docente asesor?</label>
            <div class="contenedorRadioCheck">
                <input type="radio" name="asesor" id="si" value="Si" disabled <?php $var = $this->datoAsesor == "Si"; echo $var ? 'checked' : ''?>>
                <label for="si" class="radioCheck">Si</label>
                <input type="radio" name="asesor" id="no" value="No" disabled <?php $var = $this->datoAsesor == "No"; echo $var ? 'checked' : ''?>>
                <label for="no">No</label>
            </div>
        </div>
    <?php }?>

    <h2 class="subtitulos">Participante</h2><hr class = "hrClass">
    <div class="formGroup">
        <div class="descripcionesContenedores">
            <label for="cantidadDeEstudiantes" class="formGroupLabel">Cantidad de Estudiantes</label>
            <div class="formGroupInput">
                <input type="text" name="cantidadDeEstudiantes" value="<?php echo $this->datoCantidadEstudiantesMax?>" disabled>
            </div>               
        </div>
    </div>
        <label class="formP">Facultades Involucradas</label>
        <?php 
        $FCyT = false;
        $FIC = false;
        $FIE = false;
        $FII = false;
        $FIM = false;
        $FISC = false;
        for ($i=0; $i<count($this->datoFacultadesInvolucradas); $i++){
            if ((int)$this->datoFacultadesInvolucradas[$i]["CodFacultad"] == 1) {
                $FCyT = true;
            }
            if ((int)$this->datoFacultadesInvolucradas[$i]["CodFacultad"] == 2) {
                $FIC = true;
            }
            if ((int)$this->datoFacultadesInvolucradas[$i]["CodFacultad"] == 3) {
                $FIE = true;
            }
            if ((int)$this->datoFacultadesInvolucradas[$i]["CodFacultad"] == 4) {
                $FII = true;
            }
            if ((int)$this->datoFacultadesInvolucradas[$i]["CodFacultad"] == 5) {
                $FIM = true;
            }
            if ((int)$this->datoFacultadesInvolucradas[$i]["CodFacultad"] == 6) {
                $FISC = true;
            }
        }?>

    <div class="contenedorRadioCheck">
        <input type="checkbox" name="facultadesInvolucradas[]" value = "1" disabled <?php echo $FCyT ? 'checked' : ''?>>
        <label for="FCyT" class="radioCheck">FCyT</label>
        <input type="checkbox" name="facultadesInvolucradas[]" value = "2" disabled <?php echo $FIC ? 'checked' : ''?>>
        <label for="FIC" class="radioCheck">FIC</label>
        <input type="checkbox" name="facultadesInvolucradas[]" value = "3" disabled <?php echo $FIE ? 'checked' : ''?>>
        <label for="FIE" class="radioCheck">FIE</label>
        <input type="checkbox" name="facultadesInvolucradas[]" value = "4" disabled <?php echo $FII ? 'checked' : ''?>>
        <label for="FII" class="radioCheck">FII</label>
        <input type="checkbox" name="facultadesInvolucradas[]" value = "5" disabled <?php echo $FIM ? 'checked' : ''?>>
        <label for="FIM" class="radioCheck">FIM</label>
        <input type="checkbox" name="facultadesInvolucradas[]" value = "6" disabled <?php echo $FISC ? 'checked' : ''?>>
        <label for="FISC">FISC</label><br> 
    </div>

        <div class="formGroup">
            <div class="descripcionesContenedores">
                <label for="perfilEstudiantes" class="formGroupLabel">Perfil de Estudiantes Solicitados</label>
                <div class="formGroupInput">
                    <textarea class="textClass" name="perfilEstudiantes" rows="5" disabled><?php echo $this->PerfilEstudiantes?></textarea>
                </div>
            </div>
        </div>

        <label for="">Datos de Participantes</label><br>
        <table class="table table-hover small-text" id="tb">
            <tr class="tr-header">
                <th scope="col">Cedula</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Teléfono Residencial</th>
                <th scope="col">Teléfono Móvil</th>
            
            <?php 
                for ($i = 0; $i < count($this->datosParticipantes); $i++) {?>
            <tr>
                <td>
                    <input type="text" name="cedulaParticipante[]" class="form-control" disabled value="<?php echo $this->datosParticipantes[$i][0]["Cedula"]?>">
                </td> 
                <td>
                    <input type="text" name="nombreParticipante[]" class="form-control" disabled value="<?php echo $this->datosParticipantes[$i][0]["NombreParticipante"]?>">
                </td>
                <td>
                    <input type="text" name="apellidoParticipante[]" class="form-control" disabled value="<?php echo $this->datosParticipantes[$i][0]["ApellidoParticipante"]?>">
                </td>
                <td>
                    <input type="text" name="telefonoResidencialParticipante[]" class="form-control" disabled value="<?php echo $this->datosParticipantes[$i][0]["TelResidencialParticipante"]?>">
                </td>
                <td>
                    <input type="text" name="telefonoMovilParticipante[]" class="form-control" disabled value="<?php echo $this->datosParticipantes[$i][0]["TelMovilParticipante"]?>">
                </td>
            </tr>
            <?php }?> 
        </table>

        <h2 class="subtitulos">Información de Encargados</h2><hr class = "hrClass">
        <h3 class="tabla-actividades">Responsable</h3>
    
        <div class="formGroup">
            <div class="descripcionesContenedores">
                <label for="nombreResponsable" class="formGroupLabel">Nombre</label>
                <div class="formGroupInput">
                    <input type="text" name="nombreResponsable" disabled value="<?php echo $this->datoNombreResponsable?>">
                </div>
            </div>
        </div>

        <div class="formGroup">
            <div class="descripcionesContenedores">
                <label for="apellidoResponsable" class="formGroupLabel">Apellido</label>
                <div class="formGroupInput">
                    <input type="text" name="apellidoResponsable" disabled value="<?php echo $this->datoApellidoResponsable?>">
                </div>
            </div>
        </div>

        <div class="formGroup">
            <div class="descripcionesContenedores">
                <label for="cedulaResponsable" class="formGroupLabel">Cédula</label>
                <div class="formGroupInput">
                    <input type="text" name="cedulaResponsable" disabled value="<?php echo $this->datoCedulaResponsable?>">
                </div>
            </div>
        </div>

        <div class="formGroup">
            <div class="descripcionesContenedores">
                <label for="correoResponsable" class="formGroupLabel">Correo</label>
                <div class="formGroupInput">
                    <input type="text" name="correoResponsable" disabled value="<?php echo $this->datoCorreoResponsable?>">
                </div>
            </div>
        </div>

        <div class="formGroup">
            <div class="descripcionesContenedores">
                <label for="telefonoOficinaResponsable" class="formGroupLabel">Teléfono Oficina</label>
                <div class="formGroupInput">
                    <input type="text" name="telefonoOficinaResponsable" disabled value="<?php echo $this->datoTelefonoOficinaResponsable?>">
                </div>
            </div>
        </div>
        
        <div class="formGroup">
            <div class="descripcionesContenedores">
                <label for="telefonoMovilResponsable" class="formGroupLabel">Teléfono Móvil</label>
                <div class="formGroupInput">
                    <input type="text" name="telefonoMovilResponsable" disabled value="<?php echo $this->datoTelefonoMovilResponsable?>">
                </div>
            </div>
        </div>
        
        <h3 class="tabla-actividades">Supervisor</h3>
        <div class="formGroup">
            <div class="descripcionesContenedores">
                <label for="nombreSupervisor" class="formGroupLabel">Nombre</label>
                <div class="formGroupInput">
                    <input type="text" name="nombreSupervisor" disabled value="<?php echo $this->datoNombreSupervisor?>">
                </div>
            </div>
        </div>
        
        <div class="formGroup">
            <div class="descripcionesContenedores">
                <label for="apellidoSupervisor" class="formGroupLabel">Apellido</label>
                <div class="formGroupInput">
                    <input type="text" name="apellidoSupervisor" disabled value="<?php echo $this->datoApellidoSupervisor?>">
                </div>
            </div>
        </div>
        
        <div class="formGroup">
            <div class="descripcionesContenedores">
                <label for="cedulaSupervisor" class="formGroupLabel">Cédula</label>
                <div class="formGroupInput">
                    <input type="text" name="cedulaSupervisor" disabled value="<?php echo $this->datoCedulaSupervisor?>">
                </div>
            </div>
        </div>
        
        <div class="formGroup">
            <div class="descripcionesContenedores">
                <label for="correoSupervisor" class="formGroupLabel">Correo</label>
                <div class="formGroupInput">
                    <input type="text" name="correoSupervisor" disabled value="<?php echo $this->datoCorreoSupervisor?>">
                </div>
            </div>
        </div>

        <div class="formGroup">
            <div class="descripcionesContenedores">
                <label for="telefonoOficinaSupervisor" class="formGroupLabel">Teléfono Oficina</label>
                <div class="formGroupInput">
                    <input type="text" name="telefonoOficinaSupervisor" disabled value="<?php echo $this->datoTelefonoOficinaSupervisor?>">
                </div>
            </div>
        </div>

        <div class="formGroup">
            <div class="descripcionesContenedores">
                <label for="telefonoMovilSupervisor" class="formGroupLabel">Teléfono Móvil</label>
                <div class="formGroupInput">
                    <input type="text" name="telefonoMovilSupervisor" disabled value="<?php echo $this->datoTelefonoMovilSupervisor?>">
                    </div>
            </div>
        </div>
    </div>

    <form action="<?php echo constant('URI');?>CTFormularioDePropuestaAprobacion/obtenerCodProyecto" method="POST">
            <div class="ContenedorTitulos">
                <h2 class= "tituloinicial">Aprobación</h2>
            </div>    
            <div class="retroalimentacion"><p>*Para habilitar el botón <span style="cursiva">Guardar</span> cuando el estado es <span style="cursiva">Pendiente de aprobación</span> debe imprimir el documento primero</p></div>
            <div class = "contenedorForm">   
                <?php 
                    if ($this->datoEstadoProyecto != 4){
                        $var2 = TRUE;
                    } else {
                        $var2 = FALSE;
                    }
                ?>

                <div class="contenedorTipoProyecto">
                    <div class="TipoProyecto">
                        <input type="radio" name="aprobacion" id="aprobado" value="1" <?php $var = $this->datoEstadoProyecto == 1; echo $var ? 'checked': ''?> <?php $var2 == TRUE; echo $var2 ? 'disabled': ''?>>
                        <label for="aprobado">Aprobado</label>
                    </div>
                    <div class="TipoProyecto">
                        <input type="radio" name="aprobacion" id="rechazado" value="2" <?php $var = $this->datoEstadoProyecto == 2; echo $var ? 'checked': ''?> <?php $var2 == TRUE; echo $var2 ? 'disabled': ''?>>
                        <label for="rechazado">Rechazado</label>
                    </div>
                </div>

                <div class="ObservacionesClass">
                    <div class="tabla-actividades" >
                        <div class="formGroup">
                            <div class="descripcionesContenedores">
                                <label class="formGroupLabel" for="observaciones">Observaciones</label>
                                <div class="formGroupInput">
                                    <textarea class="textClass" name="observaciones" rows="5" <?php $var2 == TRUE; echo $var2 ? 'disabled': ''?>><?php if ($this->datoEstadoProyecto == 2) {echo $this->datoMotivo; }?></textarea>
                                    <div class="mensajes"><?php echo $this->mensajeObservaciones;?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <input type = "hidden" name = "codProyecto" value="<?php echo $this->datoCodProyecto?>">
            </div>
            
            <div class="contenedorBotones">
                <input class="botonespantalla" type="button" onClick="confirmExit();" value="Salir">
                <button class="botonespantalla" type="submit" name="accion" id="imprimir" value="0" onClick="cambiarValorImprimir();">Imprimir</button>
                <button class="botonespantalla" type="submit" name="accion" id="guardar" value = "0" onClick="cambiarValorGuardar();" <?php $var = $this->datoEstadoProyecto != 4; echo $var ? 'disabled' : ''?>>Guardar</button>
            </div>
        </form>
    <?php require __DIR__.'/../views/includes/footer.php'; ?>
</body>
</html>

<script>
    /*Cambia el atributo value del boton imprimir*/
    function cambiarValorImprimir()
    {
        var elem = document.getElementById("imprimir");
        if (elem.value=="0") elem.value = "1";
    }

    /*Cambia el atributo value del boton guardar*/
    function cambiarValorGuardar()
    {
        var elem = document.getElementById("guardar");
        if (elem.value=="0") elem.value = "2";
    }

</script>

<script>
    /*Muestra y esconde el area de texto motivo*/
    $(document).ready(function () {

    $('input[type="radio"]').click(function () {
        if ($(this).attr("id") == "aprobado") {
            $(".ObservacionesClass").hide('slow');
        }
        if ($(this).attr("id") == "rechazado") {
            $(".ObservacionesClass").show('slow');
        }
    });

    $('input[type="radio"]').trigger('click');
    });
</script>

<script type="text/javascript">
    /*Pide confirmacion para salir de la pagina web*/
    function confirmExit()
    {
        var salir = confirm("¿Está seguro de que desea salir?");

        if(salir==true){  
            setTimeout(function() {
            setTimeout(function() {
            window.location.href="<?php echo constant('URI');?>CTAdministrarPropuestas";
            }, 1000);
            },1); 
        }  
        else{  
            return false;
        }  
    }
</script>