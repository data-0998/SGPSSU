<?php
require_once (__DIR__.'/../models/FormularioDePropuestaModel.php');
use \PHPUnit\Framework\TestCase;

Class FormularioDePropuestaModelTest extends TestCase{
    public function insertarResponsableDeProyectoProveedor(){
        return [
            'Existente' => [["columna1" => "65009080", "columna2" => "3901600",
                            "columna3" => "Ernesto", "columna4" => "Urrutia",
                            "columna5" => "E-6-555555", "columna6" => "ernesto@gmail.com"], 1],
            'Nuevo' => [["columna1" => "66698569", "columna2" => "2693656",
                            "columna3" => "Sancho", "columna4" => "Panza",
                            "columna5" => "E-9-50885", "columna6" => "sancho@gmail.com"], 2]
        ];
    }

    public function insertarSupervisorDeProyectoProveedor(){
        return [
            'Existente' => [["columna1" => "66638050", "columna2" => "2758040",
                            "columna3" => "Dylan", "columna4" => "Cardenas",
                            "columna5" => "5-450-698", "columna6" => "dylan@gmail.com"], 1],
            'Nuevo' => [["columna1" => "65037454", "columna2" => "2004656",
                            "columna3" => "Laura", "columna4" => "Cheung",
                            "columna5" => "8-940-8888", "columna6" => "laura@gmail.com"], 2]
        ];
    }

    public function insertarParticipanteDePropuestaProveedor(){
        return [
            'Caso 1' => [["columna6" => 3, "columna7" => 2], 3]
        ];
    }

    public function insertarParticipanteDeProyectoProveedor(){
        return [
            'Existente' => [["columna1" => "Sawako", "columna2" => "Kuronuma",
                            "columna3" => "9-205-514", "columna4" => "65465465",
                            "columna5" => ""], 1],
            'Nuevo' => [["columna1" => "Leticia", "columna2" => "Karasuma",
                            "columna3" => "4-214-180", "columna4" => "64747008",
                            "columna5" => "3910006"], 3]
        ];
    }

    public function insertarPropuestaFacultadProveedor(){
        return [
            'Caso 1' => [["columna1" => 4, "columna2" => 2], 4]
        ];
    }

    public function insertarProductoProveedor(){
        return [
            'Caso 1' => [["columna1" => 2, "columna2" => "No",
                        "columna3" => 1, "columna4" => "Internet, Computadoras",
                        "columna5" => "Transporte, Comida", "columna6" => "Desarrollar el software llamada SGPSSU"], 3]
        ];
    }

    public function insertarActividadProveedor(){
        return [
            'Caso 1' => [["columna1" => 1, "columna2" => "Cerca de San Francisco",
                        "columna3" => "Parque Omar"], 2]
        ];
    }

    public function insertarDescripcionActividadProveedor(){
        return [
            'Caso 1' => [["columna1" => 1, "columna2" => "Plantar 1000 flores en el centro del parque.",
                        "columna3" => 5], 2]
        ];
    }

    public function insertarPropuestaDeProyectoProveedor(){
        return [
            'Caso 1' => [["columna1" => 1, "columna2" => 1,
                        "columna4" => "Nito Cortizo", "columna5" => 2,
                        "columna6" => "Reforestación en el Parque Omar", 
                        "columna7" => "Restaurar la naturaleza pérdida causado por el hombre", 
                        "columna8" => "Se plantaran muchos tipos de flora", "columna9" => 2,
                        "columna10" => 2, "columna11" => 10,
                        "columna12" => 1, "columna13" => "",
                        "columna14" => 3], 3]
        ];
    }

    /**
     * @dataProvider insertarSupervisorDeProyectoProveedor
     */
    public function testInsertarSupervisorDeProyecto ($arreglo, $resultado_esperado){
        $test = new FormularioDePropuestaModel();
        $this->assertEquals($resultado_esperado, $test->insertarSupervisorDeProyecto($arreglo));
    }

    /**
     * @dataProvider insertarResponsableDeProyectoProveedor
     */
    public function testInsertarResponsableDeProyecto ($arreglo, $resultado_esperado){
        $test = new FormularioDePropuestaModel();
        $this->assertEquals($resultado_esperado, $test->insertarResponsableDeProyecto($arreglo));
    }

    /**
     * @dataProvider insertarParticipanteDePropuestaProveedor
     */
    public function testInsertarParticipanteDePropuesta($arreglo, $resultado_esperado){
        $test = new FormularioDePropuestaModel();
        $this->assertEquals($resultado_esperado, $test->insertarParticipanteDePropuesta($arreglo));
    }

    /**
     * @dataProvider insertarParticipanteDeProyectoProveedor
     */
    public function testInsertarParticipanteDeProyecto($arreglo, $resultado_esperado){
        $test = new FormularioDePropuestaModel();
        $this->assertEquals($resultado_esperado, $test->insertarParticipanteDeProyecto($arreglo));
    }

    /**
     * @dataProvider insertarPropuestaFacultadProveedor
     */
    public function testInsertarPropuestaFacultad($arreglo, $resultado_esperado){
        $test = new FormularioDePropuestaModel();
        $this->assertEquals($resultado_esperado, $test->insertarPropuestaFacultad($arreglo));
    }

    /**
     * @dataProvider insertarProductoProveedor
     */
    public function testInsertarProducto($arreglo, $resultado_esperado){
        $test = new FormularioDePropuestaModel();
        $this->assertEquals($resultado_esperado, $test->insertarProducto($arreglo));
    }

    /**
     * @dataProvider insertarActividadProveedor
     */
    public function testInsertarActividad($arreglo, $resultado_esperado){
        $test = new FormularioDePropuestaModel();
        $this->assertEquals($resultado_esperado, $test->insertarActividad($arreglo));
    }

    /**
     * @dataProvider insertarDescripcionActividadProveedor
     */
    public function testInsertarDescripcionActividad($arreglo, $resultado_esperado){
        $test = new FormularioDePropuestaModel();
        $this->assertEquals($resultado_esperado, $test->insertarDescripcionActividad($arreglo));
    }

    /**
     * @dataProvider insertarPropuestaDeProyectoProveedor
     */
    public function testInsertarPropuestaDeProyecto($arreglo, $resultado_esperado){
        $test = new FormularioDePropuestaModel();
        $this->assertEquals($resultado_esperado, $test->insertarPropuestaDeProyecto($arreglo));
    }

}
