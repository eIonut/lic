<?php
unset($_SESSION);
$_SESSION = array();
session_unset();
session_start();
session_regenerate_id(TRUE); //THIS DOES THE TRICK! Calling it after session_start. Dunno if true makes a difference.
include 'includes.php';
?>

<link rel="stylesheet" href="css/coursePageQueries.css?v=addddadasdaasddaddadadaddadadadddDdsddasdddaadsdaadadaddasassadadadaddaaddadaasdaddadadaaddadasasadasddaaas" />
<link rel="stylesheet" href="css/newCourse.css?v=ss03dasssdDDadadddddaaddadadaddaddaddaadddddddaadadadaaaddaadaaddadadddadasasdasasaddaasdasaddadadaasdadasddasas03sssssssdassdasdasssssssssssssssdadsassssssssssssss8b" />
<link rel="stylesheet" href="css/accordion.css?v=ss03ssdasdaDsdadddaa0ddadadadSdddadadaddadadddaddasdadaadadadsadasaddadasa3dadasdsssdassssssdadasdassssdassssssssssssssdassssssssssss8b" /> 

    
<?php
include('../dbconnection.php');
//  error_reporting(0);
if(isset($_POST['delete'])){
    $asd = mysqli_real_escape_string($con, $_POST['lesson_to_delete']);
    $id_to_delete = mysqli_real_escape_string($con, $_POST['id_to_delete']);
    
    $sql2 = "DELETE FROM lessons WHERE lesson_subject = '$asd'";
    echo($sql2);
    $sql = "DELETE FROM courses WHERE course_id = $id_to_delete";


    if(mysqli_query($con, $sql2)){
        //success
        header('Location: index_admin.php');
    } else
    {
        echo 'query error: ' . mysqli_error($con);
    }
    
    if(mysqli_query($con, $sql)){
        //success
        header('Location: index_admin.php');
    }else
     {
        echo 'query error: ' . mysqli_error($con);
    }

}


//check GET request name param
if (isset($_GET['course_name'])) {
    $id = mysqli_real_escape_string($con, $_GET['course_name']);
    
    //make sql
    $sql = "SELECT lessons.id, lessons.name, assets.url, lessons_assets.lesson_id FROM lessons
    INNER JOIN lessons_assets ON lessons_assets.lesson_id = lessons.id
    INNER JOIN assets ON assets.id = lessons_assets.asset_id
    WHERE lessons.course_id = 14
    ORDER BY lessons.id;
    ";
    $result = mysqli_query($con, $sql);

    
    
}

$asd = $_GET["course_name"];

if(isset($comm)){
    date_default_timezone_set('Europe/Bucharest');
$comm = $_POST['comment'];

    $asdf = $_SESSION['login_admin'];
    $timestamp = date("Y-m-d H:i:s");
    $sql3 = "INSERT INTO comments(user, date, comment_content, course_name)
    VALUES('$asdf', '$timestamp', '$comm', '$asd')";
   $result3 = mysqli_query($con, $sql3);
   

    
}
if(isset($_POST['update'])) {
   $asdf = $_SESSION['login_admin'];
    $emp_salary = $_POST['comm-content'];
    
    $sql = "UPDATE comments ". "SET comment_content = '$emp_salary' ". 
       "WHERE user = '$asdf'" ;
    $retval = mysql_query( $sql, $con );
    
    if(! $retval ) {
       die('Could not update data: ' . mysql_error());
    }
    echo "Updated data successfully\n";
    
    
 }

    
 ?>





<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dETAILS</title>
</head>
<body style="background: white;">
<div class="col-xl-4 border-info p-0 m-0 courses-div" style="background: #eaeef5; height:max-height: 120vh;">
<?php
$collecting_names = array();
$contor = 0;
while($row = mysqli_fetch_assoc($result)){
  
    $collecting_names[] = $row['name'];
    $collecting_names = array_unique($collecting_names);
    if($row['lesson_id'] == $row['id']){
        if($contor < count($collecting_names)){
echo '<button class="accordion py-4 font-weight-bold mx-4 d-flex justify-content-between align-items-center" style="background: #eaeef5;">' . $collecting_names[$contor] . '</button>';

        $contor ++;
        }  
        
        echo '<p>'.$row['url'].'</p>';
        echo '<a class="mr-2" style="opacity: 0.75; color: #305397;" href="../images/' . $row["url"] . '" target="_blank">Download File </a>';
    }
  }
?>
</div>

</body>



<script>

if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

</script>
<script src="js/newAccordionV2.js?v=dasgdfgdadassdasadaddaadassdadaDAdaddadadsadadasdaadadadadadadadadaddadaadadadaddsSafasdafssfsdadadaadadadaassddasAddaasdsagsf"></script>
</html>