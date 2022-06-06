<?php include('app_logic.php'); 
include 'admin/includes.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Reset PHP</title>
</head>
<body>
<div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
	<form class="login-form" action="new_pass.php" method="post">
		<h3 class="form-title">New password</h3>
		<!-- form validation messages -->
		<?php include('messages.php'); ?>
		<div class="form-group">
			<label>New password</label>
			<input class="form-control"type="password" name="new_pass">
		</div>
		<div class="form-group">
			<label>Confirm new password</label>
			<input class="form-control"type="password" name="new_pass_c">
		</div>
		<div class="form-group">
		<input class="form-control reset-pass" type="submit" name="new_password" value="Reset password">
		</div>
	</form>
	</div>
        </div>
    </div>
	
</body>
<link rel="stylesheet" href="admin/css/enter_email.css?v=dsadaddadasdadaddssaasdaaaddaada" />

</html>