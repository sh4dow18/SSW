<?php
    session_start();
    if (isset($_GET['die'])) {
        require_once "connect.php";
        $query = "UPDATE users SET loggedin = 0 WHERE username = '{$_SESSION['username']}';";
        mysqli_query($connection, $query);
        mysqli_close($connection);
    }
    session_unset();
    session_destroy();
    header("Location: ../index.php");
?>