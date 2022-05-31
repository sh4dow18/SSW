<?php
    $schema_query = "CREATE SCHEMA IF NOT EXISTS `ssw`;";
    $movies_table = "CREATE IF NOT EXISTS TABLE `ssw`.`movies` (`name` VARCHAR(100) NOT NULL, `child` TINYINT NOT NULL, UNIQUE INDEX `name_UNIQUE` (`name` ASC));";
    $series_table = "CREATE IF NOT EXISTS TABLE `ssw`.`series` (`name_` VARCHAR(100) NOT NULL, `seasons` INT NOT NULL, `limits` VARCHAR(100) NOT NULL, `season_begin` INT NOT NULL, `chapter_begin` INT NOT NULL, UNIQUE INDEX `name__UNIQUE` (`name_` ASC));";
    $standup_table = "CREATE IF NOT EXISTS TABLE `ssw`.`standup` (`comedian` VARCHAR(100) NOT NULL, `show_` VARCHAR(45) NOT NULL, `order_` INT NOT NULL, UNIQUE INDEX `show__UNIQUE` (`show_` ASC));";
    $users_table = "CREATE IF NOT EXISTS TABLE `ssw`.`users` (`username` VARCHAR(45) NOT NULL, `password` VARCHAR(45) NOT NULL, `loggedin` INT NOT NULL, `child` INT NOT NULL, UNIQUE INDEX `username_UNIQUE` (`username` ASC));";
    mysqli_query($connection, $schema_query);
    mysqli_query($connection, $movies_table);
    mysqli_query($connection, $series_table);
    mysqli_query($connection, $standup_table);
    mysqli_query($connection, $users_table);
    mysqli_close($connection);
    $connection = new mysqli("127.0.0.1", "root", "", "ssw");
    if ($connection->connect_error) {
        header("Location: ../pages/error.php?error='db'");
    }
?>