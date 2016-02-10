<?php
	session_start();
	date_default_timezone_set('America/Denver');
	include_once 'db/db.php';
	$db = new Database();
	include_once 'nodes/library.php';
	
	$query = 'SELECT * FROM blog WHERE url="'. $_GET['id'] .'"';
	$post = $db->dq1($query);	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo stripslashes($post['title']) ?> | Pixar Portal</title>
	<?php include 'nodes/head_tags.php'; ?>
</head>
<body class="page_blog">

	<?php include 'nodes/header.php'; ?>
	
	<div id="frame" class="frame">
		<section class="content">
			<?php 
				printArticle($post);
			?>
		</section>
	
		<?php include 'nodes/sidebar.php'; ?>	
		
	</div>
	
	<script src="/js/main.js"></script>

</body>
</html>