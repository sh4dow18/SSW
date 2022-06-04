<?php
    if(isset($_GET['path_name'])) {
        require_once "connect.php";
        $path_name = $_GET['path_name'];
        $unselected_query = "UPDATE paths SET selected = 0;";
        $selected_query = "UPDATE paths SET selected = 1 WHERE name = '$path_name';";
        mysqli_query($connection, $unselected_query); 
        mysqli_query($connection, $selected_query);
        mysqli_close($connection);
        header("Location: ../pages/admin_paths.php");
    }
?>