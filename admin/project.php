<?php
    include_once '_class/IdeaAbstractionManager.class.php';
	include_once '_class/StudentManager.class.php';
    include_once '_class/LecturerManager.class.php';

	include '_pages/header.php';

	if(isset($_GET['uid'])){
        $uid = $_GET['uid'];
        
        $database = new PDO($dbconnexion, $dbuser, $dbpwd);
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
        // $documents = explode(';', $project->docs());
        ?>
        <body>
        <div class="container-fluid" id="pagecontent">
            <div class="row" style="padding-top: 25px"><div class="col-md-offset-2 col-md-8">
                <h1><?= $project->title() ?></h1></br>
            </div></div>
            <div class="row">
                <div class="col-md-offset-2 col-md-5">
                    <p><?= $project->description() ?></p>
                </div>
                <div class="col-md-offset-2 col-md-3">
                        <label>Links: </label>
                        <?php
                            $temp = '';
                            foreach ($links as $key=>$link)
                                $temp = $temp.'<a href="'.$link.'" target="_blank">Link'.($key+1).'</a>; ';
                            echo substr($temp, 0, -2).'<br>';
                echo    '<label>Posted by:</label> ';
                            if(LecturerManager::lecturerExists($postedby, $database))
                                echo '<a href="http://localhost/sr-proj/profile.php?user='.$postedby.'&type=Lecturer">'.LecturerManager::getFullname($postedby, $database).'</a></br>';
                            else
                                echo '<a href="http://localhost/sr-proj/profile.php?user='.$postedby.'&type=Student">'.StudentManager::getFullname($postedby, $database).'</a></br>';

                echo    '<label>Authors:</label> ';
                            $temp = '';
                            foreach ($authors as $uname){
                                if(LecturerManager::lecturerExists($uname, $database))
                                    $temp = $temp.'<a href="http://localhost/sr-proj/profile.php?user='.$uname.'&type=Lecturer">'.LecturerManager::getFullname($uname, $database).'</a>; ';
                                else
                                    $temp = $temp.'<a href="http://localhost/sr-proj/profile.php?user='.$uname.'&type=Student">'.StudentManager::getFullname($uname, $database).'</a>; ';
                            }
                            echo substr($temp, 0, -2).'<br>';
                echo    '<label>Created on</label> '.
                            $project->creationdate().'</br>
                        <label>State:</label> '.
                            $project->state().'</br>
                        <label>Type:</label> '.
                            $project->type().'</br>
                        <label>Keywords:</label> ';
                            foreach ($keywords as $key)
                                echo '<u><a href="http://localhost/sr-proj/topic.php?title='.$key.'">'.$key.'</a></u> ';
                // echo    '</br>Documents: ';
                //             $temp = '';
                //             foreach ($documents as $doc)
                //                 $temp = $temp.'<a href="./_uploads/_documents/AB8CE9F1D6DF.docx" target="_blank" download>download</a>; ';
                //             echo substr($temp, 0, -2).'</br>';
                if(isset($_SESSION['repsyst_session_username']) && $postedby == $_SESSION['repsyst_session_username'])
                    echo '<br><a class="btn btn-primary" href="http://localhost/sr-proj/update_project.php?uid='.$uid.'">Update Project</a>';?>
        
            </div>
                </div>
        </div>
        </body>
        <?php
	    include_once '_pages/footer.php';
    }
    else header("Location: index.php");
    exit();
    ?>