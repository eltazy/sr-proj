<?php
class Topic{
    private $_topic_str;
    private $_topic_hits;
    private $_topic_projects;

    //constructor
    public function __construct($t_str, $t_hits, array $t_proj){
        $this->setStr($t_str);
        $this->setHits($t_hits);
        $this->setProjects($t_proj);
    }
    //getters
    public function str(){
        return $this->_topic_str;
    }
    public function hits(){
        return $this->_topic_hits;
    }
    public function projects(){
        return $this->_topic_projects;
    }
    //setters
    public function setStr($arg){
        $this->_topic_str = $arg;
    }
    public function setHits($arg){
        $this->_topic_hits = $arg;
    }
    public function setProjects(array $arg){
        $this->_topic_projects = $arg;
    }
}
?>