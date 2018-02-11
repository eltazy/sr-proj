<?php
class Authentication{
    private $_auth_name;
    private $_auth_pwd;

    //constructor
    public function __construct($t_usr, $t_pwd){
        $this->setUsername($t_usr);
        $this->setPassword($t_pwd);
    }
    //getters
    public function username(){
        return $this->_auth_name;
    }
    public function password(){
        return $this->_auth_pwd;
    }
    //setters
    public function setUsername($arg){
        $this->_auth_name = $arg;
    }
    public function setPassword($arg){
        $this->_auth_pwd = $arg;
    }
}
?>