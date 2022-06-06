<?php
include 'admin/includes.php';
include('dbconnection.php');
unset($_SESSION);
$_SESSION = array();
session_unset();
session_start();
session_regenerate_id(TRUE); 

if (strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
}

if (!$con) {
    echo 'Connection error' . mysqli_connect_error();
}

?>

    
<?php

if(isset($_GET['id'])){
	//select query
	$id = $_GET['id'];
	$selsql = "SELECT * FROM reviews WHERE reviews.id=$id";
	$selres = mysqli_query($con, $selsql);
	$courses_array = mysqli_fetch_array($selres);

	
}

if(isset($_POST) & !empty($_POST)){
	$subject = mysqli_real_escape_string($con, $_POST['subject']);
	
	$id = $_GET['id'];
	$selsql = "SELECT * FROM reviews WHERE reviews.id=$id";
	$selres = mysqli_query($con, $selsql);
	$courses_array = mysqli_fetch_array($selres);

	date_default_timezone_set('Europe/Bucharest');
    $timestamp = date("Y-m-d H:i:s");

	$sql = "UPDATE reviews SET reviews.rating='$subject' WHERE reviews.id=$id";
	$res = mysqli_query($con, $sql) or die(mysqli_error($con));

	$sql2 = "UPDATE reviews SET reviews.update_at='$timestamp' WHERE reviews.id=$id";
	$res2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
	if($res){
		$smsg = "Comment updated Successfully";
		header("Location: coursePage.php?id=" . $courses_array["course_id"]);
	}else{
		$fmsg = "Failed to update Comment";
	}

	if($res2){
		$smg = "COmment updated successfully";
		header("Location: coursePage.php?id=" . $courses_array["course_id"]);
	}
	else{
		$fmsg = "Failed to update comment";
	}
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
	<link rel="stylesheet" href="admin/css/coursePageQueries.css?v=addasddaddaddadadadddDdsddasdddaadsdaadadaddasassadadadaddaaddadaasdaddadadaaddadasasadasddaaas" />
	<link rel="stylesheet" href="admin/css/newCourse.css?v=ss03dasssdDDadadddddaaddadadaddaddaddaadddddddaadadadaaaddaadaaddadadddadasasdasasaddaasdasaddadadaasdadasddasas03sssssssdassdasdasssssssssssssssdadsassssssssssssss8b" />
	<link rel="stylesheet" href="admin/css/accordion.css?v=ss03ssdasdaDsdadddaa0ddadadadSdddadadaddadadddaddasdadaadadadsadasaddadasa3dadasdsssdassssssdadasdassssdassssssssssssssdassssssssssss8b" /> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
</head>
<body>
	 <div class="row d-flex mx-auto ap-0" style="width: 45%; height: fit-content; margin-top: 6rem;">
     <div class="col  p-3 w-50" style="height: fit-content; border-radius: 6px; background:rgba(48, 83, 151, 0.75);">
	 <form id="edit-comment-form" class="w-100 h-100 p-3 m-0" method="post">
		<div class="form-group">
			<p class="text-light">Your comment: <?php echo $courses_array['rating']; ?></p>
			<label class="text-light" for="exampleInputPassword1">Enter your new comment</label>
			<input type="text" name="subject" class="form-control mt-4 mb-4 font-weight-bold" rows="6" required value="<?php echo $courses_array['rating'] ?>"></input>
		</div>
		<div class="d-flex flex-row justify-content-start">
			<button id="submit-btn" type="submit" class="btn btn-default mt-2 font-weight-bold ">Submit</button>
			<button class="btn btn-default mt-2 font-weight-bold mx-4 text-muted"><a href="delete_course_admin.php?course_name=<?php echo $courses_array['course_id'] ?>"></a>Back to course</button>
		</div>
	</form>
	</div>
    </div>
</div>
</body>
</html>