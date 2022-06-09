<?php session_start();
require_once('dbconnection.php');
include 'admin/includes.php'; 
if(isset($_POST['login']))
{

$password = mysqli_real_escape_string($con, $_POST['password']);
$username = mysqli_real_escape_string($con, $_POST['username']);
$password = md5($password);

$role = 0;

$ret= mysqli_query($con, "SELECT * FROM users WHERE username = '$username' AND password='$password' AND role='$role'");

$num=mysqli_fetch_array($ret);

if($num>0)
{
$extra="index.php";
$_SESSION['login_user']=$_POST['username'];
$_SESSION['id']=$num['id'];
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
	echo '<div class="mx-auto bg-danger p-1 text-light" style="position: relative; top: 67.5%; border-radius: 4px; left:0; z-index: 9999; width: fit-content;" >Invalid username or password</div>';

}
}
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="stylesheet" href="admin/css/new_login.css?v=sdaczxsxsds" />
   

    <title>Login</title>
  </head>
  <body> 
        <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form method="POST" autocomplete="">
                    <h2 class="text-center">Login</h2>
                    
                    <div class="form-group">
                        <input class="form-control w-100" type="text" name="username" placeholder="Username" required value="">
                        <i class="fa-solid fa-user" style="position: relative; top: -27px;right: -93%; opacity: 0.5;"></i>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                        <i class="fa-solid fa-key" style="position: relative; top: -27px;right: -93%; opacity: 0.5;"></i>
                        <div>
                        <a class="link login-link"href="enter_email.php">Forgot your password?</a>
                    </div>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login" value="Login">
                    </div>
                    <div class="text-center">Not having an account? <a class="link login-link"href="register.php">Register here.</a></div>
                    
                </form>
            </div>
        </div>
    </div>
    
  </body>
  <script src="login.js"></script>
</html>
