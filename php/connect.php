<?php
    $connection = new mysqli("127.0.0.1", "root", "", "ssw");
    if ($connection->connect_error) {
        header("Location: ../pages/error.php?error='db'");
    }
?>