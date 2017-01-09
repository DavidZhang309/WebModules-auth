<?php
include_once __DIR__ . '/../../php/AuthDB.php';
include_once __DIR__ . '/../../php/constants.php';
require_once __DIR__ . '/../../php/auth_utils.php';
require_once __DIR__ . '/../../php/internal_utils.php';
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
if (($username = try_get_post_data('username')) === false) {
	abort_response('invalid_username', 'No username given');
}
if (($password = try_get_post_data('password')) === false) {
	abort_response('invalid_password', 'No password given');
}

//login user
$db_connection = new AuthDB();
if (($user_id = authenticate_user($db_connection, $username, $password)) > 0) {
	$_SESSION[SESSION_ID] = $user_id;
	if (($project_id = try_get_post_data('p_id')) !== false) {
		update_permissions($project_id);	
	}
	echo json_encode(array());
} else {
	switch ($user_id) {
		case AUTHAPI_BAD_USERNAME:
			abort_response('bad_username', 'User does not exist');
			break;
		
		case AUTHAPI_BAD_PASSWORD:
			abort_response('bad_password', 'Password is incorrect');
			break;
		default:
			abort_response('unknown_error', 'Unexpected error has occured');
			break;
	}
}