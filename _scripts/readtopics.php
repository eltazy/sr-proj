<?php
if (!isset($_SESSION)) session_start();

include_once '../_class/TopicManager.class.php';

    $database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
    if(isset($_POST['keyword'])){
        $temp = explode(';', $_POST['keyword']);
        $str = end($temp);
        $quest = $database->prepare("SELECT topic FROM topics WHERE topic REGEXP '$str'");
        $quest->execute();

        $result = $quest->fetchAll();
        echo '<div class="list-group" id="topics">';
        if(empty($result))
            echo "<a class=\"list-group-item list-group-item-action list-group-item-warning\" onClick=\"selectTopic('notopic');\">+ Add \"".$str."\" as new topic</a>";
        foreach($result as $topic)
            echo "<a class=\"list-group-item list-group-item-action list-group-item-info\" onClick=\"selectTopic('".$topic['topic']."');\">".$topic['topic'].'</a>';
        echo '</div>';
    }
?>