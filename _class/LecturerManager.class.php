<?php
include_once 'Lecturer.class.php';

class LecturerManager{
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
    public function add(Lecturer $lecturer){
        $quest = $this->_db->prepare("INSERT INTO lecturers_tb (firstname, middlename, lastname, gender, username, email, supervision, hasideas, hasprojects) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $arguments = array($lecturer->firstname(), $lecturer->middlename(), $lecturer->lastname(), $lecturer->gender(), $lecturer->username(), $lecturer->email(), $lecturer->supervision(), $lecturer->with_ideas(), $lecturer->with_projects());
        $quest->execute($arguments);
    }
    public function get($uname){
        $quest = $this->_db->prepare("SELECT * FROM lecturers_tb WHERE username = ?");
        $quest->execute(array($uname));
        $response_data = $quest->fetch(PDO::FETCH_ASSOC);
        return new Lecturer($response_data);
    }
    public function getPublicInfo($uname){
        $quest = $this->_db->prepare("SELECT * FROM lecturers_tb WHERE username = ?");
        $quest->execute(array($uname));
        $response_data = $quest->fetch(PDO::FETCH_ASSOC);
        unset($response_data['email']);
        return new Lecturer($response_data);
    }
    public function delete(Lecturer $lecturer){
        $quest = $this->_db->prepare("DELETE FROM lecturers_tb WHERE username = ?");
        $quest->execute(array($lecturer->username()));
    }
    public function update(Lecturer $lecturer){
        //instructions for changing db data values
    }
    //methods for temporary database
    public function temp_add(Lecturer $lecturer, $id){
        $quest = $this->_db->prepare("INSERT INTO temp_lecturers_tb (firstname, middlename, lastname, gender, username, email, schoolid, major, hasideas, hasprojects, uniqueid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $arguments = array($lecturer->firstname(), $lecturer->middlename(), $lecturer->lastname(), $lecturer->gender(), $lecturer->username(), $lecturer->email(), $lecturer->schoolid(), $lecturer->major(), $lecturer->with_ideas(), $lecturer->with_projects(), $id);
        $quest->execute($arguments);
    }
    public function temp_get($uname, $uniqueid){
        $quest = $this->_db->prepare("SELECT * FROM temp_lecturers_tb WHERE username = ? AND uniqueid = ?");
        $quest->execute(array($uname, $uniqueid));
        $response_data = $quest->fetch(PDO::FETCH_ASSOC);
        return new Lecturer($response_data);
    }
    public function temp_delete(Lecturer $lecturer, $uid){
        $quest = $this->_db->prepare("DELETE FROM temp_lecturers_tb WHERE username = ? AND uniqueid = ?");
        $quest->execute(array($lecturer->username(), $uid));
    }
    //other methods
    public static function lecturerExists($lecturer_username, PDO $db){
        $quest = $db->prepare("SELECT username FROM lecturers_tb WHERE username = ?");
        $quest->execute(array($lecturer_username));
        if(!empty($quest->fetchAll())) return true;
        else return false;
    }
    public static function getFullname($lecturer_username, PDO $db){
        $quest = $db->prepare("SELECT firstname, lastname FROM lecturers_tb WHERE username = ?");
        $quest->execute(array($lecturer_username));
        $result = $quest->fetch(PDO::FETCH_ASSOC);
        return $result['firstname'].' '.$result['lastname'];
    }
}
?>