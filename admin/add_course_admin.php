
<?php

	include('../dbconnection.php');
	include 'includes.php';
	unset($_SESSION);
$_SESSION = array();
session_unset();
session_start();
session_regenerate_id(TRUE); //THIS DOES THE TRICK! Calling it after session_start. Dunno if true makes a difference.

if (strlen($_SESSION['id'] == 0)) {
    header('location:logout_admin.php');
}

if (!$con) {
    echo 'Connection error' . mysqli_connect_error();
}

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
				<p class="text-center">Course name must be letters, numbers and spaces only!</p>
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



<link rel="stylesheet" href="css/modals.css?v=esss0das3rsddadaszdass0c3d8b" />
<link rel="stylesheet" href="css/new_login.css?v=sdsafaddaafadadadassasds" />


<!DOCTYPE html>
<html>
	
	<body>
		
	<div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
				<h4 class="center font-weight-bold" style="opacity: 0.75;">Add a new course</h4>
		<form action="add_course_admin.php" method="POST"  enctype="multipart/form-data">
		<div class="form-group">
			<label class="font-weight-bold">Course Title</label>
			<input class="form-control" type="text" name="name" maxlength="50" value="<?php echo htmlspecialchars($name) ?>">
			</div>

			<div class="form-group">
			<label class="font-weight-bold" for="description">Course Description</label>
			<input class="form-control" type="text" name="description" value="<?php echo htmlspecialchars($description) ?>">
			</div>

			<div class="form-group">
			<label  class="font-weight-bold" for="image">Select an image for the course</label>

			<!-- ADD IMAGE for the course -->
			<input class="form-control" type="file" 
                   name="file" 
				   required
            />
			</div>

			<div class="form-group py-3 m-0 pb-0">
						<input style="background: rgba(48, 83, 151, 0.75); border: none;" class="form-control text-light" type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
						<p class="mx-auto w-100 text-center py-3 m-0 font-weight-bold">OR</p>
						<a style="background: rgba(48, 83,151, 0.75); border: none;" class="btn btn-primary text-light mx-auto w-100" href="index_admin.php">Go back to courses</a>
					</div>
		</form>
	</section>
	</body>
	<script src="js/addCourseModal.js?v=dasddadaaddaasdadasda"></script>
</html>