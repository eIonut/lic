<?php

	include('../dbconnection.php');

	$course_name = '';
	$errors = array('course_name' => '');

	if(isset($_POST['submit'])){
		
		// check email
		
		// check title
		if(empty($_POST['course_name'])){
			$errors['course_name'] = 'A name is required';
		} else{
			$course_name = $_POST['course_name'];
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
			$sql = "INSERT INTO courses(course_name) VALUES ('$course_name')";

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
		<h4 class="center">Add a Pizza</h4>
		<form class="white" action="add_course_admin.php" method="POST">
			
			<label>Course Title</label>
			<input type="text" name="course_name" value="<?php echo htmlspecialchars($course_name) ?>">
		
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

</html>