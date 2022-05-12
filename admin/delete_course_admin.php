<?php
unset($_SESSION);
$_SESSION = array();
session_unset();
session_start();
session_regenerate_id(TRUE); //THIS DOES THE TRICK! Calling it after session_start. Dunno if true makes a difference.
include 'includes.php';
?>

<link rel="stylesheet" href="css/coursePageQueries.css?v=addasddaddaddadadadddDdsddasdddaadsdaadadaddasassadadadaddaaddadaasdaddadadaaddadasasadasddaaas" />
<link rel="stylesheet" href="css/newCourse.css?v=ss03dasssdDDadadddddaaddadadaddaddaddaadddddddaadadadaaaddaadaaddadadddadasasdasasaddaasdasaddadadaasdadasddasas03sssssssdassdasdasssssssssssssssdadsassssssssssssss8b" />
<link rel="stylesheet" href="css/accordion.css?v=ss03ssdasdaDsdadddaa0ddadadadSdddadadaddadadddaddasdadaadadadsadasaddadasa3dadasdsssdassssssdadasdassssdassssssssssssssdassssssssssss8b" /> 

    
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
    date_default_timezone_set('Europe/Bucharest');
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
<div class="container-grid">
    <div class="sidebar text-light px-3">
        <div class="text-light sidebar-header px-2 pt-4 mx-auto d-flex justify-content-between align-items-center  p0-collapse" style="width: 100%; overflow:hidden;">
        <div>
        <h3 class="hide-event m-0 p-0 welcome-top-sidebar">
        Welcome back,
        <br> <p class="font-weight-bold"><?php echo $_SESSION['login_admin'];?></p>
      
            </h3>
            </div>
            
           
            
            <i class="fa-solid py-3 fa-expand collapse-btn sidebar-icons"></i>
            <!-- fa-compress -->
          
            
            </div>
            <hr>
        <div class="sidebar-top-section  p0-collapse d-flex py-2 flex-column px-2">

            <div class="d-flex justify-content-between  align-items-center">
                <a class="sidebar-links hide-event py-2" href="index_admin.php">Courses</a>
                <i class="fa-solid fa-book-open text-center sidebar-icons"></i>
            </div>
            
        </div>
<hr>
        <div class="add-content d-flex flex-column  p0-collapse px-2 py-2 mx-auto" style="width: 100%;">  
        <div class="py-2 d-flex justify-content-between align-items-center">
            <a class="sidebar-links hide-event py-2" href="add_course_admin.php">Add course</a>
            <i class="fa-solid fa-plus text-center sidebar-icons"></i>
        </div> 
            
        <div class="py-2 d-flex justify-content-between  p0-collapse  py-2 align-items-center">
            <a class="sidebar-links hide-event py-2" href="add_class.php">Add subject</a>
            <i class="fa-solid fa-plus text-center sidebar-icons"></i>
        </div>
        </div>
        <hr>
 
        <form action="delete_course_admin.php" class="del-course-form  p0-collapse d-flex px-2 py-2 align-items-center my-0" method="POST">
           
                <input  class="form-control" type="hidden" name="id_to_delete" value="<?php echo $course['course_id'];?>"> 
                <input  class="form-control" type="hidden" name="lesson_to_delete" value="<?php echo $course['course_name'];?>"> 
                <input  class="delete-course-btn hide-event sidebar-links" type="submit" name="delete" value="Delete course">
                
           
            <i class="fa-solid fa-trash ml-auto sidebar-icons"></i> 
        </form>
        <hr>
        <div class="logout-div px-2 d-flex p0-collapse flex-row py-3 justify-content-between align-items-center">
        
        <a
                href="logout_admin.php"
                id="logout-btn"
                class="logout-btn hide-event sidebar-links px-0  mx-auto d-flex justify-content-start" style="width: 100%;"
                >Logout
              </a>
              

              <i class="fa-solid fa-right-from-bracket sidebar-icons"></i>
              </div>
              
    </div>

    <div class="content">
        <div class="row col-12 h-100 p-0 m-0">
            <div class="col-xl-8 p-0 m-0">
                <div id="videoDiv"class="videos d-flex flex-column text-center" style="height: 400px">
                    <p>Here is the video section</p>
                </div>

                <div class="comments mt-auto p-4" style="height: 80vh; overflow: scroll; overflow-x:hidden;">
                    <h4 class="border-bottom py-4 pt-0">Comments</h4>
                        <?php
                        $sql2 = "SELECT * from comments WHERE course_name='$asd'";
                        $result2 = mysqli_query($con, $sql2);

                        if (mysqli_num_rows($result2) > 0) {
                            while ($row = mysqli_fetch_assoc($result2)) {
                                
                                echo '<div class="border-bottom py-3">';
                                echo '<div class="d-flex">';
                                    echo '<p class="align-self-start font-weight-bold" style="color: #305397">'.$row["user"].'</p>';
                                    echo '<p class="align-self-end ml-auto font-weight-normal" style="opacity: 0.5">'.$row["date"].'</p>';
                                echo '</div>';
                                echo '<p class="font-weight-bold">'.$row["comment_content"].'</p>';
                                // if($row['user'] == $_SESSION['login_admin']){ //pt partea
                                echo '<div class="w-100 text-right">';
                                echo '<a class="px-3 text-dark" style="opacity: 0.75;" href="editcomment.php?id= '. $row['comment_id'] .';"><i class="fa-solid fa-pencil"></i></a>';

                                echo '<a class="text-danger" style="opacity: 0.75;" href="delcomment.php?id= '. $row['comment_id'] .';"><i class="fa-solid fa-trash"></i></a>';
                                echo '</div>';
                                // }
                                
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
                            <textarea class="form-control is-invalid" name="comment" id="comment" placeholder="Write here your comment..." required></textarea>
                            <div class="invalid-feedback">
                                Please enter a message in the textarea above to write a comment.
                            </div>
                    
                            <button class="btn btn-primary w-100 text-start border-0 py-2 pl-4 my-3 d-flex justify-content-between align-items-center"
                            style="background: linear-gradient(84.57deg, #1b3d7d 0%, #4a6db0 100%);"
                            >Send the comment<i class="fa-solid fa-xs ml-auto pr-2 fa-arrow-right"></i></button>
                            </div>
                    </form>
                </div>
                </div>

                
            </div>
        

        
            
            <div class="col-xl-4 border-info p-0 m-0 courses-div" style="background: #eaeef5; ">
            <h4 class="px-3 py-3"><?php
    echo htmlspecialchars($course['course_name']);
?></h4>
            <?php
             $sql    = "SELECT * FROM lessons WHERE lesson_subject= '$asd'";
             $result = mysqli_query($con, $sql);
             $i = 1;
           
             if (mysqli_num_rows($result) > 0) {
                echo '<h1>'.$row["lesson_subject"].'</h1>';
                 while ($row = mysqli_fetch_assoc($result)) {
                    if (str_contains($row["pdf_location"], '.mp4')) {
                    
            echo '<button class="accordion py-4 font-weight-bold mx-4" style="background: #eaeef5;">' . $i . '.' . " " . $row["lesson_number"] .'</button>';
            echo '<div class="panel" style="background: #eaeef5;">';
            echo '<video poster="imgs/video-poster.jpg" class="course-video" src="../images/' . $row["pdf_location"] . '" width="100%" height="300px" controls volume="1">';

            echo ' </video>';
            echo '<div class="mb-4">';
            echo '<i class="fa-solid fa-stopwatch mr-2 text-start"></i>';
            echo '<p class="timer bolded mr-auto d-inline" style="opacity: 0.75;">Duration: <span class="video-duration"></span></p>';
            echo '</div>';
            echo '<button class="play-btn btn btn-primary w-100 text-start border-0 py-2 pl-4 d-flex justify-content-between align-items-center" 
            style="background: linear-gradient(84.57deg, #1b3d7d 0%, #4a6db0 100%);" type="button">See this lesson<i class="fa-solid fa-xs ml-auto pr-2 fa-arrow-right"></i></button>';
           
            echo '</div>'; 
            $i++;
                    }
                    else{
                         
        echo '<button class="accordion py-4 mx-4 font-weight-bold" style="background: #eaeef5;">' . $i . '.' . " " . $row["lesson_number"] . " - (Resources)".'</button>';
        echo '<div class="panel" style="background: #eaeef5;"> ';
        echo '<p>';
        echo '<span class="bolded bolded-file">File: </span>' . $row["pdf_location"];
        echo '</p>';
        echo "<br>";
        
        echo '<div class="d-flex justify-content-between align-items-center">';
        echo '<a class="mr-3" style="opacity: 0.75;" href="../images/' . $row["pdf_location"] . '" target="_blank">Download File </a>';
        echo '<i class="fas fa-md fa-file-download mr-auto" style="opacity: 0.75; color: #0d6efd;"></i>';
        echo '</div>';
      

       
        echo '</div>';
        $i++;
                    }
                }
            }
                    else {
                        echo '<div class="no-subjects">';
                         echo "<p>No subjects were added to this course so far. Talk to an administrator for adding.</p>";
                        echo "</div>";
                    }
            ?>    
            </div>
        </div>
    </div>
</div>
  
</body>


<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<script src="js/newAccordionV2.js?v=dasgdfgdassdadadadadaddfasdafssfsdadadaadadadaassddasAddaasdsagsf"></script>
</html>