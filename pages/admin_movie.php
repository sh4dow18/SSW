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
        <title>Movies</title>
        <link rel="stylesheet" type="text/css" href="../css/general.css">
        <link rel="stylesheet" type="text/css" href="../css/logo.css">
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
                <i class='fas fa-angle-left'></i></i><a href="../php/destroy.php" class="nav-link">Log Out</a>
            </nav>
        </header>
        <div id="login">
            <div id="login-header">
                <h1>Add Movie</h1>
            </div>
            <form action="admin_movie.php" method="post">
                <div id="login-form">
                    <h3>Movie:</h3>
                    <input name="movie" type="text" placeholder="Movie" required>
                    <div id="child">
                        <input type=checkbox name="child" value="yes">
                        Can children watch the movie?
                    </div>
                    <input type="submit" name="Add" value="Add">
                </div>
            </form>
        </div>
        <p>To see the Movie Catalog, click <b><a href='movies.php' class='nav-link'>here</a></b></p>
        <div id="login">
            <div id="login-header">
                <h1>Edit Movie</h1>
            </div>
            <form action="admin_movie.php" method="post">
                <div id="login-form">
                    <h3>Movie:</h3>
                    <input name="movie" type="text" placeholder="Movie" required>
                    <div id="child">
                        <input type=checkbox name="child" value="yes">
                        Can children watch the movie?
                    </div>
                    <input type="submit" name="Update" value="Update">
                </div>
            </form>
        </div>
        <div id="login">
            <div id="login-header">
                <h1>Delete Movie</h1>
            </div>
            <form action="admin_movie.php" method="post">
                <div id="login-form">
                    <datalist id="list">
                        <?php
                            require_once "../php/connect.php";
                            $select_query = "SELECT * FROM movies;";
                            $result = $connection->query($select_query);
                            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                $name = str_replace('_', ' ', $row['name']);
                                echo "<option>$name</option>";
                            }
                        ?>
                    </datalist>
                    <h3>Movie:</h3>
                    <input name="movie" type="list" list="list" placeholder="Movie" required>
                    <input type="submit" name="Delete" value="Delete">
                </div>
            </form>
        </div>
        <div id="login">
            <div id="login-header">
                <h1>Backup</h1>
            </div>
            <form action="admin_movie.php" method="post">
                <div id="login-form">
                    <h3>File:</h3>
                    <input name="file" type="text" placeholder="File" required>
                    <input type="submit" name="Backup" value="Backup">
                </div>
            </form>
        </div>
        <div id="login">
            <div id="login-header">
                <h1>Backup for Children</h1>
            </div>
            <form action="admin_movie.php" method="post">
                <div id="login-form">
                    <h3>File:</h3>
                    <input name="file" type="text" placeholder="File" required>
                    <input type="submit" name="Backup_Child" value="Backup">
                </div>
            </form>
        </div>
        <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    </body>
</html>
<?php
    if (isset($_POST['Add'])) {
        if ($_POST['movie'] != " ") {
            require_once "../php/connect.php";
            $name = str_replace(' ', '_', $_POST['movie']);
            $verify_query = "SELECT * FROM movies WHERE name = '$name';";
            $result = $connection->query($verify_query);
            if ($result->num_rows == 0) {
                $child = 0;
                if (isset($_POST['child'])) {
                    $child = 1;
                }
                $name = str_replace(' ', '_', $_POST['movie']);
                $movie_query = "INSERT INTO movies (name, child) VALUES ('$name', $child);";
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
    if (isset($_POST['Update'])) {
        if ($_POST['movie'] != " ") {
            require_once "../php/connect.php";
            $name = str_replace(' ', '_', $_POST['movie']);
            $verify_query = "SELECT * FROM movies WHERE name = '$name';";
            $result = $connection->query($verify_query);
            if ($result->num_rows == 1) {
                $child = 0;
                if (isset($_POST['child'])) {
                    $child = 1;
                }
                $name = str_replace(' ', '_', $_POST['movie']);
                $movie_query = "UPDATE movies SET child = '$child' WHERE name = '$name';";
                mysqli_query($connection, $movie_query);
                echo "<script language='javascript'>alert('Se ha actualizado {$_POST['movie']} con exito')</script>";
            }
            else {
                echo "<script language='javascript'>alert('La Pelicula {$_POST['movie']} no existe en el sistema')</script>";
            }
            mysqli_close($connection);
        }
        else {
            echo "<script language='javascript'>alert('No se puede ingresar una pelicula vacia');</script>";
        }
    }
    if (isset($_POST['Delete'])) {
        if ($_POST['movie'] != " ") {
            require_once "../php/connect.php";
            $name = str_replace(' ', '_', $_POST['movie']);
            $verify_query = "SELECT * FROM movies WHERE name = '$name';";
            $result = $connection->query($verify_query);
            if ($result->num_rows == 1) {
                $movie_query = "DELETE FROM movies WHERE name = '$name';";
                mysqli_query($connection, $movie_query);
                echo "<script language='javascript'>alert('Se ha eliminado {$_POST['movie']} con exito')</script>";
                echo "<script language='javascript'>alert('Recordar que unicamente se ha eliminado el enlace de la pelicula a este programa, los archivos siguen en su sistema')</script>";
            }
            else {
                echo "<script language='javascript'>alert('La Pelicula {$_POST['movie']} no existe en el sistema')</script>";
            }
            mysqli_close($connection);
        }
        else {
            echo "<script language='javascript'>alert('No se puede eliminar una pelicula vacia');</script>";
        }
    }
    if (isset($_POST['Backup'])) {
        if ($_POST['file'] != " ") {
            require_once "../php/connect.php";
            $file_path = $_POST['file'];
            if (($movies = file($file_path)) != 0) {
                foreach ($movies as $movie) {
                    $name = str_replace(' ', '_', $movie);
                    $name = str_replace('\n', '', $name);
                    $verify_query = "SELECT * FROM movies WHERE name = '$name';";
                    $result = $connection->query($verify_query);
                    if ($result->num_rows == 0) {
                        $movie_query = "INSERT INTO movies (name, child) VALUES ('$name', 0);";
                        mysqli_query($connection, $movie_query);   
                    }
                }
                echo "<script language='javascript'>alert('Backup was Finished Successfully');</script>";
            }
            mysqli_close($connection);
        }
        else {
            echo "<script language='javascript'>alert('File path is Blank');</script>";
        }
    }
    if (isset($_POST['Backup_Child'])) {
        if ($_POST['file'] != " ") {
            require_once "../php/connect.php";
            $file_path = $_POST['file'];
            if (($movies = file($file_path)) != 0) {
                foreach ($movies as $movie) {
                    $name = str_replace(' ', '_', $movie);
                    $name = str_replace('\n', '', $name);
                    $verify_query = "SELECT * FROM movies WHERE name = '$name';";
                    $result = $connection->query($verify_query);
                    if ($result->num_rows == 1) {
                        $movie_query = "UPDATE movies SET child = 1 WHERE name = '$name';";
                        mysqli_query($connection, $movie_query);   
                    }
                }
                echo "<script language='javascript'>alert('Backup was Finished Successfully');</script>";
            }
            mysqli_close($connection);
        }
        else {
            echo "<script language='javascript'>alert('File path is Blank');</script>";
        }
    }
?>