<?php
////////////////script start
include_once 'IdeaAbstraction.class.php';

class Idea extends IdeaAbstraction{
    private $_developped_project_id;

    private static $_idea_count = 0;

    //constructor and/or hydration
    public function __construct(){
        self::$_idea_count++;
        $this->setUid(uniqid().rand(0,9));
    }
    public function hydrate(array $data){
        foreach ($data as $key => $value){
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) $this->$method($value);
        }
    }
    //getters
    //setters
    //other methods

}
////////////////script end
?>