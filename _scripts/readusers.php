<?php
	include_once '../_class/StudentManager.class.php';
    include_once '../_class/LecturerManager.class.php';
    
    include '_config/db.php';
    
    if(isset($_POST['keyword'])) {
        $temp = explode(';', $_POST['keyword']);
        $str = end($temp);
        $quest = __db()->prepare("   SELECT username FROM lecturers_tb   WHERE firstname REGEXP '$str' 
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
            if(LecturerManager::lecturerExists($user['username'], __db()))
                echo "<a class=\"list-group-item list-group-item-action list-group-item-info\" onClick=\"selectUser('".$user['username']."');\">".LecturerManager::getFullname($user['username'], __db()).'</a>';
            else echo "<a class=\"list-group-item list-group-item-action list-group-item-info\" onClick=\"selectUser('".$user['username']."')\";>".StudentManager::getFullname($user['username'], __db()).'</a>';
        }
        echo '</div>';
}
?>