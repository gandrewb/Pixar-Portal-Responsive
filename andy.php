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
	<title>Pixar Portal | Andy</title>
	<?php include 'nodes/head_tags.php'; ?>
</head>
<body class="page_andy">

	<?php include 'nodes/header.php'; ?>
	
	<div id="frame" class="frame">
		<section class="content">
			<article class="privacy">
				<img src="imgs/andy.jpg" class="andy_portrait">
				<h1>Andy Griffin</h1>
				<p>I was raised with a deep appreciation for art and design. Couple that with the instant connection I felt with Andy from Toy Story due to our shared name, age and resemblance, and I was instantly mesmerized way back in 1995. Monsters, Inc. was the film that pushed me over the edge to fandom, and it all reached a fever pitch (where it has stayed) with The Incredibles in 2005.</p>
				<p>I'm fascinated by the crossroads of art and technology. By day, I'm a web designer and developer. But I have an appetite for a variety of design media like animation, architecture, graphic design, industrial design, and photography.</p>
				<p>There's more to say, but I'm going to make you work for it. Check out <a href="http://www.andygriff.in">my website</a>. And find me on <a href="http://www.twitter.com/andybgriffin">Twitter</a>, <a href="http://www.linkedin.com/in/griffinandyb">LinkedIn</a> and <a href="https://dribbble.com/gandrewb">Dribbble</a>.</p>
			</article>
		</section>
	
		<?php include 'nodes/sidebar.php'; ?>	
		
	</div>
	
	<script src="/js/main.js"></script>

</body>
</html>