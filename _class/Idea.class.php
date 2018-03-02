<?php
include_once 'IdeaAbstraction.class.php';

class Idea extends IdeaAbstraction  implements IdeaState, Type{
    private $_developped_project_id;

    //constructor and/or hydration
    public function __construct(array $t_array){
        $this->setType();
        $this->setState(IdeaState::_IDEA_NOT_DEVELOPPED);
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
        $this->setState(IdeaState::_IDEA_DEVELOPPED);
    }
    //other methods
    public static function getStates(){
        return array("Developped", "Not Developped");
    }
}
?>