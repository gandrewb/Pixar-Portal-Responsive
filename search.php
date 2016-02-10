<?php
	session_start();
	date_default_timezone_set('America/Denver');
	include_once 'db/db.php';
	$db = new Database();
	include_once 'nodes/library.php';
	
	// •••••••••• SEARCH FUNCTIONS
	function prepareSearch($text){
		$text = addslashes(preg_replace("/[^A-Za-z0-9 \']/", "", $text ));
		$new = explode(" ", $text);
		$final = arrayToQuery($new, "title").' OR '.arrayToQuery($new, "article");
		return $final;
	}
	function arrayToQuery($arr, $col){
		for($x=0; $x<sizeof($arr); $x++){
			$arr[$x] = ' '.$col.' LIKE "%'. $arr[$x] .'%"';
		}
		return '('. implode(' AND ', $arr) .')';
	}
	function summarize($str, $color){
		$str = strip_tags($str);
		$str = substr($str,0,250);
		$idx = strrpos($str, ' ');
		$str = substr($str, 0, $idx);
		
		if(empty($str) && $color=='black'){
			$str = '[VIDEO]';
		}
		
		return $str;
	}
	
	$search = prepareSearch($_GET['search']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Pixar Portal | Search Results</title>
	<?php include 'nodes/head_tags.php'; ?>
</head>
<body class="page_search">

	<?php include 'nodes/header.php'; ?>
	
	<div id="frame" class="frame">
		<section class="content">
			<article>
				
				
			<?php
					
				// •••••••••• SEARCH RESULTS
				$postsperpage = 20;
			
				$pg = (!isset($_GET['pg'])) ? 1 : $_GET['pg'];
				
				$first = ($pg - 1) * $postsperpage; //Which post to start with on the page
				
				$query = 'SELECT * FROM blog WHERE '. $search .' ORDER BY timestamp DESC LIMIT '. $first .', '. $postsperpage;
			
				$posts = $db->dq($query);
				
				echo '<h1>Search results for: '. $_GET['search'] .'</h1>';
			
				if(sizeof($posts)<1){
					echo '<p>No matches.</p>';
				}else{
					foreach($posts as $post){
						echo
							'<div class="search_result">
								<h2><a href="/blog/'. $post['url'] .'">'. stripslashes($post['title']) .'</a></h2>
								<time dateTime="'. date("Y-m-d", $post['timestamp']) .'">'. date("j F Y", $post['timestamp']) .'</time>
								<p>'. summarize($post['article'], $post['color']) .'…</p>
							</div>';
					}
				}
			?>
				
				
			</article>
			
			<footer>
				
				
				<?php
					// •••••••••• SEARCH RESULT PAGINATION
					
					$pgnums = $db->dq1('SELECT COUNT(*) AS count FROM blog WHERE '. $search);
					$numposts = $pgnums['count'];
					
					if((int)$numposts > $postsperpage){
						$numpages = ceil((int)$numposts / $postsperpage);
						
						if($numpages<12){ // Determines if number of pages exceeds maximum number of links: 12
							$pageArray = array();
							for($n=1; $n<=$numpages; $n++){
								$pageArray[$n-1] = $n;
							}
						}else{
							$pageArray = array(1,2,3);
						}
						
						for($i=$pg-1; $i<$pg+2; $i++){
							if(!in_array($i, $pageArray) && $i>0 && $i<$numpages){
								$pageArray[] = $i;
							}
						}
						if(!in_array($numpages, $pageArray)){
							$pageArray[] = $numpages;
						}
						
						for ($p=0; $p<sizeof($pageArray); $p++) { // Traverses page link array
							$i = $pageArray[$p];
							if ($p>0 && ($i-1)!=$pageArray[$p-1]){
								echo ' &hellip; ';
							}
							
							if ($i == $pg) {
								echo '<span class="blogPgSelected">' . $i . '</span>';
							} else {
								echo '<a href="?pg='. $i .'&amp;search='. $_GET['search'] .'" class="blogPgLink">'. $i .'</a>';
							} 
						}
					}
				?>
				
				
			</footer>
		</section>
	
		<?php include 'nodes/sidebar.php'; ?>	
		
	</div>
	
	<script src="/js/main.js"></script>

</body>
</html>