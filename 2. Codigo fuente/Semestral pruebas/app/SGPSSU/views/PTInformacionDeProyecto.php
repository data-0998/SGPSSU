<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/PTInformacionDeProyecto.css">
    <title><?= $this->titulo ?></title>
</head>
<body>
    <?php require __DIR__.'/../views/includes/header.php'; ?>

    <?php 
        include_once __DIR__.'/../models/PropuestaDeProyectoModel.php';
        $item = new PropuestaDeProyectoModel();
        $item = $this->proyecto;
    ?>


<div>
        <ul class="breadcrumb">
        <li><a href="<?php echo constant('URI');?>CTPrincipal">Página Principal</a></li>
            <li>Proyectos</li>
            <li><a href="<?php echo constant('URI');?>CTProyectosDisponibles">Proyectos Disponibles</a></li>
            <li>Descripción del Proyecto</li>
        </ul>
    </div>

    <div class="ContenedorTitulos">
    <h1 class="tituloinicial">DESCRIPCIÓN DEL PROYECTO</h1> 
    </div>

    <div class="contenedordescripcion">
        <h1 class="negritatitulo">Título del Proyecto: </h1><div class="descripcioncaja"><p class="datosdeladb"><?= $item->tituloProyecto; ?></p></div>
        <h1 class="negritatitulo">Responsable: </h1><div class="descripcioncaja"><p class="datosdeladb"><?= $item->responsable->nombre; ?></p></div>
        <h1 class="negritatitulo">Correo Electrónico: </h1><div class="descripcioncaja"><p class="datosdeladb"><?= $item->responsable->correo; ?></p></div>
        <h1 class="negritatitulo">Télefono Oficina: </h1><div class="descripcioncaja"><p class="datosdeladb"><?= $item->responsable->telefonoMovil; ?></p></div>
        <h1 class="negritatitulo">Télefono Móvil: </h1><div class="descripcioncaja"><p class="datosdeladb"><?= $item->responsable->telefonoOficina; ?></p></div>
        <h1 class="negritatitulo">Lugar: </h1><div class="descripcioncaja"><p class="datosdeladb"><?= $item->actividad->lugar; ?></p></div>
        <h1 class="negritatitulo">Descripción: </h1>
        <div class="descripcioncaja"><p class="datosdeladb"> <?= $item->descripcion; ?></p></div>
    </div>
    <div class="cajafinal">
    <div class="salirproyecd">
        <form action="CTProyectosDisponibles"method="GET">
            <input class="botonespantalladisp" type="submit" name="" value="Salir">
        </form> 
    </div>
    <div class="participarcaja">
        <form action="CTProyectosDisponibles"method="GET">
        <input class="botonespantalladisp" type="submit" name="" value="Participar">
    </form> 
    </div>
    </div>    

    <?php require __DIR__.'/../views/includes/footer.php'; ?>
</body>
</html>