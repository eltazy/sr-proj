<?php
include_once 'Search.class.php';

class SearchManager{
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
    public function searchStudents(Search $search){
        $quest = $this->_db->prepare("SELECT * FROM students_tb WHERE username LIKE %?%");
        $quest->execute(array($search->str()));
        return $quest->fetch(PDO::FETCH_ASSOC);
    }
}
?>