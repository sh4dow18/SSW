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
        <h1>Welcome to:</h1>
        <div id="main">
            <h1>Sh4dow18 Streaming Website</h1>
        </div>
        <?php
            if (count($users) != 0) {
                echo "<h3>There are Open Sessions, you want to enter quickly as:</h3>";
                foreach ($users as $user) {
                    echo "<button class='custom-btn btn-11 Login'>$user</button>";
                }
                echo "<h3>You are another person? So to go to login click <a href='pages/login.php'>here</a></h3>";
            }
            else {
                echo "<h3>It seems that you are not logged in, so to go to log in click <a href='pages/login.php'>here</a></h3>";
            }
        ?>
        <script language="javascript" src="js/login.js"></script>
    </body>
</html>
<?php
    mysqli_close($connection);
?>