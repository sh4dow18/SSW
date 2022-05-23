<?php
    if(isset($_GET['username'])) {
        require_once "connect.php";
        $username = $_GET['username'];
        $delete_query = "DELETE FROM users WHERE username = '$username'";
        $connection->query($delete_query);
        mysqli_close($connection);
        header("Location: ../pages/admin.php");
    }
?>