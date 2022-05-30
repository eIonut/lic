
<?php

include('../dbconnection.php');
include 'includes.php';
$course_names = '';
$lesson_subjectt = '';
$lesson_subject = '';
$lesson_number = '';

$sql = 'SELECT * from courses';
$result = mysqli_query($con, $sql);
$courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);



if(isset($_POST['submit']))
{   
     
 $file = $_FILES['file']['name'];
$file_loc = $_FILES['file']['tmp_name'];
 $file_size = $_FILES['file']['size'];
 $file_type = $_FILES['file']['type'];
 $folder="../images/";
 /* new file size in KB */
 $new_size = $file_size/1024;  
 /* new file size in KB */
 
 /* make file name in lower case */
 $new_file_name = strtolower($file);
 /* make file name in lower case */
 
 $final_file=str_replace(' ','-',$new_file_name);

 if(move_uploaded_file($file_loc,$folder.$final_file))
 {
        // escape sql chars
    
        $lesson_subject = mysqli_real_escape_string($con, $_POST['class-option']);
        $lesson_number = mysqli_real_escape_string($con, $_POST['lesson_number']);
        $lesson_order = mysqli_real_escape_string($con, $_POST['lesson_order']);

       

        $sql = "INSERT INTO lessons(course_id, name, lesson_order)
        VALUES ('$lesson_subject', '$lesson_number', '$lesson_order')";

        $sql2 = "INSERT INTO assets(url, type, course_id) 
        VALUES ('$final_file', '$file_type', '$lesson_subject')";

$sql3 = "SELECT * from lessons WHERE course_id = '$lesson_subject'";
$result3 = mysqli_query($con, $sql3);
$res3 = mysqli_fetch_assoc($result3);


          try{
        // save to db and check
        if(mysqli_query($con, $sql)){
            // success
            header('Location: delete_course_admin.php?id=' . $lesson_subject);
        } else {
            echo 'query error: '. mysqli_error($con);
        }

        if(mysqli_query($con, $sql2)){
            header('Location: delete_course_admin.php?id=' . $lesson_subject);
        } else {
            echo 'query error: '. mysqli_error($con);
        }

        if(mysqli_query($con, $sql3)){
            header('Location: delete_course_admin.php?id=' . $lesson_subject);
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
    <title>Document</title>
</head>
<body style="  background: rgba(48, 83, 151, 0.75);">

<div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">

            <h4 class="center font-weight-bold" style="opacity: 0.75;">Add a new subject</h4>
                <form class="m-0" action="add_class.php" method="POST"  enctype="multipart/form-data">
                <div class="form-group">
			<label class="font-weight-bold" for="class-option">Lesson Subject</label>
            <select class="form-control w-100"name="class-option" id="class-option">
            
            <?php
                foreach($courses as $course){ ?>
                <option value="<?php echo $course['id'];?>" name="class-option"><?php echo ($course['name']); echo $course['id']?></option>
            <?php } ?>
                
            </select>
            </div>
			
            <div class="form-group">
                <label class="font-weight-bold">Lesson Name</label>
                <input class="form-control w-100"type="text" name="lesson_number">
            </div>
            <div class="form-group">
                <label class="font-weight-bold"for="">Lesson Order</label>
                <input class="form-control w-100" type="number" name="lesson_order">
            </div>
           
            <div class="form-group">
                <label class="font-weight-bold"for="">File Upload</label>
                <input type="file" class="form-control" name="file">
            </div>
           
			<div class="form-group py-3 m-0 pb-0">
				<input style="background: rgba(48, 83, 151, 0.75); border: none;"type="submit" name="submit" value="Submit" class="w-100 btn btn-primary text-light mx-auto text-center z-depth-0">
                <p class="mx-auto w-100 text-center py-3 m-0 font-weight-bold">OR</p>
				<a style="background: rgba(48, 83,151, 0.75); border: none;" class="btn btn-primary text-light mx-auto w-100" href="index_admin.php">Go back to courses</a>
			</div>
	

            </div>
        </div>
    </div>


</body>
<link rel="stylesheet" href="css/new_login.css?v=sdsafafadassasds" />

</html>