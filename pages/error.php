<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Error</title>
        <link rel="stylesheet" type="text/css" href="../css/general.css">
        <link rel="stylesheet" type="text/css" href="../css/logo.css">
        <link rel="stylesheet" type="text/css" href="../css/titles.css"> 
   </head>
    <body>
        <header>
            <a id="logo-header" class="logo"><img src="../images/logo.png" alt="logo" class="logo-img"><p class="logo-nombre">Sh4dow18 Streaming Website</p></a>
            <nav>
                <i class='fas fa-angle-left'></i></i><a href="../php/destroy.php" class="nav-link">Back to Title Screen</a>
            </nav>
        </header>
        <div id="title">
            <h1>Error</h1>
        </div>
        <?php
            if ($_GET['error'] == 'db') {
                echo "<h2>Failed to connect to server, please try again</h2>";
            }
            else if ($_GET['error'] == 'privileges') {
                echo "<h2>This Page is for Authorized Users only</h2>";
            }
            else {
                echo "<h2>This Page is only for Registered Users</h2>";
            }
        ?>
    </body>
    <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
</html>