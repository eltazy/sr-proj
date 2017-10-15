<?php
////////////////script start
include_once 'project.class.php';

class ProjectManager{
	private $_db;
	public function __construct($db){
		$this->setDb($db);
	}
	public function add(Project $perso){

	}
	public function delete(Project $perso){

	}
	public function get($id){
	// Returns one Project object from its id.

	}
	public function getList(){
	// Returns a list of projects.
	}
	public function update(Project $proj){
	// Prépare une requête de type UPDATE.
	// Assignation des valeurs à la requête.
	// Exécution de la requête.
	}
	//setter
	public function setDb(PDO $db){
		$this->_db = $db;
	}
}

////////////////script end
?>