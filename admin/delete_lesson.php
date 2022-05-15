<?php
include 'includes.php';
include('../dbconnection.php');
?>

<link rel="stylesheet" href="css/coursePageQueries.css?v=addasddaddaddadadadddDdsddasdddaadsdaadadaddasassadadadaddaaddadaasdaddadadaaddadasasadasddaaas" />
<link rel="stylesheet" href="css/newCourse.css?v=ss03dasssdDDadadddddaaddadadaddaddaddaadddddddaadadadaaaddaadaaddadadddadasasdasasaddaasdasaddadadaasdadasddasas03sssssssdassdasdasssssssssssssssdadsassssssssssssss8b" />
<link rel="stylesheet" href="css/accordion.css?v=ss03ssdasdaDsdadddaa0ddadadadSdddadadaddadadddaddasdadaadadadsadasaddadasa3dadasdsssdassssssdadasdassssdassssssssssssssdassssssssssss8b" /> 

<?php
 $selsql = "SELECT * FROM lessons";
 $selres = mysqli_query($con, $selsql);
 $courses_array = mysqli_fetch_array($selres);

if(isset($_GET['id']) & !empty($_GET['id'])){
	$id = $_GET['id'];
 
	$delsql="DELETE FROM `lessons` WHERE id=$id";
	if(mysqli_query($con, $delsql)){
		header("Location: delete_course_admin.php?course_name=" .$courses_array["lesson_subject"]);
	}
}else{
	header('location: index_admin.php');
}
 
?>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>