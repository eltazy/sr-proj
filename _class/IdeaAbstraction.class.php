<?php
abstract class IdeaAbstraction{
    protected $_uid,
              $_title,
              $_state,
              $_type,
              $_description,
              $_authors,	//string of authors usernames separated by ';'
              $_keywords;	//string of keywords separated by ';'
    //getters
    public function uid(){
    	return $this->_uid;
    }
    public function title(){
    	return $this->_title;
    }
    public function state(){
    	return $this->_state;
    }
    public function type(){
    	return $this->_type;
    }
    public function description(){
    	return $this->_description;
    }
    public function authors(){
    	return $this->_authors;
    }
    public function keywords(){
    	return $this->_keywords;
    }
    //setters
    public function setUid(string $t_uid){
    	$this->_uid = $t_uid;
    }
    public function setTitle(string $t_title){
    	$this->_title = $t_title;
    }
    public function setState(State $t_state){
    	$this->_state = $t_state;
    }
    public function setType(Type $t_type){
    	$this->_type = $t_type;
    }
    public function setDescription(string $t_description){
    	$this->_description = $t_description;
    }
    public function setAuthors(array $t_author){
    	$this->_authors = $t_author;
    }
    public function setKeywords(array $t_keywords){
    	$this->_keywords = $t_keywords;
    }
    //methods    
}
interface State{
    const _PROJECT_STARTED = 0;
    const _PROJECT_ONGOING = 1;
    const _PROJECT_SUSPENDED = 2;
    const _PROJECT_ABANDONNED = 3;
    const _PROJECT_FINISHED = 4;

    const _IDEA_DEVELOPPED = 5;
    const _IDEA_NOT_DEVELOPPED = 6;
}
interface Type{
    const IDEA = 0;
    const PROJECT = 1;
    const SENIOR_PROJECT = 2;
    const RESEARCH = 3;
}
?>