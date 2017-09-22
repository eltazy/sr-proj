<?php
include_once 'Student.class.php';

class StudentManager{
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
    public function add(Student $student){
        $quest = $this->_db->prepare("INSERT INTO students_tb (firstname, middlename, lastname, gender, username, email, schoolid, major, hasideas, hasprojects) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $arguments = array($student->firstname(), $student->middlename(), $student->lastname(), $student->gender(), $student->username(), $student->email(), $student->schoolid(), $student->major(), $student->with_ideas(), $student->with_projects());
        $quest->execute($arguments);
    }
    public function get($uname){
        $quest = $this->_db->prepare("SELECT * FROM students_tb WHERE username = ?");
        $quest->execute(array($uname));
        $donnees = $quest->fetch(PDO::FETCH_ASSOC);
        return new Student($donnees);
    }
    public function delete(Student $student){
        $quest = $this->_db->prepare("DELETE FROM students_tb WHERE username = ?");
        $quest->execute(array($student->username()));
    }
    public function update(Student $student){
        //instructions for changing db data values
    }
    //methods for temporary database
    public function temp_add(Student $student, $id){
        $quest = $this->_db->prepare("INSERT INTO temp_students_tb (firstname, middlename, lastname, gender, username, email, schoolid, major, hasideas, hasprojects, uniqueid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $arguments = array($student->firstname(), $student->middlename(), $student->lastname(), $student->gender(), $student->username(), $student->email(), $student->schoolid(), $student->major(), $student->with_ideas(), $student->with_projects(), $id);
        $quest->execute($arguments);
    }
    public function temp_get($uname, $uniqueid){
        $quest = $this->_db->prepare("SELECT * FROM temp_students_tb WHERE username = ? AND uniqueid = ?");
        $quest->execute(array($uname, $uniqueid));
        $donnees = $quest->fetch(PDO::FETCH_ASSOC);
        return new Student($donnees);
    }
    public function temp_delete(Student $student, $uid){
        $quest = $this->_db->prepare("DELETE FROM temp_students_tb WHERE username = ? AND uniqueid = ?");
        $quest->execute(array($student->username(), $uid));
    }
    //other methods
    public function studentExists($student_username){
        $quest = $this->_db->prepare("SELECT username FROM students_tb WHERE username = ?");
        $quest->execute(array($student_username));
        $nrow = $quest->fetch(PDO::FETCH_ASSOC);
        return (bool)$nrow;
    }
}
////////////////script end
?>