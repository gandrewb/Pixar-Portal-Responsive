<?php
	function checkAdmin(){
		if(!isAdmin()){
			header('Location: login.php?msg=notAdmin');
			exit;
		}
	}
	
	function logIn($user, $password, $verify){
		if($user=='griffinandyb@gmail.com' && $password=='109HetBegin' && empty($verify)){
			$_SESSION['user']='admin';
			header('Location: index.php');
			exit;
		}else{
			header('Location: login.php?msg=wrong');
			exit;
		}
	}
	
	function isAdmin() {
		if (isset($_SESSION['user'])) {
			if ($_SESSION['user'] == 'admin') {
				return TRUE;
			}
			else {
				return FALSE;
			}
		}
		else {
			return FALSE;
		}
	}
?>