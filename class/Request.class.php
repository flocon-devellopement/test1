<?php

class Request
{
    private $pdo;
    // Connexion base de donnée
	public function __construct() {
	    $this->pdo = new PDO('mysql:host=localhost;dbname=session', 'root', 'root');
	}
	// Requète Execute
	public function execute($sql, array $values = array()){
	    $this->pdo->exec('SET NAMES UTF8');
	    $query = $this->pdo->prepare($sql);
		$query->execute($values);
	}
	// Requète fetchAll
	public function query($sql){
        $this->pdo->exec('SET NAMES UTF8');
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    // Requète fetch
    public function queryOne($sql, array $values = array()){
        $this->pdo->exec('SET NAMES UTF8');
        $query = $this->pdo->prepare($sql);
        $query->execute($values);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}