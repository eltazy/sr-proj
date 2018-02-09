<?php
class Search{
    private $_search_str;
    private $_search_options;

    //constructor
    public function __construct($t_str, array $t_opt){
        $this->setStr($t_str);
        $this->setOptions($t_opt);
    }
    //getters
    public function str(){
        return $this->_search_str;
    }
    public function options(){
        return $this->_search_options;
    }
    //setters
    public function setStr($arg){
        $this->_search_str = $arg;
    }
    public function setOptions(array $arg){
        $this->_search_options = $arg;
    }
}
?>