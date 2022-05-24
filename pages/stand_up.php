<?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
        header("Location: error.php?error='login'");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stand Up</title>
        <link rel="stylesheet" type="text/css" href="../css/general.css">
        <link rel="stylesheet" type="text/css" href="../css/logo.css">
        <link rel="stylesheet" type="text/css" href="../css/nav.css">
        <link rel="stylesheet" type="text/css" href="../css/titles.css">
    </head>
    <body>
        <header>
            <a id="logo-header" class="logo"><img src="../images/logo.png" alt="logo" class="logo-img"><p class="logo-nombre">Sh4dow18 Streaming Website</p></a>
            <nav>
                <i class="fas fa-home"></i><a href="series.php" class="nav-link">Series</a>
                <a href="movies.php" class="nav-link">Peliculas</a>
                <a href="stand_up.php" class="nav-link">Stand up</a>
                <?php
                    if ($_SESSION['username'] == 'admin') {
                        echo "<a href='admin.php' class='nav-link'>Administracion</a>";
                    }
                ?>
                <i class='fas fa-user'></i></i><a href="../php/destroy.php" class="nav-link">Cambiar de Usuario</a>
                <i class='fas fa-angle-left'></i></i><a href="../php/destroy.php?die=yes" class="nav-link">Cerrar Sesion</a>
            </nav>
        </header>
        <div id="title">
            <h1>Stand Up</h1>
        </div>
        <div id="flex">
            <?php
                require_once "../php/connect.php";
                $standup_query = "SELECT * FROM standup ORDER BY order_ ASC;";
                $result = $connection->query($standup_query);
                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    $name = str_replace('_', ' ', $row['show_']);
                    echo 
                    "<div>
                        <a href='play_video.php?comedian={$row['comedian']}&show={$row['show_']}'><img src='../images/comedy/{$row['comedian']}/{$row['show_']}.jpg'></a>
                        <h2>$name</h2>
                    </div>";
                }
                mysqli_close($connection);
            ?>
        </div>
        <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    </body>
</html>