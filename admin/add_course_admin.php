<link rel="stylesheet" href="css/modals.css?v=esss0s3rsszss0c3d8b" />
<?php

	include('../dbconnection.php');

	$name = '';
	$description = '';
	$image = '';
	$errors = array('name' => '');

	if(isset($_POST['submit'])){
		
		// image
		
  $file_name = $_FILES['file']['name'];
  $target_dir = "upload/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);

  // Select file type
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("jpg","jpeg","png","gif");

  // Check extension
  if( in_array($imageFileType,$extensions_arr) ){
     // Upload file
     if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$file_name)){
        // Insert record
        // $query = "insert into courses(course_image) values('".$name."')";
     }

  }
	
	
		
		// check title
		if(empty($_POST['name'])){
			$errors['name'] = 'A name is required';
		} else{
			$name = $_POST['name'];
			$description = $_POST['description'];
			if(!preg_match('/^[a-zA-Z0-9\s]+$/', $name)){
				$errors['name'] = 'Course name must be letters, numbers and spaces only';
				echo '<div class="modal">
			<p>Course name must be letters, numbers and spaces only!</p>
			<a href="javascript:void(0)" class="closebtn">&times;</a>
			</div>';
			}
		}

		if(array_filter($errors)){
			// echo 'errors in form';
		} else {
			// escape sql chars
		
			$name = mysqli_real_escape_string($con, $_POST['name']);
			

			// create sql
			$sql = "INSERT INTO courses(name, description, image) VALUES ('$name', '$description', '$file_name')";

			// save to db and check

			try{
			if(mysqli_query($con, $sql)){
			
				// success
				header('Location: index_admin.php');

				
			
						} else {
				echo '<div class="modal">
			<p>Please choose another name for the course. This one is already taken!</p>
			<a href="javascript:void(0)" class="closebtn">&times;</a>
			</div>';
			}
		}catch(Exception $e) {
			
			echo '<div class="modal">
			<p>Please choose another name for the course. This one is already taken!</p>
			<a href="javascript:void(0)" class="closebtn">&times;</a>
			</div>';
		  }
		
		}

	} // end POST check

?>


<!DOCTYPE html>
<html>
	
	<body>
		
	

	<section class="container grey-text">
		<h4 class="center">Add a Course</h4>
		<form class="white" action="add_course_admin.php" method="POST"  enctype="multipart/form-data">>
			
			<label>Course Title</label>
			<input type="text" name="name" maxlength="50" value="<?php echo htmlspecialchars($name) ?>">

			<label for="description">Course Description</label>
			<input type="text" name="description" value="<?php echo htmlspecialchars($description) ?>">
			<label for="image">Select an image for the course</label>

			<!-- ADD IMAGE for the course -->
			<input type="file" 
                   name="file" 
				   required
            />

			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>
	</body>
	<script src="js/addCourseModal.js"></script>
</html>