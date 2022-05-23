<?php
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $_GET['username'];
    header("Location: ../pages/home.php");
?>