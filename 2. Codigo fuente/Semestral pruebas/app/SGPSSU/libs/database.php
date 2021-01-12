<!-- La clase Database sirve para acceder desde los modelos,
a metodos que de forma sencilla hacen querys a la base de datos(Insert,Delete,Select,Update...) -->

<?php
require_once(__DIR__ . '/../config/config.php');
class Database{

    private $host;
    private $db;
    private $user;
    private $password;
    private $connection = null;

    public function __construct(){
        $this->host = constant('HOST');
        $this->db = constant('DB');
        $this->user = constant('USER');
        $this->password = constant('PASSWORD');
        $this->Connect();
    }

    private function Connect(){
        try{
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->db};", $this->user, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }catch(Exception $e){
            throw new Exception($e->getMessage());   
        }	
    }

    public function Insert( $statement = "" , $parameters = [] ){
        $this->executeStatement( $statement , $parameters );
        return $this->connection->lastInsertId();
    }

    public function Select( $statement = "" , $parameters = [] ){
        $stmt = $this->executeStatement( $statement , $parameters );
        return $stmt->fetchAll();
    }
    
    public function Update( $statement = "" , $parameters = [] ){
        $this->executeStatement( $statement , $parameters );
    }		
    
    public function Remove( $statement = "" , $parameters = [] ){
        $this->executeStatement( $statement , $parameters );
	
    }		
    
    private function executeStatement( $statement = "" , $parameters = [] ){
        $stmt = $this->connection->prepare($statement);
        $stmt->execute($parameters);
        return $stmt;
    }

}

?>