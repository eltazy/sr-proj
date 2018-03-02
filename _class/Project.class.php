<?php
include_once 'IdeaAbstraction.class.php';

class Project extends IdeaAbstraction implements ProjectState, Type{
    protected $_original_idea;
        
    //constructor and/or hydration
    public function __construct(array $t_array){
        $this->setType();
        $this->setState(ProjectState::_PROJECT_STARTED);
        $this->hydrate($t_array);
    }
    //getters
    public function originalIdea(){
    	return $this->_original_idea;
    }
    //setters
    public function setType(){
    	$this->_type = Type::_PROJECT;
    }
    public function setOriginalIdea($origin){
        $this->_original_idea =$origin;
    }
    //other methods
    public static function getStates(){
        return array("Started", "Ongoing", "Suspended", "Dropped", "Finished");
    }
}
?>