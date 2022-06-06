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
            <h1>Series</h1>
        </div>
        <form action="series.php" method="post">
            <div id="search">
                <input name="serie_searched" type="text" placeholder="Serie a Buscar" required>
            </div>
        </form>
        <div id="flex">
            <?php
                require_once "../php/connect.php";
                if (isset($_POST['serie_searched']) && $_POST['serie_searched'] != " ") {
                    $series_query = "SELECT * FROM series WHERE name_ LIKE '%{$_POST['serie_searched']}%' ORDER BY name_ ASC;";
                }
                else {
                    $series_query = "SELECT * FROM series ORDER BY name_ ASC";
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