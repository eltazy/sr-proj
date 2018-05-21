<?php

class AppSettings
{
    private $dbname      = 'srproj';
    private $dbhost      = 'localhost';
    private $dbuser      = 'el';
    private $dbpwd       = 'root';
    private $dbconnexion = null;

    //constructor
    public function __construct(){
        $this->dbconnexion = new PDO("mysql:dbhost=$this->dbhost;dbname=$this->dbname", $this->dbuser, $this->dbpwd);
        $this->dbconnexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    //getter
    public function AppDatabaseConnexion(){
        return $this->dbconnexion;
    }
}

function __db(){
    return (new AppSettings())->AppDatabaseConnexion();
}
?>