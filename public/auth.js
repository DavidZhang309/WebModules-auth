function login(username, password, redirect, errorCallback) {
	$.ajax({
		url: "query/client_login.php",
		type: "POST",
		dataType: "json",
		data: {
			username: username,
			password: password
		},
		success: function(data) {
			if (data["error_type"] != null) {
				errorCallback(data);			
			} else {
				window.location.replace(redirect);
			}
		},
		error: function(data) {
			errorCallback({ error_type: "client_error", error_msg: data.responseText });
		}
	});
}


function loginModalSubmit($modal) {
	//if aiting on last request, prevent more requests
	if ($modal.attr("data-waiting") == 1) { 
		return;
	}

	//lock modal
	$modal.attr("data-waiting", 1);

	//reset alert, show loading
	$modal.find(".login-progress").removeClass("hidden");
	$modal.find(".login-response").addClass("hidden");

	//login
	login(
		$modal.find(".login-form .login-username").val(), 
		$modal.find(".login-form .login-password").val(),
		"",
		function(errorMsg) {
			$modal.attr("data-waiting", 0);
			$modal.find(".login-progress").addClass("hidden");

			//if error
			$modal.find(".login-response").removeClass("hidden")
				.children(".alert").text(errorMsg["error_msg"]);
		}
	);
}

$(document).ready(function() {
	

	var $loginModal = $("#login-modal").on("click", ".login-submit", function() {
		loginModalSubmit($loginModal);
	}).on("submit", "form.login-form", function() {
		loginModalSubmit($loginModal);
	});

});