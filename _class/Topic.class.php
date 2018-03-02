<?php
class Topic{
    private $_topic_str;
    private $_topic_hits;
    private $_topic_projects;

    //constructor
    public function hydrate(array $response_data){
        foreach ($response_data as $key => $value){
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) $this->$method($value);
        }
    }
    public function __construct(array $t_topic){
        $this->hydrate($t_topic);
    }
    public function __toString(){
        $link = 'http://localhost/sr-proj/topic.php?title='.$this->topic();
        return  '<a href="'.$link.'">'.ucfirst($this->topic()).'</a>('.$this->hits().')';
    }
    //getters
    public function topic(){
        return $this->_topic_str;
    }
    public function hits(){
        return $this->_topic_hits;
    }
    public function projects(){
        return $this->_topic_projects;
    }
    //setters
    public function setTopic($arg){
        $this->_topic_str = $arg;
    }
    public function setHits($arg){
        $this->_topic_hits = $arg;
    }
    public function setProjects($arg){
        $this->_topic_projects = $arg;
    }
}
?>