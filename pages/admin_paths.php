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
        <title>Paths</title>
        <link rel="stylesheet" type="text/css" href="../css/general.css">
        <link rel="stylesheet" type="text/css" href="../css/logo.css">
        <link rel="stylesheet" type="text/css" href="../css/titles.css">
        <link rel="stylesheet" type="text/css" href="../css/admin_table.css">
        <link rel="stylesheet" type="text/css" href="../css/login.css">
        <link rel="icon" type="image/x-icon" href="../images/SSW/favicon.ico">
    </head>
    <body>
        <header>
            <a id="logo-header" class="logo"><img src="../images/SSW/logo.png" alt="logo" class="logo-img"></a>
            <nav>
                <a href="admin.php" class="nav-link">Users</a>
                <a href="admin_paths.php" class="nav-link">Paths</a>
                <a href="admin_serie.php" class="nav-link">Series</a>
                <a href="admin_movie.php" class="nav-link">Movies</a>
                <a href="admin_stand_up.php" class="nav-link">Stand Up</a>
                <a href="admin_categories.php" class="nav-link">Categories</a>
                <a href="admin_genders.php" class="nav-link">Genders</a>
                <i class='fas fa-angle-left'></i></i><a href="../php/destroy.php" class="nav-link">Log Out</a>
            </nav>
        </header>
        <div id="login">
            <div id="login-header">
                <h1>Add Path</h1>
            </div>
            <form action="admin_paths.php" method="post">
                <div id="login-form">
                    <h3>Name:</h3>
                    <input name="name" type="text" placeholder="Name" required>
                    <h3>Path:</h3>
                    <input name="path" type="text" placeholder="Path" required>
                    <input type="submit" name="Add" value="Add">
                </div>
            </form>
        </div>
        <div id="title">
            <h1>Paths</h1>
        </div>
        <table class="container">
            <thead>
                <tr>
                    <th>Path</th>
                    <th>Select</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once "../php/connect.php";
                    $paths_query = "SELECT * FROM paths;";
                    $result = $connection->query($paths_query);
                    while($row = $result->fetch_array(MYSQLI_ASSOC)){
                        if ($row['selected'] == 1) {
                            $selected = $row['name'];
                        }
                        echo
                        "<tr>
                            <td>{$row['name']}</td>
                            <td><a href='../php/select_path.php?path_name={$row['name']}'>Select</a></td>";
                        if ($row['name'] != "Default") {
                            echo "<td><a href='../php/delete_path.php?path_name={$row['name']}'>Delete</a></td>";
                        }
                        else {
                            echo "<td>Delete</td>";
                        }
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <?php
            echo "<p>The Selected Path is <b>$selected</b></p>";
        ?>
        <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    </body>
</html>
<?php
    if (isset($_POST["Add"])) {
        require_once "../php/connect.php";
        $add_path_query = "INSERT INTO paths (name, path, selected) VALUES ('{$_POST["name"]}', '{$_POST["path"]}', 0);";
        mysqli_query($connection, $add_path_query);
        header("Location: admin_paths.php");
    }
    mysqli_close($connection);
?>