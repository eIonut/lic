<?php 
    include('dbconnection.php');
    
    $asd = $_GET["course_name"];

    //check GET request name param
   
    $id = mysqli_real_escape_string($con, $asd);

    //make sql
    $sql = 'SELECT course_name FROM courses WHERE course_name LIKE "%'.$asd.'%"';

    //get the query result
    $result = mysqli_query($con, $sql);

    //fetch result in array format
    $course = mysqli_fetch_assoc($result);
    
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
       echo "<div class='asd'>Curs: " . $row["lesson_subject"] . " " . "</br>" . "Lectia nr: " . $row["lesson_number"]. " " . "</br>" . "Fisier atasat: " . $row["pdf_location"] . "</br>"  ;
    
       echo '<a href="./images/'.$row["pdf_location"].'" target="_new">Download File </a>' . "</br>";
       echo "</br>";
     }
    
   } else {
     echo "No subjects were added to this course so far. Talk to an administrator for adding.";
   }
   ?>
   
</body>
</html>