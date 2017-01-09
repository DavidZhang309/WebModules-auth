<?php
include_once "AuthDB.php";
include_once "constants.php";

function get_redirect() {
	if (isset($_GET["redirect"])) {
		return $_GET["redirect"];
	}
	else if (isset($_POST["redirect"])) {
		return $_POST["redirect"];
	}
	else {
		return false;
	}
}

function try_get_post_data($key) {
	return isset($_POST[$key]) && $_POST[$key] !== '' ? $_POST[$key] : false;
}

define('AUTHAPI_BAD_USERNAME', -1);
define('AUTHAPI_BAD_PASSWORD', -2);
function authenticate_user($db_connection, $user, $password) {
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
		return AUTHAPI_BAD_USERNAME;
	}
	$statement->close();

	if (strtolower(hash('sha256', $query_salt . $password)) === strtolower($query_password)) {
		return $query_id;
	} else {
		return AUTHAPI_BAD_PASSWORD;
	}
}

?>