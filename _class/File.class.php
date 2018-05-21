<?php
class File{
    private $_filename;
    // private $_description;
    private $_type;
    private $_size;

    //constructor
    public function __construct($t_filename, $t_description, $t_size, $t_type){
        $this->setFilename($t_filename);
        $this->setDescription($t_description);
        $this->setType($t_type);
        $this->setSize($t_size);
    }
    //getters
    public function filename(){
        return $this->_filename;
    }
    public function type(){
        return $this->_type;
    }
    public function size(){
        return $this->_size;
    }
    public function description(){
        return $this->_description;
    }
    public static function getFileType($str){
        switch ($str) {
            case 'pdf': return 'PDF'; break;
            case 'csv': case 'xls': case 'xlsx': return 'Excel'; break;
            case 'doc': case 'docx': return 'Word'; break;
            case 'ppt': case 'pptx': return 'PowerPoint'; break;            
            default: return 'file'; break;
        }
    }
    public static function getFileIcon($str){
        switch ($str) {
            case 'PDF':             return '<i alt="'.$str.'" class="fas fa-file-pdf"></i>'; break;
            case 'Excel':           return '<i alt="'.$str.'" class="fas fa-file-excel"></i>'; break;
            case 'Word':            return '<i alt="'.$str.'" class="fas fa-file-word"></i>'; break;
            case 'PowerPoint':      return '<i alt="'.$str.'" class="fas fa-file-powerpoint"></i>'; break;            
            default:                return '<i alt="'.$str.'" class="fas fa-file"></i>';
        }
    }
    //setters
    public function setFilename($arg){
        $this->_filename = $arg;
    }
    public function setDescription($arg){
        $this->_description = $arg;
    }
    public function setType($arg){
        $this->_type = $arg;
    }
    public function setSize($arg){
        $this->_size = $arg;
    }
}
?>