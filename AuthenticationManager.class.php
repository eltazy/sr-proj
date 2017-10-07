<?php
////////////////script start
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
        $donnees = $quest->fetch(PDO::FETCH_ASSOC);
        return new Authentication($donnees['username'], $donnees['known_password']);
    }
    public function delete(Authentication $credentials){
        $quest = $this->_db->prepare("DELETE FROM user_pwd WHERE username = ?");
        $quest->execute(array($credentials->username()));
    }
    public function update(Authentication $credentials){
        //instructions for changing db data values
    }
    //methods for temporary database
    public function temp_add(Authentication $credentials, $uniqueid){
        $quest = $this->_db->prepare("INSERT INTO temp_user_pwd (username, known_password, uniqueid) VALUES (?, ?, ?)");
        $quest->execute(array($credentials->username(), $credentials->password(), $uniqueid));
    }
    public function temp_get($username, $uniqueid){
        $quest = $this->_db->prepare("SELECT * FROM temp_user_pwd WHERE username = ? AND uniqueid = ?");
        $quest->execute(array($username, $uniqueid));
        $donnees = $quest->fetch(PDO::FETCH_ASSOC);
        return new Authentication($donnees['username'], $donnees['known_password']);
    }
    public function temp_delete(Authentication $credentials, $uniqueid){
        $quest = $this->_db->prepare("DELETE FROM temp_user_pwd WHERE username = ? AND uniqueid = ?");
        $quest->execute(array($credentials->username(), $uniqueid));
    }
    //other methods
    public function credentialsExists($student_username){
        $quest = $this->_db->prepare("SELECT username FROM user_pwd WHERE username = ?");
        $quest->execute(array($student_username));
        if($quest->fetchColumns() == 0) return true;
        else return false;
    }

}

////////////////script end
?>