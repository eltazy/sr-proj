<?php
	include_once '_class/StudentManager.class.php';
    include_once '_class/LecturerManager.class.php';
    
    $database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    print_r($project);
    $links = explode(';', $project->links());
    $authors = explode(';', $project->coauthors());
    $keywords = explode(';', $project->keywords());
    $postedby = $project->postedby();
    $documents = explode(';', $project->links());
    
    echo    '<h1>'.$project->title().'</h1>
            <p>'.$project->description().'</p></br>
            Links: ';
                foreach ($links as $link)
                    echo '<a href="'.$link.'">'.$link.'</a></br>';
    echo    'Posted by: ';
                if(LecturerManager::lecturerExists($postedby, $database))
                    echo '<a href="http://localhost/sr-proj/profile.php?user='.$postedby.'&type=Lecturer">'.LecturerManager::getFullname($postedby, $database).'</a></br>';
                else
                    echo '<a href="http://localhost/sr-proj/profile.php?user='.$postedby.'&type=Student">'.StudentManager::getFullname($postedby, $database).'</a></br>';

    echo    'Authors: ';
                foreach ($authors as $uname){
                    if(LecturerManager::lecturerExists($uname, $database))
                        echo '<a href="http://localhost/sr-proj/profile.php?user='.$uname.'&type=Lecturer">'.LecturerManager::getFullname($uname, $database).'</a></br>';
                    else
                        echo '<a href="http://localhost/sr-proj/profile.php?user='.$uname.'&type=Student">'.StudentManager::getFullname($uname, $database).'</a></br>';
                }
    echo    'Created on '.
                $project->date().'</br>
            State: '.
                $project->state().'</br>
            Type: '.
                $project->type().'</br>
            Keywords: ';
                foreach ($keywords as $key)
                    echo '<u><a href="http://localhost/sr-proj/search.php?keyword='.$key.'">'.$key.'</a></u> ';
    echo    '</br>Documents:<label><?php echo $user->middlename() ?></label>';
?>