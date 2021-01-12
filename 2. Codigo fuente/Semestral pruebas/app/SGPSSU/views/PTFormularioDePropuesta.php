<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/formulario.css">
    
    <title>Propuesta de proyecto</title>
</head>
<body>

    <?php require __DIR__.'/../views/includes/header.php';?>

    <div>
        <ul class="breadcrumb">
            <li><a href="<?php echo constant('URI');?>CTPrincipal">Página Principal</a></li>
            <li><a href="<?php echo constant('URI');?>CTFormularioDePropuesta">Registrar Propuesta</a></li>
        </ul>
    </div>

    <div class="ContenedorTitulos">
        <h1 class= "tituloinicial">Propuesta de Proyecto</h1>
    </div>

    <div class="mensajePrincipal"><?php echo $this->mensajeGlobal;?></div>

    <div class = "contenedorForm"> 
        
        <div class="encabezadoForm">
            <label for="frmDateReg" class="formGroupLabel">Fecha</label>
            <input type="text" name="frmDateReg" required id="frmDate" value="" disabled class="formGroupInput">
        </div>

        <form action="<?php echo constant('URI');?>CTFormularioDePropuesta/Agregar" method="POST">

            <div class="encabezadoForm">
                <label for="proponente" class="formGroupLabel">Proponente</label>
                <input type="text" name="proponente" class="formGroupInput">
                <div class="mensajes"><?php echo $this->mensajeProponente;?></div>
            </div>

            <fieldset class="seccionField">
                <legend class="legendEstilo">Información del Proyecto</legend><hr class = "hrClass" >
                <div class="formGroup">
                    <div class="descripcionesContenedores">
                        <label for="nombreProyecto" class="formGroupLabel">Nombre del Proyecto</label>
                        <div class="formGroupInput">
                            <input type="text" name="nombreProyecto">
                            <div class="mensajes"><?php echo $this->mensajeNombreProyecto;?></div>
                        </div>
                    </div>
                </div>
            
                <div class="formGroup">
                    <div class="descripcionesContenedores">
                        <label for="objetivo" class="formGroupLabel">Objetivo</label>
                        <div class="formGroupInput">
                            <textarea class="textClass" name="objetivo" rows="5" ></textarea>
                            <div class="mensajes"><?php echo $this->mensajeObjetivo;?></div>
                        </div>
                    </div>
                </div>

                <div class="formGroup">
                    <div class="descripcionesContenedores">
                        <label for="descripcion" class="formGroupLabel">Descripción</label>
                        <div class="formGroupInput">
                            <textarea name="descripcion" rows="5" class="textClass"></textarea>
                            <div class="mensajes"><?php echo $this->mensajeDescripcion;?></div>
                        </div>
                    </div>
                </div>

                <label class="formP">Nivel del Proyecto</label>
                <div class="contenedorRadioCheck">
                    <input type="radio" name="nivelProyecto" id="voluntariado" value="1">
                    <label for="voluntariado" class="radioCheck">Voluntariado</label>
                    <input type="radio" name="nivelProyecto" id="servicioSocial" value="2" checked="checked">
                    <label for="servicioSocial">Servicio Social</label>
                </div>

                <label class="formP">Modalidad</label>
                <div class="contenedorRadioCheck">
                    <input type="radio" name="modalidad" id="individual" value="1">
                    <label for="individual" class="radioCheck">Individual</label>
                    <input type="radio" name="modalidad" id="grupal" value="2" checked>
                    <label for="grupal">Grupal</label>
                </div>
            </fieldset>

            <fieldset class="seccionForm">
                <legend class="legendEstilo">Tipo de Proyecto</legend><hr class = "hrClass">
                <div class="contenedorTipoProyecto">

                    <div class="TipoProyecto">
                        <input type="radio" name="tipoProyecto" id="producto" value="1" >
                        <label for="producto">Producto</label>
                    </div>
                    <div class="TipoProyecto">
                        <input type="radio" name="tipoProyecto" id="actividad" value="2" checked="checked">
                        <label for="actividad">Actividad</label>
                    </div>

                </div>
            </fieldset>
            
            <div class = "ActividadClass">
                <fieldset class="seccionField">
                    <legend class="legendEstilo">Actividad</legend><hr class = "hrClass">
                    <div class="formGroup">
                        <div class="descripcionesContenedores">
                            <label for="lugar" class="formGroupLabel">Lugar</label>
                            <div class="formGroupInput">
                                <input type="text" name="lugar">
                                <div class="mensajes"><?php echo $this->mensajeLugar;?></div>
                            </div>
                        </div>
                    </div>

                    <div class="formGroup">
                        <div class="descripcionesContenedores">
                            <label for="descripcionLugar" class="formGroupLabel">Descripción del Lugar</label>
                            <div class="formGroupInput">
                                <textarea class="textClass" name="descripcionLugar" rows="5"></textarea>
                                <div class="mensajes"><?php echo $this->mensajeDescripcionLugar;?></div>
                            </div>
                        </div>
                    </div>

                    <label class="formP" for="programaActividades">Programa de Actividades</label><span> (debe llenar como mínimo una fila)</span>
                    <div class="tabla-actividades" >
                        <table  class="table table-hover small-text" id="actividades">
                            <thead>
                                <tr class="tr-header">
                                    <th scope="col">Actividad</th>
                                    <th scope="col">Tiempo (Horas)</th>
                                    <th scope="col"><a href="javascript:void(0);" style="font-size:18px;" id="addMore1" title="Add More Person"><span class="glyphicon glyphicon-plus"></span></a></th>
                                </tr>
                            </thead>
                            <tbody id="actividadesBody">
                                <?php for ($j = 0; $j < $this->s; $j++) {?>
                                <tr>
                                    <td><textarea name="actividades[]" id="id-actividades" rows="5" class="form-control"></textarea>
                                        <div class="mensajes">
                                            <?php 
                                                if (empty($this->mensajeDatosActividades)){
                                                    echo "";
                                                } else{
                                                    echo $this->mensajeDatosActividades[0][$j];
                                                }
                                            ?>
                                        </div>
                                    </td>
                                    <td class="td-actividades"><input type="text" name="horas[]" id="horas" class="piezas">
                                        <div class="mensajes">
                                            <?php 
                                                if (empty($this->mensajeDatosActividades)){
                                                    echo "";
                                                } else{
                                                    echo $this->mensajeDatosActividades[1][$j];
                                                }
                                            ?>
                                        </div>
                                    </td>
                                    <td><a href="javascript:void(0);" style="font-size:18px;" class='remove1'><span class='glyphicon glyphicon-remove'></span></a></td>
                                </tr>
                                <?php }?> 
                            </tbody>
                            <tfoot>
                                <tr class="tr-footer"> 
                                    <td class="totalClass">Total</td>
                                    <td class="td-actividades"><input type="text" name="resultado" id="resultado" disabled></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </fielset>
            </div>    
            
            <div class="ProductoClass">
                <fieldset class="seccionField">
                    <legend class="legendEstilo">Producto</legend><hr class = "hrClass">

                    <div class="formGroup">
                        <div class="descripcionesContenedores">
                        <label for="tiempoElaboracion" class="formGroupLabel">Tiempo de Elaboración</label>
                            <div class="formGroupInput">
                                <input type="text" name="tiempoElaboracion" placeholder="Horas">
                                <div class="mensajes"><?php echo $this->mensajeTiempoElaboracion;?></div>
                            </div>               
                        </div>
                    </div>

                    <div class="formGroup">
                        <div class="descripcionesContenedores">
                            <label for="descripcionProducto" class="formGroupLabel">Descripción del Producto</label>
                            <div class="formGroupInput">
                                <textarea class="textClass" name="descripcionProducto" rows="5"></textarea>
                                <div class="mensajes"><?php echo $this->mensajeDescripcionProducto;?></div>
                            </div>
                        </div>
                    </div>

                    <div class="formGroup">
                        <div class="descripcionesContenedores">
                            <label for="materialesRequeridos" class="formGroupLabel">Materiales Requeridos</label>
                            <div class="formGroupInput">
                                <textarea class="textClass" name="materialesRequeridos" rows="5"></textarea>
                                <div class="mensajes"><?php echo $this->mensajeMaterialesRequeridos;?></div>
                            </div>
                        </div>
                    </div>

                    <div class="formGroup">
                        <div class="descripcionesContenedores">
                        <label for="facilidades" class="formGroupLabel">Facilidades Otorgadas</label>
                            <div class="formGroupInput">
                                <textarea name="facilidades" rows="5" class="textClass"></textarea>
                                <div class="mensajes"><?php echo $this->mensajeFacilidades;?></div>
                            </div>
                        </div>
                    </div>

                    <label class="formP" for="">¿Requiere docente asesor?</label>
                    <div class="contenedorRadioCheck">
                        <input type="radio" name="asesor" id="si" value="Si" checked="checked">
                        <label for="si" class="radioCheck">Si</label>
                        <input type="radio" name="asesor" id="no" value="No">
                        <label for="no">No</label>
                    </div>
                </fieldset>
            </div>
                
            <fieldset class="seccionField">
                <legend class="legendEstilo">Participante</legend><hr class = "hrClass">
                <div class="formGroup">
                    <div class="descripcionesContenedores">
                    <label for="cantidadDeEstudiantes" class="formGroupLabel">Cantidad de Estudiantes </label>
                        <div class="formGroupInput">
                            <input type="text" name="cantidadDeEstudiantes">
                            <div class="mensajes"><?php echo $this->mensajecantidadDeEstudiantes;?></div>
                        </div>
                    </div>
                </div>
                
                <label class="formP" for="">Facultades Involucradas</label><span> (debe seleccionar uno como mínimo)</span>
                <div class="contenedorRadioCheck">
                    <input type="checkbox" name="facultadesInvolucradas[]" value = "1">
                    <label for="FCyT" class="radioCheck"><span>FCyT</span></label>
                    <input type="checkbox" name="facultadesInvolucradas[]" value = "2">
                    <label for="FIC" class="radioCheck"><span>FIC</span></label>
                    <input type="checkbox" name="facultadesInvolucradas[]" value = "3">
                    <label for="FIE" class="radioCheck"><span>FIE</span></label>
                    <input type="checkbox" name="facultadesInvolucradas[]" value = "4">
                    <label for="FII" class="radioCheck"><span>FII</span></label>
                    <input type="checkbox" name="facultadesInvolucradas[]" value = "5">
                    <label for="FIM" class="radioCheck"><span>FIM</span></label>
                    <input type="checkbox" name="facultadesInvolucradas[]" value = "6">
                    <label for="FISC">FISC</label>
                    <div class="mensajes"><?php echo $this->mensajeFacultadesInvolucradas;?></div>
                </div>

                <div class="formGroup">
                    <div class="descripcionesContenedores">
                        <label for="perfilEstudiantes" class="formGroupLabel">Perfil de Estudiantes Solicitados</label>
                        <div class="formGroupInput">
                            <textarea class="textClass" name="perfilEstudiantes" rows="5"></textarea>
                        </div>
                    </div>
                </div>

                <label class="formP">Datos de Participantes</label><span> (debe llenar como mínimo una fila)</span>
                <table  class="table table-hover small-text" id="tb">
                    <thead>
                        <tr class="tr-header">
                            <th scope = "col">Cédula</th>
                            <th scope = "col">Nombre</th>
                            <th scope = "col">Apellido</th>
                            <th scope = "col">Teléfono Residencial</th>
                            <th scope = "col">Teléfono Móvil</th>
                            <th scope = "col"><a href="javascript:void(0);" style="font-size:18px;" id="addMore2" title="Add More Person"><span class="glyphicon glyphicon-plus"></span></a></th>
                    </thead>
                    
                    <tbody>
                        <?php for ($i = 0; $i < $this->n; $i++) {?>
                        <tr>
                            <td>
                                <input type="text" name="cedulaParticipante[]" placeholder="8-234-2322" class="form-control">
                                <div class="mensajes">
                                    <?php 
                                        if (empty($this->mensajeDatosParticipantes)){
                                            echo "";
                                        } else{
                                            echo $this->mensajeDatosParticipantes[0][$i];
                                        }
                                    ?>
                                </div>
                            </td> 
                            <td>
                                <input type="text" name="nombreParticipante[]" placeholder="primer nombre" class="form-control">
                                <div class="mensajes">
                                    <?php 
                                        if (empty($this->mensajeDatosParticipantes)){
                                            echo "";
                                        } else{
                                            echo $this->mensajeDatosParticipantes[1][$i];
                                        }
                                    ?>
                                </div>
                            </td>
                            <td>
                                <input type="text" name="apellidoParticipante[]" placeholder="primer apellido" class="form-control">
                                <div class="mensajes">
                                    <?php 
                                        if (empty($this->mensajeDatosParticipantes)){
                                            echo "";
                                        } else{
                                            echo $this->mensajeDatosParticipantes[2][$i];
                                        }
                                    ?>
                                </div>
                            </td>
                            <td>
                                <input type="text" name="telefonoResidencialParticipante[]" placeholder="omitir guiones" class="form-control">
                                <div class="mensajes">
                                    <?php 
                                        if (empty($this->mensajeDatosParticipantes)){
                                            echo "";
                                        } else{
                                            echo $this->mensajeDatosParticipantes[3][$i];
                                        }
                                    ?>
                                </div>
                            </td>
                            <td>
                                <input type="text" name="telefonoMovilParticipante[]" placeholder="omitir guiones" class="form-control">
                                <div class="mensajes">
                                    <?php 
                                        if (empty($this->mensajeDatosParticipantes)){
                                            echo "";
                                        } else{
                                            echo $this->mensajeDatosParticipantes[4][$i];
                                        }
                                    ?>
                                </div>
                            </td>
                            <td><a href="javascript:void(0);" style="font-size:18px;" class='remove2'><span class='glyphicon glyphicon-remove'></span></a></td>
                        </tr>
                        <?php }?> 
                    </tbody>
                </table>
            </fieldset>
            
            <fieldset>
                <legend class="legendEstilo">Información de Encargados</legend><hr class = "hrClass">
                <section>
                    <h3 class="tabla-actividades">Responsable</h3>
                    <div class="formGroup">
                        <div class="descripcionesContenedores">
                            <label for="nombreResponsable" class="formGroupLabel">Nombre</label>
                            <div class="formGroupInput">
                                <input type="text" name="nombreResponsable" placeholder="primer nombre">
                                <div class="mensajes"><?php echo $this->mensajeNombreResponsable;?></div>
                            </div>
                        </div>
                    </div>

                    <div class="formGroup">
                        <div class="descripcionesContenedores">
                            <label for="apellidoResponsable" class="formGroupLabel">Apellido</label>
                            <div class="formGroupInput">
                                <input type="text" name="apellidoResponsable" placeholder="primer apellido">
                                <div class="mensajes"><?php echo $this->mensajeApellidoResponsable;?></div>
                            </div>
                        </div>
                    </div>

                    <div class="formGroup">
                        <div class="descripcionesContenedores">
                            <label for="cedulaResponsable" class="formGroupLabel">Cédula</label>
                            <div class="formGroupInput">
                                <input type="text" name="cedulaResponsable" placeholder="8-234-2322">
                                <div class="mensajes"><?php echo $this->mensajeCedulaResponsable;?></div>
                            </div>
                        </div>
                    </div>

                    <div class="formGroup">
                        <div class="descripcionesContenedores">
                            <label for="correoResponsable" class="formGroupLabel">Correo</label>
                            <div class="formGroupInput">
                                <input type="text" name="correoResponsable">
                                <div class="mensajes"><?php echo $this->mensajeCorreoResponsable;?></div>
                            </div>
                        </div>
                    </div>

                    <div class="formGroup">
                        <div class="descripcionesContenedores">
                            <label for="telefonoOficinaResponsable" class="formGroupLabel">Teléfono Oficina</label>
                            <div class="formGroupInput">
                                <input type="text" name="telefonoOficinaResponsable" placeholder="omitir guiones">
                                <div class="mensajes"><?php echo $this->mensajeTelefonoOficinaResponsable;?></div>
                            </div>
                        </div>
                    </div>

                    <div class="formGroup">
                        <div class="descripcionesContenedores">
                        <label for="telefonoMovilResponsable" class="formGroupLabel">Teléfono Móvil</label>
                            <div class="formGroupInput">
                                <input type="text" name="telefonoMovilResponsable" placeholder="omitir guiones">
                                <div class="mensajes"><?php echo $this->mensajeTelefonoMovilResponsable;?></div>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="tabla-actividades">Supervisor</h3>
                    <div class="formGroup">
                        <div class="descripcionesContenedores">
                            <label for="nombreSupervisor"  class="formGroupLabel">Nombre </label>
                            <div class="formGroupInput">
                                <input type="text" name="nombreSupervisor" placeholder="primer nombre">
                                <div class="mensajes"><?php echo $this->mensajeNombreSupervisor;?></div>
                            </div> 
                        </div> 
                    </div> 
                    <div class="formGroup">
                        <div class="descripcionesContenedores"> 
                            <label for="apellidoSupervisor"  class="formGroupLabel">Apellido</label>
                            <div class="formGroupInput">
                                <input type="text" name="apellidoSupervisor" placeholder="primer apellido">
                                <div class="mensajes"><?php echo $this->mensajeApellidoSupervisor;?></div>
                            </div>
                        </div> 
                    </div>

                    <div class="formGroup">
                        <div class="descripcionesContenedores"> 
                            <label for="cedulaSupervisor"  class="formGroupLabel">Cédula</label>
                            <div class="formGroupInput">
                                <input type="text" name="cedulaSupervisor" placeholder="8-234-2322">
                                <div class="mensajes"><?php echo $this->mensajeCedulaSupervisor;?></div>
                            </div>
                        </div> 
                    </div> 

                    <div class="formGroup">
                        <div class="descripcionesContenedores">
                            <label for="correoSupervisor"  class="formGroupLabel">Correo</label>
                            <div class="formGroupInput">
                                <input type="text" name="correoSupervisor">
                                <div class="mensajes"><?php echo $this->mensajeCorreoSupervisor;?></div>
                            </div> 
                        </div> 
                    </div> 
                    <div class="formGroup">
                        <div class="descripcionesContenedores">
                            <label for="telefonoOficinaSupervisor"  class="formGroupLabel">Teléfono Oficina</label>
                            <div class="formGroupInput">
                                <input type="text" name="telefonoOficinaSupervisor" placeholder="omitir guiones">
                                <div class="mensajes"><?php echo $this->mensajeTelefonoOficinaSupervisor;?></div>
                            </div> 
                        </div> 
                    </div> 
                    <div class="formGroup">
                        <div class="descripcionesContenedores">
                            <label for="telefonoMovilSupervisor"  class="formGroupLabel">Teléfono Móvil</label>
                            <div class="formGroupInput">
                                <input type="text" name="telefonoMovilSupervisor" placeholder="omitir guiones">
                                <div class="mensajes"><?php echo $this->mensajeTelefonoMovilSupervisor;?></div>
                            </div> 
                        </div> 
                    </div> 
                <section>
            </fieldset>

            <div class="contenedorBotones">
                <input type="button" value="Salir" onClick="confirmExit();" class="botonespantalla">
                <input type="submit" value="Registrar" class="botonespantalla">
            </div>
        </form>
    </div>

    <?php require __DIR__.'/../views/includes/footer.php'; ?>
</body>
</html>

<script src="<?php echo constant('URL');?>public/js/FormularioDePropuesta.js"></script>
<script type="text/javascript">
    function confirmExit()
    {
        var salir = confirm("¿Está seguro de que desea salir?");

        if(salir==true){  
            setTimeout(function() {
            setTimeout(function() {
            window.location.href="<?php echo constant('URI');?>CTPrincipal";
            }, 1000);
            },1); 
        }  
        else{  
            return false;
        }  
    }
</script>

