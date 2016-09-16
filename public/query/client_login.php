<?php
include_once __DIR__ . '/../../php/AuthDB.php';
include_once __DIR__ . '/../../php/constants.php';
session_start();

function abort_response($error_type, $error_msg = false) {
	$error_arr = array('error_type' => $error_type);
	if ($error_msg !== false) {
		$error_arr['error_msg'] = $error_msg;
	}
	echo json_encode($error_arr);
	exit();
}

//check POST
if (!isset($_POST)) {
	abort_response('invalid_method', 'POST requests only');
}

if (isset($_POST['username'])) {
	$username = $_POST['username'];
} else {
	abort_response('invalid_username', 'No username provided.');
}

if (isset($_POST['password'])) {
	$password = $_POST['password'];
} else {
	abort_response('invalid_password', 'No password provided.');
}

$db_connection = new AuthDB();
$statement = $db_connection->prepare('
	SELECT UserID, Password, Salt
	FROM tbl_users
	WHERE Username=?
');
$statement->bind_param('s', $username);
$statement->execute();
$statement->bind_result($query_id, $query_password, $query_salt);
if (!$statement->fetch()) { //user does not exist
	abort_response('invalid_username', 'User does not exist');
}

if (hash('sha256', $query_salt . $password) === $query_password) {
	$_SESSION[SESSION_ID] = $query_id;
	echo json_encode(array());
} else {
	abort_response('invalid_password', 'Password is incorrect');
}
?>