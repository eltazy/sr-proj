<?php
	include_once '../_class/StudentManager.class.php';
    include_once '../_class/LecturerManager.class.php';
    
    $database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
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
        echo '<ul id="users">';
        if(empty($result)) echo "<li onClick=\"selectUser('nouser');\">No user</li>";
        foreach($result as $user){
            if(LecturerManager::lecturerExists($user['username'], $database))
                echo "<li onClick=\"selectUser('".$user['username']."');\">".LecturerManager::getFullname($user['username'], $database).'</li>';
            else echo "<li onClick=\"selectUser('".$user['username']."')\";>".StudentManager::getFullname($user['username'], $database).'</li>';
        }
        echo '</ul>';
}
?>