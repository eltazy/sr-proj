<?php
include_once 'File.class.php';

class FileManager{
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
    public function add(File $file){
        $quest = $this->_db->prepare("INSERT INTO files (description, filename, size, type) VALUES (?, ?, ?, ?)");
        $quest->execute(array($file->description(), $file->filename(), $file->size(), $file->type()));
    }
    public static function getFiles($proj_id, $db){
        $quest = $db->prepare("SELECT * FROM files WHERE filename REGEXP '$proj_id'");
        $quest->execute();
        return $quest->fetchAll();
    }
    public function delete($filename){
        $quest = $this->_db->prepare("DELETE FROM files WHERE filename = ?");
        $quest->execute(array($filename));
    }
}
?>