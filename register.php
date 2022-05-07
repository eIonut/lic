<?php session_start();
require_once('dbconnection.php');

//Code for Registration 
if(isset($_POST['signup']))
{

	$username=$_POST['username'];
	$email=$_POST['email'];
	$password=$_POST['password'];
 


$sql=mysqli_query($con,"select id from users where email='$email'");
$row=mysqli_num_rows($sql);
$hashed_password = md5($password);
if($row>0)
{
	echo "<script>alert('Email id already exist with another account. Please try with other email id');</script>";
} else{
	$msg=mysqli_query($con,"insert into users(email,password,username) values('$email','$hashed_password','$username')");

if($msg)
{
	echo "<script>alert('Register successfully');</script>";
}
}
}

//


?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="register.css" />
    <link
      rel="stylesheet"
      href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
      integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
      crossorigin="anonymous"
    />

    <title>Register</title>
  </head>
  <body>
    <main class="main-section">
      <section>
        <h1>Register</h1>
        <form name="registration" method="post" action="" enctype="multipart/form-data">

          <label for="user-input">Username</label>
          <i id="user-icon" class="far fa-user"></i>
          <input
            id="user-input"
            type="text"
            placeholder="Introduceti username-ul"
            required
            name="username"
            value=""
          />
          <label for="user-email">Email</label>
          <i id="email-icon" class="far fa-envelope"></i>
          <input
            id="user-email"
            type="email"
            required
            placeholder="Introduceti email-ul"
            name="email"
            value=""
          />
          <label for="user-password">Password</label>
          <i id="password-icon" class="far fa-lock"></i>
          <input
            id="user-password"
            type="password"
            placeholder="Introduceti parola"
            required
            name="password"
            value=""
          />
          <i class="far fa-eye toggle-show-password"></i>
          <input
            class="register-btn"
            type="submit"
            name="signup"
            value="Register"
          />
        </form>
        <div class="register-div">
          <p>Aveti deja cont?</p>
          <a id="register-link" href="login.php">Logati-va</a>
        </div>
      </section>
    </main>
  </body>
  <script src="login.js"></script>
</html>

