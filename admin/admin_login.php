<?php session_start();
require_once('../dbconnection.php');
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
    <link rel="stylesheet" href="../login.css" />
    <link
      rel="stylesheet"
      href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
      integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
      crossorigin="anonymous"
    />

    <title>Login</title>
  </head>
  <body>
    <main class="main-section">
      <section>
        <h1>Admin Login</h1>
        <form name="login"action="" method="post">
          <label for="user-input">Username</label>
          <i id="user-icon" class="far fa-user"></i>
          <input
            id="user-input"
            type="text"
            placeholder="Introduceti username-ul"
            name="username"
            required
          />
          <label for="user-password">Password</label>
          <i id="password-icon" class="far fa-lock"></i>
          <input
            id="user-password"
            type="password"
            placeholder="Introduceti parola"
            name="password"
            required
          />
          <i class="far fa-eye toggle-show-password"></i>
          <input
            class="login-btn"
            type="submit"
            name="login"
            value="Login"
          />
        </form>
        <div class="register-div">
          <p>Nu aveti cont?</p>
          <a id="register-link" href="">INREGISTRARE</a>
        </div>
      </section>
    </main>
  </body>
  <script src="login.js"></script>
</html>
