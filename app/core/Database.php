<?php
require_once __DIR__.'../../../config/config.php';
class Database{
    private $pdo;

    function __construct(){
        try{
            $dsn      = 'mysql:host='.HOST.';dbname='.DB_NAME;
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Error :".$e->getMessage();
        }
    }    
    public function query($sql, $params = []){
    	$stmt = $this->pdo->prepare($sql);
    	$stmt->execute($params);
    	return $stmt;
    }
}
