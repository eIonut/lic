

    <link rel="stylesheet" href="css/indexPage.css?v=ess0ssssssssDAdadasddadsasdassssssssssassdsssssssdsssssszssss0c3d8b" />
    <link rel="stylesheet" href="css/sidebar.css?v=e031dddsdsassddadasssssssssssssssssssssssdsssssssssssscZd8b" />
    <link rel="stylesheet" href="css/commonStyles.css?v=esssdassdssdassssssssssssssssswssssdssssssssss1se80c32s8b" />
    <link rel="stylesheet" href="css/indexPageQueries.css?v=esdsddadaadasssddaadasdasssssssssadsssssssssdssssssssssssssss1se80c32s8b" />

   
    <?php
include '../dbconnection.php';
include 'includes.php';
unset($_SESSION);
$_SESSION = array();
session_unset();
session_start();
session_regenerate_id(TRUE); 

if (strlen($_SESSION['id'] == 0)) {
    header('location:logout_admin.php');
}

if (!$con) {
    echo 'Connection error' . mysqli_connect_error();
}



$query1 = @$_POST['course-search'];


if (empty($query1)) {
    $sql     = 'SELECT name, description, image from courses';
    $result  = mysqli_query($con, $sql);
    $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($con);
}

else {
    $sql     = 'SELECT courses.name, courses.id, courses.description, courses.image from courses WHERE (`courses.name` LIKE "%' . $query1 . '%")';
    $result  = mysqli_query($con, $sql);
    $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($con);
}

function clearClasses()
{
    $sql     = 'SELECT courses.name from courses';
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
        


        <title>Homepage</title>
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
          <div class="d-flex justify-content-between align-items-center w-100" style="opacity: 0.75;">
  <a class="sidebar-links hide-event" href="index_admin.php">Courses</a>
  <i class="fa-solid fa-book-open  sidebar-icons" style="opacity: 0.75;"></i>
</div>

  </div>

  <div class="add-content"> 
  <div class="py-0 d-flex justify-content-between align-items-center w-100" style="opacity: 0.75;">
    <a class="sidebar-links hide-event py-2" href="add_course_admin.php">Add course</a>
    <i class="fa-solid fa-plus text-center sidebar-icons" style="opacity: 0.75;"></i>
</div>

<div class="py-0 d-flex justify-content-between align-items-center w-100 " style="opacity: 0.75;">
    <a class="sidebar-links hide-event py-2" href="add_asset.php">Add assets</a>
    <i class="fa-solid fa-plus text-center sidebar-icons" style="opacity: 0.75;"></i>
</div>

<div class="py-0 d-flex justify-content-between align-items-center w-100 " style="opacity: 0.75;">
    <a class="sidebar-links hide-event py-2" href="add_lesson.php">Add lessons</a>
    <i class="fa-solid fa-plus text-center sidebar-icons" style="opacity: 0.75;"></i>
</div>

<div class="py-0 d-flex justify-content-between align-items-center w-100" style="opacity: 0.75;">
    <a class="sidebar-links hide-event py-2" href="add_class_v2.php">Add content</a>
    <i class="fa-solid fa-plus text-center sidebar-icons" style="opacity: 0.75;"></i>
</div>


    
  </div>

  <div class="py-4 d-flex justify-content-between align-items-center w-100 query" style="opacity: 0.75;">
              <a
                href="logout_admin.php"
                id="logout-btn"
                class="logout-btn hide-event text-decoration-none m-0"
                >Logout
              </a>
              <i class="fa-solid fa-right-from-bracket sidebar-icons" style="opacity: 0.75;"></i>
</div>      
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
