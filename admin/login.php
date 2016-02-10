<?php 
session_start(); 
include 'scripts/authentication.php'; 
if (isset($_POST['username'])) {
	logIn($_POST['username'], $_POST['password'], $_POST['verify']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link type="text/css" rel="stylesheet" href="styles/login.css" />
<title>Admin Login | Pixar Portal</title>
</head>

<body>

<form name="login" method="post" action="">
	<div>LOGIN</div>
	<input type="text" placeholder="User Name" name="username" required/><br/>
    <input type="password" placeholder="Password" name="password" required/><input type="password" name="verify"/><br/>
    <input type="submit" name="submit" value="Submit" />
</form>

</body>
</html>