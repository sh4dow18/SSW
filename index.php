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
        <link rel="icon" type="image/x-icon" href="images/SSW/favicon.ico">
    </head>
    <body>
        <h1>Welcome to:</h1>
        <img id="logo" src="images/SSW/logo.png">
        <?php
            if (count($users) != 0) {
                echo "<p>There are Open Sessions, you want to enter quickly as:</p>";
                foreach ($users as $user) {
                    echo "<button class='custom-btn btn-11 Login'>$user</button>";
                }
                echo "<p>You are another person? So to go to login click <b><a href='pages/login.php'>here</a></b></p>";
            }
            else {
                echo "<p>It seems that you are not logged in, so to go to log in click <b><a href='pages/login.php'>here</a></b></p>";
            }
        ?>
        <script language="javascript" src="js/login.js"></script>
    </body>
</html>
<?php
    mysqli_close($connection);
?>