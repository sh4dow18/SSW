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
                <h1>Agregar Show</h1>
            </div>
            <form action="admin_stand_up.php" method="post">
                <div id="login-form">
                    <h3>Comediante:</h3>
                    <input name="comedian" type="text" placeholder="Comediante" required>
                    <h3>Nombre del Show:</h3>
                    <input name="show" type="text" placeholder="Show" required>
                    <input type="submit" name="Submit" value="Agregar">
                </div>
            </form>
        </div>
        <p>Para ver los Stand Up Comedy, hacer click <a href='stand_up.php' class='nav-link'>aqui</a></p>
        <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    </body>
</html>
<?php
    if (isset($_POST['Submit'])) {
        require_once "../php/connect.php";
        $comedian = str_replace(' ', '_', $_POST['comedian']);
        $show = str_replace(' ', '_', $_POST['show']);
        $verify_query = "SELECT * FROM standup WHERE comedian = '$comedian' AND show_ = '$show';";
        $result = $connection->query($verify_query);
        if ($result->num_rows == 0) {
            $stand_up_query = "INSERT INTO standup (comedian, show_) VALUES ('$comedian', '$show');";
            mysqli_query($connection, $stand_up_query);
            echo "<script language='javascript'>alert('Se ha agregado el show {$_POST['show']} de {$_POST['comedian']} con exito')</script>";
        }
        else {
            echo "<script language='javascript'>alert('La Serie {$_POST['show']} ya existe en el sistema')</script>";
        }
        mysqli_close($connection);
    }
?>