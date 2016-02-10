<?php 
session_start(); 
date_default_timezone_set('America/Denver');
include 'scripts/authentication.php'; 
checkAdmin();

include '../db/db.php';
$db = new Database();
$res = $db->dq('SELECT id, title FROM films');

$action = 'insert';
$comments = array();

if(isset($_GET['id'])){
	$article = $db->dq1('SELECT * FROM blog WHERE id='. $_GET['id']);
	$action = 'update';
	
	$cquery = 'SELECT id, comment, name, timestamp FROM comments
				WHERE postid='. $article['id'] .' ORDER BY timestamp DESC';
	$comments = $db->dq($cquery);
}

function a($idx, $default=null){
	global $article;
	return isset($article[$idx]) ? $article[$idx] : $default;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Blog Post | Pixar Portal</title>
	<link rel="stylesheet" href="styles/blogpost.css">
</head>
<body>

	<form name="blogarticle" action="scripts/addarticle.php" method="post">
		<header>
			<input type="text" name="title" placeholder="Title" value="<?php echo a('title'); ?>"><br>
			
			<div>
				<a onclick="textInsert('img');">&#9744;</a>
				<a onclick="textInsert('link');">&#9883;</a>
				<a onclick="textInsert('quote');">&raquo;</a>
				<a onclick="textInsert('smartquotes');">&ldquo;</a>
				<a onclick="textInsert('italic');"><em>i</em></a>
				<a onclick="textInsert('bold');"><strong>B</strong></a>
				<a onclick="textInsert('paragraph');">&para;</a>
				<a onclick="textInsert('youtube');">&#9656;</a>
				<a onclick="textInject('amazon', prompt('ASIN / ISBN 10'));">a</a>
				<a onclick="iTunes();"></a>
				<a onclick="textInsert('piechart');">&#9673;</a>
			</div>
			<select name="film">
				<option value="0">None</option>
				<?php 
					foreach($res as $r){
						echo '<option value="'. $r['id'] .'">'. $r['title'] .'</option>';
					}
				?>
			</select>
		</header>
		
		<section id="middle">
			<textarea id="blogpost" name="blogpost"><?php echo a('article', ''); ?></textarea>
			
			<div id="rcol">
			<?php foreach($comments as $c){
				echo '<div>
					<div class="delete" data-id="'. $c['id'] .'">&times;</div>
					<strong>'. htmlspecialchars($c['name']) .' &mdash; '. date('j M Y, G:i', $c['timestamp']) .'</strong>
					<p>'.htmlspecialchars($c['comment']) .'</p>
					</div>';
			}?>
			</div>
		</section>
		
		<footer>
			<input type="text" name="timestamp" value="<?php echo a('timestamp', time()); ?>">
			<input type="hidden" name="color" value="<?php echo a('color', 'white'); ?>"><div id="white" class="colorbox"></div><div id="black" class="colorbox"></div>
			<input type="hidden" name="to_edges" value="<?php echo a('to_edges', 'off'); ?>"><div id="margin_toggle" class="toggle"></div>
			<input type="hidden" name="action" value="<?php echo $action; ?>">
			<input type="hidden" name="id" value="<?php echo a('id'); ?>">
			<input type="submit" name="submit" value="Save">
			<input type="submit" name="submit" value="Publish">
			<input type="button" name="cancel" value="Cancel">
			<br><a href="http://agriffindesign.com/timestamp/index.php" target="_blank">Timestamp Generator</a>
		</footer>
	</form>
	
	<script src="scripts/jquery.js"></script>
	<script>
		$(window).load(function(){
			$('[name=film] option[value=<?php echo a('film', 0); ?>]').attr("selected","selected");
			$('#<?php echo a('color', 'white'); ?>').addClass('selected');
			$('[name=cancel]').click(function(){ window.location = 'index.php'; });
		});
	
		var tbox = document.getElementById("blogpost");
		var codes = new Array();
		function setVars(){
			codes['img'] = ['<img src="http://www.pixarportal.com/imgs/blog/<?php echo strtolower(date("Y/M", time())); ?>/sm/" alt="" data-link="enlarge" class="left">', '', 42];
			codes['youtube'] = ['<iframe width="618" height="348" src="http://www.youtube.com/embed/?autohide=1&showinfo=0" frameborder="0" allowfullscreen></iframe>', '', 65];
			codes['link'] = ['<a href="" target="_blank">', '</a>', 18];
			codes['italic'] = ['<em>', '</em>', 0];
			codes['bold'] = ['<strong>', '</strong>', 0];
			codes['quote'] = ['<blockquote>', '<p class="author"></p></blockquote>', 0];
			codes['smartquotes'] = ['&ldquo;', '&rdquo;', 0];
			codes['paragraph'] = ['<p>', '</p>', 0];
			codes['amazon'] = ['<a href="http://www.amazon.com/gp/product/###/ref=as_li_tf_tl?ie=UTF8&tag=pixarportal-20&linkCode=as2&camp=1789&creative=9325&creativeASIN=###" target="_blank">', '</a>', 0];
			codes['itunes'] = ['<a href="http://click.linksynergy.com/fs-bin/stat?id=eUM5p1o/2Hk&offerid=146261&type=3&subid=0&tmpid=1826&RD_PARM1=###%253Fuo%253D4%2526partnerId%253D30" target="itunes_store">', '</a>', 0];
			codes['piechart'] = ['<div class="blog_poll_results" data-poll-id="">', '</div>', 2];
		}
		setVars();
	</script>
	<script src="scripts/js.js"></script>
	<script src="scripts/lists.js"></script>

</body>
</html>
