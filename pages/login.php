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
                <h1>Login</h1>
            </div>
            <form action="login.php" method="post">
                <div id="login-form">
                    <h3>Username:</h3>
                    <input name="username" type="text" placeholder="Username" required>
                    <h3>Password:</h3>
                    <input name="password" type="password" placeholder="Password" required>
                    <input type="submit" name="Submit" value="Login">
                </div>
            </form>
            <p>Have you not registered? Click <b><a href="register.php">here</a></b> to register</p1>
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