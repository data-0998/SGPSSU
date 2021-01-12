<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$this->titulo?></title>
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/PTPrincipal.css">
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/slider.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <?php require __DIR__.'/../views/includes/header.php'; ?>

    <div class = "slide-container">
        <?php require __DIR__.'/../views/includes/slider.php'; ?>
    </div>

    
    <div class="m-5 pb-5 ">
        <section>
            <h1>Servicio Social</h1>
            <p class="text-justify"  >El programa de Servicio Social Universitario es un emprendimiento de la Universidad Tecnologica de Panama (UTP)
            dirigido a apoyar a los sectores mas necesitados de nuestra sociedad, a traves de proyectos de Servicio Social
            en el que nuestros estudiantes y profesores puedan aportar sus capacidades personales y su creatividad para la solucion 
            de problemas concretos de la sociedad o puedan hacer uso de las capacidades tecnicas adquiridas a traves de sus diversas
            carreras universitarias</p>
        </section>
    </div>
    <div class="m-5 pb-5 ">
        <section>
            <h1>Objetivo</h1>
            <p class="text-justify">Vincular a la UTP con los sectores publicos, privado y social con el proposito de contribuir con el bienestar y desarrollo 
            tecnologico, economico y social sostenible de las comunidades, a traves de los proyectos de Servicio Social Universitario. Asi como 
            el desarrollar una conciencia de resposabilidad social en la comunidad universiaria y fomentar en el estudiante la solidaridad, 
            la etica, la participacion ciudadana y el compromiso con la comunidad como valores sociales</p>
        </section>
    </div>
    <div class="m-5 pb-5 ">
        <section>
            <h1>Beneficios</h1>
            <p class="text-justify">Algunos de los beneficios de hacer Servicio Social son poder poner en practica y reforsar conocimientos y habilidades al 
            integrarse en un ambito profesional. Realizar proyectos en concordancia con el perfil profescional; vincularse en la realidad 
            del area profesional que le permita darse a conocer como un profesionista capacitado y con valores suficientes para cumplir con 
            su responsabilidad social; asesoria academica que le apoyen a cumplir sus servicio social, asi como acreditar su certificado de culminacion;
            fortalecer la Hoja de Vida del estudiante, con experiencia que cada dia son mas tomadas en cuenta en participacion de concursos
            para optar por una beca, una plaza laboral, etc.</p>
        </section>
    </div>
    <div class="m-5 pb-5 ">
        <section >
            <h1>Procedimiento para realizar proyectos de Servicio Social Universitario</h1>
            <p>El proponente debe llenar y enviar el formulario "Propuesta de Proyecto".<br>
            <ol type="number" class="mx-5">
            <li>Por correo electronico se le enviara la respuesta a dicha solicitud</li>
            <li>Una vez aprobada, el proyecto inicia el reclutamiento de los voluntarios (En caso de que se necesiten)
            por medio de esta aplicacion</li>
            <li>Durante el proyecto, el proponente debe llevar el control de la ejecucion del mismo: para ello, llenara el documento "Informe de Ejecucion"</li>
            <li>Al terminar, se debe enviar el "Informe de Culminacion" donde debera incluir fotos que evidencen la ejecucion del proyecto</li>
            </ol></p>
        </section>
    </div>
    
    <?php require __DIR__.'/../views/includes/footer.php'; ?>
</body>
</html>