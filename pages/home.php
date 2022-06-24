<?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
        header("Location: error.php?error='login'");
    }
    $username = ucfirst($_SESSION['username']);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="../css/general.css">
        <link rel="stylesheet" type="text/css" href="../css/titles.css">
        <link rel="stylesheet" type="text/css" href="../css/home_buttons.css">
        <link rel="icon" type="image/x-icon" href="../images/SSW/favicon.ico">
    </head>
    <body>
        <div id="title">
            <?php echo "<h1>Hello $username</h1>"; ?>
        </div>
        <h2>Tell me, what do you want to watch?</h2>
        <button class="custom-btn btn-11" id="Series">Series</button>
        <button class="custom-btn btn-11" id="Movies">Peliculas</button>
        <?php
            if ($_SESSION['child'] == 0) {
                echo "<button class='custom-btn btn-11' id='Stand_Up'>Stand Up</button>";
            }
        ?>
        <script language="javascript" src="../js/buttons.js"></script>
    </body>
</html>