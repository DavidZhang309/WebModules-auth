<?php
include_once "AuthDB.php";
include_once "constants.php";

function get_user_id($redirect = false)
{
	if (isset($_SESSION[SESSION_ID]))
	{
		return $_SESSION[SESSION_ID];
	}
	else if ($redirect)
	{
		header("location: " . $redirect);
		exit();
	}
	else
	{
		return -1;
	}
}

function update_permissions($project_id) {
	if (!isset($_SESSION[SESSION_PERMISSION])) {
		$_SESSION[SESSION_PERMISSION] = array();
	}
	$user = get_user_id();

	$db_connection = new AuthDB();
	$statement = $db_connection->prepare("
		SELECT 
			PermissionCode
		FROM v_permissions
		WHERE UserID=? AND ProjectID=?
	");
	$statement->bind_param('ii', $user, $project_id);
	$statement->execute();
	$statement->bind_result($query_permission);

	$permissions = array();
	while ($statement->fetch()) {
		$permissions[] = $query_permission;
	}

	$_SESSION[SESSION_PERMISSION][$project_id] = $permissions;
}

function get_permissions($project_id) {
	if (!isset($_SESSION[SESSION_PERMISSION][$project_id])) {
		update_permissions($project_id);
	}
	return $_SESSION[SESSION_PERMISSION][$project_id];
}

function has_permissions($project_id, $permission_code) {
	$permissions = get_permissions($project_id);
	return array_search($permission_code, $permissions) !== false;
}

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
?>