<?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['username'] != "admin") {
        header("Location: error.php?error=privileges");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Users</title>
        <link rel="stylesheet" type="text/css" href="../css/general.css">
        <link rel="stylesheet" type="text/css" href="../css/logo.css">
        <link rel="stylesheet" type="text/css" href="../css/titles.css">
        <link rel="stylesheet" type="text/css" href="../css/admin_table.css">
    </head>
    <body>
        <header>
            <a id="logo-header" class="logo"><img src="../images/logo.png" alt="logo" class="logo-img"><p class="logo-nombre">Sh4dow18 Streaming Website</p></a>
            <nav>
                <a href="admin.php" class="nav-link">Users</a>
                <a href="admin_paths.php" class="nav-link">Paths</a>
                <a href="admin_serie.php" class="nav-link">Series</a>
                <a href="admin_movie.php" class="nav-link">Movies</a>
                <a href="admin_stand_up.php" class="nav-link">Stand Up</a>
                <i class='fas fa-angle-left'></i></i><a href="../php/destroy.php" class="nav-link">Log Out</a>
            </nav>
        </header>
        <div id="title">
            <h1>Users</h1>
        </div>
        <table class="container">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Child?</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once "../php/connect.php";
                    $users_query = "SELECT * FROM users";
                    $result = $connection->query($users_query);
                    while($row = $result->fetch_array(MYSQLI_ASSOC)){
                        if ($row['username'] != "admin") {
                            $child = "No";
                            if ($row['child'] == 1) {
                                $child = "Yes";
                            }
                            echo
                            "<tr>
                                <td>{$row['username']}</td>
                                <td>$child</td>
                                <td><a href='../php/delete_user.php?username={$row['username']}'>Delete</a></td>
                            </tr>";
                        }
                    }
                    mysqli_close($connection);
                ?>
            </tbody>
        </table>
        <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    </body>
</html>