
<?php

include('../dbconnection.php');
include 'includes.php';
unset($_SESSION);
$_SESSION = array();
session_unset();
session_start();
session_regenerate_id(TRUE);

if (strlen($_SESSION['id'] == 0)) {
    header('location:logout_admin.php');
}

if (!$con) {
    echo 'Connection error' . mysqli_connect_error();
}

if(isset($_POST['submit']))
{   
     
 $file = $_FILES['file']['name'];
$file_loc = $_FILES['file']['tmp_name'];
 $file_size = $_FILES['file']['size'];
 $file_type = $_FILES['file']['type'];
 $folder="../images/";
 $new_size = $file_size/1024;  

 $new_file_name = strtolower($file);
 
 $final_file=str_replace(' ','-',$new_file_name);

 if(move_uploaded_file($file_loc,$folder.$final_file))
 {
        $sql2 = "INSERT INTO assets(url, type) 
        VALUES ('$final_file', '$file_type')";

          try{

        if(mysqli_query($con, $sql2)){
            header('Location: add_lesson.php');
        } else {
            echo 'query error: '. mysqli_error($con);
        }

    }catch(Exception $e) {
			
        echo 'Too many characters';
      }
    
        }
 }
 
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a File</title>
</head>
<body style="  background: rgba(48, 83, 151, 0.75);">

<div class="container">
        <div class="row">
            <div class="form">

            <h4 class="center font-weight-bold" style="opacity: 0.75;">Add a new file</h4>
            <form class="m-0" action="add_asset.php" method="POST"  enctype="multipart/form-data">
                <div class="form-group">		
                    <label class="font-weight-bold"for="">File Upload</label>
                    <input type="file" class="form-control" name="file" required>
                </div>
           <div class="form-group py-3 m-0 pb-0">
				<input style="background: rgba(48, 83, 151, 0.75); border: none;"type="submit" name="submit" value="Submit" class="w-100 btn btn-primary text-light mx-auto text-center z-depth-0">
                <p class="mx-auto w-100 text-center py-3 m-0 font-weight-bold">OR</p>
				<a style="background: rgba(48, 83,151, 0.75); border: none;" class="btn btn-primary text-light mx-auto w-100" href="index_admin.php">Go back to courses</a>
			</div>
            </form>
            </div>
        </div>
    </div>


</body>
<link rel="stylesheet" href="css/new_login.css?v=sdsafafadassasds" />

</html>