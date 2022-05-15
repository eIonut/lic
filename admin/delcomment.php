<?php
include 'includes.php';
include('../dbconnection.php');
?>

<link rel="stylesheet" href="css/coursePageQueries.css?v=addasddaddaddadadadddDdsddasdddaadsdaadadaddasassadadadaddaaddadaasdaddadadaaddadasasadasddaaas" />
<link rel="stylesheet" href="css/newCourse.css?v=ss03dasssdDDadadddddaaddadadaddaddaddaadddddddaadadadaaaddaadaaddadadddadasasdasasaddaasdasaddadadaasdadasddasas03sssssssdassdasdasssssssssssssssdadsassssssssssssss8b" />
<link rel="stylesheet" href="css/accordion.css?v=ss03ssdasdaDsdadddaa0ddadadadSdddadadaddadadddaddasdadaadadadsadasaddadasa3dadasdsssdassssssdadasdassssdassssssssssssssdassssssssssss8b" /> 

<?php
 
if(isset($_GET['id']) & !empty($_GET['id'])){
	$id = $_GET['id'];
	$selsql = "SELECT * FROM comments WHERE comment_id=$id";
	$selres = mysqli_query($con, $selsql);
	$courses_array = mysqli_fetch_array($selres);
   
	$delsql="DELETE FROM `comments` WHERE comment_id=$id";
	if(mysqli_query($con, $delsql)){
		header("Location: delete_course_admin.php?course_name=" .$courses_array["course_name"]);	}
}else{
	header('location: index_admin.php');
}
 
?>