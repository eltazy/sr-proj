<?php
    if (!isset($_SESSION)) session_start();
	
	include_once '_class/IdeaAbstractionManager.class.php';
	include_once '_class/TopicManager.class.php';

	include_once '_pages/header.php';
?>
<head>
	<title>Home</title>
</head>
<body>
	<!-- recently added projects -->
	<article>
		<header>Recent Projects</header>
		<?php $database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
		$latest_projects = IdeaAbstractionManager::getLatestProjects($database);
		// displaying latest projects
		foreach ($latest_projects as $project){
			$Constructor = str_replace(' ', '', $project['type']);
			echo new $Constructor($project).'<hr>';
		}?>
	</article>

	<!-- recent activity -->
	<article>
		<header>Recent Activity</header>
		<?= include '_pages/recent_activity.php' ?>
	</article>

	<!-- popular topics -->
	<aside>
		<header>Popular Topics</header>
		<?php $popular_topics = TopicManager::getPopularTopics($database);
		// displaying topics
		echo '<ul>';
		foreach ($popular_topics as $topic)
			echo new Topic($topic);
			echo '<li><a href="http://localhost/sr-proj/topic.php?all">All topics</a></li>';
		echo '</ul>';
		?>
	</aside>
</body>