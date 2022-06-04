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

	$selsql2 = "SELECT * FROM reviews WHERE reviews.id=$id";
	$selres2 = mysqli_query($con, $selsql2);
	$courses_array2 = mysqli_fetch_array($selres2);
	
	$selsql = "SELECT lessons.course_id FROM lessons
	INNER JOIN courses ON courses.id = lessons.course_id
	INNER JOIN reviews ON reviews.course_id = courses.id
	WHERE courses.id = lessons.course_id";
	$selres = mysqli_query($con, $selsql);
	$courses_array = mysqli_fetch_assoc($selres);

	$asdfg = $_SESSION['login_admin'];
	$sql3 = "SELECT * from users WHERE users.username = '$asdfg'";
                                            $result3 = mysqli_query($con, $sql3);
                                            $rows = mysqli_fetch_assoc($result3);
                                            $user_id = $rows['id'];
											
	
	

	$delsql="DELETE FROM reviews WHERE reviews.id = $id";
	if(mysqli_query($con, $delsql)){
		// header("Location: index_admin.php");
		header("Location: delete_course_admin.php?id=" . $courses_array2['course_id']);
		}
}else{
	header('location: index_admin.php');
}
 
?>