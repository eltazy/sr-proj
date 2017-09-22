<?php
include_once 'UserAbstraction.class.php';

class Lecturer extends UserAbstraction{
    private $_supervised_projects, //array of supervised projects id
            $_had_supervised;

    private static $_lecturer_count = 0;
    //constructor
    public function __construct(array $t_array){
        parent::__construct();
        $this->hydrate($t_array);
    }
    //getters
    public function supervision(){
        return $this->_had_supervised;
    }
    public function supervisedProjects(){
        return $this->_supervised_projects;
    }
    //setters
    public function setType(){
        $this->_type = Type::LECTURER;
    }
    public function setSupervision($sup){
        $this->_had_supervised = $sup;
    }
    public function setSupervisedProjects(array $sup){
        if(!empty($sup)){
            $this->_supervised_projects = $sup;
            $this->setSupervision(true);
        }
    }
    //other methods
    public function addCount(){
        self::$_lecturer_count++;
    } 
}//end of class
?>