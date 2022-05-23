<?php
    require_once "php/connect.php";
    $query = "SELECT * FROM users WHERE loggedin = 1;";
    $result = $connection->query($query);
    $users = array();
    if ($result->num_rows != 0) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            if ($row['username'] != "admin") {
                array_push($users, $row['username']);
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sh4dow18 Streaming Website</title>
        <link rel="stylesheet" type="text/css" href="css/general.css">
        <link rel="stylesheet" type="text/css" href="css/titles.css">
        <link rel="stylesheet" type="text/css" href="css/home_buttons.css">
    </head>
    <body>
        <h1>Bienvenido/a a:</h1>
        <div id="main">
            <h1>Sh4dow18 Streaming Website</h1>
        </div>
        <?php
            if (count($users) != 0) {
                echo "<h3>Existen Sesiones Abiertas, deseas ingresar rapidamente como:</h3>";
                foreach ($users as $user) {
                    echo "<button class='custom-btn btn-11 Login'>$user</button>";
                }
                echo "<h3>Eres otra persona? Entonces para ir a iniciar sesion has click <a href='pages/login.php'>aqui</a></h3>";
            }
            else {
                echo "<h3>No has iniciado sesion parece, entonces para ir a iniciar sesion has click <a href='pages/login.php'>aqui</a></h3>";
            }
        ?>
        <script language="javascript" src="js/login.js"></script>
    </body>
</html>
<?php
    mysqli_close($connection);
?>