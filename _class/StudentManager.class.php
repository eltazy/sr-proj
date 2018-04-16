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
        $response_data = $quest->fetch(PDO::FETCH_ASSOC);
        return new Student($response_data);
    }
    public function getPublicInfo($uname){
        $quest = $this->_db->prepare("SELECT * FROM students_tb WHERE username = ?");
        $quest->execute(array($uname));
        $response_data = $quest->fetch(PDO::FETCH_ASSOC);
        unset($response_data['schoolid'], $response_data['email']);
        return new Student($response_data);
    }
    public function get_from_email($email){
        $quest = $this->_db->prepare("SELECT * FROM students_tb WHERE email = ?");
        $quest->execute(array($email));
        $response_data = $quest->fetch(PDO::FETCH_ASSOC);
        if($response_data) return new Student($response_data);
        return null;
    }
    public static function delete($str, $db){
        $quest = $db->prepare("DELETE FROM students_tb WHERE username = ?");
        $quest->execute(array($str));
    }
    public function update($user, $post_update){
        $quest = $this->_db->prepare("  UPDATE students_tb SET
                                        firstname = ?,
                                        middlename = ?,
                                        lastname = ?,
                                        email = ? WHERE username = ?");
        $quest->execute(array($post_update['p_firstname'], $post_update['p_middlename'], $post_update['p_lastname'], $post_update['p_email'], $user));
    }
    //methods for temporary database
    public function temp_add(Student $student, $id){
        $quest = $this->_db->prepare("INSERT INTO temp_students_tb (firstname, middlename, lastname, gender, username, email, schoolid, major, hasideas, hasprojects, uniqueid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $arguments = array($student->firstname(), $student->middlename(), $student->lastname(), $student->gender(), $student->username(), $student->email(), $student->schoolid(), $student->major(), 0, 0, $id);
        $quest->execute($arguments);
    }
    public function temp_get($uname, $uniqueid){
        $quest = $this->_db->prepare("SELECT * FROM temp_students_tb WHERE username = ? AND uniqueid = ?");
        $quest->execute(array($uname, $uniqueid));
        $response_data = $quest->fetch(PDO::FETCH_ASSOC);
        return new Student($response_data);
    }
    public function temp_delete(Student $student, $uid){
        $quest = $this->_db->prepare("DELETE FROM temp_students_tb WHERE username = ? AND uniqueid = ?");
        $quest->execute(array($student->username(), $uid));
    }
    //other methods
    public function tempStudentExists($student_username, $uid){
        $quest = $this->_db->prepare("SELECT username FROM temp_students_tb WHERE username = ? AND uniqueid = ?");
        $quest->execute(array($student_username, $uid));
        if(!empty($quest->fetchAll())) return true;
        else return false;
    }
    public static function getFullname($student_username, PDO $db){
        $quest = $db->prepare("SELECT firstname, lastname FROM students_tb WHERE username = ?");
        $quest->execute(array($student_username));
        $result = $quest->fetch(PDO::FETCH_ASSOC);
        return $result['firstname'].' '.$result['lastname'];
    }
}
?>