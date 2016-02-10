<?php
	session_start();
	date_default_timezone_set('America/Denver');
	include_once 'db/db.php';
	$db = new Database();
	include_once 'nodes/library.php';	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Pixar Portal | News & Rumors Blog</title>
	<?php include 'nodes/head_tags.php'; ?>
	<?php include_once 'nodes/headerimg.php'; ?>
</head>
<body class="page_homepage">

	<?php include 'nodes/header.php'; ?>
	
	<div id="frame" class="frame">
	
		<section class="content">
			<?php printBlog(); ?>
			
			<footer>
			<?php buildPageNav(); ?>
			</footer>
		</section>
	
		<?php include 'nodes/sidebar.php'; ?>	
		
	</div>
	
	<script src="/js/main.js"></script>

</body>
</html>