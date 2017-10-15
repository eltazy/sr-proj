<?php
////////////////script start
include_once 'IdeaAbstraction.class.php';

class Idea extends IdeaAbstraction{
    private $_developped,
            $_developped_project_id;

    //constructor and/or hydration
    public function __construct(){
        $this->setDevelopped(false);
        $this->setUid(uniqid().rand(0,9));
    }
    public function hydrate(array $data){
        foreach ($data as $key => $value){
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) $this->$method($value);
        }
    }
    //getters
    public function developped(){
    	return $this->_developped;
    }
    public function developpedProjectID(){
    	return $this->_developped_project_id;
    }
    //setters
    public function setDevelopped(boolean $t_developped){
    	$this->_developped = $t_developped;
    }
    public function setDeveloppedProjectID($t_proj_id){
        if(!empty($t_proj_id)){
            $this->setDevelopped(true);
            $this->_developped_project_id = $t_proj_id;
        }
    }
    //other methods

}
////////////////script end
?>