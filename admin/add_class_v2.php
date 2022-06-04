
<?php

include('../dbconnection.php');
include 'includes.php';



$sqll = 'SELECT * FROM assets';
$result = mysqli_query($con, $sqll);
$assets = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

  
// $sqlll = "SELECT * from lessons";
// $result = mysqli_query($con, $sqlll);
// $lessons = mysqli_fetch_all($result, MYSQLI_ASSOC);


$result3 = mysqli_query($con, "SELECT courses.name as cn, lessons.name as ln, lessons.id as id from courses
INNER JOIN lessons on lessons.course_id = courses.id
WHERE lessons.course_id = courses.id" );

       
// $result2 = mysqli_query($con, "SELECT courses.name from courses
// INNER JOIN lessons on lessons.course_id = courses.id
// WHERE lessons.course_id = courses.id" );


// $result2 = mysqli_query($con, "SELECT courses.name, courses.id from courses
// INNER JOIN lessons ON lessons.course_id =  courses.id
// WHERE lessons.name = '2'" );

// $row = mysqli_fetch_assoc($result2);
if(isset($_POST['submit']))
{   
    
        // escape sql chars
    
        // $lesson_subject = mysqli_real_escape_string($con, $_POST['class-option']);
        
        $asset_option = mysqli_real_escape_string($con, $_POST['asset-option']);
        
        $lesson_option = mysqli_real_escape_string($con, $_POST['lesson-option']);
    
        // $result2 = mysqli_query($con, "SELECT courses.name from courses
        // INNER JOIN lessons ON lessons.course_id =  courses.id
        // WHERE lessons.name = '$lesson_option'" );
        
        // $row = mysqli_fetch_assoc($result2);
        
$sql3 = "INSERT INTO lessons_assets(lesson_id, asset_id)
        VALUES ($lesson_option, $asset_option)";

        if(mysqli_query($con, $sql3)){
            // success
            header('Location: index_admin.php');
        } else {
            echo 'query error: '. mysqli_error($con);
        }
 }


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="  background: rgba(48, 83, 151, 0.75);">

<div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">

            <h4 class="center font-weight-bold" style="opacity: 0.75;">Add a new subject</h4>
                <form class="m-0" action="add_class_v2.php" method="POST"  enctype="multipart/form-data">
                <div class="form-group">
			

           

            <select class="form-control w-100"name="asset-option" id="class-option" required>
            <label class="font-weight-bold" for="class-option">File:</label>
            <?php
            $collecting_names = array();
            $contor = 0;
           
                foreach($assets as $asset){ ?>
                <?php
                $collecting_names[] = $asset['url'];
                 $collecting_names = array_unique($collecting_names);
                 if($contor < count($collecting_names)){
                    ?>
                    <option value="<?php echo $asset['id'];?>" name="asset-option">
                    
                <?php 
                  echo $collecting_names[$contor];
                  ?>
                 </option>
                     
                    <?php
                     $contor++;
                 }
               ?>
            <?php } ?>
                
            </select>

            <select class="form-control w-100"name="lesson-option" id="lesson-option" required>
            <label class="font-weight-bold" for="class-option">Lesson:</label>
          

                   
                <?php while($row = mysqli_fetch_assoc($result3)){      ?>
                    
                <option value="<?php echo $row['id'];?>" name="lesson-option"><?php echo '<p class="font-weight-bold">Lesson:</p>' . $row['ln'] . " Course:" . $row['cn']?></option>
            <?php    } ?>
        
            
            </select>
            </div>
           
			<div class="form-group py-3 m-0 pb-0">
				<input style="background: rgba(48, 83, 151, 0.75); border: none;"type="submit" name="submit" value="Submit" class="w-100 btn btn-primary text-light mx-auto text-center z-depth-0">
                <p class="mx-auto w-100 text-center py-3 m-0 font-weight-bold">OR</p>
				<a style="background: rgba(48, 83,151, 0.75); border: none;" class="btn btn-primary text-light mx-auto w-100" href="index_admin.php">Go back to courses</a>
			</div>
	

            </div>
        </div>
    </div>


</body>
<link rel="stylesheet" href="css/new_login.css?v=sdsafafadassasds" />

</html>