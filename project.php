<?php
    include_once '_class/IdeaAbstractionManager.class.php';
	include_once '_class/StudentManager.class.php';
    include_once '_class/LecturerManager.class.php';
    include_once '_class/FileManager.class.php';

	include '_pages/header.php';

	if(isset($_GET['uid'])){
        $uid = $_GET['uid'];

        $manager = new IdeaAbstractionManager();
        $project = $manager->get($uid);
        // customizing page title eg. "My research's title blahblabla - Research"
        $s = get_class($project)=='SeniorProject' ? 'Senior Project' : get_class($project);
        echo '<head><title>'.$project->title().' - '.$s.'</title></head>';
        
        // showing details
        $links = explode(';', $project->links());
        $authors = explode(';', $project->coauthors());
        $keywords = explode(';', $project->keywords());
        $postedby = $project->postedby();
        $documents = FileManager::getFiles($uid, __db());
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
                            if(LecturerManager::lecturerExists($postedby, __db()))
                                echo '<a href="http://localhost/sr-proj/profile.php?user='.$postedby.'&type=Lecturer">'.LecturerManager::getFullname($postedby, __db()).'</a></br>';
                            else
                                echo '<a href="http://localhost/sr-proj/profile.php?user='.$postedby.'&type=Student">'.StudentManager::getFullname($postedby, __db()).'</a></br>';

                echo    '<label>Authors:</label> ';
                            $temp = '';
                            foreach ($authors as $uname){
                                if(LecturerManager::lecturerExists($uname, __db()))
                                    $temp = $temp.'<a href="http://localhost/sr-proj/profile.php?user='.$uname.'&type=Lecturer">'.LecturerManager::getFullname($uname, __db()).'</a>; ';
                                else
                                    $temp = $temp.'<a href="http://localhost/sr-proj/profile.php?user='.$uname.'&type=Student">'.StudentManager::getFullname($uname, __db()).'</a>; ';
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
                echo    '</br><label>Documents:</label> ';
                        $temp='<ul>';
                        foreach ($documents as $doc)
                            $temp .= '<li><a href="download.php?file='.$doc['filename'].'" target="_blank" title="Download">'.$doc['description'].'</a>('.number_format($doc['size']/1024).'Kb)'.File::getFileIcon($doc['type']).'</li>';
                        $temp .= '</ul>';
                        echo empty($documents) ? 'No Documents' : $temp;
                if(isset($_SESSION['repsyst_session_username']) && $postedby == $_SESSION['repsyst_session_username']){
                    echo '  <br><a class="btn btn-primary" href="http://localhost/sr-proj/update_project.php?uid='.$uid.'">Update Project</a>
                                <a class="btn btn-primary" href="http://localhost/sr-proj/upload.php?uid='.$uid.'">Add Files to project</a>';
                }?>
        
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