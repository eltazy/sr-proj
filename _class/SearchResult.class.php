<?php
class SearchResult{
    private $_heading;
    private $_count;
    private $_results;

    //constructor
    public function __construct(array $t_vec){
        $this->setResults($t_vec);
        $this->setHits(sizeof($t_vec));
    }
    //getters
    public function heading(){
        return $this->_heading;
    }
    public function hits(){
        return $this->_count;
    }
    public function results(){
        return $this->_results;
    }
    //setters
    public function setHeading($str){
        $this->_heading = $str;
    }
    public function setHits($c){
        $this->_count = $c;
    }
    public function setResults(array $vec){
        $this->_results = $vec;
    }
}
?>