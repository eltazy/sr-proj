<?php
include_once 'Authentication.class.php';

class AuthenticationManager{
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
    public function add(Authentication $credentials){
        $quest = $this->_db->prepare("INSERT INTO user_pwd (username, known_password) VALUES (?, ?)");
        $quest->execute(array($credentials->username(), $credentials->password()));
    }
    public function get($username){
        $quest = $this->_db->prepare("SELECT * FROM user_pwd WHERE username = ?");
        $quest->execute(array($username));
        $response_data = $quest->fetch(PDO::FETCH_ASSOC);
        return new Authentication($response_data['username'], $response_data['known_password']);
    }
    public function delete(Authentication $credentials){
        $quest = $this->_db->prepare("DELETE FROM user_pwd WHERE username = ?");
        $quest->execute(array($credentials->username()));
    }
    public function updatePassword(Authentication $credentials, $new_pwd){
        $quest = $this->_db->prepare("UPDATE user_pwd SET known_password = ? WHERE username = ?");
        $quest->execute(array($new_pwd, $credentials->username()));
    }
    //methods for temporary database
    public function temp_add(Authentication $credentials, $uid){
        $quest = $this->_db->prepare("INSERT INTO temp_user_pwd (username, known_password, uniqueid) VALUES (?, ?, ?)");
        $quest->execute(array($credentials->username(), $credentials->password(), $uid));
    }
    public function temp_get($username, $uid){
        $quest = $this->_db->prepare("SELECT * FROM temp_user_pwd WHERE username = ? AND uniqueid = ?");
        $quest->execute(array($username, $uid));
        $response_data = $quest->fetch(PDO::FETCH_ASSOC);
        return new Authentication($response_data['username'], $response_data['known_password']);
    }
    public function temp_delete(Authentication $credentials, $uid){
        $quest = $this->_db->prepare("DELETE FROM temp_user_pwd WHERE username = ? AND uniqueid = ?");
        $quest->execute(array($credentials->username(), $uid));
    }
    //other methods
    public function tempCredentialsExists($student_username, $uid){
        $quest = $this->_db->prepare("SELECT username FROM temp_user_pwd WHERE username = ? AND uniqueid = ?");
        $quest->execute(array($student_username, $uid));
        if(!empty($quest->fetchAll())) return true;
        else return false;
    }

}
?>