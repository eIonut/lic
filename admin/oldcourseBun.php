<?php
unset($_SESSION);
$_SESSION = array();
session_unset();
session_start();
session_regenerate_id(TRUE); //THIS DOES THE TRICK! Calling it after session_start. Dunno if true makes a difference.
include 'includes.php';
?>
<!-- 
<link rel="stylesheet" href="css/sidebar.css?v=e031ddses0sssssssssssssssssssssssssssssssssssssssssssssssZsd8b" />
<link rel="stylesheet" href="css/commonStyles.css?v=e031ses8sssssssssssssssssssssssssssssssssssss328b" />
<link rel="stylesheet" href="css/individualCoursePage.css?v=s0ssssssssssssssssssssssssss0sc328b" /> -->
<link rel="stylesheet" href="css/accordion.css?v=ss03sssdas03ssssssssdasdasssssssssssssssssssssssssssss8b" />

    
<?php
include('../dbconnection.php');
error_reporting(0);

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
$comm = $_POST['comment'];


if(isset($comm)){
    $asdf = $_SESSION['login_admin'];
    $date = date("Y/m/d");
    
    $sql3 = "INSERT INTO comments(user, date, comment_content, course_name)
    VALUES('$asdf', '$date', '$comm', '$asd')";
   $result3 = mysqli_query($con, $sql3);
   

    
}


?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dETAILS</title>
</head>
<body>

  <div class="container-fluid w-100 p-0 m-0 d-flex flex-column">
    <div class="row col-12 m-0 p-0" style="height: 100%">
        <div class="col-xl-2 d-flex flex-column order-1 order-sm-1" style="background-color: beige;">

            <div class="sidebar h-100">
                
                <div class="sidebar-top-section">
                    <h3 class="hide-event">
                        <span class="welcome">Welcome back,</span>
                        <?php echo $_SESSION['login_admin'];?>
                    </h3>
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
            </div>
        
        </div>

        <div class="col-xl-6 m-0 p-0 order-3 order-sm-3 order-lg-2">
            
            <div id="videoDiv"class="videos border border-primary d-flex flex-column text-center" style="height: 400px">
                <p>Here is the video section</p>
            </div>

           
            <div class="comments border border-danger mt-auto p-4" style="height: fit-content;">
            <h4 class="border-bottom py-4 pt-0">Comments</h4>
            <?php
                $sql2 = "SELECT * from comments WHERE course_name='$asd'";
                $result2 = mysqli_query($con, $sql2);

                if (mysqli_num_rows($result2) > 0) {
                    while ($row = mysqli_fetch_assoc($result2)) {
                        echo '<div class="border-bottom py-3">';
                        echo '<div class="d-flex">';
                            echo '<p class="align-self-start">'.$row["user"].'</p>';
                            echo '<p class="align-self-end ml-auto">'.$row["date"].'</p>';
                        echo '</div>';
                        
                        echo '<p class="font-weight-bold">'.$row["comment_content"].'</p>';
                        echo '</div>';
                    }
                }

                else{
                    echo 'No comments found.';
                }
            ?>

                <div class="leave-comment" style="height: fit-content;">
                <form name="form" method="POST" class="was-validated" >
                    <div class="form-group">
                        <h4 class="my-4 p-0" >Leave a comment</h4>
               
<textarea class="form-control is-invalid" name="comment" id="comment" placeholder="Required example textarea" required></textarea>
    <div class="invalid-feedback">
      Please enter a message in the textarea.
    </div>
                        
                        
                        <button class="btn btn-primary btn-block my-3">Submit</button>
                    </div>
                </form>

                </div>
            </div>
        </div>

       
       
         
      
        <div class="col-xl-4 m-0 p-0 border border-warning h-100 order-2 order-sm-2" style="max-height: 125vh; overflow: scroll; overflow-x: hidden;">
            <?php
             $sql    = "SELECT * FROM lessons WHERE lesson_subject= '$asd'";
             $result = mysqli_query($con, $sql);
             if (mysqli_num_rows($result) > 0) {
                 while ($row = mysqli_fetch_assoc($result)) {
                    if (str_contains($row["pdf_location"], '.mp4')) {
        
           
            echo '<button class="accordion">' . $row["lesson_number"] .'</button>';
            echo '<div class="panel ">';
            echo '<p>' . $row["lesson_number"] .'</p>';
            echo '<video poster="imgs/video-poster.jpg" class="course-video" src="../images/' . $row["pdf_location"] . '" width="100%" height="300px" controls volume="1">';

            echo ' </video>';
            echo '<p class="timer bolded">Duration: <span class="video-duration"></span></p>';
            echo '<button class="play-btn">See this lesson</button>';
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
            }
                    else {
                        echo '<div class="no-subjects">';
                         echo "<p>No subjects were added to this course so far. Talk to an administrator for adding.</p>";
                        echo "</div>";
                    }
            ?>    
            <!-- accordion -->
        </div>
        <!-- col -->
    </div>   
    <!-- row -->
  </div> 
  <!-- container -->
</body>

<!-- <script src="js/accordion.js?v=ss0ssssssssssdasdsssssssssssddssasssssssssssdasdassdsssssssssssaasssssssssssssssssssdsssasdssssaasssssdasssssssdsdasassssssssdassssssssssssssssssssssssss0328b"></script> -->

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<script src="js/newAccordion.js?v=dasgdfgsdasdasAdasdsagsf"></script>
</html>