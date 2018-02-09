<?php
include_once 'UserAbstraction.class.php';

class Student extends UserAbstraction{
    private $_schoolid,
            $_major;
            
    //constructor and hydrator
    public function __construct(array $t_array){
        parent::__construct();
        $this->setType();
        $this->hydrate($t_array);
    }
    //getters
    public function schoolid(){
        return $this->_schoolid;
    }
    public function major(){
        return $this->_major;
    }
    //setters
    public function setType(){
        $this->_type = Type::STUDENT;
    }
    public function setSchoolid($sID){
        $this->_schoolid = $sID;
    }
    public function setMajor($maj){
        $this->_major = $maj;
    }
    //other methods
    public function addCount(){
        self::$_student_count++;
    }
}//end of class
interface Major{
    const SWEN = "Software Engineering";
    const NETW = "Networking";
    const BBIT = "Business Information Technology";
}
?>