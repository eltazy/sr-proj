<?php
include_once 'SearchResult.class.php';

include_once 'Idea.class.php';
include_once 'Project.class.php';
include_once 'SeniorProject.class.php';
include_once 'Research.class.php';

include_once 'Lecturer.class.php';
include_once 'Student.class.php';

class Collection extends SearchResult{
    //constructor
    public function __construct(SearchResult $temp, $ObjectType){
        parent::setHeading($temp->heading());
        parent::setHits($temp->hits());
        $vec = array();
        foreach ($temp->results() as $key => $entry) {
            $new_obj = new $ObjectType($entry);
            array_push($vec, $new_obj);
        }
        parent::setResults($vec);
    }
    // other methods
    // public static function add(Collection $a, Collection $b){
    //     return new Collection(array_merge($a->results(), $b->results()));
    // }
}
?>