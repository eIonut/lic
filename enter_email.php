<?php include('app_logic.php'); 
include 'admin/includes.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Reset</title>
</head>

<body>
<div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
				<form class="login-form" action="enter_email.php" method="post">
					<h3 class="form-title">Reset password</h3>
					<?php include('messages.php'); ?>
					<div class="form-group d-flex flex-column">
						<label>Your email address</label>
						<input class="form-control" type="email" name="email">
					</div>
					<div class="form-group">
						<input class="form-control reset-pass" type="submit" name="reset-password" value="Next">
					</div>
				</form>
			</div>
        </div>
    </div>
</body>
<link rel="stylesheet" href="admin/css/enter_email.css?v=dsadaddadasdadaddsasdaaaddaada" />

</html>

