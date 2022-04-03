<?php
include('../dbconnection.php');

$lesson_subject = '';
$lesson_number = '';
$errors = array('lesson_subject' => '', 'lesson_number' => '');

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
    
        // save to db and check
        if(mysqli_query($con, $sql)){
            // success
            header('Location: index_admin.php');
        } else {
            echo 'query error: '. mysqli_error($con);
        }
    
        }
        
  
 }

 if(empty($_POST['class-option']) || (empty($_POST['lesson_number']))){
    $errors['lesson_number'] = 'A number is required';
} else{
    $lesson_subject = $_POST['class-option'];
    $lesson_number = $_POST['lesson_number'];

}


    //echo 'errors in form';


    $sql = "SELECT * FROM lessons";

    //get the query result
    $result = mysqli_query($con, $sql);

    //fetch result in array format
    $doc = mysqli_fetch_assoc($result);

    mysqli_free_result($result);


    $sql = 'SELECT course_name from courses';
        $result = mysqli_query($con, $sql);
        $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($con);
 
   
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
			
            <label>Lesson Number</label>
            <input type="text" name="lesson_number" value="">
            <label for="">File Upload</label>
            <input type="file" name="file">
           
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>

      
	</section>

</body>
</html>