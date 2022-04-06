<link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css/indexPage.css?v=e031erzs0c3d8b" />
    <link rel="stylesheet" href="css/sidebar.css?v=e031es0cZd8b" />
    <link rel="stylesheet" href="css/commonStyles.css?v=e031e80c328b" />
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
include '../dbconnection.php';
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
        <link rel="stylesheet" type="text/css" href="css/indexPage.css?v=e031e80c3d8b">


        <title>Document</title>
      </head>
      <body>
      
     
      <main id="main-content">
        <section class="welcome-section first-section">
          <h1>Lorem ipsum</h1>
          <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Officia enim aspernatur dolor facere aliquid delectus ab excepturi labore, rem soluta itaque officiis cumque, quasi saepe quibusdam commodi! Quas, ratione quidem!
          Iusto sint amet, tempore a modi quisquam mollitia deserunt, ipsum, ipsa dolores voluptate ullam adipisci ducimus est cupiditate sit dolor perferendis dolore quia asperiores labore cum quos nostrum provident? Quia.</p>
          <button><a href="#course-section">Start Learning here!</a></button>
        </section>
        <div class="add-content-div">
    
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
                value="Clear search"
                id="clear-btn"
                onclick="clearClasses()"
              />
            </form>
          </div>

          
        
          <h1 class="your-courses">YOUR COURSES</h1>
          <section id="course-section">
            <?php
foreach ($courses as $course) {
?>

            
              <div class="card">
                <img
                  class="card-img-top"
                  src="<?php
    echo 'upload/' . $course['course_image'];
?>"
                  alt=""
                />

                <div class="card-body">
                  <h5 class="card-title">
                    <?php
    echo htmlspecialchars($course['course_name']);
?>
                </h5>
                  <p class="card-text">
                    <?php
    echo htmlspecialchars($course['course_description']);
?>
                </p>
                  <a
                    class="btn btn-primary"
                    href="delete_course_admin.php?course_name=<?php
    echo $course['course_name'];
?>"
                    >More info</a
                  >
                </div>
              </div>
            
            <?php
}
?>
        </section>
        </main>
     
      <div id="mySidebar" class="sidebar">
      <button class="openbtn" onclick="openNav()">&#9776;</button>
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
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
  <a class="sidebar-links hide-event" href="#">About</a>
  <a class="sidebar-links hide-event" href="#">Contact</a>
  <a class="sidebar-btns hide-event" href="add_course_admin.php">Add Course</a>
  <a class="sidebar-btns hide-event" href="add_class.php">Add Subject</a>
  
              <a
                href="logout_admin.php"
                id="logout-btn"
                class="logout-btn sidebar-btns hide-event"
                >Logout
              </a>
           
</div>




        

      
      </body>
      <script src="js/sidebar.js?v=e031e80ssc3d8b"></script>

    </html>
    