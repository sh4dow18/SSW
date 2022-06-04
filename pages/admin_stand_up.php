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
                <a href="admin.php" class="nav-link">Usuarios</a>
                <a href="admin_paths.php" class="nav-link">Rutas</a>
                <a href="admin_serie.php" class="nav-link">Series</a>
                <a href="admin_movie.php" class="nav-link">Peliculas</a>
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
                    <input type="submit" name="Add" value="Agregar">
                </div>
            </form>
        </div>
        <p>Para ver los Stand Up Comedy, hacer click <a href='stand_up.php' class='nav-link'>aqui</a></p>
        <div id="login">
            <div id="login-header">
                <h1>Eliminar Show</h1>
            </div>
            <form action="admin_stand_up.php" method="post">
                <div id="login-form">
                    <datalist id="list1">
                        <?php
                            require_once "../php/connect.php";
                            $list1_query = "SELECT * FROM standup;";
                            $result = $connection->query($list1_query);
                            $repeated = array();
                            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                if (!in_array($row['comedian'], $repeated)) {
                                    // array_push($row['comedian'], $repeated);
                                    $name = str_replace('_', ' ', $row['comedian']);
                                    echo "<option>$name</option>";
                                }
                            }
                        ?>
                    </datalist>
                    <datalist id="list2">
                        <?php
                            $list2_query = "SELECT * FROM standup;";
                            $result = $connection->query($list2_query);
                            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                $name = str_replace('_', ' ', $row['show_']);
                                echo "<option>$name</option>";
                            }
                        ?>
                    </datalist>
                    <h3>Comediante:</h3>
                    <input name="comedian" type="list" list="list1" placeholder="Comediante" required>
                    <h3>Nombre del Show:</h3>
                    <input name="show" type="list" list="list2" placeholder="Show" required>
                    <input type="submit" name="Delete" value="Eliminar">
                </div>
            </form>
        </div>
        <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    </body>
</html>
<?php
    if (isset($_POST['Add'])) {
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
    }
    if (isset($_POST['Delete'])) {
        require_once "../php/connect.php";
        $comedian = str_replace(' ', '_', $_POST['comedian']);
        $show = str_replace(' ', '_', $_POST['show']);
        $verify_query = "SELECT * FROM standup WHERE comedian = '$comedian' AND show_ = '$show';";
        $result = $connection->query($verify_query);
        if ($result->num_rows == 1) {
            $stand_up_query = "DELETE FROM standup WHERE comedian = '$comedian' AND show_ = '$show';";
            mysqli_query($connection, $stand_up_query);
            echo "<script language='javascript'>alert('Se ha eliminado el show {$_POST['show']} de {$_POST['comedian']} con exito')</script>";
            echo "<script language='javascript'>alert('Recordar que unicamente se ha eliminado el enlace al show a este programa, los archivos siguen en su sistema')</script>";
        }
        else {
            echo "<script language='javascript'>alert('La Serie {$_POST['show']} ya existe en el sistema')</script>";
        }
    }
    mysqli_close($connection);
?>