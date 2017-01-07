<?php
function write_login_modal() { ?>
<div id="login-modal" class="modal fade" data-waiting="0">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">Login</div>
			<div class="modal-body">
				<div class="login-response hidden">
					<div class="alert alert-danger"></div>
				</div>
				<form class="login-form" action="auth.php" method="post">
					<div class="input-group">
						<span class="input-group-addon">Username</span>
						<input type="text" name="username" class="login-username form-control">
					</div>
					<div class="input-group">
						<span class="input-group-addon">Password</span>
						<input type="password" name="password" class="login-password form-control">
					</div>
				</form>
			</div>
			<div class="modal-footer login-options">
				<span class="login-progress hidden"><i class="fa fa-spin fa-spinner"></i> Logging in</span>
				<button class="btn btn-default login-cancel">Cancel</button>
				<button class="btn btn-default login-submit">Login</button>
			</div>
		</div>
	</div>
</div>
<?php } 

function write_header_tags($dir = '.') { ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="<?= $dir ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?= $dir ?>/vendor/font-awesome-4.6.3/css/font-awesome.min.css" />
<?php }

function write_footer_scripts($dir = '.') { ?>
	<script src="<?= $dir ?>/vendor/jquery-2.2.4.min.js"></script>
	<script src="<?= $dir ?>/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?= $dir ?>/vendor/js.cookie-2.1.3.min.js"></script>
	<script src="<?= $dir ?>/auth.js"></script>
<?php }
?>