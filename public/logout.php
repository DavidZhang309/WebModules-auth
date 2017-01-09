<?php
require_once __DIR__ . '/../php/internal_utils.php';
include_once __DIR__ . '/../php/constants.php';
include_once __DIR__ . '/../php/template.php';

session_start();
session_destroy();
#unset($_SESSION[SESSION_ID]);
#unset($_SESSION[SESSION_PERMISSION]);

$redirect = get_redirect();

?>
<!DOCTYPE html>
<html>
<head>
<?php write_header_tags(); ?>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-success">You are now logged out. <?= $redirect ? "Redirecting..." : "" ?></div>
		</div>
	</div>
</div>
</body>
<?php if ($redirect) { ?>
<script type="text/javascript">
	setTimeout(function(){
		window.location.replace("<?= $redirect ?>");
	}, 1000);
</script>
<?php } ?>
</html>