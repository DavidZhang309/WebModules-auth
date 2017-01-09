<?php
include_once __DIR__ . '/../php/AuthDB.php';
include_once __DIR__ . '/../php/constants.php';
include_once __DIR__ . '/../php/auth_utils.php';
include_once __DIR__ . '/../php/internal_utils.php';

session_start();

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

//input
if (($user = try_get_post_data('username')) === false) {
	login_failed('No username given');
}

if (($pass = try_get_post_data('password')) === false) {
	login_failed('No password given');
}

$db_connection = new AuthDB();

if (($user_id = authenticate_user($db_connection, $user, $pass)) > 0) {
	$_SESSION[SESSION_ID] = $user_id;
	if (($project_id = try_get_post_data('p_id')) !== false) {
		update_permissions($project_id);
	}
	if (($redirect = try_get_post_data('redirect')) !== false) {
		header("location: $redirect");
	}
} else {
	switch ($user_id) {
		case AUTHAPI_BAD_USERNAME:
			login_failed('User does not exist');
			break;
		
		case AUTHAPI_BAD_PASSWORD:
			login_failed('Incorrect password.');
			break;
		default:
			login_failed('Unexpected error has occured');
			break;
	}
}