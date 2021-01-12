<?php
require_once (__DIR__.'/../models/FormularioDePropuestaAprobacionModel.php');
use \PHPUnit\Framework\TestCase;

Class FormularioDePropuestaAprobacionModelTest extends TestCase {

    public function cambiarEstadoProveedor () {
        return [
            'Cambiar estado a enviado a comision' => [1, 0, "", 1, ["codProyecto" => 1, "estadoNuevoPropuesta" => 4], ""],
            'Cambiar estado a aprobado' => [2, 1,"", 2, ["codProyecto" => 2, "estadoNuevoPropuesta" => 1], "La propuesta de proyecto ha sido aprobada"],
        ];
    }

    public function cambiarEstadoRechazadoProveedor () {
        return [
            'Cambiar estado a rechazado' => [2, 2, "Le falta un integrante.", 2, "La propuesta de proyecto ha sido rechazada"],
                ];
    } 

    public function cambiarEstadoAccionImprimirProveedor () {
        return [
            'Accion sobre una propuesta aprobada' => [1, 0, "", 3, ""],
            'Accion sobre una propuesta rechazada' => [1, 0, "", 4, ""],
        ];
    }

//Pruebas con codProyecto = 1
    public function testObtenerPropuestaDeProyecto () {
        $test = new FormularioDePropuestaAprobacionModel();
        $this->assertNotEmpty($test->obtenerPropuestaDeProyecto(["columna1" => 1]));
    }

    public function testObtenerResponsableDeProyecto () {
        $test = new FormularioDePropuestaAprobacionModel();
        $this->assertCount(1, $test->obtenerResponsableDeProyecto(1));
    }

    public function testObtenerSupervisorDeProyecto () {
        $test = new FormularioDePropuestaAprobacionModel();
        $this->assertCount(1, $test->obtenerSupervisorDeProyecto(1));
    }

    public function testObtenerProducto () {
        $test = new FormularioDePropuestaAprobacionModel();
        $this->assertCount(1, $test->obtenerProducto(["columna1" => 1]));
    }

    public function testObtenerPropuestaFacultad () {
        $test = new FormularioDePropuestaAprobacionModel();
        $this->assertNotEmpty($test->obtenerPropuestaFacultad(["columna1" => 1]));
    }

//Pruebas con codProyecto = 2
    public function testObtenerActividad () {
        $test = new FormularioDePropuestaAprobacionModel();
        $this->assertCount(1, $test->obtenerActividad(["columna1" => 2]));
    }

    //CodActividad = 1 
    public function testObtenerDescripcionActividad () {
        $test = new FormularioDePropuestaAprobacionModel();
        $this->assertNotEmpty($test->obtenerDescripcionActividad(1));
    }


    public function testObtenerParticipanteDeProyecto () {
        $test = new FormularioDePropuestaAprobacionModel();
        $this->assertNotEmpty($test->obtenerParticipanteDeProyecto(["columna1" => 2]));
    }

//Prueba si cambia el estado a aprobado y enviado a comision
    /**
     * @dataProvider cambiarEstadoProveedor
     */
    public function testCambiarEstado ($accion, $aprobacion, $observaciones, $codProyecto, $arreglo, $resultado_esperado) {
        $mockTest = $this->getMockBuilder('FormularioDePropuestaAprobacionModel')
                         ->onlyMethods(array('actualizarEstado'))
                         ->getMock();

        $mockTest->expects($this->once())
                 ->method('actualizarEstado')
                 ->with($this->equalTo($arreglo));
        
        $this->assertSame ($resultado_esperado, $mockTest->CambiarEstado($accion, $aprobacion, $codProyecto, $observaciones));
    }

//Prueba si cambia el estado a rechazado
    /**
     * @dataProvider cambiarEstadoRechazadoProveedor
     */
    public function testCambiarEstadoRechazado ($accion, $aprobacion, $observaciones, $codProyecto, $resultado_esperado) {
        $mockTest = $this->getMockBuilder('FormularioDePropuestaAprobacionModel')
                         ->onlyMethods(['actualizarEstado','actualizarMotivo'])
                         ->getMock();

        $mockTest->expects($this->once())
                 ->method('actualizarEstado')
                 ->with($this->equalTo(["codProyecto" => $codProyecto, "estadoNuevoPropuesta" => 2]));

        $mockTest->expects($this->once())
                 ->method('actualizarMotivo')
                 ->with($this->equalTo(["codProyecto" => $codProyecto, "observaciones" => $observaciones]));
        
        $this->assertSame ($resultado_esperado, $mockTest->CambiarEstado($accion, $aprobacion, $codProyecto, $observaciones));
    }

    //Prueba si se realiza la accion correcta sobre una propuesta con estado aprobada o rechazada
    /**
     * @dataProvider cambiarEstadoAccionImprimirProveedor 
     */
    public function testCambiarEstadoAccionImprimir ($accion, $aprobacion, $observaciones, $codProyecto, $resultado_esperado) {
        $test = new FormularioDePropuestaAprobacionModel();
        $this->assertSame ($resultado_esperado, $test->CambiarEstado($accion, $aprobacion, $codProyecto, $observaciones));
    }
}
