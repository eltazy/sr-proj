<?php
    include_once '_class/IdeaAbstractionManager.class.php';
	include_once '_class/StudentManager.class.php';
    include_once '_class/LecturerManager.class.php';

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
        $links = explode(';', $project->links());
        $authors = explode(';', $project->coauthors());
        $keywords = explode(';', $project->keywords());
        $postedby = $project->postedby();
        $documents = explode(';', $project->docs());
        
        echo    '<h1>'.$project->title().'</h1>
                <p>'.$project->description().'</p></br>
                Links: ';
                    $temp = '';
                    foreach ($links as $link)
                        $temp = $temp.'<a href="'.$link.'" target="_blank">'.$link.'</a>; ';
                    echo substr($temp, 0, -2).'</br>';
        echo    'Posted by: ';
                    if(LecturerManager::lecturerExists($postedby, $database))
                        echo '<a href="http://localhost/sr-proj/profile.php?user='.$postedby.'&type=Lecturer">'.LecturerManager::getFullname($postedby, $database).'</a></br>';
                    else
                        echo '<a href="http://localhost/sr-proj/profile.php?user='.$postedby.'&type=Student">'.StudentManager::getFullname($postedby, $database).'</a></br>';

        echo    'Authors: ';
                    $temp = '';
                    foreach ($authors as $uname){
                        if(LecturerManager::lecturerExists($uname, $database))
                            $temp = $temp.'<a href="http://localhost/sr-proj/profile.php?user='.$uname.'&type=Lecturer">'.LecturerManager::getFullname($uname, $database).'</a>; ';
                        else
                            $temp = $temp.'<a href="http://localhost/sr-proj/profile.php?user='.$uname.'&type=Student">'.StudentManager::getFullname($uname, $database).'</a>; ';
                    }
                    echo substr($temp, 0, -2).'<br>';
        echo    'Created on '.
                    $project->creationdate().'</br>
                State: '.
                    $project->state().'</br>
                Type: '.
                    $project->type().'</br>
                Keywords: ';
                    foreach ($keywords as $key)
                        echo '<u><a href="http://localhost/sr-proj/search.php?topic='.$key.'">'.$key.'</a></u> ';
        echo    '</br>Documents: ';
                    $temp = '';
                    foreach ($documents as $doc)
                        $temp = $temp.'<a href="./_uploads/_documents/AB8CE9F1D6DF.docx" target="_blank" download>download</a>; ';
                    echo substr($temp, 0, -2).'</br>';
	}
	else header("Location: index.php");
?>