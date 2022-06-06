<?php session_start();
require_once('dbconnection.php');
include 'admin/includes.php'; 
//Code for Registration 
if(isset($_POST['signup']))
{

  $password = mysqli_real_escape_string($con, $_POST['password']);
$username = mysqli_real_escape_string($con, $_POST['username']);

$email = mysqli_real_escape_string($con, $_POST['email']);
$name = mysqli_real_escape_string($con, $_POST['name']);

  $role = 0;
 


$sql=mysqli_query($con,"select id from users where username='$username' and role='$role'");
$row=mysqli_num_rows($sql);
$password = md5($password);
if($row>0)
{
	echo '<div class="mx-auto bg-danger p-1 text-light" style="position: relative; top: 77%; border-radius: 4px; left:0; z-index: 9999; width: fit-content;" >This Email/Username is already taken</div>';
} else{
	$msg=mysqli_query($con,"insert into users(role, email,password,username,name) values('$role', '$email','$password','$username', '$name')");

if($msg)
{
  echo '<div class="mx-auto bg-success p-1 text-light" style="position: relative; top: 77%; border-radius: 4px; left:0; z-index: 9999; width: fit-content;" >Registered successfuly</div>';

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
    <link rel="stylesheet" href="admin/css/new_login.css?v=dsadadada" />
    <link
      rel="stylesheet"
      href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
      integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
      crossorigin="anonymous"
    />

    <title>Register User</title>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form  method="POST" autocomplete="">
                    <h2 class="text-center">Signup Form</h2>
                    <p class="text-center">It's quick and easy.</p>
                    
                    
                    <div class="form-group">
                        <input class="form-control" type="text" name="username" placeholder="Username" required value="">
                        <i class="fa-solid fa-user" style="position: relative; top: -27px;right: -93%; opacity: 0.5;"></i>

                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="name" placeholder="Name" required value="">
                        <i class="fa-solid fa-envelope" style="position: relative; top: -27px;right: -93%; opacity: 0.5;"></i>

                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email Address" required value="">
                        <i class="fa-solid fa-envelope" style="position: relative; top: -27px;right: -93%; opacity: 0.5;"></i>

                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                        <i class="fa-solid fa-key" style="position: relative; top: -27px;right: -93%; opacity: 0.5;"></i>

                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="signup" value="Signup">
                    </div>
                    <div class="text-center">Already a member? <a class="link login-link"href="login.php">Login here.</a></div>
                </form>
            </div>
        </div>
    </div>
    
  </body>

  
</html>

