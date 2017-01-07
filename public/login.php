<?php 
include_once __DIR__ . '/../php/auth_utils.php';
include_once __DIR__ . '/../php/constants.php';
session_start();

$redirect = get_redirect();

$redirect_value_attr = '';
if ($redirect) {
	$redirect_value_attr = 'value="' . $redirect . '"';
}

$project_id_attr = '';
if (isset($_GET['p_id'])) {
	$project_id_attr = 'value="' . $_GET['p_id'] . '"';
}
?>
<!DOCTYPE html>
<html>
<head>
	<link href="/extlib/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body>
    <div class="container">
	<div class="panel panel-default">
		<div class="panel-heading"><h3>Login</h3></div>
		<div class="panel-body">
		    <?php if (isset($_SESSION[SESSION_ERROR])) { ?>
		    <div class="alert alert-danger">
		        <div><?= $_SESSION[SESSION_ERROR] ?></div>
		    </div>
		    <?php $_SESSION[SESSION_ERROR] = null; } ?>
			<form action="auth.php" method="POST">
				<input type="text" name="p_id" class="hidden" <?= $project_id_attr ?>>
				<input type="text" name="redirect" class="hidden" <?= $redirect_value_attr ?>>
				<div class="form-group">
					<label for="user_input">Username</label>
					<input id="user_input" name="username" type="text" class="form-control">
				</div>
				<div class="form-group">
					<label for="pass_input">Password</label>
					<input id="pass_input" name="password" type="password" class="form-control">
				</div>
				<div class="form-group">
					<input type="submit" class="form-control">
				</div>
			</form>
		</div>
	</div>
    </div>
	<script src="/extlib/jquery-3.0.0.min.js"></script>
</body>
</html>