<?php
    include_once '_class/IdeaAbstractionManager.class.php';

	include '_pages/header.php';

	if(isset($_GET['uid'])){
        $uid = $_GET['uid'];
        
        $database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $manager = new IdeaAbstractionManager($database);
        $project = $manager->get($uid);
        // customizing page title eg. "My research's title blahblabla - Research"
        $s = get_class($project)=='SeniorProject' ? 'Senior Project' : get_class($project);
        echo '<head><title>'.$project->title().' - '.$s.'</title></head>';
        // showing details
        include '_pages/projectpage.php';
	}
	else header("Location: index.php");
?>