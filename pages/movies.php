<?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
        header("Location: error.php?error='login'");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sh4dow18 Streaming Website</title>
        <link rel="stylesheet" type="text/css" href="../css/general.css">
        <link rel="stylesheet" type="text/css" href="../css/logo.css">
        <link rel="stylesheet" type="text/css" href="../css/nav.css">
        <link rel="stylesheet" type="text/css" href="../css/titles.css">
        <link rel="stylesheet" type="text/css" href="../css/search.css">
    </head>
    <body>
        <header>
            <a id="logo-header" class="logo"><img src="../images/logo.png" alt="logo" class="logo-img"><p class="logo-nombre">Sh4dow18 Streaming Website</p></a>
            <nav>
                <i class="fas fa-home"></i><a href="series.php" class="nav-link">Series</a>
                <a href="movies.php" class="nav-link">Movies</a>
                <?php
                    if ($_SESSION['child'] == 0) {
                        echo "<a href='stand_up.php' class='nav-link'>Stand up</a>";
                    }
                    if ($_SESSION['username'] == 'admin') {
                        echo "<a href='admin.php' class='nav-link'>Administration</a>";
                    }
                    else {
                        echo "<i class='fas fa-user'></i></i><a href='../php/destroy.php' class='nav-link'>Change User</a>";
                    }
                ?>
                <i class='fas fa-angle-left'></i></i><a href="../php/destroy.php?die=yes" class="nav-link">Log Out</a>
            </nav>
        </header>
        <div id="title">
            <h1>Movies</h1>
        </div>
        <form action="movies.php" method="post">
            <div id="search">
                <input name="movie_searched" type="text" placeholder="Movie to Search" required>
            </div>
        </form>
        <div>
            <?php
                require_once "../php/connect.php";
                if ($_POST['movie_searched'] == NULL || $_POST['movie_searched'] == " ") {
                    $last_movie_query = "SELECT * FROM users WHERE username = '{$_SESSION['username']}';";
                    $result = $connection->query($last_movie_query);
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    if ($row['last_movie'] != '-') {
                        $name = str_replace('_', ' ', $row['last_movie']);
                        echo 
                        "<h2>Watch Again:</h2>
                        <div>
                            <a href='play_video.php?movie={$row['last_movie']}'><img src='../images/Movies/{$row['last_movie']}.jpg'></a>
                            <h2>$name</h2>
                        </div>";
                    }
                }
            ?>
        </div>
        <div id="flex">
            <?php
                if (isset($_POST['movie_searched']) && $_POST['movie_searched'] != " ") {
                    if ($_SESSION['child'] == 0) {
                        $movies_query = "SELECT * FROM movies WHERE name LIKE '%{$_POST['movie_searched']}%' ORDER BY name ASC;";
                    }
                    else {
                        $movies_query = "SELECT * FROM movies WHERE name LIKE '%{$_POST['movie_searched']}%' AND child = {$_SESSION['child']} ORDER BY name ASC;";
                    }
                }
                else {
                    if ($_SESSION['child'] == 0) {
                        $movies_query = "SELECT * FROM movies ORDER BY name ASC";
                    }
                    else {
                        $movies_query = "SELECT * FROM movies WHERE child = {$_SESSION['child']} ORDER BY name ASC";
                    }
                    
                }
                $result = $connection->query($movies_query);
                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    $name = str_replace('_', ' ', $row['name']);
                    echo 
                    "<div>
                        <a href='play_video.php?movie={$row['name']}'><img src='../images/Movies/{$row['name']}.jpg'></a>
                        <h2>$name</h2>
                    </div>";
                }
                mysqli_close($connection);
            ?>
        </div>
        <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    </body>
</html>