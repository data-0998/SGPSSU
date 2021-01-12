<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link  rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/header.css">
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/footer.css">
    
</head>
<body>
    <header>
        <div class="encabezado">
            <div class="encabezado-logo">
                <a href="<?php echo constant('URI');?>CTPrincipal"><img class="logoUTP" src="<?php echo constant('URL');?>public/images/utp.png" alt="Logo UTP" tittle = "Logo UTP"></a>
            </div>    
            <div class="encabezado-titulo">
                <p>Camino a la excelencia a través del mejoramiento continuo</p>
                <h1>Universidad Tecnológica de Panamá</h1>
                <h1>Servicio Social Universitario</h1>
            </div>
            <div class="encabezado-notificacion">
                <img class="imagen-notificacion" src="<?php echo constant('URL');?>public/images/notificacion.png" alt="Capana de notificación" tittle = "Campana de notificación">
            </div>
            <div class="encabezado-perfil">
                <img class="imagen-perfil" src="<?php echo constant('URL');?>public/images/perfil.png" alt="Perfil del usuario" tittle="Perfil del usuario">
            </div>
            <div class="encabezado-sesion">
                <a href="#">Iniciar Sesión</a>
            </div>
            <div class="encabezado-servicio">
                <img class="imagen-servicio" src="<?php echo constant('URL');?>public/images/social.png" alt="Logo del Servicio Social" tittle ="Logo del Servicio Social">
            </div>
        </div>
    </header>

    <nav class="navegador">
        <ul class="navegador-ul">
            <li class="navegador-dropdown"><a href="#">Proyectos</a>
                <ul class="navegador-ul-ul">
                    <li><a href="<?php echo constant('URI');?>CTFormularioDePropuesta">Registrar Propuesta</a></li>
                    <li><a href="<?php echo constant('URI');?>CTProyectosDisponibles">Proyectos Disponibles</a></li>
                </ul>
            </li>
            <li><a href="#">Seguimiento de Proyectos</a></li>
            <li class="navegador-dropdown"><a href="#">Administrar Proyectos</a>
                <ul class="navegador-ul-ul">
                    <li><a href="<?php echo constant('URI');?>CTAdministrarPropuestas">Administrar Propuestas</a></li>
                </ul>
            </li>
            <li><a href="#">Administrar Cuentas</a></li>
            <li><a href="#">Servicios</a></li>
            <li><a href="<?php echo constant('URL');?>public/docs/Manual del usuario.pdf">Ayuda</a></li>
        </ul>
    </nav>
</body>
</html>