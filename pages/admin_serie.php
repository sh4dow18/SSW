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
        <title>Peliculas</title>
        <link rel="stylesheet" type="text/css" href="../css/general.css">
        <link rel="stylesheet" type="text/css" href="../css/logo.css">
        <link rel="stylesheet" type="text/css" href="../css/login.css">
    </head>
    <body>
        <header>
            <a id="logo-header" class="logo"><img src="../images/logo.png" alt="logo" class="logo-img"><p class="logo-nombre">Sh4dow18 Streaming Website</p></a>
            <nav>
                <a href="admin.php" class="nav-link">Eliminar</a>
                <a href="admin_movie.php" class="nav-link">Peliculas</a>
                <a href="admin_serie.php" class="nav-link">Series</a>
                <a href="admin_stand_up.php" class="nav-link">Stand Up</a>
                <i class='fas fa-angle-left'></i></i><a href="../php/destroy.php" class="nav-link">Cerrar Sesion</a>
            </nav>
        </header>
        <div id="login">
            <div id="login-header">
                <h1>Agregar Serie</h1>
            </div>
            <form action="admin_serie.php" method="post">
                <div id="login-form">
                    <h3>Serie:</h3>
                    <input name="serie" type="text" placeholder="Serie" required>
                    <h3>Cantidad de Temporadas:</h3>
                    <input name="seasons" type="number" placeholder="3" required>
                    <h3>Codigo de Capitulos:</h3>
                    <input name="limits" type="text" placeholder="8/16/18" required>
                    <h3>Temporada en la que Empieza:</h3>
                    <input name="season_begin" type="number" placeholder="1" required>
                    <h3>Capitulo en el que Empieza:</h3>
                    <input name="chapter_begin" type="number" placeholder="1" required>
                    <input type="submit" name="Submit" value="Agregar">
                </div>
            </form>
        </div>
        <p>Para ver las series, hacer click <a href='series.php' class='nav-link'>aqui</a></p>
        <div id="login">
            <div id="login-header">
                <h1>Actualizar Serie</h1>
            </div>
            <form action="admin_serie.php" method="post">
                <div id="login-form">
                    <datalist id="list">
                        <?php
                            require_once "../php/connect.php";
                            $update_query = "SELECT * FROM series;";
                            $result = $connection->query($update_query);
                            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                $name = str_replace('_', ' ', $row['name_']);
                                echo "<option>$name</option>";
                            }
                        ?>
                    </datalist>
                    <h3>Serie:</h3>
                    <input name="serie" type="list" list="list" placeholder="Serie" required>
                    <h3>Agregar Temporadas:</h3>
                    <input name="seasons" type="number" placeholder="2" required>
                    <h3>Agregar a Codigo de Capitulos:</h3>
                    <input name="limits" type="text" placeholder="15/10" required>
                    <input type="submit" name="Update" value="Actualizar">
                </div>
            </form>
        </div>
        <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    </body>
</html>
<?php
    if (isset($_POST['Submit'])) {
        require_once "../php/connect.php";
        $verify_query = "SELECT * FROM series WHERE name_ = '{$_POST['serie']}';";
        $result = $connection->query($verify_query);
        if ($result->num_rows == 0) {
            $name = str_replace(' ', '_', $_POST['serie']);
            $serie_query = "INSERT INTO series (name_, seasons, limits, season_begin, chapter_begin) VALUES ('$name', {$_POST['seasons']}, '{$_POST['limits']}', {$_POST['season_begin']}, {$_POST['chapter_begin']});";
            mysqli_query($connection, $serie_query);
            echo "<script language='javascript'>alert('Se ha agregado {$_POST['serie']} con exito')</script>";
        }
        else {
            echo "<script language='javascript'>alert('La Serie {$_POST['serie']} ya existe en el sistema')</script>";
        }
        mysqli_close($connection);
    }
    if (isset($_POST['Update'])) {
        require_once "../php/connect.php";
        $verify_query = "SELECT * FROM series WHERE name_ = '{$_POST['serie']}';";
        $result = $connection->query($verify_query);
        if ($result->num_rows == 1) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $seasons = $row['seasons'] + $_POST['seasons'];
            $limits = $row['limits'] . '/' . $_POST['limits'];
            $name = str_replace(' ', '_', $_POST['serie']);
            $update_query = "UPDATE series SET seasons = $seasons, limits = $limits WHERE name = {$row['name']};";
            mysqli_query($connection, $update_query);
            echo "<script language='javascript'>alert('Se ha actualizado {$_POST['serie']} con exito')</script>";
        }
        else {
            echo "<script language='javascript'>alert('La Serie {$_POST['serie']} no existe en el sistema')</script>";
        }
        mysqli_close($connection);
    }
?>