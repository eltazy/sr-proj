<?php
include_once 'Search.class.php';
include_once 'Collection.class.php';

class SearchManager{
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
            array_push($results, $res_lecturers);
        }
        $res_students = new Collection(new SearchResult(array()), 'Student');
        if(in_array('Students', $search->userOptions())){
            $res_students = $this->searchStudents($search->str());
            array_push($results, $res_students);
        }
        return $results;
    }
    public function searchWorks(Search $search){
        $results = array();

        $res_ideas = new Collection(new SearchResult(array()), 'Idea');
        if(in_array('Idea', $search->projectOptions())){
            $res_ideas = $this->searchIdeas($search->str());
            array_push($results, $res_ideas);
        }
        $res_projects = new Collection(new SearchResult(array()), 'Project');
        if(in_array('Project', $search->projectOptions())){
            $res_projects = $this->searchProjects($search->str());
            array_push($results, $res_projects);
        }
        $res_srproj = new Collection(new SearchResult(array()), 'SeniorProject');
        if(in_array('Senior Project', $search->projectOptions())){
            $res_srproj = $this->searchSeniorProjects($search->str());
            array_push($results, $res_srproj);
        }
        $res_research = new Collection(new SearchResult(array()), 'Research');
        if(in_array('Research', $search->projectOptions())){
            $res_research = $this->searchResearches($search->str());
            array_push($results, $res_research);
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
                                                WHERE firstname REGEXP '$str' 
                                                OR middlename REGEXP '$str' 
                                                OR lastname REGEXP '$str' 
                                                OR username REGEXP '$str'");
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