<?php
include_once 'Topic.class.php';

class TopicManager{
    private $_db;

    //constructor
    public function __construct($db){
        $this->setDB($db);
    }
    //setters
    public function setDB(PDO $temp_db){
        $this->_db = $temp_db;
    }
    //methods
    public function add(Topic $topic){
        $quest = $this->_db->prepare("INSERT INTO topics (topic, hits, projects) VALUES (?, 1, ?)");
        $quest->execute(array($topic->topic(), $topic->projects()));
    }
    public function get($topic){
        $quest = $this->_db->prepare("SELECT * FROM topics WHERE topic = ?");
        $quest->execute(array($topic));
        $donnees = $quest->fetch(PDO::FETCH_ASSOC);
        return new Topic($donnees['topic'], $donnees['hits'], explode(';', $donnees['projects']));
    }
    public static function incrementTopicHits(Topic $topic, PDO $db){
        $quest = $db->prepare("UPDATE topics SET hits += 1 WHERE topic = ?");
        $quest->execute(array($topic->topic()));
    }
}
?>