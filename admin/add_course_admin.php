<?php

	include('../dbconnection.php');

	$course_name = '';
	$course_description = '';
	$course_image = '';
	$errors = array('course_name' => '');

	if(isset($_POST['submit'])){
		
		// image
		
		$name = $_FILES['file']['name'];
  $target_dir = "upload/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);

  // Select file type
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("jpg","jpeg","png","gif");

  // Check extension
  if( in_array($imageFileType,$extensions_arr) ){
     // Upload file
    //  if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)){
    //     // Insert record
    //     $query = "insert into courses(course_image) values('".$name."')";
    //     mysqli_query($con,$query);
    //  }

  }
	
	
		
		// check title
		if(empty($_POST['course_name'])){
			$errors['course_name'] = 'A name is required';
		} else{
			$course_name = $_POST['course_name'];
			$course_description = $_POST['course-description'];
			$course_image = $_POST['course_image'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $course_name)){
				$errors['course_name'] = 'Course name must be letters and spaces only';
			}
		}

		if(array_filter($errors)){
			//echo 'errors in form';
		} else {
			// escape sql chars
		
			$course_name = mysqli_real_escape_string($con, $_POST['course_name']);
			

			// create sql
			$sql = "INSERT INTO courses(course_name, course_description, course_image) VALUES ('$course_name', '$course_description', '$name')";

			// save to db and check
			if(mysqli_query($con, $sql)){
				// success
				header('Location: index_admin.php');
			} else {
				echo 'query error: '. mysqli_error($con);
			}
		
		}

	} // end POST check

?>


<!DOCTYPE html>
<html>
	
	

	<section class="container grey-text">
		<h4 class="center">Add a Course</h4>
		<form class="white" action="add_course_admin.php" method="POST"  enctype="multipart/form-data">>
			
			<label>Course Title</label>
			<input type="text" name="course_name" value="<?php echo htmlspecialchars($course_name) ?>">

			<label for="course-description">Course Description</label>
			<input type="text" name="course-description" value="<?php echo htmlspecialchars($course_description) ?>">
			<label for="course_image">Select an image for the course</label>

			<!-- ADD IMAGE for the course -->
			<input type="file" 
                   name="file" 
            />

			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

</html>