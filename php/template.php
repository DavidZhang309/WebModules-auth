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

?>