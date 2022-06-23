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
            <h1>Series</h1>
        </div>
        <form action="series.php" method="post">
            <div id="search">
                <input name="serie_searched" type="text" placeholder="Serie to Search" required>
            </div>
        </form>
        <div>
            <?php
                require_once "../php/connect.php";
                if ($_POST['serie_searched'] == NULL || $_POST['serie_searched'] == " ") {
                    $last_movie_query = "SELECT * FROM users WHERE username = '{$_SESSION['username']}';";
                    $result = $connection->query($last_movie_query);
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    if ($row['last_serie'] != '-') {
                        $name = str_replace('_', ' ', $row['last_serie']);
                        $chapter = $row['last_chapter'];
                        if ($chapter < 10) {
                            $chapter = '0' . $chapter;
                        }
                        $title = $name . ": S" . $row['last_season'] . "E" . $chapter;
                        echo 
                        "<h2>Watch Again:</h2>
                        <div>
                            <a href='play_video.php?serie={$row['last_serie']}&season={$row['last_season']}&chapter=$chapter&max={$row['max_chapters']}&seasons={$row['max_seasons']}'><img src='../images/Series/{$row['last_serie']}.jpg'></a>
                            <h2>$title</h2>
                        </div>";
                    }
                }
            ?>
        </div>
        <div id="flex">
            <?php
                if (isset($_POST['serie_searched']) && $_POST['serie_searched'] != " ") {
                    if ($_SESSION['child'] == 0) {
                        $series_query = "SELECT * FROM series WHERE name_ LIKE '%{$_POST['serie_searched']}%' ORDER BY name_ ASC;";
                    }
                    else {
                        $series_query = "SELECT * FROM series WHERE name_ LIKE '%{$_POST['serie_searched']}%' AND child = {$_SESSION['child']} ORDER BY name_ ASC;";
                    }
                }
                else {
                    if ($_SESSION['child'] == 0) {
                        $series_query = "SELECT * FROM series ORDER BY name_ ASC";
                    }
                    else {
                        $series_query = "SELECT * FROM series WHERE child = {$_SESSION['child']} ORDER BY name_ ASC";
                    }
                }
                $result = $connection->query($series_query);
                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    $name = str_replace('_', ' ', $row['name_']);
                    echo 
                    "<div>
                        <a href='seasons_and_chapters.php?serie={$row['name_']}'><img src='../images/Series/{$row['name_']}.jpg'></a>
                        <h2>$name</h2>
                    </div>";
                }
                mysqli_close($connection);
            ?>
        </div>
        <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    </body>
</html>