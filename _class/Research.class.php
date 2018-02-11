<?php
include_once 'IdeaAbstraction.class.php';

class Research extends IdeaAbstraction{
    private $_project;
    
    //constructor and/or hydration
    public function __construct(array $t_array){
        $this->setType();
        $this->setState(State::_RESEARCH_STARTED);
        $this->hydrate($t_array);
    }
    //getters
    public function resultProject(){
    	return $this->_project;
    }
    //setters
    public function setType(){
    	$this->_type = Type::_RESEARCH;
    }
    public function setResultProject($proj_id){
    	$this->_project = $proj_id;
    }
}
?>