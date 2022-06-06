<?php
require_once('dbconnection.php');
include 'admin/includes.php'; 
$errors = [];
$user_id = "";
// connect to database


if (isset($_POST['reset-password'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    // ensure that the user exists on our system
    $query = "SELECT email FROM users WHERE email='$email'";
    $results = mysqli_query($con, $query);

    if (empty($email)) {
        array_push($errors, "Your email is required");
    } elseif (mysqli_num_rows($results) <= 0) {
        array_push($errors, "Sorry, no user exists on our system with that email");
    }
    // generate a unique random token of length 100
    $token = bin2hex(random_bytes(50));

    if (count($errors) == 0) {
        // store token in the password-reset database table against the user's email
        $sql = "INSERT INTO password_resets(email, token) VALUES ('$email', '$token')";
        $results = mysqli_query($con, $sql);

        // Send email to user with the token in a link they can click on
        $to = $email;
        $subject = "Reset your password on aplicatie_licenta";
        $msg = "Hi there, click on this link\n" . "new_pass.php?token=" . $token . " to reset your password";
        $msg = wordwrap($msg, 70);
        $headers = "From: aplicatie_licenta@forupit.com";
        mail($to, $subject, $msg, $headers);
        header('location: pending.php?email=' . $email);
    }
}

// ENTER A NEW PASSWORD
if (isset($_POST['new_password'])) {
    $new_pass = mysqli_real_escape_string($con, $_POST['new_pass']);
    $new_pass_c = mysqli_real_escape_string($con, $_POST['new_pass_c']);

    // Grab to token that came from the email link
    // $tokens = $_GET['token'];
    $tokensql = "SELECT password_resets.token from password_resets";
    $resulttoken = mysqli_query($con, $tokensql);
    $restoken = mysqli_fetch_array($resulttoken);
    $token = $restoken['token'];
    if (empty($new_pass) || empty($new_pass_c)) {
        array_push($errors, "Password is required");
    }
    if ($new_pass !== $new_pass_c) {
        array_push($errors, "Password do not match");
    }
    if (count($errors) == 0) {
        // select email address of user from the password_reset table
        $sql = "SELECT email FROM password_resets WHERE token='$token' LIMIT 1";
        $results = mysqli_query($con, $sql);
        $email = mysqli_fetch_assoc($results)['email'];

        if ($email) {
            $new_pass = md5($new_pass);
            $sql = "UPDATE users SET password='$new_pass' WHERE email='$email'";
            $results = mysqli_query($con, $sql);
            header('location: index.php');
        }
    }
}
