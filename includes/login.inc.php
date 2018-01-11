<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$usr_email		= $_POST['usr_email'];
	$usr_password	= md5($_POST['usr_password']);

	$sql = "SELECT usr_email, usr_password FROM users WHERE usr_email = '$usr_email' AND usr_password = '$usr_password'";
	$result = $conn->query($sql);

	if ($result->num_rows == 1) {
		if (isset($_POST['remember'])) {
			setcookie('usr_email', $usr_email, time() + 86400);
		}
		/*set user email session*/
		$_SESSION['usr_email'] = $usr_email;

		redirect("index.php");
		exit;
	} else {
		set_message('<div class="alert alert-warning" role="alert" col-md-12"><p>Invalid username or password.</p></div>');
	}
}
?>