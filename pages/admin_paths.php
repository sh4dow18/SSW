<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Paths</title>
        <link rel="stylesheet" type="text/css" href="../css/general.css">
        <link rel="stylesheet" type="text/css" href="../css/logo.css">
        <link rel="stylesheet" type="text/css" href="../css/titles.css">
        <link rel="stylesheet" type="text/css" href="../css/admin_table.css">
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
                <h1>Agregar Ruta</h1>
            </div>
            <form action="admin_paths.php" method="post">
                <div id="login-form">
                    <h3>Nombre:</h3>
                    <input name="name" type="text" placeholder="Nombre" required>
                    <h3>Ruta:</h3>
                    <input name="path" type="text" placeholder="Ruta" required>
                    <input type="submit" name="Add" value="Agregar">
                </div>
            </form>
        </div>
        <div id="title">
            <h1>Rutas</h1>
        </div>
        <table class="container">
            <thead>
                <tr>
                    <th>Ruta</th>
                    <th>Seleccionar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once "../php/connect.php";
                    $paths_query = "SELECT * FROM paths;";
                    $result = $connection->query($paths_query);
                    while($row = $result->fetch_array(MYSQLI_ASSOC)){
                        if ($row['selected'] == 1) {
                            $selected = $row['name'];
                        }
                        echo
                        "<tr>
                            <td>{$row['name']}</td>
                            <td><a href='../php/select_path.php?path_name={$row['name']}'>Seleccionar</a></td>";
                        if ($row['name'] != "Default") {
                            echo "<td><a href='../php/delete_path.php?path_name={$row['name']}'>Eliminar</a></td>";
                        }
                        else {
                            echo "<td>Eliminar</td>";
                        }
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <?php
            echo "<p>La ruta seleccionada es <b>$selected</b></p>";
        ?>
        <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    </body>
</html>
<?php
    if (isset($_POST["Add"])) {
        require_once "../php/connect.php";
        $add_path_query = "INSERT INTO paths (name, path, selected) VALUES ('{$_POST["name"]}', '{$_POST["path"]}', 0);";
        mysqli_query($connection, $add_path_query);
        header("Location: admin_paths.php");
    }
    mysqli_close($connection);
?>