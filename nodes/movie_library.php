<?php
	function dates($rdate, $title){
		$res='';
		if(!empty($rdate)){
			$res.= '<div class="factbox"><h3>'. $title .'</h3><time datetime="'. date("Y-m-d", $rdate) .'">'. date("j F Y", $rdate).'</time>';
			if(time()<$rdate){
				$jstime = date("Y:", $rdate) . (date("n", $rdate)-1) . date(":j:G:i", $rdate);
				$res.= ' &mdash; <span class="timer" data-time="'. $jstime .'"></span>';
			}
			$res.='</div>';
		}
		return $res;
	}
	function text($text){
		if(!empty($text)){
			return $text;
		}
	}
	function para($text, $class){
		if(!empty($text)){
			return '<p class="'. $class .'">'.$text.'</p>';
		}
	}
	function boxoffice($num){
		if(!empty($num)){
			return '<div class="factbox"><h3>Box Office Earnings</h3>$'. $num. '</div>'; 
		}
	}
	function short($sfilm){
		if(!empty($sfilm)){
			return '<div class="factbox"><h3>Released With Short</h3>'. $sfilm. '</div>'; 
		}
	}
	function amazonlink($asin, $title){
		if(!empty($asin)){
			return '<p><a href="http://www.amazon.com/gp/product/'. $asin .'/ref=as_li_tf_tl?ie=UTF8&tag=pixarportal-20&linkCode=as2&camp=217145&creative=399369&creativeASIN='. $asin .'" target="_blank" class="amazon_link">'. $title .'</a></p>';
		}
	}
	
	function amazon($threed, $bluray, $dvd, $cd, $book, $title){
		$links = amazonlink($threed, '3D Blu-ray').
				 amazonlink($bluray, 'Blu-ray').
				 amazonlink($dvd, 'DVD').
				 amazonlink($cd, 'Soundtrack').
				 amazonlink($book, 'Art of '.$title);
		if(!empty($links)){
			return $links;
		}
	}
	
	function imgs($title){
		global $db; $new = array();
		$path = 'imgs/'.$db->prepURL($title);
		$pics = makearray(scandir($path));
		foreach ($pics as $pic){
			$new[] = array($path.'/'.$pic, $title);
		}
		return $new;
	}



/* IMAGE FUNCTIONS */
	
	function makearray($files){
		$new = array();
		for($x=0; $x<sizeof($files); $x++){	
			if(checkImg($files[$x])){
				$new[] = $files[$x];
			}
		}return $new;
	}
	
	function checkImg($filename){
		$per = strrpos($filename, '.');
		$s = substr($filename, $per+1);
		if($s=='png' || $s=='gif' || $s=='jpg' || $s=='jpeg'){
			return true;
		}else{
			return false;
		}
	}
?>