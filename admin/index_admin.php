
    <link rel="stylesheet" href="css/indexPage.css?v=ess0ssssssssDAdadasddadsasdassssssssssassdsssssssdsssssszssss0c3d8b" />
    <link rel="stylesheet" href="css/sidebar.css?v=e031dddsdsassddadasssssssssssssssssssssssdsssssssssssscZd8b" />
    <link rel="stylesheet" href="css/commonStyles.css?v=esssdassdssdassssssssssssssssswssssdssssssssss1se80c32s8b" />
    <link rel="stylesheet" href="css/indexPageQueries.css?v=esdsdasssdadassssssssssadsssssssssdssssssssssssssss1se80c32s8b" />

   
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
     
<button class="openbtn"></button>

<div id="mySidebar" class="sidebar">
     
        <div class="sidebar-content">
        
  
  <div class="right-content-div">
            <h1 class="hide-event">
                <span class="welcome">Welcome back,</span>
              
              <span class="user-name-log">
                  <br>
              <?php
echo $_SESSION['login_admin'];
?>
</span>
           </h1>
           <a href="javascript:void(0)" class="closebtn">adassd</a>
            
          </div>
         

          <div class="sidebar-top-section">
          
  <a class="sidebar-links hide-event" href="index_admin.php">Courses</a>

  </div>

  <div class="add-content"> 
    <a class="sidebar-links hide-event py-2" href="add_course_admin.php">Add course</a>
    <a class="sidebar-links hide-event py-2" href="add_class.php">Add subject</a>
    
  </div>

  
              <a
                href="logout_admin.php"
                id="logout-btn"
                class="logout-btn hide-event pt-4 text-decoration-none"
                >LOGOUT
              </a>
          
</div>
</div>


      <main id="main-content">
      
     
        <section id="Asd" class="welcome-section first-section">
          <h1>Learn everything at your own pace... with us!</h1>
          <p>Take your pen and start learning right away, for <span class="us">FREE.</span></p> 
        </section>
       

<form class="search-form d-flex justify-content-between align-items-center" action="">
<input type="text" name="search" id="search" placeholder="Search courses..." maxlength="40" onkeyup="load_data(this.value);" />
<i class="fa-solid fa-magnifying-glass ml-auto position-absolute fa-lg" style="right: 3rem; color: gray;"></i>
</form>

<div id="wrapper">

          <section id="course-section">
          <h1 class="your-courses">Your courses</h1>  
     

       </section>

       </div>
      
        </main>
    

      




        

        </div>
      </body>
      <script src="js/sidebar.js?v=dassdssssssssdadadassdssadasssssssssssassssssss"></script>
      <script src="js/loadData.js?v=dsadssdasdadsdasdssddasdasadadaddadadadadasdadadasassasdsassadas"></script>
    

    </html>