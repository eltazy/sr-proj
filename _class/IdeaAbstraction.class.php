<?php
abstract class IdeaAbstraction{
    protected $_uid,
              $_title,
              $_state,
              $_type,
              $_description,
              $_creation_date,
              $_co_authors,	//string of co-authors usernames separated by ';'
              $_postedby,
              $_docs,
              $_links,
              $_keywords;	//string of keywords separated by ';'
    //toString and hydrate functions
    public function __toString(){
        $link = 'http://localhost/sr-proj/project.php?uid='.$this->uid();
        $description_100_chars = strlen($this->description())>100 ? substr($this->description(), 0, 100) : $this->description();
        return  '<h1><a href="'.$link.'">'.$this->title().'</a></h1>
                <br><p>'.$description_100_chars.'...<a href="'.$link.'"><b><u>more</u></b></a></p>
                <br><p>'.$this->keywords().'</p>';
    }
    public function hydrate(array $data){
        foreach ($data as $key => $value){
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) $this->$method($value);
        }
    }
    //abstract methods
    abstract public function setType();
    //getters
    public function uid(){
    	return $this->_uid;
    }
    public function title(){
    	return $this->_title;
    }
    public function state(){
    	return $this->_state;
    }
    public function type(){
    	return $this->_type;
    }
    public function description(){
    	return $this->_description;
    }
    public function creationdate(){
    	return $this->_creation_date;;
    }
    public function coauthors(){
    	return $this->_co_authors;
    }
    public function postedby(){
    	return $this->_postedby;
    }
    public function docs(){
    	return $this->_docs;
    }
    public function links(){
    	return $this->_links;
    }
    public function keywords(){
    	return $this->_keywords;
    }
    //setters
    public function setUid(string $t_uid){
    	$this->_uid = $t_uid;
    }
    public function setTitle(string $t_title){
    	$this->_title = $t_title;
    }
    public function setState(string $t_state){
    	$this->_state = $t_state;
    }
    public function setDescription(string $t_description){
    	$this->_description = $t_description;
    }
    public function setCreationdate($t_date){
    	$this->_creation_date = $t_date;
    }
    public function setCoauthors(string $t_author){
    	$this->_co_authors = $t_author;
    }
    public function setPostedby(string $t_author){
    	$this->_postedby = $t_author;
    }
    public function setDocs(string $t_docs){
    	$this->_docs = $t_docs;
    }
    public function setLinks(string $t_links){
    	$this->_links = $t_links;
    }
    public function setKeywords(string $t_keywords){
    	$this->_keywords = $t_keywords;
    }
    //methods
}
interface State{
    const _PROJECT_STARTED =  "Started";
    const _PROJECT_ONGOING =  "Ongoing";
    const _PROJECT_SUSPENDED =  "Suspended";
    const _PROJECT_DROPPED =  "Dropped";
    const _PROJECT_FINISHED =  "Finished";
    
    const _SENIOR_PROJECT_APPROVED = "Approved";
    const _SENIOR_PROJECT_REJECTED = "Rejected";

    const _RESEARCH_STARTED =  "Started";
    const _RESEARCH_ONGOING =  "Ongoing";
    const _RESEARCH_SUSPENDED =  "Suspended";
    const _RESEARCH_DROPPED =  "Dropped";
    const _RESEARCH_FINISHED =  "Finished";

    const _IDEA_DEVELOPPED =  "Developped";
    const _IDEA_NOT_DEVELOPPED =  "Not Developped";
}
interface Type{
    const _IDEA = "Idea";
    const _PROJECT = "Project";
    const _SENIOR_PROJECT = "Senior Project";
    const _RESEARCH = "Research";
}
?>