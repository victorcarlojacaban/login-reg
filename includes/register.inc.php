<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$usr_firstname				= $_POST['usr_firstname'];
	$usr_lastname				= $_POST['usr_lastname'];
	$usr_displayname			= $_POST['usr_displayname'];
	$usr_email					= $_POST['usr_email'];
	$usr_password				= md5($_POST['usr_password']);
	$confirm_password		    = $_POST['confirm_password'];

	$errors = [];

	if (email_exists($usr_email))
	{
		$errors[] = "$usr_email is already registered.";
	}

	if (!empty($errors)) {
		foreach ($errors as $error) {
			validation_errors($error);
		}
	}else{
		$sql = "INSERT INTO users (usr_firstname, usr_lastname, usr_displayname, usr_email, usr_password, usr_creation_date)
		VALUES ('$usr_firstname', '$usr_lastname', '$usr_displayname', '$usr_email', '$usr_password', now())";

		if ($conn->query($sql) === TRUE) {
			redirect("index.php");
			exit;

		} else {
			set_message("<p>Error: " . $sql . "<br>" . $conn->error . "</p>");
		}

		$conn->close();
	}
}
?>