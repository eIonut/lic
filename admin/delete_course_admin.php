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
        echo "Curs: " . $row["lesson_subject"] . " " . "Lectia nr: " . $row["lesson_number"]. " " . "Fisier atasat: " . $row["pdf_location"];
        echo "<br>";
        echo '<a href="../images/'.$row["pdf_location"].'" target="_blank">Download File </a>';
      }
      
     
    } else {
      echo "No subjects were added to this course so far. Talk to an administrator for adding.";
    }

    mysqli_close($con);
    ?>

<div id="vid-gallery"><?php
  // (A) GET ALL VIDEO FILES FROM THE GALLERY FOLDER
  $dir = __DIR__ . DIRECTORY_SEPARATOR . "../images" . DIRECTORY_SEPARATOR;
  $videos = glob("$dir*.{webm,mp4,ogg, mkv}", GLOB_BRACE);
 
  // (B) OUTPUT ALL VIDEOS
  if (count($videos) > 0) { foreach ($videos as $vid) {
    printf("<video src='..images/%s'></video>", rawurlencode(basename($vid)));
  }}
?></div>

  
    <form action="delete_course_admin.php" method="POST">
        <input type="hidden" name="id_to_delete" value="<?php echo $course['course_id'];?>">
        <input type="submit" name="delete" value="Delete"> 
    </form>

</body>
<script src="js/videos.js"></script>
</html>