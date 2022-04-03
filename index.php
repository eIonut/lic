<?php
include 'dbconnection.php';
session_start();
if (strlen($_SESSION['id']==0)) {
  header('location:logout.php');
  } else{
	
if(!$con){
    echo 'Connection error'. mysqli_connect_error();
}

$query1 = @$_POST['course-search'];


    if(empty($query1))
    {
        $sql = 'SELECT course_name from courses';
        $result = mysqli_query($con, $sql);
        $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($con);
    }
  
    else{
        $sql = 'SELECT course_name, course_id from courses WHERE (`course_name` LIKE "%'.$query1.'%")';
        $result = mysqli_query($con, $sql);
        $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($con);
    }


function clearClasses(){
    $sql = 'SELECT course_name from courses';
    $result = mysqli_query($con, $sql);
    $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($con);
}


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <H1>Welcome back, <?php echo $_SESSION['login'] ?></h5></H1>
    <h4>YOUR COURSES</h4>

    <?php
    foreach($courses as $course){ ?>
            <h6><?php echo htmlspecialchars($course['course_name']);?></h6>
            <div><a href="details.php?course_name=<?php echo $course['course_name']?>">More info</a></div>
    
       <?php } ?>
   

    <form action="index.php" method="POST">
		<input type="text" name="course-search" />
		<input type="submit" value="Search" />
	</form>

    <form action="index.php" method="POST">
		<input type="submit" value="Clear" onclick=clearClasses()/>
	</form>

    
    <a  href="logout.php" class="btn btn-primary btn-large">Logout </a>
</body>
</html>
<?php } ?>