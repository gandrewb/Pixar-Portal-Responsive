<?php
	session_start();
	date_default_timezone_set('America/Denver');
	include_once 'db/db.php';
	$db = new Database();
	include_once 'nodes/library.php';
	include_once 'nodes/movie_library.php';
	
	$url = addslashes($_GET['movie']);
	$mov = $db->dq1('SELECT * FROM films WHERE url="'. $url .'"');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $mov['title']; ?> | Pixar Portal</title>
	<?php include 'nodes/head_tags.php'; ?>
	<?php include_once 'nodes/headerimg.php'; ?>
</head>
<body class="page_movie">

	<?php include 'nodes/header.php'; ?>
	
	<div id="frame" class="frame">
		<section class="content">
			<div class="poster_image">
				<img src="/imgs/movie_main_imgs/<?php echo $mov['url']; ?>.jpg">
			</div>	
			<article class="movie_info">
				<h1><?php echo $mov['title']; ?></h1>
				<div class="factframe">
					<?php 
						echo dates($mov['theater'], "Theatrical Release") . 
						dates($mov['video'], "Home Video Release").
						short($mov['short']) . 
						boxoffice($mov['boxoffice']);
					?>
				</div>
				
				<h2>Links</h2>
				<div class="factframe">
					<div class="factbox">
						<img src="/imgs/interface/amazon.png" alt="amazon logo" class="amazon_logo">
						<?php
							echo amazon($mov['3d'], $mov['bluray'], $mov['dvd'], $mov['cd'], $mov['book'], $mov['title']);
						?>
					</div>
					<div class="factbox">
						<h3>Other Links</h3>
						<?php  
							if(!empty($mov['trailer'])){ echo '<p><a href="'. $mov['trailer'] .'">Watch the Trailer</a></p>'; }
							if(!empty($mov['imdb'])){ echo '<p><a href="'. $mov['imdb'] .'">'. $mov['title'] .' IMDb Page</a></p>'; }
						?>
					</div>
				</div>
				
				<h2>Articles</h2>
				<table class="movie_articles">
				<?php
					$articles = $db->dq('SELECT * FROM blog WHERE film='. $mov['id']. ' AND status="published" ORDER BY timestamp DESC');
					foreach($articles as $article){
						echo '<tr><td>'.
							'<time datetime="'. date("Y-m-d", $article['timestamp']) .'">'.  
							date("d M Y", $article['timestamp']) .
							'</time></td>'.
							'<td><a href="/blog/'. $article['url'] .'">' .
							$article['title'] .
							'</a></td></tr>';
					}
				?>
				</table>
			</article>			
		</section>
	
		<?php include 'nodes/sidebar.php'; ?>	
		
	</div>
	
	<script src="/js/main.js"></script>

</body>
</html>