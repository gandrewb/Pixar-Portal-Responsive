<?php
session_start(); 
date_default_timezone_set('America/Denver');
include 'authentication.php'; 
checkAdmin();

include '../../db/db.php';
$db= new Database();

$url=$db->prepURL($_POST['title']);

$status = ($_POST['submit']=='Publish') ? 'published' : 'saved';

switch($_POST['action']){
	case 'insert':
		$query='INSERT INTO blog
				(title, url, article, color, to_edges, film, timestamp, status) VALUES (?, ?, ?, ?, ?, ?, ?, "'. $status .'")';
		$params = array($_POST['title'], $url, $_POST['blogpost'], $_POST['color'], $_POST['to_edges'], $_POST['film'], $_POST['timestamp']);
		break;
	case 'update':
		$query='UPDATE blog SET
				title=?, 
				url=?, 
				article=?, 
				color=?,
				to_edges=?, 
				film=?, 
				timestamp=?,
				status = "'. $status .'"
				WHERE id ='. $_POST['id'];
		$params = array($_POST['title'], $url, $_POST['blogpost'], $_POST['color'], $_POST['to_edges'], $_POST['film'], $_POST['timestamp']);
		break;
	case 'delete':
		$db->dc('DELETE FROM blog WHERE id='.$_POST['id']);
		break;
}

if($db->dcParams($query, $params)){
	header('Location: rssgenerator.php');
	exit;
}
?>