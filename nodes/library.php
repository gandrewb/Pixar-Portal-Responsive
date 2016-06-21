<?php
$movies = $db->dq('SELECT * FROM films ORDER BY theater ASC');

$pageArray = array();
$pg = (!isset($_GET['pg'])) ? 1 : $_GET['pg'];
$postsperpage = 3;

function addPageLink($num){
	global $pageArray;
	if(!in_array($num, $pageArray)){
		array_push($pageArray, $num);
	}
}

function buildPageNav(){
	global $db, $pageArray, $pg, $postsperpage;
	$results = $db->dq1('SELECT COUNT(*) AS count FROM blog WHERE status="published"');
	$numposts = (int)$results['count'];
	$numpages = ceil($numposts / $postsperpage);
	
	if($numpages<10){	
		for($n=1; $n<=$numpages; $n++){ addPageLink($n); }
	}else{ 
		array_push($pageArray,1,2,3);
		if($pg<4){
			array_push($pageArray,4,5);
		}
	}
	
	for($i=$pg-2; $i<$pg+3; $i++){
		if($i>0 && $i<$numpages){
			addPageLink($i);
		}
	}
	addPageLink($numpages-2); addPageLink($numpages-1); addPageLink($numpages);
	
	for ($p=0; $p<sizeof($pageArray); $p++) { // Traverses page link array
		$i = $pageArray[$p];
		if ($p>0 && ($i-1)!=$pageArray[$p-1]){
			echo ' &hellip; ';
		}
		
		if ($i == $pg) {
			echo '<span class="blogPgSelected">' . $i . '</span>';
		} else {
			echo '<a href="?pg='. $i .'" class="blogPgLink">'. $i .'</a>';
		} 
	}
}

function movieLinks($article){
	global $movies;		
	foreach($movies as $movie){
		$mov = preg_replace('/&bull;/', '•', $movie['title']);
		$article = preg_replace('/<em>'.$mov.'<\/em>/', '<a href="/movies/'.$movie['url'].'"><em>'.$movie['title'].'</em></a>', $article);
		$article = preg_replace('/<em>'.$movie['workingtitle'].'<\/em>/', '<a href="/movies/'.$movie['url'].'"><em>'.$movie['workingtitle'].'</em></a>', $article);
	}
	return $article;
}

function printArticle($post, $link){
	$articletext = stripslashes($post['article']);
	$title = ($link) 
		? '<a href="/blog/'. $post['url'] .'">'. stripslashes($post['title']) .'</a>' 
		: stripslashes($post['title']);
		
	echo '<article class="blog_article">
			<h2>'.$title.'</h2>
			<time dateTime="'. date("Y-m-d", $post['timestamp']) .'">'. date("j F Y", $post['timestamp']) .'</time>
			<section class="article_body">'. movieLinks($articletext) .'</section>
		</article>';
}

function printBlog($id = null){
	global $db;
	global $postsperpage;
	global $pg;
	
	$first = ($pg - 1) * $postsperpage; //Which post to start with on the page		
	
	$query = 'SELECT * FROM blog WHERE status="published" ORDER BY timestamp DESC LIMIT '. $first .', '. $postsperpage;
	
	$posts = $db->dq($query);

	foreach($posts as $post){
		printArticle($post, true);
	}
}

?>