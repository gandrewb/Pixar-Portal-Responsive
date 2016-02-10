<?php
	session_start();
	include '../db/db.php';
	$db = new Database();
	include 'scripts/authentication.php'; 
	checkAdmin();
	
	$articles = $db->dq('SELECT id, title, timestamp, url, status FROM blog ORDER BY timestamp DESC');
	
	$cquery = 'SELECT comments.id AS id, comment, title, name FROM comments
				INNER JOIN blog ON postid=blog.id 
				WHERE comments.status="submitted" ORDER BY comments.timestamp DESC';
	$comments = $db->dq($cquery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Admin Dashboard</title>
	<link rel="stylesheet" href="styles/lists.css">
</head>
<body>
	<div id="content">
		<header>
			<a href="post.php"> New &plus; </a>
			<a href="http://www.pixarportal.com" target="_blank"> Pixar Portal </a>
			<a href="http://toolbox.omnis.com/phpmyadmin/" target="_blank"> Database </a>
		</header>
		<div id="lcol">
			<?php foreach($articles as $a){
				$saved = ($a['status']=='saved') ? 'saved' : '';
				echo '<div class="post '. $saved .'">
						<div class="delete" data-id="'. $a['id'] .'">&times;</div>
						<a href="../blog.php?id='. $a['url'] .'" target="_blank" class="preview">👀</a>
						<a href="post.php?id='. $a['id'] .'">'. date('d M Y', $a['timestamp']) .' &mdash; '. $a['title'] .'</a>
					</div>';
			}?>
		</div>
		<div id="rcol">
			<?php foreach($comments as $c){
				echo '<div>
					<div class="approve" data-id="'. $c['id'] .'">&#10003;</div>
					<div class="delete" data-id="'. $c['id'] .'">&times;</div>
					<strong>'. htmlspecialchars($c['title']) .'</strong>
					<p><em>'. htmlspecialchars($c['name']).':</em> <span contenteditable>'.htmlspecialchars($c['comment']) .'</span></p>
					</div>';
			}?>
		</div>
	</div>
	
	<script src="scripts/jquery.js"></script>
	<script src="scripts/lists.js"></script>
</body>
</html>