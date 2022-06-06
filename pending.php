<?php include('app_logic.php');
include 'admin/includes.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Reset PHP</title>
	<link rel="stylesheet" href="admin/css/pending.css?v=dsadadadaddadasdasdadaddsasdaaaddaada" />

</head>
<body>

	<form class="login-form pt-5 px-2 text-light" action="login.php" method="post" style="text-align: center;">
		<p>
			We sent an email to  <b><?php echo '<span class="text-dark">' . $_GET['email'] .'</span>' ?></b> to help you recover your account. 
		</p>
	    <p>Please login into your email account and click on the link we sent to reset your password.</p>
	</form>
		
</body>

</html>