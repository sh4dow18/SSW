<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="../css/general.css">
        <link rel="stylesheet" type="text/css" href="../css/logo.css">
        <link rel="stylesheet" type="text/css" href="../css/login.css">
    </head>
    <body>
        <header>
            <a id="logo-header" class="logo" href="../index.html"><img src="../images/logo.png" alt="logo" class="logo-img"><p class="logo-nombre">Sh4dow18 Streaming Website</p></a>
        </header>
        <div id="login">
            <div id="login-header">
                <h1>Registro</h1>
            </div>
            <form action="register.php" method="post">
                <div id="login-form">
                    <h3>Usuario:</h3>
                    <input name="username" type="text" placeholder="Usuario" required>
                    <h3>Contraseña:</h3>
                    <input name="password" type="password" placeholder="Contraseña" required>
                    <h3>Repita la Contraseña:</h3>
                    <input name="password_2" type="password" placeholder="Repita la Contraseña" required>
                    <div id="child">
                        <input type=checkbox name="child" value="yes">
                        Eres un Niño?
                    </div>
                    <input type="submit" name="Register" value="Registrarse">
                </div>
            </form>
        </div>
        <h3>Volver al <a href="login.php">Inicio de Sesion</a></h3>
        <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    </body>
</html>
<?php
    if (isset($_POST['Register'])) {
        require_once "../php/connect.php";
        $user_query = "SELECT * FROM users WHERE username = '{$_POST['username']}';";
        $result = $connection->query($user_query);
        if ($result->num_rows == 0) {
            if ($_POST["password"] == $_POST["password_2"]) {
                $child = 0;
                if (isset($_POST['child'])) {
                    $child = 1;
                }
                $register_query = "INSERT INTO users (username, password, loggedin, child, last_movie) VALUES ('{$_POST['username']}', md5('{$_POST['password']}'), 1, $child, '-');";
                mysqli_query($connection, $register_query);
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $_POST["username"];
                if ($child == 0) {
                    $_SESSION["child"] = 0;
                }
                else {
                    $_SESSION["child"] = 1;
                }
                header("Location: home.php");
            }
            else {
                echo "<script language='javascript'>alert('Las Contraseñas no coinciden');</script>";
            }
        }
        else {
            echo "<script language='javascript'>alert('El Usuario ingresado ya existe');</script>";
        }
    }
?>