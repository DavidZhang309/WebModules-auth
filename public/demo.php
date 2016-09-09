<?php
include_once __DIR__ . '/../php/template.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="/extlib/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="/extlib/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" />
</head>
<body>
<?php write_login_modal() ?>
<div class="container">
<div class="row">
	<div class="col-md-12">
		<button class="btn btn-primary login">Login</button>
	</div>	
</div>
<script src="/extlib/jquery-2.2.4.min.js"></script>
<script src="/extlib/bootstrap/js/bootstrap.min.js"></script>
<script src="auth.js"></script>
<script type="text/javascript">
	$(document).ready(function() {

	}).on("click", ".login", function() {
		$("#login-modal").modal('show');
	});
</script>
</body>
</html>