<?php
    if(isset($_GET['path_name'])) {
        require_once "connect.php";
        $path_name = $_GET['path_name'];
        $delete_query = "DELETE FROM paths WHERE name = '$path_name'";
        mysqli_query($connection, $delete_query);
        mysqli_close($connection);
        header("Location: ../pages/admin_paths.php");
    }
?>