<?php
include_once __DIR__ . '/../php/AuthDB.php';
include_once __DIR__ . '/../php/constants.php';
include_once __DIR__ . '/../php/auth_utils.php';
include_once __DIR__ . '/../php/internal_utils.php';


function login_failed($error_msg) {
	$_SESSION[SESSION_ERROR] = $error_msg; 

	$get_data = [];
	if (($redirect = try_get_post_data('redirect')) !== false) {
		$get_data[] = "redirect=$redirect";
	}
	if (($project_id = try_get_post_data('p_id')) !== false) {
		$get_data[] = "p_id=$project_id";
	}

	$query_string = '';
	if (count($get_data) > 0) {
		$query_string = '?' . implode('&', $get_data);
	}

	header('location: login.php' . $query_string);
	exit();
}

session_start();
//input
if (($user = try_get_post_data('username')) === false) {
	login_failed('No username given');
}

if (($pass = try_get_post_data('password')) === false) {
	login_failed('No password given');
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
$statement->close();

if (hash('sha256', $query_salt . $pass) === $query_password) {
	$_SESSION[SESSION_ID] = $query_id;
	if (($project_id = try_get_post_data('p_id')) !== false) {
		update_permissions($project_id);
	}
	if (($redirect = try_get_post_data('redirect')) !== false) {
		header("location: $redirect");
	}
} else {
	login_failed('Incorrect password.');
}
?>