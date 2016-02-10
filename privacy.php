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
	<title>Pixar Portal | Privacy Policy</title>
	<?php include 'nodes/head_tags.php'; ?>
</head>
<body class="page_privacy">

	<?php include 'nodes/header.php'; ?>
	
	<div id="frame" class="frame">
		<section class="content">
			<article class="privacy">
				<h1>Privacy Policy</h1>
				<p>Pixar Portal collects only a minimal amount of anonymous data, through the use of cookies, for website improvement purposes only. I do not share, sell or distribute that anonymous data with anyone. You have my word.</p>
				<p>By following affiliate links or clicking on advertisements on this site, you grant your permission for these third parties to temporarily track your purchases on their sites so that a referrers fee may be paid to Pixar Portal. These affiliate programs help to cover the costs and resources necessary to continue the operation of Pixar Portal.</p>
			</article>
		</section>
	
		<?php include 'nodes/sidebar.php'; ?>	
		
	</div>
	
	<script src="/js/main.js"></script>

</body>
</html>