<?php
include_once __DIR__ . '/../php/authDB.php';
include_once __DIR__ . '/../php/auth_utils.php';
include_once __DIR__ . '/../php/constants.php';

function login_failed($error_msg) {
	$_SESSION[SESSION_ERROR] = $error_msg; 
	header('location: login.php');
	exit();
}

session_start();
//input
if (isset($_POST['username'])) {
	$user = $_POST['username'];
} else {
	exit();
}

if (isset($_POST['password'])) {
	$pass = $_POST['password'];
} else {
	exit();
}

if (isset($_POST['redirect'])) {
	$redirect = $_POST['redirect'];
} else {
	$redirect = false;
}

$db_connection = new AuthDB();
$statement = $db_connection->prepare('
	SELECT UserID, 
		Password, 
		Salt
	FROM tbl_users
	WHERE Username=?
');

$statement->bind_param('s', $user);
$statement->execute();
$statement->bind_result($query_id, $query_password, $query_salt);

if (!$statement->fetch()) { //user does not exist
	login_failed('Account does not exist.');
}
if (hash('sha256', $query_salt . $pass) === $query_password) {
	$_SESSION[SESSION_ID] = $query_id;
	if ($redirect !== false) {
		header("location: $redirect");
	}
} else {
	login_failed('Incorrect password.');
}
?>