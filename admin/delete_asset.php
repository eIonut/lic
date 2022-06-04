<?php
include 'includes.php';
include('../dbconnection.php');
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

?>

<link rel="stylesheet" href="css/coursePageQueries.css?v=addasddaddaddadadadddDdsddasdddaadsdaadadaddasassadadadaddaaddadaasdaddadadaaddadasasadasddaaas" />
<link rel="stylesheet" href="css/newCourse.css?v=ss03dasssdDDadadddddaaddadadaddaddaddaadddddddaadadadaaaddaadaaddadadddadasasdasasaddaasdasaddadadaasdadasddasas03sssssssdassdasdasssssssssssssssdadsassssssssssssss8b" />
<link rel="stylesheet" href="css/accordion.css?v=ss03ssdasdaDsdadddaa0ddadadadSdddadadaddadadddaddasdadaadadadsadasaddadasa3dadasdsssdassssssdadasdassssdassssssssssssssdassssssssssss8b" /> 

<?php
if(isset($_GET['id'])){
	$id = $_GET['id'];


$selsql3 = "SELECT * FROM lessons_assets
INNER JOIN lessons on lessons.id = lessons_assets.lesson_id
WHERE lessons_assets.id=$id";

$selres3 = mysqli_query($con, $selsql3);
$courses_array3 = mysqli_fetch_array($selres3);


	$delsql="DELETE FROM lessons_assets WHERE lessons_assets.id = $id";

	if(mysqli_query($con, $delsql)){
		header("Location: delete_course_admin.php?id=" . $courses_array3['course_id']);
	}
else{
	header('location: index_admin.php');
}
}

?>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

<body>

</body>