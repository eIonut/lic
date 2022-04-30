<?php
unset($_SESSION);
$_SESSION = array();
session_unset();
session_start();
session_regenerate_id(TRUE); //THIS DOES THE TRICK! Calling it after session_start. Dunno if true makes a difference.
include 'includes.php';
?>

<link rel="stylesheet" href="css/sidebar.css?v=e031ddses0sssssssssssssssssssssssssssssssssssssssssssssssZsd8b" />
<link rel="stylesheet" href="css/commonStyles.css?v=e031ses8sssssssssssssssssssssssssssssssssssss328b" />
<link rel="stylesheet" href="css/individualCoursePage.css?v=s0ssssssssssssssssssssssssss0sc328b" />
<link rel="stylesheet" href="css/accordion.css?v=ss03ssss03sssssssssssssssssssssssssssssssssssss8b" />

    
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

  
<button class="openbtn"></button>

<div id="mySidebar" class="sidebar">

        <div class="sidebar-content">
     
  
  <div class="right-content-div">
            <h1 class="hide-event">
                <span class="welcome">Welcome back,</span>
              
              <span class="user-name-log">
                  <br>
              <?php
echo $_SESSION['login_admin'];
?>
</span>
           </h1>
           <a href="javascript:void(0)" class="closebtn">adassd</a>
            
          </div>
         

          <div class="sidebar-top-section">
          <a class="sidebar-links hide-event" href="#">About</a>
  <a class="sidebar-links hide-event" href="index_admin.php">Courses</a>
  <a class="sidebar-links hide-event" href="#">Contact</a>
  </div>

  <div class="add-content"> 
    <a class="sidebar-btns hide-event" href="add_course_admin.php">ADD COURSE</a>
    <a class="sidebar-btns hide-event" href="add_class.php">ADD SUBJECT</a>
    
  </div>
 
  <form action="delete_course_admin.php" method="POST">
        <input type="hidden" name="id_to_delete" value="<?php echo $course['course_id'];?>"> 

       <input type="hidden" name="lesson_to_delete" value="<?php echo $course['course_name'];?>"> 
        <input class="delete-course-btn" type="submit" name="delete" value="Delete Course"> 
    </form>
  
              <a
                href="logout_admin.php"
                id="logout-btn"
                class="logout-btn hide-event"
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

<div class="course-top-content">
           <h4><?php
    echo htmlspecialchars($course['course_name']);
?></h4>
<a href="javascript:void(0)" class="courseCloseBtn"></a>
<a href="javascript:void(0)" class="close-course-btn"></a>
</div>
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
// $shortenedName = '';
if (mysqli_num_rows($result) > 0) {
   
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        
        if (str_contains($row["pdf_location"], '.mp4')) {   
            // if($row["pdf_location"] > 20){
            //     for($i = 0; $i <= 20; $i++)
            // $shortenedName = $shortenedName . $row["pdf_location"][$i];
            // $row["pdf_location"] = $shortenedName;
            // }
           

            echo '<button class="accordion">' . $row["lesson_number"] .'</button>';
            echo '<div class="panel">';
           
            echo '<video poster="imgs/video-poster.jpg" class="course-video" src="../images/' . $row["pdf_location"] . '" width="100%" height="300px" controls volume="1">';

            echo ' </video>';
            // echo '<p>';
            //     echo "<span class='bolded'>Lesson title:</span> " . $row["lesson_number"] . "<br>". "";
            // echo '</p>';
            echo '<p class="timer bolded">Duration: <span class="video-duration"></span></p>';
            echo '<button class="play-btn">See this lesson</button>';
            // echo '<button class="collapse-btn">collapse</button>';
            echo '</div>';

           
        }
        else{
        
            
        echo '<button class="accordion">' . $row["lesson_number"] . " - (Resources)".'</button>';
        echo '<div class="panel">';
        echo '<p>';
        echo '<span class="bolded bolded-file">File: </span>' . $row["pdf_location"];
        echo '</p>';
        echo "<br>";
        
        echo '<a href="../images/' . $row["pdf_location"] . '" target="_blank">Download File </a>';
       
        echo '</div>';
        }
       
      
    }
    
  
} else {
    echo '<div class="no-subjects">';
     echo "<p>No subjects were added to this course so far. Talk to an administrator for adding.</p>";
    echo "</div>";
}

mysqli_close($con);

?>
  </div>

    

    </main>


</body>

<script src="js/accordion.js?v=ss0ssssssssssdasdsssssssssssddssassssssssssdasdassdsssssssssssaasssssssssssssssssssdsssasdssssaasssssdasssssssdsdasassssssssdassssssssssssssssssssssssss0328b"></script>

</html>