<?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
        header("Location: error.php?error='login'");
    }
    $title = str_replace('_', ' ', $_GET['serie']);
    $serie = $_GET['serie'];
    require_once "../php/connect.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Temporadas</title>
        <link rel="stylesheet" type="text/css" href="../css/general.css">
        <link rel="stylesheet" type="text/css" href="../css/logo.css">
        <link rel="stylesheet" type="text/css" href="../css/nav.css">
        <link rel="stylesheet" type="text/css" href="../css/titles.css">
        <link rel="stylesheet" type="text/css" href="../css/table.css">
    </head>
    <body>
        <header>
            <a id="logo-header" class="logo"><img src="../images/logo.png" alt="logo" class="logo-img"><p class="logo-nombre">Sh4dow18 Streaming Website</p></a>
            <nav>
                <i class='fas fa-angle-left'></i><a href="series.php" class="nav-link">Volver a Series</a>
            </nav>
        </header>
        <div id="title">
            <?php
                echo "<h1>Temporadas de $title</h1>";
            ?>
        </div>
        <?php
            $chapters_query = "SELECT * FROM series WHERE name_ = '$serie';";
            $result = $connection->query($chapters_query);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $number_of_seasons = intval($row['seasons']);
            $first_season = $row['season_begin'];
            $first_chapter = $row['chapter_begin'];
            $begin = 0;
            $lenght = 2;
            for ($iterable = 1; $iterable <= $number_of_seasons; $iterable++) {
                echo
                "<h2>Temporada $first_season</h2>
                <table class='container'>
                    <thead>
                        <th>Episodio</th>
                    </thead>
                    <tbody>";
                $number_of_chapters = intval(substr($row['limits'], $begin, $lenght));
                for ($iterable_2 = 1; $iterable_2 <= $number_of_chapters; $iterable_2++) {
                    if ($first_chapter < 10) {
                        $first_chapter = "0" . $first_chapter;
                    }
                    echo
                    "   <tr>
                            <td><a href='play_video.php?serie=$serie&season=$first_season&chapter=$first_chapter&max=$number_of_chapters'>Episodio $first_chapter</a></td>
                        </tr>";
                    $first_chapter = intval($first_chapter);
                    $first_chapter++;
                }
                echo 
                    "</tbody>
                </table>";
                $begin = $begin + 3;
                $first_season++;
                $first_chapter = 1;
            }
        ?>
        <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    </body>
</html>
<?php
    mysqli_close($connection);
?>