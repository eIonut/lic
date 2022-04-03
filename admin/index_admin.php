<?php
include '../dbconnection.php';
unset($_SESSION);
    $_SESSION=array();
    session_unset();
    session_start();
    session_regenerate_id(TRUE); //THIS DOES THE TRICK! Calling it after session_start. Dunno if true makes a difference.

if (strlen($_SESSION['id']==0)) {
  header('location:logout_admin.php');
  }
	
if(!$con){
    echo 'Connection error'. mysqli_connect_error();
}



$query1 = @$_POST['course-search'];


    if(empty($query1))
    {
        $sql = 'SELECT course_name from courses';
        $result = mysqli_query($con, $sql);
        $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($con);
    }
  
    else{
        $sql = 'SELECT course_name, course_id from courses WHERE (`course_name` LIKE "%'.$query1.'%")';
        $result = mysqli_query($con, $sql);
        $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($con);
    }
    


function clearClasses(){
    $sql = 'SELECT course_name from courses';
    $result = mysqli_query($con, $sql);
    $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($con);
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/indexPage.css" />

    <title>Document</title>
</head>
<body>
    
    <nav id="navbar">
        <div class="add-content-div">
            <a href="add_course_admin.php">Add Course</a>
            <a href="add_class.php">Add Subject</a>
        </div>

        <button id="toggle">Change Theme</button>

        <form id="search-clear-form"action="index_admin.php" method="POST">
        
            <input type="text" name="course-search" class="search-input" placeholder="Search courses..."/>
            <input type="submit" value="" id="search-course-input-button" />
            <input type="submit" value="Clear search" id="clear-btn" onclick=clearClasses()/>
        </form>
        
        <div class="right-content-div">
            <h1>Welcome back, <?php echo $_SESSION['login_admin'] . "!";?></h1>
            <button id="logout-btn">
                <a href="logout_admin.php" id="logout-btn" class="btn btn-primary btn-large">Logout </a>
            </button>
        </div>

       
    </nav>

   
   
    <main id="main-content"> 
    <div class="blob">
  
 <svg xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 310 350">
  <path d="M156.4,339.5c31.8-2.5,59.4-26.8,80.2-48.5c28.3-29.5,40.5-47,56.1-85.1c14-34.3,20.7-75.6,2.3-111  c-18.1-34.8-55.7-58-90.4-72.3c-11.7-4.8-24.1-8.8-36.8-11.5l-0.9-0.9l-0.6,0.6c-27.7-5.8-56.6-6-82.4,3c-38.8,13.6-64,48.8-66.8,90.3c-3,43.9,17.8,88.3,33.7,128.8c5.3,13.5,10.4,27.1,14.9,40.9C77.5,309.9,111,343,156.4,339.5z"/>
  </svg>
</div>
        <h1 class="your-courses">YOUR COURSES</h1>
            <section id="course-section">
                <?php
                    foreach($courses as $course){ ?>
                        <div class="course-content">
                            <h6><?php echo htmlspecialchars($course['course_name']);?></h6>
                            <a href="delete_course_admin.php?course_name=<?php echo $course['course_name']?>">More info</a>
                        </div>
                <?php } ?>
            </section>
    

       
    </main>
    
</body>
<script src="./js/toggleModev2.js"></script>
</html>
