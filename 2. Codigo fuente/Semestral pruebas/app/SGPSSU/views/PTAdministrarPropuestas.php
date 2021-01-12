<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->titulo ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/PTAdministrarPropuestas3.css">
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/error.css">
    
</head>
<body>
    <?php require __DIR__.'/../views/includes/header.php'; ?>
    <div>
        <ul class="breadcrumb">
            <li><a href="<?php echo constant('URI');?>CTPrincipal">Página Principal</a></li>
            <li>Administrar Proyectos</li>
            <li><a href="<?php echo constant('URI');?>CTAdministrarPropuestas">Propuestas de Proyecto</a></li>
        </ul>
    </div>
    <div class="ContenedorTitulos">
        <h1 class="tituloinicial">PROPUESTAS DE PROYECTO</h1> 
    </div>


    <div class="contenedoruno">
        <div class="tituloproyecto">
            <p class="negritatitulo">Buscar:</p>
            <form class="example" action="" method = "GET">
                <input type="text" placeholder="Buscar nombre del proyecto o nombre del encargado..." name="buscar">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>

        <div class="contenedorbuscaryf">
            <form action=""method="GET">
                <div class="filtroalado">
                <div class="listadelfiltro">
                    <label class="negritatitulo" for="">Seleccionar una opción: </label>
                    <select name="estado">
                    <option value="Todos">Todos</option>
                        <option value="Aprobado">Aprobado</option>
                        <option value="Rechazado">Rechazado</option>
                        <option value="Pendiente de Aprobación">Pendiente de Aprobación</option>
                        <option value="Envíado a la Comisión">Envíado a la Comisión</option>
                    </select>
                    
                </div>
                <div class="moverfiltro"><input class="botonespantalla" type="submit" value="Filtrar"></div>
            </form>
            </div>
        </div>
    </div>  
    <hr style="clear:both">   
    <div class="tamaño">    
        <table>
            <tr><div class="espaciosenb"></div>
                <th class="lineas1">Proyecto</th>
                <th class="lineas1">Encargado</th>
                <th class="lineas1">Estado</th>
                <th class="lineas1"></th></div>
            </tr>
            <?php 
            include_once __DIR__.'/../models/PropuestaDeProyectoModel.php';
            foreach($this->proyectos as $row){
                $proyecto = new PropuestaDeProyectoModel();
                $proyecto = $row;
            ?>
            
                <tr>
                    <td class="lineas"> <div class="rellenos"><p><?= $proyecto->tituloProyecto?></p> </div></td>
                    <td class="lineas"><div class="rellenos"><p><?= $proyecto->responsable->nombre?></p></div></td>
                    <td class="lineas"><div class="rellenos"><p><?= $proyecto->estado?></p></div></td>
                    <td class="quitarlinea">
                        <form action="<?= constant('URI')?>CTFormularioDePropuestaAprobacion/obtenerCodProyecto" method="POST"> 
                                <input type="hidden" name="verDetalles" value="<?= $proyecto->codProyecto; ?>" >
                                <input class="botonespantalla"type="submit" value="Abrir">       
                        </form>
                    </td>
                </tr>
                <tr>
                    <td class="espacioblancos"> <p class = "content-administrar"></p></td>
                    <td class="espacioblancos"><p class = "content-administrar"></p></td>
                    <td class="espacioblancos"><p class = "content-administrar"></p></td>
                    <td class="espacioblancos"><p class = "content-administrar"></p></td>
                </tr>



            <?php } ?>
    </table>
    </div>

    <?php
        $imgerror=constant('URL')."public/images/error.png";
        if($this->error!=""){
            echo "
                <div class='center'>
                    <div class='contenedorerror'><img class='errorimagen' src=".$imgerror." alt='error' title='error' width='150em' height='150em'></div>
                    <div class='contenedorerrortex'><p class='errores'>$this->error</p></div>
                </div> ";
        }

    ?>

    <div class="salirproyecd">
        <form action="CTPrincipal">
            <input class="botonespantalla" type="submit" name="" value="Salir">
        </form>
    </div>

    <?php require __DIR__.'/../views/includes/footer.php'; ?>
</body>
</html>