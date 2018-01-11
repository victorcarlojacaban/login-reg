<?php
function email_exists($usr_email) 
{
	global $conn;

	$sql = "SELECT usr_id FROM users WHERE usr_email = '$usr_email'";

	$result = $conn->query($sql);

	if($result->num_rows == 1 ) {
		return true;
	} else {
		return false;
	}
}

function get_name($usr_email) {
	global $conn;

	$sql = "SELECT usr_firstname FROM users WHERE usr_email = '$usr_email'";

	$result = $conn->query($sql);

	$row = $result->fetch_assoc();

	return $row["usr_firstname"];
}

function set_message($message) 
{
	if(!empty($message)){
		$_SESSION['message'] = $message;
	}else {
		$message = "";
	}
}

function display_message()
{
	if(isset($_SESSION['message'])) {
		echo $_SESSION['message'];

		unset($_SESSION['message']);
	}
}

function redirect($location){
	return header("Location: {$location}");
}

function validation_errors($error_message) 
{
$error_message = <<<DELIMITER

<div class="alert alert-danger alert-dismissible" role="alert">
  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  	<strong>Warning!</strong> $error_message
 </div>
DELIMITER;

set_message($error_message);
}

function logged_in(){
	if(isset($_SESSION['usr_email']) || isset($_COOKIE['usr_email'])){
		return true;
	} else {
		return false;
	}
}

?>