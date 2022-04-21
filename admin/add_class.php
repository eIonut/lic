<?php
include('../dbconnection.php');

$course_names = '';
$lesson_subjectt = '';
$lesson_subject = '';
$lesson_number = '';
// $errors = array('lesson_subject' => '', 'lesson_number' => '');


$sql = 'SELECT course_name from courses';
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
    
        // create sql
        $sql = "INSERT INTO lessons(lesson_subject, lesson_number, pdf_location) VALUES ('$lesson_subject', '$lesson_number', '$final_file')";
    
   
          try{
        // save to db and check
        if(mysqli_query($con, $sql)){
            // success
            header('Location: index_admin.php');
        } else {
            echo 'query error: '. mysqli_error($con);
        }
    }catch(Exception $e) {
			
        echo 'Too many characters';
      }
    
        }
        
  
        $lesson_subject = $_POST['class-option'];
        $lesson_number = $_POST['lesson_number'];
 }
   

if(isset($_POST['submit_delete']))
{   
    $lesson_subjectt =  $_POST['lesson-delete-option'];
    print_r($lesson_subject);
   
        $query= "DELETE FROM `lessons` WHERE `lesson_number` = '$lesson_subjectt' ";
 
    

    if(mysqli_query($con, $query)){
        echo "Records were deleted successfully.";
    } else{
        echo "ERROR: Could not able to execute $query. " . mysqli_error($con);
    }
     
    // Close connection
    // mysqli_close($con);

        // save to db and check
        // if(mysqli_query($con, $sql)){
        //     // success
        //     header('Location: index_admin.php');
        // } else {
        //     echo 'query error: '. mysqli_error($con);
        // }
    
        // }
}

 
 $sql = "SELECT lesson_subject, lesson_number FROM lessons";

 //get the query result
 $result = mysqli_query($con, $sql);

 //fetch result in array format
 $lessons = mysqli_fetch_all($result, MYSQLI_ASSOC);
//  mysqli_free_result($result);

$sql = "SELECT lesson_number FROM lessons WHERE lesson_subject = 'HTML ONE'";

//get the query result
$result = mysqli_query($con, $sql);

//fetch result in array format
$lessons2 = mysqli_fetch_all($result, MYSQLI_ASSOC);
//  mysqli_free_result($result);



 


//  $sql = 'SELECT course_name from courses';
//  $result = mysqli_query($con, $sql);
//  $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
//  mysqli_free_result($result);
 

    //echo 'errors in form';



    // echo '<p>'.$doc['lesson_subject'].'</p>';
 
   
    // check title
   
// end POST check

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<section class="container grey-text">
		<h4 class="center">Add a Subject</h4>
		<form class="white" action="add_class.php" method="POST"  enctype="multipart/form-data">
			
			<label>Lesson Subject</label>

            <select name="class-option" id="">
            <?php
                foreach($courses as $course){ ?>
                <option value="<?php echo htmlspecialchars($course['course_name']);?>" name="class-option"><?php echo htmlspecialchars($course['course_name']);?></option>
            <?php } ?>
                
            </select>
			
            <label>Lesson Name</label>
            <input type="text" name="lesson_number">
            <label for="">File Upload</label>
            <input type="file" name="file">
           
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
	
<!-- SECOND FORM -->

        
<!-- 			
			<label>Course name</label> -->

            <!-- <select  name="course-delete-option" id="">
            <?php
                foreach($courses as $course){ ?>
                <option name="" value="<?php echo htmlspecialchars($course['course_name']);?>""><?php echo htmlspecialchars($course['course_name']);?></option>
            <?php } ?>
                
            </select> -->
			
            <label>Lesson Name</label>
           

          
            <select name="lesson-delete-option"id="">
            <?php
            foreach($lessons as $lesson){ ?>
             
                <option  name="" value="<?php echo htmlspecialchars($lesson['lesson_number']);?>"><?php echo htmlspecialchars($lesson['lesson_number']); echo " " . "-" . " "; echo htmlspecialchars($lesson['lesson_subject']);?></option>
           
            <?php } ?>
            </select>
           
           
			<div class="center">
				<input type="submit" name="submit_delete" value="Delete" class="btn brand z-depth-0">
			</div>
		</form>

	</section>

</body>
</html>