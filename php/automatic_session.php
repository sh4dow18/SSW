<?php
    session_start();
    require_once "connect.php";
    $child_query = "SELECT * FROM users WHERE username = '{$_GET['username']}';";
    $result = $connection->query($child_query);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $_GET['username'];
    $_SESSION['child'] = $row['child'];
    mysqli_close($connection);
    header("Location: ../pages/home.php");
?>