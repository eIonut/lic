<?php
unset($_SESSION);
$_SESSION = array();
session_unset();
session_start();
session_regenerate_id(TRUE); //THIS DOES THE TRICK! Calling it after session_start. Dunno if true makes a difference.

?>

<link rel="stylesheet" href="css/sidebar.css?v=e031ddes0sssscZd8b" />
<link rel="stylesheet" href="css/commonStyles.css?v=e031se80c328b" />
<link rel="stylesheet" href="css/individualCoursePage.css?v=s031e80c328b" />
<script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
<?php 
    include('../dbconnection.php');

    if(isset($_POST['delete'])){
        $asd = $_GET['course_name'];
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
    if(isset($_GET['course_name'])){
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
        <?php if($course): ?>
            <h4><?php echo htmlspecialchars($course['course_name']);?></h4>
            <?php else: ?>

                <h5>No such course exists!</h5>
                <?php endif; ?>
    </div>

    <?php
    
    $sql = "SELECT * FROM lessons WHERE lesson_subject= '$asd'";
    $result = mysqli_query($con, $sql);
    
    if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
       
        if (str_contains($row["pdf_location"], '.mp4')) {
            echo "Curs: " . $row["lesson_subject"] . " " . "Lectia nr: " . $row["lesson_number"]. " ";
            echo '<video width="320" height="240" controls volume="1">
            <source src="../images/'.$row["pdf_location"].'" type="video/mp4">
            </video>';
        }

        else{
            echo "Curs: " . $row["lesson_subject"] . " " . "Lesson title: " . $row["lesson_number"]. " " . "Fisier atasat: " . $row["pdf_location"];
            echo "<br>";
            echo '<a href="../images/'.$row["pdf_location"].'" target="_blank">Download File </a>';
            
        }
        echo "<br>";
 
      }
      
     
    } else {
      echo "No subjects were added to this course so far. Talk to an administrator for adding.";
    }

    mysqli_close($con);
    ?>



  
    <form action="delete_course_admin.php" method="POST">
        <input type="hidden" name="id_to_delete" value="<?php echo $course['course_id'];?>">
        <input type="submit" name="delete" value="Delete"> 
    </form>

</body>
<script src="js/courseSideBar.js"></script>
</html>