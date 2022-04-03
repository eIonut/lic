<?php
unset($_SESSION['id']);
session_start();
session_destroy();
header('location:admin_login.php')
?>

