<?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
        header("Location: error.php?error='login'");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Advanced Search</title>
        <link rel="stylesheet" type="text/css" href="../css/general.css">
        <link rel="stylesheet" type="text/css" href="../css/titles.css">
        <link rel="stylesheet" type="text/css" href="../css/login.css">
    </head>
    <body>
        <div id="title">
            <h1>Advanced Search</h1>
        </div>
        <div id="login">
            <form action="movies.php" method="post">
                <div id="login-form">
                    <input name="gender" type="text" placeholder="Specify Gender" required>
                </div>
            </form>
        </div>
        <div id="login">
            <form action="movies.php" method="post">
                <div id="login-form">
                    <input name="category" type="text" placeholder="Specify Category" required>
                </div>
            </form>
        </div>
        <a href="movies.php">Back to Movies</a>
    </body>
</html>