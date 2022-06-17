<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="../css/general.css">
        <link rel="stylesheet" type="text/css" href="../css/logo.css">
        <link rel="stylesheet" type="text/css" href="../css/login.css">
    </head>
    <body>
        <header>
            <a id="logo-header" class="logo" href="../index.php"><img src="../images/logo.png" alt="logo" class="logo-img"><p class="logo-nombre">Sh4dow18 Streaming Website</p></a>
        </header>
        <div id="login">
            <div id="login-header">
                <h1>Iniciar Sesion</h1>
            </div>
            <form action="login.php" method="post">
                <div id="login-form">
                    <h3>Usuario:</h3>
                    <input name="username" type="text" placeholder="Usuario" required>
                    <h3>Contraseña:</h3>
                    <input name="password" type="password" placeholder="Contraseña" required>
                    <input type="submit" name="Submit" value="Iniciar Sesion">
                </div>
            </form>
            <h3>No te has registrado? Has click <b><a href="register.php">aqui</a></b> para registrarte</h3>
        </div>
        <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    </body>
</html>

<?php
    if (isset($_POST["Submit"])) {
        require_once "../php/connect.php";
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = $connection->query($query);
        if ($result->num_rows == 1) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if ($password == $row['password']) {
                $query = "UPDATE users SET loggedin = 1 WHERE username = '$username';";
                mysqli_query($connection, $query);
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                if ($row['child'] == 0) {
                    $_SESSION["child"] = 0;
                }
                else {
                    $_SESSION["child"] = 1;
                }
                if ($username == 'admin') {
                    header("Location: admin.php");
                }
                else {
                    header("Location: home.php");
                }
            }
            else {
                echo "<script language='javascript'>alert('El Usuario o la contraseña son incorrectos');</script>";
            }
        }
        else {
            echo "<script language='javascript'>alert('El Usuario o la contraseña son incorrectos');</script>";
        }
        mysqli_close($connection);
    }
?>