<?php
class Authentication{
    private $_auth_name;
    private $_auth_pwd;
    private $_auth_type;

    //constructor
    public function __construct($t_usr, $t_pwd, $t_type='S'){
        $this->setUsername($t_usr);
        $this->setPassword($t_pwd);
        $this->setType($t_type);
    }
    //getters
    public function username(){
        return $this->_auth_name;
    }
    public function password(){
        return $this->_auth_pwd;
    }
    public function type(){
        return $this->_auth_type;
    }
    public function matches(Authentication $auth){
        return $this->_auth_name==$auth->username() && $this->_auth_pwd==$auth->password();
    }
    //setters
    public function setUsername($arg){
        $this->_auth_name = $arg;
    }
    public function setPassword($arg){
        $this->_auth_pwd = $arg;
    }
    public function setType($arg){
        $this->_auth_type = $arg;
    }
}
?>