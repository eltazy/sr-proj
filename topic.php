<?php
    include_once '_class/TopicManager.class.php';
    include_once '_class/IdeaAbstractionManager.class.php';

	// include '_pages/header.php';

    if(isset($_GET['title'])){
        $database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');

        $topic_manager = new TopicManager($database);
        $topic = $topic_manager->get($_GET['title']);
        echo $topic->hits().' projects discussing this topic';
        $projects = explode(';', $topic->projects());
        $project_manager = new IdeaAbstractionManager($database);
        foreach ($projects as $projID)
            echo $project_manager->get($projID);
    }else{
        $all_topics = TopicManager::getTopics();
        echo '<ul>';
        foreach ($all_topics as $topic)
            echo new Topic($topic);
        echo '</ul>';
    }
?>