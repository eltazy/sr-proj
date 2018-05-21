<?php
include_once 'Topic.class.php';
include_once 'ManagerAbstraction.class.php';

class TopicManager extends ManagerAbstraction{
    // private $_db;

    //constructor
    public function __construct(){
        parent::__construct();
    }
    //methods
    public static function addNew($topic, $first_project_uid, $db){
        $quest = $db->prepare("INSERT INTO topics (topic, hits, projects) VALUES (?, 1, ?)");
        $quest->execute(array($topic, $first_project_uid.';'));
    }
    public function get($topic){
        $quest = $this->_db->prepare("SELECT * FROM topics WHERE topic = ?");
        $quest->execute(array($topic));
        $response_data = $quest->fetch(PDO::FETCH_ASSOC);
        return new Topic($response_data);
    }
    public static function getTopics($db){
        $quest = $db->prepare("SELECT * FROM topics");
        $quest->execute();
        return $quest->fetchAll();
    }
    public static function searchTopics($str, $db){
        $quest = $db->prepare("SELECT topic, hits FROM topics WHERE topic REGEXP '$str'");
        $quest->execute();
        return $quest->fetchAll();
    }
    public static function getPopularTopics($db){
        $quest = $db->prepare("SELECT * FROM topics ORDER BY hits DESC LIMIT 10");
        $quest->execute();
        return $quest->fetchAll();
    }
    public static function addProject($topic, $new_project, $db){
        $quest = $db->prepare("UPDATE topics SET projects = CONCAT(projects, ';', ?) WHERE topic = ?");
        $quest->execute(array($new_project, $topic));
        $quest = $db->prepare("UPDATE topics SET hits = hits+1 WHERE topic = ?");
        $quest->execute(array($topic));
    }
    public static function topicExists($topic, PDO $db){
        $quest = $db->prepare("SELECT topic FROM topics WHERE topic = ?");
        $quest->execute(array($topic));
        if(!empty($quest->fetchAll())) return true;
        else return false;
    }
}
?>