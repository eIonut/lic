<?php session_start();
require_once('../dbconnection.php');
include 'includes.php';
// Code for login 
if(isset($_POST['login']))
{
$password=$_POST['password'];
$username=$_POST['username'];
$dec_password=md5($password);
$ret= mysqli_query($con,"SELECT * FROM admins WHERE username='$username' and password='$dec_password'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$extra="index_admin.php";
$_SESSION['login_admin']=$_POST['username'];
$_SESSION['id']=$num['id'];
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
	echo '<div class="mx-auto bg-danger p-1 text-light" style="position: relative; top: 68%; border-radius: 4px; left:0; z-index: 9999; width: fit-content;" >Invalid username or password</div>';

}
}
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="stylesheet" href="css/new_login.css?v=sdasdads" />
   

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
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login" value="Login">
                    </div>
                    <div class="link login-link text-center">Not having an account? <a href="admin_register.php">Register here</a></div>
                </form>
            </div>
        </div>
    </div>
    
    
  </body>
  <script src="login.js"></script>
</html>
