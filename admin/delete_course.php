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


 $selsql2 = "SELECT * FROM assets";
 $selres2 = mysqli_query($con, $selsql2);



if(isset($_GET['id']) & !empty($_GET['id'])){
	$id = $_GET['id'];
 
	$delsql="DELETE FROM courses WHERE id=$id";
	if(mysqli_query($con, $delsql)){
		header("Location: index_admin.php");
	}
}else{
	header('location: index_admin.php');
}

$delsql2 = "DELETE FROM lessons WHERE lessons.course_id = $id";
	if(mysqli_query($con, $delsql2)){
		header("Location: index_admin.php");
	}
else{
	header('location: index_admin.php');
}


while($row = mysqli_fetch_assoc($selres)){
$lid = $row['id'];
$delsql3 = "DELETE FROM lessons_assets WHERE lessons_assets.lesson_id = $lid";
	if(mysqli_query($con, $delsql3)){
		header("Location: index_admin.php");
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