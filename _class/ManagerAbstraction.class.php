<?php
include_once '_config/db.php';

abstract class ManagerAbstraction{
    protected $_db;
    
    //constructor
    public function __construct(){
        $this->_db = __db();
    }
}