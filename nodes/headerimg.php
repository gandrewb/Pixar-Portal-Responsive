<?php
	function gatherImgs($dir){
		$imglist = array();
		foreach(scandir($dir) as $img){
			$end = substr($img, strripos($img, '.')+1);
			if($end=='jpg' || $end=='jpeg' || $end=='png' || $end=='gif'){
				$imglist[] = $img;
			}
		}return $imglist;
	}
	if(empty($_SESSION['header'])){
		$header_imgs = gatherImgs($_SERVER['DOCUMENT_ROOT'].'/imgs/headers/');
		$_SESSION['header'] = $header_imgs[rand(0, sizeof($header_imgs)-1)];
	}
	
	echo '<style>
			@media screen and (min-width:750px){
				header{
					background-image: url("/imgs/headers/'. $_SESSION['header'] .'");
				}
			}
		</style>';
?>