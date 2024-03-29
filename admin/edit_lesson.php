<?php
include 'includes.php';
include('../dbconnection.php');
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
?>

<?php

if(isset($_GET['id']) & !empty($_GET['id'])){
	$id = $_GET['id'];
	$selsql = "SELECT * FROM lessons WHERE id=$id";
	$selres = mysqli_query($con, $selsql);
	$courses_array = mysqli_fetch_array($selres);
    
	$sql = "SELECT courses.id as cd from courses
	INNER JOIN lessons ON lessons.course_id = courses.id
	WHERE lessons.course_id = courses.id";
	$result = mysqli_query($con, $sql);
	$cid = mysqli_fetch_array($result);
}

if(isset($_POST) & !empty($_POST)){
	$lesson_edit = mysqli_real_escape_string($con, $_POST['lesson-edit']);
	$lesson_order = mysqli_real_escape_string($con, $_POST['lesson-order']);
	$sql = "UPDATE lessons SET name='$lesson_edit' WHERE id=$id";
	$res = mysqli_query($con, $sql) or die(mysqli_error($con));
	if($res){
		$smsg = "Lesson updated Successfully";
		header("Location: delete_course_admin.php?id=" .$courses_array["course_id"]);
	}else{
		$fmsg = "Failed to update Lesson";
	}

	$sql2 = "UPDATE lessons SET lesson_order='$lesson_order' WHERE id=$id";
	$res2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" href="styles.css" >
	<link rel="stylesheet" href="css/fonts.css" /> 
	<link rel="stylesheet" href="css/coursePageQueries.css?v=addasddaddaddadadadddDdsddasdddaadsdaadadaddasassadadadaddaaddadaasdaddadadaaddadasasadasddaaas" />
	<link rel="stylesheet" href="css/newCourse.css?v=ss03dasssdDDadadddddaaddadadaddaddaddaadddddddaadadadaaaddaadaaddadadddadasasdasasaddaasdasaddadadaasdadasddasas03sssssssdassdasdasssssssssssssssdadsassssssssssssss8b" />
	<link rel="stylesheet" href="css/accordion.css?v=ss03ssdasdaDsdadddaa0ddadadadSdddadadaddadadddaddasdadaadadadsadasaddadasa3dadasdsssdassssssdadasdassssdassssssssssssssdassssssssssss8b" /> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
</head>
<body>
    

		  
		 
	 <div class="row d-flex mx-auto ap-0" style="width: 45%; height: fit-content; margin-top: 6rem;">
      <div class="col  p-3 w-50" style="height: fit-content; border-radius: 6px; background:rgba(48, 83, 151, 0.75);">
	  <form id="edit-lesson-form" class="w-100 h-100 p-3 m-0" method="post">

<div class="form-group">
<label class="text-light" for="lessonOrder">Enter lesson order</label>
  <input type="number" min="1" name="lesson-order" class="form-control mt-4 mb-4 font-weight-bold" rows="6" required value="<?php echo $courses_array['lesson_order']?>"></input>

  <label class="text-light" for="exampleInputPassword1">Enter new lesson name</label>
  <input type="text" name="lesson-edit" class="form-control mt-4 mb-4 font-weight-bold" rows="6" required value="<?php echo $courses_array['name']?>"></input>
</div>
<div class="d-flex flex-row justify-content-center align-items-center">
<button id="submit-btn" type="submit" class="btn btn-default mt-2 font-weight-bold ">Submit</button>
<button class="btn btn-default mt-2 font-weight-bold ml-1 text-muted" style="width: fit-content"><a href="delete_course_admin.php?id=<?php echo $cid['cd'] ?>"></a>Back to course</button>

</div>
</form>
</div>

         
        </div>

	
</div>
</body>
<script>

</script>
</html>