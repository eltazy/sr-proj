<?php
class Search{
    private $_search_str;
    private $_search_user_options;
    private $_search_project_options;

    //constructor
    public function __construct($t_str, array $u_opt, array $p_opt){
        $this->setStr($t_str);
        $this->setUserOptions($u_opt);
        $this->setProjectOptions($p_opt);
    }
    //getters
    public function str(){
        return $this->_search_str;
    }
    public function userOptions(){
        return $this->_search_user_options;
    }
    public function projectOptions(){
        return $this->_search_project_options;
    }
    //setters
    public function setStr($arg){
        $this->_search_str = $arg;
    }
    public function setUserOptions(array $arg){
        $this->_search_user_options = array();
        foreach($arg as $option) array_push($this->_search_user_options, $option);
    }
    public function setProjectOptions(array $arg){
        $this->_search_project_options = array();
        foreach($arg as $option) array_push($this->_search_project_options, $option);
    }
}
?>