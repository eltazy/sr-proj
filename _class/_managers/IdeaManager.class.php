<?php
////////////////script start
include_once 'Idea.class.php';

class IdeaManager{
    private PDO $_db;

    //constructor
    public function __construct($db){
    	$this->setDB($db);
    }
    //setters
    public function setDB(PDO $temp_db){
    	$this->_db = $temp_db;
    }
    //methods
    public function add(Idea $idea){
    	$query = $this->_db->prepare("INSERT INTO ideas_tb (idea_uid, idea_title, idea_content, idea_state) VALUES (?, ?, ?, ?)");
    	$arguments = array($idea->uid(), $idea->title(), $idea->content(), $idea->state());
    	$query->execute($arguments);
    }
    public function delete(Idea $idea){
    }
    public function get($id){
    }
    public function getList(){
    }
    public function update(Idea $idea){
    }

}

////////////////script end
?>