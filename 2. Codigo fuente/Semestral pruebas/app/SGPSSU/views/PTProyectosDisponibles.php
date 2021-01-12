<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->titulo ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/PTProyectosDisponibles.css">
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/error.css">
</head>
<body>
    <?php require __DIR__.'/../views/includes/header.php'; ?>
    
    <div>
        <ul class="breadcrumb">
        <li><a href="<?php echo constant('URI');?>CTPrincipal">Página Principal</a></li>
            <li>Administrar Proyectos</li>
            <li><a href="<?php echo constant('URI');?>CTProyectosDisponibles">Proyectos Disponibles</a></li>
        </ul>
    </div>
    
    <div class="ContenedorTitulos">
        <h1 class="tituloinicial">PROYECTOS DE SERVICIO SOCIAL</h1> 
    </div>

    <div class="contenedoruno">
        <div class="tituloproyecto">
            <p class="negritatitulo">Buscar:</p>
            <form class="example" action="" method="GET">
                <input type="text" placeholder="Ingrese el nombre del proyecto o encargado..." name="buscar">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>  

    <hr style="clear:both">   
    <div class="tamaño">
        <table>
            <tr><div class="espaciosenb"></div>
                <th class="lineas1"></th></div>
            </tr>

            <?php 
                include_once __DIR__.'/../models/PropuestaDeProyectoModel.php';
                foreach($this->proyectos as $row){
                    $proyecto = new PropuestaDeProyectoModel();
                    $proyecto = $row;
            ?>
                <tr>
                    <td class="lineas"> <div class="rellenos"> <p class="negritatitulo">Titulo de proyecto:</p> </div></td>
                    <td class="lineas"><p class="textoinsert"> <?= $proyecto->tituloProyecto?></p></td>
                    <td rowspan="2" class="quitarlinea">
                            <form action="<?= constant('URI')?>CTInformacionDeProyecto" method="GET"> 
                                <input type="hidden" name="id" value="<?= $proyecto->codProyecto; ?>" >
                                <input class="botonespantalladisp"type="submit" value="Abrir">       
                            </form>
                    </td>

                </tr>
                <tr>
                    <td class="lineas"> <div class="rellenos"> <p class="negritatitulo">Representante:</div></td>
                    <td class="lineas"><p class="textoinsert"> <?= $proyecto->responsable->nombre?></p></td>
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
        <form action="CTPrincipal"method="GET">
            <input class="botonespantalladisp" type="submit" name="" value="Salir">
        </form>
    </div>
    
    <?php require __DIR__.'/../views/includes/footer.php'; ?>
</body>
</html>