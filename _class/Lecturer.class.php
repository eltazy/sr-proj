<?php
include_once 'UserAbstraction.class.php';

class Lecturer extends UserAbstraction{
    private $_supervised_projects, //list of supervised projects id separated by ';'
            $_had_supervised;

    //constructor
    public function __construct(array $t_array){
        parent::__construct();
        $this->setType();
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
        $this->_type = UserType::LECTURER;
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