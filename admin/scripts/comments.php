<?php
	include '../../db/db.php';
	$db = new Database();
	
	switch($_POST['action']){
		case 'delete':
			echo ($db->dc('DELETE FROM comments WHERE id='.$_POST['id'])) ? 'true' : 'false';
			break;
		case 'approve':
			$query = 'UPDATE comments SET
						status="approved",
						comment="'. $_POST['comment'] .'"
						WHERE id='.$_POST['id'];
			echo ($db->dc($query)) ? 'true' : 'false';
			break;
	}
?>