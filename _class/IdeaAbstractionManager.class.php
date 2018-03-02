<?php
include_once 'Idea.class.php';
include_once 'Project.class.php';
include_once 'SeniorProject.class.php';
include_once 'Research.class.php';

include_once 'TopicManager.class.php';

class IdeaAbstractionManager{
    private $_db;

    // constructor
    public function __construct($db){
    	$this->setDB($db);
    }
    // setters
    public function setDB(PDO $temp_db){
    	$this->_db = $temp_db;
    }
    // getters
    public function db(){
    	return $this->_db;
    }
//methods
    //add methods
    public function add($idea){
        $last_arg_name = '';
        $last_arg_value = '';
        switch ($idea->type()) {
            case Type::_IDEA:
                $last_arg_name = "developpedProjectID";
                $last_arg_value = $idea->developpedProjectID();
                break;            
            case Type::_PROJECT:
                $last_arg_name = "originalIdea";
                $last_arg_value = $idea->originalIdea();
                break;
            case Type::_SENIOR_PROJECT:                
                $last_arg_name = "supervisor";
                $last_arg_value = $idea->supervisor();
                break;
            case Type::_RESEARCH:
                $last_arg_name = "resultProject";
                $last_arg_value = $idea->resultProject();
                break;
        }
        $query = $this->_db->prepare("INSERT INTO abs_ideas_tb (uid, title, state, type, description, coauthors, postedby, links, docs, keywords, creationdate, $last_arg_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, DATE_FORMAT(CURDATE(), '%D %M %Y'), ?)");
        $arguments = array($idea->uid(), $idea->title(), $idea->state(), $idea->type(), $idea->description(), $idea->coauthors(), $idea->postedby(), $idea->links(), $idea->docs(), $idea->keywords(), $last_arg_value);
    	$query->execute($arguments);
        // COMPLETED: add new keywods to db or increment their hits
        $topics = explode(';', $idea->keywords());
        foreach ($topics as $topic) {
            if(TopicManager::topicExists($topic, $this->db()))
                TopicManager::addProject($topic, $idea->uid(), $this->db());
            else TopicManager::addNew($topic, $idea->uid(), $this->db());
        }
    }
    //delete methods
    public function delete($uid){
        $quest = $this->_db->prepare("DELETE FROM abs_ideas_tb WHERE uid = ?");
        $quest->execute(array($uid->uid()));
    }
    //get methods
    public function get($uid){
        $quest = $this->_db->prepare("SELECT * FROM abs_ideas_tb WHERE uid = ?");
        $quest->execute(array($uid));
        $response_data = $quest->fetch(PDO::FETCH_ASSOC);
        $Constructor = '';
        switch ($response_data['type']) {
            case Type::_IDEA: $Constructor = 'Idea'; break;
            case Type::_PROJECT: $Constructor = 'Project'; break;
            case Type::_SENIOR_PROJECT: $Constructor = 'SeniorProject'; break;
            case Type::_RESEARCH: $Constructor = 'Research'; break;
        }
        return new $Constructor($response_data);
    }
    public static function getLatestProjects($db){
        $quest = $db->prepare("SELECT * FROM abs_ideas_tb ORDER BY id DESC LIMIT 15");
        $quest->execute();
        return $quest->fetchAll();
    }
    //exist methods
    public static function uidExists($uid, $_db){
        $quest = $_db->prepare("SELECT uid FROM abs_ideas_tb WHERE uid = ?");
        $quest->execute(array($uid));
        if(!empty($quest->fetchAll())) return true;
        else return false;
    }
}
?>