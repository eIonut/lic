<?php
unset($_SESSION);
$_SESSION = array();
session_unset();
session_start();
session_regenerate_id(TRUE); //THIS DOES THE TRICK! Calling it after session_start. Dunno if true makes a difference.
include 'includes.php';
?>

<link rel="stylesheet" href="css/sidebar.css?v=e031ddses0ssssscZd8b" />
<link rel="stylesheet" href="css/commonStyles.css?v=e031se80sc328b" />
<link rel="stylesheet" href="css/individualCoursePage.css?v=s03ss8ss0sc328b" />
<link rel="stylesheet" href="css/accordion.css?v=ss03sss8s0c3s28b" />

    
<?php
include('../dbconnection.php');


if(isset($_POST['delete'])){
    $asd = mysqli_real_escape_string($con, $_GET['course_name']);
    $id_to_delete = mysqli_real_escape_string($con, $_POST['id_to_delete']);
    $sql = "DELETE FROM courses WHERE course_id = $id_to_delete";


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
  
              <a
                href="logout_admin.php"
                id="logout-btn"
                class="logout-btn sidebar-btns hide-event"
                >LOGOUT
              </a>
          
</div>
</div>
</div>

    <div class="container">
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
            
            echo '<button class="accordion">' . $row["lesson_number"] . '</button>';
            echo '<div class="panel">';
            echo '<video width="100%" height="300px" controls volume="1">';
            echo '<source src="../images/' . $row["pdf_location"] . '" type="video/mp4">';
            echo ' </video>';
            echo '</div>';

           
        }
        
        else{
            echo '<div>';
              echo "Lesson title: " . $row["lesson_number"] . "<br>" . "Fisier atasat: " . $row["pdf_location"];
              echo "<br>";
              echo '<a href="../images/' . $row["pdf_location"] . '" target="_blank">Download File </a>';
            echo '</div>';  
        }
       
      
    }
    
  
} else {
    echo "No subjects were added to this course so far. Talk to an administrator for adding.";
}

mysqli_close($con);

?>



    <form action="delete_course_admin.php" method="POST">
        <input type="hidden" name="id_to_delete" value="<?php
echo $course['course_id'];
?>">
        <input type="submit" name="delete" value="Delete Course!"> 
    </form>

<!--    
    <form action="delete_course_admin.php" method="POST">
        <input type="hidden" name="lesson_id_to_delete" value="
echo $lessons['id'];
?>">
        <input type="submit" name="delete_lesson" value="Delete"> 
    </form>
    
  </div>
   -->
   </div>


</body>
<script src="js/courseSideBar.js"></script>
<script src="js/accordion.js?v=ss0ss3ss80c328b"></script>

</html>