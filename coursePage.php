<?php
include 'admin/includes.php';
include ('dbconnection.php');
unset($_SESSION);
$_SESSION = array();
session_unset();
session_start();
session_regenerate_id(TRUE);
if (strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
}
if (!$con) {
    echo 'Connection error' . mysqli_connect_error();
}
?>

<link rel="stylesheet" href="admin/css/coursePageQueries.css?v=addddadasdaasddaddadadadddaadadadddDdsddasdddaadsdaadadaddasassadadadaddaaddadaasdaddadadaaddadasasadasddaaas" />
<link rel="stylesheet" href="admin/css/newCourse.css?v=ss03dasssdadadadDDaddadadaadddddaaddadadaddadaddaddaadddddddaadadadaaaddaadaaddadadddadasasdasasaddaasdasaddadadaasdadasddasas03sssssssdassdasdasssssssssssssssdadsassssssssssssss8b" />
<link rel="stylesheet" href="admin/css/accordion.css?v=ss03ssdadasdadaDsdadddaa0ddadadaddaSdddadadaddadadddaddasdadaadadadsadasaddadasa3dadasdsssdassssssdadasdassssdassssssssssssssdassssssssssss8b" /> 


<?php
$id = mysqli_real_escape_string($con, $_GET['id']);
$sql2 = "SELECT * from courses WHERE courses.id = '$id'";
$result2 = mysqli_query($con, $sql2);
if (mysqli_num_rows($result2)==0) { 
    header("Location: index.php");
}
$res = mysqli_fetch_assoc($result2);

$sql = "SELECT lessons.id, lessons.name, lessons.lesson_order, assets.url,
            lessons_assets.lesson_id, lessons_assets.id as ai,
            assets.type, courses.name as course_name FROM lessons
            INNER JOIN lessons_assets ON lessons_assets.lesson_id = lessons.id
            INNER JOIN assets ON assets.id = lessons_assets.asset_id
            INNER JOIN courses ON lessons.course_id = courses.id
            WHERE lessons.course_id = '$id'
            ORDER BY lessons.lesson_order
        ";
$result = mysqli_query($con, $sql);

$asdfg = $_SESSION['login_user'];
$sql3 = "SELECT * from users WHERE users.username = '$asdfg'";
$result3 = mysqli_query($con, $sql3);
$rows = mysqli_fetch_assoc($result3);
$user_id = $rows['id'];
if (isset($_POST['comment'])) {
    $asdf = $_SESSION['login_user'];
    $comment = $_POST['comment'];
    $sql3 = "INSERT INTO reviews(course_id, user_id, rating)
    VALUES($id, '$user_id', '$comment')";
    if (mysqli_query($con, $sql3)) {
        header("Location: coursePage.php?id=" . $res['id']);
    } else {
        echo 'query error: ' . mysqli_error($con);
    }
}
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dETAILS</title>
</head>
<body style="background: white;">

<div class="container-grid">
    <div class="sidebar text-light px-3" style="transition: all 0.5s ease;">
        <div class="text-light sidebar-header pt-4 mx-auto d-flex justify-content-between align-items-center px-2 p0-collapse" style="width: 100%; overflow:hidden;">
        <div>
            <h3 class="hide-event m-0 p-0 welcome-top-sidebar">
                Welcome back,
                <br> 
                <p class="font-weight-bold"><?php echo $_SESSION['login_user']; ?></p>
            </h3>
        </div>
            <i class="fa-solid py-3 fa-expand collapse-btn sidebar-icons"></i>
        </div>
        <hr>

        <div class="sidebar-top-section  p0-collapse d-flex py-2 flex-column px-2">
            <div class="d-flex justify-content-between  align-items-center">
                <a class="sidebar-links hide-event py-2" href="index.php">Courses</a>
                <i class="fa-solid fa-book-open text-center sidebar-icons"></i>
            </div>
        </div>
        <hr>
        
        <div class="logout-div d-flex p0-collapse flex-row py-3 justify-content-between align-items-center px-2">
            <a
                href="logout.php"
                id="logout-btn"
                class="logout-btn hide-event sidebar-links px-0  mx-auto d-flex justify-content-start text-light" style="width: 100%;"
                >Logout
            </a>
            <i class="fa-solid fa-right-from-bracket sidebar-icons"></i>
        </div> 
    </div>

    <div class="content">
        <div class="row col-12 h-100 p-0 m-0">
            <div class="col-xl-8 p-0 m-0">
                <div id="videoDiv"class="videos d-flex flex-column text-center justify-content-center" style="height: 400px">
                    <p class="mt-50">No videos to watch. Talk to an admin to add more.</p>
                </div>

                <div class="comments mt-auto p-4" style="background: #eaeef5; height:50vh; max-height: 100vh; overflow: scroll; overflow-x: hidden;"">
                    <h4 class="border-bottom py-4 pt-0">Comments</h4>
                        <?php
                        $sql2 = "SELECT users.username as user_username, users.role as ur, reviews.update_at as reviews_update, reviews.rating as reviews_rating, reviews.id as reviews_id from reviews 
                                INNER JOIN courses ON courses.id = reviews.course_id
                                INNER JOIN users on users.id = reviews.user_id
                                WHERE courses.id=$id
                                ORDER BY reviews_update
                                ";
                        $result2 = mysqli_query($con, $sql2);
                        if (mysqli_num_rows($result2) > 0) {
                            while ($row = mysqli_fetch_assoc($result2)) {
                                echo '<div class="border-bottom py-3">';
                                echo '<div class="d-flex">';
                                echo '<p class="align-self-start font-weight-bold" style="color: #305397">' . $row["user_username"] . '</p>';
                                echo '<p class="align-self-end ml-auto font-weight-normal" style="opacity: 0.5">' . $row["reviews_update"] . '</p>';
                                echo '</div>';
                                echo '<p class="font-weight-bold">' . $row["reviews_rating"] . '</p>';
                                if ($row['user_username'] == $_SESSION['login_user']) { //pt partea
                                    echo '<div class="w-100 text-right">';
                                    echo '<a class="px-3 text-dark edit-btn" style="opacity: 0.75;" href="editCommentUser.php?id=' . $row['reviews_id'] . ';"><i class="fa-solid fa-pencil"></i></a>';
                                    echo '<a class="text-danger delete-btn" style="opacity: 0.75;" href="deleteCommentUser.php?id=' . $row['reviews_id'] . ';"><i class="fa-solid fa-trash"></i></a>';
                                    echo '</div>';
                                }
                                echo '</div>';
                            }
                        } else {
                            echo 'No comments found.';
                        }
                        ?>

<div class="leave-comment" style="height: fit-content;">
                    <form name="form" method="POST" class="was-validated" >
                        <div class="form-group">
                            <h4 class="my-4 p-0" >Leave a comment</h4>
                            <textarea class="form-control is-invalid" name="comment" id="comment" placeholder="Write here your comment..." required></textarea>
                            <div class="invalid-feedback">
                                Please enter a message in the textarea above to write a comment.
                            </div>
                    
                            <button class="btn btn-primary w-100 text-start border-0 py-2 pl-4 my-3 d-flex justify-content-between align-items-center"
                            style="background: linear-gradient(84.57deg, #1b3d7d 0%, #4a6db0 100%);"
                            >Send the comment<i class="fa-solid fa-xs ml-auto pr-2 fa-arrow-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>                
        </div>
        <div class="col-xl-4 border-info p-0 m-0 courses-div" style="background: #eaeef5; max-height: 100vh; overflow: scroll; overflow-x: hidden;">
            <?php
                $collecting_names = array();
                $contor = 0;
                echo ' <div class="d-flex justify-content-between align-items-center m-0 py-2">';
                echo '<h4 class="px-4 py-3 m-0"style="color: #305397;">' . $res['name'] . '</h4>';
                echo '</div>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $collecting_names[] = $row['name'];
                    $collecting_names = array_unique($collecting_names);
                    if ($row['lesson_id'] == $row['id']) {
                        if ($contor < count($collecting_names)) {
                            echo '<div class="accordion py-4 font-weight-bold mx-4 d-flex justify-content-between align-items-center" 
                            style="color: #000; border-bottom: 1px solid rgba(48, 83, 151, 0.3);">' . $collecting_names[$contor];
                            echo ' <div class="ml-auto pr-3">
                        </div>';
                            echo '</div>';
                            $contor++;
                        }
                    }
                    if ($row['type'] != 'video/mp4') {
                        echo '<div class="px-4 py-3"style="background: #eaeef5; max-height: fit-content;"> ';
                        echo '<p>' . $row['url'] . '</p>';
                        echo ' <div class="ml-auto pr-3  d-flex">';
                        echo '<a class="mr-2" style="opacity: 0.75; color: #305397;" href="images/' . $row["url"] . '" 
                        target="_blank">Download File </a>';
                        echo '<i class="fas fa-md fa-file-download mr-auto d-flex
                         justify-content-center align-items-center" style="opacity: 0.75; color: #305397;"></i>';
                ?>
                <?php
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<div class="panel px-4 py-3"style="background: #eaeef5; max-height: fit-content;"> ';
                        echo '<video class="course-video" src="images/' . $row["url"] . '" width="100%" height="300px" controls volume="1"></video>';
                        echo '<p>' . $row["url"] . '</p>';
                        echo '<button class="play-btn btn btn-primary w-100 text-start border-0 py-2 pl-4 d-flex justify-content-between 
                        align-items-center" 
                        style="background: linear-gradient(84.57deg, #1b3d7d 0%, #4a6db0 100%);" 
                        type="button">Watch this video<i class="fa-solid fa-xs ml-auto pr-2 fa-arrow-right"></i></button>';
                        echo '</div>';
                    }
                }
            ?>
        </div>
    </div>
</div>
</div>
</body>



<script>

if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

</script>
<script src="coursePageLogic.js?v=dasgdfgdadassdasdadaadadddaaadaeqsdadasdaaddadadadaaddaaddddaadadadaaadadadsadadasdaadadadadadadadadaddadaadadadaddsSafasdafssfsdadadaadadadaassddasAddaasdsagsf"></script>
</html>