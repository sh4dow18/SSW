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
        <title>Stand Up</title>
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
                <a href="admin_categories.php" class="nav-link">Categories</a>
                <a href="admin_genders.php" class="nav-link">Genders</a>
                <i class='fas fa-angle-left'></i></i><a href="../php/destroy.php" class="nav-link">Log Out</a>
            </nav>
        </header>
        <div id="login">
            <div id="login-header">
                <h1>Add Show</h1>
            </div>
            <form action="admin_stand_up.php" method="post">
                <div id="login-form">
                    <h3>Comedian:</h3>
                    <input name="comedian" type="text" placeholder="Comedian" required>
                    <h3>Show:</h3>
                    <input name="show" type="text" placeholder="Show" required>
                    <input type="submit" name="Add" value="Add">
                </div>
            </form>
        </div>
        <p>To see the Shows Catalog, click <b><a href='stand_up.php' class='nav-link'>here</a></b></p>
        <div id="login">
            <div id="login-header">
                <h1>Delete Show</h1>
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
                    <h3>Comedian:</h3>
                    <input name="comedian" type="list" list="list1" placeholder="Comedian" required>
                    <h3>Show:</h3>
                    <input name="show" type="list" list="list2" placeholder="Show" required>
                    <input type="submit" name="Delete" value="Delete">
                </div>
            </form>
        </div>
        <div id="login">
            <div id="login-header">
                <h1>Backup</h1>
            </div>
            <form action="admin_stand_up.php" method="post">
                <div id="login-form">
                    <h3>File:</h3>
                    <input name="file" type="text" placeholder="File" required>
                    <input type="submit" name="Backup" value="Backup">
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
            $stand_up_query = "INSERT INTO standup (comedian, show_, order_) VALUES ('$comedian', '$show', 0);";
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
    if (isset($_POST['Backup'])) {
        if ($_POST['file'] != " ") {
            require_once "../php/connect.php";
            $file_path = $_POST['file'];
            if (($shows = file($file_path)) != 0) {
                $counter = 0;
                $comedian_name = "";
                foreach ($shows as $show) {
                    if ($counter == 0) {
                        $comedian_name = str_replace(' ', '_', $show);
                        $comedian_name = str_replace('\n', '', $comedian_name);
                        $counter = 1;
                    }
                    else {
                        $show_name = str_replace(' ', '_', $show);
                        $show_name = str_replace('\n', '', $show_name);
                        $verify_query = "SELECT * FROM standup WHERE comedian = '$comedian_name' AND show_ = '$show_name';";
                        $result = $connection->query($verify_query);
                        if ($result->num_rows == 0) {
                            $movie_query = "INSERT INTO standup (comedian, show_, order_) VALUES ('$comedian_name', '$show_name', 0);";
                            mysqli_query($connection, $movie_query);
                        }
                        $comedian_name = "";
                        $counter = 0;
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
    mysqli_close($connection);
?>