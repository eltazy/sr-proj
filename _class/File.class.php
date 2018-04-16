<?php
class File{
    private $_filename;
    private $_description;

    //constructor
    public function __construct($t_filename, $t_description){
        $this->setFilename($t_filename);
        $this->setDescription($t_description);
    }
    //getters
    public function filename(){
        return $this->_filename;
    }
    public function description(){
        return $this->_description;
    }
    //setters
    public function setFilename($arg){
        $this->_filename = $arg;
    }
    public function setDescription($arg){
        $this->_description = $arg;
    }
}
?>