		<aside class="sidebar" class="sidebar">			
			<nav class="main_nav">
					<a href="/" class="round_btn">Home</a>
					<a href="http://twitter.com/pixarportal" class="round_btn twitter_btn"></a>
					<a href="/andy.php" class="round_btn">Andy</a>
				</nav>
			
			<div class="movie_menu">
				<div id="poster_container" class="poster_container">
				<?php 
					foreach($movies as $r){
						echo '<a href="/movies/'. $r['url'] .'" class="movie_poster" data-title="'. $r['title'] .'"><img src="/imgs/movie_posters/'.$r['url'].'.jpg"></a>';
					}
				?>
				</div>
			</div>
			
			<div class="sidebar_content">
				<form class="search_form" action="/search.php" method="get">
					<input type="search" name="search">
				</form>
				
				<footer class="legal">
					<p>Content and site design &copy; <a href="http://www.agriffindesign.com">Andrew Griffin</a>.</p>
					<p>Pixar Portal is not affiliated with <a href="http://www.pixar.com">Pixar</a> or <a href="http://disney.go.com">Disney</a>. Pixar images &amp; video &copy; Disney/Pixar, and used under fair use or by permission.</p>
					<p><a href="/privacy.php" class="secondary_nav">Privacy Policy</a>   |   <a href="/feed.rss" class="secondary_nav">Subscribe via RSS</a></p>
				</footer>
			</div>					
		</aside>