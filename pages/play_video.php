<?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
        header("Location: error.php?error=login");
    }
    if (isset($_GET['serie'])) {
        $title = str_replace('_', ' ', $_GET['serie']) . ": S" . $_GET['season'] . "E" . $_GET['chapter'];
        $video = "../Series/{$_GET['serie']}/Season {$_GET['season']}/Episode {$_GET['chapter']}.mp4";
        $return = "<i class='fas fa-angle-left'></i></i><a href='seasons_and_chapters.php?serie={$_GET['serie']}' class='nav-link'>Volver a los capitulos de {$_GET['serie']}</a>";
    }
    else if (isset($_GET['movie'])) {
        $title = str_replace('_', ' ', $_GET['movie']);
        $video = "../Movies/{$_GET['movie']}.mp4";
        $return = "<i class='fas fa-angle-left'></i></i><a href='movies.php' class='nav-link'>Volver a Peliculas</a>";
    }
    else if (isset($_GET['comedian'])) {
        $title = $_GET['comedian'] . ": " . str_replace('_', ' ', $_GET['show']);
        $video = "../Comedy/{$_GET['comedian']}/{$_GET['show']}.mp4";
        $return = "<i class='fas fa-angle-left'></i></i><a href='stand_up.php' class='nav-link'>Volver a Stand Up</a>";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Reproductor</title>
        <link rel="stylesheet" type="text/css" href="../css/general.css">
        <link rel="stylesheet" type="text/css" href="../css/logo.css">
        <link rel="stylesheet" type="text/css" href="../css/nav.css">
        <link rel="stylesheet" type="text/css" href="../css/titles.css">
        <link rel="stylesheet" type="text/css" href="../css/video.css">
    </head>
    <body>
        <header>
            <a id="logo-header" class="logo"><img src="../images/logo.png" alt="logo" class="logo-img"><p class="logo-nombre">Sh4dow18 Streaming Website</p></a>
            <nav>
                <?php echo $return; ?>
            </nav>
        </header>
        <div id="title">
            <?php echo "<h1>$title</h1>"; ?>
            <video controls>
                <?php echo "<source type='video/mp4' src='$video'>"; ?>
            </video>
        </div>
        <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    </body>
</html>