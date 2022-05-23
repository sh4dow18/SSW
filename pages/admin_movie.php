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
                <h1>Agregar Pelicula</h1>
            </div>
            <form action="admin_movie.php" method="post">
                <div id="login-form">
                    <h3>Pelicula:</h3>
                    <input name="movie" type="text" placeholder="Pelicula" required>
                    <input type="submit" name="Submit" value="Agregar">
                </div>
            </form>
        </div>
        <p>Para ver las peliculas, hacer click <a href='movies.php' class='nav-link'>aqui</a></p>
        <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    </body>
</html>
<?php
    if (isset($_POST['Submit'])) {
        if ($_POST['movie'] != " ") {
            require_once "../php/connect.php";
            $verify_query = "SELECT * FROM movies WHERE name = '{$_POST['movie']}';";
            $result = $connection->query($verify_query);
            if ($result->num_rows == 0) {
                $name = str_replace(' ', '_', $_POST['movie']);
                $movie_query = "INSERT INTO movies (name) VALUES ('$name');";
                mysqli_query($connection, $movie_query);
                echo "<script language='javascript'>alert('Se ha agregado {$_POST['movie']} con exito')</script>";
            }
            else {
                echo "<script language='javascript'>alert('La Pelicula {$_POST['movie']} ya existe en el sistema')</script>";
            }
            mysqli_close($connection);
        }
        else {
            echo "<script language='javascript'>alert('No se puede ingresar una pelicula vacia');</script>";
        }
    }
?>