<?php

class Model{

private const DB_HOST = "localhost";
private const DB_USER = 'root';
private const DB_PASS = 'root';
private const DB_NAME = 'onlinemvc';

protected $dbh;

public function __construct(){

    $this->dbh = new PDO("mysql:host=".self::DB_HOST.";dbname=".self::DB_NAME,self::DB_USER, self::DB_PASS);
}

public function getConnexion(){
    return $this->dbh;
}

public function valid_donnees($donnees){
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;

}

}
?>