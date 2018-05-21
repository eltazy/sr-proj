<?php
include_once 'Search.class.php';
include_once 'Collection.class.php';
include_once 'ManagerAbstraction.class.php';

class SearchManager extends ManagerAbstraction{
    // private $_db;

    //constructor
    public function __construct(){
        parent::__construct();
    }
    //methods
    public function search(Search $search){
        $uresults = $this->searchUsers($search);
        $wresults = $this->searchWorks($search);
        return array_merge($uresults, $wresults);
    }
    public function searchUsers(Search $search){
        $results = array();
        
        $res_lecturers = new Collection(new SearchResult(array()), 'Lecturer');
        if(in_array('Lecturers', $search->userOptions())){
            $res_lecturers = $this->searchLecturers($search->str());
            if($res_lecturers->hits()) array_push($results, $res_lecturers);
        }
        $res_students = new Collection(new SearchResult(array()), 'Student');
        if(in_array('Students', $search->userOptions())){
            $res_students = $this->searchStudents($search->str());
            if($res_students->hits()) array_push($results, $res_students);
        }
        return $results;
    }
    public function searchWorks(Search $search){
        $results = array();

        $temp_results = new Collection(new SearchResult(array()), 'Idea');
        if(in_array('Idea', $search->projectOptions())){
            $temp_results = $this->searchIdeas($search->str());
            if($temp_results->hits()) array_push($results, $temp_results);
        }
        $temp_results = new Collection(new SearchResult(array()), 'Project');
        if(in_array('Project', $search->projectOptions())){
            $temp_results = $this->searchProjects($search->str());
            if($temp_results->hits()) array_push($results, $temp_results);
        }
        $temp_results = new Collection(new SearchResult(array()), 'SeniorProject');
        if(in_array('Senior Project', $search->projectOptions())){
            $temp_results = $this->searchSeniorProjects($search->str());
            if($temp_results->hits()) array_push($results, $temp_results);
        }
        $temp_results = new Collection(new SearchResult(array()), 'Research');
        if(in_array('Research', $search->projectOptions())){
            $temp_results = $this->searchResearches($search->str());
            if($temp_results->hits()) array_push($results, $temp_results);
        }
        return $results;
    }
    //submethods
    public function searchStudents($str){
        $quest = $this->_db->prepare(" SELECT * FROM students_tb 
                                                WHERE firstname REGEXP '$str' 
                                                OR middlename REGEXP '$str' 
                                                OR lastname REGEXP '$str' 
                                                OR username REGEXP '$str'");
        $quest->execute();
        $rep = new SearchResult($quest->fetchAll());
        $s = $rep->hits() == 1 ? 'Student' : 'Students';
        $rep->setHeading($s.'('.$rep->hits().')');
        return new Collection($rep, 'Student');
    }
    public function searchLecturers($str){
        $quest = $this->_db->prepare(" SELECT * FROM lecturers_tb
                                                WHERE (firstname REGEXP '$str' 
                                                OR middlename REGEXP '$str' 
                                                OR lastname REGEXP '$str' 
                                                OR username REGEXP '$str') 
                                                AND NOT username = 'Admin'");
        $quest->execute();
        $rep = new SearchResult($quest->fetchAll());
        $s = $rep->hits() == 1 ? 'Lecturer' : 'Lecturers';
        $rep->setHeading($s.'('.$rep->hits().')');
        return new Collection($rep, 'Lecturer');
    }
    public function searchIdeas($str){
        $quest = $this->_db->prepare(" SELECT * FROM abs_ideas_tb
                                                WHERE type = 'Idea' 
                                                AND (title REGEXP '$str' 
                                                OR description REGEXP '$str' 
                                                OR keywords REGEXP '$str')");
        $quest->execute();
        $rep = new SearchResult($quest->fetchAll());
        $s = $rep->hits() == 1 ? 'Idea' : 'Ideas';
        $rep->setHeading($s.'('.$rep->hits().')');
        return new Collection($rep, 'Idea');
    }
    public function searchResearches($str){
        $quest = $this->_db->prepare(" SELECT * FROM abs_ideas_tb
                                                WHERE type = 'Research' 
                                                AND (title REGEXP '$str' 
                                                OR description REGEXP '$str' 
                                                OR keywords REGEXP '$str')");
        $quest->execute();
        $rep = new SearchResult($quest->fetchAll());
        $s = $rep->hits() == 1 ? 'Research' : 'Researches';
        $rep->setHeading($s.'('.$rep->hits().')');
        return new Collection($rep, 'Research');
    }
    public function searchSeniorProjects($str){
        $quest = $this->_db->prepare(" SELECT * FROM abs_ideas_tb
                                                WHERE type = 'Senior Project' 
                                                AND (title REGEXP '$str' 
                                                OR description REGEXP '$str' 
                                                OR keywords REGEXP '$str')");
        $quest->execute();
        $rep = new SearchResult($quest->fetchAll());
        $s = $rep->hits() == 1 ? 'Senior Project' : 'Senior Projects';
        $rep->setHeading($s.'('.$rep->hits().')');
        return new Collection($rep, 'SeniorProject');
    }
    public function searchProjects($str){
        $quest = $this->_db->prepare(" SELECT * FROM abs_ideas_tb
                                                WHERE type = 'Project' 
                                                AND (title REGEXP '$str' 
                                                OR description REGEXP '$str' 
                                                OR keywords REGEXP '$str')");
        $quest->execute();
        $rep = new SearchResult($quest->fetchAll());
        $s = $rep->hits() == 1 ? 'Project' : 'Projects';
        $rep->setHeading($s.'('.$rep->hits().')');
        return new Collection($rep, 'Project');
    }
}
?>