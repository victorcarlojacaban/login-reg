<?php include("includes/init.php");
	session_destroy();

	if(isset($_COOKIE['usr_email'])) {
		unset($_COOKIE['usr_email']);

		setcookie('usr_email', '', time()-86400);
	}

redirect("login.php");
?>