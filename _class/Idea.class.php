<?php
////////////////script start
include_once 'IdeaAbstraction.class.php';

class Idea extends IdeaAbstraction{
    private $_developped_project_id;

    //constructor and/or hydration
    public function __construct(array $t_array){
        $this->setType();
        $this->setState(State::_IDEA_NOT_DEVELOPPED);
        $this->hydrate($t_array);
    }
    //getters
    public function developpedProjectID(){
    	return $this->_developped_project_id;
    }
    //setters
    public function setType(){
    	$this->_type = Type::_IDEA;
    }
    public function setDeveloppedProjectID($project_id){
        $this->_developped_project_id = $project_id;
        $this->setState(State::_IDEA_DEVELOPPED);
    }
    //other methods

}
////////////////script end
?>