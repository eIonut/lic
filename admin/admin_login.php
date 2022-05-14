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
echo "<script>alert('Invalid username or password');</script>";
$extra="admin_register.php";
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
//header("location:http://$host$uri/$extra");
exit();
}
}
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="stylesheet" href="css/admin_login.css?v=esdasdasdassada0sss" />
   

    <title>Login</title>
  </head>
  <body>
    <div class="login-form row d-flex mx-auto" style="width: 65%; margin-top: 6rem; box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
      <div class="col mt-auto order-md-1">
          <form class="d-flex flex-column justify-content-center align-items-center 
          w-100 h-100 form-group p-3 m-0 py-0"
           name="login"action="" method="post">
          <h1 class="w-100 text-left" style="opacity: 0.75;" >Admin Login</h1>
            <label class="text-left w-100 py-3 m-0" for="user-input">Username</label>
            <input
              class="form-control border-0"
              id="user-input"
              type="text"
              placeholder="Enter username"
              name="username"
              required
              style="border-radius: 25px;"
            />
            <label class="text-left w-100 py-3 m-0"  for="user-password">Password</label>
          
            <input
              class="form-control border-0"
              id="user-password"
              type="password"
              placeholder="Enter password"
              name="password"
              required
              style="border-radius: 25px;"
            />
          
            <input
              class="login-btn btn my-3 btn-block text-light"
              type="submit"
              name="login"
              value="Login"
              style="border-radius: 25px;background:rgba(48, 83, 151, 0.75);"
            />
            
          </form>
</div>

          <div class="col d-flex flex-column justify-content-center align-items-center welcome-login order-md-2"
          style="background:rgba(48, 83, 151, 0.75);">
         
          <h1 class="text-light text-center" >Welcome to login</h1>
            <p class="text-white" >Don't have an account?</p>
            <a class="btn btn-danger bg-transparent pt-2 px-3 border border-light" 
            style="border-radius: 25px;"
             id="register-link" href="admin_register.php">Sign up</a>
        
        
         
        </div>
        </div>
     
      
    
  </body>
  <script src="login.js"></script>
</html>
