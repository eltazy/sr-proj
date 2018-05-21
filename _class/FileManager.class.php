<?php
include_once 'File.class.php';
include_once 'ManagerAbstraction.class.php';

class FileManager extends ManagerAbstraction{
    // private $_db;

    //constructor
    public function __construct(){
        parent::__construct();
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