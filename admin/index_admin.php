
    <link rel="stylesheet" href="css/indexPage.css?v=ess0s3rsssszss0c3d8b" />
    <link rel="stylesheet" href="css/sidebar.css?v=e031dds0ssssssscZd8b" />
    <link rel="stylesheet" href="css/commonStyles.css?v=ess03ssss1e80c32s8b" />

   
    <?php
include '../dbconnection.php';
include 'includes.php';
unset($_SESSION);
$_SESSION = array();
session_unset();
session_start();
session_regenerate_id(TRUE); //THIS DOES THE TRICK! Calling it after session_start. Dunno if true makes a difference.

if (strlen($_SESSION['id'] == 0)) {
    header('location:logout_admin.php');
}

if (!$con) {
    echo 'Connection error' . mysqli_connect_error();
}



$query1 = @$_POST['course-search'];


if (empty($query1)) {
    $sql     = 'SELECT course_name, course_description, course_image from courses';
    $result  = mysqli_query($con, $sql);
    $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($con);
}

else {
    $sql     = 'SELECT course_name, course_id, course_description, course_image from courses WHERE (`course_name` LIKE "%' . $query1 . '%")';
    $result  = mysqli_query($con, $sql);
    $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($con);
}



function clearClasses()
{
    $sql     = 'SELECT course_name from courses';
    $result  = mysqli_query($con, $sql);
    $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($con);
}

?>

    <html lang="en">
      <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        


        <title>Document</title>
      </head>
      <body>

     <div class="all-content">
      <main id="main-content">

      <!-- FIRST SECTION -->
        <section id="Asd" class="welcome-section first-section">
          <h1>Learn everything at your own pace... with us!</h1>
          <p>Take your pen and start learning right away, for <span class="us">FREE</span></p> 
          <a class="btn-hover color-2" href="#course-section">BEGIN NOW</a>
        </section>
        <!-- FIRST SECTION -->

        <!-- SECOND SECTION -->
        <!-- <div class="add-content-div">
            <form id="search-clear-form" action="index_admin.php" method="POST">
              <input
                type="text"
                name="course-search"
                class="search-input"
                placeholder="Search courses..."
              />
              <input class="search-btns" type="submit" value="Search" id="search-course-input-button" />
              <input
                class="search-btns"
                type="submit"
                value="Clear"
                id="clear-btn"
                onclick="clearClasses()"
              />
            </form>
            
          </div> -->
          
           <!-- SECOND SECTION -->
<!--  -->


<input type="text" name="search" id="search" placeholder="Search courses..." onkeyup="load_data(this.value);" />

<div id="wrapper">

          <section id="course-section">
          <h1 class="your-courses">Your courses</h1>  
          <!-- <p id="no-criteria-p">No courses found matching your criteria</p> -->
          <!-- THIRD SECTION -->


       </section>

       </div>
       <!-- THIRD SECTION -->
        </main>
    

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




        

      
      </body>
      <script src="js/sidebar.js"></script>
      <script src="js/loadData.js?"></script>
    

    </html>