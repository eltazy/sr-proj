<?php    
    $database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
    if(isset($_POST['keyword'])){
        $temp = explode(';', $_POST['keyword']);
        $str = end($temp);
        $quest = $database->prepare("SELECT * FROM topics WHERE topic REGEXP '$str'");
        $quest->execute();
        $result = $quest->fetchAll();
        echo '<ul id="users">';
        
        if(empty($result)) echo "<li onClick=\"selectTopic('".$str."');\">+ Add '".$str."' as new topic</li>";
        foreach($result as $topic)
            echo "<li onClick=\"selectTopic('".$topic['topic']."')\";>".$topic['topic'].'</li>';
        echo '</ul>';
    }
?>