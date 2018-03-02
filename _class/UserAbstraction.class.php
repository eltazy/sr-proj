<?php
abstract class UserAbstraction{
    protected $_firstname,
              $_middlename,
              $_lastname,
              $_gender,
              $_username,
              $_email,
              $_type,
              $_projects, //list of projects ID separated by ';'
              $_ideas, //list of ideas ID separated by ';'
              $_with_projects,
              $_with_ideas;
    //constructor and hydrate functions
    public function __construct(){
        $this->setHasideas(0);
        $this->setHasprojects(0);
    }
    public function __toString(){
        return  '<h1><a href="http://localhost/sr-proj/profile.php?user='.$this->username().'&type='.$this->type().'">'.$this->fullname().'</a></h1>
                <br>Gender: '.$this->gender().
                '<br>Username: @'.$this->username();
    }
    public function hydrate(array $response_data){
        foreach ($response_data as $key => $value){
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) $this->$method($value);
        }
    }
    //abstract methods
    abstract public function setType();
    //getters
    public function fullname(){
        return $this->_firstname.' '.substr($this->_middlename, 0, 1).'. '.$this->_lastname;
    }
    public function firstname(){
        return $this->_firstname;
    }
    public function middlename(){
        return $this->_middlename;
    }
    public function lastname(){
        return $this->_lastname;
    }
    public function gender(){
        return $this->_gender;
    }
    public function username(){
        return $this->_username;
    }
    public function email(){
        return $this->_email;
    }
    public function type(){
        return $this->_type;
    }
    public function projects(){
        return $this->_projects;
    }
    public function ideas(){
        return $this->_ideas;
    }
    public function with_projects(){
        return $this->_with_projects;
    }
    public function with_ideas(){
        return $this->_with_ideas;
    }
    //setters
    public function setFirstname($fname){
        $this->_firstname = strval($fname);
    }
    public function setMiddlename($mname){
        $this->_middlename = $mname;
    }
    public function setLastname($lname){
        $this->_lastname = $lname;
    }
    public function setGender($gen){
        $this->_gender = $gen;
    }
    public function setUsername($uname){
        $this->_username = $uname;
    }
    public function setEmail($email){
        $this->_email = $email;
    }
    public function setProjects($projects){
        if(!empty($projects)){
            $this->_projects = $projects;
            $this->setHasprojects(1);
        }
    }
    public function setIdeas($pideas){
        if(!empty($pideas)){
            $this->_ideas = $pideas;
            $this->setHasideas(1);
        }
    }
    public function setHasprojects($h_projs){
        $this->_with_projects = $h_projs;
    }
    public function setHasideas($h_ideas){
        $this->_with_ideas = $h_ideas;
    }
}//end of class
interface UserType{
    const STUDENT = 'Student';
    const LECTURER = 'Lecturer';
}
interface Gender{
    const MALE = 'male';
    const FEMALE = 'female';
}
?>