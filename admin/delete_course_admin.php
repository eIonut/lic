<?php
unset($_SESSION);
$_SESSION = array();
session_unset();
session_start();
session_regenerate_id(TRUE); //THIS DOES THE TRICK! Calling it after session_start. Dunno if true makes a difference.
include 'includes.php';
?>

<link rel="stylesheet" href="css/sidebar.css?v=e031ddses0sssssssssssscZd8b" />
<link rel="stylesheet" href="css/commonStyles.css?v=e031se80ssscsssssssssss328b" />
<link rel="stylesheet" href="css/individualCoursePage.css?v=ssssssssssssssssss0sssssss0sc328b" />
<link rel="stylesheet" href="css/accordion.css?v=ss03sssssssssssssssssssssssss03ss28b" />

    
<?php
include('../dbconnection.php');


if(isset($_POST['delete'])){
    $asd = mysqli_real_escape_string($con, $_POST['lesson_to_delete']);
    $id_to_delete = mysqli_real_escape_string($con, $_POST['id_to_delete']);
    
    $sql2 = "DELETE FROM lessons WHERE lesson_subject = '$asd'";
    echo($sql2);
    $sql = "DELETE FROM courses WHERE course_id = $id_to_delete";


    if(mysqli_query($con, $sql2)){
        //success
        header('Location: index_admin.php');
    }
    {
        echo 'query error: ' . mysqli_error($con);
    }
    
    if(mysqli_query($con, $sql)){
        //success
        header('Location: index_admin.php');
    }
    {
        echo 'query error: ' . mysqli_error($con);
    }

}


//check GET request name param
if (isset($_GET['course_name'])) {
    $id = mysqli_real_escape_string($con, $_GET['course_name']);
    
    //make sql
    $sql = "SELECT * FROM courses WHERE course_name = '$id'";
    
    //get the query result
    $result = mysqli_query($con, $sql);
    
    //fetch result in array format
    $course = mysqli_fetch_assoc($result);
    
    mysqli_free_result($result);
    
    
}


$asd = $_GET["course_name"];




 
// $sql_1    = "SELECT lesson_subject FROM lessons";
// $result_lesson = mysqli_query($con, $sql_1);

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dETAILS</title>
</head>
<body>


<div id="mySidebar" class="sidebar">
      <button class="openbtn">&#9776;</button>
        <div class="sidebar-content">
    
  <a href="javascript:void(0)" class="closebtn">&times;</a>
  <div class="right-content-div">
            <h1 class="hide-event">
              Welcome back,
              <span class="user-name-log">
              <?php
echo $_SESSION['login_admin'] . "!";
?>
</span>
           </h1>
            
          </div>
          <a class="sidebar-links hide-event" href="#">ABOUT</a>
  <a class="sidebar-links hide-event" href="index_admin.php">COURSES</a>
  <a class="sidebar-links hide-event" href="#">CONTACT</a>
  <a class="sidebar-btns hide-event" href="add_course_admin.php">ADD COURSE</a>
  <a class="sidebar-btns hide-event" href="add_class.php">ADD SUBJECT</a>
  <form action="delete_course_admin.php" method="POST">
        <input type="hidden" name="id_to_delete" value="<?php echo $course['course_id'];?>"> 

       <input type="hidden" name="lesson_to_delete" value="<?php echo $course['course_name'];?>"> 
        <input class="delete-course-btn" type="submit" name="delete" value="Delete Course"> 
    </form>
   
  
              <a
                href="logout_admin.php"
                id="logout-btn"
                class="logout-btn sidebar-btns hide-event"
                >LOGOUT
              </a>
          
</div>
</div>
</div>
<main class="main-content">
    <div class="courses">

  
        <?php
if ($course):
?>
           <h4><?php
    echo htmlspecialchars($course['course_name']);
?></h4>
            <?php
else:
?>

                <h5>No such course exists!</h5>
                <?php
endif;
?>
   

    <?php

$sql    = "SELECT * FROM lessons WHERE lesson_subject= '$asd'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
   
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        
        if (str_contains($row["pdf_location"], '.mp4')) {   
            
            echo '<button class="accordion">' . $row["lesson_number"] .'</button>';
            echo '<div class="panel">';
            echo '<video poster="imgs/video-poster.jpg" class="course-video" src="../images/' . $row["pdf_location"] . '" width="100%" height="300px" controls volume="1">';
            echo ' </video>';
            echo '<p>';
                echo "Lesson title: " . $row["lesson_number"] . "<br>" . "File: " . $row["pdf_location"];
            echo '</p>';
            echo '<p class="timer">Duration: <span class="video-duration"></span></p>';
            echo '<button class="play-btn">Play video</button>';
            // echo '<button class="collapse-btn">collapse</button>';
            echo '</div>';

           
        }
        else{
        
            
        echo '<button class="accordion">' . $row["lesson_number"] . " - (Resources)".'</button>';
        echo '<div class="panel">';
        echo '<p>';
        echo "Lesson title: " . $row["lesson_number"] . "<br>" . "File: " . $row["pdf_location"];
        echo '</p>';
        echo "<br>";
        
        echo '<a href="../images/' . $row["pdf_location"] . '" target="_blank">Download File </a>';
       
        echo '</div>';
        }
       
      
    }
    
  
} else {
    echo '<div class="no-subjects">';
     echo "No subjects were added to this course so far. Talk to an administrator for adding.";
    echo "</div>";
}

mysqli_close($con);

?>
  </div>

    

    </main>


</body>
<script src="js/courseSideBar.js?v=dassdssssssssassssssdas"></script>
<script src="js/accordion.js?v=ss0sssssssss8ssssssssssssssss0328b"></script>

</html>