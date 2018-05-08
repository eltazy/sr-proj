<?php
	include_once '../_class/StudentManager.class.php';
    include_once '../_class/LecturerManager.class.php';
    
    $database = new PDO($dbconnexion, $dbuser, $dbpwd);
    if(isset($_POST['keyword'])) {
        $temp = explode(';', $_POST['keyword']);
        $str = end($temp);
        $quest = $database->prepare("   SELECT username FROM lecturers_tb   WHERE firstname REGEXP '$str' 
                                                                            OR middlename REGEXP '$str' 
                                                                            OR lastname REGEXP '$str' 
                                                                            OR username REGEXP '$str'
                                        UNION
                                        SELECT username FROM students_tb    WHERE firstname REGEXP '$str'
                                                                            OR middlename REGEXP '$str'
                                                                            OR lastname REGEXP '$str'
                                                                            OR username REGEXP '$str'");
        $quest->execute();
        $result = $quest->fetchAll();
        echo '<div class="list-group" id="users">';
        if(empty($result)) echo "<a class=\"list-group-item list-group-item-action list-group-item-warning\" onClick=\"selectUser('nouser');\">No user</a>";
        foreach($result as $user){
            if(LecturerManager::lecturerExists($user['username'], $database))
                echo "<a class=\"list-group-item list-group-item-action list-group-item-info\" onClick=\"selectUser('".$user['username']."');\">".LecturerManager::getFullname($user['username'], $database).'</a>';
            else echo "<a class=\"list-group-item list-group-item-action list-group-item-info\" onClick=\"selectUser('".$user['username']."')\";>".StudentManager::getFullname($user['username'], $database).'</a>';
        }
        echo '</div>';
}
?>