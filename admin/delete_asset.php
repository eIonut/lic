<?php
include 'includes.php';
include('../dbconnection.php');
?>

<link rel="stylesheet" href="css/coursePageQueries.css?v=addasddaddaddadadadddDdsddasdddaadsdaadadaddasassadadadaddaaddadaasdaddadadaaddadasasadasddaaas" />
<link rel="stylesheet" href="css/newCourse.css?v=ss03dasssdDDadadddddaaddadadaddaddaddaadddddddaadadadaaaddaadaaddadadddadasasdasasaddaasdasaddadadaasdadasddasas03sssssssdassdasdasssssssssssssssdadsassssssssssssss8b" />
<link rel="stylesheet" href="css/accordion.css?v=ss03ssdasdaDsdadddaa0ddadadadSdddadadaddadadddaddasdadaadadadsadasaddadasa3dadasdsssdassssssdadasdassssdassssssssssssssdassssssssssss8b" /> 

<?php

$sql1 = "SELECT assets.id as ai, lessons.id as li, lessons.course_id as ci from lessons_assets
INNER JOIN assets ON assets.id = lessons_assets.asset_id
INNER join  lessons ON lessons.id = lessons_assets.lesson_id
WHERE lessons_assets.lesson_id = lessons.id";
$ressql1 = mysqli_query($con, $sql1);
$ids = mysqli_fetch_array($ressql1);
$id_asset = $ids['ai'];
$id_lesson = $ids['li'];
$id_course = $ids['ci'];

//  $selsql = "SELECT * FROM lessons";
//  $selres = mysqli_query($con, $selsql);
//  $courses_array = mysqli_fetch_array($selres);
//  $id = $courses_array['id'];

//  $selsql2 = "SELECT * FROM assets";
//  $selres2 = mysqli_query($con, $selsql2);
//  $courses_array2 = mysqli_fetch_array($selres2);
//  $id2 = $courses_array2['id'];



	$delsql="DELETE FROM lessons_assets
	WHERE lessons_assets.lesson_id = $id_lesson AND lessons_assets.asset_id = $id_asset";

	if(mysqli_query($con, $delsql)){
		header("Location: delete_course_admin.php?id=" . $id_course);
	}
else{
	header('location: index_admin.php');
}

?>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

<body>

</body>