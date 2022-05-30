
<?php

include('../dbconnection.php');
include 'includes.php';

$sql = 'SELECT DISTINCT * from courses';
$result = mysqli_query($con, $sql);
$courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

$sqll = 'SELECT DISTINCT id, url from assets';
$result = mysqli_query($con, $sqll);
$assets = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

  
$sqlll = "SELECT DISTINCT * from lessons";
$result = mysqli_query($con, $sqlll);
$lessons = mysqli_fetch_all($result, MYSQLI_ASSOC);





if(isset($_POST['submit']))
{   
        // escape sql chars
    
        $lesson_subject = mysqli_real_escape_string($con, $_POST['class-option']);
        
        $asset_option = mysqli_real_escape_string($con, $_POST['asset-option']);
        
        $lesson_option = mysqli_real_escape_string($con, $_POST['lesson-option']);

        
$sql3 = "INSERT INTO lessons_assets(lesson_id, asset_id)
        VALUES ($lesson_option, $asset_option)";

        if(mysqli_query($con, $sql3)){
            // success
            header('Location: delete_course_admin.php?id=' . $lesson_subject);
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
			<label class="font-weight-bold" for="class-option">Course:</label>
            <select class="form-control w-100"name="class-option" id="class-option">
            
            <?php
                foreach($courses as $course){ ?>
                <option value="<?php echo $course['id'];?>" name="class-option"><?php echo ($course['name']);?></option>
            <?php } ?>
                
            </select>
            <label class="font-weight-bold" for="asset-option">File:</label>
            <select class="form-control w-100"name="asset-option" id="class-option">
            
            <?php
               
                $sql = "SELECT DISTINCT assets.url from assets";
                $result = mysqli_query($con, $sql);
                
                foreach($assets as $asset){ ?>
                    <?php
                while($rowz = mysqli_fetch_assoc($result)){
                    ?>
                    
                <option value="<?php echo $asset['id'];?>" name="asset-option"><?php 
                
               
                    echo $rowz['url'];
                    
             
               
                 ?></option>
            <?php    }} ?>
                
            </select>
            <label class="font-weight-bold" for="lesson-option">Lesson:</label>
            <select class="form-control w-100"name="lesson-option" id="lesson-option">
           
            <?php

                foreach($lessons as $lesson){ ?>           
                <option value="<?php echo $lesson['id'];?>" name="lesson-option"><?php echo ($lesson['name']);?></option>
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