<?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['username'] != "admin") {
        header("Location: error.php?error=privileges");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Categories</title>
        <link rel="stylesheet" type="text/css" href="../css/general.css">
        <link rel="stylesheet" type="text/css" href="../css/logo.css">
        <link rel="stylesheet" type="text/css" href="../css/login.css">
        <link rel="stylesheet" type="text/css" href="../css/table.css">
        <link rel="icon" type="image/x-icon" href="../images/SSW/favicon.ico">
    </head>
    <body>
        <header>
            <a id="logo-header" class="logo"><img src="../images/SSW/logo.png" alt="logo" class="logo-img"></a>
        </header>
        <table class="container">
            <thead>
                <tr>
                    <th>Categories</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (isset($_GET['categories']) || isset($_GET['genders'])) {
                        require_once "../php/connect.php";
                        if (isset($_GET['categories'])) {
                            $query = "SELECT * FROM categories;";
                            $back = "categories";
                        }
                        else {
                            $query = "SELECT * FROM genders;";
                            $back = "genders";
                        }
                        $result = $connection->query($query);
                        while($row = $result->fetch_array(MYSQLI_ASSOC)){
                            echo
                            "<tr>
                                <td>{$row['name']}</td>
                            </tr>";
                        }
                        $back_link = "admin_$back.php";
                        mysqli_close($connection);
                    }
                ?>
            </tbody>
        </table>
        <?php
            echo "<p><b><a href='$back_link' class='nav-link'>Back to $back</a></b></p>";
        ?>
        <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    </body>
</html>
