<?php
////////////////script start
include_once 'Project.class.php';

class SeniorProject extends Project{
    private $_supervisor;

    //constructor and/or hydration
    public function __construct(array $t_array){
        $this->setType();
        $this->setState(State::_PROJECT_STARTED);
        $this->hydrate($t_array);
    }
    //getters
    public function supervisor(){
    	return $this->_supervisor;
    }
    //setters
    public function setSupervisor($sup){
    	$this->_supervisor = $sup;
    }
    public function setType(){
    	$this->_type = Type::_SENIOR_PROJECT;
    }
}
////////////////script end
?>