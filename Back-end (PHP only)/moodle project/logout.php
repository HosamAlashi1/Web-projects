<?php
  // This Logout Page is Completely By Ahmed Hesham Alashi 120191156 and Mohammed Abo Sido 120192308
    session_start();
    echo "You are logged out Succesfully!";
    if (isset($_SESSION['admin'])) { // if the logger is an admin
        unset($_SESSION["admin"]);
    } else if (isset($_SESSION['student'])){  // if the logger is a user
        unset($_SESSION['student']);
    }
    setcookie('email'); // deleting the email cookie because the user logged out
    setcookie('password'); //  deleting the password cookie also because the user logged out
    
    $BackToMyPage = $_SERVER['HTTP_REFERER'];
    if (!isset($BackToMyPage)) {
        header('Location: '.$BackToMyPage);
    } else {
        header('Location: login.php'); // default page
    }
    // session_destroy();