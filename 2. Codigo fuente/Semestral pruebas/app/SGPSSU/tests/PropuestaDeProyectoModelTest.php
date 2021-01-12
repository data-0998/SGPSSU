<!--  Pruebas a realizar: assertIsArray, assertIsNotEmpty, assertCount, assertIsString para get lugar -->
<?php
require_once(__DIR__ . '/../models/PropuestaDeProyectoModel.php');
use \PHPUnit\Framework\TestCase;

class PropuestaDeProyectoModelTest extends TestCase{

/**
 * Como llamar metodos privados.
 *
 * @param object &$object    Instancia el metodo a llamar
 * @param string $methodName Nombre del metodo a llamar
 * @param array  $parameters Arreglo de parametros que usa
 *
 * @return mixed Method return.
 */
public function invocarMetodo(&$object, $methodName, array $parameters = array())
{
    $reflection = new \ReflectionClass(get_class($object));
    $method = $reflection->getMethod($methodName);
    $method->setAccessible(true);

    return $method->invokeArgs($object, $parameters);
}

    public function filtroObtenerPropuestasProveedor(){
        return [
            // Necesito propuestas con cada uno de los estados
            'Caso Todos' => ['Todos'],
            'Caso Aprobado' => ['Aprobado'],
            'Caso Rechazado' => ['Rechazado'],
            'Caso Pendiente de Aprobación' => ['Pendiente de Aprobación'],
            'Caso Enviado a Comisión' => ['Envíado a la Comisión'],
        ];
    }

    public function buscarObtenerPropuestasProveedor(){
        // Tiene estado de pendiente de aprovacion
        return [
            'Caso Titulo' => ['Feria de Galletas'],
            'Caso Nombre Responsable' => ['Belen'],
        ];
    }

    public function buscarObtenerProyectosProveedor(){
        return [
            'Caso Titulo' => ['Feria del Libro'],
            'Caso Nombre Responsable' => ['Diego'],
        ];
    }
    // Probar que se obtienen un arreglo con datos sin un filtro
    public function testGeneraloObtenerPropuestas(){
        $filtro = null;
        $test = new PropuestaDeProyectoModel();
        $this->assertIsArray($test->obtenerPropuestas($filtro));
        $this->assertNotEmpty($test->obtenerPropuestas($filtro));
    }

    /**
     * @dataProvider filtroObtenerPropuestasProveedor
     */    
    public function testFiltroObtenerPropuestas($filtro){
        $test = new PropuestaDeProyectoModel();
        $this->assertNotEmpty($test->obtenerPropuestas($filtro));
        $this->assertIsArray($test->obtenerPropuestas($filtro));
    }

    /**
     * @dataProvider buscarObtenerPropuestasProveedor
     */ 
    public function testBuscarObtenerPropuestas($filtro){
        $test = new PropuestaDeProyectoModel();
        $this->assertNotEmpty($test->obtenerPropuestas($filtro));
        $this->assertIsArray($test->obtenerPropuestas($filtro));
    }

    // Probar que se obtinen datos sin un filtro de proyectots
    public function testGeneralObtenerProyectos(){
        $filtro = null;
        $test = new PropuestaDeProyectoModel();
        $this->assertIsArray($test->obtenerProyectos($filtro));
        $this->assertNotEmpty($test->obtenerProyectos($filtro));
    }

    /**
     * @dataProvider buscarObtenerProyectosProveedor
     */
    public function testBuscarObtenerProyectos($filtro){
        $test = new PropuestaDeProyectoModel();
        $this->assertNotEmpty($test->obtenerProyectos($filtro));
        $this->assertIsArray($test->obtenerProyectos($filtro));
    }

    public function testObtenerProyecto(){
        $id = 1;
        $test = new PropuestaDeProyectoModel();
        $this->assertIsObject($test->obtenerProyecto($id));
        $this->assertNotEmpty($test->obtenerProyecto($id));
    }

    public function testActividadgetLugar(){
        // Id de una Actividad
        $id = 1;
        $test = new PropuestaDeProyectoModel();
        $metodo = $this->invocarMetodo($test,'getLugar',array($id));
        $this->assertNotEmpty($metodo);
        $this->assertIsString($metodo);
    }

    public function testProductogetLugar(){
        // Id de un producto
        $id = 3;
        $test = new PropuestaDeProyectoModel();
        $metodo = $this->invocarMetodo($test,'getLugar',array($id));
        $this->assertNotEmpty($metodo);
        $this->assertIsString($metodo);
        $this->assertEquals('No hay un lugar especificado',$metodo);
    }


}

?>